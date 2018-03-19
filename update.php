<?php
$colvalue = "";
if(isset($_POST["colvalue"])){
    $colvalue = $_POST["colvalue"];
}$colname =  $_POST["colname"]; 
$uid =$_COOKIE["id"];


//引入mysql.php打开数据库
require_once './mysql.php';
//获取的是密码，进行md5加密
if($colname=="password"){
    $colvalue = md5($colvalue);
}
$sql = "UPDATE users SET $colname='$colvalue' WHERE id=$uid";
$result = mysqli_query($con, $sql);
if($result==1){
    $arr = ["code"=>"30001","uid"=>"$uid","name"=>"$colname","value"=>"$colvalue"];
    echo json_encode($arr);
}else{
    echo "30002";
}



