<?php 
namespace app\common\model;

use app\base\model\Base;

class Admin extends Base
{
	//多对多关联角色表
	public function authGroup()
    {
        return $this->belongsToMany('AuthGroup','auth_group_access','group_id','admin_id');
    }


    //一对多关联角色权限表
	public function authGroupAccess()
    {
        return $this->hasMany('AuthGroupAccess');
    }


	/**
	 * 获取管理员
	 * @return [type] [description]
	 */
	public function getAdmin($id=null)
	{
		if($id){
			$admins = $this->with('authGroup')->field('id,username,phone,avatar')->find($id);
			return obj_to_arr($admins);
		}else{
			//获取管理员列表
			$admins = $this->with('authGroup')->field('id,username,phone,avatar,logintime,loginip,num,status')->paginate('',false,['query' => request()->param()]);
			//dump(obj_to_arr($admins));die;
			return $admins;
		}
	}


	/**
	 * 添加管理员
	 * @param [type] $data [description]
	 */
	public function add()
	{
		//数据库字段 网页字段转换，过滤参数
        $param = [
            'group_id' => 'group_id',
            'username' => 'username',
            'password' => 'password',
            'phone'    => 'phone',
            'avatar'   => 'avatar',
        ];
        $data = $this->buildParam($param);

        //验证
        $this->validataCheck('Admin',$data,'add');

		//加密密码
		if($data['password']){
			$data['password'] = md5($data['password']);
		}

		//插入数据库
		if($this->allowField(true)->save($data)){
			//添加角色管理员表，group——access
			if($data['group_id']){
				$this->authGroupAccess()->save(['admin_id'=>$this->id,'group_id'=>$data['group_id']]);
			}
			return $this->id;//返回自增id
		}else{
			//失败删除头像图片
			@unlink($data['avatar']);
			return false;
		}
	}

	/**
	 * 修改
	 * @return [type] [description]
	 */
	public function edit(){
		//数据库字段 网页字段转换，过滤参数
        $param = [
            'id'       => 'id',
            'username' => 'username',
            'password' => 'password',
            'phone'    => 'phone',
            'avatar'   => 'avatar',
            'group_id' => 'group_id',
        ];
        $data = $this->buildParam($param);
        //验证
       $this->validataCheck('Admin',$data,'change');
		//加密密码
		$data['password'] = md5($data['password']);
		//获取用户头像信息
		$avatar = $this->field('avatar')->find($data['id']);
		if($this->allowField(true)->save($data,['id'=>$data['id']])){
			//编辑角色管理员表，group——access
			$this->authGroupAccess()->where('admin_id',$data['id'])->update(['group_id'=>$data['group_id']]);
			//如果新图片和旧图片不一致，删除旧图片
			if($data['avatar'] != $avatar['avatar']){
				@unlink($avatar['avatar']);
			}
			return true;
		}else{
			//删除新图片
			@unlink($data['avatar']);
			return false;
		}
	}

	/**
	 * 删除事务
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function del(){
		$id = input('id');

		$admin = $this->find($id);
        $admin_trans =  $this;
        $auth_trans  =  model('AuthGroupAccess');
        
        //开启事务
        $admin_trans->startTrans();
        $auth_trans->startTrans();

        //删除用户表
        $adminRes = $admin_trans->where('id',$id)->delete();
        //删除角色用户表
        $authRes  = $auth_trans->where('admin_id',$id)->delete();


        //事务回滚
        if(!$adminRes || !$authRes){
            $admin_trans->rollBack();
            $auth_trans->rollBack();
        }
        
        //提交事务
        $admin_trans->commit();
        $auth_trans->commit();

        if($adminRes && $authRes){
            //删除头像
            @unlink($admin['avatar']);
            return true;
        }else{
            return false;
        }
	}




	/**
	 * 登录
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	public  function login()
	{
		$data = input('post.');//登录数据
		if($res = obj_to_arr(self::getByUsername($data['username']))){
			//验证密码
			if($res['password'] == md5($data['password'])){
				//删除密码
				unset($res['password']);
				//存储session，session_id 用户标识，防止覆盖
				session('admin_info',$res);
				//修改数据表
				$param = [
					'logintime'	=>time(),         //登录时间
					'loginip'	=>request()->ip(),//登录ip
					'session_id'=>session_id(),   //登录session_id
					'num'		=>$res['num']+1,  //登录次数
				];
				//修改数据
				$this->save($param,['id'=>$res['id']]);
				return json(['code'=>1,'msg'=>'登陆成功']);
				//return 1;//密码正确
			}else{
				return json(['code'=>0,'msg'=>'密码错误']);
				//return 0;//密码错误
			}
		}else{
			return json(['code'=>0,'msg'=>'用户不存在']);
			//return 0;//用户不存在
		}
		
	}


	/**
	 * 注册
	 * @param [type] $data [description]
	 */
	public function register($e=false)
	{
		//数据库字段 网页字段转换，过滤参数
        $param = [
            'username' => 'username',
            'password' => 'password',
            'password1'=> 'password1',
            'phone'    => 'phone',
            'email'    => 'email',
        ];
        $data = $this->buildParam($param);
		//验证
		$this->validataCheck('Admin',$data,'register');

		//模拟发送邮件信息
		$data['token']=md5($data['username'].$data['password'].time());//创建邮件激活码
		$data['token_exptime']=time()+60*60*24;//过期时间为24小时
		$data['status'] = 1;//锁定账号，激活后设置为0

		//加密密码
		if($data['password']){
			$data['password'] = md5($data['password']);
		}
		//插入数据库
		if($this->allowField(true)->save($data)){
			//用户注册成功后添加用户角色表,默认是普通会员
			if($this->authGroupAccess()->save(['admin_id'=>$this->id,'group_id'=>2])){
				//是否发送邮件
			    if($e){
					$email = $data['email'];//注册邮箱
				    $title = "TTCMS账号激活";//邮件标题
				    //邮件主题
				    $content="亲爱的".$data['username']."：<br/>感谢您在我站注册了新帐号。<br/>请点击链接激活您的帐号。<br/> 
				         <a href='".request()->domain().url('admin/login/check',array('verify'=>$data['token']))."' target= 
				         '_blank'>".request()->domain().url('admin/login/check',array('verify'=>$data['token']))."</a><br/> 
				         如果以上链接无法点击，请将它复制到你的浏览器地址栏中进入访问，该链接24小时内有效。";
				    //发送邮件
					sendEmail($email,$title,$content);
			    }

				return $this->id;//返回自增id
			}else{
				//删除管理员
				$this->delete($this->id);
				return false;
			}
		}else{
			return false;
		}
	}

	/**
	 * 检测激活信息
	 * @return [type] [description]
	 */
	public function check(){
		$data['token']  = trim(input('verify'));
		$data['status'] = 1;
		if($res=$this->field('id,token_exptime')->where($data)->find()){
			//对比过期时间
			if(time()>$res['token_exptime']){
				//删除用户信息
				$this->delete($res['id']);
				return ['code'=>2,'msg'=>'激活时间已过期!请重新登录发送激活邮件！'];
			}else{
				//修改状态
				$data['status'] = 0;
				if($this->save($data,["id"=>$res['id']])){
					return ['code'=>1,'msg'=>'激活成功!请登录'];
				}else{
					return ['code'=>3,'msg'=>'激活失败！请联系管理员！'];
				}
			}
		}else{
			return ['code'=>4,'msg'=>'获取数据失败！请联系管理员！'];
		}
	}


}