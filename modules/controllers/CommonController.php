<?php 
namespace app\modules\controllers;
use yii\web\Controller;
use Yii;
class CommonController extends Controller{
	protected $except=[];
	protected $myAction=[];
	public function behaviors(){
		return [
			'access'=>[
				'class'=>\yii\filters\AccessControl::className(),
				'only'=>['*'],
				'user'=>'admin',
				'except'=>$this->except,
				'rules'=>[
					[
						'allow'=>false,
						'actions'=>$this->myAction,
						'roles'=>['?'],
					],
					[
						'allow'=>true,
						'actions'=>$this->myAction,
						'roles'=>['@'],
					]
				]
			]
		];
	}
	public function init(){

		/*if(Yii::$app->session['admin']['isLogin']!=1){

			$this->redirect(['/admin/public/login']);
		}*/
	}
}