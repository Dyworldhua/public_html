<?php
    namespace app\index\Controller;
    use think\Controller;
    use think\Db;
    class Base extends Controller{

        // 头部公共继承样式
        public function _initialize(){
            $nav = Db::table('index_nav')->select(); // 取出导航栏
            $this->assign('nav',$nav);
            $type = Db::table('pro_type')->select(); // 取出产品分类列表
            $this->assign('type',$type);
            $age = Db::table('pro_type_age')->select(); // 取出产品适用年龄
            $this->assign('age',$age);
        }
    }