<?php 
namespace app\common\model;
use app\base\model\Base;

class Category extends Base
{

	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function add(){
		$data = input('post.');
		//验证
		$this->validataCheck('Category',$data,'add');
		return $this->allowField(true)->save($data);
	}



	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit(){
		$data = input('post.');
		dump($data);die;
		
		//验证
		$this->validataCheck('Conf',$data,'add');

		
		return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}



	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function del(){
		$data = input('post.');
		dump($data);die;
		
		//验证
		$this->validataCheck('Conf',$data,'add');

		
		return $this->allowField(true)->save($data);
	}


}