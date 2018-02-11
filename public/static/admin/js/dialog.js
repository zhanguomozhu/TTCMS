var dialog = {

    layer : layui.use('layer',this.getLayer),

    //获取layer
    getLayer : function(){
        var that = this;
        layui.use('layer', function(){
            that.layer = layui.layer;
        });
    },

    // 错误弹出层
    error : function(message) {
        this.getLayer();
        this.layer.open({
            content:message,
            icon:2,
            title : '错误提示',
        });
    },

    //成功弹出层
    success : function(message,url) {
        this.getLayer();
        this.layer.open({
            content : message,
            icon : 1,
            yes : function(){
                location.href=url;
            },
        });
    },

    // 确认弹出层
    confirm : function(message, url) {
        var that = this;
        that.getLayer();
        that.layer.open({
            content : message,
            icon:3,
            btn : ['是','否'],
            yes : function(index){
                //关闭本窗口
                that.layer.close(index);
                //跳转
                location.href=url;
            },
        });
    },

    //无需跳转到指定页面的确认弹出层,get提交
    toconfirm : function(message,url) {
        var that = this;
        that.getLayer();
        that.layer.open({
            content : message,
            icon:3,
            btn : ['确定','取消'],
            yes : function(index){
                //关闭本窗口
                that.layer.close(index);
                $.get(url,{},function(res){
                    //成功
                    if(res.code == 1){
                        //提示成功信息
                        that.msg(res.msg,1,1000,0);
                        //刷新当前页面
                        if(res.url) {
                            location.href = res.url;
                        }else{
                            location.reload();
                        }
                    }
                    //失败
                    if(res.code == 0){
                        that.msg(res.msg,2,1000,6);
                    }
                },'json')
            },
        });
    },

    //消息弹窗
    msg : function(message,icon,time,anim,url){
        this.getLayer();
        this.layer.msg(message,{icon: icon,time: time,anim: anim },function(){
            if(url) location.href = url;
        });
    },
}

