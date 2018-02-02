layui.use(['table','layer','jquery'],function(){
	var table = layui.table,
	layer = layui.layer,
	$ = layui.jquery;

	var Article = function(){

	};

	table.render({
	    elem: '#newsList'
	    ,height: 315
	    ,page: true //开启分页
	    ,url:''
	    ,cols: [[ //表头
	      {type:'checkbox'}
	      ,{field: 'id', title: 'ID', sort: true, fixed: 'left'}
	      ,{field: 'username', title: '用户名'}
	      ,{field: 'sex', title: '性别', sort: true}
	      ,{field: 'city', title: '城市'} 
	      ,{field: 'sign', title: '签名'}
	      ,{field: 'experience', title: '积分', sort: true}
	      ,{field: 'score', title: '评分', sort: true}
	      ,{field: 'classify', title: '职业'}
	      ,{field: 'wealth', title: '财富', sort: true}
	    ]]
	  });


})