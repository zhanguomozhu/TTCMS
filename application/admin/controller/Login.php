<?php 
namespace app\admin\controller;
use think\Controller;
use think\Loader;

class Login extends Controller
{
	public $captcha;//验证码

	/**
	 * 初始化
	 * @return [type] [description]
	 */
	public function _initialize(){
		$config =    [
		    // 验证码字体大小
		    'fontSize'    => 16,
		    //开启中文验证码
		    'useZh'       => false, 
		    //高度
		    'imageH'      => 34,
		    //宽度
		    'imageW'      => 110,
		    // 验证码位数
		    'length'      => 1,
		    // 关闭验证码杂点
		    'useNoise'    => true, 
		];
		$this->captcha = new \think\captcha\Captcha($config);
	}
	/**
	 * 登录
	 * @return [type] [description]
	 */
	public function login()
	{
		if(request()->isPost()){
			if(!$this->check_verify(input('code'))){
				$this->error('验证码错误');
			}
			return model('Admin')->login();
		}
		return $this->fetch();
	}

	/**
	 * 生成验证码
	 * @return [type] [description]
	 */
	public function verify()
	{
		return $this->captcha->entry();	
	}

	/**
	 * 检测验证码
	 * @param  [type] $code [description]
	 * @param  string $id   [description]
	 * @return [type]       [description]
	 */
	public function check_verify($code, $id = ''){
	    return $this->captcha->check($code, $id);
	}

	/**
	 * 忘记密码
	 * @return [type] [description]
	 */
	public function forget()
	{
		if(request()->isPost()){
            //插入数据库,true发送激活邮件,false不发送
			// if(model('Admin')->register(true)){
			// 	$this->success('注册成功','login/login');
			// }else{
			// 	$this->error('注册失败,请重试');
			// };
			return;
		}
		return $this->fetch();
	}


	/**
	 * 重置密码验证
	 * @return [type] [description]
	 */
	public function forgetCheck(){
	  	if(request()->isAjax())
	  	{
		  	$username	=	input('username') ? input('username') : '';//验证用户名
			$phone		=	input('phone') ? input('phone') : '';//验证手机号
			$email		=	input('email') ? input('email') : '';//验证邮箱
			$code       =	input('code') ? input('code') : '';//短信验证码
			if((isset($username) && !empty($username)) && (!isset($phone) || empty($phone)) && (!isset($email) || empty($email)))
			{
	    		if(model('admin')->where(['username'=>$username])->find()){
		        	return json(['code'=>1,'msg'=>'管理员账号正确']);
			  	}else{
			   		return json(['code'=>0,'msg'=>'管理员账号错误']);
			  	}
			}elseif((isset($phone) && !empty($phone)) && (!isset($email) || empty($email)))
			{
	    		if(model('admin')->where(['username'=>$username,'phone'=>$phone])->find()){
	    			return json(['code'=>1,'msg'=>'手机号正确']);
			  	}else{
			  		return json(['code'=>0,'msg'=>'手机号错误']);
			  	}
			}elseif((isset($email) && !empty($email)) && (!isset($phone) || empty($phone)))
			{
	    		if(model('admin')->where(['username'=>$username,'email'=>$email])->find()){
	    			return json(['code'=>1,'msg'=>'邮箱正确']);
			  	}else{
			  		return json(['code'=>0,'msg'=>'邮箱错误']);
			  	}
			}elseif(isset($code) && !empty($code))
			{
	    		if($code != session('phone_code')){
	    			return json(['code'=>0,'msg'=>'验证码错误']);
			  	}else{
			  		return json(['code'=>1,'msg'=>'验证码正确']);
			  	}
			}
		}
	}

	/**
	 * 注册
	 * @return [type] [description]
	 */
	public function register()
	{
		if(request()->isPost()){
            //插入数据库,true发送激活邮件,false不发送
			if(model('Admin')->register(true)){
				$this->success('注册成功','login/login');
			}else{
				$this->error('注册失败,请重试');
			};
			return;
		}
		return $this->fetch();
	}


	//激活账号邮箱操作
	public function check()
	{
		//激活检测
		$res = model('Admin')->check();
		if($res['code'] == 1){//成功
			$this->success($res['msg'],'login/login');
		}else{//失败
			$this->error($res['msg'],'login/login');
		}
	}


	/**
	 * 注册ajax验证
	 * @return [type] [description]
	 */
	public function yanzheng(){
	  	if(request()->isAjax())
	  	{
		  	$username	=	input('username') ? input('username') : '';//验证用户名
			$phone		=	input('phone') ? input('phone') : '';//验证手机号
			$email		=	input('email') ? input('email') : '';//验证邮箱
			$code       =	input('code') ? input('code') : '';//短信验证码
			if(isset($username) && !empty($username))
			{
	    		if(model('admin')->where(['username'=>$username])->find()){
		        	return json(['code'=>0,'msg'=>'管理员账号已存在']);
			  	}else{
			   		return json(['code'=>1,'msg'=>'管理员账号可以使用']);
			  	}
			}elseif(isset($phone) && !empty($phone))
			{
	    		if(model('admin')->where(['phone'=>$phone])->find()){
	    			return json(['code'=>0,'msg'=>'手机号已存在']);
			  	}else{
			  		return json(['code'=>1,'msg'=>'手机号可以使用']);
			  	}
			}elseif(isset($email) && !empty($email))
			{
	    		if(model('admin')->where(['email'=>$email])->find()){
	    			return json(['code'=>0,'msg'=>'邮箱已存在']);
			  	}else{
			  		return json(['code'=>1,'msg'=>'邮箱可以使用']);
			  	}
			}elseif(isset($code) && !empty($code))
			{
	    		if($code != session('phone_code')){
	    			return json(['code'=>0,'msg'=>'验证码错误']);
			  	}else{
			  		return json(['code'=>1,'msg'=>'验证码正确']);
			  	}
			}
		}
	}


	/**
	 * 发送手机验证码
	 * @return [type] [description]
	 */
	public function sendPhone(){
		if (request()->isAjax()) {
			$phone   = input('phone');    //手机号
    		$content = "验证码";                //内容
			$res = sendPhone1($phone,$content);
            if ($res['code'] == 1) {
                //成功
                return json($res);
            } else {
                //不成功
                return json($res);
            }
        }
	}


	/**
	 * 发送邮箱验证码
	 * @return [type] [description]
	 */
	public function sendEmail(){
		if (request()->isAjax()) {
			$email   = input('email');          //邮箱
			$title   = "邮箱验证";          //标题
    		$content = "验证码【 ".rand_string(6,2)." 】";//内容
			$res = sendEmail($email,$title,$content);
            if ($res) {
                //成功
                return json(['code'=>1,'msg'=>'发送成功']);
            } else {
                //不成功
                return json(['code'=>0,'msg'=>'发送失败']);
            }
        }
	}
}