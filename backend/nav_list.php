<?php
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $sql = "select * from nav_list";
    $result = $link->query($sql);
    $data = [];
    while($row = $result->fetch()){
        $data[] = $row;
    }
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
        h3{
            font-weight:normal;
            text-align:center;
        }
        table{
            margin:0 auto;
            text-align:center;
        }
        td{
            width:100px;
        }
        a{
            color:#000;
            text-decoration:none;
        }
        a:hover{
            color:red;
        }
    </style>
</head>
<body>
    <h2>导航栏列表</h2>
    <h3><a href="nav_add.html">添加导航栏</a></h3>
    <table border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td>ID</td>
            <td>导航栏</td>
            <td>编辑</td>
        </tr>
        <?php foreach($data as $val){?>
        <tr>
            <td><?=$val['id']?></td>
            <td><?=$val['nav_name']?></td>
            <td><a href="nav_edit.php?id=<?=$val['id']?>">编辑</a>|<a href="nav_delete.php?id=<?=$val['id']?>">删除</a></td>
        </tr>
        <?php }?>
    </table>
</body>
</html>