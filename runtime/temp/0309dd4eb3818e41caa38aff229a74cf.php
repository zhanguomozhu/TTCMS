<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:74:"D:\phpStudy\WWW\TLCMS\public/../application/admin\view\login\register.html";i:1516331401;}*/ ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"><!--Head--><head>
    <meta charset="utf-8">
    <title>注册</title>
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
        <form action="<?php echo url('register'); ?>" method="post">
            <div class="loginbox bg-white">
                <div class="loginbox-title">管理员注册</div>
                <div class="loginbox-textbox" id="username">
                    <input value="" class="form-control" placeholder="用户名" name="username" type="text" onchange="check()">
                    <span class="red"></span>
                    <span class="success"></span>
                </div>
                <div class="loginbox-textbox" id="password">
                    <input class="form-control" placeholder="密码" name="password" type="password" onchange="check()">
                    <span class="red"></span>
                    <span class="success"></span>
                </div>
                <div class="loginbox-textbox" id="password1">
                    <input class="form-control" placeholder="确认密码" name="password1" type="password" onchange="check()">
                    <span class="red"></span>
                    <span class="success"></span>
                </div>
                <div class="loginbox-textbox" id="phone">
                    <input class="form-control" placeholder="手机号" name="phone" type="text" onchange="check()">
                    <span class="red"></span>
                    <span class="success"></span>
                </div>
                <div class="loginbox-textbox" id="code">
                    <input class="form-control" style="width: 115px;float: left;margin-right: 3px;" placeholder="手机验证码" name="code" type="text" onchange="check()">
                    <a href="javascript:void(0);" style="width: 100px;" class="btn btn-success" id="send">获取验证码</a>
                    <span class="red"></span>
                    <span class="success"></span>
                </div>
                <div class="loginbox-submit">
                    <input class="btn btn-primary btn-block" value="注册" type="submit" id="sub">
                </div>
                <div class="loginbox-textbox">
                    <p class="text-center">
                        <a  href="<?php echo url('login'); ?>">已有账号点击这里登录</a>
                    </p>
                </div>
            </div>
                <div class="logobox">
                    <p class="text-center" style="margin-top: 10px;">TTCMS @2017-2018</p>
                </div>
        </form>
    </div>
    <!--Basic Scripts-->
    <script src="__ADMIN__/style/jquery-1.11.1.js"></script>
    <script src="__ADMIN__/style/bootstrap.js"></script>
    <!--Beyond Scripts-->
    <script type="text/javascript">
    //60秒倒计时
    var countdown=60;
    function settime(obj) {
        if (countdown == 0) { 
            obj.removeAttribute("disabled");    
            obj.innerText="点击发送"; 
            countdown = 60; 
            return;
        } else { 
            obj.setAttribute("disabled", true); 
            obj.innerText="重新发送(" + countdown + ")"; 
            countdown--; 
        }
        setTimeout(function() { 
            settime(obj) 
        },1000);
    }
    


    //验证用户名   
    $("input[name='username']").focus(function(){
        $("#username .red").html('中文、字母、数字等组合,4-18个字符');
    });

    //验证用户名是否存在
    $("input[name='username']").blur(function(){
        if($(this).val().length!=0)
        {
            if($(this).val().length>18 || $(this).val().length<6){
                 $("#username .red").html('用户名长度为4-18个字符');
            }else{
                $.post("<?php echo url('login/yanzheng'); ?>",{username:$(this).val()},function(res){
                    if(res.code == 1031){
                        $("#username .red").html(res.msg);
                    }
                    if(res.code == 1032){
                        $("#username .red").html('');
                        $("#username .success").html(res.msg);
                    }
                },"json"); 
            }
        }else{
             $("#username .red").html('用户名不能为空');
        }
           
    });

    //验证密码
    $("input[name='password']").focus(function(){
        $("#password .red").html("中文、字母、数字等组合,4-18个字符");
    });
    //验证密码是否为空
    $("input[name='password']").blur(function(){
        if($(this).val().length>18 || $(this).val().length<4){
            $("#password .red").html('密码不能为空');
        }else{
            $("#password .red").html('');
            $("#password .success").html('输入密码');
        }
    });


    //验证重复密码
    $("input[name='password1']").focus(function(){
        $("#password1 .red").html("请再次输入密码！");
    });
    //验证密码是否一致
    $("input[name='password1']").blur(function(){
        if($(this).val()!=$("input[name='password']").val()){
            $("#password1 .red").html('密码不一致');
        }
        if($(this).val()!='' && $(this).val()==$("input[name='password']").val()){
            $("#password1 .red").html('');
            $("#password1 .success").html('密码一致');
        }
     });
    //验证手机
    $("input[name='phone']").focus(function(){
        $("#phone .red").html("建议使用常用手机！");
    });
   

     $("input[name='phone']").blur(function(){ 
        //验证手机是否为空和长度
        if($(this).val().length!=11 || $(this).val().length==0){
            $("#phone .red").html('手机号不能为空，长度11位');
        }else{
            //验证手机号码是否已注册
            if($(this).val().match(/^1[34578]\d{9}$/))
            {
                $.post("<?php echo url('login/yanzheng'); ?>",{phone:$(this).val()},function(res){
                    if(res.code == 1033){
                        $("#phone .red").html(res.msg);
                    }
                    if(res.code == 1034){
                        $("#phone .red").html('');
                        $("#phone .success").html(res.msg);
                    }
                },"json");  
            }else{
                $("#phone .red").html('手机号格式不正确');
            }
        }
        
    });


    //手机验证码
    $('#send').click(function(){
        $.post("<?php echo url('login/sendPhone'); ?>",{phone:$("input[name='phone']").val()},function(res){
            console.log(res)
        },'json');
        settime(this);
    })



    function check(){
        var username = $("input[name='username']").val();
        var password = $("input[name='password']").val();
        var password1 = $("input[name='password1']").val();
        var phone = $("input[name='phone']").val();
        //var code = $("input[name='code']").val();
        if(!username || !password || !password1 || !phone){
            $('#sub').attr('disabled',true);
        }else{
            $('#sub').attr('disabled',false);
        }
    }
    check();
    </script>



</body><!--Body Ends--></html>