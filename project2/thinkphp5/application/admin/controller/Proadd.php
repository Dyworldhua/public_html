<?php
    namespace app\admin\Controller;
    use think\Controller;
    use think\Db;
    use think\Request;

    class Proadd extends Controller{
        public function pro_add(){
            // 从数据库中提取出颜色表
            $color = Db::table('color')->select();
            // // 模板赋值
            $this->assign('color',$color);
            return view();
        }
        public function add(){
            //var_dump($_FILES);
                // 图片处理
                $files = request()->file('picture'); // key值为html页面中的name值
                $info = $files->move(ROOT_PATH . 'public' . DS . 'uploads'); // 将图片保存到指定目录中
                $data['picture'] = $info->getSavename(); // 获取保存路径
    
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
            // 将数据插入数据库中
            $insert_pro = Db::table('product')->insert($data); // 产品基本信息插入产品信息表中
            $pro_id = Db::table('product')->getLastInsID(); // 获取当前插入数据的自增长ID值
            $para['pro_id'] = $pro_id;
            // var_dump($para['pro_id']);
            $insert_del = Db::table('pro_del')->insert($para); // 产品参数插入产品参数表中，以上一部获取的id值做关联条件
            if($insert_pro and $insert_del){
                Alert('产品添加成功',url('Product/product'));
            }else{
                Alert('产品添加失败','-1');
            }
        } 
    }