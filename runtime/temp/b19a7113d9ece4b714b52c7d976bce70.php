<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:70:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\admin\edit.html";i:1516264407;s:70:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\top.html";i:1516609252;s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\public\left.html";i:1515654260;}*/ ?>
<!DOCTYPE html>
<html><head>
        <meta charset="utf-8">
    <title>编辑管理员</title>

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
     <script src="__ADMIN__/style/jquery_002.js"></script>
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
                        <a href="<?php echo url('lst'); ?>">管理员管理</a>
                    </li>
                                        <li class="active">编辑管理员</li>
                                        </ul>
                </div>
                <!-- /Page Breadcrumb -->

                <!-- Page Body -->
                <div class="page-body">
                    
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-header bordered-bottom bordered-blue">
                <span class="widget-caption">编辑管理员</span>
            </div>
            <div class="widget-body">
                <div id="horizontal-form">
                    <form class="form-horizontal" role="form" action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $admin['id']; ?>" id="id">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">所属用户组</label>
                            <div class="col-sm-4">
                                <select name="group_id">
                                <?php if($groups): if(is_array($groups) || $groups instanceof \think\Collection || $groups instanceof \think\Paginator): $i = 0; $__LIST__ = $groups;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                                        <option value="<?php echo $vo['id']; ?>" <?php if($vo['id'] == $admin['auth_group'][0]['id']): ?>selected<?php endif; ?>><?php echo $vo['title']; ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; else: ?>
                                    <option value="0">暂无用户组</option>
                                <?php endif; ?>
                                </select>
                            </div>
                            <p class="help-block col-sm-4 red">* 必填</p>
                        </div>

                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label no-padding-right">名称</label>
                            <div class="col-sm-4">
                                <input class="form-control"  placeholder="" name="username" required="" type="text" value="<?php echo $admin['username']; ?>" onchange="check()">
                            </div>
                            <p class="help-block col-sm-4 red username">* 必填</p>
                        </div>
                        
                        <div class="form-group">
                            <label for="group_id" class="col-sm-2 control-label no-padding-right">旧密码</label>
                            <div class="col-sm-4">
                              <input class="form-control"  placeholder="" name="old" required="" type="password"  value="" onchange="check()">
                            </div>
                            <p class="help-block col-sm-4 red old">* 必填</p>
                        </div>
                        <div class="form-group">
                            <label for="group_id" class="col-sm-2 control-label no-padding-right">新密码</label>
                            <div class="col-sm-4">
                              <input class="form-control"  placeholder="" name="password" required="" type="password"  value="" onchange="check()">
                            </div>
                            <p class="help-block col-sm-4 red password">* 必填</p>
                        </div>
                        <div class="form-group">
                            <label for="group_id" class="col-sm-2 control-label no-padding-right">手机号</label>
                            <div class="col-sm-4">
                              <input class="form-control" placeholder="" name="phone" required="" type="text"  value="<?php echo $admin['phone']; ?>" onchange="check()">
                            </div>
                            <p class="help-block col-sm-4 red phone">* 必填</p>
                        </div>
                        <div class="form-group">
                            <label for="group_id" class="col-sm-2 control-label no-padding-right">头像</label>
                            <div class="col-sm-4">
                                    <?php echo uploadImg(['avatar',$admin['avatar']]); ?>
                            </div>
                        </div>
                 
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success" id="sub">保存信息</button>
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
   
    <script src="__ADMIN__/style/bootstrap.js"></script>
    <!--Beyond Scripts-->
    <script src="__ADMIN__/style/beyond.js"></script>
    <script type="text/javascript">
        //验证用户名   
        $("input[name='username']").focus(function(){
            $(".username").html('中文、字母、数字等组合,4-18个字符');
        });

        //验证用户名是否存在
        $("input[name='username']").blur(function(){
            if($(this).val().length!=0)
            {
                $.post("<?php echo url('admin/yanzheng'); ?>",{username:$(this).val()},function(res){
                    if(res.code == 1031){
                        $(".username").addClass('red').html(res.msg);
                    }
                    if(res.code == 1032){
                        $(".username").removeClass('red').addClass('green').html(res.msg);
                    }
                },"json");  
            } 
            if($(this).val().length>18||$(this).val().length<4){
                 $(".username").html('用户名不能为空');
            }   
        });






        //验证手机
        $("input[name='phone']").focus(function(){
            $(".phone").addClass('red').html("建议使用常用手机！");
        });
       

         $("input[name='phone']").blur(function(){ 
            //验证手机是否为空和长度
            if($(this).val().length!=11 || $(this).val().length==0){
                $(".phone").html('手机号不能为空，长度11位');
            }else{
                //验证手机号码是否已注册
                if($(this).val().match(/^1[34578]\d{9}$/))
                {
                    $.post("<?php echo url('admin/checkAccount'); ?>",{id:$("#id").val(),phone:$(this).val()},function(res){
                        if(res.code == 1040){
                            $(".phone").removeClass('red').addClass('green').html(res.msg);
                        }
                        if(res.code == 1042){
                            $(".phone").html(res.msg);
                        }
                    },"json");  
                }else{
                    $(".phone").html('手机号格式不正确');
                }
            }
            
        });


         //验证旧密码
        $("input[name='old']").focus(function(){
            $(".old").addClass('red').html("请输入原密码");
        });
       

         $("input[name='old']").blur(function(){ 
            //验证旧密码是否为空
            if($(this).val().length==0){
                $(".old").html('原密码不能为空');
            }else{
                //验证旧密码
                $.post("<?php echo url('admin/checkAccount'); ?>",{id:$("#id").val(),old:$(this).val()},function(res){
                    if(res.code == 1041){
                        $(".old").removeClass('red').addClass('green').html(res.msg);
                    }
                    if(res.code == 1042){
                        $(".old").html(res.msg);
                    }
                },"json");  
            }
            
        });


        //验证新密码
        $("input[name='password']").focus(function(){
            $(".password").addClass('red').html("中文、字母、数字等组合,6-18个字符");
        });
        //验证新密码是否为空
        $("input[name='password']").blur(function(){
            var old = $("input[name='old']").val();//旧密码
            if($(this).val().length>18 || $(this).val().length<6){
                $(".password").addClass('red').html('密码是6-18个字符');
            }else{
                if($(this).val() == old){
                    $(".password").addClass('red').html('新密码不能和旧密码一样');
                }else{
                    $(".password").removeClass('red').addClass('green').html('输入正确');
                }
            }
        });

    function check(){
        var username = $("input[name='username']").val();
        var password = $("input[name='password']").val();
        var phone = $("input[name='phone']").val();
        var old = $("input[name='old']").val();
        if(!username || !old || !password || !phone || phone.length != 11 || password.length<6 || password.length>18){
            $('#sub').attr('disabled',true);
        }else{
            $('#sub').attr('disabled',false);
        }
    }
    check();
    </script>


</body></html>