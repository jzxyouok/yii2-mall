<?php 
namespace app\modules\controllers;
use yii\web\Controller;
use app\modules\models\Admin;
use yii\data\Pagination;
use Yii;
use app\modules\controllers\CommonController;
class ManageController extends CommonController{
	/*
	通过邮件找回密码
	 */
	protected $except=[];
	/*protected $myAction=[
		'mailchangepass','managers','reg','del','changeemail','changepass'
	];*/
	public function actionMailchangepass(){
		$admin = new Admin;
		$time = Yii::$app->request->get('timestamp');
		$token = Yii::$app->request->get('token');
		$adminuser = Yii::$app->request->get('adminuser');
		$myToken = $admin->createToken($adminuser,$time);
		if($myToken!==$token){
			$this->redirect(['public/login']);
			Yii::$app->end();
		}
		if(time()-$time>=300){
			$this->redirect(['public/login']);
			Yii::$app->end();
		}
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			if($admin->changepass($post)){
				Yii::$app->session->setFlash('info','密码修改成功');
			}else{
				Yii::$app->session->setFlash('info','密码修改失败');
			}

		}
		$this->layout = false;
		$admin->adminuser = $adminuser;
		return $this->render('mailchangepass',['model'=>$admin]);
	}

	public function actionManagers(){
		$this->layout = 'layout1';
		$model = Admin::find();
		$count = $model->count();
		$pageSize = Yii::$app->params['pageSize']['manage'];
		$pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
		$managers = $model->offset($pager->offset)->limit($pager->limit)->all();
		return $this->render('managers',['managers'=>$managers,'pager'=>$pager]);
	}

	/*
	添加管理员
	 */
	
	public function actionReg(){
		$this->layout = 'layout1';
		$model = new Admin;
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			$post['Admin']['createtime'] = time();
			if($model->reg($post)){
				Yii::$app->session->setFlash('info','add success');
			}else{
				Yii::$app->session->setFlash('info','add fail');
			}

		}
		$model->adminpass = '';
		$model->repass = '';
		return $this->render('reg',['model'=>$model]);
	}
	/*
	删除管理员
	 */
	public function actionDel(){
		$model = new Admin;
		$get = Yii::$app->request->get();
		if(empty($get)){
			$this->redirect(['manage/managers']);
		}
		if($model->deleteAll('adminid =:id',[':id'=>$get['adminid']])){
			Yii::$app->session->setFlash('info','删除成功');
			$this->redirect(['manage/managers']);
		}else{
			Yii::$app->session->setFlash('info','删除失败');
			$this->redirect(['manage/managers']);
		}
		
	}
	/*
	修改email
	 */
	
	public function actionChangeemail(){
		$model = Admin::find()->where('adminuser=:user',[':user'=>Yii::$app->session['admin']['adminuser']])->one();
		$this->layout = 'layout1';
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			if($model->changeEmail($post)){
				Yii::$app->session->setFlash('info','修改成功');
			}else{
				Yii::$app->session->setFlash('info','修改失败');
			}
		}
		$model->adminpass = '';
		return $this->render('changeemail',['model'=>$model]);
	}

	public function actionChangepass(){
		$this->layout = 'layout1';
		$model = Admin::find()->where('adminuser=:user',[':user'=>Yii::$app->session['admin']['adminuser']])->one();
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			if($model->changepass($post)){
				Yii::$app->session->setFlash('info','修改成功');
			}else{
				Yii::$app->session->setFlash('info','修改失败');
			}
		}
		$model->adminpass = '';
		return $this->render('changepass',['model'=>$model]);
	}
}