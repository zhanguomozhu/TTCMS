<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 刘志淳 <chun@engineer.com>
// +----------------------------------------------------------------------
namespace think\template\taglib;

use think\Request;
use think\template\TagLib;

/**
 *  <!-- 声明使用 TagLib -->
 *  <!-- {taglib name="TT" /} -->
 *  <!-- 在需要使用 标签的地方插入 -->
 *  <!-- {TT:webuploader src="__OTHER__/webuploader" name="avatar" url="<?php echo url('edit'); ?>" filenum='1' max='2'/} -->
 */

class TT extends TagLib
{
    // 标签定义
    protected $tags = [
        // 标签定义： attr 属性列表 close 是否闭合（0 或者1 默认1） alias 标签别名 level 嵌套层次
        // 
        //百度完整版编辑器<ueditor src='__PUBLIC__/Other/ueditor' id='des' name='description' height='300' width="800"/>
        'ueditor'=>array('attr'=>'src,id,name,content,width,height','close'=>0),

        //百度迷你版编辑器<umeditor src='__PUBLIC__/Other/umeditor' id='des' name='description' height='300' width="800"/>
        'umeditor'=>array('attr'=>'src,id,name,content,width,height','close'=>0),

        //webuploader异步上传<webuploader src='__PUBLIC__/Other/webuploader' name="image" url="{:U('Admin/Product/ajax_upload')}" filenum="5" max="2"/>
        'webuploader'=>array('attr'=>'src,name,url,filenum,max','close'=>0),
    ];


    /**
    * 引入ueidter编辑器完整版
    * @param string $tag  name:表单name content：编辑器初始化后 默认内容
    */
    public function tagUeditor($tag,$content){
        $src     = isset($tag['src'])     ? $tag['src']     : '__OTHER__/ueditor';
        $id      = isset($tag['id'])      ? $tag['id']      : 'container';
        $name    = isset($tag['name'])    ? $tag['name']    : 'content';
        $content = isset($tag['content']) ? $tag['content'] : '';
        $width   = isset($tag['width'])   ? $tag['width']   : '100%';
        $height  = isset($tag['height'])  ? $tag['height']  : '300';

        $parseStr = '';

        //加载静态资源
        $parseStr .= "<!-- 配置文件 --><script type='text/javascript' src='{$src}/ueditor.config.js'></script>";
        $parseStr .= "<!-- 编辑器源码文件 --><script type='text/javascript' src='{$src}/ueditor.all.min.js'></script>";
        $parseStr .= "<!-- 字体文件 --><script type='text/javascript' charset='utf-8' src='{$src}/lang/zh-cn/zh-cn.js'></script>";
        //加载编辑器容器
        $parseStr .= "<!-- 加载编辑器的容器 --><script id='{$id}' name='{$name}' type='text/plain'>{$content}</script>";
        //实例化编辑器
        $parseStr .= "<!-- 实例化编辑器 -->
                    <script>
                        var um = UE.getEditor('container',{
                            initialFrameWidth:'{$width}',
                            initialFrameHeight:'{$height}',
                            toolbars: [[
                                'fullscreen',  'undo', 'redo', '|',
                                'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
                                'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
                                'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
                                'directionalityltr', 'directionalityrtl', 'indent', '|',
                                'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
                                'link', 'unlink', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
                                'simpleupload', 'emotion', 'scrawl', 'insertvideo', 'music', 'map',   'insertcode', 'template', '|',
                                'horizontal', 'date', 'time', 'spechars', '|',
                                'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
                                 'searchreplace', 'drafts'
                            ]],
                            autoHeightEnabled:false,
                            catchRemoteImageEnable:true
                        });
                    </script>";
        return $parseStr;
    }


