$(function() {
    
    //点击logo跳转到首页
    $(".logo").click(function(){
        location.href="index.php";
    })

    //页面加载通过JS判断cookie是否存在
    // var cookie = document.cookie;
    // var cookies = cookie.split(";");
    // var id = cookies[0];
    // var id_value = cookies[0].split("=");
    // alert(id_value[1]);
    //JS cookie的获取 必须要封装成函数


    var id = getCookie("id");
    var face = unescape(getCookie("face"));
    if (id!=""&&id!=undefined) {
        getperson(id,face);
    }

    // function getCookie(key){
    //     var cookie = document.cookie;//获取所有的cookie
    //     var cookies = cookie.split(";");
    //     var value = "";
    //     for (var i = 0,length=cookies.length;i<length; i++) {
    //         var key_value = cookies[i].split("=");
    //         var new_key_value = key_value[0].replace(/(^\s*)|(\s*$)/g, "");
    //         if(key == new_key_value){
    //             value = key_value[1];
    //             break;
    //         }
    //     }
    //     return value;
    // }
    
    //登录按钮
    $(".LogIn").click(function() {
        mark("#login_box");
    });

    //注册按钮
    $(".SingIn").click(function() {
        mark("#reg_box");
        $("#login_input > img").attr("src", "./verification.php?t=" + Math.random());
    });

    //登录关闭按钮
    $("#login_box > span").click(function() {
        close_botton("#login_box");
    });

    //注册关闭按钮
    $("#reg_box > span").click(function() {
        close_botton("#reg_box");
    });

    //登录跳转按钮
    $(".login_turnto a").click(function() {
        turnto_botton("#login_box","#reg_box");
    });

    //注册跳转按钮
    $(".reg_turnto a").click(function() {
        turnto_botton("#reg_box","#login_box");
    });
    
    
    //js简单验证


    //注册按钮
    $("#reg_btn").click(function(){

        var reg_username = $("#reg_username").val();
        var reg_user_password = $("#reg_user_password").val();
        var reg_code_input = $("#reg_code_input").val();

//        if(reg_username.length<6 || reg_username.length>11){
//            layer.msg('用户名为6-11位', {icon: 5});
//           return;
//        }
//        if (reg_user_password.length<8 || reg_user_password.length>15) {
//            layer.msg('密码为8-15位', {icon: 5});
//            return;
//        }
//        if (reg_code_input.length!==4) {
//            layer.msg('验证码为4位', {icon: 5});
//            return;
//        }

        //提交数据到后台，页面不能刷新 --- 无刷新技术（AJAX）
        //原生态JS非常复杂  jq使用AJAX无兼容性问题
        $.ajax({
            url:"register.php",
            type:"POST",
            data:{reg_username:reg_username,reg_user_password:reg_user_password,reg_code_input:reg_code_input},
            success:function(data){
                
                ////用户名错误提示
                if(data == "10011"){
                    layer.msg('用户名不能为空！', {icon: 5});
                    return;
                }
                else if(data == "10012"){
                    layer.msg('用户名格式错误！', {icon: 5});
                    return;
                }else{}
                
                //密码错误提示
                if (data == "10021") {
                    layer.msg('密码不能为空！', {icon: 5});
                    return;
                }
                else if (data == "10022") {
                    layer.msg('密码格式错误！', {icon: 5});
                    $("#reg_user_password").val("");
                    $("#login_input > img").attr("src", "./verification.php?t=" + Math.random());
                    return;
                }else{}
                
                //验证码错误提示
                if(data == "10031"){
                    layer.msg('验证码不能为空！', {icon: 5});
                    return;
                }
                else if(data == "10032" || data == "10033"){
                    layer.msg('您输入的验证码有误！', {icon: 5});
                    $("#reg_user_password").val("");
                    $("#reg_code_input").val("");
                    $("#login_input > img").attr("src", "./verification.php?t=" + Math.random());
                    return;
                }else{}
                
                //注册成功
                var newdata = eval("("+data+")");
                if(newdata.code == "10000"){
                    
                    layer.msg('注册成功！', {icon: 6});
                    $("#reg_box").fadeOut(500);
                    $("#mark").remove();
                    getperson(newdata.id,newdata.face);
                    return;
                }else if(data == "10001"){
                    layer.msg('注册失败！', {icon: 5});
                    return;
                }else if(data == "10002"){
                    layer.msg('用户名重复！', {icon: 5});
                    $("#reg_username:text").select();
                    $("#reg_user_password").val("");
                    $("#reg_code_input").val("");
                    $("#login_input > img").attr("src", "./verification.php?t=" + Math.random());
                    return;
                }else{}
                
                //数据库连接失败
                if(data == "10041"){
                    layer.alert('数据库连接失败！', {icon: 5});
                    return;
                }
            },
            error:function(){
                
            }
        });

    });
    
    //登录按钮
    $("#login_btn").click(function(){
        //获取用户输入的用户名、密码
        var login_username = $("#login_username").val();
        var login_user_password = $("#login_user_password").val();
        
        $.ajax({
            url: "login.php",
            type: "POST",
            data: {login_username: login_username, login_user_password: login_user_password},
            success:function(data){
                //json数据格式 手机 PC端都能访问 可加密
                //eval 把js字符串转换成对象
                var newdata = eval("("+data+")");
                //alert(newdata.code);//把一个字符串转化成一个对象型字符串
                //对象 ---属性 方法
                //对象   属性--Math.Pi    方法---Math.ceil()
                if(newdata.code == "20000"){
                    layer.msg('登录成功！', {icon: 6});
                    $("#login_box").fadeOut(500);
                    $("#mark").remove();
                    getperson(newdata.id,newdata.face);
                    setTimeout(location.href='list.php',6000);
                    
                    return;
                }else if(data == "20001"){
                    layer.msg('用户名或密码错误！', {icon: 5});
                    $("#login_user_password").val("");
                    return;
                }
            },
            error:function(){
                
            }
        });
    });

    //点击图片更换验证码
    $("#login_input > img").click(function() {
        $(this).attr("src", "./verification.php?t=" + Math.random());
    });

    //退出登录
    $(".logout").click(function(){
        //JS清除cookie
        deleteCookie("id");
        deleteCookie("username");
        deleteCookie("face");
        layer.msg('退出登录成功！', {icon: 6});
        window.location.href='http://localhost/huabanwang/index.php';
        $(".user_info").hide();
        $(".user_detail").hide();
        $(".SingIn,.LogIn").show();
    })

    //安全纱
    function mark(id){
        $(id).fadeIn(500);
        $("body").append("<div id='mark'></div>");
        $("#mark").css({
            "width": "100%",
            "height": $(document).height(),
            "position": "absolute",
            "top": "0",
            "left": "0",
            "z-index": "1001",
            "background": "rgba(0,0,0,.4)"
        }).on("click", function() {
            $("#login_box").fadeOut(500);
            $("#reg_box").fadeOut(500);
            $("#mark").fadeOut(500, function() {
                $("#mark").remove();
            });
        });
    }

    //关闭按钮
    function close_botton(id){
        $(id).fadeOut(500);
        $("#mark").fadeOut(500, function() {
            $("#mark").remove();
        });
    }

    //跳转按钮
    function turnto_botton(now,turnto){
        $(turnto).fadeIn(250);
        $(now).fadeOut(250);
    }

    //显示登录状态
    function getperson(id,face){
        $(".user").find("a").attr("href","i.php?id="+id);
        $(".user_info").find('img').attr('src',face);
        $(".user_info").show();
        $(".SingIn,.LogIn").hide();
    }
});
