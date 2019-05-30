<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/2
 * Time: 11:24
 */

namespace app\index\controller;


use think\Request;

class Search extends Base
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){
        $keyword = trim(input('q'));

        if($keyword){
            $map['title']=['like','%'.$keyword.'%'];
            $searchres = db('tp_article')
                ->where($map)
                ->order('time desc')
                ->paginate($listRows = 2,$simple=false,$config=[
                    'query'=>array('q'=>$keyword),
                ]);
            $this->assign(array(
                'searchres'=>$searchres,
                'keyword'=>$keyword
            ));
        }else{
            $this->assign(array(
                'searchres' => 1,
                'keyword'=>'暂无数据'
            ));

        }
        return $this->fetch();

    }

}