<?php
    $iid = 0;
    require_once 'mysql.php';
    //获取总条数
    $count_sql = "SELECT COUNT(id) AS count FROM images;";
    $count = mysqli_query($con, $count_sql);
    $c_arr = mysqli_fetch_row($count);
    $images_count = $c_arr[0]; //总计条数
    //随机取随机数
    $tmp = range(1,$images_count);
    $tmp_num = array_rand($tmp,6);
    for($i=0; $i<6; $i++){
        $iid = $iid+1; 
        $num = $tmp_num[$i]+1;
//        $num = rand(1, $images_count);
        $sql = "SELECT id,url,title,description,looktimes FROM images WHERE id=$num;";
        $select = mysqli_query($con, $sql);
        $result = mysqli_fetch_row($select);
        
        $new_id[$i] = $result[0];
        $new_url[$i] = $result[1];
        $new_title[$i] = $result[2];
        $new_description[$i] = $result[3];
        $new_looktimes[$i] = $result[4];

        if($iid==6){
            $iid = 0;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>花瓣网首页</title>
        <link rel="stylesheet" href="css/common.css" type="text/css">
        <link rel="stylesheet" href="./css/style.css" type="text/css">
        <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                //页面每次刷新，轮播图更新一次   
                //图片路径  
                var imgs = ["images/c1.jpg", "images/c2.jpg", "images/c3.jpg", "images/c4.jpg"];
                //随机获取一个索引
                var len = imgs.length;
                $("#carcouse img:first").attr("src", imgs[parseInt(Math.random() * 10 % len)]);
            });
        </script>
    </head>
    <body style="height: 100%; overflow:-Scroll; overflow-x:hidden; user-select:none; " ondragstart="return false;">
        <?php require_once'login_reg.php'; ?>
        <div id="header">
            <?php require_once'header.php'; ?>
            <!-- 轮播图DIV -->
            <div id="carcouse">
                <img src="images/c4.jpg">
            </div>

            <!-- 搜索框 -->
            <div id="search">
                <h1>
                    <img src="images/head_title.svg">
                </h1>
                <form id="search_input">
                    <div id="inputs">
                        <input type="text" class="txt" name="search" placeholder="搜索你喜欢的">
                        <a href="javascript:void(0)"></a>
                    </div>
                </form>
                <div id="hot_search">
                    <span style="color: #ddd">热门搜索：</span>
                    <a href="">排版</a
                    ><span>，</span><a href="list.php">海报设计</a
                    ><span>，</span><a href="list.php">花瓣live</a
                    ><span>，</span><a href="list.php">壁纸那些事</a
                    ><span>，</span><a href="list.php">配色</a>
                </div>
            </div>
        </div>


        <!-- 网页主体部分 -->
        <div id="main">


            <!-- 大家正在关注 -->
            <div class="all_look">
                <a>大家正在关注</a>
            </div>
            <?php require_once 'all_look.php';?>

            <!-- 为您推荐 -->
            <div class="all_look">
                <a>为您推荐</a>
            </div>
            <div id="foryou">

                <div class="img_div">
                    <a href="detail.php?id=<?php echo $new_id[0];?>">
                        <img class="sanjiao_t" src="images/info_tra.svg"> 
                        <img class="mm" src="<?php echo $new_url[0];?>">
                    </a>
                </div>

                <div class="img_div">
                    <div class="img_word_top">
                        <div class="recommend_data_top">
                            <a href="detail.php?id=<?php echo $new_id[0];?>" style="color: rgb(68, 68, 68);"><?php echo $new_title[0];?></a>
                        </div>
                        <span><?php echo $new_looktimes[0];?>观看</span>
                    </div>
                    <div class="img_word_bottom">
                        <div class="recommend_data_bottom">
                            <a href="detail.php?id=<?php echo $new_id[1];?>" style="color: rgb(68, 68, 68);"><?php echo $new_title[1];?></a>
                        </div>
                        <span><?php echo $new_looktimes[1];?>观看</span>
                    </div>
                </div>

                <div class="img_div">
                    <a href="detail.php?id=<?php echo $new_id[1];?>">
                        <img class="sanjiao_b" src="images/info_tra.svg"> 
                        <img class="mm" src="<?php echo $new_url[1];?>">
                    </a>
                </div>

                <div class="img_div">
                    <a href="detail.php?id=<?php echo $new_id[2];?>">
                        <img class="sanjiao_t" src="images/info_tra.svg"> 
                        <img class="mm" src="<?php echo $new_url[2];?>">
                    </a>
                </div>

                <div class="img_div_big">
                    <div class="recommend_data">
                        <a href="detail.php?id=<?php echo $new_id[2];?>" style="color: rgb(68, 68, 68);"><?php echo $new_title[2];?></a>
                    </div>
                    <p><?php echo $new_description[2];?></p>
                    <span><?php echo $new_looktimes[2];?>观看</span>
                </div>
            </div>


            <!-- 原创插画 -->
            <div class="all_look">
                <a>原创插画</a>
            </div>

            <div id="foryou">

                <div class="img_div">
                    <a href="detail.php?id=<?php echo $new_id[3];?>">
                        <img class="sanjiao_t" src="images/info_tra.svg">
                        <img class="mm" src="<?php echo $new_url[3];?>">
                    </a>
                </div>
                <div class="img_div_big">
                    <div class="recommend_data">
                        <a href="detail.php?id=<?php echo $new_id[3];?>" style="color: rgb(68, 68, 68);"><?php echo $new_title[3];?></a>
                    </div>
                    <p><?php echo $new_description[3];?></p>
                    <span><?php echo $new_looktimes[3];?>观看</span>
                </div>
                <div class="img_div">
                    <a href="detail.php?id=<?php echo $new_id[4];?>">
                        <img class="sanjiao_t" src="images/info_tra.svg">
                        <img class="mm" src="<?php echo $new_url[4];?>">
                    </a>
                </div>

                <div class="img_div">
                    <div class="img_word_top">
                        <div class="recommend_data_top">
                            <a href="detail.php?id=<?php echo $new_id[4];?>" style="color: rgb(68, 68, 68);"><?php echo $new_title[4];?></a>
                        </div>
                        <span><?php echo $new_looktimes[4];?>观看</span>
                    </div>
                    <div class="img_word_bottom">
                        <div class="recommend_data_bottom">
                            <a href="detail.php?id=<?php echo $new_id[5];?>" style="color: rgb(68, 68, 68);"><?php echo $new_title[5];?></a>
                        </div>
                        <span><?php echo $new_looktimes[5];?>观看</span>
                    </div>
                </div>
                <div class="img_div">
                    <a href="detail.php?id=<?php echo $new_id[5];?>">
                        <img class="sanjiao_b" src="images/info_tra.svg"> 
                        <img class="mm" src="<?php echo $new_url[5];?>">
                    </a>
                </div>
            </div>

            <div class="show_more">
                <a>加载更多</a>
            </div>

            <div id="more_links">

                <div class="more_links_top">
                    <div class="more_links_top_left">
                        <span>以分类浏览花瓣</span>
                    </div>
                    <div class="more_links_top_right">
                        <a href="list.php">所有采集 》</a>
                    </div>
                </div>

                <div class="uls">
                    <ul>
                        <li><a href="list.php">UI/UX</a></li>
                        <li><a href="list.php">平面</a></li>
                        <li><a href="list.php">插画/漫画</a></li>
                        <li><a href="list.php">家居/家装</a></li>
                        <li><a href="list.php">女装/搭配</a></li>
                        <li><a href="list.php">男士/风尚</a></li>
                        <li><a href="list.php">婚礼</a></li>
                    </ul>
                    <ul>
                        <li><a href="list.php">工业设计</a></li>
                        <li><a href="list.php">摄影</a></li>
                        <li><a href="list.php">造型/美妆</a></li>
                        <li><a href="list.php">美食</a></li>
                        <li><a href="list.php">旅行</a></li>
                        <li><a href="list.php">手工/布衣</a></li>
                        <li><a href="list.php">健身/舞蹈</a></li>
                    </ul>
                    <ul>
                        <li><a href="list.php">儿童</a></li>
                        <li><a href="list.php">宠物</a></li>
                        <li><a href="list.php">美图</a></li>
                        <li><a href="list.php">明星</a></li>
                        <li><a href="list.php">美女</a></li>
                        <li><a href="list.php">礼物</a></li>
                        <li><a href="list.php">极客</a></li>
                    </ul>
                    <ul>
                        <li><a href="list.php">动漫</a></li>
                        <li><a href="list.php">建筑设计</a></li>
                        <li><a href="list.php">人文艺术</a></li>
                        <li><a href="list.php">数据图</a></li>
                        <li><a href="list.php">游戏</a></li>
                        <li><a href="list.php">汽车/摩托</a></li>
                        <li><a href="list.php">电影/图书</a></li>
                    </ul>
                    <ul>
                        <li><a href="list.php">生活百科</a></li>
                        <li><a href="list.php">教育</a></li>
                        <li><a href="list.php">运动</a></li>
                        <li><a href="list.php">搞笑</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?php include'footer.php'; ?>
    </body>
</html>
