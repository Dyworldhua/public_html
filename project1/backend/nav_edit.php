<?php
    $id = $_GET['id'];
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $sql = "select * from nav_list where id = '$id'";
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
    <h2>导航栏添加</h2>
    <form action="nav_update.php" method="POST">
        <p>添加导航栏：<input type="text" name="nav" value="<?=$row['nav_name']?>"/></p>
        <input type="hidden" name="id" value="<?=$row['id']?>"/>
        <input type="submit" value="更改"/>
    </form>
</body>
</html>