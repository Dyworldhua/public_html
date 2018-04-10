<?php
    session_start();
    $power = $_SESSION['power'];
    $infor_power = in_array("13",$power); // 查找权限组中是否有公司信息编辑权限
    $infor_manage_power = in_array("11",$power); // 查找权限组中是否有公司信息管理功能
    if($infor_manage_power || $infor_power){
        $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
        $sql = "select * from information";
        $result = $link->query($sql);
        $row = $result->fetch();
        $row['introduce'] = strip_tags($row['introduce']);
        $row['introduce'] = mb_substr($row['introduce'],0,10,"utf-8").'...';
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
                text-align:center;
            }
            table{
                margin:0 auto;
                text-align:center;
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
        <h2>公司信息列表</h2>
        <table border="1" cellspacing="0" cellpadding="0">
            <tr>
                <td>公司ID</td>
                <td>公司LOGO</td>
                <td>公司地址</td>
                <td>公司电话</td>
                <td>公司邮箱</td>
                <td>公司传真</td>
                <td>公司手机</td>
                <td>公司邮编</td>
                <td>公司介绍</td>
                <td>信息编辑</td>
            </tr>
            <tr>
                <td><?=$row['id']?></td>
                <td><img src="<?=$row['logo']?>" width="200px"/></td>
                <td><?=$row['address']?></td>
                <td><?=$row['telephone']?></td>
                <td><?=$row['email']?></td>
                <td><?=$row['fax']?></td>
                <td><?=$row['phone']?></td>
                <td><?=$row['post']?></td>
                <td><?=$row['introduce']?></td>      
                <td><a href="infor_edit.php">编辑</a></td>         
            </tr>
        </table>
    </body>
</html>