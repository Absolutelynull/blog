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

use app\admin\model\Article as ArticleModel;
use app\admin\controller\Base;

class Article extends Base{
    public function index(){
        return $this->fetch();
    }
    public function lst(){
//        $articles = Db::table("tp_article")->paginate(5);
//        $articles = Db::table("tp_article")->alias("a")->join("tp_cate c",'c.id=a.cateid')->paginate(5);
        $articles = Db::table("tp_cate")->alias("c")->join("tp_article a",'a.cateid=c.id')->paginate(5);


        $this->assign("articles",$articles);
        return $this->fetch();

    }
    public function add(){
        $cates = Db::table("tp_cate")->select();
        if(request()->isPost()){
            $data['title'] = trim(input('post.title'));
            $data['author'] = trim(input('post.author'));
            $data['desc'] = trim(input('post.desc'));
//            $data['keyword'] = trim(input('post.keyword'));
            $data['keyword'] = str_replace('，',',',trim(input('post.keyword')));
            $data['content'] = trim(input('post.content'));
            $data['cateid'] = trim(input('post.cate'));
            $data['state'] = trim(input('post.state'));
            $data['time'] = date('Y-m-d H:i:s',time());
            if($_FILES['pic']['tmp_name']){
                $file = request()->file("pic");
                $info = $file->move(ROOT_PATH.'PUBLIC'.DS.'static/uploads');
                if(!$info){
                    $this->error("图片上传错误: ".$file->getError());
                    exit;
                }
                $data['pic'] = $info->getSaveName();
            }

            $result = \db("tp_article")->insert($data);
            if($result){

                $this->success("发表帖子成功",'article/lst');
            }else{
                $this->error("发表文章失败");
            }


        }



        $this->assign("cates",$cates);
        return $this->fetch();
    }
    public function edit(){
        if(request()->isPost()){
            $data['title'] = trim(input('post.title'));
            $data['author'] = trim(input('post.author'));
//            $data['keyword'] = trim(input('post.keyword'));
            $data['keyword'] = str_replace('，',',',trim(input('post.keyword')));

            $data['desc'] = trim(input('post.desc'));
            $data['cateid'] = trim(input('post.cate'));
            $data['content'] = trim(input('post.content'));
            $data['state'] = trim(input('post.state')) == 'on' ? 1:0;

            if($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH.'public'.DS.'static/uploads');
                $data['pic'] = 'uploads/'.$info->getSaveName();
            }
            $result = \db("tp_article")->where('id',input('post.id'))->update($data);
            if($result){
                $this->success("文章修改成功",'article/lst');
            }else{
                $this->error('文章修改失败');
            }
            exit;
        }else{
            $id = input('id');
//        $result = Db::table("tp_article")->alias("a")->join("tp_cate c",'c.id=a.cateid')->where("a.id",$id)->find();
            $result = Db::table("tp_cate")->alias("c")->join("tp_article a",'a.cateid=c.id')->where("a.id",$id)->find();
            if(!$result){
                $this->error("找不到文章~~~~",'article/lst');
            }
            $cates = \db("tp_cate")->select();
            $this->assign("article",$result);
            $this->assign("cates",$cates);
            return $this->fetch();
        }




    }

    public function delete(){
        $result = Db::table("tp_article")->delete(input('id'));
        if($result){
            $this->success("删除文章成功",'article/lst');
        }else{
            $this->error("删除文章失败",'article/lst');
        }
    }
}