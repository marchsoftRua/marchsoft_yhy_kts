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

    function addNews(url){
        if(!url)
            url = "/add/article"
        var index = layer.open({
            title : "添加文章",
            type : 2,
            content : url,
        })
        layui.layer.full(index);
        //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        $(window).on("resize",function(){
            layui.layer.full(index);
        })
    } 	

    function changeNews(id)
    {
        url = "/change/article/";
        addNews(url + id)
    }

    $(".addNews_btn").click(function(){
        addNews();
    })

    table.on('tool(newsList)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
        var layEvent = obj.event; 
        var data = obj.data; 
        if(layEvent === 'edit')
        {
            console.log(data.id)
            changeNews(data.id); 
        }  
    }); 

})