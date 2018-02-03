layui.use(['table','layer','jquery'],function(){
	var table = layui.table,
	layer = layui.layer,
	$ = layui.jquery;

	var Article = function(){

	};

	table.render({
	    elem: '#newsList'
	    ,height: 315
	    ,url:'/articleList'
	    ,cols: [[ //表头
	       {type:'checkbox',fixed: 'left'}
	      ,{field: 'article_id', title: '文章ID', sort: true}
	      ,{field: 'article_title', title: '文章标题'}
	      ,{field: 'article_type', title: '文章类型', sort: true}
	      ,{field: 'authority', title: '文章权限'}
	      ,{field: 'notebook_id', title: '笔记本'}
	      ,{field:'readnum',title:'浏览量'}
	      ,{field: 'praise', title: '赞', sort: true}
	      ,{field:'shame',title:'踩'}
	      ,{field: 'created_at', title: '创建时间', sort: true}
	      ,{field:'updated_at',title:'最后更新',sort: true}
	    ]]
	  });


})