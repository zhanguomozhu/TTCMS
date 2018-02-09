/**
 * 登录业务类
 * @author singwa
 */
var login = {
    
    check : function() {
        // 获取登录页面中的用户名 和 密码
        var username = $('input[name="username"]').val();
        var password = $('input[name="password"]').val();
        var code     = $('input[name="code"]').val();

        if(!username) {
            dialog.msg('用户名不能为空',2,1000,6);
            return;
        }
        if(!password) {
            dialog.msg('密码不能为空',2,1000,6);
            return;
        }
        if(!code) {
            dialog.msg('验证码不能为空',2,1000,6);
            return;
        }

        var url  = 'login';
        var data = {'username':username,'password':password,'code':code};

        // 执行异步请求  $.post
        $.post(url,data,function(res){
            if(res.code == 0) {
                dialog.msg(res.msg,2,1000,6);
                //更换验证码
                $('#captcha').attr('src','/admin/Login/verify?id='+Math.random());
            }
            if(res.code == 1) {
                dialog.msg(res.msg,1,1000,0,'/admin/Index/index');
            }

        },'JSON');

    }
}