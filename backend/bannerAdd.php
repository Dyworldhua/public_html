<?php   
    session_start();
    $power = $_SESSION['power'];
    $banner_add_power = in_array("10",$power); //  查找权限组中是否有Banner添加权限
    $banner_manage_power = in_array("8",$power); // 查找权限组中是否有Banner管理权限，其中包括了Banner编辑，添加
    if($banner_add_power || $banner_manage_power){
        $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
        $sql = "select * from nav_list";
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
        <meta charset="UTF-8"/>
        <title></title>
        <style>
            h2{
                text-align: center;
                font-weight: normal;
            }
            input[type=file]{
                margin-left:500px;
                margin-top:20px;
            }
            input[type=submit]{
                border:1px solid #000;
                cursor:pointer;
                margin-left:540px;
                margin-top:30px;
            }
            select{
                margin-left:520px;
                border:1px solid #000;
            }
            option{
                border:1px solid #000;
            }
        </style>
    </head>
    <body>
        <h2>Banner图片添加</h2>
        <form action="banner_add.php" method="POST" enctype="multipart/form-data">
            <select name="type">
                <?php foreach($data as $val){?>
                <option value="<?=$val['id']?>"><?=$val['nav_name']?></option>
                <?php }?>
            </select>
            <p><input type="file" name="img"/></p>
            <br/>
            <input type="submit" value="添加"/>
        </form>
    </body>
</html>