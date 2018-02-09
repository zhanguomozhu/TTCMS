<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\login\forget.html";i:1518167148;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><!--Head--><head>
    <meta charset="utf-8">
    <title>忘记密码</title>
    <meta name="description" content="login page">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="__ADMIN__/style/bootstrap.css" rel="stylesheet">
    <link href="__ADMIN__/style/font-awesome.css" rel="stylesheet">
    <!--Beyond styles-->
    <link href="__ADMIN__/style/beyond.min.css" id="beyond-link" rel="stylesheet">
    <link href="__ADMIN__/style/demo.css" rel="stylesheet">
    <link href="__ADMIN__/style/animate.css" rel="stylesheet">
    
    <!--jq-->
    <script src="__ADMIN__/js/jquery-1.11.1.js"></script>
    <!-- layui -->
    <script src="__OTHER__/layui/layui.js"></script>

</head>

<body>
    <div class="login-container animated fadeInDown">
        <form action="<?php echo url('forget'); ?>" method="post">
            <div class="loginbox bg-white" >
                <div class="loginbox-title">重置密码</div>
                <div class="loginbox-social">
                    <div class="social-title ">请选择验证方式</div>
                    <div class="social-buttons">
                        <a onclick="forget.choose('phone')" class="button-facebook" style="margin-left: 40px;">
                            <i class="social-icon fa fa-phone"></i>
                        </a>
                        <a onclick="forget.choose('email')" class="button-twitter">
                            <i class="social-icon fa fa-envelope"></i>
                        </a>
                    </div>
                </div>
                <div class="loginbox-textbox">
                    <input value="" class="form-control" placeholder="用户名" name="username" type="text" onchange="forget.verify(this,'username')">
                </div>
                <div class="phone">
                    <div class="loginbox-textbox">
                        <input class="form-control" placeholder="手机号" name="phone" type="text" onchange="forget.verify(this,'phone')">
                    </div>
                    <div class="loginbox-textbox">
                        <input class="form-control" style="width: 115px;float: left;margin-right: 3px;" placeholder="手机验证码" name="phone_code" type="text">
                        <a href="javascript:void(0);" style="width: 100px;" class="btn btn-success" onclick="common.getCode(this,'phone')">获取验证码</a>
                    </div>
                    <div class="loginbox-submit" >
                        <input class="btn btn-primary btn-block" value="提交" type="button" onclick="forget.check('phone')">
                    </div>
                </div>
                <div class="email" style="display: none;">
                    <div class="loginbox-textbox">
                        <input class="form-control" placeholder="邮箱" name="email" type="text" onchange="forget.verify(this,'email')">
                    </div>
                    <div class="loginbox-textbox">
                        <input class="form-control" style="width: 115px;float: left;margin-right: 3px;" placeholder="邮箱验证码" name="email_code" type="text">
                        <a href="javascript:void(0);" style="width: 100px;" class="btn btn-success" onclick="common.getCode(this,'email')">获取验证码</a>
                    </div>
                    <div class="loginbox-submit" >
                        <input class="btn btn-primary btn-block" value="提交" type="button" onclick="forget.check('email')">
                    </div>
                </div>
                <div class="loginbox-textbox">
                    <p class="text-center">
                        <a href="<?php echo url('login'); ?>">立即登录</a>    |    <a  href="<?php echo url('register'); ?>">立即注册</a>
                    </p>
                </div>
            </div>
            <div class="logobox bg-white" align="center">
                <div class="loginbox-textbox">
                    <p class="text-center" style="margin-top: 10px;">TTCMS @2017-2018</p>
                </div>
            </div>
        </form>
    </div>
</body>

<!-- 弹窗js -->
<script src="__ADMIN__/js/dialog.js"></script>
<!-- commonjs -->
<script src="__ADMIN__/js/common.js"></script>
<!-- 验证js -->
<script src="__ADMIN__/js/forget.js"></script>

</html>