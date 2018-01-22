<?php 
namespace app\admin\controller;
use app\base\controller\Base;

//数据库备份
class Sqlbak extends Base
{

	protected $sql;

	public function _initialize(){
		parent::_initialize();
		$this->sql = new \org\Baksql(\think\Config::get("database"));
	}


	//数据库备份
	public function index(){
		return $this->fetch("index",["list"=>$this->sql->get_filelist()]);
	}


	//备份
	public function backup(){
		$this->error($this->sql->backup());

	}


	//下载
	public function dowonload(){
		return $this->sql->downloadFile(input("name")) != '文件有错误！' ? $this->sql->downloadFile(input("name")) : $this->error('文件有错误！');
	}


	//还原
	public function restore(){
		$this->error($this->sql->restore(input("name")));

	}


	//删除
	public function del(){
		$this->error($this->sql->delfilename(input("name")));
	}

}