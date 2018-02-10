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
				return json(['code'=>0,'msg'=>'验证码错误']);
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
	 * 重置密码
	 * @return [type] [description]
	 */
	public function forget()
	{
		if(request()->isPost()){
            //插入数据库,true发送激活邮件,false不发送
			if(model('Admin')->forget()){
				return json(['code'=>1,'msg'=>'重置密码成功']);
			}else{
				return json(['code'=>0,'msg'=>'重置密码失败']);
			};
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
			$phone_code =	input('phone_code') ? input('phone_code') : '';//短信验证码
			$email_code =	input('email_code') ? input('email_code') : '';//邮箱验证码
			if($username && !$phone && !$email)
			{//账号
	    		if(model('admin')->where(['username'=>$username])->find()){
		        	return json(['code'=>1,'msg'=>'管理员账号正确']);
			  	}else{
			   		return json(['code'=>0,'msg'=>'管理员账号错误']);
			  	}
			}elseif($phone && !$email && !$phone_code)
			{//手机
	    		if(model('admin')->where(['username'=>$username,'phone'=>$phone])->find()){
	    			return json(['code'=>1,'msg'=>'手机号正确']);
			  	}else{
			  		return json(['code'=>0,'msg'=>'手机号错误']);
			  	}
			}elseif($email && !$phone && !$email_code)
			{//邮箱
	    		if(model('admin')->where(['username'=>$username,'email'=>$email])->find()){
	    			return json(['code'=>1,'msg'=>'邮箱正确']);
			  	}else{
			  		return json(['code'=>0,'msg'=>'邮箱错误']);
			  	}
			}elseif($phone_code && $phone && !$username)
			{//手机验证码
				if(!session($phone.'_phone_code')){
					return json(['code'=>0,'msg'=>'验证码已过期']);
				}
	    		if(md5($phone . $phone_code) != session($phone.'_phone_code')){
	    			return json(['code'=>0,'msg'=>'手机验证码错误']);
			  	}else{
			  		//验证成功删除session
			  		session($phone.'_phone_code', null);
			  		return json(['code'=>1,'msg'=>'手机验证码正确']);
			  	}
			}elseif($email_code && $email && !$username)
			{//邮箱验证码
				if(!session($email.'_email_code')){
					return json(['code'=>0,'msg'=>'验证码已过期']);
				}
	    		if(md5($email . $email_code) != session($email.'_email_code')){
	    			return json(['code'=>0,'msg'=>'邮箱验证码错误']);
			  	}else{
			  		//验证成功删除session
			  		session($email.'_email_code', null);
			  		return json(['code'=>1,'msg'=>'邮箱验证码正确']);
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
				return json(['code'=>1,'msg'=>'注册成功','url'=>'/admin/Login/login']);
			}else{
				return json(['code'=>0,'msg'=>'注册失败,请重试']);
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
			if($username)
			{
	    		if(model('admin')->where(['username'=>$username])->find()){
		        	return json(['code'=>0,'msg'=>'管理员账号已存在']);
			  	}else{
			   		return json(['code'=>1,'msg'=>'管理员账号可以使用']);
			  	}
			}elseif($phone && !$code)
			{
	    		if(model('admin')->where(['phone'=>$phone])->find()){
	    			return json(['code'=>0,'msg'=>'手机号已存在']);
			  	}else{
			  		return json(['code'=>1,'msg'=>'手机号可以使用']);
			  	}
			}elseif($email)
			{
	    		if(model('admin')->where(['email'=>$email])->find()){
	    			return json(['code'=>0,'msg'=>'邮箱已存在']);
			  	}else{
			  		return json(['code'=>1,'msg'=>'邮箱可以使用']);
			  	}
			}elseif($code && $phone)
			{
				if(!session($phone.'_phone_code')){
					return json(['code'=>0,'msg'=>'验证码已过期']);
				}
	    		if(md5($phone . $code) != session($phone.'_phone_code')){
	    			return json(['code'=>0,'msg'=>'验证码错误']);
			  	}else{
			  		//验证成功删除session
			  		session($phone.'_phone_code', null);
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
			$email   = input('email');         //邮箱
			$title   = "邮箱验证";             //标题
			$rand    = rand_string(6,2);       //随机码
    		$content = "验证码【 ".$rand." 】";//内容
			$res = sendEmail($email,$title,$content);
            if ($res) {
                //成功
                session($email . '_email_code', md5($email . $rand));
                return json(['code'=>1,'msg'=>'发送成功']);
            } else {
                //不成功
                return json(['code'=>0,'msg'=>'发送失败']);
            }
        }
	}
}