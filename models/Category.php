<?php 
namespace app\models;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use Yii;
class Category extends ActiveRecord{
	public static function tableName(){
		return "{{%category}}";
	}

	public function rules(){
		return [
			['title','required','message'=>'分类名称不能为空','on'=>['addcate']],
			['parentid','required','message'=>'上级分类不能为空','on'=>['addcate']],
			['createtime','safe','on'=>['addcate']],
		];
	}

	public function attributeLabels(){
		return [
			'title'=>'分类名称',
			'parentid'=>'上级分类'
		];
	}

	public function add($data){
		$this->scenario = 'addcate';
		$data['Category']['createtime'] = time();
		if($this->load($data) && $this->save()){
			return true;
		}
		return false;
	}

	/*
	获取所有数据商品
	 */
	
	public function getAllData(){
		$cates = $this->find()->all();
		return ArrayHelper::toArray($cates);
	}

	public function getCateTree($cates,$pid=0){
		$task = array($pid);
		$tree = array();
		while (!empty($task)) {
			$flog = false;
			foreach ($cates as $key => $cate) {
				if($cate['parentid']==$pid){

					$tree[] = $cate;
					array_push($task, $cate['cateid']);
					$pid = $cate['cateid'];
					unset($cates[$key]);
					$flog = true;
				}
			}
			if($flog==false){
				array_pop($task);
				$pid = end($task);
			}
		}
		return $tree;
	}
	public function setProfix($data,$p='|---'){
		$tree=[];
		$num = 1;
		$prefix = [0=>1];
		while ($val = current($data)) {
			$key = key($data);
			if($key>0){
				if($data[$key-1]['parentid']!=$val['parentid']){
					$num ++;
				}
			}
			if(array_key_exists($val['parentid'],$prefix)){
				$num = $prefix[$val['parentid']];
			}
			$val['title'] = str_repeat($p,$num).$val['title'];
			$prefix[$val['parentid']] = $num;
			$tree[] = $val;
			next($data);
		}
		return $tree;
	}

	public function setOption(){
		$data = $this->getAllData();
		$tree = $this->getCateTree($data);
		$profix = $this->setProfix($tree);
		$option[0] = '添加顶级分类';
		foreach ($profix as $key => $value) {
			$option[$value['cateid']] = $value['title'];
		}
		return $option;
	}

	public function getDateByPage($offset,$pageSize){
		$rel = $this->find()->offset($offset)->limit($pageSize)->all();
		return $rel;
	}

	public function getTreeList($offset,$pageSize){
		$data = $this->getDateByPage($offset,$pageSize);
		$tree = $this->getCateTree($data);
		return $this->setProfix($tree);
	}

	/*
	获取总条数
	 */
	
	public function getCount(){
		return $this->find()->count();
	}
	/* 
	获取分类
	 */
	
	public static function getMenu(){
		$pid = 0;
		$top = self::find()->where('parentid=:pid',[':pid'=>$pid])->asArray()->all();
		$data = [];
		foreach ((array)$top as $key => $cate) {
			$cate['children'] = self::find()->where("parentid=:pid",[':pid'=>$cate['cateid']])->all();
			$data[$key] = $cate;
		}
		return $data;
	}

}