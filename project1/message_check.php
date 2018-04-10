<?php
    $id = $_GET['id'];
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $sql = "select * from message where id = '$id'";
    $result = $link->query($sql);
    $row = $result->fetch();
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title></title>
        <style>
            *{
                margin:0;
            }
            h2{
                margin-top:30px;
                font-weight:normal;
                text-align:center;
            }
            
            p{
                float:left;
                margin-top:50px;
                margin-left:400px;
                margin-bottom:20px;
                padding:0;
                
            }
            span{
                float:left;
                margin-top:50px;
                margin-left:30px;
                
            }
            ul{
                list-style:none;
                margin:10px auto;
            }
            li{
                overflow:hidden;
            }
        </style>
    </head>
    <body>
        <h2>用户留言信息</h2>
        <div>
            <ul>
                <li><p>用户姓名：</p><span><?=$row['name']?></span></li>
                <li><p>用户邮箱：</p><span><?=$row['email']?></span></li>
                <li><p>用户电话：</p><span><?=$row['phone']?></span></li>
                <li><p>留言内容：</p><span><?=$row['content']?></span></li>
            </ul>
        </div>
    </body>
</html>