<?php
    $id = $_GET['id'];
    $link = mysqli_connect('localhost','root','','project');
    mysqli_query($link,"set names utf8");
    $sql = "select * from pro_list where id = '$id'";
    $result = mysqli_query($link,$sql);
    $row = mysqli_fetch_assoc($result);

    $sql_type = "select * from pro_type";
    $type_result = mysqli_query($link,$sql_type);
    $data = [];
    while($value = mysqli_fetch_assoc($type_result)){
        $data[] = $value;
    }

    $sql_del = "select * from pro_del where pro_id = '$id'";
    $del_result = mysqli_query($link,$sql_del);
    $value = mysqli_fetch_assoc($del_result);

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <style>
            h2{
                font-weight:normal;
                text-align: center;
            }
            .content{
                width:400px;
                height:400px;
                margin-left:430px;
            }
            input[type=text]{
                border:1px solid #000;
                padding-left:5px;
            }
            input[type=date]{
                border:1px solid #000;
            }
            input[type=submit]{
                margin-left:130px;
                cursor:pointer;
            }
            .details{
                width:400px;
            }
            .details input{
                width:100px;
                margin-top:20px;
            }
        </style>
        <script type="text/javascript" src="../plugins/jquery-1.11.3.js"></script>
        <script type="text/javascript" charset="utf-8" src="../plugins/ueditor.config.js"></script>
        <script type="text/javascript" charset="utf-8" src="../plugins/ueditor.all.min.js"></script>
    </head>
    <body>
        <h2>产品编辑</h2>
        <div class="content">
            <form action="pro_update.php" method="POST" enctype="multipart/form-data">
                <p>产品名称：<input type="text" name="title" value="<?=$row['name']?>"/></p>
                <p>产品类别：
                    <select name="type">
                        <?php foreach($data as $val){?>  
                        <option value="<?=$val['id']?>" <?php if($row['type']==$val['id']){echo "selected = 'selected'";}?>><?=$val['type']?></option>
                        <?php }?>
                    </select>
                </p>
                <p>产品内容：</p>
                <textarea id="editor" name="content"><?=$row['content']?></textarea>
                <p>产品图片：<input type="file" name="img" value="更换图片"/><img src="<?=$row['img_src']?>"/></p>
                <p>产品详情：</p>
                <div class="details"> 
                    
                    <span>保&nbsp;&nbsp;修&nbsp;&nbsp;期：</span><input type="text" name="time" value="<?=$value['date']?>" required/>
                    <span>品&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牌：</span><input type="text" name="brand" value="<?=$value['brand']?>" required/>
                    
                    <span>型&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：</span><input type="text" name="model" value="<?=$value['model']?>" required/>
                    <span>分&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;类：</span><input type="text" name="classify" value="<?=$value['classify']?>" required/>
                    <span>类&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;型：</span><input type="text" name="del_type" value="<?=$value['type']?>" required/>
                    
                    <span>文&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：</span><input type="text" name="num" value="<?=$value['num']?>" required/>
                    <span>生产企业：</span><input type="text" name="company" value="<?=$value['company']?>" required/>
                    <span>颜&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;色：</span><input type="text" name="color" value="<?=$value['color']?>" required/>
                    
                    <span>滤&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;芯：</span><input type="text" name="lvxin" value="<?=$value['lvxin']?>" required/>
                    <span>使用位置：</span><input type="text" name="position" value="<?=$value['position']?>" required/>
                    <span>功&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;效：</span><input type="text" name="effect" value="<?=$value['effect']?>" required/>
                       
                </div>
                <p>添加时间：<input type="date" name="date" value="<?=$row['ctime']?>"/></p>
				<input type="hidden" name="id" value="<?=$row['id']?>"/>
                <p><input type="submit" value="修改信息"/></p>
            </form>
        </div>
    </body>
    <script type="text/javascript">
	    var ue = UE.getEditor('editor');
    </script>
</html>