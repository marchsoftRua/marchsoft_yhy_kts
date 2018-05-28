layui.use(["jquery"],function(){
	var $ = layui.jquery;
	console.log('main.js')
	$(".upload-video-box").on("dragover",function(event){
  		event.preventDefault();  
	    event.stopPropagation();
	    console.log(1)
  	})
	$(".upload-video-box").on("dragleave",function(event){
  		event.preventDefault();  
	    event.stopPropagation();
	    console.log(2)
  	})
  	$(".upload-video-box").on("drop",function(event){
  		event.preventDefault();  
	    event.stopPropagation();
	    
  	})
})