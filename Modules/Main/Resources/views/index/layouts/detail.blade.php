
@section('container')
    <div class="layui-container">
        <div class="layui-row layui-col-space15">
            <div class="layui-col-md8 content detail">
            <div class="fly-panel detail-box">
                <h1>{{$data->article_title}}</h1>
                <div class="fly-detail-info">
                    <!-- <span class="layui-badge">审核中</span> -->
                    <span class="layui-badge layui-bg-green fly-detail-column">动态</span>

                    <span class="layui-badge" style="background-color: #999;">未结</span>
                    <!-- <span class="layui-badge" style="background-color: #5FB878;">已结</span> -->

                    <span class="layui-badge layui-bg-black">置顶</span>
                    <span class="layui-badge layui-bg-red">精帖</span>

                    <div class="fly-admin-box" data-id="123">
                        <span class="layui-btn layui-btn-xs jie-admin" type="del">删除</span>

                        <span class="layui-btn layui-btn-xs jie-admin" type="set" field="stick" rank="1">置顶</span>
                        <!-- <span class="layui-btn layui-btn-xs jie-admin" type="set" field="stick" rank="0" style="background-color:#ccc;">取消置顶</span> -->

                        <span class="layui-btn layui-btn-xs jie-admin" type="set" field="status" rank="1">加精</span>
                        <!-- <span class="layui-btn layui-btn-xs jie-admin" type="set" field="status" rank="0" style="background-color:#ccc;">取消加精</span> -->
                    </div>
                    <span class="fly-list-nums">
            <a href="#comment"><i class="iconfont" title="回答">&#xe60c;</i> {{$data->CommentNum}}</a>
            <i class="iconfont" title="人气">&#xe60b;</i> {{$data->readnum}}
          </span>
                </div>
                <div class="detail-about">
                    <a class="fly-avatar" href="../user/home.html">
                        <img src="https://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg" alt="{{$data->user_playname}}">
                    </a>
                    <div class="fly-detail-user">
                        <a href="../user/home.html" class="fly-link">
                            <cite>{{$data->user_playname}}</cite>
                            <i class="iconfont icon-renzheng" title="认证信息：@{{ rows.user.approve }}"></i>
                            <i class="layui-badge fly-badge-vip">VIP3</i>
                        </a>
                        <span>{{$data->created_at}}</span>
                    </div>
                    <div class="detail-hits" id="LAY_jieAdmin" data-id="123">
                        <span style="padding-right: 10px; color: #FF7200">{{$data->praise}}</span>
                        <span class="layui-btn layui-btn-xs jie-admin" type="edit"><a href="add.html">编辑此贴</a></span>
                    </div>
                </div>
                <div class="detail-body photos">
                    {{$data->praise}}
                </div>
            </div>


            <div class="fly-panel detail-box" id="flyReply">

                <fieldset class="layui-elem-field layui-field-title" style="text-align: center;">
                    <legend>回帖</legend>
                </fieldset>
                <div class="layui-form layui-form-pane">
                    <form action="/jie/reply/" method="post">
                        <div class="layui-form-item layui-form-text">
                            <a name="comment"></a>
                            <div class="layui-input-block">
                                <textarea id="L_content" name="content" required lay-verify="required" placeholder="请输入内容"  class="layui-textarea fly-editor" style="height: 150px;"></textarea>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <input type="hidden" name="jid" value="123">
                            <button class="layui-btn" lay-filter="*" lay-submit>提交回复</button>
                        </div>
                    </form>
                </div>
                <div class="fly-panel-title fly-filter" style="padding: 0">
               <span class="fly-filter-left layui-hide-xs">
                    <a href="javascript:void(0);" class="layui-this"  id="byNew">按最新</a>
                    <span class="fly-mid"></span>
                    <a href="javascript:void(0);" id="byHot">按热门排序</a>
                </span>
                </div>
                <ul class="jieda" id="comment_area">


                    <!-- 无数据时 -->
                    <!-- <li class="fly-none">消灭零回复</li> -->
                </ul>


            </div>
        </div>
            <div class="layui-col-md4">

                <div class="fly-panel">
                    <h3 class="fly-panel-title">温馨通道</h3>
                    <ul class="fly-panel-main fly-list-static">
                        <li>
                            <a href="http://fly.layui.com/jie/4281/" target="_blank">layui 的 GitHub 及 Gitee (码云) 仓库，欢迎Star</a>
                        </li>
                        <li>
                            <a href="http://fly.layui.com/jie/5366/" target="_blank">
                                layui 常见问题的处理和实用干货集锦
                            </a>
                        </li>
                        <li>
                            <a href="http://fly.layui.com/jie/4281/" target="_blank">layui 的 GitHub 及 Gitee (码云) 仓库，欢迎Star</a>
                        </li>
                        <li>
                            <a href="http://fly.layui.com/jie/5366/" target="_blank">
                                layui 常见问题的处理和实用干货集锦
                            </a>
                        </li>
                        <li>
                            <a href="http://fly.layui.com/jie/4281/" target="_blank">layui 的 GitHub 及 Gitee (码云) 仓库，欢迎Star</a>
                        </li>
                    </ul>
                </div>


                <div class="fly-panel fly-signin">
                    <div class="fly-panel-title">
                        签到
                        <i class="fly-mid"></i>
                        <a href="javascript:;" class="fly-link" id="LAY_signinHelp">说明</a>
                        <i class="fly-mid"></i>
                        <a href="javascript:;" class="fly-link" id="LAY_signinTop">活跃榜<span class="layui-badge-dot"></span></a>
                        <span class="fly-signin-days">已连续签到<cite>16</cite>天</span>
                    </div>
                    <div class="fly-panel-main fly-signin-main">
                        <button class="layui-btn layui-btn-danger" id="LAY_signin">今日签到</button>
                        <span>可获得<cite>5</cite>飞吻</span>

                        <!-- 已签到状态 -->
                        <!--
                        <button class="layui-btn layui-btn-disabled">今日已签到</button>
                        <span>获得了<cite>20</cite>飞吻</span>
                        -->
                    </div>
                </div>

                <div class="fly-panel fly-rank fly-rank-reply" id="LAY_replyRank">
                    <h3 class="fly-panel-title">回贴周榜</h3>
                    <dl>
                        <!--<i class="layui-icon fly-loading">&#xe63d;</i>-->
                        {{--@foreach($userRank as $user)--}}
                            {{--<dd>--}}
                                {{--<a href="user/home.html">--}}
                                    {{--<img src="https://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg"><cite>{{$user->user_playname}}</cite><i>{{$user->comment_num}}次回答</i>--}}
                                {{--</a>--}}
                            {{--</dd>--}}
                        {{--@endforeach--}}
                    </dl>
                </div>

                <dl class="fly-panel fly-list-one">
                    <dt class="fly-panel-title">本周热议</dt>
                    {{--@foreach($hotRank as $hot)--}}
                        {{--<dd>--}}
                            {{--<a href="/article">{{$hotRank->article_name}}</a>--}}
                            {{--<span><i class="iconfont icon-pinglun1"></i> {{$hotRank->comment_num}}</span>--}}
                        {{--</dd>--}}
                    {{--@endforeach--}}
                    {{--@if(count($hotRank)<1)--}}
                    {{--<!-- 无数据时 -->--}}
                        {{--<div class="fly-none">没有相关数据</div>--}}
                    {{--@endif--}}
                </dl>

                <div class="fly-panel">
                    <div class="fly-panel-title">
                        这里可作为广告区域
                    </div>
                    <div class="fly-panel-main">
                        <a href="http://layim.layui.com/?from=fly" target="_blank" class="fly-zanzhu" time-limit="2017.09.25-2099.01.01" style="background-color: #5FB878;">LayIM 3.0 - layui 旗舰之作</a>
                    </div>
                </div>

                <div class="fly-panel fly-link">
                    <h3 class="fly-panel-title">友情链接</h3>
                    <dl class="fly-panel-main">
                        <dd><a href="http://www.layui.com/" target="_blank">layui</a><dd>
                        <dd><a href="http://layim.layui.com/" target="_blank">WebIM</a><dd>
                        <dd><a href="http://layer.layui.com/" target="_blank">layer</a><dd>
                        <dd><a href="http://www.layui.com/laydate/" target="_blank">layDate</a><dd>
                        <dd><a href="mailto:xianxin@layui-inc.com?subject=%E7%94%B3%E8%AF%B7Fly%E7%A4%BE%E5%8C%BA%E5%8F%8B%E9%93%BE" class="fly-link">申请友链</a><dd>
                    </dl>
                </div>

            </div>
        </div>
    </div>
    <script src="{{asset('/Main/index/articleDetail.js')}}"></script>
@endsection