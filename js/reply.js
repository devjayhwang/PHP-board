$(function () {
    /*댓글작성 ajax */
    $("#rep_btn").click(function () {

        var rep_con = $(".rep_con").val();
        
        if (rep_con == "") {
            alert("댓글을 입력해주세요.");
            location.reload();
        } else {
            $.ajax({
                url: "reply_ok.php",
                type: "POST",
                data: {
                    "bno": $(".bno").val(),
                    "dat_user": $(".dat_user").val(),
                    "rep_con": $(".rep_con").val(),
                },
                success: function (data) {
                    alert("댓글이 작성되었습니다.");
                    location.reload();
                }
            
            });
        }
    });

});
