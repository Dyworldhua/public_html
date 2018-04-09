<?php
    $id = $_GET['id'];
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $sql = "select * from banner_list where id = '$id'";
    $result = $link->query($sql);
    $row = $result->fetch();

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title></title>
        <style>
            h2{
                text-align:center;
                font-weight:normal;
            }
            img{
                margin-left:318px;
            }
            input[type=file]{
                margin-left:490px;
                margin-top:30px;
            }
            input[type=submit]{
                margin-left:530px;
                border:1px solid #000;
                cursor:pointer;
            }
            div{
                margin-left:530px;
                margin-bottom:30px;
            }
            select{
                border:1px solid #000;
            }
        </style>
    </head>
    <body>
        <h2>Banner编辑</h2>
        
        <img src="<?=$row['img_src']?>" width="480px" height="150px"/>
        <form action="banner_update.php" method="POST" enctype="multipart/form-data">
            <p><input type="file" name="img"/></p>
            <p><input type="submit" value="提交"/></p>
            <input type="hidden" value="<?=$row['id']?>" name="id"/>
        </form>
    </body>
</html>