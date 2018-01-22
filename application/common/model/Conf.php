<?php 
namespace app\common\model;
use app\base\model\Base;

class Conf extends Base
{
	//一对一关联配置分类表
	public function confCate(){
		return $this->belongsTo('ConfCate');
	}


	/**
	 * 获取列表
	 * @return [type] [description]
	 */
	public function getConfList(){
		return $this->with('confCate')->paginate('',false,['query' => request()->param()]);
	}
	/**
	 * 添加
	 * @return [type] [description]
	 */
	public function add(){
		$data = input('post.');
		//去除空格
		foreach ($data as $key => $value) {
			$data[$key] = trim($value);
		}
		//验证
		$this->validataCheck('Conf',$data,'add');
		//中文逗号变英文
		if($data['values']){
			$data['values'] = str_replace('，',',',$data['values']);
		}
		return $this->allowField(true)->save($data);
	}


	/**
	 * 编辑
	 * @return [type] [description]
	 */
	public function edit(){
		$data = input('post.');
		//去除空格
		foreach ($data as $key => $value) {
			$data[$key] = trim($value);
		}
		//验证
		$this->validataCheck('Conf',$data,'edit');
		//中文逗号变英文
		if($data['values']){
			$data['values'] = str_replace('，',',',$data['values']);
		}
		return $this->allowField(true)->save($data,['id'=>$data['id']]);
	}


	/**
	 * 设置配置
	 */
	public function setConf(){
		$data = input('post.');
		$list = array();
		if($data){
			foreach ($data as $key => $value) {
				//值如果是数组，组合成字符串,复选框数数组格式
				if(is_array($value)){
					$value = implode(',',$value);
				}
				//获取id用于批量更新
				$conf = $this->where('enname',$key)->find();
				
				if($conf['value'] != $value){
					//如果type=6是上传类型和有新的上传文件，删除原文件
					if($conf['type'] == 6){
						@unlink($conf['value']);
					}
					//组合数据
					$list[] = [
						'id'   => $conf['id'],
						'value'=> trim($value),
					];
				}
			}
		}
		//批量更新
		if($this->allowField(true)->saveAll($list)){
			return true;
		}else{
			return false;
		}
	}


	/**
	 * 按照配置分类取出数据
	 * @return [type] [description]
	 */
	public function allGroup($where=null,$field=null){
		$res = model('ConfCate')->field($field)->with(['confs'])->where($where)->order('sort')->select();
		return obj_to_arr($res);
	}
}