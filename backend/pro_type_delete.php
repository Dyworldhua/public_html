<?php
    $id = $_GET['id'];
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $delete = "delete from pro_type where id = '$id'";
    $result = $link->query($delete);
    if($result){
        echo "<script>alert('类型删除成功');location.href='pro_type_list.php'</script>";
    }else{
        echo "<script>alert('类型删除失败');window.history.back()</script>";
    }
?>