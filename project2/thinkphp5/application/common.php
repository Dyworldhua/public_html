<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
    // 封装验证失败时URL返回
    function Alert($str,$url=''){
        if($url == '-1'){
            echo "<script>alert(\"$str\");window.history.back()</script>";
        }else{
            echo "<script>alert(\"$str\");location.href='$url'</script>";
        }
    }