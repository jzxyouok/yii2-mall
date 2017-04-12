<?php  
namespace app\modules\controllers;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Order;
use Yii;
use app\modules\controllers\CommonController;
class OrderController extends CommonController{
	protected $except=[];
	protected $myAction=[
		'orders','detail','send'
	];
	public function actionOrders(){
		$this->layout = 'layout1';
		$count = Order::find()->count();
		$pageSize = Yii::$app->params['pageSize']['order'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$orders = Order::find()->offset($pager->offset)->limit($pager->limit)->all();
		$orders = Order::getorders($orders);
		return $this->render('orders',['pager'=>$pager,'orders'=>$orders]);
	}

	public function actionDetail(){
		$this->layout = 'layout1';
		$orderid = Yii::$app->request->get('orderid');
		$ordermodel = Order::find()->where('orderid=:oid',[':oid'=>$orderid])->one();
		$order = Order::getorder($ordermodel);
		return $this->render('detail',['order'=>$order]);

	}
	/**
	 * 发货操作
	 * @return [type] [description]
	 */
	public function actionSend(){
		$this->layout = 'layout1';
		$orderid = Yii::$app->request->get('orderid');
		$model = Order::find()->where('orderid=:oid',[':oid'=>$orderid])->one();
		$model->scenario = 'send';
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			$model->status = Order::SENDED;
			if($model->load($post) && $model->save()){
				Yii::$app->session->setFlash('info','修改成功');
			}else{
				Yii::$app->session->setFlash('info','修改失败');
			}
		}
		return $this->render('send',['model'=>$model]);
	}

	
}

?>