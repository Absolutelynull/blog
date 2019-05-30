<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/14
 * Time: 14:38
 */

namespace app\admin\validate;

use think\Validate;

class Links extends Validate{
    protected $rule = [
        'url'=>"require|url",
        'title'=>"require",
    ];
    protected $message = [
        'url.url' => 'url地址不合法',
        'title.require' => '链接标题不能为空',
    ];


}