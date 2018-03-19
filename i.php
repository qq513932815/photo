<?php
if (isset($_GET["id"])) {
    $uid = $_GET["id"];
}
//根据地址栏的参数判断当前用户点击的是哪个选项卡
$p = 1;
if (isset($_GET["p"])) {
    $p = $_GET["p"];
}
$red1 = $red2 = "";
$p == 1 ? $red1 = "red" : $red2 = "red";

$cid = $_COOKIE["id"];
if ($uid == $cid) {
    
} else {
    echo '<script>alert("你瞎改啥？");location.href="i.php?id=' . $cid . '";</script>';
}
//引入mysql.php打开数据库
require_once '/mysql.php';

$sql = "SELECT * FROM users WHERE id = $uid ";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);

$sex = $user["sex"];
$nan = $nv = "";
if ($sex == 1) {
    $nan = "checked";
} else {
    $nv = "checked";
}

//收藏功能
$page = 1;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}
$pagesize = 6;
$start = ($page - 1) * $pagesize;
//获取收藏总条数
$all_selection = "SELECT COUNT(uid) AS num FROM colection WHERE uid=$uid&&statu=1;";
$all_selection_search = mysqli_query($con, $all_selection);
$all_selections = mysqli_fetch_assoc($all_selection_search);
$selection_num = $all_selections["num"]; //总条数
//总页数
$page_count = ceil($selection_num / $pagesize);
$colection_search = "SELECT 
                        c.id AS celectionid,u.id AS userid,i.id AS imgid,c.statu,c.ctime,
                        u.username,u.face AS userface,i.url,i.title,i.description 
                        FROM colection c 
                        LEFT JOIN images i ON i.id=c.iid 
                        LEFT JOIN users u ON u.id=c.uid 
                        WHERE u.id=$uid&&c.statu=1 
                        LIMIT $start,$pagesize;";
