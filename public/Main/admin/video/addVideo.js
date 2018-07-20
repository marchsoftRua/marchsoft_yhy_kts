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
	linkImgUrl = '',
	upImgUrl = '',
	upload = layui.upload,
	uploadVideoList = Array(),
	fromData = new FormData();//一个ｆｒｏｍｄａｔａ对象

	var uploadInst = upload.render({
	    elem: '.videoImg', //绑定元素
	    url: '/add/image', //缓存并显示
	    method : "post",  //此处是为了演示之用，实际使用中请将此删除，默认用post方式提交
        accept:'images',
        field:'img',
        dataType:'json',
        data:{
            '_token':_token
        },
        done:function(msg){
            layer.msg(msg.msg);
            $('#videoImage').attr('src',msg.data['src']);
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

  	/*
		拖拽
  	*/
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


//选择框事件
  	form.on('select(manner)', function(data){
	  if(data.value==1)//链接上传
	  {
	  	if($('#linksend').hasClass('layui-hide'))
	  	{
	  		$('#linksend').removeClass('layui-hide');
	  		if(!linkGet)
	  			hideVideoImage()
	  		if(linkImgUrl)
	  			$('#videoImage').attr('src',linkImgUrl)
	  	}
	  	$('#uploadsend').addClass('layui-hide');
	  }
	  else
	  {
	  	if($('#uploadsend').hasClass('layui-hide'))
	  	{
	  		$('#uploadsend').removeClass('layui-hide');
	  		showVideoImage()
	  		if(!upImgUrl)
	  			$('#videoImage').removeAttr('src')
	  		else
	  			$('#videoImage').attr('src',upImgUrl)
	  	}
	  	$('#linksend').addClass('layui-hide ');
	  }
	});

  	function showVideoImage()
  	{
  		$("#video-from").removeClass("flex-center")
  		$("#videoImageBox").removeClass("layui-hide")
  	}

  	function hideVideoImage()
  	{
		$("#video-from").addClass("flex-center")
  		$("#videoImageBox").addClass("layui-hide")
  	}

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
		showVideoImage()
		linkImgUrl = img
		$('#link-name').val(name)
		$('#link-outline').val(outline)
		$('#videoImage').attr('src',linkImgUrl)
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


    function sendType(text,index,elem)
    {
        let this_ajax = $.ajax({
            url:'/add/type',
            method:'post',
            dataType:'json',
            data:{
                    'name':text,
                    '_token':$("#_token").val()
                },
            beforeSend:function(ajax){
                if(text.length<2)
                {
                    layer.tips('兄弟,类型至少得一个字符以上。',elem, {
                      tips: [1, '#3595CC'],
                      time: 2500
                    });
                    ajax.abort()
                }
            },
            success:function(msg){
                layer.msg(msg.msg);
                var id = msg.data.id;
                layer.close(index);
                selectNewType(id,text);
            },
            error:function(msg){
                layer.msg("出现了某种错误，请刷新!");
                layer.close(index);
            },

        })
    }

    function selectNewType(id,val)//增加类型
    {
        elem = $("#type_select").children(":first");
        elem.after("<option value="+id+">"+val+"</option>")
        form.render()
    }

    function addType()
    {

        layer.prompt({title: '添加类型', formType: 0,maxlength: 10}, function(text, index,elem){
            sendType(text,index,elem);
        });
    }

    form.on('select(articletype)', function(data){
        select_val = data.value
        if(data.value == 'add')
        {
            addType()
        }
    });

    /*直传*/
    $("#upload-send").click(function(){

    	if(checkUpload())//检查是否正确填写
    	$.ajax({
    		url:'/upload/video',
    		data:{
    			_token: _token,
    			name : $('#upload-name').val(),
    			description : $('#upload-outline').val(),
    			type : $('#type_select').val(),
    			pathList:uploadVideoList,
    			img : $("#videoImage").attr("src")
    		},
    		type:'post',
			dataType:'json',
			success:function(res){
				layer.msg(res.data)
			},
			error:function(res){
				console.log(res)
			},
    	})
    })

    function checkUpload()//上传前的检查
    {
    	var nameLen = $('#upload-name').val().length;
    	var descriptionLen = $('#upload-outline').val().length
    	if(nameLen > 50){
    		layer.msg("视频名称过长！")
    		return false
    	}
    	if(nameLen==0){
    		layer.msg("请填写视频名称!")
    		return false
    	}
    	if(!$('#type_select').val())
    	{
    		layer.msg("请选择视频类型！")
    		return false
    	}
    	if(descriptionLen > 120){
    		layer.msg("视频描述过长！")
    		return false
    	}
    	if(!uploadVideoList.length>0){
    		layer.msg("请先上传一个视频！")
    		return false
    	}
    	return true;
    }


	$('#easyContainer').easyUpload({
	  allowFileTypes: '*.mp4;*.flv;*.avi',//允许上传文件类型，格式';*.doc;*.pdf'
	  allowFileSize: 100000,//允许上传文件大小(KB)
	  selectText: '选择文件',//选择文件按钮文案
	  multi: false,//是否允许多文件上传
	  // multiNum: 5,//多文件上传时允许的文件数
	  showNote: true,//是否展示文件上传说明
	  note: '提示：支持格式仅为视频(.mp4,.flv,.avi)',//文件上传说明
	  showPreview: true,//是否显示文件预览
	  url: '/cache/video',//上传文件地址
	  fileName: 'file',//文件filename配置参数
	  formParam: {
	    _token: _token//不需要验证token时可以去掉
	  },//文件filename以外的配置参数，格式：{key1:value1,key2:value2}
	  timeout: 30000,//请求超时时间
	  successFunc: function(res) {
	  	console.log(res)
		uploadVideoList.push(res.data[0])//保存视频地址
		$("#videoImage").attr("src",res.data[1])//设置封面

	  },//上传成功回调函数
	  errorFunc: function(res) {
	    console.log('失败回调', res);
	  },//上传失败回调函数
	  deleteFunc: function(res) {
	    console.log('删除回调', res);
	  }//删除文件回调函数
	});

});

