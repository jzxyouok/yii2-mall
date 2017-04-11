<?php 
namespace app\modules\controllers;
use yii\web\Controller;
use app\modules\models\User;
use app\models\Profile;
use yii\data\Pagination;
use Yii;
use app\modules\controllers\CommonController;
class UserController extends CommonController{
	public function actionUsers(){
		$this->layout = 'layout1';
		$model = User::find()->joinWith('profile');
		$count = $model->count();
		$pageSize = Yii::$app->params['pageSize']['user'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$users = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('users',['users'=>$users,'pager'=>$pager]);
	}

	public function actionReg(){
		$this->layout = 'layout1';
		$model = new User;
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			if($model->addUser($post)){
				Yii::$app->session->setFlash('info','添加用户成功');
			}else{
				Yii::$app->session->setFlash('info','添加用户失败');
			}
		}
		return $this->render('reg',['model'=>$model]);
	}

	/*
	删除用户
	 */
	
	public function actionDel(){
		$id = (int)Yii::$app->request->get();
		if(empty($id)){
			$this->redirect(['user/users']);
		}
		try {
			$trans = Yii::$app->db->beginTransaction();
			if(Profile::find()->where('userid=:user',[':user'=>$id])->one()){
				$rel = Profile::deleteAll('userid=:user',[':user'=>$id]);
				if(empty($rel)){
					throw new \Exception();
				}
			}
			if(!User::deleteAll('userid=:user',[':user'=>$id])){
					throw new \Exception();
			}
			$trans->commit();
			Yii::$app->session->setFlash('info','删除成功');
			$this->redirect(['user/users']);
		} catch (\Exception $e) {
			Yii::$app->session->setFlash('info',$e->getMessage());
			$this->redirect(['user/users']);
		}
	}
}