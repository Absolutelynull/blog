<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/7
 * Time: 15:56
 */

namespace app\admin\controller;




use think\Db;
use think\Loader;


use app\admin\controller\Base;
use app\admin\validate;
use app\admin\model\Admin as AdminModel;


class Admin extends Base{



    public function add(){

        /**
         * 判断是否提交添加管理员
         */
        if(request()->isPost()){
           $data  = [
               'username'=>input('post.username'),
               'password'=>input('post.password')
           ];
//           $rule = [
//               ['username','require|length:6,30','用户名只能6~30位'],
//               ['password','require|length:6,32|alphaDash','用户名必须在6~16位之间']
//           ];
//           //进行验证表单提交过来的数据是否符合
//           $validate = new Validate($rule);
//           $check_result = $validate->check($data);

            $validate = Loader::validate('Admin');
            $check_result = $validate->check($data);

           if(!$check_result){
               return $validate->getError();
               exit;
           }
           if($d = \db('tp_admin')->insert($data)){
                $this->success('添加管理员成功','admin/lst');
           }else{
                $this->error('添加管理员失败');
                exit;}

        }else{

        }

        return $this->fetch();
    }
    public function lst(){
//        $list = AdminModel::pa

        $data = \db('tp_admin')->paginate(2);
        $this->assign("data",$data);
        return $this->fetch();
    }

    public function edit(){

        //显示
        $id = input('id');
        $admins= \db("tp_admin")->where("id",$id)->find();


        //修改提交这个页面 进行处理
        if (request()->isPost()){
            $data = [
                'id'=>input('post.id'),
                'username'=>input('post.username')
            ];
            $data['password']  = input('post.password') ? md5(input('post.password')) : $admins['password'];

            $validate = Loader::validate("Admin");
            $result = $validate->scene('edit')->check($data);
            if(!$result){
                $this->error($validate->getError());
            }
            if(\db("tp_admin")->where('id',$data['id'])->update($data)){
                $this->success("管理员信息修改成功",'lst');
            }else{
                $this->error("管理员信息修改失败");
            }
        }


        $this->assign("admins",$admins);
        return $this->fetch();
    }

    public function delete(){
        $id = input("id");

        if($id === 1){
            $this->error("删除管理员失败");
        }else{
//            $result = \db("tp_admin")->where('id',$id)->delete($id);
            $result = \db("tp_admin")->delete($id);
            if($result){
                $this->success("删除管理员成功",'lst');

            }else{
                $this->error("删除管理员失败");
            }

        }


    }




}