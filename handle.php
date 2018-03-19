<?php
$file = $_FILES["file"];
$oldname = $file["name"];
$name_arr = explode(".", $oldname);
$time = date("Ymdhis");
$newpath = $time.".".$name_arr[1];
//判断上传类型
$ext = ["png","jpg","tmp","jpeg"];
if(!in_array($name_arr[1], $ext)){
    return;
}
if(!is_uploaded_file($file["tmp_name"])){
    return;
}
$path = "./images/uploads/";
$id = $_COOKIE["id"];
$new_name = $path.$newpath;
if(move_uploaded_file($file["tmp_name"], $new_name)){
    //更新数据库
    //引入mysql.php打开数据库
    require_once './mysql.php';
    setcookie("face",$new_name);
    $sql = "UPDATE users SET face='$new_name' WHERE id=$id";
    $ret = mysqli_query($con, $sql);
    if($ret>0){
        echo "<script>alert('修改成功！'); location.href='i.php?id=$id'</script>";
    } else {
        echo "<script>alert('你瞎传什么！'); location.href='i.php?id=$id'</script>";
    }
    
    
    
}
$id = $_COOKIE["id"];

