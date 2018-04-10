<?php
    $id = $_GET['id'];
    $link = mysqli_connect('localhost','root','','project');
    mysqli_query($link,"set names utf8");
    $sql = "select * from news_list where id = '$id'";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);
    $row['date'] = date('Y-m-d',strtotime($row['date']));
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title></title>
    </head>
    <body>
        <form action="#" method="POST">
            <span>新闻标题：</span><input type="text" name="title" value="$row['title']"/><br/>
            <span>日 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;期：</span><input type="date" name="date" value="$row['date']"/><br/>
            <span>新闻类型：</span><input type="radio"/>公司新闻<input type="radio"/>行业新闻
            <div class="div1">
                <span>新闻内容：</span><textarea name="content">$row['content']</textarea>
            </div>
            <input type="submit"/>
            <input type="reset"/>
        </form>
    </body>
</html>