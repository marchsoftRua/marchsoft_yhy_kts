<!DOCTYPE html>
<html>
<head>
	<title视频上传</title>
	@include('main::admin.layouts.script')
</head>
<body class="childrenBody">
<form class="layui-form layui-row">
	<input type="hidden" id="_token" value="{{ csrf_token() }}">
	<div class="layui-col-md3 layui-col-xs12 user_right">
		<div class="layui-upload-list">
			<img class="layui-upload-img userFaceBtn userAvatar" style="max-height: 200px;" id="userFace">
		</div>
		<button type="button" class="layui-btn layui-btn-primary userFaceBtn"><i class="layui-icon">&#xe67c;</i>点击上传封面</button>
	</div>
	<div class="layui-col-md6 layui-col-xs12">
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
				<label class="layui-form-label">用户名</label>
				<div class="layui-input-block">
					<input type="text" value="驊驊龔頾" disabled class="layui-input layui-disabled">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">用户组</label>
				<div class="layui-input-block">
					<input type="text" value="超级管理员" disabled class="layui-input layui-disabled">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">真实姓名</label>
				<div class="layui-input-block">
					<input type="text" value="" placeholder="请输入真实姓名" lay-verify="required" class="layui-input realName">
				</div>
			</div>
			<div class="layui-form-item" pane="">
				<label class="layui-form-label">性别</label>
				<div class="layui-input-block userSex">
					<input type="radio" name="sex" value="男" title="男" checked="">
					<input type="radio" name="sex" value="女" title="女">
					<input type="radio" name="sex" value="保密" title="保密">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">手机号码</label>
				<div class="layui-input-block">
					<input type="tel" value="" placeholder="请输入手机号码" lay-verify="phone" class="layui-input userPhone">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">出生年月</label>
				<div class="layui-input-block">
					<input type="text" value="" placeholder="请输入出生年月" lay-verify="userBirthday" readonly class="layui-input userBirthday">
				</div>
			</div>
			<div class="layui-form-item userAddress">
				<label class="layui-form-label">家庭住址</label>
				<div class="layui-input-inline">
					<select name="province" lay-filter="province" class="province">
						<option value="">请选择市</option>
					</select>
				</div>
				<div class="layui-input-inline">
					<select name="city" lay-filter="city" disabled>
						<option value="">请选择市</option>
					</select>
				</div>
				<div class="layui-input-inline">
					<select name="area" lay-filter="area" disabled>
						<option value="">请选择县/区</option>
					</select>
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">掌握技术</label>
				<div class="layui-input-block userHobby">
					<input type="checkbox" name="like[javascript]" title="Javascript">
					<input type="checkbox" name="like[C#]" title="C#">
					<input type="checkbox" name="like[php]" title="PHP">
					<input type="checkbox" name="like[html]" title="HTML(5)">
					<input type="checkbox" name="like[css]" title="CSS(3)">
					<input type="checkbox" name="like[.net]" title=".net">
					<input type="checkbox" name="like[ASP]" title="ASP">
					<input type="checkbox" name="like[Angular]" title="Angular">
					<input type="checkbox" name="like[VUE]" title="VUE">
					<input type="checkbox" name="like[XML]" title="XML">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">邮箱</label>
				<div class="layui-input-block">
					<input type="text" value="" placeholder="请输入邮箱" lay-verify="email" class="layui-input userEmail">
				</div>
			</div>
			<div class="layui-form-item">
				<label class="layui-form-label">自我评价</label>
				<div class="layui-input-block">
					<textarea placeholder="请输入内容" class="layui-textarea myself"></textarea>
				</div>
			</div>
			<div class="layui-form-item">
				<div class="layui-input-block">
					<button class="layui-btn" lay-submit="" lay-filter="changeUser">立即提交</button>
					<button type="reset" class="layui-btn layui-btn-primary">重置</button>
				</div>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript" src="{{asset('Main/admin/video/addVideo.js')}}"></script>
</body>
</html>