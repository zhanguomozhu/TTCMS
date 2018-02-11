<?php 
namespace app\common\model;

use app\common\model\Base;

class AuthGroup extends Base
{

    /**
	 * 添加
	 */
	public function add(){
		$data = input('post.');
		//拼接权限id
		if(isset($data['rules'])){
			$data['rules'] = implode(',', $data['rules']);
		}else{
			$data['rules'] = '';
		}
		//角色状态
		if(!isset($data['status'])){
			$data['status'] = 0;
		}
		//添加数据
		if($this->save($data)){
			return true;
		}else{
			return false;
		}
	}


	/**
	 * 编辑
	 */
	public function edit(){
		$data = input('post.');
		//拼接权限id
		if(isset($data['rules'])){
			$data['rules'] = implode(',', $data['rules']);
		}else{
			$data['rules'] = '';
		}
		//角色状态
		if(!isset($data['status'])){
			$data['status'] = 0;
		}
		//修改数据
		if($this->save($data,['id'=>$data['id']])){
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
		try {
			$id = input('id');
	        $group_trans =  $this;
	        $auth_trans  =  model('AuthGroupAccess');
	        
	        //开启事务
	        $group_trans->startTrans();

	        //删除角色表
	        $groupRes = $group_trans->destroy($id);

	        //如果有用户，删除角色用户表
	        $auth_list = $auth_trans->where('group_id',$id)->select();
	        if($auth_list){
	        	//开启事务
	        	$auth_trans->startTrans();
	        	$authRes  = $auth_trans->where('group_id',$id)->delete();
	        	//事务回滚
		        if(!$groupRes || !$authRes){
		            $group_trans->rollBack();
		            $auth_trans->rollBack();
		        }
		        //提交事务
		        $group_trans->commit();
		        $auth_trans->commit();

		        if($groupRes && $authRes){
		             return show(1,'删除成功');
		        }else{
		            return show(0,'删除失败');
		        }
			}
			//如果没有用户，删除角色用户表
	        //事务回滚
	        if(!$groupRes){
	            $group_trans->rollBack();
	        }
	        //提交事务
	        $group_trans->commit();
	        
	        if($groupRes){
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