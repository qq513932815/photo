<?php 


//判断用户是否登录
$is_login = FALSE;//默认不登录
if(isset($_COOKIE["id"])){
    $is_login = TRUE;
    $id = $_COOKIE["id"];
}

?>
<script src="js/header.js" type="text/javascript"></script>
<script src="js/jscookie.js" type="text/javascript"></script>
<!-- 顶部导航栏 -->
<div id="nav_mark">
    <div id="nav">
        <div class="logo">
            <img src="images/logo_wt.svg" class="submit_buttom">
        </div>
        <div class="link" style="letter-spacing:-1px;">
            <ul>
                <li><a href="index.php">首页</a></li>
                <li><a href="list.php">发现</a></li>
                <li><a href="detail.php">最新</a></li>
                <li><a href="index.php">活动</a></li>
                <li style="width: 25px;"><a href="">|</a></li>
                <li><a href="detail.php?id=3">美思</a></li>
                <li id="longa"><a href="detail.php?id=4">美素<img src="images/em-new.svg" style="margin: 0 5px;"></a></li>
                <li id="longa"><a href="detail.php?id=5">花瓣live</a></li>
                <li><a href=list.php">……</a></li>    
            </ul>
            <div id="top_seach_div">
                <form id="top_seach">
                    <input type="text" id="top_seach_text" placeholder="搜索你喜欢的">
                    <a href="#"></a>
                </form>
            </div>
        </div>
        <div class="login_div">
            
            <div class="user_info">
                <img src="images/face/f1.jpg">
            </div>
            <div class="user_detail">
                <ul>
                    <li class="user"><a href="i.php?p=1">个人信息</a></li>
                    <li class="like"><a href="i.php?p=2&id=<?php echo $id; ?>&page=1">我的收藏</a></li>
                    <li class="logout"><a href="javascript:void(0)">退出登录</a></li>
                </ul>
            </div>

            <a class="SingIn" href="javascript:void(0)">注册</a>
            <a class="LogIn" href="javascript:void(0)">登录</a>

        </div>
        
    </div>
</div>