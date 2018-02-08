<?php if (!defined('THINK_PATH')) exit(); /*a:10:{s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\article\add.html";i:1518080796;s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\head.html";i:1518080012;s:70:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\top.html";i:1516609361;s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\left.html";i:1515654260;s:72:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\article\page.html";i:1518072545;s:75:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\article\article.html";i:1518080765;s:75:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\article\picture.html";i:1518075105;s:72:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\article\link.html";i:1518072685;s:76:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\article\download.html";i:1518073786;s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\foot.html";i:1518058023;}*/ ?>
<!DOCTYPE html>
<html>
    <head>
	<meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!--Basic Styles-->
    <link href="__ADMIN__/style/bootstrap.css" rel="stylesheet">
    <link href="__ADMIN__/style/font-awesome.css" rel="stylesheet">
    <link href="__ADMIN__/style/weather-icons.css" rel="stylesheet">

    <!--Beyond styles-->
    <link id="beyond-link" href="__ADMIN__/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="__ADMIN__/style/demo.css" rel="stylesheet">
    <link href="__ADMIN__/style/typicons.css" rel="stylesheet">
    <link href="__ADMIN__/style/animate.css" rel="stylesheet">
    <script src="__ADMIN__/style/jquery-1.11.1.js"></script>
    <style type="text/css">
        tr td{
            vertical-align: middle!important;
        }
        tr th{
            vertical-align: middle!important;
        }
    </style>
</head>
<body>
	<!-- 头部 -->
	    <div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-container">
            <!-- Navbar Barnd -->
            <div class="navbar-header pull-left">
                <a href="#" class="navbar-brand">
                    <small>
                            <img src="__ADMIN__/images/logo.png" alt="">
                        </small>
                </a>
            </div>
            <!-- /Navbar Barnd -->
            <!-- Sidebar Collapse -->
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="collapse-icon fa fa-bars"></i>
            </div>
            <!-- /Sidebar Collapse -->

            <div style="height: 45px;line-height: 45px;width: 70%;float: left;margin: 0 50px;">
                <!-- 天气信息 -->
                <div style="float: left;color: #fff;margin: 0 50px;">
                    <?php echo $weather['city']; ?>  <?php echo $weather['weather']; ?>  <?php echo $weather['temp']; ?>°
                </div>

                <!-- 农历日期 -->
                <div style="float: left;color: #fff;margin: 0 50px;">
                     <?php echo $nongli; ?>
                </div>
            
            </div>
             <!-- 登录开始-->
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    
                   <ul class="account-area">
                       <li>
                               
                           <a class="login-area dropdown-toggle" data-toggle="dropdown">
                               <div class="avatar" title="View your public profile">
                                   <img src="/<?php echo \think\Session::get('admin_info.avatar'); ?>">
                               </div>
                               <section>
                                   <h2><span class="profile"><span><?php echo \think\Session::get('admin_info.username'); ?></span></span></h2>
                               </section>
                           </a>

                           <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                               <li class="dropdown-footer">
                                   <a href="<?php echo url('admin/loginout'); ?>">
                                           退出登录
                                       </a>
                               </li>
                               <li class="dropdown-footer">
                                   <a href="<?php echo url('admin/edit',['id'=>\think\Session::get('admin_info.id')]); ?>">
                                           修改密码
                                       </a>
                               </li>
                           </ul>

                       </li>
                   </ul>
                </div>
            </div>
           <!-- 登录结束-->
        </div>
    </div>
