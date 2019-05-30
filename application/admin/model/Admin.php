<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/7
 * Time: 20:16
 */

namespace app\admin\model;

use think\Db;
use think\Model;

class Admin extends Model{

    /**
     * @param $data
     * @return int -1密码错误 0账号不存在 1账号密码正确 2验证码错误
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     *
     */
    public function login($data){

        $captcha = new \think\captcha\Captcha();
        if(!$captcha->check($data['code'])){
            //验证码不正确
            return 2;
        }
        $user = Db::table("tp_admin")->where("username",$data['username'])->find();
        //账号存在
        if($user){
            $pass = Db::table("tp_admin")->where(['username'=>$data['username'],'password'=>$data['password']])->find();
            if($pass){
                //账号密码正确
                return 1;
            }else{
                //密码错误
                return -1;
            }

        }else{
            //不存在
            return 0;
        }
    }



}


