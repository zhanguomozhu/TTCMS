/**
 * 注册js
 */

 var register = {

 	check : function() {
        // 获取登录页面中的用户名 和 密码
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();
        var password1= $('input[name="password1"]').val();
        var phone    = $('input[name="phone"]').val();
        var code     = $('input[name="code"]').val();
        var email    = $('input[name="email"]').val();

        if(!username) {
            dialog.msg('用户名不能为空',2,1000,6);
            return;
        }
        if(!password) {
            dialog.msg('密码不能为空',2,1000,6);
            return;
        }
        if(!password1) {
            dialog.msg('重复密码不能为空',2,1000,6);
            return;
        }
        if(!phone) {
            dialog.msg('手机号码不能为空',2,1000,6);
            return;
        }
        if(!code) {
            dialog.msg('验证码不能为空',2,1000,6);
            return;
        }
        if(!email) {
            dialog.msg('邮箱不能为空',2,1000,6);
            return;
        }

        var url  = 'register';
        var data  = {'username':username,'password':password,'phone':phone,'email':email};

        // 执行异步请求  $.post
        $.post(url,data,function(res){
            if(res.code == 0) {
                dialog.msg(res.msg,2,1000,6);
            }
            if(res.code == 1) {
                dialog.msg(res.msg,1,1000,0,'/admin/Login/login');
            }
        },'json');
    },

    //验证
    verify : function(type){
        // 获取登录页面中的用户名 和 密码
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();
        var password1= $('input[name="password1"]').val();
        var phone    = $('input[name="phone"]').val();
        var code     = $('input[name="code"]').val();
        var email    = $('input[name="email"]').val();
        var url = '/admin/Login/yanzheng';
        switch(type){
            case 'username':
                //用户名
                if(username.length>18 || username.length<6){
                    dialog.msg('用户名长度为6-18个字符',2,1000,6);
                }else{
                    $.post(url,{username:username},function(res){
                        if(res.code == 0){
                            dialog.msg(res.msg,2,1000,6);
                        }
                        if(res.code == 1){
                            dialog.msg(res.msg,1,1000);
                        }
                    },"json");
                }
            break;
            case 'password':
                //密码
                if(password.length>18 || password.length<6){
                    dialog.msg('中文、字母、数字等组合,6-18个字符',2,1000,6);
                }
            break;
            case 'password1':
                //重复密码
                if(password1 != password){
                    dialog.msg('密码不一致',2,1000,6);
                }else{
                    dialog.msg('密码一致',1,1000);
                }
            break;
            case 'phone':
                //手机
                if(phone.length != 11){
                    dialog.msg('手机号长度为11位',2,1000,6);
                }else if(!phone.match(/^1[34578]\d{9}$/)){
                    dialog.msg('请输入正确格式手机号',2,1000,6);
                }else{
                    $.post(url,{phone:phone},function(res){
                        if(res.code == 0){
                            dialog.msg(res.msg,2,1000,6);
                        }
                        if(res.code == 1){
                            dialog.msg(res.msg,1,1000);
                        }
                    },"json");
                }
            break;
            case 'email':
                //邮箱
                if(!email.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/)){
                    dialog.msg('请输入正确格式email',2,1000,6);
                }else{
                    $.post(url,{email:email},function(res){
                        if(res.code == 0){
                            dialog.msg(res.msg,2,1000,6);
                        }
                        if(res.code == 1){
                            dialog.msg(res.msg,1,1000);
                        }
                    },"json");
                }
            break;
            case 'code':
                if(code.length != 6){
                    dialog.msg('验证错误',2,1000,6);
                }else{
                    $.post(url,{code:code},function(res){
                        if(res.code == 0){
                            dialog.msg(res.msg,2,1000,6);
                            return false;
                        }
                        if(res.code == 1){
                            dialog.msg(res.msg,1,1000);
                        }
                    },"json");
                }
            break;
        }
    },
 }