<?php 
namespace app\models;
use app\models\OrderDetail;
use app\models\Product;
use app\models\Order;
use \AlipayPay;
class Pay{

	public static function alipay($orderid){
		/*$amount = Order::find()->where('orderid=:oid',[':oid'=>$orderid])->one()->amount;
		if(!$amount){
			throw new \Exception("支付失败", 1);
		}
		$alipay = new \AlipayPay();
		$gifname = 'xx商城';
		$products = OrderDetail::find()->where('orderid=:oid',[':oid'=>$orderid])->all();
		$body = '';
		foreach ($products as $k => $v) {
			$body.=Product::find()->where('productid=:pid',[':pid'=>$v['productid']])->one()->title.' - ';
		}
		$body.=' 等商品';
		$url = 'http://shop.mr-jason.com';
		$html = $alipay->requestPay($orderid,$gifname,$amount,$body,$url);
		echo $html;*/
		$rel = Order::updateAll(['status'=>Order::PAYSUCCESS],'orderid=:oid',['oid'=>$orderid]);
		if($rel){
			return true;
		}
		return false;
	}
}