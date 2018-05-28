layui.use(['form','layer','jquery','table','laytpl','upload'],function(){
	var form = layui.form,
	layer = layui.layer,
	table = layui.table,
	laytpl = layui.laytpl,
	$ = layui.jquery,
	_token = $('#_token').val(),
	cid = null,//数据必须ｉｄ
	aid = null,//同上
	videoUrl = null,//暂存视频地址　用来判断是否改变　需要不需要重新加载
	linkGet = false,//是否获取了正确ｕｒｌ
	upload = layui.upload,
	fromData = new FormData();//一个ｆｒｏｍｄａｔａ对象

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

  	$("#click-video").click(function(){
  		return $("#upload-video").click();
  	});

  	// $('.upload-video-box').on({
  	// 	drop:function(event){
		 //  		event.preventDefault();  
   //  			event.stopPropagation();
		 //  		console.log(event.originalEvent.dataTransfer.files);
	  // 		}
  	// 	},
  	// );
  	$(".upload-video-box").on("dragover",function(event){
  		event.preventDefault();  
	    event.stopPropagation();
  	})
	$(".upload-video-box").on("dragleave",function(event){
  		event.preventDefault();  
	    event.stopPropagation();
  	})
  	$(".upload-video-box").on("drop",function(event){
  		event.preventDefault();  
	    event.stopPropagation();
	    $('.upload-video-box')[0].files[0] = event.originalEvent.dataTransfer.files
	    videoSend();
  	});

  	function videoSend(){
  		fromData.append('video',$('.upload-video-box')[0].files[0]);
  		$.ajax({
  			url:'/upload/video',
  			type:'post',
  			dataType:'json',
  			data:fromData,
  			success:function(msg){

  			},
  			error:function(msg){

  			},
  		})
  	}
  	// var uploadVideo = upload.render({
  	// 	elem:'.upload-video-box',
  	// 	url:'/upload/video',
  	// 	method:'post',
  	// 	accept:'video',
  	// 	field:'video',
  	// 	auto:'false',
  	// 	dataType:'json',
  	// 	data:{
  	// 		'_token':_token
  	// 	},
  	// 	choose:function(msg){
  	// 		var formData = new FormData();
  	// 		formData.append('file', $('.upload-video-box')[0].files[0]);

			// $.ajax({
			//     url: '/upload/video',
			//     type: 'post',
			//     cache: false,
			//     data: formData,
			//     processData: false,
			//     contentType: false
			// }).done(function(res) {
			// }).fail(function(res) {});
  	// 	},
  	// });



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
	/*
	链接上传
	*/
	$('#link-upload').click(function(){
		if(!linkGet)
		{
			layer.tips('请填写正确的url地址，谢谢!', '#video-link', {
			  tips: [1, '#3595CC'],
			  time: 3000
			});
			return
		}
		if($('#link-name').val().length==0||$('#link-name').val().length>50){
			layer.tips('请按格式填写，名字的长度为0-50', '#link-name', {
			  tips: [1, '#3595CC'],
			  time: 3000
			});
			return
		}
		if($('#link-outline').val().length==0||$('#link-outline').val().length>120){
			layer.tips('请按格式填写，视频描述的长度为0-120', '#link-outline', {
			  tips: [1, '#3595CC'],
			  time: 3000
			});
			return
		}
		var index = layer.load(1, {shade: 0.6,time:3000});
		$.ajax({
			url:'/add/link/video',
			type:'post',
			dataType:'json',
			data:{
				'_token':_token,
				'img':$('#userFace').attr('src'),
				'video':"https://www.bilibili.com/video/av"+aid+"/",
				'name':$('#link-name').val(),
				'description':$('#link-outline').val(),
			},
			success:function(msg){
				layer.close(index);
				layer.msg('上传完成!');
			},
		})
	})

	$('#video-link').blur(function(){
		var val = $('#video-link').val();
		if(videoUrl==val)
			return
		else
			videoUrl = val
		var pattern = /av[0-9]*/g;
		
		var url = "/info/video";//比比汗丽丽的接口
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
					$('#video-link').val("https://www.bilibili.com/video/av"+aid+"/")
					layer.close(index);
					setVideo(data.images[0],data.title,data.description);
					cid = data.cid;
					linkGet = true;

				},
				error:function(){
					layer.close(index);
					linkGet = false;
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