<?php 
namespace app\models;
use yii\db\ActiveRecord;
use app\models\User;
use app\models\Product;
use app\models\Address;
use app\models\OrderDetail;
use app\models\Category;
use Yii;
class Order extends ActiveRecord{
	public $username;
	public $address;
	public $products;
	public $stat;
	const CREATEORDER = 0;
	const CHECKORDER = 100;
	const PAYFAILED = 201;
	const PAYSUCCESS = 202;
	const SENDED = 220;
	const RECEIVED = 255;
	public static $status = [
		self::CREATEORDER => '订单初始化',
		self::CHECKORDER => '待支付',
		self::PAYFAILED => '支付失败',
		self::PAYSUCCESS => '等待发货',
		self::SENDED => '已发货',
		self::RECEIVED => '订单完成'
	];
	public static function tableName(){
		return "{{%order}}";
	}

	public function rules(){
		return [
			['expressno','required','message'=>'订单号不能为空','on'=>['send']],
			['status','safe'],
		];
	}

	public function attributeLabels(){
		return [
			'expressno'=>'订单号',
		];
	}


	public static function getorders($orders){
		foreach ($orders as $k => $order) {
			$order = self::getorder($order);
		}
		return $orders;
	}

	public static function getorder($order){
		$order->username = User::find()->where('userid=:uid',[':uid'=>$order->userid])->one()->username;
		$order->address = Address::find()->where('addressid=:aid',[':aid'=>$order->addressid])->one()->address;
		$order->stat = self::$status[$order->status];
		$details = OrderDetail::find()->where('orderid=:oid',[':oid'=>$order->orderid])->all();
		$products = array();
		foreach ($details as $k => $detail) {
			$productmodel = Product::find()->where('productid=:pid',[':pid'=>$detail->productid])->one();
			$product['title'] = $productmodel->title;
			$product['num'] = $detail->productnum;
			$product['productid'] = $detail->productid;
			$product['cover'] = $productmodel->cover;
			$product['price'] = $productmodel->price;
			$product['saleprice'] = $productmodel->saleprice;
			$product['catename'] = Category::find()->select(['title'])->where('cateid=:cid',[':cid'=>$productmodel->cateid])->one()->title;
			$products[] = $product;
		}
		$order->products = $products;
		return $order;
	}

	
	


}