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
	      ,{field: 'article_id', title: 'ID', sort: true}
	      ,{field: 'article_title', title: '用户名'}
	      ,{field: 'article_type', title: '性别', sort: true}
	      ,{field: 'authority', title: '城市'} 
	      ,{field: 'cover_path', title: '签名'}
	      ,{field: 'created_at', title: '积分', sort: true}
	      ,{field: 'deleted_at', title: '评分', sort: true}
	      ,{field: 'notebook_id', title: '职业'}
	      ,{field: 'praise', title: '财富', sort: true}
	      ,{field:'readnum',title:'readnum'}
	      ,{field:'shame',title:'shame'}
	      ,{field:'updated_at',title:'updated_at'}
	    ]]
	  });


})