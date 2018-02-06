<?php
namespace app\common\validate;
use think\Validate;
class Category extends Validate
{
	//验证规则
	protected  $rule = [
		'pid'            => 'require|number',
        'model_id'       => 'require|number',
        'name'           => 'require',
        'is_menu'        => 'number',
        'sort'           => 'number',
        'is_cover'       => 'number',
	];
	//验证提示
	 protected $message  =   [
        'pid.require'       => '父级id必须填写',
        'model_id.require'  => '模型id必须填写',
        'name.require'      => '栏目名称必须填写',
        'pid.number'        => '父级id必须是数字',
        'model_id.number'   => '模型id必须是数字',
        'is_menu.number'    => '是否展示必须是数字',
        'sort.number'       => '排序必须是数字',
        'is_cover.number'   => '是否有封面必须是数字',
    ];
    //验证场景
    protected $scene = [
        'add'     =>  ['pid','model_id','name','is_menu','sort','is_cover'],//添加
        'edit'    =>  ['pid','model_id','name','is_menu','sort','is_cover'],//修改
    ];



}

