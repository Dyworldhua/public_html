<?php
    $link = $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $id = $_POST['id'];
    $group_name = $_POST['group_name'];
    $power = json_encode($_POST['cid']);
    $update = "update power_group set group_name = '$group_name',group_id = '$power' where id = '$id'";
    $result = $link->query($update);
    if($result){
        echo "<script>alert('修改成功！');location.href='power_list.php'</script>";
    }else{
        echo "<script>alert('修改失败！');window.history.back()</script>";
    }
?>