    /**
    * 引入ueidter编辑器完整版
    * @param string $tag  name:表单name content：编辑器初始化后 默认内容
    */
    public function tagUmeditor($tag,$content){
        $src     = isset($tag['src'])     ? $tag['src']     : '__OTHER__/ueditor';
        $id      = isset($tag['id'])      ? $tag['id']      : 'container';
        $name    = isset($tag['name'])    ? $tag['name']    : 'content';
        $content = isset($tag['content']) ? $tag['content'] : '';
        $width   = isset($tag['width'])   ? $tag['width']   : '100%';
        $height  = isset($tag['height'])  ? $tag['height']  : '300';

        $parseStr = '';

        //加载静态资源
        $parseStr .= "<!-- 样式 --><link rel='stylesheet' href='{$src}/themes/default/css/umeditor.css'>";
        $parseStr .= "<!-- 配置文件 --><script type='text/javascript' src='{$src}/umeditor.config.js'></script>";
        $parseStr .= "<!-- 编辑器源码文件 --><script type='text/javascript' src='{$src}/umeditor.js'></script>";
        $parseStr .= "<!-- 字体文件 --><script type='text/javascript' charset='utf-8' src='{$src}/lang/zh-cn/zh-cn.js'></script>";
        //加载编辑器容器
        $parseStr .= "<!-- 加载编辑器的容器 --><script id='{$id}' name='{$name}' type='text/plain'>{$content}</script>";
        //实例化编辑器
        $parseStr .= "<!-- 实例化编辑器 -->
                    <script>
                        $(function(){
                            window.um = UM.getEditor('container',{
                                initialFrameWidth:'{$width}',
                                initialFrameHeight:'{$height}',
                            });
                        });
                    </script>";
        return $parseStr;
    }

