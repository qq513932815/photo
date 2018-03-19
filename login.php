<?php

//登录验证
$login_username = $_POST["login_username"];
$login_user_password = $_POST["login_user_password"];

if (empty($login_username)) {
    echo 20011; //用户名为空
    return;
} elseif (!preg_match("/^[a-zA-Z][\w]{5,10}$/", $login_username, $arr)) {
    echo 20012; //用户名或密码错误（用户名格式错误）
    return;
} elseif (empty($login_user_password)) {
    echo 20021; //密码为空
    return;
} elseif (!preg_match("/^[a-zA-Z0-9_]{7,15}$/", $login_user_password, $arr)) {
    echo 20022; //用户名或密码错误（密码格式错误）
    return;
} else {
    //引入mysql.php打开数据库
    require_once '/mysql.php';

    $login_user_password = md5($login_user_password);
    $select = "SELECT * FROM users WHERE username = '$login_username' AND password = '$login_user_password' LIMIT 1;";
    $result = mysqli_query($con, $select);
    $arr = mysqli_fetch_row($result); //索引数组的下标 0,1,2,3,4
    if ($arr) {
        setcookie("id", $arr[0],time()+36000);
        setcookie("username", $login_username,time()+36000);
        setcookie("face", $arr[3],time()+36000);
        $ret = ["code"=>"20000", "id"=>$arr[0],"login_username"=>$login_username,"face"=>$arr[3]];//关联数组
        //把数组转换成字符串
        echo json_encode($ret); //登录成功
    } else {
        echo 20001; //登录失败
    }
}