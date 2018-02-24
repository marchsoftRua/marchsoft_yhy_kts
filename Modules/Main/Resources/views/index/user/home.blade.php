@section('container')
<div class="fly-home fly-panel" style="background-image: url();">
  <img src="/image/{{$info->id}}" alt="{{$info->name}}">
  @if($info->group_id)
    <i class="iconfont icon-renzheng" title="Fly社区认证"></i>
  @endif
  <h1>
    {{$info->name}} 
    <i class="iconfont 
    @if($info->sex == 0)
      icon-nan
    @elseif($info->sex == 1)
      icon-nv
     @endif
    "></i> 

    @if($info->user_type == 1)
      <span style="color:#c00;">（管理员）</span>
    @elseif($info->user_type == 2)
      <span style="color:#5FB878;">（社区之光）</span>
    @elseif($info->user_type == -1)
      <span>（该号已被封）</span>
      @endif
  </h1>

 @if($info->group_id)
    <p style="padding: 10px 0; color: #5FB878;">认证信息：{{ $info->group_id }}</p>
@endif
  <p class="fly-home-info">
    <i class="iconfont icon-kiss" title="飞吻"></i><span style="color: #FF7200;">飞吻</span>
    <i class="iconfont icon-shijian"></i><span>加入</span>
    <i class="iconfont icon-chengshi"></i><span>来自中国 某城'</span>
  </p>

  <p class="fly-home-sign">（这个人懒得留下签名）</p>

  <div class="fly-sns" data-user="">
    <a href="javascript:;" class="layui-btn layui-btn-primary fly-imActive" data-type="addFriend">加关注</a>
    <a href="javascript:;" class="layui-btn layui-btn-normal fly-imActive" data-type="chat">发私信</a>
  </div>

</div>

<div class="layui-container">
  <div class="layui-row layui-col-space15">
    <div class="layui-col-md6 fly-home-jie">
      <div class="fly-panel">
        <h3 class="fly-panel-title">{{$info->name}} 最近分享的文章</h3>
        <ul class="jie-row">

        @foreach($articles as $article)
          <li>
            {{ $article->status == 1 ? '<span class="fly-jing layui-hide-xs">精</span>' : ''}}
            <a href="/jie/{{$article->id}}/" class="jie-title">{{ $article->article_title}}</a>
            <i>{{wordTime($article->created_at)}}</i>
            <em class="layui-hide-xs">{{$article->readnum}}阅/100答</em>
          </li>
        @endforeach
        @if(count($articles) == 0) 
        <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><i style="font-size:14px;">没有发表任何求解</i></div>
        @endif
        </ul>
      </div>
    </div>
    
    <div class="layui-col-md6 fly-home-da">
      <div class="fly-panel">
        <h3 class="fly-panel-title">{{$info->name}} 最近的回答</h3>
        <ul class="home-jieda">
          @foreach($comments as $comment )
          <li>
            <p>
            <span>在{{wordTime($comment->created_at)}}</span>
            评论了文章：<a href="/article/{{$comment->belong_id}}" target="_blank">{{$comment->article_info->article_title}}</a>
            </p>
          </li>
        @endforeach
        @if(count($comments)== 0)
        <div class="fly-none" style="min-height: 50px; padding:30px 0; height:auto;"><span>没有评论任何文章</span></div>
        @endif
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection