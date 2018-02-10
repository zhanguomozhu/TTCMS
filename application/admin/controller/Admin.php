<?php
namespace app\admin\controller;

use app\base\controller\Base;

class Admin extends Base
{

    /**
     * 获取管理员列表
     * @return [type] [description]
     */
    public function lst()
    {
        //管理员列表
        $admins = $this->model->getAdmin();
        return $this->fetch('', ['admins' => $admins]);
    }


    /**
     * 添加管理员
     */
    public function add()
    {
        if (request()->isPost()) {
            //文件上传
            if(!empty($_FILES)){
                $this->douploadimg();
            }else{
                //加入数据库
                if ($this->model->add()) {
                    $this->success('添加成功', 'lst');
                } else {
                    $this->error('添加失败');
                }
            }
            return;
        }
        //获取角色数据
        $groups = model('AuthGroup')->getList(['status'=>1],0,0,'id,title');
        return $this->fetch('', ['groups' => $groups]);
    }


    /**
     * 编辑
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function edit($id)
    {

        if (request()->isPost()) {
            //文件上传
            if(!empty($_FILES)){
                $this->douploadimg();
            }else{
                //插入数据
                if ($this->model->edit()) {
                    $this->success('修改成功', 'lst');
                } else {
                    $this->error('修改失败');
                }
            }
            return;
        }
        //角色信息
        $groups = model('AuthGroup')->getList(['status'=>1],0,0,'id,title');

        //管理员角色
        $admin = $this->model->getAdmin($id);

        return $this->fetch('', ['groups' => $groups, 'admin' => $admin]);
    }


    /**
     * 删除
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function del()
    {
        if($this->model->del()){
            return json(['code'=>1,'msg'=>'删除成功']);
        }else{
            return json(['code'=>0,'msg'=>'删除失败']);
        }
    }

    /**
     * 退出
     * @return [type] [description]
     */
    public function loginout()
    {
        session(null);
        $this->success('退出成功', 'Login/login');
    }



    /**
     * 编辑验证账号
     * @return [type] [description]
     */
    public function checkAccount()
    {
        if (request()->isAjax()) {
            $phone    = input('phone') ? input('phone') : '';//手机号
            $old      = input('old') ? input('old') : ''; //旧密码
            $res = $this->model->find(input('id'));
            if ($phone == $res['phone']) {
                echo $this->show(1040);
            }elseif(md5($old) == $res['password']){
                echo $this->show(1041);
            }else {
                echo $this->show(1042);
            }
        }
    }


    /**
     * 添加管理员验证
     * @return [type] [description]
     */
    public function yanzheng()
    {
        if (request()->isAjax()) {
            $username = input('username') ? input('username') : '';//用户名
            $phone    = input('phone') ? input('phone') : '';//手机号
            if (isset($username) && !empty($username)) {
                if ($this->model->where(['username' => $username])->find()) {
                    echo $this->show(1031);
                } else {
                    echo $this->show(1032);
                }
            } elseif (isset($phone) && !empty($phone)) {
                if ($this->model->where(['phone' => $phone])->find()) {
                    echo $this->show(1033);
                } else {
                    echo $this->show(1034);
                }
            }
        }
    }



    /**
     * 修改状态
     * @return [type] [description]
     */
    public function edit_status()
    {
        if(request()->isGet()){
            if($this->model->setStatus()){
                $this->redirect($_SERVER['HTTP_REFERER']);
            }else{
                $this->error('修改失败');
            }
        }
    }
}