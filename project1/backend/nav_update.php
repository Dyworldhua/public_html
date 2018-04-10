<?php 
    $nav = $_POST['nav'];
    $id = $_POST['id'];
    if(empty($nav)){
        echo "<script>alert('导航栏不能为空');window.history.back()</script>";
        exit;
    }
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $update = "update nav_list set nav_name = '$nav' where id = '$id'";
    $result = $link->query($update);
    if($result){
        echo "<script>alert('更改成功');location.href='nav_list.php'</script>";
    }else{
        echo "<script>alert('更改失败');window.history.back()</script>";
    }
?>