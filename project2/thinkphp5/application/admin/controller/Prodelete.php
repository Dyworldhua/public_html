<?php
    namespace app\admin\Controller;
    use think\Controller;
    use think\Db;
    class Prodelete extends Controller{
        public function delete(){
            $id = $_GET['id']; // 获取当前ID
            $delete = Db::table('product') // 删除产品基本信息
            ->where('id',$id)
            ->delete();
            $del_delete = Db::table('pro_del') // 删除产品详情信息
            ->where('pro_id',$id)
            ->delete();
            if($delete and $del_delete){
                Alert('删除成功！',url('Product/product'));
            }
        }
    }