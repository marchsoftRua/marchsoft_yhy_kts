<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>三月2</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="keywords" content="三月,三月社区">
  <meta name="_token" content="{{ csrf_token() }}">
  <meta name="description" content="三月小组是最棒的，这是我们大家的社区">
  <link rel="stylesheet" type="text/css" href="{{asset('/Main/layui/css/layui.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/Main/index/css/index.css')}}">
  <link rel="stylesheet" href="{{asset('/Main/res/css/global.css')}}">
  <script src="{{asset('/js/jquery.js')}}"></script>
  <script src="{{asset('/Main/layui/layui.js')}}"></script>

</head>
<body>
  @yield('panel')
  @yield('header')
  @yield('container')
  @yield('footer')
  <ul class="layui-fixbar">
    <li class="layui-icon" lay-type="bar1" style="background-color:#009688">&#xe68e;</li>
    <li class="layui-icon" lay-type="bar1" style="background-color:#009688">&#xe642;</li>
    <li class="layui-icon" lay-type="bar1" style="background-color:#009688">&#xe604;</li>

  </ul>
<script>
layui.cache.page = '';
layui.cache.user = {
  username: '游客'
  ,uid: -1
  ,avatar: "{{asset('/Main/images/avatar/00.jpg')}}"
  ,experience: 83
  ,sex: '男'
};
layui.config({
  version: true
  ,base: "{{asset('/Main/res/mods')}}/" //这里实际使用时，建议改成绝对路径
  ,debug:true
}).extend({
  fly: 'index'
})
// .use(['fly','jie']);

</script>
<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id='cnzz_stat_icon_30088308'%3E%3C/span%3E%3Cscript src='" + cnzz_protocol + "w.cnzz.com/c.php%3Fid%3D30088308' type='text/javascript'%3E%3C/script%3E"));</script>
</body>
</html>