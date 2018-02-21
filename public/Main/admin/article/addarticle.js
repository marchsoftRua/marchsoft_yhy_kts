layui.use(['form','layer','layedit','laydate','upload'],function(){
    var form = layui.form
        layer = parent.layer === undefined ? layui.layer : top.layer,
        laypage = layui.laypage,
        upload = layui.upload,
        layedit = layui.layedit,
        laydate = layui.laydate,
        select_val = 0,
        $ = layui.jquery;

    

    //上传缩略图
    upload.render({
        elem: '.thumbBox',
        url: '/add/image',
        field:'img',
        data:{
            '_token':$("#_token").val()
        },
        // method : "post",  //此处是为了演示之用，实际使用中请将此删除，默认用post方式提交
        done: function(res, index, upload){
            console.log(res);
            $('.thumbImg').attr('src',res.data.src) 
        },
        before:function(data){
            console.log(data)
        },
    });

    //格式化时间
    function filterTime(val){
        if(val < 10){
            return "0" + val;
        }else{
            return val;
        }
    }
    //定时发布
    var time = new Date();
    var submitTime = time.getFullYear()+'-'+filterTime(time.getMonth()+1)+'-'+filterTime(time.getDate())+' '+filterTime(time.getHours())+':'+filterTime(time.getMinutes())+':'+filterTime(time.getSeconds());
    laydate.render({
        elem: '#release',
        type: 'datetime',
        trigger : "click",
        done : function(value, date, endDate){
            submitTime = value;
        }
    });
    form.on("radio(release)",function(data){
        if(data.elem.title == "定时发布"){
            $(".releaseDate").removeClass("layui-hide");
            $(".releaseDate #release").attr("lay-verify","required");
        }else{
            $(".releaseDate").addClass("layui-hide");
            $(".releaseDate #release").removeAttr("lay-verify");
            submitTime = time.getFullYear()+'-'+(time.getMonth()+1)+'-'+time.getDate()+' '+time.getHours()+':'+time.getMinutes()+':'+time.getSeconds();
        }
    });

    form.verify({
        newsName : function(val,item){
            if(val == ''){
                return "文章标题不能为空";
            }
        },
        content : function(val,item){
            console.log(layedit.getContent(editIndex))
            if(layedit.getContent(editIndex) == ''){
                return "文章内容不能为空";
            }
        }
    })

    function addType()
    {
        var index = layer.open({
            title:'添加类型',
            content:'/add/type',
            type:2,
            shade:0.4,
            resize:false,
            anim:1
        })
        // layui.layer.full(index);
        // //改变窗口大小时，重置弹窗的宽高，防止超出可视区域（如F12调出debug的操作）
        // $(window).on("resize",function(){
        //     layui.layer.full(index);
        // })
    }

    form.on('select(type)', function(data){
        select_val = data.value
        if(data.value == 'add')
        {
            addType()
        }
    }); 

    form.on("submit(addNews)",function(data){
        //截取文章内容中的一部分文字放入文章摘要
        var abstract = layedit.getText(editIndex).substring(0,50);
        //弹出loading
        var index = top.layer.msg('数据提交中，请稍候',{icon: 16,time:false,shade:0.8});
        // 实际使用时的提交信息
        $.ajax({
            url:'/add/article',
            type:'post',
            data:{
                _token:$("#_token").val(),
                title : $(".newsName").val(),  //文章标题
                abstract : $(".abstract").val(),  //文章摘要
                content : layedit.getContent(editIndex),  //文章内容
                imgpath : $(".thumbImg").attr("src"),  //缩略图
                type : select_val,    //文章分类
                newsStatus : $('.newsStatus select').val(),    //发布状态
                newsTime : submitTime,    //发布时间
                // newsTop : data.filed.newsTop == "on" ? "checked" : "",    //是否置顶
            },
            success:function(msg){
                layer.msg(msg);
            },
            error:function(msg){
                layer.msg(msg);
            },
        })
    })

    //预览
    form.on("submit(look)",function(){
        layer.alert("此功能需要前台展示，实际开发中传入对应的必要参数进行文章内容页面访问");
        return false;
    })
    //用于同步编辑器内容到textarea
    layedit.sync(editIndex);
    //创建一个编辑器
    var editIndex = layedit.build('news_content',{
        height : 535,
        uploadImage : {
            url : "/add/image"
        }
    });
    form.render('select', 'type');
})