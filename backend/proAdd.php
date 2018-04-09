<?php
    session_start();
    $username = $_SESSION['username'];
    $power = $_SESSION['power'];
    $pro_add_power = in_array("6",$power);// 查找权限数组中是否有产品添加功能
    $pro_manage_power = in_array("4",$power);// 查找权限数组中是否有新闻管理功能，有管理功能就直接包括了编辑、添加功能
    if($pro_add_power || $pro_manage_power){
        $db_link = mysqli_connect('localhost','root','','project');
        mysqli_query($db_link,"set names utf8");
        $sql = "select * from pro_type";
        $result = mysqli_query($db_link,$sql);
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
        <h2>产品添加</h2>
        <div class="content">
            <form action="pro_add.php" method="POST" enctype="multipart/form-data">
                <p>产品名称：<input type="text" name="title"/></p>
                <p>产品类别：
                    <select name="type">
                        <?php foreach($data as $val){?>
                        <option value="<?=$val['id']?>"><?=$val['type']?></option>
                        <?php }?>
                    </select>
                </p>
                <p>产品内容：</p>
                <textarea id="editor" name="content"></textarea>
                <p>产品图片：<input type="file" name="img"/></p>
                <p>产品详情：</p>
                <div class="details"> 
                        <span>保&nbsp;&nbsp;修&nbsp;&nbsp;期：</span><input type="text" name="time" required/>
                        <span>品&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;牌：</span><input type="text" name="brand" required/>
                        
                        <span>型&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：</span><input type="text" name="model" required/>
                        <span>分&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;类：</span><input type="text" name="classify" required/>
                        <span>类&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;型：</span><input type="text" name="del_type" required/>
                        
                        <span>文&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;号：</span><input type="text" name="num" required/>
                        <span>生产企业：</span><input type="text" name="company" required/>
                        <span>颜&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;色：</span><input type="text" name="color" required/>
                        
                        <span>滤&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;芯：</span><input type="text" name="lvxin" required/>
                        <span>使用位置：</span><input type="text" name="position" required/>
                        <span>功&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;效：</span><input type="text" name="effect" required/>
                       
                </div>
                <p>添加人员：<?=$username?></p>
                <p>添加时间：<input type="date" name="date"/></p>
                <p><input type="submit" value="添加产品"/></p>
            </form>
        </div>
    </body>
    <script type="text/javascript">
	    var ue = UE.getEditor('editor');
    </script>
</html>