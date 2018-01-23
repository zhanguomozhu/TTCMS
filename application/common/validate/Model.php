<?php
namespace app\common\validate;
use think\Validate;
class Model extends Validate
{
    protected $regex = [ 
        'zsx' => '^[0-9a-zA-Z_]{1,}$',//字母数字下划线
    ];
	//验证规则
	protected  $rule = [
		'name'            => 'require',
        'tablename'       => 'require|zsx',
        'index_template'  => 'require|zsx',
        'list_template'   => 'require|zsx',
        'show_template'   => 'require|zsx',
	];
	//验证提示
	 protected $message  =   [
        'name.require'          => '模型名称必须填写',
        'tablename.require'     => '模型表名必须填写',
        'tablename.require'     => '模型表名必须填写',
        'index_template.require'=> '首页模板必须填写',
        'list_template.require' => '列表页模板必须填写',
        'show_template.require' => '详情页模板必须填写',
        'tablename.zsx'         => '模型表名必须是字母数字下划线',
        'index_template.zsx'    => '首页模板必须是字母数字下划线',
        'list_template.zsx'     => '列表页模板必须是字母数字下划线',
        'show_template.zsx'     => '详情页模板必须是字母数字下划线',
        

        
    ];
    //验证场景
    protected $scene = [
        'add'     =>  ['name','tablename','index_template','list_template','show_template'],//添加
        'edit'    =>  ['name','tablename','index_template','list_template','show_template'],//修改
    ];



}