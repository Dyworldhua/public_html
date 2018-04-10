<?php

// 常用的设置
define ('DIR_SEPARATE', '/');

define ('IMG_DIR', 'backend');

define ('FRONT_VIEW_DIR', 'front/view');

    // Banner信息
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $sql = "select * from nav_list";
        $result = $link->query($sql);
        $nav = [];
        while($row = $result->fetch()){
            $nav[] = $row;
        }
    
    // 公司信息
    $infor_sql = "select * from information";
    $infor_result = $link->query($infor_sql);
    $infor_val = $infor_result->fetch();    



