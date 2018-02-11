<?php 
namespace app\admin\controller;
use app\common\controller\Base;

class Ad extends Base
{

	/**
	 * 列表
	 * @return [type] [description]
	 */
	public function lst()
	{
		//列表
		$ads = $this->model->with('category')->order('sort')->paginate('',false,['query' => request()->param()]);
		return $this->fetch('',['ads'=>$ads]);
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
		$ad = $this->model->find($id);

		return $this->fetch('',['ad'=>$ad,'categorys'=>$categorys]);
	}





	// /**
	//  * 修改状态
	//  * @return [type] [description]
	//  */
	// public function edit_status()
	// {
	// 	 if(request()->isGet()){
 //            if($this->model->setStatus()){
 //                $this->redirect($_SERVER['HTTP_REFERER']);
 //            }else{
 //                $this->error('修改失败');
 //            }
 //        }
	// }

}