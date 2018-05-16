<?php 
    namespace app\index\controller;
    use think\Controller;
    use think\Session;
    class Out extends Controller{
        public function out(){
            Session::clear();
            Alert('退出成功',url('Index/index'));
        }
    }