</div>


	<!-- /头部 -->
	
	<div class="main-container container-fluid">
		<div class="page-container">
			<!-- Page Sidebar -->
                      <div class="page-sidebar" id="sidebar">
                <!-- Page Sidebar Header-->
                <div class="sidebar-header-wrapper">
                    <input class="searchinput" type="text">
                    <i class="searchicon fa fa-search"></i>
                    <div class="searchhelper">没啥用啊</div>
                </div>
                <!-- /Page Sidebar Header -->
                <!-- Sidebar Menu -->
                <ul class="nav sidebar-menu">
                    
                    <!--Dashboard-->
                    <?php if(isset($leftMenus)): ?>
                    <!-- 第一层 -->
                    <?php if(is_array($leftMenus) || $leftMenus instanceof \think\Collection || $leftMenus instanceof \think\Paginator): $i = 0; $__LIST__ = $leftMenus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$one): $mod = ($i % 2 );++$i;?>
                    <!-- 第二层 -->
                        <?php if(is_array($one['child']) || $one['child'] instanceof \think\Collection || $one['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $one['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$two): $mod = ($i % 2 );++$i;if($two['access'] == 1 && $two['status'] == 1): ?>
                            <li>
                                <a href="<?php echo url($two['name']); ?>" class="menu-dropdown">
                                    <i class="menu-icon fa <?php echo $two['icon']; ?>"></i>
                                    <span class="menu-text"><?php echo $two['title']; ?></span>
                                    <i class="menu-expand"></i>
                                </a>
                                <?php if(isset($two['child'])): ?>
                                <!-- 第三层 -->
                                <ul class="submenu">
                                    <?php if(is_array($two['child']) || $two['child'] instanceof \think\Collection || $two['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $two['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$three): $mod = ($i % 2 );++$i;if($three['access'] == 1 && $three['status'] == 1): ?>
                                    <li>
                                        <a href="<?php echo url($three['name']); ?>">
                                            <i class="menu-icon fa <?php echo $three['icon']; ?>"></i>
                                            <span class="menu-text"><?php echo $three['title']; ?></span>
                                            <i class="menu-expand"></i>
                                        </a>
                                    </li>
                                    <?php endif; endforeach; endif; else: echo "" ;endif; ?>
                                </ul> 
                                <?php endif; ?>
                            </li>
                        <?php endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endif; ?>
                   
                </ul>
                <!-- /Sidebar Menu -->
            </div>
            <!-- /Page Sidebar -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                       <?php echo $postion; ?>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption"><?php echo $title; ?></span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form class="form-horizontal" role="form" action="<?php echo url('add'); ?>" method="post">
                        
                         <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right">所属栏目</label>
                            <div class="col-sm-6">
                               <select name="category_id">
                                    <?php if(is_array($categorys) || $categorys instanceof \think\Collection || $categorys instanceof \think\Paginator): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == input('category_id')): ?>selected<?php endif; ?>><?php echo $vo['name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                               </select>
                            </div>
                            <p class="help-block col-sm-4 red">请选择栏目</p>
                        </div>
                        <!-- 存在模型id -->
                        <?php if(isset($model)): ?>
                            <input type="hidden" name="model_id" value="<?php echo $model; ?>">
                            <?php if($model == 1): ?>
                                <!-- 单页模型 -->
                                <div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">标题</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="title" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">缩略图</label>
    <div class="col-sm-6">
        <?php echo uploadImg(['image_url']); ?>
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">关键词</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="keywords" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">关键词以英文逗号隔开</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">摘要</label>
    <div class="col-sm-6">
        <textarea  class="form-control" rows="6" name="description" placeholder=""></textarea>
    </div>
    <p class="help-block col-sm-4 red">留空时默认截取内容的前250个字符</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">内容</label>
    <div class="col-sm-6">
         <!-- 声明使用 TagLib -->
         
         <!-- 在需要使用 标签的地方插入 -->
         <!-- 配置文件 --><script type='text/javascript' src='__OTHER__/ueditor/ueditor.config.js'></script><!-- 编辑器源码文件 --><script type='text/javascript' src='__OTHER__/ueditor/ueditor.all.min.js'></script><!-- 字体文件 --><script type='text/javascript' charset='utf-8' src='__OTHER__/ueditor/lang/zh-cn/zh-cn.js'></script><!-- 加载编辑器的容器 --><script id='content' name='content' type='text/plain'></script><!-- 实例化编辑器 -->
                    <script>
                        var um = UE.getEditor('content',{
                            initialFrameWidth:'100%',
                            initialFrameHeight:'300',
                            toolbars: [[
                                'fullscreen',  'undo', 'redo', '|',
                                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                                'directionalityltr', 'directionalityrtl', 'indent', '|',
                                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                                'link', 'unlink', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                                'simpleupload', 'emotion', 'scrawl', 'insertvideo', 'music', 'map',   'insertcode', 'template', '|',
                                'horizontal', 'date', 'time', 'spechars', '|',
                                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                                 'searchreplace', 'drafts'
                            ]],
                            autoHeightEnabled:false,
                            catchRemoteImageEnable:true
                        });
                    </script>
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

                            <?php elseif($model == 2): ?>
                                <!-- 文章模型 -->
                                <div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">标题</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="title" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">是否推荐</label>
    <div class="col-sm-6">
        <label style="margin-top:5px; ">
            <input class="checkbox-slider toggle colored-blue" type="checkbox" checked="checked" name="is_recommend" value="1">
            <span class="text"></span>
        </label>
    </div>
    <p class="help-block col-sm-4 red">用于前台推荐调用</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">是否置顶</label>
    <div class="col-sm-6">
        <label style="margin-top:5px; ">
            <input class="checkbox-slider toggle colored-blue" type="checkbox" checked="checked" name="is_top" value="1">
            <span class="text"></span>
        </label>
    </div>
    <p class="help-block col-sm-4 red">用于前台置顶调用</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">缩略图</label>
    <div class="col-sm-6">
        <?php echo uploadImg(['image_url']); ?>
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">关键词</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="keywords" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">关键词以英文逗号隔开</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">摘要</label>
    <div class="col-sm-6">
        <textarea  class="form-control" rows="6" name="description" placeholder=""></textarea>
    </div>
    <p class="help-block col-sm-4 red">留空时默认截取内容的前250个字符</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">内容</label>
    <div class="col-sm-6">
        <!-- 声明使用 TagLib -->
         
         <!-- 在需要使用编辑器 标签的地方插入 -->
         <!-- 配置文件 --><script type='text/javascript' src='__OTHER__/ueditor/ueditor.config.js'></script><!-- 编辑器源码文件 --><script type='text/javascript' src='__OTHER__/ueditor/ueditor.all.min.js'></script><!-- 字体文件 --><script type='text/javascript' charset='utf-8' src='__OTHER__/ueditor/lang/zh-cn/zh-cn.js'></script><!-- 加载编辑器的容器 --><script id='content' name='content' type='text/plain'></script><!-- 实例化编辑器 -->
                    <script>
                        var um = UE.getEditor('content',{
                            initialFrameWidth:'100%',
                            initialFrameHeight:'300',
                            toolbars: [[
                                'fullscreen',  'undo', 'redo', '|',
                                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                                'directionalityltr', 'directionalityrtl', 'indent', '|',
                                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                                'link', 'unlink', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                                'simpleupload', 'emotion', 'scrawl', 'insertvideo', 'music', 'map',   'insertcode', 'template', '|',
                                'horizontal', 'date', 'time', 'spechars', '|',
                                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                                 'searchreplace', 'drafts'
                            ]],
                            autoHeightEnabled:false,
                            catchRemoteImageEnable:true
                        });
                    </script>
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">添加时间</label>
    <div class="col-sm-6">
        <!-- 在需要使用时间插件 标签的地方插入 -->
        <!-- 样式 --><link rel='stylesheet' href='__OTHER__/layui/css/layui.css'><!-- 样式 --><link rel='stylesheet' href='__OTHER__/layui/css/modules/laydate/default/laydate.css'><!-- js文件 --><script type='text/javascript' src='__OTHER__/layui/layui.js'></script><input class='form-control' id='create_time' placeholder='create_time' name='create_time' value='<?php echo date('Y-m-d H:i:s');?>'  type='text' /><!-- 实例化编辑器 -->
                    <script>
                    $(function(){
                        layui.use('laydate', function(){
                            var laydate = layui.laydate;
                              
                            //创建时间
                            laydate.render({
                                elem: '#create_time'
                                ,type: 'datetime'
                                ,theme: 'grid'
                            });
                        });
                    })
                    </script>
    </div>
    <div class="col-sm-3">
    </div>
    <p class="help-block col-sm-2 red">默认是当前时间</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">点击量</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="clicks" required="" type="text" value="50">
    </div>
    <p class="help-block col-sm-4 red">请输入数字</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">链接地址</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="url" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">请输入url</p>
</div>
                            <?php elseif($model == 3): ?>
                                <!-- 图集模型 -->
                                <div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">标题</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="title" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">是否推荐</label>
    <div class="col-sm-6">
        <label style="margin-top:5px; ">
            <input class="checkbox-slider toggle colored-blue" type="checkbox" checked="checked" name="is_recommend" value="1">
            <span class="text"></span>
        </label>
    </div>
    <p class="help-block col-sm-4 red">用于前台推荐调用</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">是否置顶</label>
    <div class="col-sm-6">
        <label style="margin-top:5px; ">
            <input class="checkbox-slider toggle colored-blue" type="checkbox" checked="checked" name="is_top" value="1">
            <span class="text"></span>
        </label>
    </div>
    <p class="help-block col-sm-4 red">用于前台置顶调用</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">图集描述</label>
    <div class="col-sm-6">
        <textarea  class="form-control" rows="6" name="description" placeholder=""></textarea>
    </div>
    <p class="help-block col-sm-4 red">留空时默认截取内容的前250个字符</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">图集上传</label>
    <div class="col-sm-6">
        <!-- 声明使用 TagLib -->
         
         <!-- 在需要使用 标签的地方插入 -->
         <!--引入样式jq-->
<link rel="stylesheet" href="__OTHER__/webuploader/xb-webuploader.css">
<style type="text/css">
    .xb-uploader{border: 3px dashed #e6e6e6;padding-top: 10px;}
    .filelist li{margin-left: 2px;}
</style>

<!-- 引入html -->
<div id="upload-5a7c142eb41b4" class="xb-uploader">
    <div class="queueList">
        <div class="placeholder">
            <div class="filePicker"></div>
            <p>或将文件拖到这里，单次最多可选5个,最大不能超过5M</p>
        </div>
    </div>
    <div class="statusBar" style="display:none;">
        <div class="progress">
            <span class="text">0%</span>
            <span class="percentage"></span>
        </div>
        <div class="info"></div>
        <div class="btns">
            <div class="webuploader-container filePicker2">
                <div class="webuploader-pick">继续添加</div>
                <div style="position: absolute; top: 0px; left: 0px; width: 1px; height: 1px; overflow: hidden;" id="rt_rt_1armv2159g1o1i9c2a313hadij6">
                </div>
            </div>
            <div class="uploadBtn">开始上传</div>
        </div>
    </div>
</div>

<!-- 引入webupload.js主文件 -->
<script src="__OTHER__/webuploader/webuploader.min.js"></script>
<!-- 引入webupload.js配置 -->
<script>
jQuery(function() {
    var $ = jQuery,    // just in case. Make sure it's not an other libaray.

        $wrap = $("#upload-5a7c142eb41b4"),

        // 图片容器
        $queue = $('<ul class="filelist"></ul>')
            .appendTo( $wrap.find('.queueList') ),

        // 状态栏，包括进度和控制按钮
        $statusBar = $wrap.find('.statusBar'),

        // 文件总体选择信息。
        $info = $statusBar.find('.info'),

        // 上传按钮
        $upload = $wrap.find('.uploadBtn'),

        // 没选择文件之前的内容。
        $placeHolder = $wrap.find('.placeholder'),

        // 总体进度条
        $progress = $statusBar.find('.progress').hide(),

        // 添加的文件数量
        fileCount = 0,

        // 添加的文件总大小
        fileSize = 0,

        // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 1,

        // 缩略图大小
        thumbnailWidth = 110 * ratio,
        thumbnailHeight = 110 * ratio,

        // 可能有pedding, ready, uploading, confirm, done.
        state = 'pedding',

        // 所有文件的进度信息，key为file id
        percentages = {},

        supportTransition = (function(){
            var s = document.createElement('p').style,
                r = 'transition' in s ||
                      'WebkitTransition' in s ||
                      'MozTransition' in s ||
                      'msTransition' in s ||
                      'OTransition' in s;
            s = null;
            return r;
        })(),
        thisSuccess,
        // WebUploader实例
        uploader;

    if ( !WebUploader.Uploader.support() ) {
        alert( 'Web Uploader 不支持您的浏览器！如果你使用的是IE浏览器，请尝试升级 flash 播放器');
        throw new Error( 'WebUploader does not support the browser you are using.' );
    }

    // 实例化
    uploader = WebUploader.create({
        pick: {
            id: "#upload-5a7c142eb41b4 .filePicker",
            label: "点击上传图片",
            multiple : true
        },
        dnd: "#upload-5a7c142eb41b4 .queueList",
        paste: document.body,
        // accept: {
        //     title: 'Images',
        //     extensions: 'gif,jpg,jpeg,bmp,png',
        //     mimeTypes: 'image/*'
        // },

        // swf文件路径
        swf:"__OTHER__/webuploader/Uploader.swf",

        disableGlobalDnd: true,

        chunked: true,//是否要分片处理大文件上传。
        server: "<?php echo url('add'); ?>",//服务器地址
        fileNumLimit: 5,//文件上传个数
        fileSizeLimit:5 * 1024 * 1024,    // 200 M
        fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M
    });

    // 添加“添加文件”的按钮，
    uploader.addButton({
       id: "#upload-5a7c142eb41b4 .filePicker2",
       label: '继续添加'
    });

    // 当有文件添加进来时执行，负责view的创建
    function addFile( file ) {
        var $li = $( '<li id="' + file.id + '">' +
                '<p class="title">' + file.name + '</p>' +
                '<p class="imgWrap"></p>'+
                '<p class="progress"><span></span></p>' +
                '<input class="bjy-filename" type="hidden" name="avatar[]">'+
                '</li>' ),

            $btns = $('<div class="file-panel">' +
                '<span class="cancel">删除</span>' +
                '<span class="rotateRight">向右旋转</span>' +
                '<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
            $prgress = $li.find('p.progress span'),
            $wrap = $li.find( 'p.imgWrap' ),
            $info = $('<p class="error"></p>'),

            showError = function( code ) {
                switch( code ) {
                    case 'exceed_size':
                        text = '文件大小超出';
                        break;

                    case 'interrupt':
                        text = '上传暂停';
                        break;

                    default:
                        text = '上传失败，请重试';
                        break;
                }

                $info.text( text ).appendTo( $li );
            };

        if ( file.getStatus() === 'invalid' ) {
            showError( file.statusText );
        } else {
            // @todo lazyload
            $wrap.text( '预览中' );
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $wrap.text( '不能预览' );
                    return;
                }

                var img = $('<img src="'+src+'">');
                $wrap.empty().append( img );
            }, thumbnailWidth, thumbnailHeight );

            percentages[ file.id ] = [ file.size, 0 ];
            file.rotation = 0;
        }

        file.on('statuschange', function( cur, prev ) {
            if ( prev === 'progress' ) {
                $prgress.hide().width(0);
            } else if ( prev === 'queued' ) {
                $li.off( 'mouseenter mouseleave' );
                $btns.remove();
            }

            // 成功
            if ( cur === 'error' || cur === 'invalid' ) {
                showError( file.statusText );
                percentages[ file.id ][ 1 ] = 1;
            } else if ( cur === 'interrupt' ) {
                showError( 'interrupt' );
            } else if ( cur === 'queued' ) {
                percentages[ file.id ][ 1 ] = 0;
            } else if ( cur === 'progress' ) {
                $info.remove();
                $prgress.css('display', 'block');
            } else if ( cur === 'complete' ) {
                $li.append( '<span class="success"></span>' );
            }

            $li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
        });

        $li.on( 'mouseenter', function() {
            $btns.stop().animate({height: 30});
        });

        $li.on( 'mouseleave', function() {
            $btns.stop().animate({height: 0});
        });

        $btns.on( 'click', 'span', function() {
            var index = $(this).index(),
                deg;

            switch ( index ) {
                case 0:
                    uploader.removeFile( file );
                    return;

                case 1:
                    file.rotation += 90;
                    break;

                case 2:
                    file.rotation -= 90;
                    break;
            }

            if ( supportTransition ) {
                deg = 'rotate(' + file.rotation + 'deg)';
                $wrap.css({
                    '-webkit-transform': deg,
                    '-mos-transform': deg,
                    '-o-transform': deg,
                    'transform': deg
                });
            } else {
                $wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');
                // use jquery animate to rotation
                // $({
                //     rotation: rotation
                // }).animate({
                //     rotation: file.rotation
                // }, {
                //     easing: 'linear',
                //     step: function( now ) {
                //         now = now * Math.PI / 180;

                //         var cos = Math.cos( now ),
                //             sin = Math.sin( now );

                //         $wrap.css( 'filter', "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + ",M12=" + (-sin) + ",M21=" + sin + ",M22=" + cos + ",SizingMethod='auto expand')");
                //     }
                // });
            }


        });

        $li.appendTo( $queue );
    }

    // 负责view的销毁
    function removeFile( file ) {
        var $li = $('#'+file.id);

        delete percentages[ file.id ];
        updateTotalProgress();
        $li.off().find('.file-panel').off().end().remove();
    }

    function updateTotalProgress() {
        var loaded = 0,
            total = 0,
            spans = $progress.children(),
            percent;

        $.each( percentages, function( k, v ) {
            total += v[ 0 ];
            loaded += v[ 0 ] * v[ 1 ];
        } );

        percent = total ? loaded / total : 0;

        spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
        spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
        updateStatus();
    }

    function updateStatus() {
        var text = '', stats;

        if ( state === 'ready' ) {
            text = '选中' + fileCount + '个文件，共' +
                    WebUploader.formatSize( fileSize ) + '。';
        } else if ( state === 'confirm' ) {
            stats = uploader.getStats();
            if ( stats.uploadFailNum ) {
                text = '已成功上传' + stats.successNum+ '个文件，'+
                    stats.uploadFailNum + '个上传失败，<a class="retry" href="#">重新上传</a>失败文件或<a class="ignore" href="#">忽略</a>'
            }

        } else {
            stats = uploader.getStats();
            text = '共' + fileCount + '个（' +
                    WebUploader.formatSize( fileSize )  +
                    '），已上传' + stats.successNum + '个';

            if ( stats.uploadFailNum ) {
                text += '，失败' + stats.uploadFailNum + '个';
            }
            if (fileCount==stats.successNum && stats.successNum!=0) {
                $('#upload-5a7c142eb41b4 .webuploader-element-invisible').remove();
            }
        }

        $info.html( text );
    }

    uploader.onUploadAccept=function(object ,ret){
        if(ret.error_info){
            fileError=ret.error_info;
            return false;
        }
    }

    uploader.onUploadSuccess=function(file ,response){
        console.log(response);
        $('#'+file.id +' .bjy-filename').val(response.data)
    }
    uploader.onUploadError=function(file){
        alert(fileError);
    }

    function setState( val ) {
        var file, stats;
        if ( val === state ) {
            return;
        }

        $upload.removeClass( 'state-' + state );
        $upload.addClass( 'state-' + val );
        state = val;

        switch ( state ) {
            case 'pedding':
                $placeHolder.removeClass( 'element-invisible' );
                $queue.parent().removeClass('filled');
                $queue.hide();
                $statusBar.addClass( 'element-invisible' );
                uploader.refresh();
                break;

            case 'ready':
                $placeHolder.addClass( 'element-invisible' );
                $( "#upload-5a7c142eb41b4 .filePicker2" ).removeClass( 'element-invisible');
                $queue.parent().addClass('filled');
                $queue.show();
                $statusBar.removeClass('element-invisible');
                uploader.refresh();
                break;

            case 'uploading':
                $( "#upload-5a7c142eb41b4 .filePicker2" ).addClass( 'element-invisible' );
                $progress.show();
                $upload.text( '暂停上传' );
                break;

            case 'paused':
                $progress.show();
                $upload.text( '继续上传' );
                break;

            case 'confirm':
                $progress.hide();
                $upload.text( '开始上传' ).addClass( 'disabled' );

                stats = uploader.getStats();
                if ( stats.successNum && !stats.uploadFailNum ) {
                    setState( 'finish' );
                    return;
                }
                break;
            case 'finish':
                stats = uploader.getStats();
                if ( stats.successNum ) {
                    
                } else {
                    // 没有成功的图片，重设
                    state = 'done';
                    location.reload();
                }
                break;
        }
        updateStatus();
    }

    uploader.onUploadProgress = function( file, percentage ) {
        var $li = $('#'+file.id),
            $percent = $li.find('.progress span');

        $percent.css( 'width', percentage * 100 + '%' );
        percentages[ file.id ][ 1 ] = percentage;
        updateTotalProgress();
    };

    uploader.onFileQueued = function( file ) {
        fileCount++;
        fileSize += file.size;

        if ( fileCount === 1 ) {
            $placeHolder.addClass( 'element-invisible' );
            $statusBar.show();
        }

        addFile( file );
        setState( 'ready' );
        updateTotalProgress();
    };

    uploader.onFileDequeued = function( file ) {
        fileCount--;
        fileSize -= file.size;

        if ( !fileCount ) {
            setState( 'pedding' );
        }

        removeFile( file );
        updateTotalProgress();

    };

    uploader.on( 'all', function( type ) {
        var stats;
        switch( type ) {
            case 'uploadFinished':
                setState( 'confirm' );
                break;

            case 'startUpload':
                setState( 'uploading' );
                break;

            case 'stopUpload':
                setState( 'paused' );
                break;

        }
    });

    uploader.onError = function( code ) {
        if(code === 'F_DUPLICATE'){
            alert('不能重复上传同一张图片');
        }else{
            alert( 'Eroor: ' + code );
        }
            
        
    };

    $upload.on('click', function() {
        if ( $(this).hasClass( 'disabled' ) ) {
            return false;
        }

        if ( state === 'ready' ) {
            uploader.upload();
        } else if ( state === 'paused' ) {
            uploader.upload();
        } else if ( state === 'uploading' ) {
            uploader.stop();
        }
    });

    $info.on( 'click', '.retry', function() {
        uploader.retry();
    } );

    $info.on( 'click', '.ignore', function() {
        alert( 'todo' );
    } );

    $upload.addClass( 'state-' + state );
    updateTotalProgress();
});
</script>
    </div>
    <p class="help-block col-sm-4 red">默认第一张为主图</p>
</div>


<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">内容</label>
    <div class="col-sm-6">
         <!-- 声明使用 TagLib -->
         
         <!-- 在需要使用 标签的地方插入 -->
         <!-- 配置文件 --><script type='text/javascript' src='__OTHER__/ueditor/ueditor.config.js'></script><!-- 编辑器源码文件 --><script type='text/javascript' src='__OTHER__/ueditor/ueditor.all.min.js'></script><!-- 字体文件 --><script type='text/javascript' charset='utf-8' src='__OTHER__/ueditor/lang/zh-cn/zh-cn.js'></script><!-- 加载编辑器的容器 --><script id='content' name='content' type='text/plain'></script><!-- 实例化编辑器 -->
                    <script>
                        var um = UE.getEditor('content',{
                            initialFrameWidth:'100%',
                            initialFrameHeight:'300',
                            toolbars: [[
                                'fullscreen',  'undo', 'redo', '|',
                                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                                'directionalityltr', 'directionalityrtl', 'indent', '|',
                                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                                'link', 'unlink', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                                'simpleupload', 'emotion', 'scrawl', 'insertvideo', 'music', 'map',   'insertcode', 'template', '|',
                                'horizontal', 'date', 'time', 'spechars', '|',
                                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                                 'searchreplace', 'drafts'
                            ]],
                            autoHeightEnabled:false,
                            catchRemoteImageEnable:true
                        });
                    </script>
    </div>
    <p class="help-block col-sm-4 red"></p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">添加时间</label>
    <div class="col-sm-2">
        <input class="form-control" id="create_time" placeholder="<?php echo date('Y-m-d H:i:s'); ?>" value="<?php echo date('Y-m-d H:i:s'); ?>" name="create_time" required="" type="text">
    </div>
    <div class="col-sm-4">
    </div>
    <p class="help-block col-sm-4 red">默认是当前时间</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">点击量</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="clicks" required="" type="text" value="50">
    </div>
    <p class="help-block col-sm-4 red">请输入数字</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">链接地址</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="url" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">请输入url</p>
</div>
                            <?php elseif($model == 4): ?>
                                <!-- 链接模型 -->
                                <div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">标题</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="title" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">缩略图</label>
    <div class="col-sm-6">
        <?php echo uploadImg(['image_url']); ?>
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>


<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">链接地址</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="http://或者https://开头" name="url" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">请输入url</p>
</div>


<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">链接描述</label>
    <div class="col-sm-6">
        <textarea  class="form-control" rows="6" name="description" placeholder=""></textarea>
    </div>
    <p class="help-block col-sm-4 red"></p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">是否推荐</label>
    <div class="col-sm-6">
        <label style="margin-top:5px; ">
            <input class="checkbox-slider toggle colored-blue" type="checkbox" checked="checked" name="is_recommend" value="1">
            <span class="text"></span>
        </label>
    </div>
    <p class="help-block col-sm-4 red">用于前台推荐调用</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">是否置顶</label>
    <div class="col-sm-6">
        <label style="margin-top:5px; ">
            <input class="checkbox-slider toggle colored-blue" type="checkbox" checked="checked" name="is_top" value="1">
            <span class="text"></span>
        </label>
    </div>
    <p class="help-block col-sm-4 red">用于前台置顶调用</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">添加时间</label>
    <div class="col-sm-2">
        <input class="form-control" id="create_time" placeholder="<?php echo date('Y-m-d H:i:s'); ?>" value="<?php echo date('Y-m-d H:i:s'); ?>" name="create_time" required="" type="text">
    </div>
    <div class="col-sm-4">
    </div>
    <p class="help-block col-sm-4 red">默认是当前时间</p>
</div>


                            <?php elseif($model == 5): ?>
                                <!-- 下载模型 -->
                                <div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">标题</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="title" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">缩略图</label>
    <div class="col-sm-6">
        <?php echo uploadImg(['image_url']); ?>
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>


<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">下载文件</label>
    <div class="col-sm-6">
        <!-- 声明使用 TagLib -->
         
         <!-- 在需要使用 标签的地方插入 -->
         <!--引入样式jq-->
<link rel="stylesheet" href="__OTHER__/webuploader/xb-webuploader.css">
<style type="text/css">
    .xb-uploader{border: 3px dashed #e6e6e6;padding-top: 10px;}
    .filelist li{margin-left: 2px;}
</style>

<!-- 引入html -->
<div id="upload-5a7c142eb459c" class="xb-uploader">
    <div class="queueList">
        <div class="placeholder">
            <div class="filePicker"></div>
            <p>或将文件拖到这里，单次最多可选1个,最大不能超过5M</p>
        </div>
    </div>
    <div class="statusBar" style="display:none;">
        <div class="progress">
            <span class="text">0%</span>
            <span class="percentage"></span>
        </div>
        <div class="info"></div>
        <div class="btns">
            <div class="webuploader-container filePicker2">
                <div class="webuploader-pick">继续添加</div>
                <div style="position: absolute; top: 0px; left: 0px; width: 1px; height: 1px; overflow: hidden;" id="rt_rt_1armv2159g1o1i9c2a313hadij6">
                </div>
            </div>
            <div class="uploadBtn">开始上传</div>
        </div>
    </div>
</div>

<!-- 引入webupload.js主文件 -->
<script src="__OTHER__/webuploader/webuploader.min.js"></script>
<!-- 引入webupload.js配置 -->
<script>
jQuery(function() {
    var $ = jQuery,    // just in case. Make sure it's not an other libaray.

        $wrap = $("#upload-5a7c142eb459c"),

        // 图片容器
        $queue = $('<ul class="filelist"></ul>')
            .appendTo( $wrap.find('.queueList') ),

        // 状态栏，包括进度和控制按钮
        $statusBar = $wrap.find('.statusBar'),

        // 文件总体选择信息。
        $info = $statusBar.find('.info'),

        // 上传按钮
        $upload = $wrap.find('.uploadBtn'),

        // 没选择文件之前的内容。
        $placeHolder = $wrap.find('.placeholder'),

        // 总体进度条
        $progress = $statusBar.find('.progress').hide(),

        // 添加的文件数量
        fileCount = 0,

        // 添加的文件总大小
        fileSize = 0,

        // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 1,

        // 缩略图大小
        thumbnailWidth = 110 * ratio,
        thumbnailHeight = 110 * ratio,

        // 可能有pedding, ready, uploading, confirm, done.
        state = 'pedding',

        // 所有文件的进度信息，key为file id
        percentages = {},

        supportTransition = (function(){
            var s = document.createElement('p').style,
                r = 'transition' in s ||
                      'WebkitTransition' in s ||
                      'MozTransition' in s ||
                      'msTransition' in s ||
                      'OTransition' in s;
            s = null;
            return r;
        })(),
        thisSuccess,
        // WebUploader实例
        uploader;

    if ( !WebUploader.Uploader.support() ) {
        alert( 'Web Uploader 不支持您的浏览器！如果你使用的是IE浏览器，请尝试升级 flash 播放器');
        throw new Error( 'WebUploader does not support the browser you are using.' );
    }

    // 实例化
    uploader = WebUploader.create({
        pick: {
            id: "#upload-5a7c142eb459c .filePicker",
            label: "点击上传文件",
            multiple : true
        },
        dnd: "#upload-5a7c142eb459c .queueList",
        paste: document.body,
        // accept: {
        //     title: 'Images',
        //     extensions: 'gif,jpg,jpeg,bmp,png',
        //     mimeTypes: 'image/*'
        // },

        // swf文件路径
        swf:"__OTHER__/webuploader/Uploader.swf",

        disableGlobalDnd: true,

        chunked: true,//是否要分片处理大文件上传。
        server: "<?php echo url('add'); ?>",//服务器地址
        fileNumLimit: 1,//文件上传个数
        fileSizeLimit:5 * 1024 * 1024,    // 200 M
        fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M
    });

    // 添加“添加文件”的按钮，
    uploader.addButton({
       id: "#upload-5a7c142eb459c .filePicker2",
       label: '继续添加'
    });

    // 当有文件添加进来时执行，负责view的创建
    function addFile( file ) {
        var $li = $( '<li id="' + file.id + '">' +
                '<p class="title">' + file.name + '</p>' +
                '<p class="imgWrap"></p>'+
                '<p class="progress"><span></span></p>' +
                '<input class="bjy-filename" type="hidden" name="avatar[]">'+
                '</li>' ),

            $btns = $('<div class="file-panel">' +
                '<span class="cancel">删除</span>' +
                '<span class="rotateRight">向右旋转</span>' +
                '<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
            $prgress = $li.find('p.progress span'),
            $wrap = $li.find( 'p.imgWrap' ),
            $info = $('<p class="error"></p>'),

            showError = function( code ) {
                switch( code ) {
                    case 'exceed_size':
                        text = '文件大小超出';
                        break;

                    case 'interrupt':
                        text = '上传暂停';
                        break;

                    default:
                        text = '上传失败，请重试';
                        break;
                }

                $info.text( text ).appendTo( $li );
            };

        if ( file.getStatus() === 'invalid' ) {
            showError( file.statusText );
        } else {
            // @todo lazyload
            $wrap.text( '预览中' );
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $wrap.text( '不能预览' );
                    return;
                }

                var img = $('<img src="'+src+'">');
                $wrap.empty().append( img );
            }, thumbnailWidth, thumbnailHeight );

            percentages[ file.id ] = [ file.size, 0 ];
            file.rotation = 0;
        }

        file.on('statuschange', function( cur, prev ) {
            if ( prev === 'progress' ) {
                $prgress.hide().width(0);
            } else if ( prev === 'queued' ) {
                $li.off( 'mouseenter mouseleave' );
                $btns.remove();
            }

            // 成功
            if ( cur === 'error' || cur === 'invalid' ) {
                showError( file.statusText );
                percentages[ file.id ][ 1 ] = 1;
            } else if ( cur === 'interrupt' ) {
                showError( 'interrupt' );
            } else if ( cur === 'queued' ) {
                percentages[ file.id ][ 1 ] = 0;
            } else if ( cur === 'progress' ) {
                $info.remove();
                $prgress.css('display', 'block');
            } else if ( cur === 'complete' ) {
                $li.append( '<span class="success"></span>' );
            }

            $li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
        });

        $li.on( 'mouseenter', function() {
            $btns.stop().animate({height: 30});
        });

        $li.on( 'mouseleave', function() {
            $btns.stop().animate({height: 0});
        });

        $btns.on( 'click', 'span', function() {
            var index = $(this).index(),
                deg;

            switch ( index ) {
                case 0:
                    uploader.removeFile( file );
                    return;

                case 1:
                    file.rotation += 90;
                    break;

                case 2:
                    file.rotation -= 90;
                    break;
            }

            if ( supportTransition ) {
                deg = 'rotate(' + file.rotation + 'deg)';
                $wrap.css({
                    '-webkit-transform': deg,
                    '-mos-transform': deg,
                    '-o-transform': deg,
                    'transform': deg
                });
            } else {
                $wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');
                // use jquery animate to rotation
                // $({
                //     rotation: rotation
                // }).animate({
                //     rotation: file.rotation
                // }, {
                //     easing: 'linear',
                //     step: function( now ) {
                //         now = now * Math.PI / 180;

                //         var cos = Math.cos( now ),
                //             sin = Math.sin( now );

                //         $wrap.css( 'filter', "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + ",M12=" + (-sin) + ",M21=" + sin + ",M22=" + cos + ",SizingMethod='auto expand')");
                //     }
                // });
            }


        });

        $li.appendTo( $queue );
    }

    // 负责view的销毁
    function removeFile( file ) {
        var $li = $('#'+file.id);

        delete percentages[ file.id ];
        updateTotalProgress();
        $li.off().find('.file-panel').off().end().remove();
    }

    function updateTotalProgress() {
        var loaded = 0,
            total = 0,
            spans = $progress.children(),
            percent;

        $.each( percentages, function( k, v ) {
            total += v[ 0 ];
            loaded += v[ 0 ] * v[ 1 ];
        } );

        percent = total ? loaded / total : 0;

        spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
        spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
        updateStatus();
    }

    function updateStatus() {
        var text = '', stats;

        if ( state === 'ready' ) {
            text = '选中' + fileCount + '个文件，共' +
                    WebUploader.formatSize( fileSize ) + '。';
        } else if ( state === 'confirm' ) {
            stats = uploader.getStats();
            if ( stats.uploadFailNum ) {
                text = '已成功上传' + stats.successNum+ '个文件，'+
                    stats.uploadFailNum + '个上传失败，<a class="retry" href="#">重新上传</a>失败文件或<a class="ignore" href="#">忽略</a>'
            }

        } else {
            stats = uploader.getStats();
            text = '共' + fileCount + '个（' +
                    WebUploader.formatSize( fileSize )  +
                    '），已上传' + stats.successNum + '个';

            if ( stats.uploadFailNum ) {
                text += '，失败' + stats.uploadFailNum + '个';
            }
            if (fileCount==stats.successNum && stats.successNum!=0) {
                $('#upload-5a7c142eb459c .webuploader-element-invisible').remove();
            }
        }

        $info.html( text );
    }

    uploader.onUploadAccept=function(object ,ret){
        if(ret.error_info){
            fileError=ret.error_info;
            return false;
        }
    }

    uploader.onUploadSuccess=function(file ,response){
        console.log(response);
        $('#'+file.id +' .bjy-filename').val(response.data)
    }
    uploader.onUploadError=function(file){
        alert(fileError);
    }

    function setState( val ) {
        var file, stats;
        if ( val === state ) {
            return;
        }

        $upload.removeClass( 'state-' + state );
        $upload.addClass( 'state-' + val );
        state = val;

        switch ( state ) {
            case 'pedding':
                $placeHolder.removeClass( 'element-invisible' );
                $queue.parent().removeClass('filled');
                $queue.hide();
                $statusBar.addClass( 'element-invisible' );
                uploader.refresh();
                break;

            case 'ready':
                $placeHolder.addClass( 'element-invisible' );
                $( "#upload-5a7c142eb459c .filePicker2" ).removeClass( 'element-invisible');
                $queue.parent().addClass('filled');
                $queue.show();
                $statusBar.removeClass('element-invisible');
                uploader.refresh();
                break;

            case 'uploading':
                $( "#upload-5a7c142eb459c .filePicker2" ).addClass( 'element-invisible' );
                $progress.show();
                $upload.text( '暂停上传' );
                break;

            case 'paused':
                $progress.show();
                $upload.text( '继续上传' );
                break;

            case 'confirm':
                $progress.hide();
                $upload.text( '开始上传' ).addClass( 'disabled' );

                stats = uploader.getStats();
                if ( stats.successNum && !stats.uploadFailNum ) {
                    setState( 'finish' );
                    return;
                }
                break;
            case 'finish':
                stats = uploader.getStats();
                if ( stats.successNum ) {
                    
                } else {
                    // 没有成功的图片，重设
                    state = 'done';
                    location.reload();
                }
                break;
        }
        updateStatus();
    }

    uploader.onUploadProgress = function( file, percentage ) {
        var $li = $('#'+file.id),
            $percent = $li.find('.progress span');

        $percent.css( 'width', percentage * 100 + '%' );
        percentages[ file.id ][ 1 ] = percentage;
        updateTotalProgress();
    };

    uploader.onFileQueued = function( file ) {
        fileCount++;
        fileSize += file.size;

        if ( fileCount === 1 ) {
            $placeHolder.addClass( 'element-invisible' );
            $statusBar.show();
        }

        addFile( file );
        setState( 'ready' );
        updateTotalProgress();
    };

    uploader.onFileDequeued = function( file ) {
        fileCount--;
        fileSize -= file.size;

        if ( !fileCount ) {
            setState( 'pedding' );
        }

        removeFile( file );
        updateTotalProgress();

    };

    uploader.on( 'all', function( type ) {
        var stats;
        switch( type ) {
            case 'uploadFinished':
                setState( 'confirm' );
                break;

            case 'startUpload':
                setState( 'uploading' );
                break;

            case 'stopUpload':
                setState( 'paused' );
                break;

        }
    });

    uploader.onError = function( code ) {
        if(code === 'F_DUPLICATE'){
            alert('不能重复上传同一张图片');
        }else{
            alert( 'Eroor: ' + code );
        }
            
        
    };

    $upload.on('click', function() {
        if ( $(this).hasClass( 'disabled' ) ) {
            return false;
        }

        if ( state === 'ready' ) {
            uploader.upload();
        } else if ( state === 'paused' ) {
            uploader.upload();
        } else if ( state === 'uploading' ) {
            uploader.stop();
        }
    });

    $info.on( 'click', '.retry', function() {
        uploader.retry();
    } );

    $info.on( 'click', '.ignore', function() {
        alert( 'todo' );
    } );

    $upload.addClass( 'state-' + state );
    updateTotalProgress();
});
</script>
    </div>
    <p class="help-block col-sm-4 red"></p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">文件名</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="keywords" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red"></p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">演示地址</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="http://或者https://开头" name="keywords" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red"></p>
