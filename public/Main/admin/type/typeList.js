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

    table.on('tool(type)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
	  var data = obj.data; //获得当前行数据
	  var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
	  var tr = obj.tr; //获得当前行 tr 的DOM对象
	  if(layEvent === 'del'){ //删除
	    layer.confirm('真的删除行么', function(index){
	      obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
	      layer.close(index);
	      //向服务端发送删除指令
	    });
	  } else if(layEvent === 'edit'){ //编辑
	    //do something
	    
	    //同步更新缓存对应的值
	    obj.update({
	      username: '123'
	      ,title: 'xxx'
	    });
	  }
	});

})