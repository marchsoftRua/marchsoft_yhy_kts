layui.config({
	base : module_path
}).use(['jquery','element','layer'],function(){
	var layer = parent.layer === undefined ? layui.layer : parent.layer,
	element = layui.element,
	$ = layui.jquery;

	$.get('../sidenav',
		function(data)
		{
			if($(".navBar").html() == ''){
				var _this = this;
				$(".navBar").html(navBar(data)).height($(window).height()-230);
				element.init();  //初始化页面元素
				$(window).resize(function(){
					$(".navBar").height($(window).height()-230);
				})
			}
		})
	}
)