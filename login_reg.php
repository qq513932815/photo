<?php ?>
<link rel="stylesheet" href="js/theme/default/layer.css" type="text/css">
<script src="js/login_reg.js" type="text/javascript"></script>
<script src="js/layer.js" type="text/javascript"></script>
<!-- 登录模态框 -->
<div id="login_box">
    <span><img src="images/close.svg"></span>
    <div class="img">
        <img src="images/logo_2x.png">
    </div>
    <div class="yours">
        <p>使用第三方帐号登录</p>
        <div class="login_icons">
            <a href="" title="微博用户登录" class="weibo"></a>
            <a href="" title="QQ用户登录" class="QQ"></a>
            <a href="" title="豆瓣用户登录" class="douban"></a>
            <a href="" title="人人用户登录" class="renren"></a>
            <a href="" title="微信用户登录" class="weixin"></a>
        </div>
    </div>
    <div class="user_input">
        <p>使用帐号和密码登录</p>
        <div id="login_input">
            <input type="text" id="login_username" class="login_inputs" name="login_username" placeholder="输入花瓣网帐号">
            <input type="password" id="login_user_password" class="login_inputs" name="login_user_password" placeholder="输入密码">
            <input type="submit" id="login_btn" class="login_inputs submit_buttom" name="" value="登 录" style="background-color: rgb(201,0,0); color: #fff; font-size: 15px;">
        </div>
    </div>
    <div class="login_turnto">
        <p>还没有帐号？<a class="submit_buttom" style="color: blue;">点击注册</a></p>
    </div>
</div>
<!-- 登录框结束 -->

<!-- 注册框 -->
<div id="reg_box">
    <span><img src="images/close.svg"></span>
    <div class="reg_top">
        <img src="images/logo_2x.png">
    </div>
    <div class="reg_main">
        <p>使用用户名注册</p>
        <div id="login_input" style="position: relative; width: 308px; height: 200px; margin: 0 auto;">
            <input type="text" id="reg_username" class="login_inputs" name="reg_user_name" placeholder="字母开头字母数字组成 6-11位" maxlength="30">
            <input type="password" id="reg_user_password" class="login_inputs" name="reg_user_password" placeholder="字母数字下划线组成 8-15位" maxlength="30">
            <input type="text" id="reg_code_input" class="code" name="reg_code_input" placeholder="请输入验证码" maxlength="10">
            <img src="./verification.php" style="position: absolute; left: 190px; top: 107px;" class="verification">
            <input type="submit" id="reg_btn" class="login_inputs submit_buttom" name="" value="注 册" style="background-color: rgb(201,0,0); color: #fff; font-size: 15px;">
        </div>
    </div>
    <div class="reg_turnto">
        <p>已有帐号？<a class="submit_buttom" style="color: blue;" >点击登录</a></p>
    </div>
</div>