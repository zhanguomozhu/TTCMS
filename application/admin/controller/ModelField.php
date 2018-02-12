<?php
namespace app\admin\controller;
use app\common\controller\Base;
use think\Model;
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
		
		//模型表数据
		$data = db('model')->find(input('id'));
		//表英文名
		$enname = input('tablename');
		//表全名
		$table = config('database.prefix').$enname;
		$db = new \org\MysqlManage();
		//列表
		$fields = $db->checkTable($table);
		// $fields = $this->model->with('model')->where('model_id',input('model_id'))->order('sort')->select();
		return $this->fetch('',['fields'=>$fields,'table'=>$data]);
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
	public function del(){
		return $this->model->del();
	}

}