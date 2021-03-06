<?php  
namespace app\common\controller;
use think\Controller;
use think\Auth;
use think\Request;


/**
* 基类控制器
*/
class Base extends Controller
{
    //当前模型
    protected $model;

    /**
     * 初始化公共数据
     * @return [type] [description]
     */
    public function _initialize()
    {   
        //实例化当前模型
        if(!in_array(request()->controller(),config('not_model'))){
            $this->model = model(request()->controller());
        }

        //登录检测
        $this->checkLogin();

        //检测是否有异地登录
        $this->checkSessionId();

        //检查权限
        $this->checkAuth();

        //左侧菜单显示
        $this->leftMenu();

        //农历日期
        $this->getLunar();

        //天气信息
        $this->getWeather();

        //获取title,postion信息
        $this->getTitle();
    }


    /**
     * 检测是否登录
     * @return [type] [description]
     */
    private function  checkLogin(){
        //检测session 是否有用户信息
        if(!session('admin_info')){
            $this->error('您尚未登录','login/login');
        }else{
            //账户信息
            $this->assign('admin_info',session('admin_info'));
        }
    }

    /**
     * 检测是否有异地登录
     * @return [type] [description]
     */
    public function checkSessionId(){
        //查询数据表
        $adminInfo = session('admin_info');
        $user = model('Admin')->find(session('admin_info.id'));
        //本地session
        $session_id = session_id();
        //判断是否异地
        if($user['session_id'] != $session_id){  
            session_destroy();  
            $this->error('您的账号在其他地方登录,您已经被强制下线', url('admin/login/login'));  
        }  
    }


    /**
     * 检测权限
     * @return [type] [description]
     */
    private  function  checkAuth(){
        $auth       = new Auth();
        $request    = Request::instance();                  //初始化request
        $controller = $request->controller();               //控制器
        $method     = $request->action();                   //方法
        $name       = $controller.'/'.$method;              //拼接权限名称
        $not_check  = array(                                //禁止检测权限
                        "Index/index",              //后台首页
                        "Admin/loginout",           //后台登出
                        );
        if(session('admin_info.id') != 1){              //检测是用户是否登录
             //检测是否超级管理员
            //$admin = model('Admin')->field('admin')->find(session('admin_info.id'));
            //if(!$admin['admin']){
                if(!in_array($name,$not_check)){                //过滤权限检测
                    if(!$auth->check($name,session('admin_info.id'))){//检测权限
                        $this->error('没有权限','Index/index');
                    }
                }
            //}
        }
    }

    /**
     * 获取title,postion信息
     * @return [type] [description]
     */
    public function getTitle(){
        $request    = Request::instance();                  //初始化request
        $module = $request->module();                       //模块
        $controller = $request->controller();               //控制器
        $method     = $request->action();                   //方法
        $name       = $module.'/'.$controller.'/'.$method;  //拼接权限名称
        //获取权限
        $rules = db('auth_rule')->field('id,pid,title,name')->select();
        foreach ($rules as $key => $value) {
            if(strtolower($name) == strtolower($value['name'])){
                //当前标题
                $this->assign(['title'=>$value['title']]);
                //当前位置字符串
                $par = getParents($rules,$value['id'],['id','title','name'],0,1);
                $postion = '';
                foreach ($par as $k => $v) {
                    $postion .= '<li>';
                    if($k == 0){//最后一个不加链接
                        $postion .= $v['title'];
                    }else{
                        $postion .= '<a href="'.url($v['name']).'">'.$v['title'].'</a>';
                    }
                    $postion .= '</li>';
                }
                $this->assign(['postion'=>$postion]);
            }
        }
    }




    /**
     * 左侧菜单栏显示
     * @return [type] [description]
     */
    private  function leftMenu(){
        //查看用户角色权限
        $rule_access = model('AuthGroupAccess')->getAuths(session('admin_info.id'));
        //dump($rule_access);die;
        //菜单数据
        $rules = obj_to_arr(model('AuthRule')->order('sort asc')->select());
        //子排序
        $menus = getTree($rules,2,$rule_access);
        //dump(obj_to_arr($rules));die;
        $this->assign(['leftMenus'=>$menus,'rule_access'=>$rule_access]);
     
    }


    /**
     * 获取农历日期
     * @return [type] [description]
     */
    public function getLunar(){
        $lunar=new \org\Lunar;//实例化农历类
        $data=$lunar->convertSolarToLunar(date('Y'),date('m'),date('d'));
        $date[] = getWeek();
        $nongli = date('Y-m-d') . ' ' . $data[3] . '年 ' . $data[1] . $data[2] . ' ' .getWeek();
        $this->assign(['nongli'=> $nongli]);
    }



    //获取天气信息
    public function getWeather(){
        //百度地图api的密钥
        $weather=new \org\Weather(config('baidu.ak'));
        $res = $weather->weatherInfo();
        //dump($res['result']);die;
        $this->assign(['weather'=> $res['result']]);
    }



	/**
	 * api返回数据json
	 * @param  [type] $code    [状态]
	 * @param  [type] $msg     [提示]
	 * @param  array  $data    [数据]
	 * @return [type]          [json]
	 */
	static public function show($code,$msg='',$data=[])
	{
		$return_data = [
            'code' => '500',
            'msg' => '未定义消息',
            'data' => $code == 1001 ? $data : [],
        ];
        if (empty($code)) return $return_data;
        $return_data['code'] = $code;
        if(!empty($msg)){
            $return_data['msg'] = $msg;
        }else if (isset(ReturnCode::$return_code[$code]) ) {
            $return_data['msg'] = ReturnCode::$return_code[$code];
        }
        return json_encode($return_data);
	}



