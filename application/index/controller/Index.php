<?php
namespace app\index\controller;

use think\Db;

use app\index\controller\Base;

class Index extends Base
{
    public function index()
    {
        $articles = \db("tp_article")->order("id")->paginate(3);
        $this->assign("articles",$articles);
        return $this->fetch();

    }

    
}
