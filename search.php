<?php
//引入mysql.php打开数据库
require_once '/mysql.php';

//默认第一页
$page = 1;
//获取页码
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}

$search_txt = "";
if (isset($_GET["search"])) {
    $search_txt = $_GET["search"];
}


//获取每一组数据的第一条
$pagesize = 15;
//第一页 0，15
//第二页 15，15
//第三页 30，15
$start = ($page - 1) * $pagesize;
//获取images表中总共有多少条数据
$count_sql = "SELECT COUNT(id) AS count FROM images WHERE title LIKE '%$search_txt%';";
$count = mysqli_query($con, $count_sql);
$c_arr = mysqli_fetch_row($count);
$images_count = $c_arr[0]; //总计条数

$page_count = ceil($images_count / $pagesize);
//获取总页数
//33条数据 3页
//if ($images_count % $pagesize == 0) {
//    $page_count = intval($images_count / $pagesize);
//} else {
//    $page_count = intval($images_count / $pagesize) + 1;
//}
$sql = "SELECT i.id,i.url,i.title,i.publictime,i.description,u.id userid,u.username,u.face "
        . "FROM images i LEFT JOIN users u ON u.id = i.userid WHERE i.title LIKE '%$search_txt%' LIMIT $start,$pagesize;";
$result = mysqli_query($con, $sql);
?>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>花瓣网搜索页</title>
        <link rel="stylesheet" href="css/common.css" type="text/css">
        <link rel="stylesheet" href="css/ad.css" type="text/css">
        <link rel="stylesheet" href="css/list_box.css" type="text/css">
        <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
    </head>
    <body style="overflow:-Scroll; overflow-x:hidden; user-select:none; " ondragstart="return false;">
        <!-- 注册登录模态框 -->
        <?php require_once'login_reg.php'; ?>
        <div id="header">
            <?php require_once'header.php'; ?>
            <div id="ad">
                <p>国内最优质图片灵感库<br/>
                    已有数百万初中网友，用花瓣网保存喜欢的图片</p>
            </div>
        </div>
        <div id="main">

            <div class="big_box">
                <?php while ($arr = mysqli_fetch_assoc($result)) { ?>
                    <div class="small_box">
                        <div class="small_box_top">
                            <a href="detail.php?id=<?php echo $arr["id"];?>">
                            <img src="<?php echo $arr['url']; ?>">
                            </a>
                        </div>
                        <div class="small_box_bottom">
                            <p class="txt"><?php echo $arr['title']; ?></p>
                            <p class="face">
                                <img src="<?php echo $arr['face']; ?>">
                                <a href="#">来自 <span><?php echo $arr['username']; ?></span> 的收藏<br/><?php echo date('Y-m-d', $arr['publictime']); ?></a>
                            </p>
                        </div>
                    </div>
            <?php } ?>
            </div>
            <div id="page">
                <p><&nbsp;
                    <?php
                        for ($i = 1; $i <= $page_count; $i++) {
                            echo "<a href='list.php?page=" . $i . "' style=''>" . $i . "</a>&nbsp;&nbsp;";
                        }
                    ?>
                &nbsp;></p>
            </div>
        </div>
        <?php include'footer.php'; ?>
    </body>
</html>