<?php 
    $id = $_GET['id'];
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

    $sql_power = "select * from power_group where id = '$id'";
    $power_result = $link->query($sql_power);
    $power_json = $power_result->fetch();
    $power = json_decode($power_json['group_id']);
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
            <p>》修改权限组</p>
        </div>
        <form action="power_update.php" method="post">
            <p>权限组名称：<input type="text" name="group_name" value="<?=$power_json['group_name']?>"/></p>
            <?php   foreach($parent_data as $key=>$val){?>
            <p><input type="checkbox" name="cid[]" value="<?=$val['id']?>" <?php if(in_array($val['id'],$power)){echo "checked='checked'";}?>/><?=$val['power_name']?></p>
            <?php foreach($val['sub'] as $key1=>$val1){?>
                <input type="checkbox" name="cid[]" value="<?=$val1['id']?>" <?php if(in_array($val1['id'],$power)){echo "checked='checked'";}?>/><?=$val1['power_name']?>
            <?php } ?>
            
            <?php }?>
            <br/>
            <input type="hidden" name="id" value="<?=$power_json['id']?>"/>
            <input type="submit" value="修改权限"/>
        </form>
    </body>
</html>