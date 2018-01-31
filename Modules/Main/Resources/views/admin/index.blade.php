<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>三月社区</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta http-equiv="Access-Control-Allow-Origin" content="*">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">
	<link rel="icon" href="favicon.ico">
	<link rel="stylesheet" href="{{asset('admin/layui/css/layui.css')}}" media="all" />
	<link rel="stylesheet" href="{{asset('admin/css/font_eolqem241z66flxr.css')}}" media="all" />
	<link rel="stylesheet" href="{{asset('admin/css/main.css')}}" media="all" />
	<script type="text/javascript" src="{{asset('layui/layui.js')}}"></script>
	<script type="text/javascript">
		var module_path = "{{asset('admin/js/')}}/"
	</script>
	<script type="text/javascript" src="{{asset('admin/js/main.js')}}"></script>

</head>
<body class="main_body">
	<div class="layui-layout layui-layout-admin">

		@include('main::admin.layouts.header')
		@include('main::admin.layouts.side')
		
	</div>
	<script type="text/javascript">
		layui.config({
				base : "{{asset('admin/js/')}}/"
			}).use(['form','element','layer','jquery'],function()
		{
			var form = layui.form,
			layer = layui.layer,
			element = layui.element;
			$ = layui.jquery;
			tab = layui.bodyTab;
		})

	</script>
	
</body>
</html>