<?php 
    //判断数据库连接是否存在，如果存在关闭掉
    if(isset($con)){
        mysqli_close($con);
    }
?>
<div id="footer">
    <div id="footer_all">
        <div class="footer_left">
            <a href="index.php" class="title">花瓣首页</a>
            <a href="http://huaban.com/about/goodies/">花瓣采集工具</a>
            <a href="http://blog.huaban.com/">花瓣官方博客</a>
        </div>
        <div class="footer_left">
            <a class="title">联系与合作</a>
            <a href="http://huaban.com/about/contact/">联系我们</a>
            <a href="http://huaban.com/pins/53553/">用户反馈</a>
            <a href="http://huaban.com/about/brand/">花瓣LOGO标准文档</a>
        </div>
        <div class="footer_left">
            <a class="title">移动客户端</a>
            <a href="http://huaban.com/apps/#iphone">花瓣iPhone版</a>
            <a href="http://huaban.com/apps/#android">花瓣Android版</a>
            <a href="http://huaban.com/apps/#ipad">花瓣HD</a>
        </div>

        <div class="footer_left footer_right">
            <a href="#" class="title">关注我们</a>
            <a href="http://weibo.com/huabanwang" target="_blank">新浪微博：@花瓣网</a>
            <a>联系客服：<span>在线客服</span></a>
            <a href="javascript:void(0);" class="weixin">官方微信：<img src="images/about_footer_code.png"><img src="images/weixin_huaban.png" class="code"></a>
            <a><img src="images/sm_124x47.png"></a>
        </div>
    </div>
    <div class="footer_bottom">
        <span>© Huaban 杭州纬聚网络有限公司&nbsp;</span><span>|</span>&nbsp;<a href="#">浙公网安备 33010602001878号</a>
    </div>
</div>