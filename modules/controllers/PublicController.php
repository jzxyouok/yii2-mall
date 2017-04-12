<?php 
namespace app\modules\controllers;
use yii\web\Controller;
use app\modules\models\Admin;
use Yii;
class PublicController extends Controller{
	public function actionLogin(){
		$this->layout = false;
		$model = new Admin;
		if($model->isLogin()){
			$this->redirect(['default/index']);
			Yii::$app->end();
		}

		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			if($model->login($post)){
				$this->redirect(['default/index']);
				Yii::$app->end();
			}
		}
		return $this->render('login',['model'=>$model]);
	}

	public function actionLogout(){
		Yii::$app->admin->logout(false);
		/*Yii::$app->session->removeAll();
		if(!isset(Yii::$app->session['adminuser']['isLogin'])){
			$this->redirect(['public/login']); 
		}*/
		$this->redirect(['public/login']);
	}

	public function actionSeekpassword(){
		$admin = new Admin;
		$this->layout = false;
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			if($admin->seekPass($post)){
				Yii::$app->session->setFlash('info', '电子邮件已经发送成功，请查收');
			}
		}
		return $this->render('seekpassword',['model'=>$admin]);
	}
}