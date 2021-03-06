<?php

/**
 * Created by PhpStorm.
 * Power By Mikkle
 * Email：776329498@qq.com
 * Date: 2017/7/28
 * Time: 13:42
 */
return [

    //上传目录
    'upload_path'=>'uploads',


    //上传图片配置
    //上传图片文件路径
    'upload_images_path'=>'uploads/images',
    //存储上传图片文件的数据表名称
    //'upload_images_table'=>'mk_common_images',
    'upload_images_validate'=>[
        'size'=>1024*1024*5,
        'ext'=>'jpg,png,gif'
    ],

    //上传广告图片配置
    //上传广告图片文件路径
    'upload_ads_path'=>'uploads/ads',
    //存储上传图片文件的数据表名称
    //'upload_images_table'=>'mk_common_images',
    'upload_ads_validate'=>[
        'size'=>1024*1024*5,
        'ext'=>'jpg,png,gif'
    ],



    //上传文件配置
    //上传文件路径
    "upload_files_path"=>'uploads/files',
    //存储上传文件的数据表名称
    //'upload_files_table'=>'mk_common_files',
    'upload_files_validate'=>[
        'size'=>1024*1024*5,
        'ext'=>'doc,rar,7z,zip,xlsx,csv,xls'
    ],



];