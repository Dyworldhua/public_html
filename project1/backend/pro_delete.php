<?php
    $id = $_GET['id'];
    $link = mysqli_connect('localhost','root','','project');
    mysqli_query($link,"set names utf8");
    $sql = "delete from pro_list where id = '$id'";
    $result = mysqli_query($link,$sql);
    if($result){
        echo "<script>alert('删除成功！');window.history.back()</script>";
    }else{
        echo "<script>alert('删除失败！');window.history.back()</script>";
    }