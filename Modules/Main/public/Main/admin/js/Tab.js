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
		layer.msg('asd')
		var Session = window.sessionStorage;
		var menu = [];
		var curmenu = null;
		var that = new Tab();
		//获得tab的图标
		Tab.prototype.getTitle = function(navObj)
		{
			return $(navObj).find("cite").text()
		}

    // //生成左侧菜单
	   //  Tab.prototype.navBar = function(strData){
	   //      var data;
	   //      if(typeof(strData) == "string"){
	   //          var data = JSON.parse(strData); //部分用户解析出来的是字符串，转换一下
	   //      }else{
	   //          data = strData;
	   //      }
	   //      var ulHtml = '';
	   //      for(var i=0;i<data.length;i++){
	   //          if(data[i].spread || data[i].spread == undefined){
	   //              ulHtml += '<li class="layui-nav-item layui-nav-itemed">';
	   //          }else{
	   //              ulHtml += '<li class="layui-nav-item">';
	   //          }
	   //          if(data[i].children != undefined && data[i].children.length > 0){
	   //              ulHtml += '<a>';
	   //              if(data[i].icon != undefined && data[i].icon != ''){
	   //                  if(data[i].icon.indexOf("icon-") != -1){
	   //                      ulHtml += '<i class="seraph '+data[i].icon+'" data-icon="'+data[i].icon+'"></i>';
	   //                  }else{
	   //                      ulHtml += '<i class="layui-icon" data-icon="'+data[i].icon+'">'+data[i].icon+'</i>';
	   //                  }
	   //              }
	   //              ulHtml += '<cite>'+data[i].title+'</cite>';
	   //              ulHtml += '<span class="layui-nav-more"></span>';
	   //              ulHtml += '</a>';
	   //              ulHtml += '<dl class="layui-nav-child">';
	   //              for(var j=0;j<data[i].children.length;j++){
	   //                  if(data[i].children[j].target == "_blank"){
	   //                      ulHtml += '<dd><a data-url="'+data[i].children[j].href+'" target="'+data[i].children[j].target+'">';
	   //                  }else{
	   //                      ulHtml += '<dd><a data-url="'+data[i].children[j].href+'">';
	   //                  }
	   //                  if(data[i].children[j].icon != undefined && data[i].children[j].icon != ''){
	   //                      if(data[i].children[j].icon.indexOf("icon-") != -1){
	   //                          ulHtml += '<i class="seraph '+data[i].children[j].icon+'" data-icon="'+data[i].children[j].icon+'"></i>';
	   //                      }else{
	   //                          ulHtml += '<i class="layui-icon" data-icon="'+data[i].children[j].icon+'">'+data[i].children[j].icon+'</i>';
	   //                      }
	   //                  }
	   //                  ulHtml += '<cite>'+data[i].children[j].title+'</cite></a></dd>';
	   //              }
	   //              ulHtml += "</dl>";
	   //          }else{
	   //              if(data[i].target == "_blank"){
	   //                  ulHtml += '<a data-url="'+data[i].href+'" target="'+data[i].target+'">';
	   //              }else{
	   //                  ulHtml += '<a data-url="'+data[i].href+'">';
	   //              }
	   //              if(data[i].icon != undefined && data[i].icon != ''){
	   //                  if(data[i].icon.indexOf("icon-") != -1){
	   //                      ulHtml += '<i class="seraph '+data[i].icon+'" data-icon="'+data[i].icon+'"></i>';
	   //                  }else{
	   //                      ulHtml += '<i class="layui-icon" data-icon="'+data[i].icon+'">'+data[i].icon+'</i>';
	   //                  }
	   //              }
	   //              ulHtml += '<cite>'+data[i].title+'</cite></a>';
	   //          }
	   //          ulHtml += '</li>';
	   //      }
	   //      return ulHtml;
	   //  }




		//添加tab方法
		Tab.prototype.addTab = function(navObj){
			that.setNav(navObj)
			let titleName = that.getTitle($(navObj))
			if(!(that.hasTab(titleName)))
			{
				let the_id = new Date().getTime();
				element.tabAdd(that.tabConfig.tabFilter, {
				  title: that.setTitle(navObj),
				  content: "<iframe src='"+navObj.attr("data-url")+"'></frame>", //支持传入html
				  id: the_id,
				});
				element.tabChange(that.tabConfig.tabFilter,the_id);
			}
			that.updataThisNav(navObj)
		}

		Tab.prototype.updataThisNav = function($thisNav)
		{
			$thisNav = $thisNav?$thisNav:$('.layui-tab-title.top_tab li.layui-this')
			console.log($thisNav.attr("data-url"))
			curmenu = {
						"icon" : $($thisNav.find('i.layui-icon')[0]).text(),
						"title" : $thisNav.find("cite").text(),
						"href" : $thisNav.attr("data-url"),
						"layId" : $thisNav.attr('lay-id')
					};
			Session.setItem('curmenu',JSON.stringify(curmenu));
		}

		//点击上方导航栏切换
		$("body").on("click",".top_tab li",function(){
			that.updataThisNav($(this))
		})
		//点击左侧侧边栏
		$("body").on("click",".layui-nav li",function(){
			that.updataThisNav()
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
			console.log(event)
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
					content: "<iframe src='/'></frame>",
					id:menu[i].layId
				})
			}
			curmenu_str = Session.getItem('curmenu');
			console.log(curmenu)
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