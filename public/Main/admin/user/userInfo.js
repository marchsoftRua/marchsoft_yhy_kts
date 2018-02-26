var form, $,areaData;
layui.config({
    base : module_path
}).extend({
    "address" : "address"
})
layui.use(['form','layer','upload','laydate',"address"],function(){
    form = layui.form;
    $ = layui.jquery;
    var layer = parent.layer === undefined ? layui.layer : top.layer,
        upload = layui.upload,
        laydate = layui.laydate,
        address = layui.address,
        _token = $('#_token').val();

    //上传头像
    upload.render({
        elem: '.userFaceBtn',
        url: '/changeImage',
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

    //添加验证规则
    form.verify({
        userBirthday : function(value){
            if(!/^(\d{4})[\u4e00-\u9fa5]|[-\/](\d{1}|0\d{1}|1[0-2])([\u4e00-\u9fa5]|[-\/](\d{1}|0\d{1}|[1-2][0-9]|3[0-1]))*$/.test(value)){
                return "出生日期格式不正确！";
            }
        }
    })
    //选择出生日期
    laydate.render({
        elem: '.userBirthday',
        format: 'yyyy-MM-dd',
        trigger: 'click',
        max : 0,
        done: function(value, date){
                layer.msg('修改成功!');
                console.log($(".userBirthday").val())
            }
    });

    //获取省信息
    address.provinces();

    //提交个人资料
    form.on("submit(changeUser)",function(data){
        var index = layer.msg('提交中，请稍候',{icon: 16,time:false,shade:0.8});
        //将填写的用户信息存到session以便下次调取
        var key,userInfoHtml = '';
        userInfoHtml = {
            'realName' : $(".realName").val(),
            'sex' : data.field.sex,
            'userPhone' : $(".userPhone").val(),
            'userBirthday' : $(".userBirthday").val(),
            'province' : data.field.province,
            'city' : data.field.city,
            'area' : data.field.area,
            'userEmail' : $(".userEmail").val(),
            'myself' : $(".myself").val()
        };
        
        for(key in data.field){
            if(key.indexOf("like") != -1){
                userInfoHtml[key] = "on";
            }
        }
        window.sessionStorage.setItem("userInfo",JSON.stringify(userInfoHtml));
        userInfoHtml._token = _token
        $.ajax({
            url:'/userInfo',
            method:'post',
            data:userInfoHtml,
            dataType:'json',
            success:function(msg){
                layer.close(index);
                layer.msg(msg.msg);
            },
        });
        return false; //阻止表单跳转。如果需要表单跳转，去掉这段即可。
    })

    //修改密码


    setAdd = function(){
        var province = $('#province').attr('data-province'),
        city = $('#city').attr('data-city'),
        area = $('#area').attr('data-area');
        $.get("Main/json/address.json", function (addressData) {
            $(".userAddress select[name='province']").val(province); //省
            var value = province;
            if (value > 0) {
                address.citys(addressData[$(".userAddress select[name='province'] option[value='"+province+"']").index()-1].childs);
                citys = addressData[$(".userAddress select[name='province'] option[value='"+province+"']").index()-1].childs;
            } else {
                $('.userAddress select[name=city]').attr("disabled","disabled");
            }
            $(".userAddress select[name='city']").val(city); //市
            //填充市级信息，同时调取区县信息列表
            var value = city;
            if (value > 0) {
                address.areas(citys[$(".userAddress select[name=city] option[value='"+city+"']").index()-1].childs);
            } else {
                $('.userAddress select[name=area]').attr("disabled","disabled");
            }
            $(".userAddress select[name='area']").val(area); //区
            form.render();
        })
    }
    setAdd();
})