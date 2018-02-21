layui.use(['table','layer','jquery'],function(){
	var table = layui.table,
	$ = layui.jquery,
	layer = layui.layer;

	function addType()
	{
		console.log('asds')
		var index = layer.open({
			title:'添加类型',
			type : 2,
			content:'/add/type',
			area: '500px'
		});
	}


    $(".addType").click(function(){
        addType();
    })

})