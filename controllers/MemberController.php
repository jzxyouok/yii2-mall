<?php  
namespace app\controllers;
use yii\web\Controller;
use app\models\User;
use Yii;
class MemberController extends CommonController{
	public function actionAuth(){
		$this->layout = 'layout1';
		$model = new User;
		if(Yii::$app->request->isPost){

			$post = Yii::$app->request->Post();
			if($model->login($post)){
				Yii::$app->session->setFlash('info','登录成功');
			}else{
				Yii::$app->session->setFlash('info','登录失败');
			}
		}
		return $this->render('auth',['model'=>$model]);
	}

	public function actionReg(){
		$this->layout = 'layout1';
		$model = new User;
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			if($model->regByemail($post)){
				Yii::$app->session->setFlash('reg','注册成功');
			}else{
				Yii::$app->session->setFlash('reg','注册失败');
			}
		}
		return $this->render('auth',['model'=>$model]);
	}
	/*
	退出
	 */
	
	public function actionLogout(){
		$this->layout = 'layout1';
		$model = new User;
		Yii::$app->session->remove('user');
		return $this->render('auth',['model'=>$model]);

	}
	/*
	找回密码
	 */
	public function actionSeekpass(){
		$this->layout = false;
		$model = new User;
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			if($model->changepass($post)){

			}
		}
		return $this->render('seekpass',['model'=>$model]);
	}
	/*
	修改密码
	 */
	public function actionMailchangepass(){
		$this->layout = false;
		$model = new User;
		$get = Yii::$app->request->get();
		$time = $get['timestamp'];
		$token = $get['token'];
		$username = $get['username'];
	 	$myToken = $model->createToken($username,$time);
	 	if($myToken!==$token){
	 		echo "token认证错误";
	 		Yii::$app->end();
	 	}
	 	/*if(time()-$time>300){
	 		echo "链接已失效";
	 		Yii::$app->end();
	 	}*/
	 	if(Yii::$app->request->isPost){
	 		$post = Yii::$app->request->Post();
	 		if($model->updatepassByName($post)){
	 			Yii::$app->session->setFlash('info','修改成功');
	 		}else{
	 			Yii::$app->session->setFlash('info','修改失败');
	 		}
	 	}
	 	$model->username = $username;
	 	return $this->render('mailchangepass',['model'=>$model]);
	}

	public function actionQqlogin(){
		require_once('../vendor/qqlogin/qqConnectAPI.php');
		$qq = new \QC();
		$qq->qq_login();
	}

	public function actionQqcallback(){
		require_once('../vendor/qqlogin/qqConnectAPI.php');
		$oatth = new \Oauth;
		$token = $oatth->qq_callback();
		$openid = $oatth->get_openid();
		$qc = new \QC($token,$openid);
		$userInfo = $qc->get_user_info();
		$session = Yii::$app->session;
		$session['userInfo'] = $userInfo;
		$session['openid'] = $openid;
		if(User::find()->where('openid = :openid',[':openid'=>$openid])->one()){
			$session['user'] = [
				'user'=>$userInfo['nickname'],
				'isLogin' => 1
			];
			return $this->redirect(['index/index']);
		}else{
			return $this->redirect(['member/qqreg']);
		}

	}

	public function actionQqreg(){
		$this->layout = 'layout2';
		$model = new User;
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			$session = Yii::$app->session;
			$post['User']['openid'] = $session['openid'];
			if($model->reg($post,'reg')){
				$session['user'] = array(
					'user'=>$session['userInfo']['nickname'],
					'isLogin'=>1
				);
				$this->redirect(['index/index']);
			}else{
				Yii::$app->session->setFlash('info','注册失败');
			}
		}
		$model->userpass = '';
		$model->repass = '';
		return $this->render('qqreg',['model'=>$model]);
	}
}