<?php 
    namespace app\admin\Controller;
    use think\Controller;
    use think\Db;

    class Indexmanage extends Controller{
        // 导航栏首页
        public function Index_nav(){
            $nav = Db::table('index_nav')->select(); // 取出表中的导航栏
            $this->assign('nav',$nav);
            return view();
        }

        // 导航栏添加
        public function Index_nav_add(){
            return view();
        }
        public function add(){
            $title = input('title'); // 获取名称
            if(empty($title)){
                Alert('导航栏名称不能为空','-1');
            }
            $insert = Db::table('index_nav')->insert(['title'=>$title]); // 插入数据
            if($insert){
                Alert('添加成功！',url('Indexmanage/Index_nav'));
            }
        }

        //  导航栏编辑
        public function Index_nav_edit(){
            $id = $_GET['id']; // 获取当前ID
            $nav_edit = Db::table('index_nav')
            ->where('id',$id)
            ->find();  // 取出当前ID对应的导航栏名称
            $this->assign('edit',$nav_edit);
            return view();
        }
        //  导航栏更新
        public function update(){
            $id = input('id');
            $title = input('title');
            if(empty($title)){
                Alert('导航栏名称不能为空','-1');
            }
            $update = Db::table('index_nav')
            ->where('id',$id)
            ->update(['title'=>$title]);
            if($update){
                Alert('更新成功',url('Index_nav'));
            }
        }
    }