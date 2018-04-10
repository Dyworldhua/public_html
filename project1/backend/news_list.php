<?php
    session_start();
    $power = $_SESSION['power'];
    $news_list_power = in_array("2",$power); // 查找权限数组中是否有新闻编辑权限
    $news_manage_power = in_array("1",$power);// 查找权限数组中是否有新闻管理功能，有管理功能就直接包括了编辑、添加功能
    if($news_list_power || $news_manage_power){
        $link = mysqli_connect('localhost','root','','project');
        mysqli_query($link,"set names utf8");
        // 分页
        $all = mysqli_num_rows(mysqli_query($link,"select * from news_list"));
        $page_max = ceil($all/3); 
        $current_page = isset($_GET['page'])?$_GET['page']:1;
        $offset = ($current_page-1)*3;
        $sql = "select * from news_list order by date desc limit $offset,3";
        $result = mysqli_query($link,$sql);
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $row['date'] = date('Y-m-d',strtotime($row['date']));
            $row['content'] = mb_substr($row['note'],0,10,"utf-8").'...';
            $id = $row['type_id']; // 获取新闻类型的ID
            $type = "select * from news_type where id = '$id'";  // 查找当前新闻类型
            $resultType = mysqli_query($link,$type);
            $typeInfo = mysqli_fetch_assoc($resultType);
            $row['type_id'] = $typeInfo['title']; // 获取当前类型名称
            $data[] = $row;
        }
        //var_dump($data);
    }else{
        echo "<script>alert('对不起，您没有权限');window.history.back()</script>";
    }
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title></title>
        <style>
            h2{
                font-weight:normal;
                text-align:center;
            }
            table{
                margin-left:20px;
            }
            td{
                width:300px;
                height:54px;
                text-align:center;
            }
            td a{
                color:#000;
                text-decoration:none;
            }
            td a:hover{
                color:#f00;
            }
            .add{
                display:inline-block;
                width:100px;
                height:40px;
                line-height:40px;
                border:1px solid #000;
                text-align:center;
                text-decoration:none;
                color:#000;
                margin-left:514px;
                margin-bottom:30px;
            }
            .add:hover{
                font-weight:bold;
            }
            ul{
                list-style:none;
                margin-left:440px;
            }
            ul li{
                float:left;
                margin-right:10px;
            }
            ul li a{
                color:#000;
                text-decoration:none;
            }
            ul li.current a{
                color:red;
            }
        </style>
    </head>
    <body>
        <h2>新闻列表</h2>
        <table border="1" cellspacing="0" cellpadding="0">
            <tr>
                <td>新闻时间</td>
                <td>新闻类型</td>
                <td>新闻标题</td>
                <td>新闻图片</td>
                <td>新闻内容</td>
                <td>新闻编辑</td>
            </tr>
            <?php foreach ($data as $val) { ?>
            <tr>
                <td><?= $val['date']?></td>
                <td><?= $val['type_id']?></td>
                <td><?= $val['title']?></td>
                <td><img src="<?=$val['img_src']?>" width=100px height=100px/></td>
                <td><?= $val['content']?></td>
                <td><a href="news_edit.php?id=<?= $val['id']?>" target="main">编辑</a>|<a href="news_delete.php?id=<?=$val['id']?>">删除</a></td>
            </tr>
            <?php } ?>
        </table>
        <div>
            <ul>
                <li><a href="news_list.php?page=<?php if($current_page-1>0){echo $current_page-1;}else{echo 1;}?>">上一页</a></li>
                <?php for($i=1;$i<=$page_max;$i++){ ?> 
                <li class="<?php if($current_page == $i){echo 'current';}?>"><a href="news_list.php?page=<?=$i?>"><?=$i?></a></li>
                <?php } ?>
                <li><a href="news_list.php?page=<?php if($current_page+1<=$page_max){echo $current_page+1;}else{echo $page_max;}?>">下一页</a></li>  
            </ul>  
        </div>
    </body>
</html>