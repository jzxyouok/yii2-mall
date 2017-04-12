<?php  
namespace app\controllers;
use yii\web\Controller;
use app\models\User;
use app\models\Cart;
use app\models\Product;
use Yii;
class CartController extends CommonController{
	protected $except=['*'];
	public function actionIndex(){

		$this->layout = 'layout1';
		$session = Yii::$app->session;
		if($session['isUsername']){
				$where = 'username=:user';
		}else{
			$where = 'useremail=:user';
		}
		$userid = User::find()->where($where,[':user'=>$session['user']['user']])->one()['userid'];
		$carts = Cart::find()->where('userid=:uid',[':uid'=>$userid])->asArray()->all();
		$data = array();
		if(!empty($carts)){
			foreach ($carts as $k => $v) {
				$product = Product::find()->where('productid=:pid',[':pid'=>$v['productid']])->one();
				$data[$k]['cover'] = $product['cover'];
				$data[$k]['title'] = $product['title'];
				$data[$k]['productnum'] = $v['productnum'];
				$data[$k]['price'] = $product['saleprice'];
				$data[$k]['cartid'] = $v['cartid'];
				$data[$k]['productid'] = $product['productid'];
			}
		}
		$model = new Cart();
		return $this->render('index',['data'=>$data,'model'=>$model]);
	}
	/*
	加入购物车
	 */
	public function actionAdd(){
		
		
		$session = Yii::$app->session;
		$data = array();
		if($session['isUsername']){
				$where = 'username=:user';
		}else{
			$where = 'useremail=:user';
		}
		$userid = User::find()->where($where,[':user'=>$session['user']['user']])->one()['userid'];
		if(Yii::$app->request->isPost){
			$data = Yii::$app->request->Post();
		}else{
			$data['Cart']['productid']=Yii::$app->request->get('productid');
			$data['Cart']['productnum']=1;
		}
		$model = Cart::find()->where('userid=:uid and productid=:pid',[':uid'=>$userid,':pid'=>$data['Cart']['productid']])->one();
		if(!$model){
			$model = new Cart();
		}else{
			$data['Cart']['productnum']+= $model->productnum;
		}
		$data['Cart']['userid'] = $userid;
		$data['Cart']['createtime'] = time();
		$model->load($data);
		$model->save();
		
		return $this->redirect(['cart/index']);
	}
	/*
	修改数目
	 */
	
	public function actionEditnum(){
		$post = Yii::$app->request->Post();
		$rel = Cart::updateAll(['productnum'=>$post['productnum']],'cartid=:cid',[':cid'=>$post['cartid']]);
		if($rel){
			echo 1;
		}else{
			echo 0;
		}
	}
	/*
	删除
	 */
	
	public function actionDel(){
		$cartid = Yii::$app->request->Post()['cartid'];
		$rel = Cart::deleteAll('cartid=:cid',[':cid'=>$cartid]);

		if($rel){
			echo 1;
		}else{
			echo 0;
		}
		
	}
}
