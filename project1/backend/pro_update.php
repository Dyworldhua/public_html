<?php
	$link = mysqli_connect('localhost','root','','project');
	mysqli_query($link,"set names utf8");
	// POST传参信息
	$id = $_POST['id'];
	$title = $_POST['title'];
	$pro_type = $_POST['type'];
	$content = $_POST['content'];
	$date = $_POST['date'];
	// 上传文件信息
	$info = $_FILES['img'];
	$type = $info['type'];
	$img_type = substr($type,0,5);
	$tmp_name = $info['tmp_name'];
	$original = $info['name'];
    $offset = strpos($original,'.') + 1;
    $extention = substr($original,$offset);
    $filename = uniqid().'.'.$extention;
	$address = 'pro_img/'.$filename;

	//产品详情信息
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
	// 判断其他条件是否为空
	if(empty($title)){
		echo "<script>alert('标题不能为空！');window.history.back()</script>";
		exit;
	}
	if(empty($pro_type)){
		echo "<script>alert('请选择类型');window.history.back()</script>";
		exit;
	}
	if(empty($content)){
		echo "<script>alert('内容不能为空！');window.history.back()</script>";
		exit;
	}
	if(empty($date)){
		echo "<script>alert('请填写时间！');window.history.back()</script>";
		exit;
	}
	// 判断上传数据库语句
	if(empty($original)){
		$update = "update pro_list set name = '$title',type = '$pro_type',content = '$content',ctime = '$date' where id = '$id'";
		$result = mysqli_query($link,$update);
	}else{
		if($img_type == 'image'){
			$upload = move_uploaded_file($tmp_name,$address);
			if($upload){
				$update = "update pro_list set name = '$title',type = '$pro_type',img_src = '$address',content = '$content',ctime = '$date' where id = '$id'";
				$result = mysqli_query($link,$update);
			}
		}else{
			echo "<script>alert('请上传图片格式文件！');window.history.back()</script>";
		}
	}

	if($result){	
		$del_update = "update pro_del set date = '$time',brand = '$brand',model = '$model',classify = '$classify',type = '$del_type',num = '$num',company = '$company',color = '$color',lvxin = '$lvxin',position = '$position',effect = '$effect' where pro_id = '$id'";
		$del_result = mysqli_query($link,$del_update);
		if($del_result){
			echo "<script>alert('修改成功！');location.href='pro_list.php'</script>";
		}else{
			echo "<script>alert('修改失败！');window.history.back()</script>";
		}
	}else{
		echo "<script>alert('修改失败！');window.history.back()</script>";
	}
	