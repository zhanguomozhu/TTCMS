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
		//中文逗号变英文
		if($data['values']){
			$data['values'] = str_replace('，',',',$data['values']);
		}
		return $this->allowField(true)->save($data);
	}


	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function edit(){
		$data = input('post.');
		//中文逗号变英文
		if($data['values']){
			$data['values'] = str_replace('，',',',$data['values']);
		}
		return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}

}