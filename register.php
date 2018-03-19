<?php
//注册验证
session_start();
$reg_username = $_POST["reg_username"];
$reg_user_password = $_POST["reg_user_password"];
$reg_code_input = $_POST["reg_code_input"];
$face = 'images/face/f1.jpg';

if(empty($reg_username)){
    echo "10011";//用户名为空
}elseif (!preg_match("/^[a-zA-Z][\w]{5,10}$/", $reg_username, $arr)) {
    echo "10012";//用户名格式错误
}

elseif(empty($reg_user_password)){
    echo "10021";//密码为空
    return;
}elseif (!preg_match("/^[a-zA-Z0-9_]{7,15}$/", $reg_user_password, $arr)) {
    echo "10022";//密码格式错误
    return;
}

elseif(empty($reg_code_input)){
    echo "10031";//验证码为空
    return;
}elseif(!preg_match("/^[0-9]{4}$/", $reg_code_input, $arr)){
    echo "10032";//验证码为4位
    return;
}elseif($reg_code_input!=$_SESSION["code"]){
    echo "10033";//验证码不匹配
    return;
} else {
    
    //引入mysql.php打开数据库
    require_once '/mysql.php';

    //插入语句
    $reg_user_password = md5($reg_user_password);
    
    //验证用户名重复
    $has_username = "select * from  users where username='".$reg_username."';";
    $row = mysqli_query($con, $has_username);
    $user_result = mysqli_fetch_assoc($row);
    if($user_result["username"]){
        echo "10002";//用户名重复
//        echo mysqli_error($row);
        return;
    }else{
        
    }

    //用户名不重复
    $str = "INSERT INTO users(username, password,face)VALUES('$reg_username','$reg_user_password','$face');";
    $select = "SELECT * FROM users WHERE username = '$reg_username' AND password = '$reg_user_password' LIMIT 1;";
    //获取返回结果
    $result = mysqli_query($con, $str);

    if ($result) {
        $select_result = mysqli_query($con, $select);
        $arr = mysqli_fetch_row($select_result);
        setcookie("id", $arr[0],time()+3600);
        setcookie("username", $reg_username,time()+3600);
        setcookie("face", $arr[3],time()+3600);
        $ret = ["code"=>"10000", "id"=>$arr[0],"reg_username"=>$arr[1],"face"=>$arr[3]];//关联数组
        //把数组转换成字符串
        echo json_encode($ret); //注册成功
    } else {
        echo 10001; //注册失败
    }
}