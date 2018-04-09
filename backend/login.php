<?php
    session_start(); // 开启session
    $username = $_POST['username'];
    $password = md5($_POST['pwd']);
    $code = $_POST['code'];
    // 链接数据库
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');

    //判断用户名
    if(empty($username)){
        echo "<script>alert('用户名不能为空！');window.history.back()</script>";
        exit;
    }
    
    // 判断用户名是否正确
    $sql_username = "select * from user where username = '$username'";
    $username_result = $link->query($sql_username);
    $row = $username_result->fetch(); // 以结果集作为判断条件
    if($row){
        if($password == $row['password']){ // 如果用户名正确直接取出结果集中的password作为判断条件判断密码是否正确
            if($code == $_SESSION['code']){
                echo "<script>alert('登录成功！');location.href='index.php'</script>";
            }else{
                echo "<script>alert('验证码错误！');window.history.back()</script>";
            }
        }else{
            echo "<script>alert('密码错误！');window.history.back()</script>";
        }
    }else{
        echo "<script>alert('用户名错误！');window.history.back()</script>";
    }
    $_SESSION['username'] = $username; // 将用户名存入session中
?>