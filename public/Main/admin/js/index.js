layui.config({
    base : module_path
}).use(['jquery','element','layer','Tab'],function(){

	var layer = parent.layer === undefined ? layui.layer : parent.layer,
	element = layui.element,
	$ = layui.jquery;
	tab = layui.Tab();

	$.get('sidenav',
		function(data)
		{
			var _this = this;
			$(".navBar").html(navBar(data)).height($(window).height()-230);

			element.init();  //初始化页面元素
			$(window).resize(function(){
				$(".navBar").height($(window).height()-230);
			})
			$(".layui-nav .layui-nav-item a").on("click",function(){
				addTab($(this));
				$(this).parent("li").siblings().removeClass("layui-nav-itemed");
			})
		})

	//手机设备的简单适配
	var treeMobile = $('.site-tree-mobile'),
		shadeMobile = $('.site-mobile-shade')

	treeMobile.on('click', function(){
		$('body').addClass('site-mobile');
	});

	shadeMobile.on('click', function(){
		$('body').removeClass('site-mobile');
	});

	//添加新窗口
	$(".hideMenu").click(function(){
		if($(".topLevelMenus li.layui-this a").data("url")){
			layer.msg("此栏目状态下左侧菜单不可展开");  //主要为了避免左侧显示的内容与顶部菜单不匹配
			return false;
		}
		$(".layui-layout-admin").toggleClass("showMenu");
		//渲染顶部窗口
		tab.tabMove();
	})


	// $("a").on("click",function(){
	// 	layer.msg("添加tab");
	// 	// element.tabAdd(filter, options);
	// 	addTab($(this));
	// 	$(this).parent("li").siblings().removeClass("layui-nav-itemed");
	// })
	$(".clearCache").click(function(){
		window.sessionStorage.clear();
        window.localStorage.clear();
        var index = layer.msg('清除缓存中，请稍候',{icon: 16,time:false,shade:0.8});
        setTimeout(function(){
            layer.close(index);
            layer.msg("缓存清除成功！");
        },1000);
    })


		//公告层
    function showNotice(){
        layer.open({
            type: 1,
            title: "系统公告",
            area: '300px',
            shade: 0.8,
            id: 'LAY_layuipro',
            btn: ['火速围观'],
            moveType: 1,
            content: '<div style="padding:15px 20px; text-align:justify; line-height: 22px; text-indent:2em;border-bottom:1px solid #e2e2e2;"><p class="layui-red">请使用模版前请务必仔细阅读首页右下角的《更新日志》，避免使用中遇到一些简单的问题造成困扰。</p></pclass></p><p>1.0发布以后发现很多朋友将代码上传到各种素材网站，当然这样帮我宣传我谢谢大家，但是有部分朋友上传到素材网站后将下载分值设置的相对较高，需要朋友们充钱才能下载。本人发现后通过和站长、网站管理员联系以后将分值调整为不需要充值才能下载或者直接免费下载。在此郑重提示各位：<span class="layui-red">本模版已进行作品版权证明，不管以何种形式获取的源码，请勿进行出售或者上传到任何素材网站，否则将追究相应的责任。</span></p></div>',
            success: function(layero){
                var btn = layero.find('.layui-layer-btn');
                btn.css('text-align', 'center');
                btn.on("click",function(){
                    tipsShow();
                });
            },
            cancel: function(index, layero){
                tipsShow();
            }
        });
    }
    function tipsShow(){
        window.sessionStorage.setItem("showNotice","true");
        if($(window).width() > 432){  //如果页面宽度不足以显示顶部“系统公告”按钮，则不提示
            layer.tips('系统公告躲在了这里', '#userInfo', {
                tips: 3,
                time : 1000
            });
        }
    }



    $(".showNotice").on("click",function(){
        showNotice();
    })


    if(window.sessionStorage.getItem("lockcms") != "true" && window.sessionStorage.getItem("showNotice") != "true")
    {
    	showNotice();
    }
})


// 打开新窗口

function addTab(_this)
{
    tab.addTab(_this);
}