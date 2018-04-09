<?php
    $link = mysqli_connect('localhost','root','','project');
    mysqli_query($link,"set names utf8");
    $sql = "select * from user";
    $username = $_POST['username'];
    $password = md5($_POST['pwd']);
    $nickname = $_POST['nickname'];
    $sex = $_POST['sex'];
    $email = $_POST['email'];
    $time = date('Y-m-d',time());
    $power = $_POST['power'];

    if(empty($username)){
        echo "<script>alert('用户名不能为空');window.history.back()</script>";
        exit;
    }
    // 判断用户名是否被注册
    $sql_username = "select * from user where username = '$username'";
    $user_result = mysqli_query($link,$sql_username);
    $row = mysqli_fetch_assoc($user_result);
    if($row){
        echo "<script>alert('该用户名已经被注册！');window.history.back()</script>";
        exit;
    }
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
    //验证邮箱格式
    $pattern = "/^\d{6,}@(qq|126|163|yahoo)(\.com|cn)$/";
    $int = preg_match($pattern,$email);
    if($int!==1){
        echo "<script>alert('请填写正确邮箱！');window.history.back()</script>";
        exit;
    }
    if(empty($power)){
        echo "<script>alert('请选择权限组！');window.history.back()</script>";
        exit;
    }
    $add = "insert into user(username,password,nickname,sex,email,power,ctime) value('$username','$password','$nickname','$sex','$email','$power','$time')";
    $result = mysqli_query($link,$add);
    if($result){
        echo "<script>alert('添加成功');window.history.back()</script>";
    }else{
        echo "<script>alert('添加失败');window.history.back()</script>";
    }