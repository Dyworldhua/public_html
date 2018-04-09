<?php
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $group_name = $_POST['group_name'];
    $group_cid = json_encode($_POST['cid']);
    $insert = "insert into power_group(group_name,group_id) value('$group_name','$group_cid')";
    $result = $link->query($insert);
    if($result){
        echo "<script>alert('添加成功！');location.href='power_list.php'</script>";
    }else{
        echo "<script>alert('添加失败！');window.history.back()</script>";
    }
?>