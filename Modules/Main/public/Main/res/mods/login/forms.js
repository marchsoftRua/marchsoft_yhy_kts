/***
 * 设计原则：本模块不直接操作 DOM ，只提供数据处理的 API
 ***/

var FORMS = {};

// 验证账号是否存在，不存在则新建成功，账号信息存入 sessionStorage
FORMS.signup = function(obj) {
    // 用户账号类
    class Account {
        constructor(obj) {
            this.username = obj.username;
            this.account = obj.account;
            this.pwdmd5 = obj.pwdmd5;
        }
        toString() {
            return JSON.stringify(this);
        }
    }

    var accountObj = sessionStorage.getItem(obj.account);
    if (null === accountObj) {
        accountObj = new Account(obj);
        sessionStorage.setItem(accountObj.account, accountObj.toString());
        return true;
    } else {
        return false;
    }
}


// 验证登陆是否成功
FORMS.signin = function(account, pwd) {
    // 从 Storage 中取出数据并验证存在性
    var accountObj = JSON.parse(sessionStorage.getItem(account));
    if (!accountObj) { // 如果账号不存在
        return -1;
    } else if (md5(pwd) === accountObj.pwdmd5) { // 密码正确
        return 0;
    } else { // 密码不正确
        return 1;
    }
}


FORMS.inputTest = function(user, acc, pw) {
    /***
     * 验证表单输入是否合法
     * 参数列表：用户输入，包括 username, account, password
     * 返回值：返回一个 Promise 对象
     **/
    var username = user;
    var account = acc;
    var pwd = pw;

    return new Promise(function(resolve, reject) {
        // 错误信息
        // 返回 0 表示一切正常
        // 返回 1 表示字段为空
        // 返回 2 表示格式错误
        var errInfo = '';

        // 用于账号合法性验证
        var telReg = /^1[3|4|5|7|8][0-9]{9}$/;

        String.prototype.getLength = function() {
            var length = {
                len: 0,
                characters: 0,
                letters: 0
            };

            for (var i = 0; i < this.length; i++) {
                if (this.charCodeAt(i) > 127 || this.charCodeAt(i) == 94) {
                    length.len += 2;
                    length.characters++;
                } else {
                    length.len++;
                    length.letters++;
                }
            }
            return length;
        }

        var namelen = username.getLength();
        if (0 == namelen.len) {
            errInfo += '1';
        } else if (1 == namelen.len || (2 == namelen.len && 0 == namelen.characters)) {
            errInfo += '2';
        } else {
            errInfo += '0';
        }
        if (!account) {
            errInfo += '1';
        } else if (!telReg.test(account)) {
            errInfo += '2';
        } else {
            errInfo += '0';
        }
        if (!pwd) {
            errInfo += '1';
        } else if (pwd.length < 6 || pwd.length > 128) {
            errInfo += '2';
        } else {
            errInfo += '0';
        }

        if ('000' === errInfo) {
            resolve({
                username: username,
                account: account,
                pwdmd5: md5(pwd)
            });
        } else {
            reject(errInfo);
        }
    });
}
