<?php
    session_start();
    $power = $_SESSION['power'];
    $pro_list_power = in_array("5",$power); // 查找权限数组中是否有产品编辑功能
    $pro_manage_power = in_array("4",$power);// 查找权限数组中是否有产品管理功能，有管理功能就直接包括了编辑、添加功能
    if($pro_list_power || $pro_manage_power){
        $link = mysqli_connect('localhost','root','','project');
        mysqli_query($link,"set names utf8");
        $current_page = isset($_GET['page'])?$_GET['page']:1;
        $offset = ($current_page-1)*12;
        $all = mysqli_num_rows(mysqli_query($link,"select * from pro_list"));
        $page_max = ceil($all/12);
        $sql = "select * from pro_list order by ctime desc limit $offset,12";
        $result = mysqli_query($link,$sql);
        $data = [];
        while($row = mysqli_fetch_assoc($result)){
            if($row['type']==1){
                $row['type'] = '中央前置';
            }elseif($row['type']==2){
                $row['type'] = '管机线';
            }elseif($row['type']==3){
                $row['type'] = '超漏RO';
            }elseif($row['type']==4){
                $row['type'] = '茶吧机';
            }elseif($row['type']==5){
                $row['type'] = '中净中饮';
            }else{
                $row['type'] = '饮水台';
            }
            $row['content'] = strip_tags($row['content']);
            $row['content'] = mb_substr($row['content'],0,10,"utf-8").'...';
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
            ul{
                list-style:none;
				margin-left:480px;
				margin-top:50px;
            }
            li{
                float:left;
				margin-left:10px;
            }
            ul li.current a{
                color:red;
            }
        </style>
    </head>
    <body>
        <h2>产品中心列表</h2>
        <table cellspacing="0" cellpadding="0" border="1">
            <tr>
                <td>产品ID</td>
                <td>产品名称</td>
                <td>产品分类</td>
                <td>产品图片</td>
                <td>产品内容</td>
                <td>添加时间</td>
                <td>添加人员</td>
                <td>操作</td>
            </tr>
            <?php foreach($data as $val){ ?>
            <tr>
                <td><?=$val['id']?></td>
                <td><?=$val['name']?></td>
                <td><?=$val['type']?></td>
                <td><img src="<?=$val['img_src']?>" width="100px" height="100px"/></td>
                <td><?=$val['content']?></td>
                <td><?=$val['ctime']?></td>
                <td><?=$val['person']?></td>
                <td><a href="pro_edit.php?id=<?=$val['id']?>">编辑</a>|<a href="pro_delete.php?id=<?=$val['id']?>">删除</a></td>
            </tr>
            <?php } ?>
        </table>
        <ul>
            <li><a href="pro_list.php?page=<?php if($current_page-1>=1){echo $current_page-1;}else{echo 1;}?>">上一页</a></li>
            <?php for($i=1;$i<=$page_max;$i++){ ?>
            <li class="<?php if($current_page == $i){echo 'current';}?>"><a href="pro_list.php?page=<?=$i?>"><?=$i?></a></li>
            <?php }?>
            <li><a href="pro_list.php?page=<?php if($current_page+1<=$page_max){echo $current_page+1;}else{echo $page_max;}?>">下一页</a></li>
        </ul>
    </body>
</html>