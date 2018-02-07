<?php 
namespace app\common\model;
use app\base\model\Base;

class ModelField extends Base
{

	//一对一关联栏目表
	public function model(){
		return $this->belongsTo('Model');
	}

	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function add(){
		$data = input('post.');
		return $this->allowField(true)->save($data);
	}


	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function edit(){
		$data = input('post.');
		return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}


	/**
	 * 检测是否是系统模型
	 */
	public function checkModel($model_id){
		if(in_array($model_id,config('sys_model_ids'))){
			return true;
		}else{
			return false;
		}
	}
}