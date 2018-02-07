<?php 
namespace app\common\model;
use app\base\model\Base;

class Category extends Base
{

	/**
	 * 一对一关联模型表
	 * @return [type] [description]
	 */
	public function model()
    {
        return $this->belongsTo('Model');
    }


	/**
	 * 列表
	 * @return [type] [description]
	 */
	public function getCate(){
		$data = $this->with('model')->order('sort')->select();
		//树状
		$rules = getTree(obj_to_arr($data),0,0,'name');
		return $rules;
	}

	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function add(){
		$data = input('post.');
		//是否导航显示
		if(!isset($data['is_menu'])){
			$data['is_menu'] = 0;
		}
		//是否导航封面
		if(!isset($data['is_cover'])){
			$data['is_cover'] = 0;
		}
		//验证
		$this->validataCheck('Category',$data,'add');
		return $this->allowField(true)->save($data);
	}



	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit(){
		$data = input('post.');
		//是否导航显示
		if(!isset($data['is_menu'])){
			$data['is_menu'] = 0;
		}
		//是否导航封面
		if(!isset($data['is_cover'])){
			$data['is_cover'] = 0;
		}
		//验证
		$this->validataCheck('Category',$data,'edit');
		return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}



	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function del(){
		$id = input('id');
        $category_trans  =  $this;
        $article_trans   =  model('Article');
        
        //获取子栏目
        $list =$this->select();
        $ids = getSons($list,$id,'id');
        $ids[] = (int) $id;

        //开启事务
        $category_trans->startTrans();
        $article_trans->startTrans();



		//删除栏目下的文章
        $articleRes =$article_trans->where('category_id','in',$ids)->delete();

		//用于栏目图片
		$imgs = $category_trans->where('id','in',$ids)->select();
		//删除栏目
        $categoryRes = $category_trans->where('id','in',$ids)->delete();

        //事务回滚
        if(!$categoryRes || !$articleRes){
            $category_trans->rollBack();
            $article_trans->rollBack();
        }
        
        //提交事务
        $category_trans->commit();
        $article_trans->commit();

        if($categoryRes && $articleRes){
        	//删除栏目图片
	        foreach ($imgs as $key => $value) {
	        	@unlink($value['image_url']);
	        }
            return true;
        }else{
            return false;
        }
	}


}