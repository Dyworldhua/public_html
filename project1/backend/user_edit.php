<?php
    $id = $_GET['id'];
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $sql = "select * from user where id = '$id'";
    $result = $link->query($sql);
    $row = $result->fetch();

    //  权限组遍历
    $sql_group = "select * from power_group";
    $group_result = $link->query($sql_group); //取出权限组数据
    $data = [];
    while($group_row = $group_result->fetch()) {
        $data[] = $group_row;
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
            p{
                text-align: center;
                font-size:18px;
            }
            input[type=text]{
                border:1px solid #000;
                width:200px;
                height:20px;
                padding-left:5px;
            }
            input[type=password]{
                border:1px solid #000;
                width:200px;
                height:20px;
                padding-left:5px;
            }
            select{
                border: 1px solid #000;
            }
            input[type=submit]{
                font-size:18px;
                height:30px;
                cursor:pointer;
            }
        </style>
    </head>
    <body>
        <h2>用户编辑</h2>
        <h2>更新管理员</h2>
        <form action="user_update.php" method="POST">
            <p>用户名：<?=$row['username']?></p>
            <p>密&nbsp;&nbsp;&nbsp;码：<input type="password" name="pwd" value="<?=$row['password']?>"/></p>
            <p>昵&nbsp;&nbsp;&nbsp;称：<input type="text" name="nickname" value="<?=$row['nickname']?>"/></p>
            <p>性别：<input type="radio" name="sex" value="男" <?php if($row['sex'] == '男'){echo "checked = 'checked'";}?>/>男<input type="radio" name="sex" value="女" <?php if($row['sex'] == '女'){echo "checked = 'checked'";}?>/>女</p>
            <p>邮&nbsp;&nbsp;&nbsp;箱：<input type="text" name="email" value="<?=$row['email']?>"/></p>
            <input type="hidden" value="<?=$row['id']?>" name="id"/>
            <p>权限组：
                <select name="power">
                    <?php foreach($data as $val){?>
                    <option value="<?=$val['id']?>" <?php if($row['power'] == $val['id']){echo "selected = 'selected'";}?>><?=$val['group_name']?></option>
                    <?php }?>
                </select>
            </p>
            <p><input type="submit" value="更新管理员"/></p>
        </form>
    </body>
</html>