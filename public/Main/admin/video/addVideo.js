layui.use(['form','layer','jquery','table','laytpl','upload'],function(){
	var form = layui.form,
	layer = layui.layer,
	table = layui.table,
	laytpl = layui.laytpl,
	$ = layui.jquery,
	_token = $('#_token').val(),
	cid = null,
	aid = null,
	videoUrl = null,//暂存视频地址　用来判断是否改变　需要不需要重新加载
	upload = layui.upload;

	var uploadInst = upload.render({
	    elem: '.userFaceBtn', //绑定元素
	    url: '/changeImage', //上传接口
	    method : "post",  //此处是为了演示之用，实际使用中请将此删除，默认用post方式提交
        accept:'images',
        field:'img',
        dataType:'json',
        data:{
            '_token':_token
        },
        done:function(msg){
            layer.msg(msg.msg);
            $('#userFace').attr('src',msg.data['url']);
            window.sessionStorage.setItem('userFace',msg.data['url']);
        },
        error:function(msg){

        },
  	});
  	form.on('select(manner)', function(data){
	  if(data.value==1)
	  {
	  	if($('#linksend').hasClass('layui-hide'))
	  	{
	  		$('#linksend').removeClass('layui-hide');
	  	}
	  	$('#uploadsend').addClass('layui-hide');
	  }
	  else
	  {
	  	if($('#uploadsend').hasClass('layui-hide'))
	  	{

	  		$('#uploadsend').removeClass('layui-hide');
	  	}
	  	$('#linksend').addClass('layui-hide ');
	  }
	});

	$('#video-link').click(function(e){
			var index = layer.tips('优先推荐bilibili。', '#video-link', {
		  tips: [1, '#3595CC'],
		  time: 1500
		});
		
		
	});
	$('#link-look').click(function(e){
		var index = layer.open({
			type:2,
			shadeClose:true,
			content:"https://player.bilibili.com/player.html?aid="+aid+"&cid="+cid+"&page=1"
		})
		layer.full(index)
		$(window).on("resize",function(){
            layer.full(index);
        })
	})
	/*
	通过后台返回的数据设置前台视频样式
	img:视频封面
	ｎａｍｅ：视频名称
	ｏｕｔｌｉｎｅ：视频概要
	*/
	function setVideo(img,name,outline){
		$('#link-name').val(name)
		$('#link-outline').val(outline)
		$('#userFace').attr('src',img)
		$('#getvideo').removeClass('layui-hide')
	}


	$('#video-link').blur(function(){
		var val = $('#video-link').val();
		if(videoUrl==val)
			return
		else
			videoUrl = val
		var pattern = /av[0-9]*/g;
		
		var url = "/info/video";//比比汗丽丽的接口
		// var url = "http://9bl.bakayun.cn/API/GetVideoInfo.php" 
		//例如http://9bl.bakayun.cn/API/GetVideoInfo.php?aid=4143031&p=1&type=json
		if(val!=""&&pattern.test(val))
		{
			var index = layer.load(1, {shade: 0.6,time:3000});
			var pattern = /(?<=av)[0-9]*/g;
			aid = pattern.exec(val)[0];
			$.ajax({
				url:url,
				method:'get',
				dataType:'json',
				data:{
					aid:aid,
					'_token':_token,
					type:'json'
				},
				success:function(data){
					layer.close(index)
					console.log(data)
					setVideo(data.images[0],data.title,data.description)
					cid = data.cid
				}
			});
		}
		else
		{
			layer.close(index);
			if($(this).val()!=""){
					layer.tips('输入不合法。', '#video-link', {
				  tips: [1, '#FF5722'],
				  time: 1500
				});
			}
			
		}

		
		// $.ajax({
		// 	url:''
		// });
	});
});