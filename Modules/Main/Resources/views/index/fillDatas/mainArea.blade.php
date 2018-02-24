{{--/**--}}
 {{--* Created by PhpStorm.--}}
 {{--* User: KTS--}}
 {{--* Date: 2018/2/1--}}
 {{--* Time: 10:21--}}
 {{--*/--}}
        @foreach($data as $iteam )
          <li>
            <a href="article" class="fly-avatar">
              <img src="https://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg" alt="贤心">
            </a>
            <h2>
              <a class="layui-badge">分享</a>
              <a href="article/{{$iteam->id}}">{{$iteam->article_title}}</a>
            </h2>
            <div style="color: gray;font-size: 13px;">
                <p>{{$iteam->summary}}</p>
            </div>
            <div class="fly-list-info">
              <a href="user/home.html" link>
                <cite>{{$iteam->name}}</cite>
                <!--
                <i class="iconfont icon-renzheng" title="认证信息：XXX"></i>
                <i class="layui-badge fly-badge-vip">VIP3</i>
-->
              </a>
              <span>{{$iteam->created_at}}</span>
              <span class="fly-list-kiss layui-hide-xs" title="悬赏飞吻"><i class="iconfont icon-kiss"></i> {{$iteam->praise}}</span>
              <!--<span class="layui-badge fly-badge-accept layui-hide-xs">已结</span>-->
              <span class="fly-list-nums">
                <i class="iconfont icon-pinglun1" title="回答"></i> {{$iteam->CommentNum}}
              </span>
            </div>
            <div class="fly-list-badge">
              <!--<span class="layui-badge layui-bg-red">精帖</span>-->
            </div>
          </li>
          @endforeach
