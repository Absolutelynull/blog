<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/18
 * Time: 16:32
 */
namespace app\admin\controller;


use think\Db;
use think\Loader;

use app\admin\controller\Base;

class Cate extends Base{
    public function index(){


    }
    public function lst(){
        $result = Db::table("tp_cate")->paginate(3);
        $this->assign("result",$result);
        return $this->fetch();

    }
    public function add(){

        if(request()->isPost()){
            $validate = Loader::validate("Cate");
            $data = [
                'catename'=>trim(input('post.catename')),
            ];
            if(!$validate->check($data)){
                $this->error($validate->getError());
                exit;
            }
            $result = Db::table("tp_cate")->insert($data);
            if($result === 1){
                $this->success("添加栏目成功",'cate/lst');
            }else{
                $this->error("添加失败");
            }
        }

        return $this->fetch();
    }
    public function edit(){
        if(request()->isGet()){
            $id = input("id");
//        $result = Db::table("tp_cate")->where("id","=",$id)->select();
            $result = Db::table("tp_cate")->where('id',$id)->find();
            if(!$result){
                $this->error("找不到此栏目,请重试",'cate/lst');
                exit;
            }
            $this->assign("result",$result);
            return $this->fetch();

        }elseif (request()->isPost()){

            $validate = Loader::validate("Cate");
            $data['id']=trim(input("post.id"));
            $data['catename'] = trim(input('post.catename'));
            if(!$validate->check($data)){
                $this->error($validate->getError());
                exit;
            }
            $result = Db::table("tp_cate")->update(input());
            if($result){
                $this->success("修改栏目成功",'cate/lst');
            }else{
                $this->error("修改栏目失败");
            }
        }




    }

    public function delete(){
        if(request()->isGet()){
            $id = trim(input("id"));
            $result = Db::table("tp_cate")->delete($id);
            if($result){
                $this->success("删除栏目成功",'cate/lst');
            }else{
                $this->error("删除失败",'cate/lst');
            }
        }

    }
}