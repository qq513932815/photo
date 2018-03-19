<?php
    //获取用户传递的id
    $imageid = 1;
    if(isset($_GET["id"])){
        $imageid = $_GET["id"];
    }
    //获取cookie中的id
    $cookie_id = "";
    if(isset($_COOKIE["id"])){
        $cookie_id = $_COOKIE["id"];
    }
    
    //分页
    $pagesize = 3;
    $page = 1;
    if(isset($_GET["page"])){
        $page = $_GET["page"];
    }
    $start = ($page-1)*$pagesize;
    $prev = ($page-1)>0?$page-1:1;

    //引入mysql.php打开数据库
    require_once '/mysql.php';
    
    //查询语句
    $sql = "SELECT i.id,i.url,i.publictime,u.id userid,u.face,u.username FROM images i
LEFT JOIN users u ON u.id = i.userid
WHERE i.id=$imageid";
    
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);//关联数组
    $publictime = date("z")-date("z",$row["publictime"]);
    
    //获取当前的图片有多少囤评论
    $sql_count = "SELECT COUNT(id) count FROM comment WHERE imgid=$imageid";
    $r = mysqli_query($con, $sql_count);
    $all_count_number = mysqli_fetch_assoc($r);
    $pagecount = ceil(intval($all_count_number["count"]) / $pagesize);
    $next = $page+1>$pagecount?$pagecount:$page+1;
    
    //查询图片的评论
    $comment = "SELECT c.id,c.content,c.uid,c.createtime,u.username,u.face FROM comment c 
LEFT JOIN users u ON u.id = c.uid
WHERE c.imgid=$imageid
ORDER BY c.createtime DESC
LIMIT $start,$pagesize;";
    $comment_ret = mysqli_query($con, $comment);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>花瓣网详情页</title>
	<link rel="stylesheet" href="css/common.css" type="text/css">
	<link rel="stylesheet" href="css/detail.css" type="text/css">
	<link rel="stylesheet" href="css/ad.css" type="text/css">
	<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
	<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
    <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
    <script type="text/javascript" charset="utf-8" src="js/detail.js"></script>
    <script type="text/javascript" charset="utf-8" >
        $(function(){
            var collectbtn = $("#bottons a.like > span.collect");
            if(<?php echo $cookie_id?>!=""){
                <?php 
                    $load_selection = "SELECT uid,iid,statu FROM colection WHERE uid=$cookie_id&&iid=$imageid&&statu=1;";
                    $load_selection_query = mysqli_query($con, $load_selection);
                    $load_selection_result = mysqli_fetch_assoc($load_selection_query);
                    if($load_selection_result!=""){
                        echo '$(collectbtn).text("已收藏");';
                    }else{}
                ?>
            }else{
                $(collectbtn).text("收藏");
            }
            $("#bottons a.like > span.collect").click(function() {
                //获取当前登录用户的id
                <?php
                    if($cookie_id!=""){
                        $is_recolection = "SELECT uid,iid,statu FROM colection WHERE uid=$cookie_id&&iid=$imageid&&statu=0;";
                        $selectioning_query = mysqli_query($con, $is_recolection);
                        $is_recolection_result = mysqli_fetch_assoc($selectioning_query);
                        
                        if($is_recolection_result["uid"]!=""){
                            $re_colection = "UPDATE colection SET statu=1 WHERE uid=$cookie_id&&iid=$imageid";
                            $re_colection_query = mysqli_query($con, $re_colection);
                            if($re_colection_query=="1"){
                                echo 'layer.msg("第二次收藏成功!", {icon: 6});';
                                echo '$(this).text("已收藏");';
                            }
                        }else{
                            $selectioning = "SELECT uid,iid,statu FROM colection WHERE uid=$cookie_id&&iid=$imageid&&statu=1;";
                            $selectioning_query = mysqli_query($con, $selectioning);
                            $selectioning_result = mysqli_fetch_assoc($selectioning_query);
                            if($selectioning_result["statu"]=="1"){
                                echo 'layer.msg("您已收藏该图!", {icon: 5});';
                            }else{
                                $time = time();
                                $collect = "INSERT INTO colection(uid,iid,ctime) VALUES($cookie_id,$imageid,$time);";
                                $c = mysqli_query($con, $collect);
                                if($c == 1){
                                    echo 'layer.msg("收藏成功!", {icon: 6});';
                                    echo '$(this).text("已收藏");';
                                }else{
                                    echo 'layer.msg("收藏失败!", {icon: 5});';
                                }
                            }
                        }
                        
                    }else{
                        echo 'layer.msg("请登录后收藏!", {icon: 5});';
                    }
                    
                ?>
            })
        })
    </script>

