<?php
namespace app\install\controller;
use think\Controller;

/**
 * 安装控制器类
 */
class Index extends Controller
{
    public function _initialize() {
        parent::_initialize();
        if(file_exists(APP_PATH.'install.lock')){
            header("Content-type:text/html;charset=utf-8");
            die('您已安装过TTCMS-博客版，请勿重复执行安装操作！');
        }
        
    }

    //安装首页
    public function index(){
        return view('index');
    }


    //第一步
    public function setup1(){
        $checkObj = new \install\CheckConfig();//引入检测配置文件
        //操作系统
        $os  = explode(" ", php_uname());
        //php版本
        $phpVer = $checkObj->c_phpVersion();
        //php.ini
        $phpini = $checkObj->c_phpIni();
        //php extenstion
        $extension = $checkObj->c_must_extension();
        //recom_extension检查
        $recom = $checkObj->c_recom_extension();
        //writeable
        $write = $checkObj->c_writeableDir();
        return $this->fetch('setup1',array(
            'checkObj'      =>  $checkObj,
            'os'            =>  $os[0],
            'phpVer'        =>  $phpVer,
            'phpini'        =>  $phpini,
            'extension'     =>  $extension,
            'recom'         =>  $recom,
            'write'         =>  $write,
        ));
    }

    //第二步
    public function setup2(){
       return $this->fetch('setup2');
    }


    //第三步
    public function setup3(){

        return  $this->fetch('setup3');
    }


    //第四步
    public function setup4(){
        //生成lock文件
        $is_success = file_put_contents(APP_PATH.'install.lock','TTCMS-博客版:'.date('Y-m-d H:i:s').' by '.TT_VERSION);
        if(!$is_success)
        {
            die('create install.lock file fail');
        }
        return $this->fetch('setup4');
    }

    //检测数据库
    public function ajax_check_mysql(){
        check_mysql();
    }


    //清除缓存
    public function clear_cache(){
        //更新缓存
        $result = model('common/cache')->update_cache();
    }

}