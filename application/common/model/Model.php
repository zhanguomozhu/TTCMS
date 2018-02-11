<?php 
namespace app\common\model;
use app\common\model\Base;

class Model extends Base
{

	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function add(){
		$data = input('post.');
		//验证
		$this->validataCheck('Model',$data,'add');
		return $this->allowField(true)->save($data);
	}


	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function edit(){
		$data = input('post.');
		//验证
		$this->validataCheck('Model',$data,'edit');
		return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}



}