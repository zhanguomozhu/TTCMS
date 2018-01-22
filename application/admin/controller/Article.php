<?php
namespace app\admin\controller;
use app\base\controller\Base;
/**
* 文章控制器
*/
class Article extends Base
{
	private $category_model;//栏目模型

	//初始化
	public function _initialize()
	{
		parent::_initialize();
		$this->category_model = model('Category');
	}

	/**
	 * 列表
	 * @return [type] [description]
	 */
	public function lst()
	{
		//排序
		if(request()->isPost()){
			if($this->model->setOrder()){
				$this->success('排序成功','lst');
			}else{
				$this->error('排序失败');
			}
			return;
		}

		//文章列表
		$articles = $this->model->getList(0,'sort');
		return $this->fetch('',['articles'=>$articles]);
	}


	/**
	 * 添加
	 */
	public function add()
	{
		if(request()->isPost()){
			if($this->model->add()){
				$this->success('添加成功','lst');
			}else{
				$this->error('添加失败');
			}
			return;
		}

		//分类列表
		$cates = $this->model->getList(0,'sort');
		return $this->fetch('',['cates'=>$cates]);
	}


	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit($id)
	{
		if(request()->isPost()){
			if($this->model->edit()){
				$this->success('更新成功','lst');
			}else{
				$this->error('更新失败');
			}
			return;
		}

		//根据id获取配置
		$cates = $this->model->find($id);

		return $this->fetch('',['cates'=>$cates]);
	}



	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del($id)
	{
		if($this->model->destroy($id)){
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
            if($this->model->setStatus()){
                $this->redirect($_SERVER['HTTP_REFERER']);
            }else{
                $this->error('修改失败');
            }
        }
	}

}