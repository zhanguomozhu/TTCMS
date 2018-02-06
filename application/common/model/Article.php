<?php 
namespace app\common\model;
use app\base\model\Base;

class Article extends Base
{
	//一对一关联栏目表
	public function category(){
		return $this->belongsTo('Category');
	}



	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit(){
		$data = input('post.');
		//创建时间
		$data['create_time'] = $data['create_time'] ?  strtotime($data['create_time']) : time();
		//修改时间
		$data['update_time'] = time();
		//发布人
        if(!$data['author']){
        	$data['author'] = session('admin_info.username');
        }
		//摘要
		if(empty($data['description'])){
				$data['description'] = mb_substr(strip_tags($data['content']), 0,250,'utf-8');
			}
		//链接
		if(!trim($data['url'])){
			unset($data['url']);
		}
		//是否推荐
        if(!isset($data['is_recommend'])){
        	$data['is_recommend'] = 0;
        }
        //是否置顶
        if(!isset($data['is_top'])){
        	$data['is_top'] = 0;
        }
        //验证
		$this->validataCheck('Article',$data,'edit');
		return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}


	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function add(){
		$data = input('post.');
		//创建时间
		$data['create_time'] = $data['create_time'] ?  strtotime($data['create_time']) : time();
		//发布人
		$data['author'] = session('admin_info.username');
		//摘要
		if(empty($data['description'])){
				$data['description'] = mb_substr(strip_tags($data['content']), 0,250,'utf-8');
			}
		//链接
		if(!trim($data['url'])){
			unset($data['url']);
		}
		//是否推荐
        if(!isset($data['is_recommend'])){
        	$data['is_recommend'] = 0;
        }
        //是否置顶
        if(!isset($data['is_top'])){
        	$data['is_top'] = 0;
        }
        //验证
		$this->validataCheck('Article',$data,'add');

		return $this->allowField(true)->save($data);
	}


	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del(){
		$id = input('id');
        //删除图片
        $img = $this->find($id);
        if(@unlink($img['image_url'])){
        	$this->destroy($id);
            return true;
        }else{
            return false;
        }
	}

}