</div>




<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">添加时间</label>
    <div class="col-sm-2">
        <input class="form-control" id="create_time" placeholder="<?php echo date('Y-m-d H:i:s'); ?>" value="<?php echo date('Y-m-d H:i:s'); ?>" name="create_time" required="" type="text">
    </div>
    <div class="col-sm-4">
    </div>
    <p class="help-block col-sm-4 red">默认是当前时间</p>
</div>


<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">是否推荐</label>
    <div class="col-sm-6">
        <label style="margin-top:5px; ">
            <input class="checkbox-slider toggle colored-blue" type="checkbox" checked="checked" name="is_recommend" value="1">
            <span class="text"></span>
        </label>
    </div>
    <p class="help-block col-sm-4 red">用于前台推荐调用</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">是否置顶</label>
    <div class="col-sm-6">
        <label style="margin-top:5px; ">
            <input class="checkbox-slider toggle colored-blue" type="checkbox" checked="checked" name="is_top" value="1">
            <span class="text"></span>
        </label>
    </div>
    <p class="help-block col-sm-4 red">用于前台置顶调用</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">文件描述</label>
    <div class="col-sm-6">
        <textarea  class="form-control" rows="6" name="description" placeholder=""></textarea>
    </div>
    <p class="help-block col-sm-4 red"></p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">链接地址</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="url" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">请输入url</p>
