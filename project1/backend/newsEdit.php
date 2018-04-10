<?php
    $link = mysqli_connect('localhost','root','','project');
    mysqli_query($link,"set names utf8");

    $id = $_POST['id'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $new_type = $_POST['type'];
    $content = $_POST['content'];
    
    $info = $_FILES['img'];
    $type = $info['type'];
    $img_type = substr($type,0,5);
    $tmp_name = $info['tmp_name'];
    $original = $info['name'];
    $offset = strpos($original,'.')+1;
    $extention = substr($original,$offset);
    $filename = uniqid().'.'.$extention;
    $address = 'pro_img/'.$filename;

    if(empty($title)){
        echo "<script>alert('标题不能为空');window.history.back()</script>";
        exit;
    }
    if(empty($date)){
        echo "<script>alert('请填写时间');window.history.back()</script>";
        exit;
    }
    if(empty($new_type)){
        echo "<script>alert('请选择类型');window.history.back()</script>";
        exit;
    }
    if(empty($content)){
        echo "<script>alert('内容不能为空');window.history.back()</script>";
        exit;
    }

    if(empty($original)){
        $update = "update news_list set type_id = '$new_type',title = '$title',content = '$content',date = '$date' where id = '$id'";
        $result = mysqli_query($link,$update);
    }else{
        if($img_type === 'image'){
            $upload = move_uploaded_file($tmp_name,$address);
            if($upload){
                $update = "update news_list set type_id = '$new_type',img_src = '$address',title = '$title',content = '$content',date = '$date' where id = '$id'";
                $result = mysqli_query($link,$update);
            }
        }else{
            echo "<script>alert('请上传图片格式文件');</script>";
        }
    }
    
    if($result){
        echo "<script>alert('修改成功！');location.href='news_list.php'</script>";
    }else{
        echo "<script>alert('修改失败！');window.history.back()</script>";
    }
?>