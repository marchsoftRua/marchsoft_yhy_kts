<!DOCTYPE html>
<html>
<head>
	@include('main::admin.layouts.script')

	<script type="text/javascript" src="{{asset('Main/admin/article/articleList.js')}}"></script>
</head>
<body class="childrenBody">
<form class="layui-form">
	<blockquote class="layui-elem-quote quoteBox">
		<form class="layui-form">
			<div class="layui-inline">
				<div class="layui-input-inline">
					<input type="text" class="layui-input searchVal" placeholder="请输入搜索的内容" />
				</div>
				<a class="layui-btn search_btn" data-type="reload">搜索</a>
			</div>
			<div class="layui-inline">
				<a class="layui-btn layui-btn-normal addNews_btn">添加文章</a>
			</div>
			<div class="layui-inline">
				<a class="layui-btn layui-btn-danger layui-btn-normal delAll_btn">批量删除</a>
			</div>

		</form>
	</blockquote>
@verbatim
<script type="text/html" id="switchTpl">
  <input type="checkbox" name="isTop" value="{{d.article_title}}" lay-skin="switch" lay-text="是|否" lay-filter="isTop">
</script>

<script type="text/html" id="barDemo">
  <a class="layui-btn layui-btn-xs"  href="/article/{{d.id}}" target='__blank' lay-event="detail">查看</a>
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
@endverbatim
<table id="newsList" class="layui-table" lay-filter="newsList">
</table>
	
</form>
<script type="text/javascript">
	layui.use(['table','layer','jquery'],function(){
		var table = layui.table,
		$ = layui.jquery,
		layer = layui.layer;
		table.render({
	    elem: '#newsList'
	    ,height: 315
	    ,even:true
	    ,url:'/articleList'
	    ,cellMinWidth: 80
	    ,cols: [[ //表头
	       {type:'checkbox',fixed: 'left'}
	      ,{field:'id',title:'id',width:50}
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
	      ,{field:'is_delet',title:'是否置顶', templet: '#switchTpl',align:'center',width:100}
	      ,{field:'tools',title:'操作',toolbar:'#barDemo',fixed:'right',align:'center'}
	    ]]
	  });
	});

</script>

</body>
</html>