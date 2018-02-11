<?php 
namespace app\admin\controller;
use app\common\controller\Base;

class ConfCate extends Base
{
	/**
	 * 分类列表
	 * @return [type] [description]
	 */
	public function lst()
	{
		//分类列表
		$cates = $this->model->getList(0,'sort');
		return $this->fetch('',['cates'=>$cates]);
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

		//分类列表
		$cates = $this->model->getList(0,'sort');
		return $this->fetch('',['cates'=>$cates]);
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

		//根据id获取配置
		$cates = $this->model->find($id);

		return $this->fetch('',['cates'=>$cates]);
	}




	/**
	 * 修改状态
	 * @return [type] [description]
	 */
	public function edit_status()
	{
		 if(request()->isGet()){
            if($this->model->setStatus()){
                $this->redirect($_SERVER['HTTP_REFERER']);
            }else{
                $this->error('修改失败');
            }
        }
	}

}