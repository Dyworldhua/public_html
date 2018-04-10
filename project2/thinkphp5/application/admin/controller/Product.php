<?php
    namespace app\admin\Controller;
    use think\Controller;
    use think\Db;

    class Product extends Controller{
        
        // 产品列表
        public function product(){
            $select = Db::table('product')->select(); // 将数据从数据库中取出
            $this->assign('product',$select); // 模板赋值
            return view();
        }

        // 首页分类
        public function Protype(){
            $page_all = Db::table('index_type')
            ->count(); // 获取数据总条数
            $page_max = ceil($page_all/15); // 求出最大页数 
            $this->assign('page_max',$page_max); // 模板赋值
            $current_page = isset($_GET['page'])?$_GET['page']:1; // 获取当前页数，当获取不到值时默认为第一页
            $this->assign('current_page',$current_page); // 模板赋值
            $offset = ($current_page-1)*15;
            $this->assign('page_max',$page_max);
            $type = Db::table('index_type')
            ->limit($offset,15) // 根据当前页数显示数据
            ->select();

            // 将type_id转化为文字
            foreach($type as $key => $val){
                $type_id = Db::table('index_type')
                ->where('id',$val['type_id'])
                ->find();
                $type[$key]['type_name']=$type_id['type'];  
            }
            $this->assign('type',$type);  
            return view();          
            // 分类遍历
            // $data = [];
            // foreach($type as $val){
            //     if($val['type_id']==0){
            //         $data[$val['id']] = $val;
            //     }
            // }
            // foreach($type as $son){
            //     if (!empty($data[$son['type_id']])) {
            //         $data[$son['type_id']]['sub'][] = $son;
            //     }
            // }
            // $this->assign('type',$data);
            // return view();
            // $type = Db::table('index_type')
            // ->where('type_id',0)
            // ->select();
            // var_dump($type);
        }
       // 首页分类编辑
        public function type_edit(){
            $id = $_GET['id']; // 获取当前类型id
            $type = Db::table('index_type') // 查找当前类型
            ->where('id',$id)
            ->find();
            $this->assign('type',$type);
            return view();
        }
        public function update(){ // 首页分类更新
            $id = $_POST['id']; 
            $type = $_POST['type'];
            $new_type = Db::table('index_type')
            ->where('id',$id)
            ->update(['type'=>$type]);
            if($new_type){
                Alert('更改成功',url('Product/protype'));
            }
        }

        // 产品类型
        public function pro_type(){
            $type = Db::table('pro_type')->select(); // 从数据表中取出数据
            $this->assign('type',$type); 
            $age = Db::table('pro_type_age')->select();
            $this->assign('age',$age);
            return view();
        }
        public function pro_type_add(){
            return view();
        }
        public function pro_type_insert(){
            $type = input('type'); // 获取类型
            // 判断类型是否为空
            if(empty($type)){
                Alert('产品类型不能为空','-1');
                exit;
            }
            // 添加数据
            $insert = Db::table('pro_type')->insert(['type'=>$type]);
            if($insert){
                Alert('添加成功',url('pro_type'));
            }else{
                Alert('添加失败','-1');
            }
        }
        
        //适用年龄
        public function pro_age_add(){
            return view();
        }
        public function pro_age_insert(){
            $age = input('age');
            $insert = Db::table('pro_type_age')->insert(['age'=>$age]);
            if($insert){
                Alert('添加成功',url('pro_type'));
            }else{
                Alert('添加失败','-1');
            }
        }
    }