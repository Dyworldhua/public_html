<?php
    $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
    $sql = "select * from information";
    $result = $link->query($sql);
    $row = $result->fetch();
    //$row['introduce'] = mb_substr($row['introduce'],0,10,"utf-8").'...';
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
            input[type=text]{
                border:1px solid #000;
                width:300px;
            }
            input[type=submit]{
                border:1px solid #000;
                margin-top:30px;
                cursor:pointer;
                margin-left:530px;
            }
        </style>
        <script type="text/javascript" src="../plugins/jquery-1.11.3.js"></script>
        <script type="text/javascript" charset="utf-8" src="../plugins/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="../plugins/ueditor.all.min.js"></script>
    </head>
    <body>
        <h2>公司信息编辑</h2>
        <form action="infor_update.php" method="post" enctype="multipart/form-data">
            <p>公司LOGO：<img src="<?=$row['logo']?>"/><input type="file" name="logo"/></p>
            <p>公司地址：<input type="text" name="address" value="<?=$row['address']?>"/></p>
            <p>公司电话：<input type="text" name="telephone" value="<?=$row['telephone']?>"/></p>
            <p>公司邮箱：<input type="text" name="email" value="<?=$row['email']?>"/></p>
            <p>公司传真：<input type="text" name="fax" value="<?=$row['fax']?>"/></p>
            <p>公司手机：<input type="text" name="phone" value="<?=$row['phone']?>"/></p>
            <p>公司邮编：<input type="text" name="post" value="<?=$row['post']?>"/></p>
            <p>公司介绍：</p>
            <textarea name="introduce" id="editor"><?=$row['introduce']?></textarea>
            <input type="submit" value="提交"/>
        </form>
    </body>
    <script type="text/javascript">
	    var ue = UE.getEditor('editor');
    </script>
</html>