<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/18
 * Time: 16:56
 */
namespace app\admin\validate;


use think\Validate;

class Cate extends Validate {

    protected $rule = [
        'catename'=>'require|unique:tp_cate',
    ];
    protected $message =  [
        'catename.require' => '栏目名称不能为空',
        'catename.unique' => '栏目名称已经存在',
    ];


}

