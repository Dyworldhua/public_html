<?php
    $id = $_GET['id'];
     $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
     $sql = "select * from news_type where id = '$id'";
     $result = $link->query($sql);
     $row = $result->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        h2{
            font-weight:normal;
            text-align:center;
        }
        input[type=text]{
            border:1px solid #000;
            width:200px;
        }
        input[type=submit]{
            margin-left:142px;
            cursor:pointer;
        }
        form{
            margin-left:400px;
        }    
    </style>
</head>
<body>
    <h2>修改类型</h2>
    <form action="news_type_update.php" method="post">
        <p>新闻类型：<input type="text" name="type" value="<?=$row['title']?>"/></p>
        <input type="hidden" name="id" value="<?=$row['id']?>"/>
        <input type="submit" value="修改"/>
    </form>
</body>
</html>