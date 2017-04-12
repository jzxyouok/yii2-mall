<?php 
namespace app\controllers;
use yii\web\Controller;
use app\models\Category;
use app\models\Cart;
use app\models\User;
use app\models\Product;
use Yii;
class CommonController extends Controller{

	protected $myActions=[];
	protected $except=[];
	protected $verbs=[];
	public function behaviors(){
		return [
			'access'=>[
				'class'=>\yii\filters\AccessControl::className(),
				'only'=>['*'],
				'except'=>$this->except,
				'rules'=>[
					[
						'allow'=>false,
						'actions'=>$this->myActions,
						'roles'=>['?'],
					],
					[
						'allow'=>true,
						'actions'=>$this->myActions,
						'roles'=>['@'],
					]
				]
			],
			'verbs' => [
            'class' => \yii\filters\VerbFilter::className(),
            'actions' =>$this->verbs,
        	],
   		];
	}
	public function init(){
		
		$menu = Category::getMenu();
		$cartmodel = new Cart;
		$carts = $cartmodel->getCarts();
		$this->view->params['menu'] = $menu;
		$this->view->params['carts']=$carts;
	}

	
}