<?php 
namespace app\controllers;
use yii\web\Controller;
use app\models\Product;
class IndexController extends CommonController{
	public function actionIndex(){
		// $this->layout = false;
		// return $this->render("index");
		$this->layout = 'layout1';
		$model = new Product;
		$position = array();
		$position['topPos'] = $model->find()->select(['productid','cover'])->where('issale="1" and position="1" ')->asArray()->all();
		$position['tui'] = $model->find()->select(['productid','cover','title','price','saleprice','ishot','issale','istui'])->where('ison="1" and istui="1" ')->limit(4)->asArray()->all();

		$position['new'] = $model->find()->select(['productid','cover','title','price','saleprice','ishot','issale','istui'])->where('ison="1" ')->limit(4)->orderby('createtime desc')->asArray()->all();
		$position['hot'] = $model->find()->select(['productid','cover','title','price','saleprice','ishot','issale','istui'])->where('ison="1" ')->limit(4)->orderby('salenum desc')->asArray()->all();
		return $this->render("index",['position'=>$position]);
	}
}

