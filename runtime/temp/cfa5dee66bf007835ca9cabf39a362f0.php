<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:75:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\model_field\add.html";i:1518425977;s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\head.html";i:1518231672;s:70:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\top.html";i:1518328733;s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\left.html";i:1515654260;s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\foot.html";i:1518327988;}*/ ?>
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
                                  <a onclick="common.loginout('<?php echo url('admin/loginout'); ?>')">
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

                        <input type="hidden" name="tablename" value="<?php echo input('tablename'); ?>">
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right">字段名称</label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="只能用英文字母或数字" name="name"  type="text">
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right">字段类型</label>
                            <div class="col-sm-6">
                                <select name='type'>
                                    <option value="char">(char)固定长度</option>
                                    <option value="varchar">(varchar)不固定长度</option>
                                    <option value="tinyint">(tinyint)</option>
                                    <option value="text">(text)大文本</option>
                                    <option value="int">(int)整数</option>
                                    <option value="float">(float)浮点数</option>
                                </select>
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right">字段长度</label>
                            <div class="col-sm-3">
                                <input class="form-control" placeholder="0-255" name="length"  type="text">
                            </div>
                            <div class="col-sm-3">
                                
                            </div>
                            <p class="help-block col-sm-4 red"></p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right">表单类型</label>
                            <div class="col-sm-6">
                                <select name='formtype'>
                                    <option value="1">单行文本</option>
                                    <option value="2">多行文本</option>
                                    <option value="3">单选按钮</option>
                                    <option value="4">复选按钮</option>
                                    <option value="5">下拉菜单</option>
                                    <option value="6">上传按钮</option>
                                    <option value="7">编辑器</option>
                                    <option value="8">时间</option>
                                    <option value="9">上传插件</option>
                                </select>
                            </div>
                            <p class="help-block col-sm-4 red">用于表单显示类型</p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right">是否为空</label>
                            <div class="col-sm-6">
                                <div style="float: left;padding-right: 20px;margin-top: 5px;">
                                    <label>
                                        <input name="isNull" value="1" type="radio">
                                        <span class="text">是</span>
                                    </label>
                                </div>
                                <div style="float: left;padding-right: 20px;margin-top: 5px;">
                                    <label>
                                        <input name="isNull" value="0" checked type="radio">
                                        <span class="text">否</span>
                                    </label>
                                </div>
                            </div>
                            <p class="help-block col-sm-4 red"></p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right">字段注释</label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="发布内容时显示的提示文字" name="comment"  type="text">
                            </div>
                            <p class="help-block col-sm-4 red">用于表单显示名称</p>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-1 control-label no-padding-right">默认值</label>
                            <div class="col-sm-6">
                                <input class="form-control" placeholder="" name="default"  type="text">
                            </div>
                            <p class="help-block col-sm-4 red"></p>
                        </div>
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
<script>
var SCOPE = {
    'set_status_url': "<?php echo url('setStatus'); ?>",//改变状态
    'listorder_url' : "<?php echo url('setOrder'); ?>",//排序
}
</script>

<!-- Beyond -->
<script src="__ADMIN__/js/beyond.js"></script>
<!-- 基于layer的弹窗js -->
<script src="__ADMIN__/js/dialog.js"></script>
<!-- common -->
<script src="__ADMIN__/js/common.js"></script>
</html>