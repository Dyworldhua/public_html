<?php
    namespace app\index\Controller;
    use think\Controller;
    use think\Session;
    use app\index\controller\Base;

    class User extends Base{
        public function user(){
            parent::_initialize(); // 调用Base设定模板赋值
            $username = Session::get('username');
            $this->assign('username',$username);
            return view();
        }
    }