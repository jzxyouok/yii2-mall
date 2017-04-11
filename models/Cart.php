<?php 
namespace app\models;
use yii\db\ActiveRecord;
use app\models\Product;
use Yii;
class Cart extends ActiveRecord{
	public static function tableName(){
		return "{{%cart}}";
	} 

	public function rules(){
		return[
			['productnum','integer','min'=>1,'message'=>'商品数量有误'],
			['productid','integer','min'=>0,'message'=>'参数错误'],
			['price','number','min'=>0,'message'=>'价格有误'],
			[['createtime','userid'],'safe']
		];
	}
	public function add($data){
		if($this->load($data) && $this->save()){
			return true;
		}
		return false;
	}

	public function getCarts(){
		$user = Yii::$app->session->get('user');
		$userid = $user['userid'];
		$carts = $this->find()->where(['userid'=>$userid])->all();
		return $carts;
	}

	public function getProduct(){
		return $this->hasOne(Product::className(),['productid'=>'productid']);
	}

	
}