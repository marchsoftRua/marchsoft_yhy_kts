layui.use(['table','layer','jquery'],function(){
	var table = layui.table,
	$ = layui.jquery,
	layer = layui.layer;

	function addType()
	{
		var index = layer.open({
			title:'添加类型',
			type : 2,
			content:'/add/type',
		});
	}


    $(".addType").click(function(){
        addType();
    })

})