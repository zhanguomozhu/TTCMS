<?php 
namespace app\common\model;
use app\base\model\Base;

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
		$data = input('post.');
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
		$this->validataCheck('Article',$data,'add');


		//开启事务
		$article_trans  =  $this;				 //文章表
        $fields_trans   =  model('ArticleField');//附加表
        $article_trans->startTrans();
		//插入文章表数据
		$articleRes = $article_trans->allowField(true)->save($data);

		//***********************************************************附加表字段
		if(isset($data['model_id'])){
			//获取该模型附加字段
			$fields = model('ModelField')->where('model_id',$data['model_id'])->column('enname','id');
			if($fields){
				//开启事务
				$fields_trans->startTrans();
				//拼接附加表数据
						$attach_arr = array();
						foreach ($data as $key => $value) {
							if(in_array($key,$fields)){
								$attach_arr[] = [
										'article_id' 	=> $this->id,                 //模型id
										'model_field_id'=> array_search($key,$fields),//字段id
										'value' 		=> $value,                    //字段值
								];
							}
						}

				//插入附加表
				$fieldsRes = $fields_trans->saveAll($attach_arr);

				//事务回滚
		        if(!$articleRes || !$fieldsRes){
		            $article_trans->rollBack();
		            $fields_trans->rollBack();
		        }

		        //提交事务
		        $article_trans->commit();
		        $fields_trans->commit();


				if($articleRes && $fieldsRes){
					return true;
				}else{
					return false;
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
			return true;
		}else{
			return false;
		}
	}


	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function del(){
		$id = input('id');
        //删除图片
        $img = $this->find($id);
        if(@unlink($img['image_url'])){
        	$this->destroy($id);
            return true;
        }else{
            return false;
        }
	}

}