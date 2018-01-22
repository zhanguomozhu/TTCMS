<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:71:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\login\login.html";i:1516329243;}*/ ?>
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
    <link id="beyond-link" href="__ADMIN__/style/beyond.css" rel="stylesheet">
    <link href="__ADMIN__/style/demo.css" rel="stylesheet">
    <link href="__ADMIN__/style/animate.css" rel="stylesheet">
</head>
<!--Head Ends-->
<!--Body-->

<body>
    <div class="login-container animated fadeInDown">
        <form action="<?php echo url('login'); ?>" method="post">
            <div class="loginbox bg-white">
                <div class="loginbox-title">管理员登录</div>
                <div class="loginbox-textbox">
                    <input value="" class="form-control" placeholder="用户名" name="username" type="text">
                </div>
                <div class="loginbox-textbox">
                    <input class="form-control" placeholder="密码" name="password" type="password">
                </div>
                <div class="loginbox-textbox">
                    <input class="form-control" style="width: 100px;float: left;" placeholder="验证码" name="code" type="text" >
                    <img src="<?php echo url('verify'); ?>" alt="验证码" style="float: left;margin-left: 10px;cursor: pointer;" onclick="this.src='<?php echo url('verify'); ?>?'+Math.random();"/>
                </div>
                <div class="loginbox-submit" style="margin-top: 40px;">
                    <input class="btn btn-primary btn-block" value="登录" type="submit">
                </div>
                <div class="loginbox-textbox">
                    <p class="text-center">
                        <a  href="<?php echo url('register'); ?>">还没有账号？点击这里注册</a>
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
    <!--Basic Scripts-->
    <script src="__ADMIN__/style/jquery-1.11.1.js"></script>
    <script src="__ADMIN__/style/bootstrap.js"></script>
    <!--Beyond Scripts-->
    <script src="__ADMIN__/style/beyond.js"></script>




</body><!--Body Ends--></html>