</div>
                            <?php else: ?>
                                <!-- 默认文章模型 -->
                                <div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">标题</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="title" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">是否推荐</label>
    <div class="col-sm-6">
        <label style="margin-top:5px; ">
            <input class="checkbox-slider toggle colored-blue" type="checkbox" checked="checked" name="is_recommend" value="1">
            <span class="text"></span>
        </label>
    </div>
    <p class="help-block col-sm-4 red">用于前台推荐调用</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">是否置顶</label>
    <div class="col-sm-6">
        <label style="margin-top:5px; ">
            <input class="checkbox-slider toggle colored-blue" type="checkbox" checked="checked" name="is_top" value="1">
            <span class="text"></span>
        </label>
    </div>
    <p class="help-block col-sm-4 red">用于前台置顶调用</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">缩略图</label>
    <div class="col-sm-6">
        <?php echo uploadImg(['image_url']); ?>
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">关键词</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="keywords" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">关键词以英文逗号隔开</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">摘要</label>
    <div class="col-sm-6">
        <textarea  class="form-control" rows="6" name="description" placeholder=""></textarea>
    </div>
    <p class="help-block col-sm-4 red">留空时默认截取内容的前250个字符</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">内容</label>
    <div class="col-sm-6">
        <!-- 声明使用 TagLib -->
         
         <!-- 在需要使用编辑器 标签的地方插入 -->
         <!-- 配置文件 --><script type='text/javascript' src='__OTHER__/ueditor/ueditor.config.js'></script><!-- 编辑器源码文件 --><script type='text/javascript' src='__OTHER__/ueditor/ueditor.all.min.js'></script><!-- 字体文件 --><script type='text/javascript' charset='utf-8' src='__OTHER__/ueditor/lang/zh-cn/zh-cn.js'></script><!-- 加载编辑器的容器 --><script id='content' name='content' type='text/plain'></script><!-- 实例化编辑器 -->
                    <script>
                        var um = UE.getEditor('content',{
                            initialFrameWidth:'100%',
                            initialFrameHeight:'300',
                            toolbars: [[
                                'fullscreen',  'undo', 'redo', '|',
                                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                                'directionalityltr', 'directionalityrtl', 'indent', '|',
                                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                                'link', 'unlink', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                                'simpleupload', 'emotion', 'scrawl', 'insertvideo', 'music', 'map',   'insertcode', 'template', '|',
                                'horizontal', 'date', 'time', 'spechars', '|',
                                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                                 'searchreplace', 'drafts'
                            ]],
                            autoHeightEnabled:false,
                            catchRemoteImageEnable:true
                        });
                    </script>
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">添加时间</label>
    <div class="col-sm-6">
        <!-- 在需要使用时间插件 标签的地方插入 -->
        <!-- 样式 --><link rel='stylesheet' href='__OTHER__/layui/css/layui.css'><!-- 样式 --><link rel='stylesheet' href='__OTHER__/layui/css/modules/laydate/default/laydate.css'><!-- js文件 --><script type='text/javascript' src='__OTHER__/layui/layui.js'></script><input class='form-control' id='create_time' placeholder='create_time' name='create_time' value='<?php echo date('Y-m-d H:i:s');?>'  type='text' /><!-- 实例化编辑器 -->
                    <script>
                    $(function(){
                        layui.use('laydate', function(){
                            var laydate = layui.laydate;
                              
                            //创建时间
                            laydate.render({
                                elem: '#create_time'
                                ,type: 'datetime'
                                ,theme: 'grid'
                            });
                        });
                    })
                    </script>
    </div>
    <div class="col-sm-3">
    </div>
    <p class="help-block col-sm-2 red">默认是当前时间</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">点击量</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="clicks" required="" type="text" value="50">
    </div>
    <p class="help-block col-sm-4 red">请输入数字</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">链接地址</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="url" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">请输入url</p>
