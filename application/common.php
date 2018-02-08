<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 查询对象转数组
 * @param  [type] $res [description]
 * @return [type]      [description]
 */
function obj_to_arr($res){
    return json_decode(json_encode($res),true);
}


/**
 * 新浪接口，通过ip获取所在城市
 * @return [type] [description]
 */
function getIpAddress(){  
    $ipContent   = file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js");  
    $jsonData = explode("=",$ipContent);    
    $jsonAddress = substr($jsonData[1], 0, -1);  
    return json_decode($jsonAddress,true);  
}

/**
 * 获取周几
 * @return [type] [description]
 */
function getWeek($date=null){
    if(!$date){
        return '星期'. mb_substr( "日一二三四五六",date("w"),1,"utf-8" ); 
    }
    $week = date("w",strtotime($date));
    return '星期'. mb_substr( "日一二三四五六",$week,1,"utf-8" );
}


/**
 * 缩略图生成
 * @param sting $src
 * @param intval $width
 * @param intval $height
 * @param boolean $replace
 * @param intval $type 
                 1、标识缩略图等比例缩放类型
                 2、标识缩略图缩放后填充类型 
                 3、标识缩略图居中裁剪类型
                 4、标识缩略图左上角裁剪类型
                 5、标识缩略图右下角裁剪类型
                 6、标识缩略图固定尺寸缩放类型
 * @return string
 */
function thumb($src = '', $width = 500, $height = 500, $type = 1, $replace = false) {
    $src = './'.$src;
    if(is_file($src) && file_exists($src)) {
        $ext = pathinfo($src, PATHINFO_EXTENSION);
        $name = basename($src, '.'.$ext);
        $dir = dirname($src);
        if(in_array($ext, array('gif','jpg','jpeg','bmp','png'))) {
            $name = $name.'_thumb_'.$width.'_'.$height.'.'.$ext;
            $file = $dir.'/'.$name;
            if(!file_exists($file) || $replace == TRUE) {
                $image = \think\Image::open($src);
                $image->thumb($width, $height, $type);
                $image->save($file);
            }
            $file=str_replace("\\","/",$file);
            $file = '/'.trim($file,'./');
            return $file;
        }
    }
    $src=str_replace("\\","/",$src);
    $src = '/'.trim($src,'./');
    return $src;
}

/**
 * 删除目录（包括下面的文件）
 * @return void
 */
function delDir($directory, $subdir = true) {
    if (is_dir($directory) == false) {
        return false;
    }
    $handle = opendir($directory);
    while (($file = readdir($handle)) !== false) {
        if ($file != "." && $file != "..") {
            is_dir("$directory/$file") ?delDir("$directory/$file") : unlink("$directory/$file");
        }
    }
    if (readdir($handle) == false) {
        closedir($handle);
        rmdir($directory);
    }
}

/**
 * 对一个给定的二维数组按照指定的键值进行排序
 * @return array
 */
function array_sort($arr,$keys,$type='asc'){  
    $keysvalue = $new_array = array();  
    foreach ($arr as $k=>$v){  
        $keysvalue[$k] = $v[$keys];  
    }  
    if($type == 'asc'){  
        asort($keysvalue);  
    }else{  
        arsort($keysvalue);  
    }  
    reset($keysvalue);  
    foreach ($keysvalue as $k=>$v){  
        $new_array[$k] = $arr[$k];  
    }  
    return $new_array;  
}


/**
 * 时间日期格式化为多少天前
 * @param sting|intval $date_time
 * @param intval $type 1、'Y-m-d H:i:s' 2、时间戳
 * @return string
 */
function format_datetime($date_time,$type=1,$format){
    if($type == 1){
        $timestamp = strtotime($date_time);
    }elseif($type == 2){
        $timestamp = $date_time;
        $date_time = date('Y-m-d H:i:s',$date_time);
    }
    if(isset($format)){
        return date($format,$timestamp);
    }
    $difference = time()-$timestamp;
    if($difference <= 180){
        return '刚刚';
    }elseif($difference <= 3600){
        return ceil($difference/60).'分钟前';
    }elseif($difference <= 86400){
        return ceil($difference/3600).'小时前';
    }elseif($difference <= 2592000){
        return ceil($difference/86400).'天前';
    }elseif($difference <= 31536000){
        return ceil($difference/2592000).'个月前';
    }else{
        return ceil($difference/31536000).'年前';
        //return $date_time;
    }
}




/**
 * curl获取数据
 * @param  [type]  $url  [description]
 * @param  integer $type [0 get ,1 post]
 * @param  array   $data [description]
 * @return [type]        [description]
 */
function doCurl($url,$type=0,$data=[])
{
    
    //初始化curl
    $ch = curl_init();  
    /* cURL 设置 */  
    curl_setopt($ch, CURLOPT_URL, $url);  
    //超时设置
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);  
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);  
    //0 不需要输出header头
    curl_setopt($ch, CURLOPT_HEADER, 0);  
    //返回结果不输出
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //post请求  
    if ($type == 1) {  
        curl_setopt($ch, CURLOPT_POST, true);  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);  
    } 
    //执行并获取数据
    $result = curl_exec($ch);
    //释放curl句柄
    curl_close($ch);  
  
    return $result;  
}



/**
 * 发送邮件
 * @param  string $value [description]
 * @return [type]        [description]
 */
