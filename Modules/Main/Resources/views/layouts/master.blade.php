<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Main</title>
        <link rel="stylesheet" type="text/css" href="{{asset('layui/css/layui.css')}}">
        <script type="text/javascript" src="{{asset('layui/layui.js')}}"></script>
    </head>
    <script type="text/javascript">
    	layui.use(['layer'],function(argument) {
    		var layer = layui.layer
    		layer.msg("asd")
    	})


    </script>
    <body>
        @yield('content')
    </body>
</html>
