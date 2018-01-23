<?php  
namespace app\base\model;
use think\Model;

/**
* 基类模型
*/
class Base extends Model
{

    /**
     * 数据库字段 网页字段转换
     * 标识为数据库字段 值为浏览器提交字段
     * @param $array   标识为数据库字段 值为浏览器提交字段
     * @param bool|false $uuid  是否追加UUID信息
     * @return array
     */
    protected function buildParam($array,$uuid=false)
    {
        $data=[];
        foreach( $array as $item=>$value ){
            $data[$item] = request()->param($value);
        }
        if ($uuid && isset($this->uuid)){
            $data['uuid'] = $this->uuid;
        }
        return $data;
    }


    /**
     * 验证数据
     * @param  [type] $model [验证模型]
     * @param  [type] $data  [验证数据]
     * @param  [type] $type  [验证场景]
     * @return [type]        [description]
     */
    public function validataCheck($model,$data,$type){
        //实例化验证器
        $validate = \think\Loader::validate($model);
        //验证
        if (!$validate->scene($type)->check($data)){
            return $validate->getError();
        }
    }


    /**
     * 排序
     */
    public function setOrder(){
        $data = input('post.');
        $list = array();
        foreach ($data as $key => $value) {
            $list[] = ['id' => $key, 'sort' => $value];
        }
        //批量更新
        if($this->saveAll($list)){
            return true;
        }else{
            return false;
        }
    }



    /**
     * 修改状态
     * @return [type] [description]
     */
    public function setStatus($status='status')
    {
         if(request()->isGet()){
            //数据库字段 网页字段转换，过滤参数
            $param = [
                'id'     => 'id',
                $status  => $status,
            ];
            $data = $this->buildParam($param);
            //提交数据
            if($this->save($data,['id'=>$data['id']])){
                return true;
            }else{
               return false;
            }
        }
    }


    /**
     * 获取数据列表
     * @return [type] [description]
     */
    public function getList($where=null,$orderField = null,$page=1,$field=null){
        $order = null;
        //排序
        if($orderField){
            $order = $orderField;
        }
        //分页
        if($page){
            return $this->field($field)->where($where)->order($order)->paginate('',false,['query' => request()->param()]);
        }else{
            $res = $this->field($field)->where($where)->order($order)->select();
            //对象转数组
            return obj_to_arr($res);
        }
    }
}

?>