<!DOCTYPE html>
<html>
<head>
	<title>aaaaa</title>
	@include('main::admin.layouts.script')
	<script type="text/javascript" src="{{asset('Main/admin/article/addarticle.js')}}"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="childrenBody">
<form class="layui-form layui-row layui-col-space10" id="from-article">
	{{ csrf_field() }}
	<div class="layui-col-md9 layui-col-xs12">
		<div class="layui-row layui-col-space10">
			<div class="layui-col-md9 layui-col-xs7">
				<div class="layui-form-item magt3">
					<label class="layui-form-label">文章标题<span class="layui-badge-dot"></span></label>
					<div class="layui-input-block">
						<input type="text" class="layui-input newsName" lay-verify="newsName" name='title' placeholder="请输入文章标题">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">内容摘要</label>
					<div class="layui-input-block">
						<textarea placeholder="请输入内容摘要"  class="layui-textarea abstract" name='textpart'></textarea>
					</div>
				</div>
			</div>
			<div class="layui-col-md3 layui-col-xs5">
				<div class="layui-upload-list thumbBox mag0 magt3">
					<img class="layui-upload-img thumbImg">
				</div>
			</div>
		</div>
		<div class="layui-form-item magb0">
			<label class="layui-form-label">文章内容<span class="layui-badge-dot"></span></label>

			<div class="layui-input-block">
				<textarea class="layui-textarea layui-hide"  name="content" lay-verify="content" id="news_content"></textarea>
			</div>
		</div>
	</div>
	<div class="layui-col-md3 layui-col-xs12">
		<blockquote class="layui-elem-quote title"><i class="seraph icon-caidan"></i> 分类目录<span class="layui-badge-dot"></span></blockquote>
		<div class="border category">
			<select name="type" lay-filter="type">
				<option value='' >请选择一个类型</option>
				@foreach($types as $type)
		        	<option value="{{$type->type_id}}">{{$type->type_name}}</option>
		        @endforeach
	      	</select>
		</div>
		<blockquote class="layui-elem-quote title magt10"><i class="layui-icon">&#xe609;</i> 发布</blockquote>
		<div class="border">
			<div class="layui-form-item">
				<label class="layui-form-label"><i class="layui-icon">&#xe60e;</i> 状　态</label>
				<div class="layui-input-inline newsStatus">
					<select name="status" lay-verify="required">
						<option value="0">保存草稿</option>
						<option value="1">等待审核</option>
					</select>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label"><i class="layui-icon">&#xe609;</i> 发　布</label>
				<div class="layui-input-block">
					<input type="radio" name="release" title="立即发布" lay-skin="primary" lay-filter="release" checked />
					<input type="radio" name="release" title="定时发布" lay-skin="primary" lay-filter="release" />
				</div>
			</div>
			<div class="layui-form-item layui-hide releaseDate">
				<label class="layui-form-label"></label>
				<div class="layui-input-block">
					<input type="text" class="layui-input" id="release" placeholder="请选择日期和时间" readonly />
				</div>
			</div>
			<div class="layui-form-item openness">
				<label class="layui-form-label"><i class="seraph icon-look"></i> 公开度</label>
				<div class="layui-input-block">
					<input type="radio" name="openness" title="开放浏览" lay-skin="primary" checked />
					<input type="radio" name="openness" title="私密浏览" lay-skin="primary" />
				</div>
			</div>
			<div class="layui-form-item newsTop">
				<label class="layui-form-label"><i class="seraph icon-zhiding"></i> 置　顶</label>
				<div class="layui-input-block">
					<input type="checkbox" name="newsTop" lay-skin="switch" lay-text="是|否">
				</div>
			</div>
			<hr class="layui-bg-gray" />
			<div class="layui-right">
				<a class="layui-btn layui-btn-sm" lay-filter="addNews" lay-submit><i class="layui-icon">&#xe609;</i>发布</a>
				<a class="layui-btn layui-btn-primary layui-btn-sm" lay-filter="look" lay-submit>预览</a>
			</div>
		</div>
	</div>
</form>
</body>
</html>