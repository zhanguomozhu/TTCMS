<?php 
namespace app\common\model;
use app\base\model\Base;

class Featured extends Base
{


	//一对一关联栏目表
	public function category(){
		return $this->belongsTo('Category');
	}


	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit(){
		$data = input('post.');
		return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}


	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function add(){
		$data = input('post.');
		return $this->allowField(true)->save($data);
	}

}