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

    //登出
    loginout : function(url){
        $.post(url,{},function(res){
            if(res.code == 0) {
                dialog.msg(res.msg,2,1000,6);
            }
            if(res.code == 1) {
                dialog.msg(res.msg,1,1000,0,res.url);
            }
        },'json');
    },


    /**
     * 修改状态
     */
    setStatus : function(obj){
        var id     = $(obj).attr('attr-id');    //id
        var field  = $(obj).attr('attr-field'); //字段
        var status = $(obj).attr("attr-status");//状态值
        var arr    = $(obj).attr("attr-data").split('-');  //显示
        var url    = SCOPE.set_status_url;      //提交地址
        var color  = ['btn-danger','btn-success'];//颜色

        data = {};
        data['id']    = id;
        data[field]   = status;
        //发送
        $.post(url,data,function(res){
                if(res.code == 1) {
                    dialog.msg(res.msg,1,1000);
                    // 修改颜色
                    var st = status == 1 ? 0 : 1;//新值
                    var new_color = status == 1 ? 1 : 0;//新颜色
                    $(obj).removeClass(color[st]).addClass(color[new_color]);
                    //修改状态值
                    $(obj).attr("attr-status",st);
                    // 修改显示
                    $(obj).text(arr[status]);
                }
                if(res.code == 0) {
                    dialog.msg(res.msg,2,1000,6);
                }
            }
        ,"json");
    },

    /**
     * 排序
     */
    setOrder : function(obj){
        // 获取 listorder内容
        var form = $(obj).parents('form');
        var data = form.serializeArray();
        var url = SCOPE.listorder_url;

        $.post(url,data,function(res){
            if(res.code == 1) {
                dialog.msg(res.msg,1,1000,0,res.url);
            }
            if(res.code == 0) {
                // 失败
                dialog.msg(res.msg,2,1000,6);
            }
        },"json");
    },
 }



//添加，编辑文章选择栏目
$('#select_cate').change(function(){
    var category_id = $(this).val();
    location.href = '/admin/Article/add/category_id/'+category_id;
})