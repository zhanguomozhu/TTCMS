<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\index\index.html";i:1518070832;s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\head.html";i:1518144550;s:70:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\top.html";i:1516609361;s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\left.html";i:1515654260;s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\foot.html";i:1518144509;}*/ ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <!--Beyond styles-->
    <link href="__ADMIN__/style/bootstrap.css" rel="stylesheet">
    <link href="__ADMIN__/style/font-awesome.css" rel="stylesheet">
    <link href="__ADMIN__/style/beyond.css" id="beyond-link" rel="stylesheet" type="text/css">
    <link href="__ADMIN__/style/demo.css" rel="stylesheet">
    <link href="__ADMIN__/style/typicons.css" rel="stylesheet">
    <link href="__ADMIN__/style/animate.css" rel="stylesheet">


    <!-- js -->
    <script src="__ADMIN__/js/jquery-1.11.1.js"></script>
    <!-- bootstrap -->
    <script src="__ADMIN__/js/bootstrap.js"></script>
    <!-- layui -->
    <script src="__OTHER__/layui/layui.js"></script>


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
                        <li class="active">后台首页</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
            <div class="col-md-12">
                            <div class="profile-container">
                                <div class="profile-header row">
                                    <div class="col-lg-2 col-md-4 col-sm-12 text-center">
                                        <img src="/<?php echo \think\Session::get('admin_info.avatar'); ?>" alt="" class="header-avatar">
                                    </div>
                                    <div class="col-lg-5 col-md-8 col-sm-12 profile-info">
                                        <div class="header-fullname"><?php echo \think\Session::get('admin_info.username'); ?></div>
                                        <a href="#" class="btn btn-palegreen btn-sm  btn-follow">
                                            <i class="fa fa-check"></i>
                                            <?php echo $admin['auth_group'][0]['title']; ?>
                                        </a>
                                        <div class="header-information">
                                            我是个人简介
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 profile-stats">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                                <div class="stats-value pink">284</div>
                                                <div class="stats-title">文章总数</div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                                <div class="stats-value pink">803</div>
                                                <div class="stats-title">图片总数</div>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 stats-col">
                                                <div class="stats-value pink">1207</div>
                                                <div class="stats-title">点击总数</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                                                <i class="glyphicon glyphicon-map-marker"></i><?php echo $data['admin'][0]['address']; ?>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                                                余额: <strong>$250</strong>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 inlinestats-col">
                                                年龄: <strong>24</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-body">
                                    <div class="col-lg-12">
                                        <div class="tabbable">
                                            <ul class="nav nav-tabs tabs-flat  nav-justified" id="myTab11">
                                                <li class="active">
                                                    <a data-toggle="tab" href="#overview">
                                                        网站信息
                                                    </a>
                                                </li>
                                                <li class="tab-red">
                                                    <a data-toggle="tab" href="#timeline">
                                                        消息管理
                                                    </a>
                                                </li>
                                                <li class="tab-palegreen">
                                                    <a data-toggle="tab" id="contacttab" href="#contacts">
                                                        最新文章
                                                    </a>
                                                </li>
                                                <li class="tab-yellow">
                                                    <a data-toggle="tab" href="#settings">
                                                        最新评论
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content tabs-flat">
                                                <!-- 网站信息 -->
                                                <div id="overview" class="tab-pane active">
                                                    <div class="row profile-overview">
                                                        <div class="col-md-6">

                                                            <!-- 左表 -->
                                                            <div class="col-xs-12 col-md-12">
                                                                <div class="well with-header with-footer">
                                                                    <div class="header bg-blue text-center">
                                                                        网站信息
                                                                    </div>
                                                                    <table class="table table-hover table-striped table-bordered">
                                                                        <thead class="bordered-blueberry">
                                                                            <tr>
                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php if(is_array($data['site']) || $data['site'] instanceof \think\Collection || $data['site'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['site'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">操作系统</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['os']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">运行环境</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['huanjing']; ?></td>
                                                                            </tr>
                                                                             <tr>
                                                                                <td align="center" style="width: 30%;">当前主机名</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['pc']; ?></td>
                                                                            </tr>
                                                                             <tr>
                                                                                <td align="center" style="width: 30%;">获取服务器语言</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['language']; ?></td>
                                                                            </tr>
                                                                             <tr>
                                                                                <td align="center" style="width: 30%;">端口</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['port']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">PHP版本</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['php']; ?></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">MYSQL版本</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['mysql']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">数据库大小</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['mysql_size']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">PHP运行方式</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['run']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">ThinkPHP版本</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['think']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">上传附件限制</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['upload']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">执行时间限制</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['gotime']; ?></td>
                                                                            </tr>

                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">服务器时间</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['ostime']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">北京时间</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['bjtime']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">服务器域名/IP</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['os_do_ip']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">剩余空间</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['kongjian']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">register_globals</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['register_globals']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">magic_quotes_gpc</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['magic_quotes_gpc']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">magic_quotes_runtime</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['magic_quotes_runtime']; ?></td>
                                                                            </tr>
                                                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                                                        </tbody>
                                                                    </table>

                                                                    <div class="footer">
                                                                        <code></code>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">

                                                            <!-- 右表 -->
                                                            <div class="col-xs-12 col-md-12">
                                                                <div class="well with-header with-footer">
                                                                    <div class="header bg-blue text-center">
                                                                        管理员信息
                                                                    </div>
                                                                    <table class="table table-hover table-striped table-bordered">
                                                                        <thead class="bordered-blueberry">
                                                                            <tr>
                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php if(is_array($data['admin']) || $data['admin'] instanceof \think\Collection || $data['admin'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['admin'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">管理员</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['username']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">最近登录时间</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['logintime']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">最近登录IP</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['loginip']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">登录地址</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['address']; ?></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;">登陆次数</td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['num']; ?></td>
                                                                            </tr>
                                                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                                                        </tbody>
                                                                    </table>

                                                                </div>
                                                            </div>

                                                            <!-- 右下表 -->
                                                            <div class="col-xs-12 col-md-12">
                                                                <div class="well with-header with-footer">
                                                                    <div class="header bg-blue text-center">
                                                                        开发者信息
                                                                    </div>
                                                                    <table class="table table-hover table-striped table-bordered">
                                                                        <thead class="bordered-blueberry">
                                                                            <tr>
                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php if(is_array($data['developer']) || $data['developer'] instanceof \think\Collection || $data['developer'] instanceof \think\Paginator): $i = 0; $__LIST__ = $data['developer'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                                                            <tr>
                                                                                <td align="center" style="width: 30%;"><?php echo $vo['cnname']; ?></td>
                                                                                <td align="left" style="width: 70%;"><?php echo $vo['value']; ?></td>
                                                                            </tr>
                                                                            <?php endforeach; endif; else: echo "" ;endif; ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- 消息管理 左侧-->
                                                <div id="timeline" class="tab-pane">
                                                    <ul class="timeline animated fadeInDown">
                                                        <li>
                                                            <!-- 时间 -->
                                                            <div class="timeline-datetime">
                                                                <span class="timeline-time">
                                                                    8:19
                                                                </span><span class="timeline-date">Today</span>
                                                            </div>
                                                            <!-- 图标 -->
                                                            <div class="timeline-badge blue">
                                                                <i class="fa fa-tag"></i>
                                                            </div>
                                                            <!-- 内容 -->
                                                            <div class="timeline-panel">
                                                                <div class="timeline-header bordered-bottom bordered-blue">
                                                                    <span class="timeline-title">
                                                                        标题
                                                                    </span>
                                                                    <!-- 消息右上角时间 -->
                                                                    <p class="timeline-datetime" style="display: block;">
                                                                        <small class="text-muted">
                                                                            <i class="glyphicon glyphicon-time">
                                                                            </i>
                                                                            <span class="timeline-date">Today</span>
                                                                            -
                                                                            <span class="timeline-time">8:19</span>
                                                                        </small>
                                                                    </p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>内容简介</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <!-- 消息管理 右侧-->
                                                        <li class="timeline-inverted">
                                                             <!-- 时间 -->
                                                            <div class="timeline-datetime">
                                                                <span class="timeline-time">
                                                                    3:10
                                                                </span><span class="timeline-date">Today</span>
                                                            </div>
                                                             <!-- 图标 -->
                                                            <div class="timeline-badge darkorange">
                                                                <i class="fa fa-map-marker font-120"></i>
                                                            </div>
                                                            <!-- 内容 -->
                                                            <div class="timeline-panel bordered-right-3 bordered-orange">
                                                                <div class="timeline-header bordered-bottom bordered-blue">
                                                                    <span class="timeline-title">
                                                                        标题
                                                                    </span>
                                                                    <!-- 消息右上角时间 -->
                                                                    <p class="timeline-datetime">
                                                                        <small class="text-muted">
                                                                            <i class="glyphicon glyphicon-time">
                                                                            </i>
                                                                            <span class="timeline-date">Today</span>
                                                                            -
                                                                            <span class="timeline-time">3:10</span>
                                                                        </small>
                                                                    </p>
                                                                </div>
                                                                <div class="timeline-body">
                                                                    <p>内容简介</p>
                                                                    <p>
                                                                        <i class="orange fa fa-exclamation"></i>内容简介 <span><a href="#" class="info">内容简介</a></span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="timeline-node">
                                                            <a class="btn btn-success">加载更多</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <!-- 最新文章 -->
                                                <div id="contacts" class="tab-pane">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-md-12">
                                                            <div class="well with-header  with-footer">
                                                                <div class="header bg-blue">
                                                                    最新文章
                                                                </div>
                                                                <table class="table table-hover">
                                                                    <thead class="bordered-darkorange">
                                                                        <tr></tr>
                                                                        <tr></tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="left" style="width: 70%;">xxxxxxxxxxxxxx</td>
                                                                            <td align="center" style="width: 30%;">2018-11-2</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" style="width: 70%;">xxxxxxxxxxxxxx</td>
                                                                            <td align="center" style="width: 30%;">2018-11-2</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                                <div class="footer">
                                                                    <code>我是页脚</code>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- 最新留言 -->
                                                <div id="settings" class="tab-pane">
                                                    <div class="row">
                                                    <div class="col-xs-12 col-md-12">
                                                            <div class="well with-header  with-footer">
                                                                <div class="header bg-blue">
                                                                    最新留言
                                                                </div>
                                                                <table class="table table-hover">
                                                                    <thead class="bordered-darkorange">
                                                                        <tr></tr>
                                                                        <tr></tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td align="left" style="width: 70%;">xxxxxxxxxxxxxx</td>
                                                                            <td align="center" style="width: 30%;">2018-11-2</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td align="left" style="width: 70%;">xxxxxxxxxxxxxx</td>
                                                                            <td align="center" style="width: 30%;">2018-11-2</td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>

                                                                <div class="footer">
                                                                    <code>我是页脚</code>
                                                                </div>
                                                            </div>

                                                    </div>
                                                    </div>
                                                </div>



                                            </div>
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
<!-- Beyond -->
<script src="__ADMIN__/js/beyond.js"></script>
<!-- 基于layer的弹窗js -->
<script src="__ADMIN__/js/dialog.js"></script>
<!-- common -->
<script src="__ADMIN__/js/common.js"></script>
</html>