<?php  
namespace app\admin\controller;
use app\base\controller\Base;

/**
* 后台首页控制器
*/
class Index extends Base
{

	/**
	 * 后台首页
	 * @return [type] [description]
	 */
	public function index()
	{
		$data = array();
		$data = [0=>[
            'pc'        => $_SERVER['SERVER_NAME'], //当前主机名
            'language'  => $_SERVER['HTTP_ACCEPT_LANGUAGE'], //获取服务器语言
            'port'      => $_SERVER['SERVER_PORT'], //获取服务器Web端口
			//'os'		=> PHP_OS,
			'os'		=> php_uname(),
			'huanjing'	=> $_SERVER["SERVER_SOFTWARE"],
			'run'		=> php_sapi_name(),
			'php'		=> phpversion(),
			'mysql'		=> $this->_mysql_version(),
			'mysql_size'=> $this->_mysql_db_size(),
			'think'		=> THINK_VERSION.' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]',
			'upload'	=> ini_get('upload_max_filesize'),
			'gotime'	=> ini_get('max_execution_time').'秒',
			'ostime'	=> date("Y年n月j日 H:i:s"),
			'bjtime'	=> gmdate("Y年n月j日 H:i:s",time()+8*3600),
			'os_do_ip'	=> $_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
			'kongjian'	=> round((disk_free_space(".")/(1024*1024)),2).'M',
			'username'	=> session('admin_info.username'),
			'logintime'	=> date('Y-m-d H:i:s',session('admin_info.logintime')),
			'loginip'	=> session('admin_info.loginip'),
			'num'		=> session('admin_info.num'),
			'register_globals'		=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
			'magic_quotes_gpc'		=>(1===get_magic_quotes_gpc())?'YES':'NO',
			'magic_quotes_runtime'	=>(1===get_magic_quotes_runtime())?'YES':'NO',

		]];
		return $this->fetch('',['data'=>$data]);
	}

	/**
	 * 获取mysql版本
	 * @return [type] [description]
	 */
	private function _mysql_version()
    {

        $Model = model('admin');
        $version = $Model->query("select version() as ver");
        return $version[0]['ver'];
    }


    /**
     * 获取mysql数据库大小
     * @return [type] [description]
     */
    private function _mysql_db_size()
    {        
        $Model = model('admin');
        $sql = "SHOW TABLE STATUS FROM tp5api";
        $tblPrefix = 'tp_';
        if($tblPrefix != null) {
            $sql .= " LIKE '{$tblPrefix}%'";
        }
        $row = $Model->query($sql);
        $size = 0;
        foreach($row as $value) {
            $size += $value["Data_length"] + $value["Index_length"];
        }
        return round(($size/1048576),2).'M';
    }
}



?>