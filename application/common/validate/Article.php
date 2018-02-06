<?php 
namespace app\common\validate;
use think\Validate;

class Article extends Validate
{
	 protected $rule =   [
        'category_id'   => 'require|number',
        'title'         => 'require|max:255',
        'clicks'        => 'number',
        'url'           => 'url',
    ];
    
    protected $message  =   [
        'category_id.require' => '栏目id必须填写',
        'category_id.number'=> '栏目id必须是数字',
        'title.require'     => '标题必须填写',
        'title.max'         => '标题长度最大255字节',
        'clicks.number'     => '点击数必须是数字',
        'url.url'           => '链接地址必须是url格式',
    ];


    protected $scene = [
         'add'   =>  ['category_id','title','clicks','url'],
         'edit'  =>  ['category_id','title','clicks','url'],
    ];
}