<?php 
namespace app\modules\models;
use yii\db\ActiveRecord;
use app\models\Profile;
class User extends ActiveRecord{
	public $repass;
	public static function tableName(){
		return "{{%user}}";
	}

	public function rules(){
		return[
			['username','required','message'=>'用户名不能为空','on'=>['adduser']],
			['username','unique','message'=>'该用户名已被注册','on'=>['adduser']],
			['userpass','required','message'=>'密码不能为空','on'=>['adduser']],
			['useremail','required','message'=>'邮箱不能为空','on'=>['adduser']],
			['useremail','unique','message'=>'邮箱已被注册'],
			['useremail','email','message'=>'邮箱格式非法'],
			['repass','required','message'=>'密码不能为空','on'=>['adduser']],
			['repass','compare','compareAttribute'=>'userpass','message'=>'密码与确认密码不一致','on'=>'adduser']
		];
	}

	public function attributeLabels(){
		return [
			'username' =>'用户名',
			'userpass' => '用户密码',
			'useremail' => '用户邮箱',
			'repass' => '确认密码'
		];
	}
	public function addUser($data){
		$this->scenario = 'adduser';
		if($this->load($data) && $this->validate()){
			if($this->save(false)){
				return true;
			}
			return false;
		}
	}
	/*
	关联 profile表
	 */
	public function getProfile(){
		return $this->hasOne(Profile::className(),['userid'=>'userid']);
	}
}