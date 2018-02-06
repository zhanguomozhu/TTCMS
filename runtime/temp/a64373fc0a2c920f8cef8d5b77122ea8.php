<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\article\add.html";i:1517906516;s:70:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\top.html";i:1516609361;s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\left.html";i:1515654260;}*/ ?>
<!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>添加文章</title>

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
    <link href="__OTHER__/layui/css/layui.css" rel="stylesheet">
    <link href="__OTHER__/layui/css/modules/laydate/default/laydate.css" rel="stylesheet">

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
                                        <li>
                        <a href="<?php echo url('Index/index'); ?>">系统</a>
                    </li>
                                        <li>
                        <a href="<?php echo url('lst'); ?>">文章列表</a>
                    </li>
                    <li class="active">添加文章</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">添加文章</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form class="form-horizontal" role="form" action="<?php echo url('add'); ?>" method="post">
                         <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right">所属栏目</label>
                            <div class="col-sm-6">
                               <select name="category_id">
                                    <?php if(is_array($categorys) || $categorys instanceof \think\Collection || $categorys instanceof \think\Paginator): $i = 0; $__LIST__ = $categorys;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                    <option value="<?php echo $vo['id']; ?>"><?php echo $vo['name']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                               </select>
                            </div>
                            <p class="help-block col-sm-4 red">请选择栏目</p>
                        </div>
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
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right">添加时间</label>
                            <div class="col-sm-2">
                                <input class="form-control" id="create_time" placeholder="<?php echo date('Y-m-d H:i:s'); ?>" value="<?php echo date('Y-m-d H:i:s'); ?>" name="create_time" required="" type="text">
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
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
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

	    <!--Basic Scripts-->
    <script src="__ADMIN__/style/jquery_002.js"></script>
    <script src="__ADMIN__/style/bootstrap.js"></script>
    <!--Beyond Scripts-->
    <script src="__ADMIN__/style/beyond.js"></script>

    <script src="__OTHER__/layui/layui.js"></script>
    <script>
    layui.use('laydate', function(){
          var laydate = layui.laydate;
          
          //创建时间
          laydate.render({
            elem: '#create_time'
            ,type: 'datetime'
            ,theme: 'grid'
          });
      });
    </script>    
</body>
</html>