function sendEmail($email,$title,$content)
{
    //引入邮件类
    $mail = new \phpmail\Email;
    //发送邮件
    if($res = $mail->send($email,$title,$content)){
        return true;
    }else{
        return false;
    }
}


/**
 * 发送短信
 * @param  string $value [description]
 * @return [type]        [description]
 */
function sendPhone($phone,$content)
{
   //加载阿里大鱼短信类
    include EXTEND_PATH.'alidayu/TopSdk.php';//载入阿里大鱼
    $alidayu = new \TopClient();
    //加载配置
    $ali = config('sms.alidayu');
    $alidayu->appkey    = $ali['appkey'];       //appkey
    $alidayu->secretKey = $ali['secretKey'];    //secretKey
    $req = new \AlibabaAliqinFcSmsNumSendRequest();
    $req->setSmsType("normal");                    //业务参数
    $req->setSmsFreeSignName($ali['freeSignName']);//你在阿里大于设置的那个freeSignName
    $req->setSmsParam("{code:'" . $content . "'}");//我只是用来做验证码，因此只有这一个
    $req->setRecNum($phone);                       //手机号码
    $req->setSmsTemplateCode($ali['smsTemplateCode']);//自己的编号
    $res = $alidayu->execute($req);//发送
    if (isset($res->err_code) && $res->err_code == 0) {
        //成功
        return ['code'=>1];
    } else {
        //不成功
        return ['code'=>0,'msg'=>$res->msg];
    }
}






 /**
 * 获取无限分类树
 * @return [type] [默认0，带前缀；1，不带前缀；2，子排序]
 * @return [access] [array,权限判断]
 * @return [type] [description]
 */
function getTree($data,$type=0,$access=null,$field='title')
{
    switch ($type) {
        case 0:
            return qsort($data,$field);
            break;
        case 1:
            return nsort($data);
            break;
        case 2:
            return ssort($data,0,$access);
            break;
    }
}

/**
 * 排序带前缀
 * @param  [type]  $data [数据源]
 * @param  integer $pid  [父id]
 * @return [type]        []
 */
function qsort($data,$field,$pid=0,$level=0)
{
    static $arr = array();
    $depth_html = '';
    foreach ($data as $k => $v) {
        if($v['pid'] == $pid){  
            for ($i=0; $i <$level; $i++) { 
                if($i == 0){
                    $depth_html = '|';
                }
                $depth_html .= '——';
            }
            $v[$field] = $depth_html.$v[$field];
            $arr[] = $v;
            qsort($data,$field,$v['id'],$level+1);
        }
    }
    
    return $arr;
}


 /**
 * 排序不带前缀
 * @param  [type]  $data [数据源]
 * @param  integer $pid  [父id]
 * @return [type]        []
 */
function nsort($data,$pid=0)
{
    static $arr = array();
    foreach ($data as $k => $v) {
        if($v['pid'] == $pid){  
            $arr[] = $v;
            nsort($data,$v['id']);
            
        }
    }
    return $arr;
}



 /**
 * 子排序
 * @param  [type]  $data [数据源]
 * @param  integer $pid  [父id]
 * @param  array $access [节点字符串]判断是否有权限
 * @return [type]        []
 */
function ssort($data,$pid=0,$access=null)
{
    $arr = array();
    foreach ($data as $v) {
        if(is_array($access)){
            $v['access'] = in_array($v['id'],$access) ? 1 : 0;
        }
        if($v['pid'] == $pid){ 
            $v['child'] =ssort($data,$v['id'],$access); 
            $arr[] = $v;
        }
    }
    return $arr;
}




/**
 * 根据子分类id获取所有父级分类
 * @param  [type] $data [description]
 * @param  [type] $id   [description]
 * @param  [type] $field[需要取的字段]
 * @param  [type] $sort [排序，默认0从小到大]
 * @return [type]       [description]
 */
function getParents($data,$id,$field=null,$sort=0,$clear=false){
    static $array = array();
    //清空缓存数组
    if($clear){
        $array = array();
    }
    foreach ($data as $v) {
        if($v['id'] == $id){
            if(!is_array($field)){
                $array[] = $field ? $v[$field] : $v;//获取所有数据
            }else{
                $list = array();
                foreach ($field as $v1) {//遍历字段
                   $list[$v1] = $v[$v1];
                }
                $array[] = $list;
            }
            getParents($data,$v['pid'],$field);
        }
    }
    //从小到大排序
    asort($array);
    //翻转数组
    if($sort){
        $array = array_reverse($array);
    }
    return $array;
}



/**
 * 根据子父级分类id获取所有子级分类
 * @param  [type] $data [description]
 * @param  [type] $id   [description]
 * @param  [type] $field[需要取的字段]
 * @param  [type] $sort [排序，默认0从小到大]
 * @return [type]       [description]
 */
function getSons($data,$pid,$field=null,$sort=0,$clear=false){
    static $array = array();
    //清空数组
    if($clear){
        $array = array();
    }
    foreach ($data as $v) {
        if($v['pid'] == $pid){
            if(!is_array($field)){
                $array[] = $field ? $v[$field] : $v;//获取所有数据
            }else{
                $list = array();
                foreach ($field as $v1) {//遍历字段
                   $list[$v1] = $v[$v1];
                }
                $array[] = $list;
            }
            getSons($data,$v['id'],$field);
        }
    }
    //从小到大排序
    asort($array);
    //翻转数组
    if($sort){
        $array = array_reverse($array);
    }
    return $array;
}