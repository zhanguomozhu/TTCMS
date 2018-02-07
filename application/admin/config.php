<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [

    // 视图输出字符串内容替换
    'view_replace_str'       => [
        '__PUBLIC__' => '/',
        '__ADMIN__'  => '/static/admin',
        '__OTHER__' => '/static/other',
    ],
    'session'                => [
        'id'             => '',
        // SESSION_ID的提交变量,解决flash上传跨域
        'var_session_id' => '',
        // SESSION 前缀
        'prefix'         => 'think',
        // 驱动方式 支持redis memcache memcached
        'type'           => '',
        // 是否自动开启 SESSION
        'auto_start'     => true,
        //过期时间//暂时没用
        'expire'         => 60*60,
    ],
    
    //不作初始化生成的模块
    'not_model'=>['Base','Common','Index','Sqlbak'],

    //系统模型id
    'sys_model_ids'=>[1,2,3,4,5],
];