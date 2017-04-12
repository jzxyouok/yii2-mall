<?php 
namespace app\modules\controllers;
use app\models\Category;
use app\models\Product;
use yii\web\Controller;
use Yii;
use yii\data\Pagination;
use crazyfd\qiniu\Qiniu;
use app\modules\controllers\CommonController;
class ProductController extends CommonController{
    protected $except=[];
    protected $myAction=[
        'add','upload','products','removepic','edit','del','on','off','position'
    ];
	 public function actionAdd()
    {
        $this->layout = "layout1";
        $model = new Product;
        $cate = new Category;
        $list = $cate->setOption();
        unset($list[0]);
        
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $pics = $this->upload();
            if (!$pics) {
                $model->addError('cover', '封面不能为空');
            } else {
                $post['Product']['cover'] = $pics['cover'];
                $post['Product']['pics'] = $pics['pics'];
                $post['Product']['createtime'] = time();
            }
            if ($pics && $model->add($post)) {
                Yii::$app->session->setFlash('info', '添加成功');
            } else {
                Yii::$app->session->setFlash('info', '添加失败');
            }

        }

        return $this->render("add", ['opts' => $list, 'model' => $model]);
    }

	private function upload()
    {
        if ($_FILES['Product']['error']['cover'] > 0) {
            return false;
        }
        $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $key = uniqid();
        $qiniu->uploadFile($_FILES['Product']['tmp_name']['cover'], $key);
        $cover = $qiniu->getLink($key);
        $pics = [];
        foreach ($_FILES['Product']['tmp_name']['pics'] as $k => $file) {
            if ($_FILES['Product']['error']['pics'][$k] > 0) {
                continue;
            }
            $key = uniqid();
            $qiniu->uploadFile($file, $key);
            $pics[$key] = $qiniu->getLink($key);
        }
        return ['cover' => $cover, 'pics' => json_encode($pics)];
    }

    public function actionProducts(){
        $this->layout = 'layout1';
        $cateid = Yii::$app->request->get('cateid');
        $model = new Product;
        if(!empty($cateid)){
            $count = $model->find()->where(['cateid'=>$cateid])->count();
        }else{
            $count = $model->find()->count();
        }
        $pageSize = Yii::$app->params['pageSize']['product'];
        $pager = new Pagination(['totalCount'=>$count,'pageSize'=>$pageSize]);
        if(!empty($cateid)){
            $products = $model->find()->where(['cateid'=>$cateid])->offset($pager->offset)->limit($pager->limit)->all();
        }else{
            $products = $model->find()->offset($pager->offset)->limit($pager->limit)->all();
        }
        return $this->render('products',['products'=>$products,'pager'=>$pager]);
    }

    /*
    编辑商品
     */
    
    public function actionEdit(){
        $this->layout = "layout1";
        $cate = new Category;
        $list = $cate->setOption();
        unset($list[0]);
        $productid = Yii::$app->request->get("productid");
        $model = Product::find()->where('productid = :id', [':id' => $productid])->one();
        if (Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
            $post['Product']['cover'] = $model->cover;
            if ($_FILES['Product']['error']['cover'] == 0) {
                $key = uniqid();
                $qiniu->uploadFile($_FILES['Product']['tmp_name']['cover'], $key);
                $post['Product']['cover'] = $qiniu->getLink($key);
                $qiniu->delete(basename($model->cover));

            }
            $pics = [];
            foreach($_FILES['Product']['tmp_name']['pics'] as $k => $file) {
                if ($_FILES['Product']['error']['pics'][$k] > 0) {
                    continue;

                }
                $key = uniqid();
                $qiniu->uploadfile($file, $key);
                $pics[$key] = $qiniu->getlink($key);

            }
            $post['Product']['pics'] = json_encode(array_merge((array)json_decode($model->pics, true), $pics));
            if ($model->add($post)) {
                Yii::$app->session->setFlash('info', '修改成功');

            }

        }
        return $this->render('add', ['model' => $model, 'opts' => $list]);

    }

     public function actionRemovepic()
    {
        $this->layout = false;
        $key = Yii::$app->request->get("key");
        $productid = Yii::$app->request->get("productid");
        $model = Product::find()->where('productid = :pid', [':pid' => $productid])->one();
        $qiniu = new Qiniu(Product::AK, Product::SK, Product::DOMAIN, Product::BUCKET);
        $qiniu->delete($key);
        $pics = json_decode($model->pics, true);
        unset($pics[$key]);
        Product::updateAll(['pics' => json_encode($pics)], 'productid = :pid', [':pid' => $productid]);
        return $this->redirect(['product/edit', 'productid' => $productid]);
    }

    public function actionDel(){
        $productid = Yii::$app->request->get("productid");
        $model = Product::find()->where('productid=:pid',[':pid'=>$productid])->one();
        $key = basename($model->cover);
        $qiniu = new  Qiniu(Product::AK,Product::SK,Product::DOMAIN,Product::BUCKET);
        $qiniu->delete($key);
        $pics = json_decode($model->pics);
        foreach ($pics as $key => $value) {
            $qiniu->delete($key);
        }
        Product::deleteAll('productid=:pid',[':pid'=>$productid]);
        return $this->redirect(['product/products']);
    }

    public function actionOn(){
        $productid = Yii::$app->request->get("productid");
        $url = $_SERVER['HTTP_REFERER'];
        $rel = Product::updateAll(['ison'=>1],'productid=:pid',[':pid'=>$productid]);
        if(empty($rel)){
            Yii::$app->session->setFlash('info','更新失败');
        }else{
            Yii::$app->session->setFlash('info','更新成功');
        }

        return $this->redirect($url);
    }

    public function actionOff(){
        $productid = Yii::$app->request->get("productid");
        $url = $_SERVER['HTTP_REFERER'];
        $rel = Product::updateAll(['ison'=>0],'productid=:pid',[':pid'=>$productid]);
        if(empty($rel)){
            Yii::$app->session->setFlash('info','更新失败');
        }else{
            Yii::$app->session->setFlash('info','更新成功');
        }

        return $this->redirect($url);
    }
	
    public function actionPosition(){
        $this->layout = 'layout1';
        if(Yii::$app->request->isPost){
            $post = Yii::$app->request->Post();
            $productid = $post['Product']['productid'];
            $product = Product::find()->select(['productid','position'])->where('productid=:pid',[':pid'=>$productid])->one();
            $product->position = $post['Product']['position'];
            if($product->save()){
                Yii::$app->session->setFlash('info','修改成功');
            }else{
                Yii::$app->session->setFlash('info','修改失败');
            }

        }else{
            $productid = Yii::$app->request->get('productid');
            $product = Product::find()->select(['productid','position'])->where('productid=:pid',[':pid'=>$productid])->one();
        }
        
        $position = Yii::$app->params['position'];
        
        return $this->render('position',['position'=>$position,'productid'=>$productid,'product'=>$product]);
    }
	
	
}