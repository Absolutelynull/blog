<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/22
 * Time: 20:02
 */

namespace app\index\controller;


use think\Controller;

class Base extends Controller
{
    public function _initialize(){

        $this->right();
        $this->tags();
        $cates = db("tp_cate")->order('id')->select();

        $this->assign("cates",$cates);

    }

    /**
     * 文章内容右侧显示
     */
    public function right(){
        //点击
        $clickres = db("tp_article")->order("click desc")->limit(8)->select();
        //推荐
        $tjres = db("tp_article")->where("state",1)->order("click desc")->limit(8)->select();

        $this->assign(array(
            'clickres'=>$clickres,
            'tjres'=>$tjres
        ));
    }

    /**
     * Tags 标签显示
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function tags(){
        //Tags 标签
        $tags = db("tp_tags")->select();
        $this->assign(array(
            'tags'=>$tags,
        ));
    }




}