<?php
namespace app\admin\controller;
use app\base\controller\Base;
/**
* 栏目控制器
*/
class Category extends Base
{


	/**
	 * 列表
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

		//栏目列表
		$categorys = $this->model->getCate();
		//模型列表
		$model = model('Model')->column('name');

		return $this->fetch('',['categorys'=>$categorys,'model'=>obj_to_arr($model)]);
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

		//栏目列表
		$categorys = $this->model->getCate();

		//模型列表
		$models = model('Model')->getList(0,0,0);
		return $this->fetch('',[
			'categorys'=> $categorys,
			'models'   => $models,
		]);
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
		//栏目列表
		$categorys = $this->model->getCate();

		//模型列表
		$models = model('Model')->getList(0,0,0);

		//根据id获取栏目信息
		$model = $this->model->find($id);

		//获取子分类
		$sons = getSons($categorys,$id,'id');
		$sons[] = $id;

		return $this->fetch('',[
			'categorys'=> $categorys,
			'models'   => $models,
			'model'    => $model,
			'sons'     => $sons,
		]);
	}



	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del($id)
	{
		if($this->model->del()){
			$this->success('删除成功','lst');
		}else{
			$this->error('修改失败');
		}
	}


	/**
	 * 修改状态
	 * @return [type] [description]
	 */
	public function edit_status()
	{
		 if(request()->isGet()){
            if($this->model->setStatus('is_menu')){
                $this->redirect($_SERVER['HTTP_REFERER']);
            }else{
                $this->error('修改失败');
            }
        }
	}

}