
@extends('main::index.layouts.layout')

@include('main::index.layouts.header')
@include('main::index.layouts.panel')


@section('index')
@endsection
@section('container')
<body class="childrenBody">
	<div style="text-align: center; padding:11% 0;">
		<i class="layui-icon" style="line-height:20rem; font-size:20rem; color: #393D50;">&#xe61c;</i>
		<p style="font-size: 20px; font-weight: 300; color: #999;">我勒个去，页面被外星人挟持了!</p>
	</div>
</body>
@endsection

@include('main::index.layouts.footer')

