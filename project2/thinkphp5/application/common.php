<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

    // 封装验证失败时URL返回
    function Alert($str,$url=''){
        if($url == '-1'){
            echo "<script>alert(\"$str\");window.history.back()</script>";
        }elseif($url == '-2'){
            echo "<script>alert(\"$str\");history.go(-2)</script>";
        }else{
            echo "<script>alert(\"$str\");location.href='$url'</script>";
        }
    }

    //图片上传
    function Upload($name){
        $files = request()->file($name); // key值为html页面中的name值
        $info = $files->move(ROOT_PATH . 'public' . DS . 'uploads'); // 将图片保存到指定目录中
        return $info;
    }
    //生成缩略图
    function Thumb($file,$save){
        $image = \think\Image::open($file);
        $image->thumb(150,150,\think\Image::THUMB_CENTER)->save($save);
        return $image;
    }

    // 首页分类遍历
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