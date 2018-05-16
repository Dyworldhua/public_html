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
            // 取出产品类型
            $type = Db::table('pro_type')->select();
            $this->assign('type',$type);
            // 取出适用年龄
            $age = Db::table('pro_type_age')->select();
            $this->assign('age',$age);
            // 取出参考身高
            $height = Db::table('pro_height')->select();
            foreach($height as $key => $val){
                $offset = strpos($val['height'],'（');
                $height[$key]['height'] = mb_substr($val['height'],0,$offset,"utf8");
            }
            $this->assign('height',$height);
            // 取出首页内容分类
            $sub_type = Db::table('index_sub_type')->select();
            $this->assign('sub_type',$sub_type);
            return view();
        }
        public function add(){
                // 图片处理
                $info = Upload('picture'); // 调用图片上传封装函数
                $position = ROOT_PATH . 'public' . DS . 'uploads' . DS;
                $data['picture'] = $info->getSavename(); // 获取保存路径
                // 判断是否选择生成缩略图
                if(input('thumb')==1){
                    $file = $position.$data['picture']; // 调用生成缩略图封装函数
                    $save = ROOT_PATH . 'public' . DS . 'uploads' . DS . 'thumb' . DS . uniqid() . '.' .'jpg'; // 缩略图生成保存路径
                    $image = Thumb($file,$save);
                }

            // 获取产品介绍
            $data['title'] = input('title');//产品名称
            $data['price'] = input('price');//产品价格
            $data['stock'] = input('stock');//产品库存
            $data['sale'] = input('sale');//产品月销量
            $data['score'] = input('score');//产品评价
            $data['integral'] = input('integral');//产品积分
            $data['sub_type'] = input('sub_type'); // 产品首页内容分类
            $data['color'] = json_encode(input('co/a')); //产品颜色，存为json格式
            $data['height'] = json_encode(input('height/a')); // 参考身高，存为JSON格式
            $data['default_id'] = empty(input('adver'))?0:input('adver'); // 是否作为广告产品
            
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
           
            // 将产品类型插入数据库中
            $data['type'] = input('type'); // 产品类型
            $data['sex'] = input('pro_sex'); // 适用性别
            $data['age'] = input('age'); // 适用年龄
            $data['hot'] = input('hot'); // 选购热点
            $data['season'] = input('season'); // 适用季节
            $data['thickness'] = input('thickness'); // 产品厚薄度

            // 插入数据库
            $insert_pro = Db::table('product')->insert($data); // 产品基本信息插入产品信息表中
            $pro_id = Db::table('product')->getLastInsID(); // 获取当前插入数据的自增长ID值
            $para['pro_id'] = $pro_id; // 将其插入产品详情表中
            $insert_del = Db::table('pro_del')->insert($para); // 产品参数插入产品参数表中，以上一部获取的id值做关联条件
            if($insert_del and $insert_pro){
                Alert('添加成功','-1');
            }
        } 
    }