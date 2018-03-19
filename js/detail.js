$(function() {
    $("#big_right_under a").click(function() {
        //获取用户输入内容
        var user_input = $(".textarea textarea").val();
        var id = getCookie("id");
        //获取当前登录状态 未登录不能发布
        if (id == undefined || id == "") {
            layer.msg('请登录后发布！', {icon: 5});
        }else{
           if (user_input == "") {
                layer.msg('请输入内容！', {icon: 5});
            } else {
                var imgid = $("#imgid").val();
                $.ajax({
                    url: "comment.php",
                    type: "post",
                    data: {content: user_input, uid: id, imgid: imgid},
                    success: function(data) {
                        if (data == "10001") {
                            layer.msg('提交成功！', {icon: 6});
                            history.go();
                        }
                    }
                });
            } 
        }
            
    });

    

})