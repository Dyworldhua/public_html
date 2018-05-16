<?php 
    namespace app\admin\Controller;
    use think\Controller;
    use think\Db;
    
    class Proedit extends Controller{
        public function pro_edit(){
            //将产品数据从数据库中取出
            $id = $_GET['id'];
            $product = Db::table('product')->where('id',$id)->find(); // 只取一条数据的时候用find()
            $classify = json_decode($product['color']);// 将表中颜色分类字段转化转化为数组格式
            $reference = json_decode($product['height']); // 取出表中参考身高，并转化为数组格式
            $this->assign('reference',$reference);
            // 取出产品当前类型
            $pro_type = Db::table('pro_add_type')->where('id',$product['type_id'])->find();
            // 将产品详情从数据表中取出
            $pro_del = Db::table('pro_del')->where('pro_id',$id)->find();
            // 产品类型模板赋值
            $this->assign('pro_type',$pro_type); 
            // 颜色分类模板赋值
            $this->assign('classify',$classify);
            // 产品数据模板赋值
            $this->assign('product',$product);
            // 产品详情模板赋值
            $this->assign('pro_del',$pro_del);
            
            // 取出产品类型
            $type = Db::table('pro_type')->select();
            $this->assign('type',$type);
            // 取出参考身高
            $height = Db::table('pro_height')->select();
            foreach($height as $key => $val){
                $offset = strpos($val['height'],'（');
                $height[$key]['height'] = mb_substr($val['height'],0,$offset,"utf8"); // 截取参考身高，只显示身高值
            }
            $this->assign('height',$height);
            // 取出适用年龄
            $age = Db::table('pro_type_age')->select();
            $this->assign('age',$age);
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
            $data['height'] = json_encode(input('height/a'));// 参考身高，存为json格式
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
             // 产品类型
             $type['type'] = input('type'); // 产品类型
             $type['sex'] = input('pro_sex'); // 适用性别
             $type['age'] = input('age'); // 适用年龄
             $type['hot'] = input('hot'); // 选购热点
             $type['season'] = input('season'); // 适用季节
             $type['thickness'] = input('thickness'); // 产品厚薄度
            
            $type_id = Db::table('product')->where('id',$update_id)->find(); // 链接当前数据，获取产品类型ID
            $insert_type = Db::table('pro_add_type')->where('id',$type_id['type_id'])->update($type); // 产品类型更新
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