    /**
     * 删除
     * @return [type] [description]
     */
    public function del()
    {
        $url = $_SERVER['HTTP_REFERER'];
        if($this->model->destroy(input('id'))){
            return show(1,'删除成功',[],$url);
        }else{
            return show(0,'删除失败',[],$url);
        }
    }


    /**
     * 修改状态
     * @return [type] [description]
     */
    public function setStatus()
    {
        try {
            if(request()->isPost()){
                $data = request()->param();
                if(!$data['id']){
                    return show(0, 'ID不存在');
                }
                //提交数据
                if($this->model->allowField(true)->save($data,['id'=>$data['id']])){
                    return show(1, '操作成功');
                }else{
                    return show(0, '操作失败');
                }
            }
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }


    /**
     * 排序
     */
    public function setOrder(){
        try {
            if(request()->isPost()){
                $url  = $_SERVER['HTTP_REFERER'];
                $data = input('post.');
                $list = array();
                foreach ($data as $key => $value) {
                    $list[] = ['id' => $key, 'sort' => $value];
                }
                //批量更新
                if($this->model->saveAll($list)){
                    return show(1, '操作成功',[],$url);
                }else{
                    return show(0, '操作失败');
                }
            }
        }catch(Exception $e) {
            return show(0, $e->getMessage());
        }
    }


    /**
     * 获取登录用户信息
     * @return array
     */
    public function getLoginUser() {
        return session("admin_info");
    }


    /**
     * 判定是否登录
     * @return boolean 
     */
    public function isLogin() {
        $user = $this->getLoginUser();
        if($user && is_array($user)) {
            return true;
        }
        return false;
    }






    /**
     * 上传图片
     * @return [type] [description]
     */
    public function douploadimg(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file(key($_FILES));
        //执行上传操作
        $info = $file->validate(config("uploadfile.upload_images_validate"))->move(ROOT_PATH . 'public' . DS .config('uploadfile.upload_images_path'));
        if($info){
            //获取文件名
            $path = config('uploadfile.upload_images_path').'/'.$info->getSaveName();
            if($path){
                echo $this->show(1001,'上传成功',['data'=>$path]);
            }else{
                echo $this->show(2001,$file->getError());
            }
        }else{
            echo $this->show(2001,$file->getError());
        }
    }



    /**
     * webupload上传图片
     * @return [type] [description]
     */
    public function ajax_upload($type="images"){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file(key($_FILES));
        //执行上传操作
        $info = $file->validate(config("uploadfile.upload_".$type."_validate"))->move(ROOT_PATH . 'public' . DS .config("uploadfile.upload_".$type."_path"));
        if($info){
            //获取文件名
            $path = config("uploadfile.upload_".$type."_path").'/'.$info->getSaveName();
            if($path){
                echo json_encode(['data'=>$path]);
            }else{
                echo json_encode(['error_info'=>$file->getError()]);
            }
        }else{
            echo json_encode(['error_info'=>$file->getError()]);
        }
    }



    // /**
    //  * 上传图片,返回json
    //  * @return [type] [description]
    //  */
    // public function douploadfile(){
    //     if(request()->isAjax()){
    //         // 获取表单上传文件 例如上传了001.jpg
    //         $file = request()->file('file');
    //         //执行上传操作
    //         $info = $file->validate(config("uploadfile.upload_files_validate"))->move(ROOT_PATH . 'public' . DS .config('uploadfile.upload_files_path'));
           
    //         if($info){
    //             //获取文件名
    //             $path = config('uploadfile.upload_files_path').'/'.$info->getSaveName();
    //             if($path){
    //                 echo $this->show(1001,'上传成功',['data'=>$path]);
    //             }else{
    //                 echo $this->show(2001,$file->getError());
    //             }
    //         }else{
    //             echo $this->show(2001,$file->getError());
    //         }

    //     }
    // }



    // /**
    //  * 上传excel
    //  * @return [type] [description]
    //  */
    // public function doUploadExcel(){
    //     if(request()->isAjax()){
    //         // 获取表单上传文件 例如上传了001.jpg
    //         $file = request()->file('file');
    //         //执行上传操作
    //         $info = $file->validate(config("uploadfile.upload_files_validate"))->move(ROOT_PATH . 'public' . DS .config('uploadfile.upload_files_path'));
    //         if($info){
    //              //获取文件名
    //             $path = config('uploadfile.upload_files_path').'/'.$info->getSaveName();
    //             if($path){
    //                 return $path;
    //             }else{
    //                 return false;
    //             }
    //         }else{
    //            return false;
    //         }

    //     }
    // }


    // /**
    //  * 删除上传文件
    //  * @return [type] [description]
    //  */
    // public function delfile(){
    //     if(request()->isAjax()){
    //         //搜索替换路径中\
    //         $url = trim(input('src'),'/');
    //             $res = unlinks($url);
    //             if($res){
    //                 echo $this->show(1001,'删除成功');
    //             }else{
    //                 echo $this->show(2001,'删除失败');
    //             }
    //     }
    // }


}

