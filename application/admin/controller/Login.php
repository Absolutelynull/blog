<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/22
 * Time: 19:34
 */

namespace app\admin\controller;


use think\Controller;

class Login extends Controller
{

    public function index(){
        if(request()->post()){
            $adminModel = new \app\admin\model\Admin();
            $data['username'] = trim(input("post.username"));
            $data['password'] = md5(trim(input("post.password")));
            $data['code'] =trim(input("post.code"));
            switch ($adminModel->login($data)){
                case 1:
                    session("admin",$data['username']);
                    $this->success("登录成功",'admin/lst');
                    break;
                case 0:
                case -1:
                    $this->error("登录失败,请检查账号或密码是否正确,重新登录!",'login/login');
                    break;
                case 2:
                    $this->error("验证码不正确,请重复输入!");
                    break;
            }

        }
        return $this->fetch("login");
    }
    public function login(){

        return $this->fetch();
    }

    public function getsession(){
        dump(session('admin'));
    }
    public function logout(){
        session(null);
        return $this->fetch("login");
    }


}