     /**
     * webupload上传标签
     * @param string $tag  
     * url：上传的图片处理的控制器方法   
     * name：表单name   
     * filenum:文件个数
     */
    public function tagWebuploader($tag){
        $src     = isset($tag['src'])     ? $tag['src']     : '__OTHER__/webuploader';
        $url     = isset($tag['url'])     ? $tag['url']     : '';
        $name    = isset($tag['name'])    ? $tag['name']    : 'file_name';
        $filenum = isset($tag['filenum']) ? $tag['filenum'] : '10';
        $max     = isset($tag['max'])     ? $tag['max']     : '5';
        $id_name = 'upload-'.uniqid();

        $parseStr=<<<str
<!--引入样式jq-->
<link rel="stylesheet" href="{$src}/xb-webuploader.css">
<style type="text/css">
    .xb-uploader{border: 3px dashed #e6e6e6;padding-top: 10px;}
    .filelist li{margin-left: 2px;}
</style>

<!-- 引入html -->
<div id="{$id_name}" class="xb-uploader">
    <div class="queueList">
        <div class="placeholder">
            <div class="filePicker"></div>
            <p>或将照片拖到这里，单次最多可选{$filenum}张,最大不能超过{$max}M</p>
        </div>
    </div>
    <div class="statusBar" style="display:none;">
        <div class="progress">
            <span class="text">0%</span>
            <span class="percentage"></span>
        </div>
        <div class="info"></div>
        <div class="btns">
            <div class="webuploader-container filePicker2">
                <div class="webuploader-pick">继续添加</div>
                <div style="position: absolute; top: 0px; left: 0px; width: 1px; height: 1px; overflow: hidden;" id="rt_rt_1armv2159g1o1i9c2a313hadij6">
                </div>
            </div>
            <div class="uploadBtn">开始上传</div>
        </div>
    </div>
</div>

<!-- 引入webupload.js主文件 -->
<script src="{$src}/webuploader.min.js"></script>

<!-- 引入webupload.js配置 -->
<script>
jQuery(function() {
    var \$ = jQuery,    // just in case. Make sure it's not an other libaray.

        \$wrap = \$("#$id_name"),

        // 图片容器
        \$queue = \$('<ul class="filelist"></ul>')
            .appendTo( \$wrap.find('.queueList') ),

        // 状态栏，包括进度和控制按钮
        \$statusBar = \$wrap.find('.statusBar'),

        // 文件总体选择信息。
        \$info = \$statusBar.find('.info'),

        // 上传按钮
        \$upload = \$wrap.find('.uploadBtn'),

        // 没选择文件之前的内容。
        \$placeHolder = \$wrap.find('.placeholder'),

        // 总体进度条
        \$progress = \$statusBar.find('.progress').hide(),

        // 添加的文件数量
        fileCount = 0,

        // 添加的文件总大小
        fileSize = 0,

        // 优化retina, 在retina下这个值是2
        ratio = window.devicePixelRatio || 1,

        // 缩略图大小
        thumbnailWidth = 110 * ratio,
        thumbnailHeight = 110 * ratio,

        // 可能有pedding, ready, uploading, confirm, done.
        state = 'pedding',

        // 所有文件的进度信息，key为file id
        percentages = {},

        supportTransition = (function(){
            var s = document.createElement('p').style,
                r = 'transition' in s ||
                      'WebkitTransition' in s ||
                      'MozTransition' in s ||
                      'msTransition' in s ||
                      'OTransition' in s;
            s = null;
            return r;
        })(),
        thisSuccess,
        // WebUploader实例
        uploader;

    if ( !WebUploader.Uploader.support() ) {
        alert( 'Web Uploader 不支持您的浏览器！如果你使用的是IE浏览器，请尝试升级 flash 播放器');
        throw new Error( 'WebUploader does not support the browser you are using.' );
    }

    // 实例化
    uploader = WebUploader.create({
        pick: {
            id: "#$id_name .filePicker",
            label: '点击选择文件',
            multiple : true
        },
        dnd: "#$id_name .queueList",
        paste: document.body,
        // accept: {
        //     title: 'Images',
        //     extensions: 'gif,jpg,jpeg,bmp,png',
        //     mimeTypes: 'image/*'
        // },

        // swf文件路径
        swf:"{$src}/Uploader.swf",

        disableGlobalDnd: true,

        chunked: true,//是否要分片处理大文件上传。
        server: "{$url}",//服务器地址
        fileNumLimit: {$filenum},//文件上传个数
        fileSizeLimit:{$max} * 1024 * 1024,    // 200 M
        fileSingleSizeLimit: 50 * 1024 * 1024    // 50 M
    });

    // 添加“添加文件”的按钮，
    uploader.addButton({
       id: "#$id_name .filePicker2",
       label: '继续添加'
    });

    // 当有文件添加进来时执行，负责view的创建
    function addFile( file ) {
        var \$li = \$( '<li id="' + file.id + '">' +
                '<p class="title">' + file.name + '</p>' +
                '<p class="imgWrap"></p>'+
                '<p class="progress"><span></span></p>' +
                '<input class="bjy-filename" type="hidden" name="{$name}[]">'+
                '</li>' ),

            \$btns = \$('<div class="file-panel">' +
                '<span class="cancel">删除</span>' +
                '<span class="rotateRight">向右旋转</span>' +
                '<span class="rotateLeft">向左旋转</span></div>').appendTo( \$li ),
            \$prgress = \$li.find('p.progress span'),
            \$wrap = \$li.find( 'p.imgWrap' ),
            \$info = \$('<p class="error"></p>'),

            showError = function( code ) {
                switch( code ) {
                    case 'exceed_size':
                        text = '文件大小超出';
                        break;

                    case 'interrupt':
                        text = '上传暂停';
                        break;

                    default:
                        text = '上传失败，请重试';
                        break;
                }

                \$info.text( text ).appendTo( \$li );
            };

        if ( file.getStatus() === 'invalid' ) {
            showError( file.statusText );
        } else {
            // @todo lazyload
            \$wrap.text( '预览中' );
            uploader.makeThumb( file, function( error, src ) {
                if ( error ) {
                    \$wrap.text( '不能预览' );
                    return;
                }

                var img = \$('<img src="'+src+'">');
                \$wrap.empty().append( img );
            }, thumbnailWidth, thumbnailHeight );

            percentages[ file.id ] = [ file.size, 0 ];
            file.rotation = 0;
        }

        file.on('statuschange', function( cur, prev ) {
            if ( prev === 'progress' ) {
                \$prgress.hide().width(0);
            } else if ( prev === 'queued' ) {
                \$li.off( 'mouseenter mouseleave' );
                \$btns.remove();
            }

            // 成功
            if ( cur === 'error' || cur === 'invalid' ) {
                showError( file.statusText );
                percentages[ file.id ][ 1 ] = 1;
            } else if ( cur === 'interrupt' ) {
                showError( 'interrupt' );
            } else if ( cur === 'queued' ) {
                percentages[ file.id ][ 1 ] = 0;
            } else if ( cur === 'progress' ) {
                \$info.remove();
                \$prgress.css('display', 'block');
            } else if ( cur === 'complete' ) {
                \$li.append( '<span class="success"></span>' );
            }

            \$li.removeClass( 'state-' + prev ).addClass( 'state-' + cur );
        });

        \$li.on( 'mouseenter', function() {
            \$btns.stop().animate({height: 30});
        });

        \$li.on( 'mouseleave', function() {
            \$btns.stop().animate({height: 0});
        });

        \$btns.on( 'click', 'span', function() {
            var index = \$(this).index(),
                deg;

            switch ( index ) {
                case 0:
                    uploader.removeFile( file );
                    return;

                case 1:
                    file.rotation += 90;
                    break;

                case 2:
                    file.rotation -= 90;
                    break;
            }

            if ( supportTransition ) {
                deg = 'rotate(' + file.rotation + 'deg)';
                \$wrap.css({
                    '-webkit-transform': deg,
                    '-mos-transform': deg,
                    '-o-transform': deg,
                    'transform': deg
                });
            } else {
                \$wrap.css( 'filter', 'progid:DXImageTransform.Microsoft.BasicImage(rotation='+ (~~((file.rotation/90)%4 + 4)%4) +')');
                // use jquery animate to rotation
                // \$({
                //     rotation: rotation
                // }).animate({
                //     rotation: file.rotation
                // }, {
                //     easing: 'linear',
                //     step: function( now ) {
                //         now = now * Math.PI / 180;

                //         var cos = Math.cos( now ),
                //             sin = Math.sin( now );

                //         \$wrap.css( 'filter', "progid:DXImageTransform.Microsoft.Matrix(M11=" + cos + ",M12=" + (-sin) + ",M21=" + sin + ",M22=" + cos + ",SizingMethod='auto expand')");
                //     }
                // });
            }


        });

        \$li.appendTo( \$queue );
    }

    // 负责view的销毁
    function removeFile( file ) {
        var \$li = \$('#'+file.id);

        delete percentages[ file.id ];
        updateTotalProgress();
        \$li.off().find('.file-panel').off().end().remove();
    }

    function updateTotalProgress() {
        var loaded = 0,
            total = 0,
            spans = \$progress.children(),
            percent;

        \$.each( percentages, function( k, v ) {
            total += v[ 0 ];
            loaded += v[ 0 ] * v[ 1 ];
        } );

        percent = total ? loaded / total : 0;

        spans.eq( 0 ).text( Math.round( percent * 100 ) + '%' );
        spans.eq( 1 ).css( 'width', Math.round( percent * 100 ) + '%' );
        updateStatus();
    }

    function updateStatus() {
        var text = '', stats;

        if ( state === 'ready' ) {
            text = '选中' + fileCount + '个文件，共' +
                    WebUploader.formatSize( fileSize ) + '。';
        } else if ( state === 'confirm' ) {
            stats = uploader.getStats();
            if ( stats.uploadFailNum ) {
                text = '已成功上传' + stats.successNum+ '个文件，'+
                    stats.uploadFailNum + '个上传失败，<a class="retry" href="#">重新上传</a>失败文件或<a class="ignore" href="#">忽略</a>'
            }

        } else {
            stats = uploader.getStats();
            text = '共' + fileCount + '个（' +
                    WebUploader.formatSize( fileSize )  +
                    '），已上传' + stats.successNum + '个';

            if ( stats.uploadFailNum ) {
                text += '，失败' + stats.uploadFailNum + '个';
            }
            if (fileCount==stats.successNum && stats.successNum!=0) {
                $('#$id_name .webuploader-element-invisible').remove();
            }
        }

        \$info.html( text );
    }

    uploader.onUploadAccept=function(object ,ret){
        if(ret.error_info){
            fileError=ret.error_info;
            return false;
        }
    }

    uploader.onUploadSuccess=function(file ,response){
        \$('#'+file.id +' .bjy-filename').val(response.data.data)
    }
    uploader.onUploadError=function(file){
        alert(fileError);
    }

    function setState( val ) {
        var file, stats;
        if ( val === state ) {
            return;
        }

        \$upload.removeClass( 'state-' + state );
        \$upload.addClass( 'state-' + val );
        state = val;

        switch ( state ) {
            case 'pedding':
                \$placeHolder.removeClass( 'element-invisible' );
                \$queue.parent().removeClass('filled');
                \$queue.hide();
                \$statusBar.addClass( 'element-invisible' );
                uploader.refresh();
                break;

            case 'ready':
                \$placeHolder.addClass( 'element-invisible' );
                \$( "#$id_name .filePicker2" ).removeClass( 'element-invisible');
                \$queue.parent().addClass('filled');
                \$queue.show();
                \$statusBar.removeClass('element-invisible');
                uploader.refresh();
                break;

            case 'uploading':
                \$( "#$id_name .filePicker2" ).addClass( 'element-invisible' );
                \$progress.show();
                \$upload.text( '暂停上传' );
                break;

            case 'paused':
                \$progress.show();
                \$upload.text( '继续上传' );
                break;

            case 'confirm':
                \$progress.hide();
                \$upload.text( '开始上传' ).addClass( 'disabled' );

                stats = uploader.getStats();
                if ( stats.successNum && !stats.uploadFailNum ) {
                    setState( 'finish' );
                    return;
                }
                break;
            case 'finish':
                stats = uploader.getStats();
                if ( stats.successNum ) {
                    
                } else {
                    // 没有成功的图片，重设
                    state = 'done';
                    location.reload();
                }
                break;
        }
        updateStatus();
    }

    uploader.onUploadProgress = function( file, percentage ) {
        var \$li = \$('#'+file.id),
            \$percent = \$li.find('.progress span');

        \$percent.css( 'width', percentage * 100 + '%' );
        percentages[ file.id ][ 1 ] = percentage;
        updateTotalProgress();
    };

    uploader.onFileQueued = function( file ) {
        fileCount++;
        fileSize += file.size;

        if ( fileCount === 1 ) {
            \$placeHolder.addClass( 'element-invisible' );
            \$statusBar.show();
        }

        addFile( file );
        setState( 'ready' );
        updateTotalProgress();
    };

    uploader.onFileDequeued = function( file ) {
        fileCount--;
        fileSize -= file.size;

        if ( !fileCount ) {
            setState( 'pedding' );
        }

        removeFile( file );
        updateTotalProgress();

    };

    uploader.on( 'all', function( type ) {
        var stats;
        switch( type ) {
            case 'uploadFinished':
                setState( 'confirm' );
                break;

            case 'startUpload':
                setState( 'uploading' );
                break;

            case 'stopUpload':
                setState( 'paused' );
                break;

        }
    });

    uploader.onError = function( code ) {
        if(code === 'F_DUPLICATE'){
            alert('不能重复上传同一张图片');
        }else{
            alert( 'Eroor: ' + code );
        }
            
        
    };

    \$upload.on('click', function() {
        if ( \$(this).hasClass( 'disabled' ) ) {
            return false;
        }

        if ( state === 'ready' ) {
            uploader.upload();
        } else if ( state === 'paused' ) {
            uploader.upload();
        } else if ( state === 'uploading' ) {
            uploader.stop();
        }
    });

    \$info.on( 'click', '.retry', function() {
        uploader.retry();
    } );

    \$info.on( 'click', '.ignore', function() {
        alert( 'todo' );
    } );

    \$upload.addClass( 'state-' + state );
    updateTotalProgress();
});
</script>
str;
        return $parseStr;
    }

}