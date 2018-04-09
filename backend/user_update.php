<?php
    //链接数据库
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');

    // 获取前台页面POST传参值
    $id = $_POST['id'];
    //$username = $_POST['username'];
    $password = md5($_POST['pwd']);
    $nickname = $_POST['nickname'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $power = $_POST['power'];
    
    // 判断
    if(empty($password)){
        echo "<script>alert('密码不能为空');window.history.back()</script>";
        exit;
    }
    if(empty($nickname)){
        echo "<script>alert('昵称不能为空');window.history.back()</script>";
        exit;
    }
    if(empty($sex)){
        echo "<script>alert('请选择性别');window.history.back()</script>";
        exit;
    }
    if(empty($email)){
        echo "<script>alert('邮箱不能为空');window.history.back()</script>";
        exit;
    }
    $pattern = "/^\d{6,}@\w{2,}(\.?)(com|cn)$/";
    $int = preg_match($pattern,$email);
    // var_dump($int);
    if($int !== 1){
        echo "<script>alert('请填写正确格式的邮箱！');window.history.back()</script>";
        exit;
    }

    //更新数据
    $update = "update user set password = '$password',nickname = '$nickname',sex = '$sex',email = '$email',power = '$power' where id = '$id'";
    $result = $link->query($update);
    if($result){
        echo "<script>alert('用户更新成功！');location.href='user_list.php'</script>";
    }else{
        echo "<script>alert('用户更新失败！');window.history.back()</script>";
    }
?>