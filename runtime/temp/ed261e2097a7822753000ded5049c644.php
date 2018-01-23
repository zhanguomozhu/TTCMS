<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\model\add.html";i:1516697300;s:70:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\top.html";i:1516609361;s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\left.html";i:1515654260;}*/ ?>
<!DOCTYPE html>
<html><head>
	    <meta charset="utf-8">
    <title>添加模型</title>

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
                        <a href="<?php echo url('lst'); ?>">模型列表</a>
                    </li>
                    <li class="active">添加模型</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">添加模型</span>
            </div>

            <div class="widget-body">
                <div class="widget-main ">
                    <div class="tabbable">
                        <ul class="nav nav-tabs" id="myTab9">
                            <li class="active">
                                <a data-toggle="tab" href="#jiben">
                                    基本设置
                                </a>
                            </li>

                            <li class="tab-red">
                                <a data-toggle="tab" href="#fields">
                                    字段设置
                                </a>
                            </li>
                        </ul>
                    
                        <div class="tab-content">
                            <!-- 基本选项 -->
                            <div id="jiben" class="tab-pane active">

                               <form class="form-horizontal" role="form" action="<?php echo url('add'); ?>" method="post">
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right">模型名称</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" placeholder="请输入模型名称" name="name"  type="text">
                                        </div>
                                        <p class="help-block col-sm-4 red">* 必填</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right">模型表名</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" placeholder="请输入模型表名,必须由英文、数字、下划线组成" name="tablename"  type="text">
                                        </div>
                                        <p class="help-block col-sm-4 red">* 必填</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right">首页模板</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" placeholder="请输入首页模板名称" name="index_template"  type="text">
                                        </div>
                                        <p class="help-block col-sm-4 red">* 必填</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right">列表页模板</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" placeholder="请输入列表页模板名称" name="list_template"  type="text">
                                        </div>
                                        <p class="help-block col-sm-4 red">* 必填</p>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-1 control-label no-padding-right">详情页模板</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" placeholder="请输入详情页模板名称" name="show_template"  type="text">
                                        </div>
                                        <p class="help-block col-sm-4 red">* 必填</p>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">保存信息</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- 模板设置 -->
                            <div id="fields" class="tab-pane">
                                
                                    <!-- 字段配置表 -->
                                    <div class="well with-header with-footer">
                                        <div class="header bg-darkorange">
                                            模型字段配置
                                        </div>
                                        <form class="form-horizontal" role="form" action="<?php echo url('add'); ?>" method="post">
                                        <table class="table table-hover table-striped table-bordered">
                                            <thead class="bordered-darkorange">
                                                <tr>
                                                    <th style="text-align: center;">表单提示文字</th>
                                                    <th style="text-align: center;">数据字段名</th>
                                                    <th style="text-align: center;">数据类型</th>
                                                    <th style="text-align: center;">表单类型</th>
                                                    <th style="text-align: center;">操作</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td align="center" style="width: 20%;">xxxx</td>
                                                    <td align="center" style="width: 20%;">xxxx</td>
                                                    <td align="center" style="width: 20%;">xxxx</td>
                                                    <td align="center" style="width: 20%;">xxxx</td>
                                                    <td align="center" style="width: 20%;">
                                                        <a href="" class="btn btn-primary btn-sm shiny">
                                                            <i class="fa fa-edit"></i> 编辑
                                                        </a>
                                                        <a href="#" onClick="warning('确实要删除吗', '')" class="btn btn-darkorange btn-sm shiny">
                                                            <i class="fa fa-trash-o"></i> 删除
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </form>
                                    </div>
                                  
                                
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        <div>
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
    


</body></html>