<?php 
namespace app\controllers;
use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Address;
class AddressController extends Controller{
	public function actionAdd(){
		$user = Yii::$app->session['user'];
		if($user['isLogin']!=1){
			$this->redirect(['member/auth']);
		}
		$this->layout = 'layout1';
		if(Yii::$app->request->isPost){
			$userid = User::find()->where('username=:user or useremail=:email',[':user'=>$user['user'],':email'=>$user['user']])->one()->userid;
			$post = Yii::$app->request->Post();
			$post['Address']['address'] = $post['address1'].$post['address2'];
			$post['Address']['createtime'] = time();
			$post['Address']['userid'] = $userid;
			$model = new Address;
			if($model->load($post) && $model->save()){
				Yii::$app->session->setFlash('info','添加成功');
			}else{
				Yii::$app->session->setFlash('info','添加失败');
			}
			
		}
		return $this->redirect($_SERVER['HTTP_REFERER']);
	}

	public function actionDel(){
		$addressid = Yii::$app->request->get('addressid');
		$rel = Address::deleteAll('addressid=:id',[':id'=>$addressid]);
		if(empty($rel)){
			Yii::$app->session->setFlash('info','删除成功');
		}else{
			Yii::$app->session->setFlash('info','删除失败');
		}
		return $this->redirect($_SERVER['HTTP_REFERER']);
	}
}