<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\login\login.html";i:1518231463;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><!--Head--><head>
    <meta charset="utf-8">
    <title>登录</title>
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
        <form action="<?php echo url('login'); ?>" method="post">
            <div class="loginbox bg-white">
                <div class="loginbox-title">登&nbsp;&nbsp;录</div>
                <div class="loginbox-textbox">
                    <input value="" class="form-control" placeholder="用户名" name="username" type="text">
                </div>
                <div class="loginbox-textbox">
                    <input class="form-control" placeholder="密码" name="password" type="password">
                </div>
                <div class="loginbox-textbox">
                    <input class="form-control" style="width: 100px;float: left;" placeholder="验证码" name="code" type="text" >
                    <img id="captcha" src="<?php echo url('verify'); ?>" alt="验证码" style="float: left;margin-left: 10px;cursor: pointer;" onclick="this.src='<?php echo url('verify'); ?>?'+Math.random();"/>
                </div>
                <div class="loginbox-submit" style="margin-top: 40px;">
                    <input class="btn btn-primary btn-block" value="登录" type="button" onclick="login.check()">
                </div>
                <div class="loginbox-textbox">
                    <p class="text-center">
                        <a href="<?php echo url('forget'); ?>">忘记密码</a>    |    <a  href="<?php echo url('register'); ?>">立即注册</a>
                    </p>
                </div>
                <div class="loginbox-or">
                    <div class="or-line"></div>
                    <div class="or" style="width: 130px;left: calc(37% - 25px);">使用以下方式快速登录</div>
                </div>
                <div class="loginbox-social">
                    <div class="social-buttons">
                        <a href="<?php echo url('admin/oauth/login',['type'=>'qq']); ?>" class="button-facebook">
                            <i class="social-icon fa fa-qq"></i>
                        </a>
                        <a href="<?php echo url('admin/oauth/login',['type'=>'weixin']); ?>" class="button-twitter">
                            <i class="social-icon fa fa-weixin"></i>
                        </a>
                        <a href="<?php echo url('admin/oauth/login',['type'=>'sina']); ?>" class="button-google">
                            <i class="social-icon fa fa-weibo"></i>
                        </a>
                    </div>
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
<!-- 登录js -->
<script src="__ADMIN__/js/login.js"></script>

</html>