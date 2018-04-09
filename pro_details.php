<?php
    require 'base.php';
    $_GET['banner_id'] = isset($_GET['banner_id'])?$_GET['banner_id']:3;
    $banner_id = $_GET['banner_id'];

    $id = $_GET['id'];
    
    // 产品列表库
    if(!empty($banner_id)){
        $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
        $sql = "select * from pro_list where id = '$id'";
        $result = $link->query($sql);
        //var_dump($result);
        $row = $result->fetch();

        // 产品详情库
        $sql_del = "select * from pro_del where pro_id = '$id'";
        // var_dump($sql_del);
        $del_result = $link->query($sql_del);
        //var_dump($del_result);
        $del = $del_result->fetch();

        //Banner
        $sql_banner = "select * from banner_list where type_id = $banner_id";
        $banner_result = $link->query($sql_banner);
        $data_banner = $banner_result->fetch();

        }else{
        echo "<script>alert('404 not found');location.href='product.php'</script>"; 
        }

    require FRONT_VIEW_DIR.'/pro_details.html';

?>