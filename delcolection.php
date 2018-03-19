<?php
//取消收藏
$uid = $_POST["uid"];
$imgid = $_POST["imgid"];

//引入mysql.php打开数据库
require_once '/mysql.php';

$update_statu = "UPDATE colection SET statu=0 WHERE uid=$uid&&iid=$imgid;";
$update_statu_query = mysqli_query($con, $update_statu);
if($update_statu_query=="1"){
    echo '50001';
}