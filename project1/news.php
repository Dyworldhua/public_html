<?php
    require 'base.php';
    
    require 'mysql_function.php';
    $link = conn($config); // 链接数据库

    $_GET['id'] = isset($_GET['id'])?$_GET['id']:4;
    $banner_id = $_GET['id'];

    if(!empty($banner_id)){
        //var_dump($banner_id);
        $sql_banner = "select * from banner_list where type_id = $banner_id";
        $banner_result = mysqli_query($link,$sql_banner);
        $data_banner = mysqli_fetch_assoc($banner_result);
        // 设置分类
        $_GET['type'] = isset($_GET['type'])?$_GET['type']:1;
        $type_id = $_GET['type'];
        // 设置分页
        $current_page = isset($_GET['page'])?$_GET['page']:1; // 通过get获取当前页数，如果当前无页数则输出第一页
        // var_dump($current_page);
        $page_num = 3;
        $offset = ($current_page-1)*3;
        $sql = "select * from news_list where type_id = '$type_id' order by date desc limit $offset,$page_num";
        $result = mysqli_query($link,$sql);
        $all = mysqli_num_rows(mysqli_query($link,"select * from news_list where type_id = '$type_id'"));// 获取新闻总条数
        $page_max = ceil($all/3);//获取最大页数
        //var_dump($page_max);
        $data = [];
        while($row = mysqli_fetch_assoc($result)){
            $row['date'] = date('m-d',strtotime($row['date']));
            $data[] = $row;
        }
        
        $sql_type = "select * from news_type";
        $type_result = mysqli_query($link,$sql_type);
        //var_dump($type_result);
        $data_type = [];
        while($data_row = mysqli_fetch_assoc($type_result)) {
            $data_type[] = $data_row;
        }
    }else{
        echo "<script>alert('404 not found!');window.history.back()</script>";
    }
    
	
	require FRONT_VIEW_DIR .'/news.html';
?>
