var c_current_page=1,c_bycolumn=0,c_getLimit=10,havemore=true;

$(document).ready(function(){
    getComments();
});
function getComments() {
    $.ajax({
        url: "/getComment",
        type: "post",
        data:{
            "article_id":1,
            "page":1,
            "bycolumn":1,
            "getLimit":1
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success:function (data) {
            $("#comment_area").html(data)
        },
        error:function () {
            // alert()
        }

    })
}
