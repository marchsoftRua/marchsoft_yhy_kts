layui.use(['table','layer','jquery'],function(){
	var table = layui.table,
	layer = layui.layer,
	$ = layui.jquery,
	form = layui.form;
	var Article = function(){

	};

	

  	form.on('switch(isTop)', function(obj){
    	layer.tips(this.value + ':' + (obj.elem.checked?'置顶':'取消置顶'), obj.othis);
  	});

    function addNews(edit){
        var index = layer.open({
            title : "添加文章",
            type : 2,
            content : "/add/article",
            success : function(layero, index){
                var body = layui.layer.getChildFrame('body', index);
                if(edit){
                    body.find(".newsName").val(edit.newsName);
                    body.find(".abstract").val(edit.abstract);
                    body.find(".thumbImg").attr("src",edit.newsImg);
                    body.find("#news_content").val(edit.content);
                    body.find(".newsStatus select").val(edit.newsStatus);
                    body.find(".openness input[name='openness'][title='"+edit.newsLook+"']").prop("checked","checked");
                    body.find(".newsTop input[name='newsTop']").prop("checked",edit.newsTop);
                    form.render();
                }
                setTimeout(function(){
                    layui.layer.tips('点击此处返回文章列表', '.layui-layer-setwin .layui-layer-close', {
                        tips: 3
                    });
                },500)
            }
        })
        layui.layer.full(index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(index);
        })
    } 	

    $(".addNews_btn").click(function(){
        addNews();
    })
})