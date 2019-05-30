<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/22
 * Time: 20:02
 */

namespace app\index\controller;


use app\index\controller\Base;
class Cate extends Base
{
    public function index(){
        $articles = db("tp_article")->where('cateid',input('id'))->order('id')->paginate(3);
        //分类
        $cate = db("tp_cate")->where('id',input('id'))->find();


        $zycates = db("tp_cate")->where('id',$cate['id'])->find();


        $this->assign(array(
            'articles'=>$articles,
            'zycates'=>$zycates,
        ));
        return $this->fetch();
    }

}