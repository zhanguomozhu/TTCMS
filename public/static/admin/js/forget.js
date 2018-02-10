/**
 * 忘记密码
 */

 var forget = {
 	//选择验证方式
 	choose : function(type){
		switch(type){
			case 'phone':
				$('.phone').css('display','block');
				$('.email').css('display','none');
			break;
			case 'email':
				$('.phone').css('display','none');
				$('.email').css('display','block');
			break;
		}
 	},

 	check : function(type){
 		var username  = $('input[name="username"]').val();
        var phone     = $('input[name="phone"]').val();
        var email     = $('input[name="email"]').val();
        var phone_code= $('input[name="phone_code"]').val();
        var email_code= $('input[name="email_code"]').val();
        var phone_password= $('#phone_password input').val();
        var email_password= $('#email_password input').val();
        var url       = '/admin/Login/forget';
        if(!username) {
            dialog.msg('用户名不能为空',2,1000,6);
            return;
        }

        switch(type){
			case 'phone':
		        if(!phone) {
		            dialog.msg('手机号码不能为空',2,1000,6);
		            return;
		        }
		        if(!phone.match(/^1[34578]\d{9}$/)){
                    dialog.msg('请输入正确格式手机号',2,1000,6);
                }
		        if(!phone_code) {
		            dialog.msg('手机验证码不能为空',2,1000,6);
		            return;
		        }
		        if(!phone_password) {
		            dialog.msg('新密码不能为空',2,1000,6);
		            return;
		        }
		        //重置密码
		        $.post(url,{username:username,phone:phone,password:phone_password},function(res){
                    if(res.code == 0){
                        dialog.msg(res.msg,2,1000,6);
                    }
                    if(res.code == 1){
                        dialog.msg(res.msg,1,1000,0,'/admin/Login/login');
                    }
                },"json");
			break;
			case 'email':
		        if(!email) {
		            dialog.msg('邮箱不能为空',2,1000,6);
		            return;
		        }
		        if(!email.match(/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/)){
                    dialog.msg('请输入正确格式email',2,1000,6);
                }
		        if(!email_code) {
		            dialog.msg('邮箱验证码不能为空',2,1000,6);
		            return;
		        }
		        if(!email_password) {
		            dialog.msg('新密码不能为空',2,1000,6);
		            return;
		        }

		        //重置密码
		        $.post(url,{username:username,email:email,password:email_password},function(res){
                    if(res.code == 0){
                        dialog.msg(res.msg,2,1000,6);
                    }
                    if(res.code == 1){
                        dialog.msg(res.msg,1,1000,0,'/admin/Login/login');
                    }
                },"json");
			break;
		}
 	},

 	verify : function(obj,type){
 		var username  = $('input[name="username"]').val();
 		var phone     = $('input[name="phone"]').val();
        var email     = $('input[name="email"]').val();
 		var url       = '/admin/Login/forgetCheck';
 		var data      = $(obj).val();

        this.noClick();

 		switch(type){
			case 'username':
				$.post(url,{username:username},function(res){
                    if(res.code == 0){
                        dialog.msg(res.msg,2,1000,6);
                    }
                    if(res.code == 1){
                        dialog.msg(res.msg,1,1000);
                    }
                },"json");
			break;
			case 'phone':
				$.post(url,{username:username,phone:data},function(res){
                    if(res.code == 0){
                        dialog.msg(res.msg,2,1000,6);
                        //发送验证码
                        $("#phone_code_sub").attr('disabled',true);
                    }
                    if(res.code == 1){
                        dialog.msg(res.msg,1,1000);
                        //发送验证码
                        $("#phone_code_sub").attr('disabled',false);
                    }
                },"json");
			break;
			case 'email':
				$.post(url,{username:username,email:data},function(res){
                    if(res.code == 0){
                        dialog.msg(res.msg,2,1000,6);
                        //发送验证码
                        $("#email_code_sub").attr('disabled',true);
                    }
                    if(res.code == 1){
                        dialog.msg(res.msg,1,1000);
                        //发送验证码
                        $("#email_code_sub").attr('disabled',false);
                    }
                },"json");
			break;
			case 'phone_code':
				$.post(url,{phone:phone,phone_code:data},function(res){
                    if(res.code == 0){
                        dialog.msg(res.msg,2,1000,6);
                        //禁止提交
                        $("#phone_sub").attr('disabled',true);
                    }
                    if(res.code == 1){
                        dialog.msg(res.msg,1,1000);
                        $('#phone_password').css('display','block');
                        $('#email_password').css('display','none');
                        $('.bg-all').attr('style','height: 480px!important;');
                    }
                },"json");
			break;
			case 'email_code':
				$.post(url,{email:email,email_code:data},function(res){
                    if(res.code == 0){
                        dialog.msg(res.msg,2,1000,6);
                        //禁止提交
                        $("#email_sub").attr('disabled',true);
                    }
                    if(res.code == 1){
                        dialog.msg(res.msg,1,1000);
                        $('#email_password').css('display','block');
                        $('#phone_password').css('display','none');
                        $('.bg-all').attr('style','height: 480px!important;');
                    }
                },"json");
			break;
		}

 	},

    //禁止提交
    noClick : function(){
        var username  = $('input[name="username"]').val();
        var phone     = $('input[name="phone"]').val();
        var email     = $('input[name="email"]').val();
        var phone_code= $('input[name="phone_code"]').val();
        var email_code= $('input[name="email_code"]').val();
        var phone_password= $('#phone_password input').val();
        var email_password= $('#email_password input').val();
        if(username && phone && phone_code && phone_password){
            $("#phone_sub").attr('disabled',false);
        }else{
            $("#phone_sub").attr('disabled',true);
        }
        if(username && email && email_code && email_password){
            $("#email_sub").attr('disabled',false);
        }else{
            $("#email_sub").attr('disabled',true);
        }
    },

 }