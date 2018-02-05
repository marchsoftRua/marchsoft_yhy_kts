var childSortWay=1;
var orderRule = 0;
const GETCHILD = 1;
const GETALL = 2;
$(document).ready(function(){
    getComments(GETALL,1,1,0,5,1);

});
$('body').on('click','.reply_bt',function(event){
   var selEl = "#p_id_"+event.target.getAttribute("pid")
   var source = document.getElementById(selEl);
   var back =  $('#copyIn').clone(true)
   $(back).addClass('back')
   $(".back").removeAttr("style")
   $('.back').remove()
   $(selEl).append(back)
})
 $('body').on('click','.more',function(event){
    var obj = event.target
    var select = $(obj).parent().parent()
    getComments(GETCHILD,obj.name,1,0,5,select)
 })
  $('body').on('click','#byHot',function(event){
    orderRule=1
    $('#byHot').attr('class',"layui-this")
    $('#byNew').attr('class',"")
    getComments(GETALL,1,1,orderRule,5,1);
 })
    $('body').on('click','#byNew',function(event){
    orderRule=0
    $('#byHot').attr('class',"")
    $('#byNew').attr('class',"layui-this")
    getComments(GETALL,1,1,orderRule,5,1);
 })
function dealPage(obj,first) {
    if (first) return;
    if (obj.elem=="allPage") {
        getComments(GETALL,1,obj.curr,orderRule,5,obj.elem)
        window.scrollTo(0,$('#flyReply').offset().top);
    }else{
        var select = document.getElementById(obj.elem)
        var p_id = select.getAttribute('name')
        getComments(GETCHILD,p_id ,obj.curr,1,5,$(select).prev())
    }
}
function getComments(type,p_id,c_page,bycolumn,getLimit,el) {
    var myurl_ = window.location.href;
    var rout_info = document.getElementById('theArticle').getAttribute('name')
    var actionUrl;
    actionUrl = type==GETCHILD ?"/getChild":"/getComment";
    $.ajax({
        url: actionUrl,
        type: "post",
        data:{
            "article_id":rout_info,
            "page":c_page,
            "p_id":p_id,
            "bycolumn":bycolumn,
            "getLimit":getLimit
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
        success:function (data) {
            if (type==GETALL&&data.data.last_page>0) {
                $("#comment_area").html(data.html)
                if (data.data.current_page==1) {
                    readyPage(data.data.total,"allPage",dealPage)
                }
            }else{
                $(el).html(data.html)
                var c_id = "c_fpage_"+rout_info+"_"+p_id
                if (data.data.current_page==1) {
                    readyPage(data.data.total,c_id,dealPage)
                }
            }
        }
    })
}
function readyPage(total,el,cb) {
    layui.use('laypage', function(){
      var laypage = layui.laypage;
      //执行一个laypage实例
      laypage.render(
      {
            elem: el //注意，这里的 test1 是 ID，不用加 # 号
            ,count: total //数据总数，从服务端得到
            ,jump: cb,
            limit:5
      });
    })
}
