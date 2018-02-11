<?php
namespace app\admin\controller;
use app\common\controller\Base;
/**
* 模型控制器
*/
class Model extends Base
{
	/**
	 * 列表
	 * @return [type] [description]
	 */
	public function lst()
	{
		//栏目列表
		$models = $this->model->getList();
		return $this->fetch('',['models'=>$models]);
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
				$this->success('更新成功','lst');
			}else{
				$this->error('更新失败');
			}
			return;
		}

		//根据id获取配置
		$models = $this->model->find($id);

		//字段列表
		$fields = model("ModelField")->with('model')->where('model_id',$id)->order('sort')->select();
		return $this->fetch('',['model'=>$models,'fields'=>$fields]);
	}



}