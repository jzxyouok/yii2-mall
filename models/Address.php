<?php 
namespace app\models;
use yii\db\ActiveRecord;
class Address extends ActiveRecord{
	public static function tableName(){
		return "{{%address}}";
	}

	public function rules(){
		return [
			[['firstname','lastname','company','address','telephone','postcode'],'required','message'=>'不能为空'],
			['email','email','message'=>'email格式非法'],
			[['userid','createtime'],'safe']
		];
	}
}