</div>
                            <?php endif; else: ?>
                            <!-- 默认文章模型 -->
                            <div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">标题</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="title" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">是否推荐</label>
    <div class="col-sm-6">
        <label style="margin-top:5px; ">
            <input class="checkbox-slider toggle colored-blue" type="checkbox" checked="checked" name="is_recommend" value="1">
            <span class="text"></span>
        </label>
    </div>
    <p class="help-block col-sm-4 red">用于前台推荐调用</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">是否置顶</label>
    <div class="col-sm-6">
        <label style="margin-top:5px; ">
            <input class="checkbox-slider toggle colored-blue" type="checkbox" checked="checked" name="is_top" value="1">
            <span class="text"></span>
        </label>
    </div>
    <p class="help-block col-sm-4 red">用于前台置顶调用</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">缩略图</label>
    <div class="col-sm-6">
        <?php echo uploadImg(['image_url']); ?>
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">关键词</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="keywords" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">关键词以英文逗号隔开</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">摘要</label>
    <div class="col-sm-6">
        <textarea  class="form-control" rows="6" name="description" placeholder=""></textarea>
    </div>
    <p class="help-block col-sm-4 red">留空时默认截取内容的前250个字符</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">内容</label>
    <div class="col-sm-6">
        <!-- 声明使用 TagLib -->
         
         <!-- 在需要使用编辑器 标签的地方插入 -->
         <!-- 配置文件 --><script type='text/javascript' src='__OTHER__/ueditor/ueditor.config.js'></script><!-- 编辑器源码文件 --><script type='text/javascript' src='__OTHER__/ueditor/ueditor.all.min.js'></script><!-- 字体文件 --><script type='text/javascript' charset='utf-8' src='__OTHER__/ueditor/lang/zh-cn/zh-cn.js'></script><!-- 加载编辑器的容器 --><script id='content' name='content' type='text/plain'></script><!-- 实例化编辑器 -->
                    <script>
                        var um = UE.getEditor('content',{
                            initialFrameWidth:'100%',
                            initialFrameHeight:'300',
                            toolbars: [[
                                'fullscreen',  'undo', 'redo', '|',
                                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                                'directionalityltr', 'directionalityrtl', 'indent', '|',
                                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                                'link', 'unlink', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                                'simpleupload', 'emotion', 'scrawl', 'insertvideo', 'music', 'map',   'insertcode', 'template', '|',
                                'horizontal', 'date', 'time', 'spechars', '|',
                                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                                 'searchreplace', 'drafts'
                            ]],
                            autoHeightEnabled:false,
                            catchRemoteImageEnable:true
                        });
                    </script>
    </div>
    <p class="help-block col-sm-4 red">* 必填</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">添加时间</label>
    <div class="col-sm-6">
        <!-- 在需要使用时间插件 标签的地方插入 -->
        <!-- 样式 --><link rel='stylesheet' href='__OTHER__/layui/css/layui.css'><!-- 样式 --><link rel='stylesheet' href='__OTHER__/layui/css/modules/laydate/default/laydate.css'><!-- js文件 --><script type='text/javascript' src='__OTHER__/layui/layui.js'></script><input class='form-control' id='create_time' placeholder='create_time' name='create_time' value='<?php echo date('Y-m-d H:i:s');?>'  type='text' /><!-- 实例化编辑器 -->
                    <script>
                    $(function(){
                        layui.use('laydate', function(){
                            var laydate = layui.laydate;
                              
                            //创建时间
                            laydate.render({
                                elem: '#create_time'
                                ,type: 'datetime'
                                ,theme: 'grid'
                            });
                        });
                    })
                    </script>
    </div>
    <div class="col-sm-3">
    </div>
    <p class="help-block col-sm-2 red">默认是当前时间</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">点击量</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="clicks" required="" type="text" value="50">
    </div>
    <p class="help-block col-sm-4 red">请输入数字</p>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label no-padding-right">链接地址</label>
    <div class="col-sm-6">
        <input class="form-control" placeholder="" name="url" required="" type="text">
    </div>
    <p class="help-block col-sm-4 red">请输入url</p>
