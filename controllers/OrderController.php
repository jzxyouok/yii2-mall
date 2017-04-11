<?php 
namespace app\controllers;
use yii\web\Controller;
use app\models\Order;
use app\models\User;
use app\models\Product;
use app\models\OrderDetail;
use app\models\Cart;
use app\models\Address;
use app\models\Pay;
use \dzer\express\Express;
use Yii;
class OrderController extends CommonController{
	public function actionAdd(){
		if(Yii::$app->session['user']['isLogin']!=1){
			return $this->redirect(['member/auth']);
		}
		if(Yii::$app->session['isUsername']==1){
			$where = 'username=:user';
		}else{
			$where = 'useremail=:user';
		}
		$this->layout = 'layout1';
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			$transaction = Yii::$app->db->beginTransaction();
			try {
				$ordermodel = new Order;
				$usermodel = User::find()->where($where,[':user'=>Yii::$app->session['user']['user']])->one();
				if(empty($usermodel)){
					throw new \Exception();
				}
				$ordermodel->userid = $usermodel->userid;
				$ordermodel->createtime = time();
				$ordermodel->status = Order::CREATEORDER;
				if(!$ordermodel->save()){
					throw new \Exception();
				}
				$orderid = $ordermodel->getPrimaryKey();
				$totalprice = 0;
				foreach ($post['orderDetail'] as $k => $product) {
					$model = new OrderDetail;
					$product['orderid'] = $orderid;
					$product['createtime'] = time();
					$data['OrderDetail'] = $product;
					if(!$model->add($data)){
						throw new \Exception();
					}
					Cart::deleteAll('productid=:pid and userid=:uid',[':pid'=>$product['productid'],':uid'=>$usermodel->userid]);
					Product::updateAllCounters(['num'=>-$product['productnum']],'productid=:pid',[':pid'=>$product['productid']]);
					$totalprice+= Product::find()->where('productid=:pid',[':pid'=>$product['productid']])->one()['saleprice'] * $product['productnum'];
				}
				$ordermodel = Order::findOne($orderid);
				$ordermodel->amount = $totalprice;
				if(!$ordermodel->save()){
					throw new \Exception();
				}
				$transaction->commit();
			} catch (\Exception $e) {
				$transaction->rollback();
				return $this->redirect(['cart/index']);
			}
			return $this->redirect(['order/check','orderid'=>$orderid]);
		}
	}

	public function actionCheck(){
		$this->layout = 'layout1';
		if(Yii::$app->session['user']['isLogin']!=1){
			return $this->redirect(['member/auth']);
		}
		$orderid = Yii::$app->request->get('orderid');
		$user = Yii::$app->session['user'];
		$usermodel = User::find()->where('username=:user or useremail=:email',[':user'=>$user['user'],':email'=>$user['user']])->one();
		/*if(empty($orderid)){
			$usermodel = User::find()->where('username=:user or useremail=:email',[':user'=>$user['user'],':email'=>$user['user']])->one();
			if(empty($usermodel)){
				return $this->redirect(['member/auth']);
			}
			$ordermodel = Order::find()->where('userid=:uid',[':uid'=>$usermodel->userid])->one();
			$orderid = $ordermodel->orderid;
		}
*/
		if(empty($orderid)){
			return $this->redirect(['cart/index']);
		}
		$ordermodel = Order::find()->where('userid=:uid and status=:s',[':uid'=>$usermodel->userid,':s'=>Order::CREATEORDER])->one();
		if(empty($ordermodel)){
			return $this->redirect(['cart/index']);
		}
		if($ordermodel->status==Order::CHECKORDER){
			if($ordermodel->createtime - time() > 1800){
				$ordermodel->delete();
				return $this->redirect(['cart/index']);
			}
			return $this->redirect(['order/pay','orderid'=>$orders]);
		}
		$orderDetail = OrderDetail::find()->where('orderid=:oid',[':oid'=>$orderid])->asArray()->all();
		$data = [];
		$totalprice = 0;
		foreach ($orderDetail as $k => $v) {
			$product = Product::find()->where('productid=:pid',[':pid'=>$v['productid']])->one();
			$temp = $v;
			$temp['cover'] = $product->cover;
			$temp['title'] = $product->title;
			$data[] = $temp;
			$totalprice+= $v['price']*$v['productnum'];
		}
		$address = Address::find()->where('userid=:uid',[':uid'=>$usermodel->userid])->asArray()->all();
		$express = Yii::$app->params['express'];
		$expressPrice = Yii::$app->params['expressPrice'];
		return $this->render('check',['orders'=>$data,'express'=>$express,'expressPrice'=>$expressPrice,'address'=>$address,'totalprice'=>$totalprice,'orderid'=>$orderid]);
	}

	public function actionIndex(){
		$this->layout='layout1';
		if(Yii::$app->session['user']['isLogin']!=1){
			return $this->redirect(['member/auth']);
		}
		$user = Yii::$app->session['user']['user'];
		$userid = User::find()->where('username=:user or useremail=:email',[':user'=>$user,':email'=>$user])->one()->userid;
		$orders = Order::find()->where('userid=:uid',[':uid'=>$userid])->all();
		$orders = Order::getorders($orders);
		return $this->render('index',['orders'=>$orders]);
	}

	public function actionPay(){
		$orderid = Yii::$app->request->get('orderid');
		$paymethod = Yii::$app->request->get('paymethod');
		try {
			if(empty($orderid) || empty($paymethod)){
				throw new \Exception("参数错误");
			}
			if(Pay::alipay($orderid)){
				$this->redirect(['order/index']);
			}
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
			

	}

	public function actionConfirm(){
		if(Yii::$app->session['user']['isLogin']!=1){
			return $this->redirect(['member/auth']);
		}

		$user = Yii::$app->session['user']['user'];
		$this->layout = 'layout1';
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			var_dump($post);
			try {
				
				$ordermodel = Order::find()->where('orderid=:oid',[':oid'=>$post['orderid']])->one();
				if(empty($ordermodel)){
					throw new \Exception();
				}
				$expressprice= Yii::$app->params['expressPrice'][$post['express']];
				if($expressprice<0){
					throw new \Exception();	
				}
				$ordermodel->addressid = $post['addressid'];
				$ordermodel->status = Order::CHECKORDER;
				$ordermodel->expressid = $post['express'];
				$ordermodel->amount+= $expressprice;
				// var_dump($ordermodel->expressid);
				// exit;
				if(!$ordermodel->save()){
					echo 'error';
					exit;
				}
			} catch (\Exception $e) {
				return $this->redirect(['index/index']);
			}
		 	return $this->redirect(['order/pay','orderid'=>$post['orderid'],'paymethod'=>$post['paymethod']]);
		}
	}

	/*
	快递信息查修
	 */
	
	public function actionGetexpress(){
		$expressid = Yii::$app->request->get('expressid');
		$rel = Express::search($expressid);
		echo $rel;
	}

	/*
	确认收货
	 */
	
	public function actionReceived(){
		$orderid = Yii::$app->request->get('orderid');
		$ordermodel = Order::find()->where('orderid=:oid',[':oid'=>$orderid])->one();
		if(!empty($ordermodel)  && $ordermodel->status==Order::SENDED){
			$ordermodel->status = Order::RECEIVED;
			// var_dump(Order::RECEIVED);exit;
			$ordermodel->save();
		}
		return $this->redirect(['order/index']);
	}

}