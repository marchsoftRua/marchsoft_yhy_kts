var c_current_page=1,c_bycolumn=0,c_status=0,c_type=0,c_getLimit=10,havemore=true;

$(document).ready(function(){
    $("#getmore").bind("click",function () {
        if(havemore)
            getMorePage(0,c_bycolumn,c_status,c_type,10,1,c_current_page+1)
    });
    $("#byNew").bind("click",function () {
        c_bycolumn = 3;
        getMorePage(0,3,0,0,10,0,1);
        $("#byHot").attr("class","");
        $(this).attr("class","layui-this")
    });
    $("#byHot").bind("click",function () {
        c_bycolumn = 2;
        getMorePage(0,2,0,0,10,0,1);
        $("#byNew").attr("class","");
        $(this).attr("class","layui-this")
    });
    getMorePage(1,0,1,0,5,0,1); //获得置顶模块
    getMorePage(0,0,0,0,10,0,1);//获得综合模块
    getWeekHot()
});
function getWeekHot() {
    $.ajax({
        url: "/getSpeakRank",
        type: "post",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success:function (data) {
            console.log(data)
        },
        error:function () {
            // alert()
        }

    })
}
function getMorePage(isTop,bycolumn,status,type,getLimit,more,page) {
    /**
     * isTop   是否置顶  0 否 1 是
     * bycolumn 根据什么字段排序  0 不排序  1  赞数 2 阅读量 3 创建时间
     * status
     * */
     var  address = window.location.pathname
     console.log(address)
    $.ajax(
        {
            url: "/reader",
            type: "post",
            data:{
                "page":page,
                "bycolumn":bycolumn,
                "status":status,
                "type":type,
                "address":address,
                "getLimit":getLimit
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(data){
                if (isTop){
                    $('#setTop').html(data.html)
                }else{
                    console.log(data.data.current_page)
                    if (more){
                        if(data.data.last_page!=page+1){
                            c_current_page=data.data.current_page
                            $('#setMain').append(data.html)
                        }else{
                            havemore=false;
                            c_current_page=data.data.current_page
                        }
                    }else {
                        c_current_page=1;
                        c_status=0;
                        c_type=0;
                        c_getLimit=10;
                        $('#setMain').html(data.html)
                    }
                }
            },
            error:function () {
                layui.use('layer', function(){
                    var layer = layui.layer;
                    layer.msg('服务器错误！');
                });
            }
        }
    )
}