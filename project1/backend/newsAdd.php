<?php
    session_start();
    $power = $_SESSION['power'];
    $news_add_power = in_array("3",$power); // 查找权限数组中是否有新闻添加权限
    $news_manage_power = in_array("1",$power);// 查找权限数组中是否有新闻管理功能，有管理功能就直接包括了编辑、添加功能
    if($news_add_power || $news_manage_power){
        $link = mysqli_connect('localhost','root','','project');
        mysqli_query($link,"set names utf8");
        $sql = "select * from news_type";
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
            form{
                margin-left:300px;
            }
            p{
                margin-top:20px;
            }
            input{
                border:1px solid #000;
            }
            input[type=text]{
                width:300px;
                padding-left:8px;
            }
            .note {
                width:500px;
                height:100px;
                border:1px solid #000;
                resize:none;
                padding-left:5px;
                font-size:14px;
            }
            .div1{
                overflow:hidden;
            }
            .div1 span{
                float:left;
            }
            .div1 textarea{
                float:left;
                height:400px;
                border:1px solid #000;
                padding-left:8px;
                padding-top:5px;
            }
            input[type=submit]{
                margin-top:30px;
                margin-left:140px;
                margin-right:50px;
                cursor:pointer;
            }
            input[type=reset]{
                cursor:pointer;
            }
            input[type=file]{
                border:none;
            }
        </style>
        <script type="text/javascript" src="../plugins/jquery-1.11.3.js"></script>
        <script type="text/javascript" charset="utf-8" src="../plugins/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="../plugins/ueditor.all.min.js"></script>
    </head>
    <body>
        <form action="news_add.php" method="POST" enctype="multipart/form-data">
            <p>新闻标题：</span><input type="text" name="title"/></p>
            <p>日 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;期：<input type="date" name="date"/></p>
            <p>
                新闻类型：
                <select name="type">
                    <?php foreach($data as $val){?>
                        <option value="<?=$val['id']?>"><?=$val['title']?></option>
                    <?php }?>
                </select>
            </p>
            <p>新闻摘要：</p>
            <textarea name="note" class="note"></textarea>
            <div class="div1">
                <p>新闻内容：</p>
                <textarea name="content" id="editor"></textarea>
            </div>
            <p>新闻图片：<input type="file" name="img"/></p>
            <input type="hidden" name="id"/>
            <input type="submit" value="提交"/>
            <input type="reset"/>
        </form>
    </body>
    <script type="text/javascript">
	    var ue = UE.getEditor('editor');
    </script>
</html>