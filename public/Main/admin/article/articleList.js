layui.use(['table','layer','jquery'],function(){
	var table = layui.table,
	layer = layui.layer,
	$ = layui.jquery,
	form = layui.form;
	var Article = function(){

	};

	table.render({
	    elem: '#newsList'
	    ,height: 315
	    ,even:true
	    ,url:'/articleList'
	    ,cellMinWidth: 80
	    ,cols: [[ //表头
	       {type:'checkbox',fixed: 'left'}
	      ,{type:'numbers',title:'id',width:50}
	      ,{field:'name',title: '用户名称',align:'center'}
	      ,{field: 'article_title', title: '文章标题',align:'center'}
	      ,{field: 'type_name', title: '文章类型',align:'center'}
	      ,{field: 'authority', title: '文章权限',align:'center',width:100}
	      ,{field: 'notebook_id', title: '笔记本',align:'center'}
	      ,{field:'readnum',title:'浏览量',sort:true,align:'center',width:100}
	      ,{field: 'praise', title: '赞', sort: true,align:'center',width:75}
	      ,{field:'shame',title:'踩',align:'center',width:75}
	      ,{field: 'created_at', title: '创建时间', sort: true}
	      ,{field:'updated_at',title:'最后更新',sort: true}
	      ,{field:'is_delet',title:'是否置顶', templet: '#switchTpl',align:'center'}
	      ,{field:'tools',title:'操作',toolbar:'#barDemo',fixed:'right',align:'center'}
	    ]]
	  });

  	form.on('switch(isTop)', function(obj){
    	layer.tips(this.value + ':' + (obj.elem.checked?'置顶':'取消置顶'), obj.othis);
  	});

    function addNews(edit){
        var index = layui.layer.open({
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