<?php   
    session_start();
    $power = $_SESSION['power'];
    $comment_power = in_array("12",$power); // 查找权限数组中是否有留言管理功能
    $comment_manage_power = in_array("7",$power);
    if($comment_manage_power || $comment_power){
        $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
        $sql = "select * from message order by id desc";
        $result = $link->query($sql);
        $data = [];
        while($row = $result->fetch()){
            $row['content'] = mb_substr($row['content'],0,5,"utf-8").'...';
            $data[] = $row;
        }
    }else{
        echo "<script>alert('对不起，您没有权限');window.history.back()</script>";
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title></title>
        <style>
            h2{
                font-weight:normal;
                text-align:center;
            }
            table{
                margin:10px auto;
                text-align:center;
            }
            td{
                width:200px;
            }
            a{
                text-decoration:none;
                color:black;
            }
            a:hover{
                color:red;
            }
        </style>
    </head>
    <body>
        <h2>留言管理列表</h2>
        <table border="1" cellspacing="0" cellpadding="0">
            <tr>
                <td>用户ID</td>
                <td>用户姓名</td>
                <td>用户邮箱</td>
                <td>用户电话</td>
                <td>留言内容</td>
                <td>留言编辑</td>
            </tr>
            <?php foreach($data as $val){ ?>
            <tr>
                <td><?=$val['id']?></td>
                <td><?=$val['name']?></td>
                <td><?=$val['email']?></td>
                <td><?=$val['phone']?></td>
                <td><?=$val['content']?></td>
                <td><a href="../message_check.php?id=<?=$val['id']?>">查看</a>|<a href="../message_delete.php?id=<?=$val['id']?>">删除</a></td>
            </tr>
            <?php }?>
        </table>
    </body>
</html>