<?php 
    namespace app\index\Controller;
    use think\Controller;
    use think\Db;
    use app\index\controller\Base;
    class Prolist extends Base{
        public function pro_list(){
            parent::_initialize(); // 继承Base控制器
            return view();
        }    
    }   