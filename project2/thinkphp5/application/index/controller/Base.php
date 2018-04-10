<?php
    namespace app\index\Controller;
    use think\Controller;
    use think\Db;
    class Base extends Controller{
        public function _initialize(){
            $nav = Db::table('index_nav')->select(); // 取出导航栏
            $this->assign('nav',$nav);
            $type = Db::table('pro_type')->select();
            $this->assign('type',$type);
        }
    }