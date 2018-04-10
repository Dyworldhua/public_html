<?php
    $id = $_POST['id'];
    $type = $_POST['type'];
    if(empty($type)){
        echo "<script>alert('产品类型不能为空');window.history.back()</script>";
        exit;
    }
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $update = "update pro_type set type = '$type' where id = '$id'";
    $result = $link->query($update);
    if($result){
        echo "<script>alert('类型更新成功');location.href='pro_type_list.php'</script>";
    }else{
        echo "<script>alert('类型更新失败');window.history.back()</script>";
    }
?>