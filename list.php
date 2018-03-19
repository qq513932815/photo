<?php
//引入mysql.php打开数据库
require_once '/mysql.php';

//默认第一页
$page = 1;
//获取页码
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}

//获取每一组数据的第一条
$pagesize = 15;
//第一页 0，15
//第二页 15，15
//第三页 30，15
$start = ($page - 1) * $pagesize;
//获取images表中总共有多少条数据
$count_sql = "SELECT COUNT(id) AS count FROM images;";
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
        . "FROM images i LEFT JOIN users u ON u.id = i.userid LIMIT $start,$pagesize;";
$result = mysqli_query($con, $sql);

$prev = ($page-1)>0?$page-1:1;
$next = $page+1>$page_count?$page_count:$page+1;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>花瓣网分类页</title>
        <link rel="stylesheet" href="css/common.css" type="text/css">
        <link rel="stylesheet" href="css/list.css" type="text/css">
        <link rel="stylesheet" href="css/list_box.css" type="text/css">
        <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            //页面每次刷新，轮播图更新一次


        </script>
    </head>
    <body style="height: 100%; overflow:-Scroll; overflow-x:hidden; user-select:none; " ondragstart="return false; ">
        <!-- 注册登录模态框 -->
        <?php require_once'login_reg.php'; ?>
        <div id="header">
        <?php require_once'header.php'; ?>
            <div class="bg">
                <div class="center">
                    <h1>草莓</h1>
                    <p>草莓很好吃</p>
                    <p>————————Ta们已经关注————————</p>
                    <div class="face">
                        <img src="./images/face/f1.jpg">
                        <img src="./images/face/f2.png">
                        <img src="./images/face/f3.jpg">
                        <img src="./images/face/f4.jpg">
                        <img src="./images/face/f5.jpeg">
                        <img src="./images/face/f6.jpg">
                    </div>
                </div>
            </div>
        </div>

        <!-- 网页主体部分 -->
        <div id="main">

            <!-- 大家正在关注 -->
            <div class="all_look">
                <a>大家正在关注</a>
            </div>
            <?php require_once 'all_look.php'; ?>

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
                <p>
                    <a href="list.php?page=<?php echo $prev;?>" style="color: #333;"><</a>
                    <?php
                        for ($i = 1; $i <= $page_count; $i++) {
                            echo "<a href='list.php?page=" . $i . "' style='color: #333;'>" . $i . "</a>&nbsp;&nbsp;";
                        }
                    ?>
                <a href="list.php?page=<?php echo $next;?>" style="color: #333;">></a>
                </p>
            </div>
        </div>
        <?php include'footer.php'; ?>
    </body>
</html>
