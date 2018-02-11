<?php 
namespace app\admin\controller;
use app\common\controller\Base;

class AuthGroup extends Base
{

	/**
	 * 列表
	 * @return [type] [description]
	 */
	public function lst()
	{
		//管理员列表
		$groups = $this->model->getList();
		return $this->fetch('',['groups'=>$groups]);
	}



	/**
	 * 添加
	 */
	public function add()
	{
		if(request()->isPost()){
            //插入数据库
			if(model('AuthGroup')->add()){
				$this->success('添加成功','lst');
			}else{
				$this->error('添加失败');
			}
			return;
		}
		//角色权限
		$rules = model('AuthRule')->getRuleTree();
		return $this->fetch('',['rules'=>$rules]);
	}



	/**
	 * 修改
	 * @return [type] [description]
	 */
	public function edit()
	{
		if(request()->isPost()){
			//修改数据
			if($this->model->edit()){
				$this->success('更新成功','lst');
			}else{
				$this->error('更新失败');
			}
			return;
		}
		//角色信息
		$res = $this->model->find(input('id'));
		//权限信息
		$rules = model('AuthRule')->getRuleTree();
		return $this->fetch('',['rules'=>$rules,'res'=>$res]);
	} 


	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del()
	{
		return $this->model->del();
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