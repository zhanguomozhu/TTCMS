<?php
namespace app\admin\controller;
use app\base\controller\Base;
/**
* 模型字段控制器
*/
class ModelField extends Base
{
	/**
	 * 列表
	 * @return [type] [description]
	 */
	public function lst()
	{
		//排序
		if(request()->isPost()){
			if($this->model->setOrder()){
				$this->redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->error('排序失败');
			}
			return;
		}
		//列表
		$fields = $this->model->with('model')->where('model_id',input('model_id'))->order('sort')->select();
		return $this->fetch('',['fields'=>$fields]);
	}


	/**
	 * 添加
	 */
	public function add()
	{
		if(request()->isPost()){
			if($this->model->add()){
				$this->success('添加成功',url('lst',array('model_id'=>input('model_id'))));
			}else{
				$this->error('添加失败');
			}
			return;
		}
		return $this->fetch();
	}


	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit($id)
	{
		if(request()->isPost()){
			if($this->model->edit()){
				$this->success('更新成功',url('lst',array('model_id'=>input('model_id'))));
			}else{
				$this->error('更新失败');
			}
			return;
		}

		//根据id获取配置
		$field = $this->model->find($id);

		return $this->fetch('',['field'=>$field]);
	}



	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del($id)
	{
		if($this->model->destroy($id)){
			//$this->success('删除成功',url('lst',array('model_id'=>input('model_id'))));
			return json(['code'=>1,'msg'=>'删除成功','url'=>url('lst',array('model_id'=>input('model_id'))]);
		}else{
			return json(['code'=>0,'msg'=>'删除失败']);
		}
	}

}