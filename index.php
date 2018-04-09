<?php
    require 'base.php';
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');

    $_GET['id'] = isset($_GET['id'])?$_GET['id']:1;
    $banner_id = $_GET['id'];
    //var_dump($banner_id);
    $sql_type = "select * from banner_list where type_id = $banner_id";
    $type_result = $link->query($sql_type);
    $data_type = [];
    while($value = $type_result->fetch()){
        $data_type[] = $value;
    }

    // 首页产品轮播
    $pro_type_sql = "select * from pro_type";   // 遍历产品类型
    $pro_type_result = $link->query($pro_type_sql);
    $pro_type_data = [];
    while($pro_type_row = $pro_type_result->fetch()){
        $pro_type_data[] = $pro_type_row;
    }

    $_GET['type_id'] = isset($_GET['type_id'])?$_GET['type_id']:1; //默认产品类型为1
    $type_id = $_GET['type_id'];
    $pro_sql = "select * from pro_list where type = $type_id order by ctime desc limit 0,4";
    $pro_list_result = $link->query($pro_sql);
    $pro_list_data = [];
    while($pro_list_row = $pro_list_result->fetch()){
        $pro_list_data[] = $pro_list_row;
    }

    // 首页新闻
    $new_type = "select * from news_type";
    $new_type_result = $link->query($new_type);
    $new_type_data = [];
    while($new_type_row = $new_type_result->fetch()){
        $new_type_data[] = $new_type_row;
    }

    $_GET['new_type'] = isset($_GET['new_type'])?$_GET['new_type']:1;
    $new_type = $_GET['new_type'];
    $new_list = "select * from news_list where type_id = $new_type order by date desc limit 0,3";
    $new_result = $link->query($new_list);
    $new_data = [];
    while($new_row = $new_result->fetch()){
        $new_row['note'] = mb_substr($new_row['note'],0,60,"utf-8").'...';
        $new_data[] = $new_row; 
    }
    //var_dump($new_data);

    require FRONT_VIEW_DIR.'/'.'index.html';
?>