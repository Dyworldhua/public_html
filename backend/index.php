<?php
    session_start();
    if(empty($_SESSION['username'])){
        echo "<script>alert('请先登录');location.href='login.html'</script>";
    }

    
    $username = $_SESSION['username']; // 获取用户名
    // var_dump($username);
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root',''); // 链接数据库
    $sql = "select * from user where username = '$username'"; // 取出当前用户的权限组
    $result = $link->query($sql);
    $row = $result->fetch();
    $power_group = $row['power']; // 取出权限组ID

    $sql_power = "select * from power_group where id = $power_group"; // 根据权限组ID查找出当前权限组
    $power_result = $link->query($sql_power);
    $row_power = $power_result->fetch();// 取出该权限组的权限
    $power_list = json_decode($row_power['group_id']); // 用json_decode将其转化为数组格式
    $_SESSION['power'] = $power_list; // 将拥有的权限存进session
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>后台管理</title>
        <link rel="stylesheet" type="text/css" href="index.css"/>
    </head>
    <body>
        <div class="top">
            <div class="logo">
                <a href="index.html"><img src="../images/logo.png"/></a>
            </div>
            <div class="backend">
                <a href="###"><?=$username?></a>
                <a href="out.php">退出</a>  
            </div>
        </div>
        <div class="title">
            <p>后台管理系统</p>
        </div>
        <div class="down">
            <div class="nav">
                <dl>
                    <dt>新闻管理</dt>
                    <dd><a href="news_list.php" target="main">新闻列表</a></dd>
                    <dd><a href="newsAdd.php" target="main">添加新闻</a></dd>
                    <dd><a href="news_type_list.php" target="main">新闻类型</a></dd>
                </dl>
                <dl>
                    <dt>产品中心</dt>
                    <dd><a href="pro_list.php" target="main">产品列表</a></dd>
                    <dd><a href="proAdd.php" target="main">添加产品</a></dd>
                    <dd><a href="pro_type_list.php" target="main">产品类型</a></dd>
                </dl>
                <dl>
                    <dt>留言管理</dt>
                    <dd><a href="comment.php" target="main">留言列表</a></dd>
                </dl>
                <dl>
                    <dt>Banner管理</dt>
                    <dd><a href="banner_list.php" target="main">Banner列表</a></dd>
                    <dd><a href="bannerAdd.php" target="main">添加Banner</a></dd>
                </dl>
                <dl>
                    <dt>公司信息管理</dt>
                    <dd><a href="information.php" target="main">公司信息列表</a></dd>
                    <dd><a href="nav_list.php" target="main">公司导航栏</a></dd>
                </dl>
                <dl>
                    <dt>权限管理</dt>
                    <dd><a href="power_list.php" target="main">权限列表</a></dd>
                    <dd><a href="power_add.php" target="main">添加权限</a></dd>
                </dl>
                <dl>
                    <dt>用户管理</dt>
                    <dd><a href="user_list.php" target="main">管理员列表</a></dd>
                    <dd><a href="user_add.html.php" target="main">添加管理员</a></dd>
                </dl>
            </div>
            <div class="content">
                <iframe name="main" frameborder="0" scrolling="auto" src="back_content.php">
                </iframe>
            </div>
        </div>
    </body>
</html>