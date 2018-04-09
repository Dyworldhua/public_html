<?php
    $id = $_GET['id'];
    $link = mysqli_connect('localhost','root','','project');
    mysqli_query($link,"set names utf8");
    $sql = "select * from news_list where id = '$id'";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    $row['date'] = date('Y-m-d',strtotime($row['date']));

    $sql_type = "select * from news_type";
    $result_type = mysqli_query($link,$sql_type);
    $data = [];
    while($val = mysqli_fetch_assoc($result_type)){
        $data[] = $val;
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title></title>
        <script type="text/javascript" src="../plugins/jquery-1.11.3.js"></script>
        <script type="text/javascript" charset="utf-8" src="../plugins/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="../plugins/ueditor.all.min.js"></script>
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
                width:300px;
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
            input[type=file]{
                border:none;
            }
            input[type=reset]{
                cursor:pointer;
            }
            .editor{
                width:400px;
                height:500px;
            }
        </style>
    </head>
    <body>
        <form action="newsEdit.php" method="POST" enctype="multipart/form-data">
            <p>新闻标题：</span><input type="text" name="title" value="<?= $row['title']?>"/></p>
            <p>日 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;期：<input type="date" name="date" value="<?= $row['date']?>"/></p>
            <p>
                新闻类型：
                <select name="type">
                    <?php foreach($data as $value){?>
                    <option value="<?=$value['id']?>" <?php if($row['type_id']==$value['id']){echo "selected = 'selected'";}?>><?=$value['title']?></option>
                    <?php }?>
                </select>
            </p>
            <p>新闻摘要：</p>
            <textarea name="note" class="note"><?=$row['note']?></textarea>
            <div class="div1">
                <p>新闻内容：</p>
                <textarea name="content" id="editor" class="editor"><?= $row['content']?></textarea>
            </div>
            <p>新闻图片：<input type="file" name="img"/><img src="<?=$row['img_src']?>" width="100px" height="100px"/></p>
            <input type="hidden" name="id" value="<?= $row['id']?>"/>
            <input type="submit" value="提交"/>
            <input type="reset"/>
        </form>
    </body>
    <script type="text/javascript">
	    var ue = UE.getEditor('editor');
    </script>
</html>