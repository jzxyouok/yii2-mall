<?php 
namespace app\modules\controllers;
use yii\web\Controller;
use Yii;
class CommonController extends Controller{
	public function init(){
		if(Yii::$app->session['admin']['isLogin']!=1){

			$this->redirect(['/admin/public/login']);
		}
	}
}