<?php 
namespace app\common\model;

use app\base\model\Base;

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
		$id = input('id');
        $group_trans =  $this;
        $auth_trans  =  model('AuthGroupAccess');
        
        //开启事务
        $group_trans->startTrans();
        $auth_trans->startTrans();

        //删除角色表
        $groupRes = $group_trans->where('id',$id)->delete();
        //删除角色用户表
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
            return true;
        }else{
            return false;
        }
	}

	/**
	 * 删除
	 * @return [type] [description]
	 */
	public function delGroup($id)
	{
		//删除角色用户表数据
		$access = model('AuthGroupAccess')->where(['group_id'=>$id])->delete();
		if($access){
			//删除角色表
			if($this::destroy($id)){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
		
	}

}