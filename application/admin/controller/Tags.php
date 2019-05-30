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

class Tags extends Base {
    public function lst(){
        $result = Db::table("tp_tags")->paginate(2);
        $this->assign("result",$result);
        return $this->fetch();
    }

   public function add(){
        if(\request()->isPost()){

            $data['id'] = null;
            $data['tagsname'] = trim(input('post.tagname'));

            $validate = Loader::validate("Tags");
            if(!$validate->check($data)){
                $this->error($validate->getError());
                exit;
            }

            $data = Db::table("tp_tags")->insert($data);
            if($data){
                $this->success("添加成功",'tags/lst');
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
            $result = Db::table("tp_tags")->where('id',$id)->find();
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
       $result = Db::table("tp_tags")->delete($id);
       if($result){
           $this->success("删除Tags标签成功",'tags/lst');
       }else{
           $this->error("删除Tags标签失败",'tags/lst');
       }

   }

   public function update(){
        $data['id'] = input("post.id");
        $data['tagsname'] = trim(input("post.tagsname"));
        $validate = Loader::validate("Tags");
        if(!$validate->check($data)){
            $this->error($validate->getError());
            exit;
        }
        $result = Db::table("tp_tags")->update($data);
        if($result){
            $this->success("Tags标签更新成功","tags/lst");
        }else{
            $this->error("更新失败","tags/lst");
        }

   }


}