$colection_search_result = mysqli_query($con, $colection_search);
($page - 1) > 0 ? $page - 1 : 1;
$prev = ($page - 1) > 0 ? $page - 1 : 1;
$next = $page + 1 > $page_count ? $page_count : $page + 1;
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>花瓣网分类页</title>
        <link rel="stylesheet" href="css/common.css" type="text/css">
        <link rel="stylesheet" href="css/list.css" type="text/css">
        <link rel="stylesheet" href="css/i.css" type="text/css">
        <link rel="stylesheet" href="css/list_box.css" type="text/css">
        <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="js/i.js" type="text/javascript"></script>
        
    </head>
    <body style="height: 100%; overflow:-Scroll; /*overflow-x:hidden;*/ user-select:none; " ondragstart="return false; ">
        <!-- 注册登录模态框 -->
        <?php require_once'login_reg.php'; ?>
        <div id="header">
            <?php require_once'header.php'; ?>
            <div class="bg">
                <div class="top">
                    <div class="user_face">
                        <img src="<?php echo $user["face"]; ?>">
                        <p><?php echo $user["username"]; ?></p>
                    </div>
                    <div class="user_card">
                        <span><a href="i.php?p=1&id=<?php echo $uid; ?>" class="<?php echo $red1; ?>">个人资料</a></span>
                        <span><a href="i.php?p=2&id=<?php echo $uid; ?>" class="<?php echo $red2; ?>">我的收藏</a></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 网页主体部分 -->
        <div id="main">
            <div class="informations">
                <table>
                    <tr>
                        <td class="i_head">登录名：</td>
                        <td class="u_info"><span><?php echo $user["username"]; ?></span></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="i_head">密码：</td>
                        <td class="u_info"><input type="password" value="<?php echo $user["password"]; ?>"></td>
                        <td class="change"><a href="javascript:void(0);" name="password">立即修改</a></td>
                    </tr>
                    <tr>
                        <td class="i_head">性别：</td>
                        <td>
                            <input type="radio" name="sex" <?php echo $nan; ?> value="1">男
                            <input type="radio" name="sex" <?php echo $nv; ?> value="0">女
                        </td>
                        <td class="change"><a href="javascript:void(0);" name="sex">立即修改</a></td>
                    </tr>
                    <tr>
                        <td class="i_head">头像：</td>
                        <td class="u_info imgtr"><label for="upload"><img id="miniimg" src="<?php echo $user["face"]; ?>"></label></td>
                        <td class="change">
                            <form  action="handle.php" method="post" name="form" enctype="multipart/form-data">
                                <input id="upload"  class="upload" type="file" name="file" accept="image/gif, image/jpeg,image/png, image/jpg"/>
                                <input id="textss" type="submit" value="立即修改">
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td class="i_head">所在地区：</td>
                        <td class="u_info"><input type="text" value="<?php echo $user["address"]; ?>"></td>
                        <td class="change"><a href="javascript:void(0);" name="address">立即修改</a></td>
                    </tr>
                    <tr>
                        <td class="i_head">电话号码：</td>
                        <td class="u_info"><input type="text" value="<?php echo $user["tel"]; ?>"></td>
                        <td class="change"><a href="javascript:void(0);" name="tel">立即修改</a></td>
                    </tr>
                    <tr>
                        <td class="i_head bdb">个性签名：</td>
                        <td class="u_info bdb"><input type="text" value="<?php echo $user["mark"]; ?>"></td>
                        <td class="change bdb"><a href="javascript:void(0);" name="mark">立即修改</a></td>
                    </tr>
                </table>
            </div>
            <div class="colection">
                <div class="big_box_colection">
                    <?php while ($colection_result = mysqli_fetch_assoc($colection_search_result)) { ?>
                        <div class="small_box" a="1">
                            <div class="small_box_top">
                                <a href="detail.php?&id=<?php echo $colection_result["imgid"]; ?>">
                                    <img src="<?php echo $colection_result["url"]; ?>">
                                    <a href="javascript:void(0);" class="move_colection"><span>删除</span></a>
                                    <input id="imgid" value="<?php echo $colection_result["imgid"]; ?>" type="hidden"/>
                                </a>
                            </div>
                            <div class="small_box_bottom">
                                <p class="txt"><?php echo $colection_result["description"]; ?></p>
                                <p class="face_colection">
                                    <img src="<?php echo $colection_result["userface"]; ?>">
                                    <a href="#">来自 <span><?php echo $colection_result["username"]; ?></span> 的收藏<br/><?php echo date("Y-m-d",$colection_result["ctime"]); ?></a>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div id="page">
                    <p>
                        <a href="i.php?p=2&id=<?php echo $uid; ?>&page=<?php echo $prev; ?>"><&nbsp;</a>
                        <?php
                        for ($i = 1; $i <= $page_count; $i++) {
                            echo "<a href='i.php?p=2&id=" . $uid . "&page=" . $i . "'style='color: #333;'>" . $i . "</a>&nbsp;&nbsp;";
                        }
                        ?>
                        <a href="i.php?p=2&id=<?php echo $uid; ?>&page=<?php echo $next; ?>">></a>
                    </p>
                </div>
            </div>
        </div>
        <?php include'footer.php'; ?>
    </body>
    <script type="text/javascript">
        var p = <?php echo $p;?>;
        if(p=="2"){
            $(".informations").hide();
            $(".colection").show();
        }else{
            $(".informations").show();
            $(".colection").hide();
        }
        $(".move_colection span").click(function(){
            
            var id = getCookie("id");
            var imgid = $(this).parents().siblings("#imgid").attr("value");
            $.ajax({
                url: "delcolection.php",
                type: "post",
                data: {uid: id, imgid: imgid},
                success: function(data) {
                    if (data == "50001") {
                        layer.msg('取消收藏成功！', {icon: 6});
                        $(this).parents(".small_box").attr("a").remove();
                    } else {
                        layer.msg('取消收藏失败！', {icon: 5});
                    }
                }
            });
        });
        </script>
</html>