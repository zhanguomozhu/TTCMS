<?php 
namespace app\common\model;
use app\common\model\Base;

class Article extends Base
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

		//创建时间
		$data['create_time'] = $data['create_time'] ?  strtotime($data['create_time']) : time();
		//修改时间
		$data['update_time'] = time();
		//发布人
        if(!$data['author']){
        	$data['author'] = session('admin_info.username');
        }
		//摘要
		if(empty($data['description'])){
				$data['description'] = mb_substr(strip_tags($data['content']), 0,250,'utf-8');
			}
		//链接
		if(!trim($data['url'])){
			unset($data['url']);
		}
		//是否推荐
        if(!isset($data['is_recommend'])){
        	$data['is_recommend'] = 0;
        }
        //是否置顶
        if(!isset($data['is_top'])){
        	$data['is_top'] = 0;
        }
        //验证
		$this->validataCheck('Article',$data,'edit');
		return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}


	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function add(){
		try{
			$data = input('post.');//获取提交数据
			//***********************************************************文章表字段
			//创建时间
			$data['create_time'] = isset($data['create_time']) ?  strtotime($data['create_time']) : time();
			//发布人
			$data['author'] = session('admin_info.username');
			//摘要
			if(empty($data['description']) && isset($data['content'])){
					$data['description'] = mb_substr(strip_tags($data['content']), 0,250,'utf-8');
				}
			//链接
			if(isset($data['url'])){
				if(!trim($data['url'])){
					unset($data['url']);
				}
			}
			//是否推荐
	        if(!isset($data['is_recommend'])){
	        	$data['is_recommend'] = 0;
	        }
	        //是否置顶
	        if(!isset($data['is_top'])){
	        	$data['is_top'] = 0;
	        }

	        //验证
			//$this->validataCheck('Article',$data,'add');
	        //***********************************************************************获取模型id
			if(isset($data['model_id'])){
				//存在模型id
				$model_id = $data['model_id'];
			}else{
				//根据cate——id查看模型
				$model = db('category')->where('id',$data['category_id'])->column('model_id');
				$model_id = $model[0];
			}
			//**********************************************************根据模型id插入数据表数据
			switch ($model_id) {
				case 1:
					//*******************************************************************单页表
					$article_trans  =  model('Page');
					//开启事务
			  		$article_trans->startTrans();
					//插入文章表数据
					$articleRes = $article_trans->allowField(true)->save($data);
					break;
				case 3:
					//*******************************************************************图集表
					$article_trans  =  model('Picture');
					//开启事务
			  		$article_trans->startTrans();
					//插入文章表数据
					$articleRes = $article_trans->allowField(true)->save($data);
					break;
				case 4:
					//*******************************************************************链接表
					$article_trans  =  model('Link');
					//开启事务
			  		$article_trans->startTrans();
					//插入文章表数据
					$articleRes = $article_trans->allowField(true)->save($data);
					break;
				case 5:
					//*******************************************************************下载表
					$article_trans  =  model('Download');
					//开启事务
			  		$article_trans->startTrans();
					//插入文章表数据
					$articleRes = $article_trans->allowField(true)->save($data);
					break;
				default:
					//*******************************************************************文章表
					$article_trans  =  $this;
					//开启事务
			  		$article_trans->startTrans();
					//插入文章表数据
					$articleRes = $article_trans->allowField(true)->save($data);
					break;
			}
			//***********************************************************************附加表字段
			$fields_trans   =  model('ArticleField');//附加表
			if($model_id){
				//获取该模型附加字段
				$fields = model('ModelField')->where('model_id',$model_id)->column('enname');
				if($fields){
					//开启事务
					$fields_trans->startTrans();
					//拼接附加表数据
					$attach_arr = array();
					$attach_arr['article_id'] = $this->id;                         //模型id
					$attach_arr['content']    = htmlspecialchars($data['content']);//文章内容
					foreach ($data as $key => $value) {
						if(!in_array($key,$fields)){
							unset($data[$key]);//删除不是附加字段的值
						}
					}
					$attach_arr['value']      = empty($data) ? '' : json_encode($data);//字段内容
					//插入附加表
					$fieldsRes = $fields_trans->save($attach_arr);

					//事务回滚
			        if(!$articleRes || !$fieldsRes){
			            $article_trans->rollBack();
			            $fields_trans->rollBack();
			        }

			        //提交事务
			        $article_trans->commit();
			        $fields_trans->commit();

					if($articleRes && $fieldsRes){
						return show(1, '添加成功',[],url('lst',['category_id'=>input('category_id')]));
					}else{
						return show(0, '添加失败');
					}
				}
			}

			//事务回滚
	        if(!$articleRes){
	            $article_trans->rollBack();
	        }

	        //提交事务
	        $article_trans->commit();

			if($articleRes){
				return show(1, '添加成功',[],url('lst',['category_id'=>input('category_id')]));
			}else{
				return show(0, '添加失败');
			}
		}catch (Exception $e) {
            return show(0, $e->getMessage());
        }
        return show(0, '提交有误,请重试');
	}


	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del(){
		try {
			$id = input('id');

			//开启事务
			$article_trans  =  $this;				 //文章表
	  		$fields_trans   =  model('ArticleField');//附加表
	  		$article_trans->startTrans();

	  		//删除文章表
	  		$data = $this->find($id);
	  		$articleRes = $article_trans->destroy($id);
	        //删除图片
	        @unlink($data['image_url']);
	        //如果附加表有字段
	        //删除附加表
	        $fields = $fields_trans->where('article_id',$id)->select();
	        if($fields){
	        	//开启事务
		        $fields_trans->startTrans();
	        	$fieldsRes = $fields_trans->where('article_id',$id)->delete();

	        	//事务回滚
		        if(!$articleRes || !$fieldsRes){
		            $article_trans->rollBack();
		            $fields_trans->rollBack();
		        }
		        //提交事务
		        $article_trans->commit();
		        $fields_trans->commit();

		        if($articleRes && $fieldsRes){
		             return show(1,'删除成功');
		        }else{
		            return show(0,'删除失败');
		        }
	        }
       		//如果附加表没有字段
	        //事务回滚
	        if(!$articleRes){
	            $article_trans->rollBack();
	        }
	        //提交事务
	        $article_trans->commit();

	        if($articleRes){
	            return show(1,'删除成功');
	        }else{
	            return show(0,'删除失败');
	        }
	    }catch (Exception $e) {
            return show(0, $e->getMessage());
        }
        return show(0, '提交有误,请重试');
	}

}