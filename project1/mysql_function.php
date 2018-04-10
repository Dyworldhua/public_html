<?php
    // 链接数据库
    $config = ['host'=>'localhost','username'=>'root','pwd'=>'','dbname'=>'project'];
    function conn($config){
        $db_link = mysqli_connect($config['host'],$config['username'],$config['pwd'],$config['dbname']);
        mysqli_query($db_link,"set names utf8");
        return $db_link;
    }