<?php 
namespace app\admin\controller;
use app\base\controller\Base;

class Featured extends Base
{



	/**
	 * 推荐位列表
	 * @return [type] [description]
	 */
	public function lst()
	{
		//排序
		if(request()->isPost()){
			if($this->model->setOrder()){
				$this->success('排序成功','lst');
			}else{
				$this->error('排序失败');
			}
			return;
		}

		//推荐位列表
		$featureds = $this->model->with('category')->order('sort')->paginate('',false,['query' => request()->param()]);
		return $this->fetch('',['featureds'=>$featureds]);
	}


	/**
	 * 添加
	 */
	public function add()
	{
		if(request()->isPost()){
			if($this->model->add()){
				$this->success('添加成功','lst');
			}else{
				$this->error('添加失败');
			}
			return;
		}

		//栏目列表
		$categorys = model('Category')->getCate();

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
		$featured = $this->model->find($id);

		return $this->fetch('',['featured'=>$featured,'categorys'=>$categorys]);
	}



	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del($id)
	{
		if($this->model->destroy($id)){
			$this->success('删除成功','lst');
		}else{
			$this->error('修改失败');
		}
	}

}