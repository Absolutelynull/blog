<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/7
 * Time: 19:49
 */
namespace app\admin\validate;

use think\Validate;

class Admin extends Validate{

    //验证规则
    protected $rule = [
        'username'=>'require|length:5,12',
        'password'=>'require|length:6,16'
    ];

    //错误提示信息
    protected $message = [
        'username.require' =>'用户名不能为空',
        'username.length' =>'用户名 长度只能在5~12位之间',
        'password.require' =>'密码不能为空',
        'password.length' =>'密码需要在6~16位之间',

    ];

    //验证场景
    protected $scene = [
        'add'=>'',
        'edit'=>['username'=>'require|length:5,16'],

    ];

}
