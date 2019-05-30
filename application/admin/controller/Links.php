<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/14
 * Time: 14:36
 */
namespace app\admin\controller;

use think\Db;
use think\Loader;
use think\Request;

use app\admin\controller\Base;

class Links extends Base {
    public function lst(){
        $result = Db::table("tp_links")->paginate(5);
        $this->assign("result",$result);
        return $this->fetch();
    }

   public function add(){
        if(\request()->isPost()){
            $data['id'] = null;
            $data['title'] = trim(input('post.title'));
            $data['url'] = trim(input('post.url'));
            $data['content'] = trim(input('post.text'));
            $validate = Loader::validate("Links");
            if(!$validate->check($data)){
                $this->error($validate->getError());
                exit;
            }

            $data = Db::table("tp_links")->insert($data);
            if($data){
                $this->success("添加成功",'links/add');
            }else{
                $this->error("添加失败");
            }
        }
        return $this->fetch();
   }
  
   public function edit(){

        if(\request()->isGet()){
            $id = input('id');
//        $result = Db::table("tp_links")->where(['id'=>$id])->delete();
            $result = Db::table("tp_links")->where('id',$id)->find();
            if($result){
//            Db::table("tp_links")->update();

            }else{
                $this->error("找不到该链接","links/lst");
                exit;
            }
//            if($result['content'] == ""){
//                $result['content'] = "暂无描述";
//            }

            $this->assign("result",$result);
            return $this->fetch();
        }

   }

   public function delete(){
       $id = input('id');

       //        $result = Db::table("tp_links")->where(['id'=>$id])->delete();
       $result = Db::table("tp_links")->delete($id);
       if($result){
           $this->success("删除成功",'links/lst');
       }else{
           $this->error("删除友情链接失败");
       }

   }

   public function update(){
        $data['id'] = input("post.id");
        $data['title'] = input("post.title");
        $data['url'] = input("post.url");
        $data['content'] = input("post.text");
        $validate = Loader::validate("Links");
        if(!$validate->check($data)){
            $this->error($validate->getError());
            exit;
        }
        $result = Db::table("tp_links")->update($data);
        if($result){

            $this->success("链接更新成功","links/lst");
        }else{
            $this->error("更新失败","links/lst");
        }

   }


}
