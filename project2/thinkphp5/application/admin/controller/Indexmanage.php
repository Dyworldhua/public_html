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

        // 首页分类
        public function Index_type(){ 
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
        }
        // 首页分类编辑
        public function index_type_edit(){
            $id = $_GET['id']; // 获取当前类型id
            $type = Db::table('index_type') // 查找当前类型
            ->where('id',$id)
            ->find();
            $this->assign('type',$type);
            return view();
        }
        public function type_update(){ // 首页分类更新
            $id = $_POST['id']; 
            $type = $_POST['type'];
            $new_type = Db::table('index_type')
            ->where('id',$id)
            ->update(['type'=>$type]);
            if($new_type){
                Alert('更改成功',url('Indexmanage/index_type'));
            }
        }

        // 首页内容分类
        public function index_sub_type(){
            // 从数据库中取出内容分类
            $sub_type = Db::table('index_sub_type')->select();
            $this->assign('sub_type',$sub_type);
            return view();
        }
        public function sub_type_add(){ // 内容分类添加
            return view();
        }
        public function sub_type_insert(){ // 内容分类插入数据库
            $type = input('type');
            $insert = Db::table('index_sub_type')->insert(['type'=>$type]);
            if($insert){
                Alert('添加成功',url('index_sub_type'));
            }
        }
        public function sub_type_edit(){ // 内容分类编辑
            $id = $_GET['id']; // 获取当前ID
            $type = Db::table('index_sub_type') // 取出当前数据
            ->where('id',$id)
            ->find();
            $this->assign('type',$type);
            return view();
        }
        public function sub_type_update(){ // 内容分类更新
            $id = input('id'); // 获取的当前ID
            $type = input('type'); // 获取当前类型名
            $update = Db::table('index_sub_type')
            ->where('id',$id)
            ->update(['type'=>$type]);
            if($update){
                Alert('更新成功',url('index_sub_type'));
            }
        }
        public function sub_type_delete(){ // 内容分类删除
            $id = $_GET['id']; // 获取当前ID
            $delete = Db::table('index_sub_type')
            ->where('id',$id)
            ->delete();
            if($delete){
                Alert('删除成功',url('index_sub_type'));
            }
        }
    }