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

		//插入数据库
		if($this->allowField(true)->save($data)){
			//创建数据表
			$db = new \org\MysqlManage();
			if($db->createTable($data['tablename'])){
				return $this->id;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
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


	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del(){
		$id = input('id');
		//获取表名
		$data = $this->find($id);
		//删除数据
		if($this->destroy($id)){
			//删除数据库
			$db = new \org\MysqlManage();
			$table = config('database.prefix').trim($data['tablename']);
			$res = $db->delTable($table);
			if($res){
				return show(0,$res);
			}else{
				return show(1,'删除成功');
			}
		}else{
			return show(0,'删除失败');
		}
	}

}