<?php  
namespace app\controllers;
use yii\web\Controller;
use app\models\Product;
use yii\data\Pagination;
use app\models\Cart;
use Yii;
class ProductController extends CommonController{
	protected $except=['*'];
	public $layout = 'layout1';
	public function actionIndex(){
		$this->layout = 'layout1';
		$cid = Yii::$app->request->get('cateid');
		$where = "cateid=:cid and ison = '1'";
		$params = [':cid'=>$cid];
		$model = Product::find()->where($where,$params);
		// $all = $model->asArray()->all();
		$count = $model->count();
		$pageSize = Yii::$app->params['pageSize']['pro_index'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$all = $model->offset($pager->offset)->limit($pager->limit)->asArray()->all();

		$tui = $model->where($where.' and istui = "1"',$params)->orderby('createtime')->asArray()->all();
		$hot = $model->where($where.' and ishot = "1" ',$params)->orderby('createtime')->asArray()->all();
		$sale = $model->where($where.' and issale="1" ',$params)->orderby('createtime')->asArray()->all();
		
		return $this->render("index",['tui'=>$tui,'hot'=>$hot,'sale'=>$sale,'all'=>$all]);
	}

	public function actionDetail(){
		$productid = Yii::$app->request->get('productid');
		$product = Product::find()->where('productid=:pid',[':pid'=>$productid])->one();
		$pics = json_decode($product->pics);
		$cart = new Cart();
		return $this->render("detail",['product'=>$product,'pics'=>$pics,'model'=>$cart]);
	}
}