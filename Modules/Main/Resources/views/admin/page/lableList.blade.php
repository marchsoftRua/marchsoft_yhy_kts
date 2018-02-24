<!DOCTYPE html>
<html>
<head>
	<title>标签管理</title>
	@include('main::admin.layouts.script')
	<!-- <script type="text/javascript" src="{{asset('Main/admin/type/type.js')}}"></script> -->
</head>
<body>
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
				<a class="layui-btn layui-btn-normal addNews_btn">添加标签</a>
			</div>
			<div class="layui-inline">
				<a class="layui-btn layui-btn-danger layui-btn-normal delAll_btn">批量删除</a>
			</div>
		</form>
	</blockquote>
<table id="newsList" class="layui-table" lay-filter="newsList">
</table>
	
</form>
</body>
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
	      ,{type:'numbers',title:'id',width:50}
	      ,{field:'type_name',title: '标签名称',align:'center'}
	      ,{field:''}
	    ]]
	  });
	});

</script>

</html>