<?php 
namespace app\common\model;
use app\common\model\Base;

class AuthRule extends Base
{

	/**
	 * 权限列表
	 * @return [type] [description]
	 */
	public function getRule(){
		$data = $this->getList(0,'sort',0);
		//树状
		$rules = getTree(obj_to_arr($data));
		return $rules;
	}

	/**
	 * 添加
	 */
	public function add(){
		//数据库字段 网页字段转换，过滤参数
        $param = [
        	'pid' 	=> 'pid',
            'title' => 'title',
            'name' 	=> 'name',
            'level' => 'level',
            'status'=> 'status',
            'icon'  => 'icon',
        ];
        $data = $this->buildParam($param);

		//验证
		$this->validataCheck('AuthRule',$data,'add');

		//状态
		if(!isset($data['status'])){
			$data['status'] = 0;
		}

		//插入数据库
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
		//数据库字段 网页字段转换，过滤参数
        $param = [
        	'id' 	=> 'id',
        	'pid' 	=> 'pid',
            'title' => 'title',
            'name' 	=> 'name',
            'level' => 'level',
            'status'=> 'status',
            'icon'  => 'icon',
        ];
        $data = $this->buildParam($param);

		//验证
		$this->validataCheck('AuthRule',$data,'edit');

		//状态
		if($data['status'] == null){
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
        $rule_trans  =  $this;
        $auth_trans  =  model('AuthGroup');
        
        //获取子权限
        $list =$this->select();
        $ids = getSons($list,$id,'id');
        $ids[] = (int) $id;


        //开启事务
        $rule_trans->startTrans();
        $auth_trans->startTrans();

        //删除权限表
        $ruleRes = $rule_trans->where('id','in',$ids)->delete();



        //删除角色表
        $group_rule = $auth_trans->field('id,rules')->select();
        $data = array();
        //拼接修改数据
        foreach ($group_rule as $k => $v) {
        	$rules = explode(',',$v['rules']);
        	$key = array_search($id,$rules);
        	if($key >= 0){//删除权限id
        		unset($rules[$key]);
        	}
        	$data[] = ['id'=> $v['id'],'rules'=>implode(',',$rules)];
        }
        //修改
        $authRes  = $auth_trans->saveAll($data);

        //事务回滚
        if(!$ruleRes || !$authRes){
            $rule_trans->rollBack();
            $auth_trans->rollBack();
        }
        
        //提交事务
        $rule_trans->commit();
        $auth_trans->commit();

        if($ruleRes && $authRes){
            return true;
        }else{
            return false;
        }
	}



    /**
     * 获取角色权限列表
     * @return [type] [description]
     */
    public function getRuleTree()
    {
        $rules = obj_to_arr($this->order('sort')->select());
        return $this->sortTree($rules);
    }
    /**
     * tree排序
     * @param  [type]  $data [description]
     * @param  integer $pid  [description]
     * @return [type]        [description]
     */
    public function sortTree($data,$pid=0)
    {
        static $arr = array();
        foreach ($data as $k => $v) {
            if($v['pid'] == $pid){
                $v['dataid'] = implode('-',getParents($data,$v['id'],'id',0,true));
                $arr[] = $v;
                $this->sortTree($data,$v['id']);
            }
        }
        return $arr;
    }


}