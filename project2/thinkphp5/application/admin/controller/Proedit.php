<?php 
    namespace app\admin\Controller;
    use think\Controller;
    use think\Db;
    
    class Proedit extends Controller{
        public function pro_edit(){
            //将产品数据从数据库中取出
            $id = $_GET['id'];
            //var_dump($id);
            $product = Db::table('product')->where('id',$id)->find(); // 只取一条数据的时候用find()
            $classify = json_decode($product['color']); // 将表中颜色分类字段转化转化为数组格式
            // 颜色分类模板赋值
            $this->assign('classify',$classify);
            // 产品数据模板赋值
            $this->assign('product',$product);
            // 将产品详情从数据表中取出
            $pro_del = Db::table('pro_del')->where('pro_id',$id)->find();
            // 产品详情模板赋值
            $this->assign('pro_del',$pro_del);

            //将颜色分类从数据库中取出
            $color = Db::table('color')->select();
            $this->assign('color',$color);
            //var_dump($product);
            return view();
        }
        public function update(){

            $update_id = input('update_id'); // 获取当前产品ID
    
            // 图片处理
            $files = request()->file('picture'); // key值为html页面中的name值
            if(!empty($files)){
                $info = $files->move(ROOT_PATH . 'public' . DS . 'uploads'); // 将图片保存到指定目录中
                $data['picture'] = $info->getSavename(); // 获取保存路径
            }
            // var_dump($data);
            // 获取产品介绍
            $data['title'] = input('title');//产品名称
            $data['price'] = input('price');//产品价格
            // $img = $_FILES['img']; // 产品颜色图片上传
            $data['stock'] = input('stock');//产品库存
            $data['sale'] = input('sale');//产品月销量
            $data['score'] = input('score');//产品评价
            $data['integral'] = input('integral');//产品积分
            $data['color'] = json_encode(input('co/a')); //产品颜色，存为json格式
            //产品参数
            $para['material'] = input('material');  //材质
            $para['sex'] = input('sex');  //性别
            $para['color'] = input('color');  //颜色分类
            $para['model'] = input('model');  //模特实拍
            $para['number'] = input('number');  //产品货号
            $para['fabric'] = input('fabric');  //产品面料
            $para['resources'] = input('resources');  // 参考身高
            //产品内容
            $para['content'] = input('content'); 
            if(empty($para['content'])){
                Alert('产品内容不能为空','-1');
                exit;
            }
            // 产品基本信息更新
            $update = Db::table('product')
            ->where('id',$update_id)
            ->update($data);
            // 产品详情信息更新
            $del_update = Db::table('pro_del')
            ->where('pro_id',$update_id)
            ->update($para);
            // var_dump($update);
            // var_dump($del_update);
            // exit;
            if($update or $del_update){
                Alert('产品更新成功！',url('Product/product'));
            }
        }
    }