<?php
    session_start();
    $power = $_SESSION['power'];
    $user_add_power = in_array("19",$power);
    $user_manage_power = in_array("17",$power);
    if($user_add_power || $user_manage_power){
        $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
        $sql = "select * from power_group";
        $result = $link->query($sql);
        $data = [];
        while($row = $result->fetch()){
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
        <h2>添加管理员</h2>
        <form action="user_add.php" method="POST">
            <p>用户名：<input type="text" name="username"/></p>
            <p>密&nbsp;&nbsp;&nbsp;码：<input type="password" name="pwd"/></p>
            <p>昵&nbsp;&nbsp;&nbsp;称：<input type="text" name="nickname"/></p>
            <p>性别：<input type="radio" name="sex" value="男"/>男<input type="radio" name="sex" value="女"/>女</p>
            <p>邮&nbsp;&nbsp;&nbsp;箱：<input type="text" name="email"/></p>
            <p>权限组：
                <select name="power">
                    <?php foreach($data as $val){?>
                    <option value="<?=$val['id']?>"><?=$val['group_name']?></option>
                    <?php }?>
                </select>
            </p>
            <p><input type="submit" value="添加管理员"/></p>
        </form>
    </body>
</html>