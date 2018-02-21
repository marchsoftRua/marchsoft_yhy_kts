<!DOCTYPE html>
<html>
<head>
	<title>添加类型</title>
	@include('main::admin.layouts.script')
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body　class="childrenBody">
	<form class="layui-form layui-col-space5" id="from-type">
		<div class="layui-form-item　">
		    <label class="layui-form-label">输入框</label>
		    <div class="layui-input-block">
		      <input type="text" name="" placeholder="请输入" autocomplete="off" class="layui-input">
		    </div>
	  	</div>
	</form>
</body>
<script type="text/javascript">
	layui.use(['form','layer','jquery'],function(){
		var form = layui.form,
		layer = layui.layer,
		$ = layui.jquery;
	});

</script>
</html>