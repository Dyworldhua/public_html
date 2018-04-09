<?php 
    // 退出登录
    session_start(); 
    session_destroy(); // 关闭SESSION即可退出登录 
    echo "<script>alert('退出成功！');location.href='login.html'</script>";
?>