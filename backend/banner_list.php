<?php
    session_start();
    $power = $_SESSION['power'];
    $banner_list_power = in_array("9",$power); //  查找权限组中是否有Banner编辑权限
    $banner_manage_power = in_array("8",$power); // 查找权限组中是否有Banner管理权限，其中包括了Banner编辑，添加
    if($banner_list_power || $banner_manage_power){
        $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
        $sql = "select * from banner_list";
        $result = $link->query($sql);
        $data = [];
        while($row = $result->fetch()) {
            if($row['type_id']==1){
                $row['type_id'] = '首页';
            }elseif($row['type_id']==2){
                $row['type_id'] = '公司介绍';
            }elseif($row['type_id']==3){
                $row['type_id'] = '产品中心';
            }elseif($row['type_id']==4){
                $row['type_id'] = '新闻中心';
            }else{
                $row['type_id'] = '联系我们';
            }
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
        <title></title>
        <style>
            h2{
                font-weight:normal;
                text-align:center;
            }
            table{
                margin:20px auto;
                text-align:center;
            }
            a{
              text-decoration:none;
              color:black;  
            }
            a:hover{
                color:red;
            }
        </style>
    </head>
    <body>
        <h2>Banner广告管理列表</h2>
        <table border="1" cellspacing="0" cellpadding="0">
            <tr>
                <td>BannerID</td>
                <td>Banner区域</td>
                <td>Banner图</td>
                <td>操作</td>
            </tr>
            <?php foreach($data as $val){?>
            <tr>
                <td><?=$val['id']?></td>
                <td><?=$val['type_id']?></td>
                <td style="width:500px;height:200px;"><img src="<?=$val['img_src']?>" width="480px" height="150px"/></td>
                <td><a href="banner_edit.php?id=<?=$val['id']?>">编辑</a>|<a href="banner_delete.php?id=<?=$val['id']?>">删除</a></td>
            </tr>    
            <?php }?>
        </table>
    </body>
</html>