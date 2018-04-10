<?php 
    $nav = $_POST['nav'];
    if(empty($nav)){
        echo "<script>alert('导航栏不能为空');window.history.back()</script>";
        exit;
    }
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $insert = "insert into nav_list(nav_name) value('$nav')";
    $result = $link->query($insert);
    if($result){
        echo "<script>alert('添加成功');location.href='nav_list.php'</script>";
    }else{
        echo "<script>alert('添加失败');window.history.back()</script>";
    }
?>