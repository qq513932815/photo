<?php

//获取用户传递过来的值
$uid = $_POST["uid"];
$imgid = $_POST["imgid"];
$comment = $_POST["content"];
$time = time();

//引入mysql.php打开数据库
require_once '/mysql.php';
$sql = "INSERT INTO comment(uid,imgid,content,createtime) VALUES($uid,$imgid,'$comment','$time');";
$result = mysqli_query($con, $sql);
if($result>0){
    echo "10001";//成功
}  else {
    echo "10002";//失败
}