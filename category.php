<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>花瓣网分类页</title>
        <link rel="stylesheet" href="css/common.css" type="text/css">

        <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            //页面每次刷新，轮播图更新一次


        </script>
    </head>
    <body style="height: 100%; overflow:-Scroll; overflow-x:hidden">

        <!-- 注册登录模态框 -->
        <?php require_once'login_reg.php'; ?>

        <div id="header">
            <?php require_once'header.php'; ?>
        </div>

        <!-- 网页主体部分 -->
        <div id="main" style="height: 1000px;">
            <!-- 大家正在关注 -->
            <div class="all_look">
                <a>大家正在关注</a>
            </div>
        </div>
        <?php include'footer.php'; ?>
    </body>
</html>
