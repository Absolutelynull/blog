<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/14
 * Time: 14:38
 */

namespace app\admin\validate;

use think\Validate;

class Tags extends Validate{
    protected $rule = [
        'tagsname'=>"require|unique:tp_tags",
    ];
    protected $message = [
        'tagsname.require' => 'Tags名称不能为空',
        'tagsname.unique' => 'Tags名称已经存在啦~~',
    ];


}