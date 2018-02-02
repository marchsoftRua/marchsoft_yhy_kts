layui.define(['element','jquery'],
	function(exports){
		// body...
		var $ = layui.jquery,
		element = layui.element,
		layId,
		Tab = function(){
			this.tabConfig = {
				closed : true,
				openTabNum : 10,
				tabFilter : "bodyTab"
			}
		};
		var Session = window.sessionStorage;
		var menu = [];
		var curmenu = null;
		var that = new Tab();
		//获得tab的图标
		Tab.prototype.getTitle = function(navObj)
		{
			return $(navObj).find("cite").text()
		}

		// Tab.prototype.addToSession = function(navObj)
		// {
			// var menu = $.session.get('muen')
			// var curmenu = {
			// 	"icon" : navObj.find("i.iconfont").attr("data-icon")!=undefined ? navObj.find("i.iconfont").attr("data-icon") : navObj.find("i.layui-icon").attr("data-icon"),
			// 	"title" : navObj.find("cite").text(),
			// 	"href" : navObj.attr("data-url"),
			// 	"layId" : new Date().getTime()
			// }
			// menu.push(curmenu);
			// Session.setItem("menu",JSON.stringify(menu)); //打开的窗口
			// Session.setItem("curmenu",JSON.stringify(curmenu));  //当前的窗口
			// element.tabChange(that.tabConfig.tabFilter, that.getLayId(_this.find("cite").text()));
		// }

		//隐藏
		Tab.prototype.tabMove = function(){
			$(window).on("resize",function(event){
				var topTabsBox = $("#top_tabs_box"),
					topTabsBoxWidth = $("#top_tabs_box").width(),
					topTabs = $("#top_tabs"),
					topTabsWidth = $("#top_tabs").width(),
					tabLi = topTabs.find("li.layui-this"),
					top_tabs = document.getElementById("top_tabs"),
					event = event || window.event;

				if(topTabsWidth > topTabsBoxWidth){
					if(tabLi.position().left > topTabsBoxWidth || tabLi.position().left+topTabsBoxWidth > topTabsWidth){
						topTabs.css("left",topTabsBoxWidth-topTabsWidth);
					}else{
						topTabs.css("left",-tabLi.position().left);
					}
					//拖动效果
					var flag = false;
					var cur = {
					    x:0,
					    y:0
					}
					var nx,dx,x ;
					function down(){
					    flag = true;
					    var touch ;
					    if(event.touches){
					        touch = event.touches[0];
					    }else {
					        touch = event;
					    }
					    cur.x = touch.clientX;
					    dx = top_tabs.offsetLeft;
					}
					function move(){
						var self = this;
	                    if(flag){
							window.getSelection ? window.getSelection().removeAllRanges() : document.selection.empty();
					        var touch ;
					        if(event.touches){
					            touch = event.touches[0];
					        }else {
					            touch = event;
					        }
					        nx = touch.clientX - cur.x;
					        x = dx+nx;
					        if(x > 0){
					        	x = 0;
					        }else{
					        	 if(x < topTabsBoxWidth-topTabsWidth){
					        	 	x = topTabsBoxWidth-topTabsWidth;
					        	 }else{
					        	 	x = dx+nx;
					        	 }
					        }
					        top_tabs.style.left = x +"px";
					        //阻止页面的滑动默认事件
					        document.addEventListener("touchmove",function(){
					            event.preventDefault();
					        },false);
					    }
					}
					//鼠标释放时候的函数
					function end(){
					    flag = false;
					}
					//pc端拖动效果
					topTabs.on("mousedown",down);
					topTabs.on("mousemove",move);
					$(document).on("mouseup",end);
					//移动端拖动效果
					topTabs.on("touchstart",down);
					topTabs.on("touchmove",move);
					topTabs.on("touchend",end);
				}else{
					//移除pc端拖动效果
					topTabs.off("mousedown",down);
					topTabs.off("mousemove",move);
					topTabs.off("mouseup",end);
					//移除移动端拖动效果
					topTabs.off("touchstart",down);
					topTabs.off("touchmove",move);
					topTabs.off("touchend",end);
					topTabs.removeAttr("style");
					return false;
				}
			}).resize();
		}

		//添加tab方法
		Tab.prototype.addTab = function(navObj){
			that.setNav(navObj)
			let titleName = that.getTitle($(navObj))
			var the_id = $($(navObj).find('a').context).attr('data-id')
			if(!(that.hasTab(titleName)))
			{
				element.tabAdd(that.tabConfig.tabFilter, {
				  title: that.setTitle(navObj),
				  content: "<iframe src='"+navObj.attr("data-url")+"'></frame>", //支持传入html
				  id: the_id,
				});
				console.log(the_id)
				element.tabChange(that.tabConfig.tabFilter,the_id);
			}
			that.updataThisNav(navObj)
		}

		Tab.prototype.updataThisNav = function($thisNav)
		{

			$thisNav = $thisNav?$thisNav:$('.layui-tab-title.top_tab li.layui-this')
			curmenu = {
						"icon" : $($thisNav.find('i.layui-icon')[0]).text(),
						"title" : $thisNav.find("cite").text(),
						"href" : $thisNav.attr("data-url"),
						"layId" : $thisNav.attr('data-id')
					};
			Session.setItem('curmenu',JSON.stringify(curmenu));
		}

		//点击上方导航栏切换
		$("body").on("click",".top_tab li",function(){
			var cite = $(this).find('cite').text()
			$('ul.layui-nav.layui-nav-tree li.layui-nav-item.side-nav').each(function(){
				if($(this).find('cite').text() == cite){
					that.updataThisNav($(this).find('a'))
				}
			})
			

		})

		//点击左侧侧边栏
		$("body").on("click",".layui-nav li",function(){
			that.updataThisNav($(this).find('a'))
			var cite = $(this).find('cite').text()
			var selectId = 0;
			$('.layui-tab-title.top_tab li').each(function(){
				if($(this).find('cite').text()==cite)
				{
					selectId = $(this).attr('lay-id');
				}
			});
			for(let i = 0;i<menu.length;i++)
			{
				if(menu[i]['layId'] == curmenu['layId'])
				{
					element.tabChange(that.tabConfig.tabFilter,selectId)
					return;
				}
			}
			menu.push(curmenu);
			Session.setItem('menu',JSON.stringify(menu));
			element.tabChange(that.tabConfig.tabFilter,curmenu.layId)
		})

		Tab.prototype.setTitle = function(navObj,icon = null,cite = null)
		{
			var title = '';
			if(icon==null)
				var icon = navObj.find("i.layui-icon").attr("data-icon");
			if(cite==null)
				cite = navObj.find("cite").text();
			if(navObj)
				dataUrl = navObj.attr("data-url")
			else
				dataUrl = '/'
			title += '<i class="layui-icon " data-url='+dataUrl+' >'+icon+'</i>';
			title += '<cite>'+cite+'</cite>';
			title += '<i class="layui-icon layui-unselect layui-tab-close" data-id=12>&#x1006;</i>';
			return title;
		}

		Tab.prototype.setNav = function(navObj)
		{
			this.title = that.setTitle(navObj)
			// this.icon = $navObj
		}

		//通过title获取lay-id
		Tab.prototype.getLayId = function(title){
			$(".layui-tab-title.top_tab li").each(function(){
				if($(this).find("cite").text() == title){
					layId = $(this).attr("lay-id");
				}
			})
			return layId;
		}
		
		//初始化方法
		Tab.prototype.set = function(option) {
			var _this = this;
			$.extend(true, _this.tabConfig, option);
			return _this;
		};

		//是否具有这个标签
		Tab.prototype.hasTab = function(title){
			b_has = false;
			$(".layui-tab-title.top_tab li").each(function(){
				tabTitle = $(this).find("cite").text()
				if(tabTitle == title){
					b_has =  true;//标签栏已经含有标签
				}
			})
			return b_has;
		}
		
		//删除tab
		$("body").on("click",".top_tab li i.layui-tab-close",function(event){
			// curmenu_layId = curmenu.layId
			element.tabDelete(that.tabConfig.tabFilter,$(this).parent("li").attr("lay-id")).init();
			//删除tab后重置session中的menu和curmenu
			
			thislayId = $(this).parent("li").attr('lay-id');
			for(let i = 0;i<menu.length;i++)
			{
				if(curmenu!=null&&curmenu.layId == thislayId)
				{
					curmenu = null;
				}
				if(menu[i]['layId'] == thislayId)
				{
					menu.splice(i,1);
					curmenu = menu[0]

					break;
				}
			}
			Session.setItem('menu',JSON.stringify(menu));
			Session.setItem('curmenu',JSON.stringify(curmenu));
			event.stopPropagation();
		})
		//读取session初始化选项卡
		function readSession()
		{
			menu = JSON.parse(Session.getItem('menu'));

			if(menu==null)
				menu = []
			for(let i=0;i<menu.length;i++)
			{
				element.tabAdd(that.tabConfig.tabFilter,{
					title:that.setTitle(null,menu[i].icon,menu[i].title),
					content: "<iframe src='"+ menu[i].href +"'></frame>",
					id:menu[i].layId
				})
			}
			curmenu_str = Session.getItem('curmenu');
			if(curmenu_str!="undefined")
			{
				curmenu = JSON.parse(curmenu_str);
				if(curmenu!=undefined)
				element.tabChange(that.tabConfig.tabFilter,curmenu.layId)
			}
				
		}

		readSession();

		element.render('tab');

		element.tabChange(that.tabConfig.tabFilter,$(this).attr("lay-id")).init();

		exports("Tab",function(option){
			return Tab.prototype.set();
		});
	}
)