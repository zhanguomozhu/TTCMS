<?php 
namespace app\admin\controller;
use app\common\controller\Base;

class Conf extends Base
{
	/**
	 * 配置列表
	 * @return [type] [description]
	 */
	public function lst()
	{
		//配置列表
		$confs = $this->model->getConfList();
		return $this->fetch('',['confs'=>$confs]);
	}

	/**
	 * 添加配置项
	 */
	public function add()
	{
		if(request()->isPost()){
			//插入数据库
			if($this->model->add()){
				$this->success('添加成功','lst');
			}else{
				$this->error('添加失败');
			}
			return;
		}
		//配置分类
		$cates = model('ConfCate')->getList(['status'=>1],'sort',0,'id,enname,cnname');
		return $this->fetch('',['cates'=>$cates]);
	}

	/**
	 * 编辑配置
	 * @return [type] [description]
	 */
	public function edit($id)
	{
		if(request()->isPost()){
			//修改数据
			if($this->model->edit()){
				$this->success('更新成功','lst');
			}else{
				$this->error('更新失败');
			}
			return;
		}
		//配置分类
		$cates = model('ConfCate')->getList(['status'=>1],'sort',0,'id,enname,cnname');
		//配置信息
		$conf = $this->model->find($id);
		
		return $this->fetch('',['conf'=>obj_to_arr($conf),'cates'=>$cates]);
	}




	/**
	 * 配置项
	 * @return [type] [description]
	 */
	public function conf()
	{
		if(request()->isPost()){
			//文件上传
			if(request()->isAjax() && !empty($_FILES)){
				$this->douploadimg();
				return;
			}else{
				//更新配置
				if($this->model->setConf()){
					$this->success('配置成功');
				}else{
					$this->error('配置失败');
				}
				return;
			}
		}
		//获取配置信息
		$res = $this->model->allGroup(['status'=>1]);
		return $this->fetch('',['res'=>$res]);
	}

}