</head>
<body style="overflow:-Scroll; overflow-x:hidden; user-select:none; " ondragstart="return false;"">
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
            <input id="imgid" value="<?php echo $imageid;?>" type="hidden"/>
		<div id="big_left">
			<div id="bottons">
                <a href="javascript:void(0);" class="like"><span class="top_bottons collect">收藏</span></a>
                <a href="javascript:history.back(-1);"><span class="top_bottons return">返回</span></a>
			</div>
			<div id="img">
                            <img src="<?php echo $row["url"];?>">
			</div>
			<!-- <div id="shares">
				<p>分享到：</p>
				<a href="#" title="新浪微博" class="Weibo"></a>&nbsp;
				<a href="#" title="QQ空间" class="Qzone"></a>&nbsp;
				<a href="#" title="微信" class="Wechat"></a>&nbsp;
				<a href="#" title="腾讯微博" class="TWeibo"></a>
			</div> -->
			<div class="bshare-custom"><a title="分享到" href="http://www.bShare.cn/" id="bshare-shareto" class="bshare-more">分享到</a><a title="分享到QQ空间" class="bshare-qzone">QQ空间</a><a title="分享到新浪微博" class="bshare-sinaminiblog">新浪微博</a><a title="分享到人人网" class="bshare-renren">人人网</a><a title="分享到腾讯微博" class="bshare-qqmb">腾讯微博</a><a title="分享到网易微博" class="bshare-neteasemb">网易微博</a><a title="更多平台" class="bshare-more bshare-more-icon more-style-sharethis"></a><span class="BSHARE_COUNT bshare-share-count">0</span></div>
		</div>
		<div id="big_right">
			<div class="big_right_top">
                            <img src="<?php echo $row["face"];?>">
				<div id="ID_publicTime">
					<h2><?php echo $row["username"];?></h2>
                                        <p>发布于<?php echo $publictime;?>天前</p>
				</div>
			</div>
			<div id="big_right_mid">
                            <?php while($comments = mysqli_fetch_assoc($comment_ret)){?>
                                <div class="s_box">
                                            <div class="info">
                                                    <img src="<?php echo $comments["face"];?>">
                                                    <span><?php echo $comments["username"];?></span>
                                                    <span><?php echo date("m月d日",$comments["createtime"]);?></span>
                                            </div>
                                            <p class="text"><?php echo $comments["content"];?></p>
                                </div>
                            <?php }?>
<!--				<div class="s_box">
					<div class="info">
						<img src="images/face/f1.jpg">
						<span>zhangsan</span>
						<span>9月5日</span>
					</div>
					<p class="text">123123132</p>
				</div>
				<div class="s_box">
					<div class="info">
						<img src="images/face/f1.jpg">
						<span>zhangsan</span>
						<span>9月5日</span>
					</div>
					<p class="text">123123132</p>
				</div>-->
				<p>
                                    <a href="detail.php?id=<?php echo $imageid;?>&page=<?php echo $prev;?>" style="color: #333;"><</a>
                                    <?php for($i=1; $i<=$pagecount; $i++){?>
                                    <a href="detail.php?id=<?php echo $imageid;?>&page=<?php echo $i;?>" style="color: #333;"><?php echo $i;?></a>
                                    <?php }?>
                                    <a href="detail.php?id=<?php echo $imageid;?>&page=<?php echo $next;?>" style="color: #333;">></a>
                                </p>
			</div>
			<div id="big_right_under">
				<div class="textarea">
					<textarea class="words" placeholder="请登录后发表评论！"></textarea>
				</div>
                                <a href="javascript:void(0);" class="top_bottons input">评论</a>
			</div>
		</div>
	</div>
	<?php include'footer.php'; ?>
</body>
</html>