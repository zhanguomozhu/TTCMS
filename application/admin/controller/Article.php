<?php 
namespace app\admin\controller;
use app\common\controller\Base;

class Article extends Base
{

	/**
	 * 列表
	 * @return [type] [description]
	 */
	public function lst()
	{

		//列表
		$articles = $this->model->with('category')->order('sort')->paginate('',false,['query' => request()->param()]);

		//如果从栏目页条转过来
		$category_id = input('category_id') ? input('category_id') : '';
		if($category_id){
			//获取模型
			$model = model('Category')->getModelByCategoryId($category_id);
			$model_name = ucfirst($model['tablename']);
			//获取下级栏目的文章
			$data  = model('Category')->select();
			$ids   = getSons($data,$category_id,'id');
			$ids[] = (int) $category_id;
			//获取文章列表
			$articles = model($model_name)->with('category')->where('category_id','in',$ids)->order('sort')->paginate('',false,['query' => request()->param()]);
		}
		
		return $this->fetch('',['articles'=>$articles,'model_id'=>isset($model['id'])?$model['id']:2]);
	}


	/**
	 * 添加
	 */
	public function add()
	{
		if(request()->isPost()){
			if(request()->isAjax() && !empty($_FILES)){
				$this->douploadimg();
				return;
			}else{
				if($this->model->add()){
					$this->success('添加成功',url('lst',['category_id'=>input('category_id')]));
				}else{
					$this->error('添加失败');
				}
				return;
			}
		}

		//栏目列表
		$categorys = model('Category')->getCate();

		//如果有栏目id
		if(input('category_id')){
			//查找栏目
			$category = model('Category')->find(input('category_id'));
			//字段列表
			$fields = model('ModelField')->where('model_id',$category['model_id'])->select();
			$this->assign([
				'fields'=>$fields,
				'model' =>$category['model_id'],
			]);
		}
		return $this->fetch('',['categorys'=>$categorys]);
	}


	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit($id)
	{
		if(request()->isPost()){
			if($this->model->edit()){
				$this->success('更新成功','lst');
			}else{
				$this->error('更新失败');
			}
			return;
		}

		//栏目列表
		$categorys = model('Category')->getCate();

		//根据id获取配置
		$article = $this->model->find($id);

		return $this->fetch('',['article'=>$article,'categorys'=>$categorys]);
	}



	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del()
	{
		if($this->model->del()){
            return show(1,'删除成功',[],$_SERVER['HTTP_REFERER']);
        }else{
            return show(0,'删除失败');
        }
	}


}