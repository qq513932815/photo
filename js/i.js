$(function() {
    $("table tr").mouseover(function() {
        $(this).find("td.change > a,#textss").show();
    }).mouseout(function() {
        $(this).find("td.change > a,#textss").hide();
    });

    var uid = getCookie("id");
    $("td.change > a").click(function() {
        //判断用户更新的是哪个值
        var input = $(this).parent().siblings("td.u_info").children("input").val();
        var colname = $(this).attr("name");
        //如果获取的是性别 则获取一下radio被checked的value值
        if(colname == "password"&&input.length<8){
                layer.msg('密码最短8位！', {icon: 5});
        }else if (colname == "sex") {
            var colvalue = $('input:radio[name="sex"]:checked').val();
        } else {
            var colvalue = input;
        }
        $.ajax({
            url: "update.php",
            type: "post",
            data: {colname: colname, colvalue: colvalue, },
            success: function(data) {
                var newdata = eval("(" + data + ")");
                if (newdata.code == "30001") {
                    layer.msg('更新成功！', {icon: 6});
                    if (newdata.name == "password") {
                        setTimeout(window.location.href = 'logout.php', 5000);
                    }
                }
                else {
                    layer.msg('更新失败！', {icon: 5});
                }
            }
        });
    });


    //点击上传图片，进行图片的切换
    //获取你选择的图片的路径~~~~  兼容性   
    //封装获取路径   JQ图片上传插件  ~~~  
    function getObjectURL(file) {
        var url = null;
        if (window.createObjectURL != undefined) { // basic    
            url = window.createObjectURL(file);
        } else if (window.URL != undefined) { // mozilla(firefox)    
            url = window.URL.createObjectURL(file);
        } else if (window.webkitURL != undefined) { // webkit or chrome    
            url = window.webkitURL.createObjectURL(file);
        }
        return url;
    }

    $("#upload").change(function() {
        //获取你本地图片的路径
        // getObjectURL(this);
        var url = getObjectURL(this.files[0]);
        console.log(this.files[0]);
        var size = this.files[0].size;
        if (parseInt(size) > 1024000) {   //4k  4000
            layer.msg('图片限制大小为1M！', {icon: 5});
        }
        $("#miniimg").attr("src", url);
    });


    $(".small_box_top").mouseover(function(){
        $(this).find("span").show();
    }).mouseout(function(){
        $(this).find("span").hide();
    });
});