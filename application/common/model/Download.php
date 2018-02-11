<?php 
namespace app\common\model;
use app\common\model\Base;

class Download extends Base
{

	//一对一关联栏目表
	public function category(){
		return $this->belongsTo('Category');
	}
}