<?php
    session_start();
    $power = $_SESSION['power'];
    $power_add = in_array("16",$power);
    $power_manage = in_array("14",$power);
    if($power_add || $power_manage){
        $link = new PDO('mysql:host=localhost;dbname=project;charset=utf8','root','');
        $sql = "select * from power_list";
        $result = $link->query($sql);
        $data = [];
        while($row = $result->fetch()){
            $data[] = $row;
        }
        $parent_data = [];
        foreach($data as $value){
            if($value['power_id'] == 0){
                $parent_data[$value['id']] = $value;
                $parent_data[$value['id']]['sub'] = [];
            }
        }
        foreach($data as $son){
            if (isset($parent_data[$son['power_id']])) {
                $parent_data[$son['power_id']]['sub'][] = $son;
            }
        }
    }else{
        echo "<script>alert('对不起，您没有权限');window.history.back()</script>";
    }

    //var_dump($parent_data);
    //$data['power_id'] == 0
    //var_dump($data);
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <style>
            div{
                width:100%;
                height:30px;
                line-height:30px;
                background:rgb(136, 133, 133);
            }
            div p{
                margin-left:10px;
            }
            input[type=text]{
                border:1px solid #000;
                width:200px;
            }
            input[type=submit]{
                background:none;
                border:1px solid #000;
                cursor:pointer;
            }
            h3{
                font-weight:normal;
            }
            form{
                margin-left: 10px;
            }
        </style>
    </head>
    <body>
        <div>
            <p>》添加权限组</p>
        </div>
        <form action="powerAdd.php" method="post">
            <p>权限组名称：<input type="text" name="group_name"/></p>
            <?php   foreach($parent_data as $key=>$val){?>
            <p><input type="checkbox" name="cid[]" value="<?=$val['id']?>"/><?=$val['power_name']?></p>
            <?php foreach($val['sub'] as $key1=>$val1){?>
                <input type="checkbox" name="cid[]" value="<?=$val1['id']?>"/><?=$val1['power_name']?>
            <?php } ?>
            
            <?php }?>
            <br/>
            <input type="submit" value="添加权限"/>
        </form>
    </body>
</html>