layui.define(['layer', 'laytpl', 'form', 'element', 'upload', 'util'], function(exports){
  
  var $ = layui.jquery
  ,layer = layui.layer
  ,laytpl = layui.laytpl
  ,form = layui.form
  ,element = layui.element
  ,upload = layui.upload
  ,util = layui.util
  ,device = layui.device()
  var current_w_id = $('#theArticle').attr('name')
  ,DISABLED = 'layui-btn-disabled',childSortWay=1,orderRule = 0;
  var current_input=null;
  var current_page = 0;

    const GETCHILD = 1;
    const GETALL = 2;
  //阻止IE7以下访问
  if(device.ie && device.ie < 8){
    layer.alert('如果您非得使用 IE 浏览器访问Fly社区，那么请使用 IE8+');
  }
  
  layui.focusInsert = function(obj, str){
    var result, val = obj.value;
    obj.focus();
    if(document.selection){ //ie
      result = document.selection.createRange(); 
      document.selection.empty(); 
      result.text = str; 
    } else {
      result = [val.substring(0, obj.selectionStart), str, val.substr(obj.selectionEnd)];
      obj.focus();
      obj.value = result.join('');
    }
  };


  //数字前置补零
  layui.laytpl.digit = function(num, length, end){
    var str = '';
    num = String(num);
    length = length || 2;
    for(var i = num.length; i < length; i++){
      str += '0';
    }
    return num < Math.pow(10, length) ? str + (num|0) : num;
  };
  
  var fly = {

    //Ajax
    json: function(url, data, success, options){
      var that = this, type = typeof data === 'function';
      if(type){
        options = success
        success = data;
        data = {};
      }

      options = options || {};

      return $.ajax({
        type: options.type || 'post',
        dataType: options.dataType || 'json',
        data: data,
        url: url,
        success: function(res){

          if(res.status === 0) {
            success && success(res);
          } else {
            layer.msg(res.msg || res.code, {shift: 6});
            options.error && options.error();
          }
        }, error: function(e){
          layer.msg('请求异常，请重试', {shift: 6});
          options.error && options.error(e);
        }
      });
    }, 
    initAction:function(){
            form.on('submit(*)', function(data){
                if (fly.charLen(data.field.content)<5) {
                        layer.alert('太短')

                        return 0;
                }
                data.field.belong_id=current_w_id;
                data.field.toid=$(data.form).parent().attr('toid')||0
                data.field.p_id=$(data.form).parent().attr('name')
                data.field.content=fly.content_(data.field.content)
                $.ajax(
                        {
                            url:'/jie/sendComment',
                            type:'post',
                            data:data.field,
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            success:function(res) {
                                if (res.status==0) {
                                    data.form.getElementsByTagName('textarea')[0].value=''
                                    layer.alert('回复成功',function(){
                                    fly.getComments(GETALL,1,current_page,0,5,1);

                                    })
                                    // fly.getComments(GETALL,1,1,0,5,1);
                                }
                            },
                            error:function(){
                                    layer.alert('系统繁忙')
                            }

                      }
                    )
            })
            $('body').on('click','.reply_bt',function(event){
               var selEl = "#p_id_"+event.target.getAttribute("pid")
               var source = document.getElementById(selEl);
               $('.back').remove()
               var back =  $('#copyIn').clone(true)
               $(back).addClass('back')
               $(back).removeAttr("style")
               $(back).removeAttr("id")
               current_input = $(back).children()[0].getElementsByTagName('textarea')[0]
               $(current_input).val('')
               $(selEl).append(back)
               var p_id = $('.back').prev().attr('name')
               $('.back').attr('name',p_id)
               $('.back').attr('toid',event.target.getAttribute("toid"))
            })
            $('body').on('click','.praise',function(event){
                $.ajax(
                        {
                            url:'/jie/sendComment',
                            type:'post',
                            data:{
                              'praise_type':$(event.target).attr('p_type'),
                              'obj_id':$(event.target).attr('obj_id')
                            },
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            },
                            success:function(res) {
                                if (res.status==0) {
                                    data.form.getElementsByTagName('textarea')[0].value=''
                                    layer.alert('回复成功',function(){
                                    fly.getComments(GETALL,1,current_page,0,5,1);

                                    })
                                    // fly.getComments(GETALL,1,1,0,5,1);
                                }
                            },
                            error:function(){
                                    layer.alert('系统繁忙')
                            }

                      }
                    )
            })                console.log()
            })
            $('body').on('click','.childs-nav span',function(event){
                var Btn_type = $(event.target).attr('type')
                var p_id = $(event.target).parent().parent().prev().attr('pid')
                var c_id = $(event.target).parent().attr('c_id')
                // var current_w_id = current_w_id
                // console.log(c_id+"--"+current_w_id)
                if (Btn_type=='edit') {
                    alert(0)
                }else if(Btn_type=='del'){
                    layer.confirm('确定要删除该条评论吗？', {
                      btn: ['确定','取消'] //按钮
                    }, function(){
                        fly.deleteComment(current_w_id,p_id,c_id)
                    });
                }
            });
             $('body').on('click','.more',function(event){
                var obj = event.target
                var select = $(obj).parent().parent()
                console.log("p_id"+obj.name)
                fly.getComments(GETCHILD,obj.name,1,0,5,select)
             })
              $('body').on('click','#byHot',function(event){
                orderRule=1
                $('#byHot').attr('class',"layui-this")
                $('#byNew').attr('class',"")
                fly.getComments(GETALL,1,1,orderRule,5,1);
             })
                $('body').on('click','#byNew',function(event){
                orderRule=0
                $('#byHot').attr('class',"")
                $('#byNew').attr('class',"layui-this")
                fly.getComments(GETALL,1,1,orderRule,5,1);
             })
    },
    deleteComment:function(w_id,p_id,c_id){
        $.ajax(
        {
            url:'/comment_delete',
            type:'post',
            data:{
                "w_id":w_id,
                'p_id':p_id,
                'c_id':c_id
            },
            headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
            success:function(data){
                if (data.status==0) {
                        layer.msg(data.msg, {icon: 1});
                        fly.getComments(GETALL,1,current_page,0,5,1);
                }else{
                        layer.msg(data.msg, {icon: 2});
                }
            }
        }
        )
    }
    ,
     getComments:function(type,p_id,c_page,bycolumn,getLimit,el) {
            layer.msg('玩命加载中',{time:0});
            var rout_info = document.getElementById('theArticle').getAttribute('name')
            var actionUrl;
            actionUrl = type==GETCHILD ?"/getChild":"/getComment";
            current_page = c_page;

            $.ajax(
                {
                    url: actionUrl,
                    type: "post",
                    data:{
                        "article_id":rout_info,
                        "page":c_page,
                        "p_id":p_id,
                        "bycolumn":bycolumn,
                        "getLimit":getLimit
                        },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success:function (data) {
                        layer.closeAll();
                        if (data.data.data.length==0&&data.data.current_page>1) {
                          fly.getComments(type,1,c_page-1,0,5,1);
                        }
                        if (type==GETALL&&data.data.last_page>0) {
                            $("#comment_area").html(data.html)
                            if (data.data.current_page==1) {
                                fly.readyPage(data.data.total,"allPage",fly.dealPage)
                            }
                        }else{
                            $(el).html(data.html)
                            var c_id = "c_fpage_"+rout_info+"_"+p_id
                            if (data.data.current_page==1) {
                                fly.readyPage(data.data.total,c_id,fly.dealPage)
                            }
                            
                        }
                    }
            })
    }

    //计算字符长度
    ,
    dealPage:function(obj,first) {
        if (first) return;
        if (obj.elem=="allPage") {
            fly.getComments(GETALL,1,obj.curr,orderRule,5,obj.elem)
            window.scrollTo(0,$('#flyReply').offset().top);

        }else{
            var select = document.getElementById(obj.elem)
            var p_id = select.getAttribute('name')
            fly.getComments(GETCHILD,p_id ,obj.curr,1,5,$(select).prev())
        }
    },
    readyPage:function(total,el,cb) {
            layui.use('laypage', function(){
              var laypage = layui.laypage;
              //执行一个laypage实例
              laypage.render(
              {
                    elem: el //注意，这里的 test1 是 ID，不用加 # 号
                    ,count: total //数据总数，从服务端得到
                    ,jump: cb,
                    limit:5
              });
            })
    },
    charLen: function(val){
      var arr = val.split(''), len = 0;
      for(var i = 0; i <  val.length ; i++){
        arr[i].charCodeAt(0) < 299 ? len++ : len += 2;
      }
      return len;
    }
    
    ,form: {}

    //简易编辑器
    ,layEditor: function(options){
      var html = ['<div class="layui-unselect fly-edit">'
        ,'<span type="face" title="插入表情"><i class="iconfont icon-yxj-expression" style="top: 1px;"></i></span>'
        // ,'<span type="picture" title="插入图片：img[src]"><i class="iconfont icon-tupian"></i></span>'
        ,'<span type="href" title="超链接格式：a(href)[text]"><i class="iconfont icon-lianjie"></i></span>'
        ,'<span type="code" title="插入代码或引用"><i class="iconfont icon-emwdaima" style="top: 1px;"></i></span>'
        // ,'<span type="hr" title="插入水平线">hr</span>'
        ,'<span type="yulan" title="预览"><i class="iconfont icon-yulan1"></i></span>'
      ,'</div>'].join('');

      var log = {}, mod = {
        face: function(editor, self){ //插入表情
          var str = '', ul, face = fly.faces;
          for(var key in face){
            str += '<li title="'+ key +'"><img src="'+ face[key] +'"></li>';
          }
          str = '<ul id="LAY-editface" class="layui-clear">'+ str +'</ul>';
          layer.tips(str, self, {
            tips: 3
            ,time: 0
            ,skin: 'layui-edit-face'
          });
          $(document).on('click', function(){
            layer.closeAll('tips');
          });
          $('#LAY-editface li').on('click', function(){
            var title = $(this).attr('title') + ' ';

            current_input=$('.back textarea')[0]
            layui.focusInsert(current_input||editor[0], 'face' + title);
          });
        }
        ,href: function(editor){ //超链接
          layer.prompt({
            title: '请输入合法链接'
            ,shade: false
            ,fixed: false
            ,id: 'LAY_flyedit_href'
            ,offset: [
              editor.offset().top - $(window).scrollTop() + 'px'
              ,editor.offset().left + 'px'
            ]
          }, function(val, index, elem){
            if(!/^http(s*):\/\/[\S]/.test(val)){
              layer.tips('这根本不是个链接，不要骗我。', elem, {tips:1})
              return;
            }
            layui.focusInsert(current_input, ' a('+ val +')['+ val + '] ');
            layer.close(index);
          });
        }
        ,code: function(editor){ //插入代码
          layer.prompt({
            title: '请贴入代码或任意文本'
            ,formType: 2
            ,maxlength: 10000
            ,shade: false
            ,id: 'LAY_flyedit_code'
            ,area: ['800px', '360px']
          }, function(val, index, elem){
            layui.focusInsert(current_input, '[pre]\n'+ val + '\n[/pre]');
            layer.close(index);
          });
        }
        ,yulan: function(editor){ //预览
          var content = editor.val();
          
          content = /^\{html\}/.test(content) 
            ? content.replace(/^\{html\}/, '')
          : fly.content_(content);

          layer.open({
            type: 1
            ,title: '预览'
            ,shade: false
            ,area: ['100%', '100%']
            ,scrollbar: false
            ,content: '<div class="detail-body" style="margin:20px;">'+ content +'</div>'
          });
        }

      };
      
      layui.use('face', function(face){
        options = options || {};

        fly.faces = face;
        $(options.elem).each(function(index){
          var that = this, othis = $(that), parent = othis.parent();
          parent.prepend(html);
          parent.find('.fly-edit span').on('click', function(event){
            // console.log(event.target)
            if ($(event.target).parents('#copyIn').length) {
                current_input=$('#L_content');
            }
            var type = $(this).attr('type');
            mod[type].call(that, othis, this);
            if(type === 'face'){
              event.stopPropagation()
            }
          });
        });
      });
      
    }

    ,escape: function(html){
      return String(html||'').replace(/&(?!#?[a-zA-Z0-9]+;)/g, '&amp;')
      .replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/'/g, '&#39;').replace(/"/g, '&quot;');
    }

    //内容转义
    ,content_: function(content){
      //支持的html标签
            var html = function(end){
        return new RegExp('\\n*\\['+ (end||'') +'(pre|hr|div|span|p|table|thead|th|tbody|tr|td|ul|li|ol|li|dl|dt|dd|h2|h3|h4|h5)([\\s\\S]*?)\\]\\n*', 'g');
      };
      content = fly.escape(content||'') //XSS
      .replace(/img\[([^\s]+?)\]/g, function(img){  //转义图片
        return '<img src="' + img.replace(/(^img\[)|(\]$)/g, '') + '">';
      }).replace(/@(\S+)(\s+?|$)/g, '@<a href="javascript:;" class="fly-aite">$1</a>$2') //转义@
      .replace(/face\[([^\s\[\]]+?)\]/g, function(face){  //转义表情
        var alt = face.replace(/^face/g, '');
        return '<img alt="'+ alt +'" title="'+ alt +'" src="' + fly.faces[alt] + '">';
      }).replace(/a\([\s\S]+?\)\[[\s\S]*?\]/g, function(str){ //转义链接
        var href = (str.match(/a\(([\s\S]+?)\)\[/)||[])[1];
        var text = (str.match(/\)\[([\s\S]*?)\]/)||[])[1];
        if(!href) return str;
        var rel =  /^(http(s)*:\/\/)\b(?!(\w+\.)*(sentsin.com|layui.com))\b/.test(href.replace(/\s/g, ''));
        return '<a href="'+ href +'" target="_blank"'+ (rel ? ' rel="nofollow"' : '') +'>'+ (text||href) +'</a>';
      }).replace(html(), '\<$1 $2\>').replace(html('/'), '\</$1\>') //转移HTML代码
      .replace(/\n/g, '<br>') //转义换行   
      return content;
    }
    
    //新消息通知
    ,newmsg: function(){
      var elemUser = $('.fly-nav-user');
      if(layui.cache.user.uid !== -1 && elemUser[0]){
        fly.json('/message/nums/', {
          _: new Date().getTime()
        }, function(res){
          if(res.status === 0 && res.count > 0){
            var msg = $('<a class="fly-nav-msg" href="javascript:;">'+ res.count +'</a>');
            elemUser.append(msg);
            msg.on('click', function(){
              fly.json('/message/read', {}, function(res){
                if(res.status === 0){
                  location.href = '/user/message/';
                }
              });
            });
            layer.tips('你有 '+ res.count +' 条未读消息', msg, {
              tips: 3
              ,tipsMore: true
              ,fixed: true
            });
            msg.on('mouseenter', function(){
              layer.closeAll('tips');
            })
          }
        });
      }
      return arguments.callee;
    }
    
  };

        fly.initAction();
        layer.msg('玩命加载中',{time:0});
        fly.getComments(GETALL,1,1,0,5,1);
        fly.layEditor({
            elem: '.fly-editor'
         });
});


