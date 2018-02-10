/**
 * 公共js
 */

 var common = {
 
    countdown : 60,//60秒倒计时

    //倒计时函数
    settime : function (obj,beforetxt,aftertxt,time) {
    	var that = this;
        if (this.countdown == 0) { 
            obj.removeAttribute("disabled");    
            obj.innerText = beforetxt ? beforetxt : '点击发送'; 
            this.countdown = 60; 
            return;
        } else { 
            obj.setAttribute("disabled", true); 
            obj.innerText = aftertxt ? aftertxt + '( '+ this.countdown +' )' : "重新发送(" + this.countdown + ")"; 
            this.countdown--; 
        }
        //定时器
        ttime = time ? time : 1000;
        setTimeout(function() {
            that.settime(obj,beforetxt,aftertxt);
        },ttime);
    },


    //发送验证码
    getCode : function(obj,type){
        switch(type){
            case 'phone':
                // 执行异步请求
                $.post('/admin/Login/sendPhone',{phone:$("input[name='phone']").val()},function(res){
                    if(res.code == 0) {
                        dialog.msg(res.msg,2,1000,6);
                    }
                    if(res.code == 1) {
                        dialog.msg(res.msg,1,1000);
                    }
                },'json');
            break;
            case 'email':
                // 执行异步请求
                $.post('/admin/Login/sendEmail',{email:$("input[name='email']").val()},function(res){
                    if(res.code == 0) {
                        dialog.msg(res.msg,2,1000,6);
                    }
                    if(res.code == 1) {
                        dialog.msg(res.msg,1,1000);
                    }
                },'json');
            break;
        }
        this.settime(obj);
    },
 }