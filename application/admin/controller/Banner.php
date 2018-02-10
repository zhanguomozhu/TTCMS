<?php 
namespace app\admin\controller;
use app\base\controller\Base;

class Banner extends Base
{
	/**
	 * 分类列表
	 * @return [type] [description]
	 */
	public function lst()
	{
		//排序
		if(request()->isPost()){
			if($this->model->setOrder()){
				$this->redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->error('排序失败');
			}
			return;
		}

		//分类列表
		$banners = $this->model->with('ad')->order('sort')->paginate('',false,['query' => request()->param()]);
		return $this->fetch('',['banners'=>$banners]);
	}


	/**
	 * 添加
	 */
	public function add()
	{
		if(request()->isPost()){
			//文件上传
			if(request()->isAjax() && !empty($_FILES)){
				$this->douploadimg();
				return;
			}else{
				if($this->model->add()){
					$this->success('添加成功','lst');
				}else{
					$this->error('添加失败');
				}
				return;
			}
		}

		//广告位列表
		$ads = model('Ad')->getList(0,'sort');

		return $this->fetch('',['ads'=>$ads]);
	}


	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit($id)
	{
		if(request()->isPost()){
			//文件上传
			if(request()->isAjax() && !empty($_FILES)){
				$this->douploadimg();
				return;
			}else{
				if($this->model->edit()){
					$this->success('更新成功','lst');
				}else{
					$this->error('更新失败');
				}
				return;
			}
		}
		//广告位列表
		$ads = model('Ad')->getList(0,'sort');
		//根据id获取配置
		$banner = $this->model->find($id);

		return $this->fetch('',['banner'=>$banner,'ads'=>$ads]);
	}



	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del($id)
	{
		if($this->model->destroy($id)){
			return json(['code'=>1,'msg'=>'删除成功']);
		}else{
			return json(['code'=>0,'msg'=>'删除失败']);
		}
	}



	/**
	 * 修改状态
	 * @return [type] [description]
	 */
	public function edit_status()
	{
		 if(request()->isGet()){
            if($this->model->setStatus()){
                $this->redirect($_SERVER['HTTP_REFERER']);
            }else{
                $this->error('修改失败');
            }
        }
	}

}