</div>
                        <?php endif; ?>
                        <!-- 附加字段或者不是系统自带模型 -->
                        <?php if(isset($fields)): if(is_array($fields) || $fields instanceof \think\Collection || $fields instanceof \think\Paginator): $i = 0; $__LIST__ = $fields;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                <div class="form-group">
                                    <label class="col-sm-1 control-label no-padding-right"><?php echo $vo['cnname']; ?></label>
                                    <div class="col-sm-6">
                                        <?php if($vo['formtype'] <= 6): ?>
                                            <?php echo formStyle($vo['formtype'],$vo); elseif($vo['formtype'] == 7): ?>
                                            <!-- 声明使用 TagLib -->
                                            
                                            <!-- 在需要使用编辑器 标签的地方插入 -->
                                            <!-- 配置文件 --><script type='text/javascript' src='__OTHER__/ueditor/ueditor.config.js'></script><!-- 编辑器源码文件 --><script type='text/javascript' src='__OTHER__/ueditor/ueditor.all.min.js'></script><!-- 字体文件 --><script type='text/javascript' charset='utf-8' src='__OTHER__/ueditor/lang/zh-cn/zh-cn.js'></script><!-- 加载编辑器的容器 --><script id='<?php echo $vo['enname'];?>' name='<?php echo $vo['enname'];?>' type='text/plain'></script><!-- 实例化编辑器 -->
                    <script>
                        var um = UE.getEditor('<?php echo $vo['enname'];?>',{
                            initialFrameWidth:'100%',
                            initialFrameHeight:'300',
                            toolbars: [[
                                'fullscreen',  'undo', 'redo', '|',
                                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                                'directionalityltr', 'directionalityrtl', 'indent', '|',
                                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                                'link', 'unlink', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                                'simpleupload', 'emotion', 'scrawl', 'insertvideo', 'music', 'map',   'insertcode', 'template', '|',
                                'horizontal', 'date', 'time', 'spechars', '|',
                                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                                 'searchreplace', 'drafts'
                            ]],
                            autoHeightEnabled:false,
                            catchRemoteImageEnable:true
                        });
                    </script>
                                        <?php elseif($vo['formtype'] == 8): ?>
                                            <!-- 声明使用 TagLib -->
                                            
                                            <!-- 在需要使用时间插件 标签的地方插入 -->
                                            <!-- 样式 --><link rel='stylesheet' href='__OTHER__/layui/css/layui.css'><!-- 样式 --><link rel='stylesheet' href='__OTHER__/layui/css/modules/laydate/default/laydate.css'><!-- js文件 --><script type='text/javascript' src='__OTHER__/layui/layui.js'></script><input class='form-control' id='<?php echo $vo['enname'];?>' placeholder='<?php echo $vo['enname'];?>' name='<?php echo $vo['enname'];?>' value=''  type='text' /><!-- 实例化编辑器 -->
                    <script>
                    $(function(){
                        layui.use('laydate', function(){
                            var laydate = layui.laydate;
                              
                            //创建时间
                            laydate.render({
                                elem: '#<?php echo $vo['enname'];?>'
                                ,type: 'datetime'
                                ,theme: 'grid'
                            });
                        });
                    })
                    </script>
                                        <?php elseif($vo['formtype'] == 9): ?>
                                            <!-- 声明使用 TagLib -->
                                            
                                            <!-- 在需要使用上传插件 标签的地方插入 -->
                                            <!--引入样式jq-->
