<?php 
namespace org;
/**
*百度接口获取天气预报信息
**/

class Weather{
    private $ak;
    
    public function __construct($ak){
        if($ak){
            $this->ak=$ak;
        } else {
            die('参数错误');exit;
        }
        
    }
    
    /**
     * 获取城市名称
     * @param string $ip ip地址(必须为有效ip)
     * return string $city  城市名称，如武汉
    */
    public function getCity($ip=''){
        if(!$ip){
            $ip = $this->get_client_ip();
        }
        if($ip == "127.0.0.1"){
            $ips = file_get_contents("http://2017.ip138.com/ic.asp");
            //转换格式
            $str = iconv("GB2312","UTF-8",$ips);
            //ip
            preg_match("/(?:\[)(.*)(?:\])/i",$str, $arr1);
            $ip = $arr1[1];
            // //ip线路
            // preg_match('/(来自：)(.*)(<\/center>)/',$str,$arr2);
            // $isp = $arr2[2];

        }
        $ak=$this->ak;
        $content = file_get_contents("http://api.map.baidu.com/location/ip?ak=$ak&ip=$ip&coor=bd09ll");
        $json = json_decode($content,true);
        if($json['status']==2){
            $city='武汉';
        }else{
            $address=$json['address'];
            $cityarr=explode("|", $address);
            $city=$cityarr['2'];//不带"市",如"武汉",而不是"武汉市"
        }
        return $city;
    }
    
    /**
     * 获取天气预报信息
     * @param string $city  城市名称，如武汉
     * return array $data 天气信息 
    */
    public function weatherInfo($city=''){
        if(!$city){
            $city=$this->getCity();
        }
        $host = "http://jisutqybmf.market.alicloudapi.com";
        $path = "/weather/query";
        $method = "GET";
        $appcode = "1215c3a301254ee79ca773ce9054f2ca";//阿里云appcode
        $headers = array();
        array_push($headers, "Authorization:APPCODE " . $appcode);
        $querys = "city=$city&citycode=citycode&cityid=cityid&ip=ip&location=location";
        $bodys = "";
        $url = $host . $path . "?" . $querys;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_FAILONERROR, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        if (1 == strpos("$".$host, "https://"))
        {
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        }
        $result=curl_exec($curl);
        $data=json_decode($result,true);
        return $data;
    }
    /**
    *获取ip
    */
    public function get_client_ip(){
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
            $ip = getenv("HTTP_CLIENT_IP");
        }else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        }else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "unknown";
        return($ip);
    }
}
