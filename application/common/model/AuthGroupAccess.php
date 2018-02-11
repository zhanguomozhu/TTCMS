<?php 
namespace app\common\model;
use app\common\model\Base;
class AuthGroupAccess extends Base
{

	/**
	 * 一对一关联查询角色表
	 * @return [type] [description]
	 */
	public function groups()
    {
        return $this->belongsTo('AuthGroup','group_id','id');
    }

    /**
     * 获取角色权限
     * @return [type] [description]
     */
    public function getAuths($id){
    	//获取权限id
    	$data = $this->with('groups')->where(['admin_id'=>$id])->find();
    	return explode(',',$data['groups']['rules']);
    }
}