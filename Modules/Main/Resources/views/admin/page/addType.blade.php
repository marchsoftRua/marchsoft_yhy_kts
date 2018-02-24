<!DOCTYPE html>
<html>
<head>
	<title>添加类型</title>
	@include('main::admin.layouts.script')
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body　class="childrenBody">
	<div class="layui-container">
		<div class="layui-row">
			<form class="layui-form layui-form-pane" id="from-type">
				<div class="layui-form-item">
				    <label class="layui-form-label">标签名字</label>
				    <div class="layui-input-block">
				      <input type="text" name="" placeholder="请输入" autocomplete="off" class="layui-input">
				    </div>
			  	</div>
			</form>
		</div>
	</div>
</body>
<script type="text/javascript">
	layui.use(['form','layer','jquery'],function(){
		var form = layui.form,
		layer = layui.layer,
		$ = layui.jquery;
	});

</script>
</html>