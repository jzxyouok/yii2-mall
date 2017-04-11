<?php 
namespace app\modules\controllers;
use app\modules\controllers\CommonController;
use app\models\Category;
use yii\web\Controller;
use yii\data\Pagination;
use Yii;
class CategoryController extends CommonController{
	public function actionList(){
		$this->layout = 'layout1';
		$model = new Category;
		$cateid = Yii::$app->request->get('cateid');
		if(empty($cateid)){
			$cateid=0;
		}
		$cates = Category::find()->where('parentid=:pid',[':pid'=>$cateid])->asArray()->all();
		foreach ($cates as $key => $cate) {
			$rel = Category::find()->where(['cateid'])->where('parentid=:pid',[':pid'=>$cate['cateid']])->asArray()->all();
			if(empty($rel)){
				$cates[$key]['hasChild'] = 0;
			}else{
				$cates[$key]['hasChild'] = 1;
			}
		}
		return $this->render('list',['cates'=>$cates]);
	}
	public function actionAdd(){
		$this->layout = 'layout1';
		$model = new Category;
		$list = $model->setOption();
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			if($model->add($post)){
				Yii::$app->session->setFlash('info','添加成功');
			}else{
				Yii::$app->session->setFlash('info','添加失败');
			}
		}
		return $this->render('add',['model'=>$model,'list'=>$list]);
	}

	public function actionDel(){
		$cateid = Yii::$app->request->get('cateid');
		$model = new Category;
		try {
			if(empty($cateid)){
				throw new \Exception("参数有误");
			}
			$rel = $model->find()->where('parentid=:pid',[':pid'=>$cateid])->one();
			if($rel){
				throw new \Exception("该分类下有子类");
			}
			$rel = $model->deleteAll('cateid=:cid',[':cid'=>$cateid]);
			if(!$rel){
				throw new \Exception("删除失败");
			}
			Yii::$app->session->setFlash('info','删除成功');

		} catch (\Exception $e) {
			Yii::$app->session->setFlash('info',$e->getMessage());
		}
		return $this->redirect(['category/list']);
	}

	/*
	修改商品
	 */
	
	public function actionEdit(){
		$this->layout = 'layout1';
		$cateid = Yii::$app->request->get('cateid');
		$model = Category::find()->where('cateid=:id',[':id'=>$cateid])->one();
		if(Yii::$app->request->isPost){
			$post = Yii::$app->request->Post();
			if($model->load($post)){
				$model->title = $post['Category']['title'];
				$model->parentid = $post['Category']['parentid'];
				if($model->save()){
					Yii::$app->session->setFlash('info','修改成功');
				}
				
			}else{
				Yii::$app->session->setFlash('info','修改失败');
			}
		}
		
		
		$list = $model->setOption();
		return $this->render('edit',['model'=>$model,'list'=>$list]);
	}
}