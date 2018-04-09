<?php
	require 'base.php';
	$_GET['banner_id'] = isset($_GET['banner_id'])?$_GET['banner_id']:4;
	$banner_id = $_GET['banner_id'];

	$id = $_GET['id'];

    if(!empty($_GET['banner_id'])){
		require __DIR__.'/mysql_function.php';
		$link = conn($config);
		$sql = "select * from news_list where id = '$id'";
		$result = mysqli_query($link,$sql);
		$row = mysqli_fetch_assoc($result);
		$row['date'] = date('m-d',strtotime($row['date']));
		
		$note_title_offset = mb_strpos($row['note'],'。');
		$note_title = mb_substr($row['note'],0,$note_title_offset,"utf-8").'...';
		$note = mb_substr($row['note'],$note_title_offset+1);

		// 下一篇
		$sql_next = "select * from news_list where id > '$id' order by id asc limit 0,1";
		//var_dump($sql_next);
		$result_next = mysqli_query($link,$sql_next);
		//var_dump($result_next);
		$row_next = mysqli_fetch_assoc($result_next);

		//上一篇
		$sql_prev = "select * from news_list where id < '$id' order by id desc limit 0,1";
		$result_prev = mysqli_query($link,$sql_prev);
		$row_prev = mysqli_fetch_assoc($result_prev);
		//var_dump(empty($row_prev));

		//Banner
		$sql_banner = "select * from banner_list where type_id = $banner_id";
		$banner_result = mysqli_query($link,$sql_banner);
		$data_banner = mysqli_fetch_assoc($banner_result);
	
	}else{
        echo "<script>alert('404 not found!');window.history.back()</script>";
    }

	require FRONT_VIEW_DIR . '/news_details.html';