<link rel="stylesheet" href="__OTHER__/webuploader/xb-webuploader.css">
<style type="text/css">
    .xb-uploader{border: 3px dashed #e6e6e6;padding-top: 10px;}
    .filelist li{margin-left: 2px;}
</style>

<!-- 引入html -->
<div id="upload-5a7c142eb459c" class="xb-uploader">
    <div class="queueList">
        <div class="placeholder">
            <div class="filePicker"></div>
            <p>或将文件拖到这里，单次最多可选5个,最大不能超过5M</p>
        </div>
    </div>
    <div class="statusBar" style="display:none;">
        <div class="progress">
            <span class="text">0%</span>
            <span class="percentage"></span>
        </div>
        <div class="info"></div>
        <div class="btns">
            <div class="webuploader-container filePicker2">
                <div class="webuploader-pick">继续添加</div>
                <div style="position: absolute; top: 0px; left: 0px; width: 1px; height: 1px; overflow: hidden;" id="rt_rt_1armv2159g1o1i9c2a313hadij6">
                </div>
            </div>
            <div class="uploadBtn">开始上传</div>
        </div>
    </div>
</div>

<!-- 引入webupload.js主文件 -->
<script src="__OTHER__/webuploader/webuploader.min.js"></script>
<!-- 引入webupload.js配置 -->
<script>
jQuery(function() {
    var $ = jQuery,    // just in case. Make sure it's not an other libaray.

        $wrap = $("#upload-5a7c142eb459c"),

        // 图片容器
        $queue = $('<ul class="filelist"></ul>')
            .appendTo( $wrap.find('.queueList') ),

        // 状态栏，包括进度和控制按钮
        $statusBar = $wrap.find('.statusBar'),

        // 文件总体选择信息。
        $info = $statusBar.find('.info'),

        // 上传按钮
        $upload = $wrap.find('.uploadBtn'),

        // 没选择文件之前的内容。
        $placeHolder = $wrap.find('.placeholder'),

        // 总体进度条
        $progress = $statusBar.find('.progress').hide(),

        // 添加的文件数量
        fileCount = 0,

        // 添加的文件总大小
        fileSize = 0,

        // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 1,

        // 缩略图大小
        thumbnailWidth = 110 * ratio,
        thumbnailHeight = 110 * ratio,

        // 可能有pedding, ready, uploading, confirm, done.
        state = 'pedding',

        // 所有文件的进度信息，key为file id
        percentages = {},

        supportTransition = (function(){
            var s = document.createElement('p').style,
                r = 'transition' in s ||
                      'WebkitTransition' in s ||
                      'MozTransition' in s ||
                      'msTransition' in s ||
                      'OTransition' in s;
            s = null;
            return r;
        })(),
        thisSuccess,
        // WebUploader实例
        uploader;

    if ( !WebUploader.Uploader.support() ) {
        alert( 'Web Uploader 不支持您的浏览器！如果你使用的是IE浏览器，请尝试升级 flash 播放器');
        throw new Error( 'WebUploader does not support the browser you are using.' );
    }

    // 实例化
    uploader = WebUploader.create({
        pick: {
            id: "#upload-5a7c142eb459c .filePicker",
            label: "点击上传图片",
            multiple : true
        },
        dnd: "#upload-5a7c142eb459c .queueList",
        paste: document.body,
        // accept: {
        //     title: 'Images',
        //     extensions: 'gif,jpg,jpeg,bmp,png',
        //     mimeTypes: 'image/*'
        // },

        // swf文件路径
        swf:"__OTHER__/webuploader/Uploader.swf",

        disableGlobalDnd: true,

        chunked: true,//是否要分片处理大文件上传。
        server: "<?php echo url('add'); ?>",//服务器地址
        fileNumLimit: 5,//文件上传个数
        fileSizeLimit:5 * 1024 * 1024,    // 200 M
        fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M
    });

    // 添加“添加文件”的按钮，
    uploader.addButton({
       id: "#upload-5a7c142eb459c .filePicker2",
       label: '继续添加'
    });

    // 当有文件添加进来时执行，负责view的创建
    function addFile( file ) {
        var $li = $( '<li id="' + file.id + '">' +
                '<p class="title">' + file.name + '</p>' +
                '<p class="imgWrap"></p>'+
                '<p class="progress"><span></span></p>' +
                '<input class="bjy-filename" type="hidden" name="<?php echo $vo['enname'];?>[]">'+
                '</li>' ),

            $btns = $('<div class="file-panel">' +
                '<span class="cancel">删除</span>' +
                '<span class="rotateRight">向右旋转</span>' +
                '<span class="rotateLeft">向左旋转</span></div>').appendTo( $li ),
            $prgress = $li.find('p.progress span'),
            $wrap = $li.find( 'p.imgWrap' ),
            $info = $('<p class="error"></p>'),

            showError = function( code ) {
                switch( code ) {
                    case 'exceed_size':
                        text = '文件大小超出';
                        break;

                    case 'interrupt':
                        text = '上传暂停';
                        break;

                    default:
                        text = '上传失败，请重试';
                        break;
                }

                $info.text( text ).appendTo( $li );
            };

        if ( file.getStatus() === 'invalid' ) {
            showError( file.statusText );
        } else {
            // @todo lazyload
            $wrap.text( '预览中' );
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    $wrap.text( '不能预览' );
                    return;
                }

                var img = $('<img src="'+src+'">');
                $wrap.empty().append( img );
            }, thumbnailWidth, thumbnailHeight );

            percentages[ file.id ] = [ file.size, 0 ];
            file.rotation = 0;
        }

        file.on('statuschange', function( cur, prev ) {
            if ( prev === 'progress' ) {
                $prgress.hide().width(0);
            } else if ( prev === 'queued' ) {
                $li.off( 'mouseenter mouseleave' );
                $btns.remove();
            }

            // 成功
            if ( cur === 'error' || cur === 'invalid' ) {
                showError( file.statusText );
                percentages[ file.id ][ 1 ] = 1;
            } else if ( cur === 'interrupt' ) {
                showError( 'interrupt' );
            } else if ( cur === 'queued' ) {
                percentages[ file.id ][ 1 ] = 0;
            } else if ( cur === 'progress' ) {
                $info.remove();
                $prgress.css('display', 'block');
            } else if ( cur === 'complete' ) {
                $li.append( '<span class="success"></span>' );
            }

            $li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
        });

        $li.on( 'mouseenter', function() {
            $btns.stop().animate({height: 30});
        });

        $li.on( 'mouseleave', function() {
            $btns.stop().animate({height: 0});
        });

        $btns.on( 'click', 'span', function() {
            var index = $(this).index(),
                deg;

            switch ( index ) {
                case 0:
                    uploader.removeFile( file );
                    return;

                case 1:
                    file.rotation += 90;
                    break;

                case 2:
                    file.rotation -= 90;
                    break;
            }

            if ( supportTransition ) {
                deg = 'rotate(' + file.rotation + 'deg)';
                $wrap.css({
                    '-webkit-transform': deg,
                    '-mos-transform': deg,
                    '-o-transform': deg,
                    'transform': deg
                });
            } else {
                $wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');
                // use jquery animate to rotation
                // $({
                //     rotation: rotation
                // }).animate({
                //     rotation: file.rotation
                // }, {
                //     easing: 'linear',
                //     step: function( now ) {
                //         now = now * Math.PI / 180;

                //         var cos = Math.cos( now ),
                //             sin = Math.sin( now );

                //         $wrap.css( 'filter', "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + ",M12=" + (-sin) + ",M21=" + sin + ",M22=" + cos + ",SizingMethod='auto expand')");
                //     }
                // });
            }


        });

        $li.appendTo( $queue );
    }

    // 负责view的销毁
    function removeFile( file ) {
        var $li = $('#'+file.id);

        delete percentages[ file.id ];
        updateTotalProgress();
        $li.off().find('.file-panel').off().end().remove();
    }

    function updateTotalProgress() {
        var loaded = 0,
            total = 0,
            spans = $progress.children(),
            percent;

        $.each( percentages, function( k, v ) {
            total += v[ 0 ];
            loaded += v[ 0 ] * v[ 1 ];
        } );

        percent = total ? loaded / total : 0;

        spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
        spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
        updateStatus();
    }

    function updateStatus() {
        var text = '', stats;

        if ( state === 'ready' ) {
            text = '选中' + fileCount + '个文件，共' +
                    WebUploader.formatSize( fileSize ) + '。';
        } else if ( state === 'confirm' ) {
            stats = uploader.getStats();
            if ( stats.uploadFailNum ) {
                text = '已成功上传' + stats.successNum+ '个文件，'+
                    stats.uploadFailNum + '个上传失败，<a class="retry" href="#">重新上传</a>失败文件或<a class="ignore" href="#">忽略</a>'
            }

        } else {
            stats = uploader.getStats();
            text = '共' + fileCount + '个（' +
                    WebUploader.formatSize( fileSize )  +
                    '），已上传' + stats.successNum + '个';

            if ( stats.uploadFailNum ) {
                text += '，失败' + stats.uploadFailNum + '个';
            }
            if (fileCount==stats.successNum && stats.successNum!=0) {
                $('#upload-5a7c142eb459c .webuploader-element-invisible').remove();
            }
        }

        $info.html( text );
    }

    uploader.onUploadAccept=function(object ,ret){
        if(ret.error_info){
            fileError=ret.error_info;
            return false;
        }
    }

    uploader.onUploadSuccess=function(file ,response){
        console.log(response);
        $('#'+file.id +' .bjy-filename').val(response.data)
    }
    uploader.onUploadError=function(file){
        alert(fileError);
    }

    function setState( val ) {
        var file, stats;
        if ( val === state ) {
            return;
        }

        $upload.removeClass( 'state-' + state );
        $upload.addClass( 'state-' + val );
        state = val;

        switch ( state ) {
            case 'pedding':
                $placeHolder.removeClass( 'element-invisible' );
                $queue.parent().removeClass('filled');
                $queue.hide();
                $statusBar.addClass( 'element-invisible' );
                uploader.refresh();
                break;

            case 'ready':
                $placeHolder.addClass( 'element-invisible' );
                $( "#upload-5a7c142eb459c .filePicker2" ).removeClass( 'element-invisible');
                $queue.parent().addClass('filled');
                $queue.show();
                $statusBar.removeClass('element-invisible');
                uploader.refresh();
                break;

            case 'uploading':
                $( "#upload-5a7c142eb459c .filePicker2" ).addClass( 'element-invisible' );
                $progress.show();
                $upload.text( '暂停上传' );
                break;

            case 'paused':
                $progress.show();
                $upload.text( '继续上传' );
                break;

            case 'confirm':
                $progress.hide();
                $upload.text( '开始上传' ).addClass( 'disabled' );

                stats = uploader.getStats();
                if ( stats.successNum && !stats.uploadFailNum ) {
                    setState( 'finish' );
                    return;
                }
                break;
            case 'finish':
                stats = uploader.getStats();
                if ( stats.successNum ) {
                    
                } else {
                    // 没有成功的图片，重设
                    state = 'done';
                    location.reload();
                }
                break;
        }
        updateStatus();
    }

    uploader.onUploadProgress = function( file, percentage ) {
        var $li = $('#'+file.id),
            $percent = $li.find('.progress span');

        $percent.css( 'width', percentage * 100 + '%' );
        percentages[ file.id ][ 1 ] = percentage;
        updateTotalProgress();
    };

    uploader.onFileQueued = function( file ) {
        fileCount++;
        fileSize += file.size;

        if ( fileCount === 1 ) {
            $placeHolder.addClass( 'element-invisible' );
            $statusBar.show();
        }

        addFile( file );
        setState( 'ready' );
        updateTotalProgress();
    };

    uploader.onFileDequeued = function( file ) {
        fileCount--;
        fileSize -= file.size;

        if ( !fileCount ) {
            setState( 'pedding' );
        }

        removeFile( file );
        updateTotalProgress();

    };

    uploader.on( 'all', function( type ) {
        var stats;
        switch( type ) {
            case 'uploadFinished':
                setState( 'confirm' );
                break;

            case 'startUpload':
                setState( 'uploading' );
                break;

            case 'stopUpload':
                setState( 'paused' );
                break;

        }
    });

    uploader.onError = function( code ) {
        if(code === 'F_DUPLICATE'){
            alert('不能重复上传同一张图片');
        }else{
            alert( 'Eroor: ' + code );
        }
            
        
    };

    $upload.on('click', function() {
        if ( $(this).hasClass( 'disabled' ) ) {
            return false;
        }

        if ( state === 'ready' ) {
            uploader.upload();
        } else if ( state === 'paused' ) {
            uploader.upload();
        } else if ( state === 'uploading' ) {
            uploader.stop();
        }
    });

    $info.on( 'click', '.retry', function() {
        uploader.retry();
    } );

    $info.on( 'click', '.ignore', function() {
        alert( 'todo' );
    } );

    $upload.addClass( 'state-' + state );
    updateTotalProgress();
});
</script>
                                        <?php endif; ?>
                                    </div>
                                    <p class="help-block col-sm-4 red"><?php echo $vo['tips']; ?></p>
                                </div>
                            <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        <div class="form-group">
                            <div class="col-sm-offset-1 col-sm-10">
                                <button type="submit" class="btn btn-success">保存信息</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
		</div>	
	</div>

	
</body>
    <!--Basic Scripts-->
<script src="__ADMIN__/style/jquery_002.js"></script>
<script src="__ADMIN__/style/bootstrap.js"></script>
<!--Beyond Scripts-->
<script src="__ADMIN__/style/beyond.js"></script>
</html>