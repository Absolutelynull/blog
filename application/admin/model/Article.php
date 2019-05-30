<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/14
 * Time: 14:37
 */
namespace app\admin\model;

use think\Model;

class Article extends Model{
    public function cate(){
//        return $this->hasMany("cate",'id');
          return $this->belongsTo("cate",'id');
    }


}