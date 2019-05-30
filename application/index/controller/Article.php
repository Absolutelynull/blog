<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/22
 * Time: 20:06
 */

namespace app\index\controller;


use think\Db;

use app\index\controller\Base;

class Article extends Base
{
    public function index(){
        $articleid = input('articleid');
//        $cates = db("tp_cate")->order('id')->select();
//        $this->assign("cates",$cates);

        //文章
        $articles = db("tp_article")->where('id',$articleid)->find();
        //分类
        $zycates = db("tp_cate")->where('id',$articles['cateid'])->find();

        //点击数
        db('tp_article')->where('id',$articleid)->setInc('click',1);

        //相关阅读
        $reads = \db('tp_article')->where('cateid',$zycates['id'])->limit(8)->select();


        //频道推荐
        $recommend =\db('tp_article')
            ->where(array("cateid"=>$articles['cateid'],"state"=>1))
            ->order('click','desc')
            ->limit(8)->select();

        $this->assign(array(
            'article'=>$articles,
            'zycates'=>$zycates,
            'reads'=>$reads,
            'recommends'=>$recommend
        ));
        return $this->fetch("article");

    }
}