<?php
    $id = $_GET['id'];
    $link = mysqli_connect('localhost','root','','project');
    mysqli_query($link,"set names utf8");
    $sql = "delete from news_list where id = '$id'";
    $result = mysqli_query($link,$sql);
    if($sql){
        echo "<script>alert('删除成功！');location.href='news_list.php'</script>";
    }else{
        echo "<script>alert('删除失败！');location.href='news_list.php'</script>";
    }
?>