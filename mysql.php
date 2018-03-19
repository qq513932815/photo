<?php
$con = mysqli_connect('localhost', 'root', 'root');
    if (!$con) {
        echo 10041;//数据库连接失败
        echo mysqli_errno($con);
    }

    mysqli_set_charset($con, 'utf8');
    mysqli_select_db($con, 'huabanwang');