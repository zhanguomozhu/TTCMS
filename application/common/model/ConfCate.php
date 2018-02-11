<?php 
namespace app\common\model;
use app\common\model\Base;

class ConfCate extends Base
{
	/**
	 * 一对多关联查询配置表
	 * @return [type] [description]
	 */
	public function confs()
    {
        return $this->hasMany('Conf')->field('id,enname,cnname');
    }


	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit(){
		//数据库字段 网页字段转换，过滤参数
        $param = [
        	'id'=>'id',
        	'enname' => 'enname',
            'cnname' => 'cnname',
        ];
        $data = $this->buildParam($param);

		//验证
		$this->validataCheck('ConfCate',$data,'edit');
		return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}


	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function add(){
		//数据库字段 网页字段转换，过滤参数
        $param = [
            'enname' => 'enname',
            'cnname' => 'cnname',
        ];
        $data = $this->buildParam($param);

		//验证
		$this->validataCheck('ConfCate',$data,'add');
		return $this->allowField(true)->save($data);
	}

}