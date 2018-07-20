<!DOCTYPE html>
<html>
<head>
	<title视频上传</title>
	@include('main::admin.layouts.script')
	<link rel="stylesheet" type="text/css" href="{{asset('Main/admin/video/video.css')}}">
	<link rel="stylesheet" href="{{asset('Main/admin/video/easyUpload/easy-upload.css')}}">
</head>
<body class="childrenBody">
<form class="layui-form layui-row flex-center" id="video-from">
	<input type="hidden" id="_token" value="{{ csrf_token() }}">

	<div class="layui-col-md3 layui-col-xs12 user_right layui-hide" id="videoImageBox">
		<div class="layui-upload-list">
			<img class="layui-upload-img videoImg userAvatar" style="max-height: 200px;" id="videoImage">
		</div>
		<button type="button" class="layui-btn layui-btn-primary videoImg"><i class="layui-icon">&#xe67c;</i>点击上传封面</button>
	</div>

	<div class="layui-col-md6 layui-col-xs12" >
		<div class="layui-form-item">
			<label class="layui-form-label">选择上传方式</label>
			<div class="layui-input-block">
				<select name="manner" lay-filter="manner">
				  <option value="1" selected>链接上传</option>
				  <option value="2">直接上传</option>
				</select>  
			</div>
		</div>
		<div id="linksend" class="layui-anim layui-anim-upbit">
			<div class="layui-form-item">
				<label class="layui-form-label">链接地址</label>
				<div class="layui-input-block">
					<input type="text" id="video-link" placeholder="例如　https://www.bilibili.com/video/av20205319/"　 class="layui-input">
				</div>
				
			</div>
			<div id="getvideo" class="layui-anim layui-anim-upbit layui-hide">
				<div class="layui-form-item">
					<label class="layui-form-label">视频名称</label>
					<div class="layui-input-block">
						<input type="text" id="link-name" class="layui-input">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">视频简介</label>
					<div class="layui-input-block">
						<textarea id="link-outline" placeholder="请输入" class="layui-textarea"></textarea>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button type="button" class="layui-btn" id="link-look">预览视频</button>
						<button type="reset" class="layui-btn layui-btn-primary">重置</button>
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-input-block">
						<button type="button" class="layui-btn layui-btn-normal" id="link-upload">上传视频</button>
					</div>
				</div>
			</div>
		</div>
		<div id="uploadsend" class="layui-hide layui-anim layui-anim-upbit">
			<div class="layui-form-item">
				<div class="upload-video-box layui-input-block">
					<div id="easyContainer" style="width: 100%;"></div>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">视频名称</label>
				<div class="layui-input-block">
					<input type="text" placeholder="最多５０个汉字!" class="layui-input" id="upload-name">
				</div>
			</div>
			
			<div class="layui-form-item">
				<label class="layui-form-label">视频类型</label>
				<div class="layui-input-block">
					<select name="type" lay-filter="articletype" id='type_select' lay-search>
						<option value='' >请选择一个类型</option>
						@foreach($types as $type)
							@isset($article)
								@if($article->type_id==$type->id)
									<option value="{{$type->id}}" selected>{{$type->type_name}}</option>
									@continue
								@endif
				        		
				        	@endisset
				        	<option value="{{$type->id}}">{{$type->type_name}}</option>
				        @endforeach
				        	<option value = 'add'>&#xe654;添加一个类型</option>
			      	</select>
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label">视频简介</label>
				<div class="layui-input-block">
					<textarea placeholder="在这里写下视频的简介，不要超过１2０字哟～！" class="layui-textarea myself" id="upload-outline"></textarea>
				</div>
			</div>

			<div class="layui-form-item">
				<div class="layui-input-block">
					<button type="button" class="layui-btn" id="upload-send">发布视频</button>
					<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				</div>
			</div>

		</div>
	</div>
</form>
<script type="text/javascript" src="{{asset('Main/admin/video/addVideo.js')}}"></script>
<script type="text/javascript" src="{{asset('Main/admin/video/easyUpload/vendor/jquery-1.12.4.min.js')}}"></script>
<script src="{{asset('Main/admin/video/easyUpload/vendor/jquery.cookie-1.4.1.min.js')}}"></script>
<script src="{{asset('Main/admin/video/easyUpload/easyUpload.js')}}"></script>
</body>
</html>