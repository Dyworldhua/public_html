<?php
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');

    //图片上传
    $info = $_FILES['logo'];
   
    //$type = $info['']
    $type = substr($info['type'],0,5);
    
    $name = $info['name'];
    $offset = strpos($name,'.')+1;
    $extention = substr($name,$offset);
    $new_name = uniqid().'.'.$extention;
    $url = 'logo/'.$new_name;

    //公司信息
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $fax = $_POST['fax'];
    $phone = $_POST['phone'];
    $post = $_POST['post'];
    $introduce = $_POST['introduce'];

    //判断条件
    if(empty($address)){
        echo "<script>alert('公司地址不能为空！');window.history.back()</script>";
        exit;
    }
    if(empty($telephone)){
        echo "<script>alert('公司电话不能为空！');window.history.back()</script>";
        exit;
    }
    if(empty($email)){
        echo "<script>alert('公司邮箱不能为空！');window.history.back()</script>";
        exit;
    }
    if(empty($fax)){
        echo "<script>alert('公司传真不能为空！');window.history.back()</script>";
        exit;
    }
    if(empty($phone)){
        echo "<script>alert('公司手机不能为空！');window.history.back()</script>";
        exit;
    }
    if(empty($post)){
        echo "<script>alert('公司邮编不能为空！');window.history.back()</script>";
        exit;
    }
    if(empty($introduce)){
        echo "<script>alert('公司介绍不能为空！');window.history.back()</script>";
        exit;
    }

    if(empty($name)){
        $update = "update information set address = '$address',telephone = '$telephone',email = '$email',fax = '$fax',phone = '$phone',post = '$post',introduce = '$introduce'";
        $result = $link->query($update);
    }else{
        if($type == 'image'){
            $upload = move_uploaded_file($info['tmp_name'],$url);
            if($upload){
                $update = "update information set logo = '$url',address = '$address',telephone = '$telephone',email = '$email',fax = '$fax',phone = '$phone',post = '$post',introduce = '$introduce'";
                $result = $link->query($update);
            }
        }else{
            echo "<script>alert('请上传图片格式文件！');window.history.back()</script>";
        }
    }
    if($result){
        echo "<script>alert('信息修改成功！');location.href='information.php'</script>";
    }else{
        echo "<script>alert('信息修改失败！');location.href='information.php'</script>";
    }
?>