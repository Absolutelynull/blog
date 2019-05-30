<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/22
 * Time: 19:28
 */

namespace app\admin\controller;


use think\Controller;

class Base extends Controller
{
    public function _initialize()
    {
        if (!session("admin")) {
            $this->error("请先进行登录！", 'login/login');
            exit;

        }
    }
}