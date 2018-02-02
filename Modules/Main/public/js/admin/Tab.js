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

		Tab.prototype.set = function(option) {
			var _this = this;
			$.extend(true, _this.tabConfig, option);
			return _this;
		};
		Tab.prototype.hasTab = function(title){
			var tabIndex = -1;
			$(".layui-tab-title.top_tab li").each(function(){
				if($(this).find("cite").text() == title){
					tabIndex = 1;
				}
			})
			return tabIndex;
		}


		exports("bodyTab",function(option){
			return bodyTab.set(option);
		});
	}
)