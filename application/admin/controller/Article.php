<?php 
namespace app\admin\controller;
use app\base\controller\Base;

class Article extends Base
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

		//列表
		$articles = $this->model->with('category')->order('sort')->cache(true,60)->paginate('',false,['query' => request()->param()]);

		//如果从栏目页条转过来
		$category_id = input('category_id') ? input('category_id') : '';
		if($category_id){
			//获取下级栏目的文章
			$data  = model('Category')->select();
			$ids   = getSons($data,$category_id,'id');
			$ids[] = (int) $category_id;
			$articles = $this->model->with('category')->where('category_id','in',$ids)->order('sort')->cache(true,60)->paginate('',false,['query' => request()->param()]);
		}
		
		return $this->fetch('',['articles'=>$articles]);
	}


	/**
	 * 添加
	 */
	public function add()
	{
		if(request()->isPost()){
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
		$categorys = model('Category')->getCate();

		
		if(input('category_id')){
			//查找栏目
			$category = model('Category')->find(input('category_id'));
			//字段列表
			$fields = model('ModelField')->where('model_id',$category['model_id'])->cache(true,60)->select();
			$this->assign([
				'fields'=>$fields,
				'model' =>$category['model_id'],
			]);
		}
		return $this->fetch('',['categorys'=>$categorys]);
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

		//栏目列表
		$categorys = model('Category')->getCate();

		//根据id获取配置
		$article = $this->model->find($id);

		return $this->fetch('',['article'=>$article,'categorys'=>$categorys]);
	}



	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del()
	{
		if($this->model->del()){
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