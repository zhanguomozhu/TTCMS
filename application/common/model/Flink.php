<?php 
namespace app\common\model;
use app\base\model\Base;

class Flink extends Base
{
	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit(){
		$data = input('post.');
		//状态
        if(!isset($data['status'])){
        	$data['status'] = 0;
        }
		return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}


	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function add(){
		$data = input('post.');
		//状态
        if(!isset($data['status'])){
        	$data['status'] = 0;
        }
		return $this->allowField(true)->save($data);
	}

}