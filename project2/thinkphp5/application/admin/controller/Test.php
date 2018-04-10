<?php
    namespace app\admin\Controller;
    use think\Controller;
    use app\admin\model\Students; // 引入Model层中的数据库名

    class Test extends Controller{
        public function index(){
            // 静态调用
            // $db = Eason::get(1);
            // $eason = $db->toArray();
            // var_dump($eason);
            
            // 实例化调用
            // $db = new Students; 
            // $db2 = $db::get(1);
            // $students = $db2->toArray();
            // var_dump($students);

            // 使用where条件查询
            // $student = Students::where('id',2)
            // ->field('sex')
            // ->find();
            // $students = $student->toArray();
            // var_dump($students);

            $res = Students::where('id','>',0)
            ->order('id desc')
            ->limit(2)
            ->select();
            //var_dump($res);
            foreach($res as $val){
                $arr = $val->toArray();
                var_dump($arr);
            }

        }
    }
?>