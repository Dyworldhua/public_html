<?php
    require 'mysql_function.php';
    require 'base.php';
    // 封装函数链接数据库
    $link = conn($config);

    //Banner
    $_GET['id'] = isset($_GET['id'])?$_GET['id']:3;
    $banner_id = $_GET['id'];
    //var_dump($banner_id);
    if(!empty($banner_id)){
        $sql_banner = "select * from banner_list where type_id = $banner_id";
        $banner_result = mysqli_query($link,$sql_banner);
        $data_banner = mysqli_fetch_assoc($banner_result);

        $sql = "select * from pro_list";
        $result = mysqli_query($link,$sql);
        $data = [];
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }


        $type_sql = "select * from pro_type";
        $res_type = mysqli_query($link,$type_sql);
        $data_type = [];
        while($row_type = mysqli_fetch_assoc($res_type)){
            $data_type[] = $row_type;
        }

        // 分类查询
        $_GET['pro'] = isset($_GET['pro'])?$_GET['pro']:1;
        $type_id = $_GET['pro'];
        // var_dump($type_id);
        $pro_num = "select type,count(type) as num from pro_list where type = '$type_id' group by type";
        $num_re = mysqli_query($link,$pro_num);
        $num = mysqli_fetch_assoc($num_re);
        $pro_max = ceil($num['num']/6);
        
        // 分页显示
        $current_page = isset($_GET['page'])?$_GET['page']:1;
        $offset = ($current_page-1)*6;
        $pro_sql = "select * from pro_list where type = '$type_id' order by ctime desc limit $offset,6";
        $pro_result = mysqli_query($link,$pro_sql);
        $pro_data = [];
        while($pro_row = mysqli_fetch_assoc($pro_result)){
            $pro_data[] = $pro_row;
        }
    }else{
        echo "<script>alert('404 not found');window.history.back()</script>";
    }

    require FRONT_VIEW_DIR .'/product.html';
