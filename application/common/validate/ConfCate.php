<?php 
namespace app\common\validate;
use think\Validate;

class ConfCate extends Validate
{
	 protected $rule =   [
        'cnname'  => 'unique:conf_cate|require|max:25',
        'enname'  => 'unique:conf_cate|require|max:25',
    ];
    
    protected $message  =   [
        'cnname.require' => '中文名称必须填写',
        'cnname.max'     => '中文名称最多不能超过25个字符',
        'cnname.unique'  => '中文名称不能重复',
        'enname.require' => '英文名称必须填写',
        'enname.max'     => '英文名称最多不能超过25个字符',
        'enname.unique'  => '英文名称不能重复',
    ];


    protected $scene = [
         'add'   =>  ['cnname','enname'],
         'edit'  =>  ['cnname.require','cnname.max','enname.max','enname.require'],
    ];
}