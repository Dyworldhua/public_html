<?php
    session_start();
    $power = $_SESSION['power'];
    $pro_manage_power = in_array('4',$power);
    $pro_type_power = in_array('22',$power);
    if($pro_manage_power || $pro_type_power){
        $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
        $sql = "select * from pro_type";
        $result = $link->query($sql);
        //var_dump($result);
        $data = [];
        while($row = $result->fetch()){
            $data[] = $row;
        }
    }else{
        echo "<script>alert('对不起，您没有权限');window.history.back()</script>";
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
    <h2>产品类型</h2>
    <h3><a href="pro_type_add.html">添加类型</a></h3>
    <table border="1" cellspacing="0" cellpadding="0">
        <tr>
            <td>类型ID</td>
            <td>产品类型</td>
            <td>类型编辑</td>
        </tr>
        <?php foreach($data as $val){?>
        <tr>
            <td><?=$val['id']?></td>
            <td><?=$val['type']?></td>
            <td><a href="pro_type_edit.php?id=<?=$val['id']?>">编辑</a>|<a href="pro_type_delete.php?id=<?=$val['id']?>">删除</a></td>
        </tr>
        <?php }?>
    </table>
</body>
</html>