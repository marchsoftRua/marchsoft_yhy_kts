		
	<div class="layui-header header">
		<div class="layui-main mag0">
			<a href="#" class="logo">layuiCMS 2.0</a>
			<!-- 显示/隐藏菜单 -->
			<a href="javascript:;" class="seraph hideMenu icon-caidan"><i class="layui-icon" > &#xe65f;</i></a>
			<!-- 顶级菜单 -->
			<ul class="layui-nav mobileTopLevelMenus" mobile>
				<li class="layui-nav-item" data-menu="contentManagement">
					<a href="javascript:;"><i class="seraph icon-caidan"></i><cite>layuiCMS</cite></a>
					<dl class="layui-nav-child">
						<dd class="layui-this" data-menu="contentManagement"><a href="javascript:;"><i class="layui-icon" data-icon="&#xe63c;">&#xe63c;</i><cite>内容管理</cite></a></dd>
						<dd data-menu="memberCenter"><a href="javascript:;"><i class="seraph icon-icon10" data-icon="icon-icon10"></i><cite>用户中心</cite></a></dd>
						<dd data-menu="systemeSttings"><a href="javascript:;"><i class="layui-icon" data-icon="&#xe620;">&#xe620;</i><cite>系统设置</cite></a></dd>
						<dd data-menu="seraphApi"><a href="javascript:;"><i class="layui-icon" data-icon="&#xe705;">&#xe705;</i><cite>使用文档</cite></a></dd>
					</dl>
				</li>
			</ul>
			<ul class="layui-nav topLevelMenus" pc>
				<li class="layui-nav-item layui-this" data-menu="contentManagement">
					<a href="javascript:;"><i class="layui-icon" data-icon="&#xe63c;">&#xe63c;</i><cite>内容管理</cite></a>
				</li>
				<li class="layui-nav-item" data-menu="memberCenter" pc>
					<a href="javascript:;"><i class="seraph icon-icon10" data-icon="icon-icon10"></i><cite>用户中心</cite></a>
				</li>
				<li class="layui-nav-item" data-menu="systemeSttings" pc>
					<a href="javascript:;"><i class="layui-icon" data-icon="&#xe620;">&#xe620;</i><cite>系统设置</cite></a>
				</li>
				<li class="layui-nav-item" data-menu="seraphApi" pc>
					<a href="javascript:;"><i class="layui-icon" data-icon="&#xe705;">&#xe705;</i><cite>使用文档</cite></a>
				</li>
			</ul>
		    <!-- 顶部右侧菜单 -->
		    <ul class="layui-nav top_menu">
				<li class="layui-nav-item" pc>
					<a href="javascript:;" class="clearCache"><i class="layui-icon" data-icon="&#xe640;">&#xe640;</i><cite>清除缓存</cite><span class="layui-badge-dot"></span></a>
				</li>
				<li class="layui-nav-item lockcms" pc>
					<a href="javascript:;"><i class="seraph icon-lock"></i><cite>锁屏</cite></a>
				</li>
				<li class="layui-nav-item" id="userInfo">
					<a href="javascript:;"><img src="{{asset('Main/admin/images/face.jpg')}}" class="layui-nav-img userAvatar" width="35" height="35"><cite class="adminName">驊驊龔頾</cite></a>
					<dl class="layui-nav-child">
						<dd><a href="javascript:;" data-url="page/user/userInfo.html"><i class="seraph icon-ziliao" data-icon="icon-ziliao"></i><cite>个人资料</cite></a></dd>
						<dd><a href="javascript:;" data-url="page/user/changePwd.html"><i class="seraph icon-xiugai" data-icon="icon-xiugai"></i><cite>修改密码</cite></a></dd>
						<dd><a href="javascript:;" class="showNotice"><i class="layui-icon">&#xe645;</i><cite>系统公告</cite><span class="layui-badge-dot"></span></a></dd>
						<dd pc><a href="javascript:;" class="functionSetting"><i class="layui-icon">&#xe620;</i><cite>功能设定</cite><span class="layui-badge-dot"></span></a></dd>
						<dd pc><a href="javascript:;" class="changeSkin"><i class="layui-icon">&#xe61b;</i><cite>更换皮肤</cite></a></dd>
						<dd><a href="page/login/login.html" class="signOut"><i class="seraph icon-tuichu"></i><cite>退出</cite></a></dd>
					</dl>
				</li>
			</ul>
		</div>
	</div>
