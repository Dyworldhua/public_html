<?php
    require 'base.php';

    $_GET['id'] = isset($_GET['id'])?$_GET['id']:2;
    $banner_id = $_GET['id'];
    //var_dump($banner_id);
    if(!empty($banner_id)){
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $sql = "select * from banner_list where type_id = 2";
    $result = $link->query($sql);
    $row = $result->fetch();
    }else{
        echo "<script>alert('404 not found!');window.history.back()</script>";
    }

    require FRONT_VIEW_DIR.'/'.'about.html';
?>