<?php
    namespace app\admin\Controller;
    use think\Controller;
    use think\Db;

    class Product extends Controller{
        
        // 产品列表
        public function product(){
            $select = Db::table('product')->select(); // 将数据从数据库中取出
            //var_dump($select);
            foreach($select as $key => $val){
                $type_id = $val['type']; // 取出产品类型ID
                $pro_type = Db::table('pro_type')->where('id',$type_id)->find();  // 查找当前类型的名称      
                $select[$key]['type_name'] = $pro_type['type']; 
                $index_type = $val['sub_type']; // 查找当前的首页内容类型ID
                $index_sub_type = Db::table('index_sub_type')->where('id',$index_type)->find();// 查找当前类型ID对应的内容分类
                $select[$key]['index_sub_type'] = $index_sub_type['type']; // 获取当前内容分类
            }
            $this->assign('product',$select);// 模板赋值
            return view();
        }

        // 首页分类
        public function index_type(){
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
        public function pro_type(){ // 产品类型列表
            $type = Db::table('pro_type')->select(); // 从数据表中取出数据
            $this->assign('type',$type); 
            $age = Db::table('pro_type_age')->select();
            $this->assign('age',$age);
            return view();
        }
        public function pro_type_add(){ // 产品类型添加
            return view();
        }
        public function pro_type_insert(){ // 产品类型插入数据库
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
        public function pro_type_edit(){ // 产品类型编辑
            $id = $_GET['id']; // 获取当前ID
            $type = Db::table('pro_type') // 查找当前ID类型值
           ->where('id',$id)
           ->find();
           $this->assign('type',$type); // 模板赋值
            return view();
        }
        public function pro_type_update(){ // 产品类型数据库更新
            $id = input('id'); // 获取当前ID
            $type = input('type'); // 获取当前类型
            if(empty($type)){ // 判断是否为空
                Alert('产品类型不能为空','-1');
                exit;
            }
            $update = Db::table('pro_type') // 数据库更新
            ->where('id',$id)
            ->update(['type'=>$type]);
            if($update){
                Alert('更新成功',url('pro_type'));
            }
        }
        public function pro_type_delete(){ // 删除类型
            $id = $_GET['id']; // 获取当前ID
            $delete = Db::table('pro_type') // 删除当前数据
            ->where('id',$id)
            ->delete();
           if($delete){
                Alert('删除成功',url('pro_type'));
           } 
        }
        
        //适用年龄
        public function pro_age_add(){ // 适用年龄添加
            return view();
        }
        public function pro_age_insert(){ // 适用年龄插入数据库
            $age = input('age'); // 获取当前适用年龄
            if(empty($age)){
                Alert('适用年龄不能为空','-1');
            }
            $insert = Db::table('pro_type_age')->insert(['age'=>$age]); // 插入数据库
            if($insert){
                Alert('添加成功',url('pro_type'));
            }else{
                Alert('添加失败','-1');
            }
        }
        public function pro_age_edit(){ // 适用年龄编辑
            $id = $_GET['id']; // 获取当前ID
            $age = Db::table('pro_type_age') // 取出当前数据
            ->where('id',$id)
            ->find();
            $this->assign('age',$age); // 模板赋值
            return view();
        }
        public function pro_age_update(){ // 适用年龄更新
            $id = input('id'); // 获取当前ID
            $age = input('age'); // 获取当前适用年龄
            if(empty($age)){
                Alert('适用年龄不能为空','-1');
            }
            $update = Db::table('pro_type_age') // 更新当前年龄
            ->where('id',$id)
            ->update(['age'=>$age]);
            if($update){
                Alert('更新成功',url('pro_type'));
            }
        }
        public function pro_age_delete(){ // 适用年龄删除
            $id = $_GET['id']; // 获取当前ID
            $delete = Db::table('pro_type_age') // 删除当前数据
            ->where('id',$id)
            ->delete();
            if($delete){
                Alert('删除成功',url('pro_type'));
            }
        }

        // 产品参考身高
        public function pro_height(){
            $height = Db::table('pro_height')->select(); // 取出身高值
            $this->assign('height',$height);
            return view();
        }
        public function pro_height_add(){ // 添加参考身高
            return view();
        }
        public function pro_height_insert(){ // 插入数据库
            $height = input('height'); // 获取当前身高值
            if(empty($height)){
                Alert('参考身高不能为空','-1');
                exit;
            }
            $insert = Db::table('pro_height')->insert(['height'=>$height]); // 插入数据库
            if($insert){
                Alert('添加成功',url('pro_height'));
            }
        }
        public function pro_height_edit(){ // 参考身高编辑
            $id = $_GET['id'];
            $height = Db::table('pro_height')
            ->where('id',$id)
            ->find();
            $this->assign('height',$height);
            return view();
        }
        public function pro_height_update(){ // 参考身高更新
            $id = input('id');
            $height = input('height');
            if(empty($height)){
                Alert('参考身高不能为空','-1');
                exit;
            }
            $update = Db::table('pro_height')
            ->where('id',$id)
            ->update(['height'=>$height]);
            if($update){
                Alert('更新成功',url('pro_height'));
            }
        }
        public function pro_height_delete(){ // 删除参考身高
            $id = $_GET['id'];
            $delete = Db::table('pro_height')
            ->where('id',$id)
            ->delete();
            if($delete){
                Alert('删除成功',url('pro_height'));
            }
        }
    }