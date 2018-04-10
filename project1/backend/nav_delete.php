<?php
    $id = $_GET['id'];
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $delete = "delete from nav_list where id = '$id'";
    $result = $link->query($delete);
    if($result){
        echo "<script>alert('删除成功');location.href='nav_list.php'</script>";
    }else{
        echo "<script>alert('删除失败');window.history.back()</script>";
    }
?>