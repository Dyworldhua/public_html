<?php
    session_start();
    $username = $_SESSION['username'];
    $link = mysqli_connect('localhost','root','','project');
    mysqli_query($link,"set names utf8");
    $sql = "select * from user";
    
    //基本信息
    $title = $_POST['title'];
    $pro_type = $_POST['type'];
    $content = $_POST['content'];
    $date = $_POST['date'];
    
    //详情信息
    $time = $_POST['time'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $classify = $_POST['classify'];
    $del_type = $_POST['del_type'];
    $num = $_POST['num'];
    $company = $_POST['company'];
    $color = $_POST['color'];
    $lvxin = $_POST['lvxin'];
    $position = $_POST['position'];
    $effect = $_POST['effect'];
    if(empty($title)){
        echo "<script>alert('产品名称不能为空!');window.history.back()</script>";
        exit;
    }
    if(empty($pro_type)){
        echo "<script>alert('请选择产品类型!');window.history.back()</script>";
        exit;
    }
    if(empty($content)){
        echo "<script>alert('产品内容不能为空!');window.history.back()</script>";
        exit;
    }
    if(empty($date)){
        echo "<script>alert('请填写时间!');window.history.back()</script>";
        exit;
    }
    //获取上传文件的信息
    $info = $_FILES['img'];
    if(empty($info)){
        echo "<script>alert('请上传图片!');window.history.back()</script>";
        exit;
    }
    //获取文件上传的临时目录
    $tmp_name = $info['tmp_name'];
    //获取文件的后缀名
    $original = $info['name'];
    $offset = strpos($original,'.') + 1;// 获取文件后缀名第一次出现的位置
    $extention = substr($original,$offset);// 通过截取函数获取文件的后缀格式
    // 通过uniqid获取一个唯一的值
    $filename = uniqid().'.'.$extention;
    $address = 'pro_img/'.$filename;
    $type = $info['type'];
    $img_type = substr($type,0,5);
    if($img_type !== 'image'){
        echo "<script>alert('请上传图片格式文件!');window.history.back()</script>";
        exit;
    }
    $upload = move_uploaded_file($tmp_name,$address);
    $pro_add = "insert into pro_list(name,type,img_src,content,person,ctime) value('$title','$pro_type','$address','$content','$username','$date')";
    $pro_result = mysqli_query($link,$pro_add);
    $pro_id = mysqli_insert_id($link);
    if($pro_result){
        $del_add = "insert into pro_del(pro_id,date,brand,model,classify,type,num,company,color,lvxin,position,effect) value('$pro_id','$time','$brand','$model','$classify','$del_type','$num','$company','$color','$lvxin','$position','$effect')";
        $del_result = mysqli_query($link,$del_add);
        if($del_result){
            echo "<script>alert('添加成功！');location.href='pro_list.php'</script>";
        }else{
            echo "<script>alert('添加失败！');window.history.back()</script>";
        }
    }else{
        echo "<script>alert('添加失败！');window.history.back()</script>";
    }
   
   
    
    