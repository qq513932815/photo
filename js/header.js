$(function() {

    //获取滚动条的位置
    $(document).scroll(function() {
        var top = $(document).scrollTop();
        var nav = $("#nav_mark");
        if (top > 0) {
            nav.css("position", "fixed");
            /*nav.animate({background:'#fff'},1000)*/
            nav.css("background", "#fff");
            $(".link").find("a").css({"color": "#333"})
            $(".logo img:eq(0)").attr("src", "images/logo.svg");
            $(".LogIn").css({"color": "#333", "border": "1px solid #333"})
            $("#top_seach_div").css({"display": "block"});
        } else {
            nav.css("position", "absolute");
            nav.css("background", "linear-gradient(to bottom, rgba(0, 0, 0, 0.3) , transparent)");
            $(".link").find("a").css({"color": "#fff"})
            $(".logo img:eq(0)").attr("src", "images/logo_wt.svg");
            $(".LogIn").css({"color": "white", "border": "1px solid white"})
            $("#top_seach_div").css("display", "none");
        }
    })

    //头像悬浮窗
    $(".user_info img").mouseover(function(){
        $(".user_detail").fadeIn(200);
    })


    //BUG 无法准确判断鼠标是否在user_detail内

    
    // .mouseout(function(){
    //     if($(".user_detail").mouseover()){
    //         console.log(1);
    //     }else if ($(".user_detail").mouseout()) {
    //         $(".user_detail").fadeOut(200);
    //     }
    // })

    //首页搜索框
    $("#inputs a").click(function(){
        var user_input_index = $("#inputs input").val();
        location.href = "search.php?page=1&search="+user_input_index;
    })

    //顶部搜索框
    $("#top_seach a").click(function(){
        var user_input_top = $("#top_seach_text").val();
        location.href = "search.php?page=1&search="+user_input_top;
    })
    

    //footer显示二维码
    var a = $(".weixin");
    var img = $(".code");
    a.mouseover(function() {
        img.css("display", "block");
    });
    a.mouseout(function() {
        img.css("display", "none");
    });

});