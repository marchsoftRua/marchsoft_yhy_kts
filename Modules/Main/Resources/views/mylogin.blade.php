<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>三月社区 - 与世界分享你的知识、经验和见解aaaa</title>
    <link rel="stylesheet" href="{{asset('Main/res/css/login/base.css')}}" />
    <link rel="stylesheet" href="{{asset('Main/res/css/login/main.css')}}" />
    <script src="{{asset('Main/layui/layui.js')}}"></script>
    <style>
        #canvas {
          display: block;
          width: 100%;
          height: 100%;
        }
    </style>
</head>

<body>
    <div id="info" class="sign-info" hidden="hidden"></div>
        <canvas id="canvas"></canvas>
    <main id="index-main">
        <header id="index-header">
            <h1 class="logo hide-text"></h1>
            <h2 id="slogan">与世界分享你刚刚编好的故事</h2>
        </header>
        <nav class="index-tab-nav">
            <button id="signup-option" type="button">注册</button>
            <button id="signin-option" type="button">登陆</button>
        </nav>
        <!-- 注册表单 -->
        <div class="signup-wrapper">
            <form id="signup" class="" method="post" action="/register">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                <div class="group-inputs">
                    <div class="input-wrapper input-username">
                        <input name="user_playname" type="text" placeholder="用户昵称" />
                    </div>
                    <div class="input-wrapper input-account">
                        <input name="user_email" type="email" placeholder="请填写你的注册邮箱a" />
                    </div>
                    <button class="the-button" type="button">点击66</button>
                    <div class="input-wrapper input-password">
                        <input name="user_password" type="password" placeholder="密码" style="width: 83%;" />
                    </div>
                </div>
                <input id="signup-btn" class="sign-btn" type="submit" onclick=""  value="注册"/>
            </form>
            <p class="agreement-tips">点击「注册」按钮，即代表你同意<a href="https://www.zhihu.com/terms">《三月协议》</a></p>
        </div>
        <!-- 登陆表单 -->
        <div class="signin-wrapper">
            <form id="signin" class="" method="post" action="/login">
                <input name="_token" type="hidden" value="{{ csrf_token() }}">
                <div class="group-inputs">
                    <div class="input-wrapper input-account">
                        <input name="account" type="text" placeholder="手机号或邮箱" />
                    </div>
                    <div class="input-wrapper input-password">
                        <input name="password" type="password" placeholder="密码" />
                    </div>
                </div>
                <div>
                    <?php echo Geetest::render(); ?>
                </div>
                
                <input id="signin-btn" class="sign-btn" type="button" onclick="" value="登陆"/>
            </form>
            <p class="agreement-tips">点击「注册」按钮，即代表你同意<a href="https://www.zhihu.com/terms">《三月协议》</a></p>
        <div class="signin-btn-wrapper">
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
    <script src="{{asset('Main/res/mods/login/forms.js')}}"></script>
    <script src="{{asset('Main/res/mods/login/main.js')}}"></script>
    <script type="text/javascript" src="{{asset('Main/res/mods/login/bundle.js')}}"></script>
    <script>
        layui.use(['jquery'],function () {
            var $ = layui.jquery
        })
    </script>
</body>

</html>
