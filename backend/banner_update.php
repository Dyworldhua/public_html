<?php
    $id = $_POST['id'];
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $info = $_FILES['img'];
    // var_dump($info);
    $img_type = substr($info['type'],0,5);
    $name = strpos($info['name'],'.')+1;
    $offset = substr($info['name'],$name);
    $extention = uniqid().'.'.$offset;
    $address = 'banner/'.$extention;
    // $type = $_POST['type'];
    //var_dump($_POST);
    if(empty($info['name'])){
        echo "<script>alert('请上传图片！');window.history.back()</script>";
        exit;
    }
    if($img_type!=='image'){
        echo "<script>alert('请上传图片格式文件！');window.history.back()</script>";
        exit;
    }
    $upload = move_uploaded_file($info['tmp_name'],$address);
    if($upload){
        $sql = "update banner_list set img_src = '$address' where id = '$id'";
        
        $result = $link->query($sql);
        if($result){
            echo "<script>alert('图片修改成功！');location.href='banner_list.php'</script>";
        }
    }else{
        echo "<script>alert('图片上传失败！');window.history.back()</script>";
    }
    
?>