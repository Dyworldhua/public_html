<?php
    $id = $_GET['id'];
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $delete = "delete from user where id = '$id'";
    $result = $link->query($delete);
    if($result){
        echo "<script>alert('删除成功！');window.history.back()</script>";
    }else{
        echo "<script>alert('删除失败！');window.history.back()</script>";
    }
?>