<?php
    $link = mysqli_connect('localhost','root','','project');
    mysqli_query($link,"set names utf8");
    $info = $_FILES['img'];
    $tmp_name = $info['tmp_name'];
    $original = $info['name'];
    $img_type = substr($info['type'],0,5);
    $offset = strpos($original,'.')+1;
    $extention = substr($original,$offset);
    $filename = uniqid().'.'.$extention;
    $address = 'new_img/'.$filename;
    $title = $_POST['title'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $note = $_POST['note'];
    $content = $_POST['content'];
    if(empty($title)){
        echo "<script>alert('请输入标题');window.history.back()</script>";
        exit;
    }
    if(empty($date)){
        echo "<script>alert('请填写时间');window.history.back()</script>";
        exit;
    }
    if(empty($note)){
        echo "<script>alert('请填写摘要');window.history.back()</script>";
        exit;
    }
    if(empty($content)){
        echo "<script>alert('内容不能为空！');window.history.back()</script>";
        exit;
    }
    if(empty($original)){
        echo "<script>alert('请上传图片！');window.history.back()</script>";
        exit;
    }
    if($img_type=='image'){
        $upload = move_uploaded_file($tmp_name,$address);
        if($upload){
            $add = "insert into news_list(title,type_id,img_src,note,content,date) value('$title','$type','$address','$note','$content','$date')";
            $result = mysqli_query($link,$add);
                if($result){
                    echo "<script>alert('新闻添加成功！');location.href='news_list.php'</script>";
                }else{
                    echo "<script>alert('新闻添加失败！');window.history.back()</script>";
                }
        }
    }else{
        echo "<script>alert('图片格式错误！');window.history.back()</script>";
    }
?>