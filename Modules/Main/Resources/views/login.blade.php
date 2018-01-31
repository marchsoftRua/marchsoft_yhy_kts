<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>三月社区 - 与世界分享你的知识、经验和见解</title>
    <link rel="stylesheet" href="{{asset("res/css/login/base.css")}}" />
    <link rel="stylesheet" href="{{asset("res/css/login/main.css")}}" />
    <style>
        canvas {
          display: block;
          width: 100%;
          height: 100%;
        }
    </style>
</head>

<body>
    <div id="info" class="sign-info" hidden="hidden"></div>
    <!-- <canvas id="Mycanvas"></canvas> -->
        <canvas id="canvas"></canvas>
        <main id="index-main">
        <header id="index-header">
            <!--
            <div class="logo">
                <img src="images/zhihu-logo.png" />
            </div>
        -->
            <h1 class="logo hide-text"></h1>
            <h2 id="slogan">与世界分享你的知识、经验和见解</h2>
        </header>
        <nav class="index-tab-nav">
            <button id="signup-option" type="button">注册</button>
            <button id="signin-option" type="button">登陆</button>
        </nav>
        <!-- 注册表单 -->
        <div class="signup-wrapper">
        <form id="signup" class="">
            <div class="group-inputs">
                <div class="input-wrapper input-username">
                    <input name="username" type="text" placeholder="姓名" />
                </div>
                <div class="input-wrapper input-account">
                    <input name="account" type="text" placeholder="手机号（仅支持中国大陆）" />
                </div>
                <div class="input-wrapper input-password">
                    <input name="password" type="password" placeholder="密码" />
                </div>
                <div class="input-wrapper input-captcha">
                    <input class="captcha" type="text" placeholder="验证码" />
                </div>
            </div>
            <!-- .group-inputs -->
            <input id="signup-btn" class="sign-btn" type="button" onclick=""  value="注册"/>
        </form>
        <p class="agreement-tips">点击「注册」按钮，即代表你同意<a href="https://www.zhihu.com/terms">《三月协议》</a></p>
    </div>

        <!-- 登陆表单 -->
        <div class="signin-wrapper">
        <form id="signin" class="">
            <div class="group-inputs">
                <div class="input-wrapper input-account">
                    <input name="account" type="text" placeholder="手机号或邮箱" />
                </div>
                <div class="input-wrapper input-password">
                    <input name="password" type="password" placeholder="密码" />
                </div>
                <div class="input-wrapper input-captcha">
                    <input name="captcha" type="text" placeholder="验证码" />
                </div>
            </div>
            <!-- .group-inputs -->
            <input id="signin-btn" class="sign-btn" type="button" onclick="" value="登陆"/>
        </form>
        <div class="signin-btn-wrapper">
            <button class="signin-switch-button" type="button">手机验证码登陆</button>
            <button class="unable-signin" type="button">无法登陆？</button>
        </div>
        <div class="social-signup-wrapper">
            <button class="social-signup-button" type="button">社交账号登陆</button>
        </div>
        </div>
    </main>

    <footer id="index-footer" class="informations">
        <div class="informations-wrapper">
            <span>&copy; 2018 三月</span>
            <span class="dot">·</span>
            <a href="https://zhihu.com/roundtable" target="_blank">三月点赞币</a>
            <span class="dot">·</span>
            <a href="https://zhihu.com/explore" target="_blank">发现</a>
            <span class="dot">·</span>
            <a href="https://zhihu.com/app" target="_blank">移动应用</a>
            <span class="dot">·</span>
            <a href="https://zhihu.com/org/signin" target="_blank">使用机构账号登陆</a>
            <span class="dot">·</span>
            <a href="https://zhihu.com/contact" target="_blank">联系我们</a>
            <span class="dot">·</span>
            <a href="https://zhihu.com/careers" target="_blank">来三月工作</a>
        </div>
        <div class="informations-wrapper">
            <!-- <a href="http://www.miibeian.gov.cn/" target="_blank">豫 ICP 证 110745 号</a> -->
            <span class="dot">·</span>
            <span>豫公网安备 11010802010035 号</span>
            <span class="dot">·</span>
            <!-- <a href="http://zhstatic.zhihu.com/assets/zhihu/publish-license.jpg" target="_blank">出版物经营许可证</a> -->
        </div>
    </footer>
    <script src="{{asset("js/jquery.js")}}"></script>
    <!-- <script src="https://cdn.bootcss.com/blueimp-md5/2.7.0/js/md5.min.js"></script> -->
    <script src="{{asset("res/mods/login/forms.js")}}"></script>
    <script src="{{asset("res/mods/login/main.js")}}"></script>
    <script type="text/javascript" src="{{asset("res/mods/login/bundle.js")}}"></script>
</body>

</html>
