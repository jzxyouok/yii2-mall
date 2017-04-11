<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;
class User extends ActiveRecord{
    public $rememberMe;
    public $user;
    public $repass;
    public $loginUser;
    public static function tableName(){
        return "{{%user}}";
    }

    public function rules(){
        return [
            ['user','required', 'message'=>'账号不能为空' ,'on'=>['login']],
            ['user','validatelogin','on'=>['login']],
            ['username','required','message'=>'账号不能为空','on'=>['emailchangepass','reg']],
            ['username','unique','message'=>'该用户名已被注册','on'=>['reg']],
            ['useremail','required','message'=>'邮箱不能为空','on'=>['regbyemail','seekpass']],
            ['useremail','email','message'=>'邮箱非法','on'=>['regbyemail','seekpass']],
            ['useremail','unique','message'=>'邮箱已被注册','on'=>['regbyemail']],
            ['userpass','required','message'=>'密码不能为空','on'=>['login','emailchangepass','reg']],
            ['repass','compare','compareAttribute'=>'userpass','message'=>'密码与确认密码不一致','on'=>['emailchangepass','reg']],
            ['openid','unique','message'=>'该qq号已经被注册','on'=>['reg']],
        ];
    }

    /*
    通过邮箱注册
     */
    public function regByemail($data){
        $this->scenario = 'regbyemail';
        if($this->load($data) && $this->validate()){
            $username = 'imooc_'.uniqid();
            $userpass = uniqid();
            $email = Yii::$app->mailer->compose('userReg',['useremail'=>$this->useremail,'username'=>$username,'userpass'=>$userpass]);
            $email->setFrom("imooc_shop@163.com");
            $email->setTo($this->useremail);
            $email->setSubject('商城账号密码');
            if($email->send()){
                $this->username = $username;
                $this->userpass = md5($userpass);
                if($this->save(false)){
                    return true;
                }
                return false;
            }
        }
        return false;
    }
    /*
     邮箱登录
     */
    
    public function validatelogin(){
        if(!$this->hasErrors()){
            $data = $this->find()->where('useremail=:user and userpass=:pass',[':user'=>$this->user,':pass'=>md5($this->userpass)])->one();
            if(is_null($data)){
                $rel = $this->find()->where('username=:user and userpass=:pass',[':user'=>$this->user,':pass'=>md5($this->userpass)])->one();
                if(is_null($rel)){
                    $this->addError('user','账号或密码错误');
                }else{
                    Yii::$app->session['isUsername']=1;
                    $this->loginUser = $rel;
                }
            }else{
                Yii::$app->session['isUsername']=0;
                $this->loginUser = $data;
            }
            
        }
    }

    /*
    登录
     */
    public function login($data){
        $this->scenario = 'login';
        if($this->load($data) && $this->validate()){
            $session = Yii::$app->session;
            $session['user']=[
                'user'=>$this->user,
                'isLogin' =>1,
                'userid'=>$this->loginUser->userid,
            ];
            if($this->rememberMe==1){
                session_get_cookie_params(3600*12);
            }
            return true;
            
        }
        return false;
    }

    public function attributeLabels(){
        return [
            'useremail'=>'邮箱',
            'userpass'=>'密码',
            'user'=>'邮箱/账号',
            'repass'=>'确认密码',
            'username'=>'用户名'
        ];
    }

    public function changepass($data){
        $this->scenario = 'seekpass';
        if($this->load($data) && $this->validate()){
            $rel = $this->find()->where('username=:user and useremail=:pass',[':user'=>$this->username,':pass'=>$this->useremail])->one();
            if(is_null($rel)){
                Yii::$app->session->setFlash('info','账号或密码有误');
                return false;
            }
            $time = time();
            $token = $this->createToken($this->username,$time);
            $mailer = Yii::$app->mailer->compose('userseekpass',['username'=>$this->username,'time'=>$time,'token'=>$token]);
            $mailer->setFrom("imooc_shop@163.com");
            $mailer->setTo($this->useremail);
            $mailer->setSubject("慕课商城-找回密码");
            if($mailer->send()){
                Yii::$app->session->setFlash('info','邮件发送成功，请注意查收');
                return true;
            }
            return false;
        }
    }
    /*
    token
     */
    public function createToken($user,$time){
        return md5(md5($user).base64_encode(Yii::$app->request->userIp).md5($time));
    }
    /*
    修改用户信息
     */
    public function updatepassByName($data){
        $this->scenario = 'emailchangepass';
        if($this->load($data) && $this->validate()){
            $rel = $this->updateAll(['userpass'=>md5($this->userpass)],'username=:user',[':user'=>$this->username]);
            if(!$rel){
                return false;
            }
            return true;
        }
    }
    /*
    注册
     */
    public function reg($data,$scenario='reg'){
        $this->scenario = $scenario;
        if($this->load($data) && $this->validate()){
            $this->createtime = time();
            $this->userpass = md5($this->userpass);

            if($this->save(false)){
                return true;
            }
            return false;
        }
    }
}