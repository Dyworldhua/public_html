<?php
    session_start();
    $power = $_SESSION['power'];
    $power_list = in_array("15",$power);
    $power_manage = in_array("14",$power);
    if($power_list || $power_manage){
        $link = mysqli_connect('localhost','root','','project');
        mysqli_query($link,"set names utf8");
        $sql = "select * from power_group";
        $result = mysqli_query($link,$sql);
        $data = [];
        while($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
    }else{
        echo "<script>alert('对不起，您没有权限');window.history.back()</script>";
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title></title>
        <style>
            h2{
                font-weight:normal;
                text-align: center;
            }
            table{
                margin:20px auto;
                text-align:center;
            }
            td{
                width:100px;
            }
            a{
                text-decoration:none;
                color:#000;
            }
            a:hover{
                color:red;
            }
        </style>
    </head>
    <body>
        <h2>权限组列表</h2>
        <table border="1" cellspacing="0" cellpadding="0">
            <tr>
                <td>权限ID</td>
                <td>权限组名称</td>
                <td>权限操作</td>
            </tr>
            <?php foreach($data as $val){?>
            <tr>
                <td><?=$val['id']?></td>
                <td><?=$val['group_name']?></td>
                <td><a href="power_edit.php?id=<?=$val['id']?>">编辑</a>|<a href="power_delete.php?id=<?=$val['id']?>">删除</a></td>
            </tr>
            <?php }?>
        </table>
    </body>
</html>
