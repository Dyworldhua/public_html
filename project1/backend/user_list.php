<?php
    session_start();
    $power = $_SESSION['power'];
    $user_list_power = in_array("19",$power);
    $user_manage_power = in_array("17",$power);
    if($user_list_power || $user_manage_power){
        $link = mysqli_connect('localhost','root','','project');
        mysqli_query($link,"set names utf8");
        $sql = "select * from user order by id desc";
        $result = mysqli_query($link,$sql);
        $data = [];
        while($row = mysqli_fetch_assoc($result)){
            $power_id = $row['power'];
            $sql_group_name = "select * from power_group where id = '$power_id'"; //查找出权限组表中id值与用户表中权限组ID相同的数据
            //var_dump($sql_group_name);
            $group_result = mysqli_query($link,$sql_group_name);
            //var_dump($group_result);
            $group_data = mysqli_fetch_assoc($group_result);
            $row['power'] = $group_data['group_name']; // 取出ID值相同的组名作为当前权限组名
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
        <style>
            h2{
                font-weight:normal;
                text-align:center;
            }
            table{
                margin:10px auto;
            }
            td{
                width:200px;
                height:40px;
                text-align:center;
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
        <h2>后台用户管理列表</h2>
        <table cellspacing="0" cellpadding="0" border="1">
            <tr>
                <td>用户ID</td>
                <td>用户名</td>
                <td>昵称</td>
                <td>性别</td>
                <td>邮箱</td>
                <td>权限组</td>
                <td>注册时间</td>
                <td>用户操作</td>
            </tr>
            <?php foreach($data as $value){?>
            <tr>
                <td><?=$value['id']?></td>
                <td><?=$value['username']?></td>
                <td><?=$value['nickname']?></td>
                <td><?=$value['sex']?></td>
                <td><?=$value['email']?></td>
                <td><?=$value['power']?></td>
                <td><?=$value['ctime']?></td>
                <td><a href="user_edit.php?id=<?=$value['id']?>">编辑</a>|<a href="user_delete.php?id=<?=$value['id']?>">删除</a></td>
            </tr>
            <?php }?>
        </table>
    </body>
</html>