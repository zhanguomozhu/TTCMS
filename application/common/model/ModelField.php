<?php 
namespace app\common\model;
use app\common\model\Base;

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


	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del(){
		$data = input();
		$db = new \org\MysqlManage();
		//表名
		$table = config('database.prefix').trim($data['tablename']);
		//字段名
		$field = trim($data['field']);
		//删除
		$res = $db->dropField($table,$field);
		if($res){
			return show(0,'删除失败');
		}else{
			return show(1,'删除成功');
		}
	}

}