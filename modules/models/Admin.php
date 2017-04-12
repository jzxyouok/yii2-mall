<?php 
namespace app\modules\models;
use yii\db\ActiveRecord;
use Yii;
class Admin extends ActiveRecord implements \yii\web\IdentityInterface {
	public $rememberMe = true;
	public $repass;
	public static function tableName(){
		return "{{%admin}}";
	}

	public function rules(){
		return [
			['adminuser','required','message'=>'用户名不能为空','on'=>['login','email','changepass','adminadd']],
			['adminuser','unique','message'=>'该用户已存在','on'=>['adminadd']],
			['adminpass','required','message'=>'密码不能为空','on'=>['login','changepass','adminadd','changeemail']],
			['rememberMe','boolean','on'=>['login']],
			['adminemail','required','message'=>'邮箱不能为空','on'=>['email','adminadd','changeemail']],
			['adminemail','email','message'=>'邮箱格式错误','on'=>['email','adminadd','changeemail']],
			['adminemail','unique','message'=>'邮箱已被注册','on'=>['adminadd','changeemail']],
			['adminemail','validateEmail','on'=>['email']],
			['repass','required','message'=>'确认密码不能为空','on'=>['changepass','adminadd']],
			['repass','compare','compareAttribute'=>'adminpass','message'=>'密码与确认密码不一致','on'=>['changepass','adminadd']],
			['adminpass','validatepass','on'=>['login','changeemail']],
			['createtime','safe'],
		];
	}

	public function validatepass(){
		if(!$this->hasErrors()){
			$data = $this->find()->where('adminuser= :user and adminpass= :pass',[':user'=>$this->adminuser,':pass'=>md5($this->adminpass)])->one();
			if(is_null($data)){
				$this->addError('adminpass','用户名或密码错误');
			}
		}
		
	}

	public function validateEmail(){
		if(!$this->hasErrors()){
			$data = $this->find()->where('adminuser= :user and adminemail= :email',[':user'=>$this->adminuser,':email'=>$this->adminemail])->one();
			if(is_null($data)){
				$this->addError('adminemail','邮箱或用户名错误');
			}
		}
	}

	public function getUser(){
		return $this->find()->where('adminuser=:user',[':user'=>$this->adminuser])->one();
	}

	public function login($data){
		$this->scenario = 'login';
		if($this->load($data) && $this->validate()){
			return Yii::$app->admin->login($this->getUser(),$this->rememberMe ? 3600*24 :0);

			/*$lifetime = $this->rememberMe ? 3600*24 :0;
			$session = Yii::$app->session;
			session_set_cookie_params($lifetime);
			$session['admin'] = array(
				'adminuser' => $this->adminuser,
				'isLogin' => 1
			);
			$this->updateAll(
				array(
				'logintime'=>time(),
				'loginip' =>ip2long(Yii::$app->request->userIp)
				),
				'adminuser= :user',
				[':user'=>$this->adminuser]
			);
			return true;*/
		}else{
			return false;
		}
	}

	public function isLogin(){
		$session = Yii::$app->session;
		if(isset($session['admin']['isLogin'])){
			return true;
		}
		return false;
	}

	public function seekPass($data){
		$this->scenario = 'email';
		if($this->load($data) && $this->validate()){
			$time = time();
			$token = $this->createToken($data['Admin']['adminuser'],$time);
			 $mailer = Yii::$app->mailer->compose('seekpass', ['adminuser' => $data['Admin']['adminuser'], 'time' => $time, 'token' => $token]);
            $mailer->setFrom("imooc_shop@163.com");
            $mailer->setTo($data['Admin']['adminemail']);
            $mailer->setSubject("慕课商城-找回密码");

            if ($mailer->send()) {
                return true;
            }
		}
		return false;
	}

	public function createToken($user,$email){
		return md5(md5($user).base64_encode(Yii::$app->request->userIp).md5($email));
	}

	public function changepass($data){
		$this->scenario = 'changepass';
		if($this->load($data) && $this->validate()){
			$rel = $this->updateAll(['adminpass'=>md5($this->adminpass)],'adminuser= :user',[':user'=>$this->adminuser]);
			return (bool)$rel;
		}
		return false;
	}

	/*
	显示label标签的内容
	 */
	public function attributeLabels(){
		return[
			'adminuser' => 'Name',
			'adminemail' => 'Email',
			'adminpass' => 'passwrod',
			'repass' => 'confirm passwrod'
		];
	}

	/*
	保存注册管理员
	 */
	public function reg($data){
		$this->scenario = 'adminadd';
		if($this->load($data) && $this->validate()){
			$this->adminpass = md5($this->adminpass);
			if($this->save(false)){
				return true;
			}
			return false;
		}
		return false;
	}
	/*
	更改本人邮箱
	 */
	
	public function changeEmail($data){
		$this->scenario = 'changeemail';
		if($this->load($data) && $this->validate()){
			$rel= $this->updateAll(['adminemail'=>$this->adminemail],'adminuser=:user',[':user'=>$this->adminuser]);
			return (bool)$rel;
		}
		return false;
	}

	public static function findIdentity($id){
		return static::findOne($id);
	}
	public static function findIdentityByAccessToken($token, $type = null){

	}

	public function getId(){
		return $this->adminid;
	}
	public function getAuthKey(){

	}

	public function validateAuthKey($authKey){

	}
	
}
