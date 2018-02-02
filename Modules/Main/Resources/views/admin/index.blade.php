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
	<link rel="stylesheet" href="{{asset('Main/admin/layui/css/layui.css')}}" media="all" />
	<link rel="stylesheet" href="{{asset('Main/admin/css/font_eolqem241z66flxr.css')}}" media="all" />
	<link rel="stylesheet" href="{{asset('Main/admin/css/main.css')}}" media="all" />
	<script type="text/javascript" src="{{asset('Main/layui/layui.js')}}"></script>
	<script type="text/javascript">
		var module_path = "{{asset('Main/admin/js')}}/";
	</script>
	<script type="text/javascript" src="{{asset('Main/admin/js/main.js')}}"></script>
	<script type="text/javascript" src="{{asset('Main/admin/js/nav.js')}}"></script>
	<script type="text/javascript" src="{{asset('Main/admin/js/leftNav.js')}}"></script>
	<script type="text/javascript" src={{asset('Main/js/admin/index.js')}}></script>
</head>
<body class="main_body">
	<div class="layui-layout layui-layout-admin">

		@include('main::admin.layouts.header')
		@include('main::admin.layouts.side')
		@include('main::admin.layouts.body')
		@include('main::admin.layouts.phonenav')

	</div>
</body>
</html>