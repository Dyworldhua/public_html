<?php
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    session_start();
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $content = $_POST['content'];
    $code = $_POST['code'];
    if(empty($name)){
        echo "<script>alert('名字不能为空');window.history.back()</script>";
        exit;
    }
    if(empty($email)){
        echo "<script>alert('邮箱不能为空');window.history.back()</script>";
        exit;
    }
    $pattern_ema = "/^\d{6,}@(163|qq|yahoo|126)(\.com|cn)$/";
    $ema = preg_match($pattern_ema,$email);
    if($ema!==1){
        echo "<script>alert('请填写正确的邮箱格式');window.history.back()</script>"; 
        exit;
    }
    if(empty($phone)){
        echo "<script>alert('电话不能为空');window.history.back()</script>";
        exit;
    }
    $pattern_pho = "/^[1](3|5|7|8)[0-9]{9}$/";
    $int = preg_match($pattern_pho,$phone);
    //var_dump($int);
    if($int!==1){
        echo "<script>alert('请填写正确的电话格式');window.history.back()</script>"; 
        exit;
    }
    if(empty($phone)){
        echo "<script>alert('电话不能为空');window.history.back()</script>";
        exit;
    }
    if(empty($content)){
        echo "<script>alert('内容不能为空');window.history.back()</script>";
        exit;
    }
    if(empty($code)){
        $insert = "insert into message(name,email,phone,content) value('$name','$email','$phone','$content')";
        //var_dump($insert);
        $result = $link->query($insert);
    }else{
        if($code == $_SESSION['code']){
            $insert = "insert into message(name,email,phone,content) value('$name','$email','$phone','$content')";
            //var_dump($insert);
            $result = $link->query($insert);
        }else{
            echo "<script>alert('验证码错误！');window.history.back()</script>";
        }
    }
    if($result){
        echo "<script>alert('留言成功！');window.location.href='contact.php'</script>";
    }else{
        echo "<script>alert('留言失败！');window.history.back()</script>";
    }
    