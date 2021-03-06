<?php 
namespace app\admin\controller;
use app\common\controller\Base;
use think\Loader;
class AuthRule extends Base
{
	/**
	 * 权限列表
	 * @return [type] [description]
	 */
	public function lst()
	{
		//权限列表
		$rules = $this->model->getRule();
		return $this->fetch('',['rules'=>$rules]);
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
		//权限列表
		$rules = $this->model->getRule();
		return $this->fetch('',['rules'=>$rules]);
	}


	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit()
	{
		if(request()->isPost()){
			if($this->model->edit()){
				$this->success('更新成功','lst');
			}else{
				$this->error('更新失败');
			}
			return;
		}
		//权限列表
		$rules = $this->model->getRule();
		//获取单独权限
		$rule  = $this->model->find(input('id'));
		return $this->fetch('',['rules'=>obj_to_arr($rules),'rule'=>$rule]);
	}



	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del()
	{
		if($this->model->del()){
            return show(1,'删除成功');
        }else{
            return show(0,'删除失败');
        }
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