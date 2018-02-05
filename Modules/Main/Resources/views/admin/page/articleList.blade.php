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
  <a class="layui-btn layui-btn-xs" lay-event="detail">查看</a>
  <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
  <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
</script>
@endverbatim
<table id="newsList" class="layui-table" lay-filter="newsList">
</table>
	
</form>


</body>
</html>