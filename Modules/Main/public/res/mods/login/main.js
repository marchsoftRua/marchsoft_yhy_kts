'use strict'

$(function() {
    $('.signin-wrapper').hide();
    $('#signup-option').addClass('nav-active');
    $('#signin-option').addClass('nav-deactive');
    $('#info').hide();
});

$('#signup-option').click(function() {
    $('#signup-option').removeClass('nav-deactive').addClass('nav-active');
    $('#signin-option').removeClass('nav-active').addClass('nav-deactive');
    $('.signin-wrapper').hide();
    $('.signup-wrapper').show();
})

$('#signin-option').click(function() {
    $('#signin-option').removeClass('nav-deactive').addClass('nav-active');
    $('#signup-option').removeClass('nav-active').addClass('nav-deactive');
    $('.signup-wrapper').hide();
    $('.signin-wrapper').show();
})

var $username = $('#signup [name=username]');
var $account = $('#signup [name=account]');
var $pwd = $('#signup [name=password]');

// 点击输入框时将输入框后面可能存在的错误信息提示去除
$username.click(function() {
    $username.next('label').remove();
})
$account.click(function() {
    $account.next('label').remove();
})
$pwd.click(function() {
    $pwd.next('label').remove();
})


// “注册知乎” button
$('#signup-btn').click(function() {
    /*
     * 首先验证输入是否合法
     * 若合法则注册成功，调用 FORMS.signup() 将注册信息存储
     */

    // 输入验证，返回验证错误码
    FORMS.inputTest($username.val(), $account.val(), $pwd.val())
        .then(obj => {
            var signupRes = FORMS.signup(obj);
            if (!signupRes) {
                $account.after('<label class="input-err">账号已存在</label>');
            } else {
                $username.val('');
                $account.val('');
                $pwd.val('');
                alert('注册成功');
            }
        })
        .catch(e => {
            // 姓名验证反馈
            if ('1' === e[0]) {
                $username.next('label').remove();
                $username.after('<label class="input-err">请填写姓名</label>');
            } else if ('2' === e[0]) {
                $username.next('label').remove();
                $username.after('<label class="input-err">姓名最短为2个汉字或3个英文字符</label>');
            }

            // 账号验证反馈
            if ('1' === e[1]) {
                $account.next('label').remove();
                $account.after('<label class="input-err">请填写手机号</label>');
            } else if ('2' === e[1]) {
                $account.next('label').remove();
                $account.after('<label class="input-err">请输入正确的手机号</label>');
            }

            // 密码验证反馈
            if ('1' === e[2]) {
                $pwd.next('label').remove();
                $pwd.after('<label class="input-err">请填写密码</label>');
            } else if ('2' === e[2]) {
                $pwd.next('label').remove();
                $pwd.after('<label class="input-err">请输入 6-128 位的密码');
            }
        })
})

var $accountSigninInput = $('#signin [name=account]');
var $pwdSigninInput = $('#signin [name=password]');

$accountSigninInput.click(() => $accountSigninInput.next('label').remove());

$pwdSigninInput.click(() => $pwdSigninInput.next('label').remove());

$('#signin-btn').click(function() {
    var signinRes = FORMS.signin($accountSigninInput.val(), $pwdSigninInput.val());
    if (-1 == signinRes) {
        $accountSigninInput.next('label').remove();
        $accountSigninInput.after('<label class="input-err">账号或密码错误</label>');
    } else if (1 == signinRes) {
        $pwdSigninInput.next('label').remove();
        $pwdSigninInput.after('<label class="input-err">账号或密码错误</label>');
    } else {
        $('#info').show();
        for (var i = 3; i > 0; i--) {
            (function (ind) {
                setTimeout(() => $('#info').text('登陆成功，' + ind + ' 秒后跳转至 真·知乎'), 1000 * (3 - ind));
            })(i);
        }
        setTimeout(() => window.location.href = 'https://www.zhihu.com', 3000);
    }
})
