<?php
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $info = $_FILES['img'];
    $name = $info['name'];
    $tmp_name = $info['tmp_name'];
    $type = substr($info['type'],0,5);
    $last = strpos($name,'.')+1;
    $extention = substr($name,$last);//截取后缀名
    $offset = uniqid().'.'.$extention;
    $address = 'banner/'.$offset;
    $type_id = $_POST['type'];
    if(empty($name)){
        echo "<script>alert('请上传图片！');window.history.back()</script>";
        exit;
    }
    if($type!=='image'){
        echo "<script>alert('请上传图片格式文件！');window.history.back()</script>";
        exit;
    }
    $upload = move_uploaded_file($tmp_name,$address);
    if($upload){
        $sql = "insert into banner_list(type_id,img_src) value('$type_id','$address')";
        $result = $link->query($sql);
        if($result) {
            echo "<script>alert('图片添加成功！');location.href='banner_list.php'</script>";
        }else{
            echo "<script>alert('图片添加失败！');window.history.back()</script>";
        }
    }else{
        echo "<script>alert('图片上传失败！');window.history.back()</script>";
    }
    
?>