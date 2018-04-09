<?php
    $type = $_POST['type'];
    if(empty($type)){
        echo "<script>alert('产品类型不能为空');window.history.back()</script>";
        exit;
    }
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $insert = "insert into pro_type(type) value('$type')";
    $result = $link->query($insert);
    if($result){
        echo "<script>alert('类型添加成功');location.href='pro_type_list.php'</script>";
    }else{
        echo "<script>alert('类型添加失败');window.history.back()</script>";
    }
?>