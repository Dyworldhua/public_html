<?php
    namespace app\index\Controller;
    use think\Controller;
    use think\Db;
    use app\index\controller\Base;
    use think\Session;
    class Prodetails extends Base{
        public function prodetails(){
            parent::_initialize();
            $id = $_GET['id']; // 获取当前产品ID
            $this->assign('id',$id);
            $product = Db::table('product')->where('id',$id)->find(); // 取出产品基本信息
            $this->assign('product',$product);
            $pro_del = Db::table('pro_del')->where('pro_id',$id)->find(); // 取出产品详情信息
            $this->assign('pro_del',$pro_del);
            $height = json_decode($product['height']); // 取出当前产品的参考身高
            $this->assign('height',$height);
            $color = json_decode($product['color']); // 取出当前产品的颜色分类
            $this->assign('color',$color);
            // $this->assign('color',$id);
            // 产品参考身高前台显示
            $hei = Db::table('pro_height')->select();
            $this->assign('hei',$hei);
            // 颜色分类前台显示
            $col = Db::table('color')->select();
            $this->assign('col',$col);   

            // 送货地址显示
            $position = Db::table('position')->select();
            $data = [];
            foreach($position as $val){
                if($val['cid']==0){
                    $data[$val['id']] = $val;
                }
            }
            foreach($position as $son){
                if(isset($data[$son['cid']])){
                    $data[$son['cid']]['sub'][] = $son;
                }
            }
            $this->assign('data',$data);
            return view();
        }
    }