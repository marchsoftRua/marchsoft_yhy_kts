
@foreach($comment as $key=>$item )
<li id="p_id_{{$item->id}}" class="jieda-daan">
    <div class="detail-about detail-about-reply">
        <a class="fly-avatar" href="">
            <img src="https://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg" alt=" ">
        </a>
        <div class="fly-detail-user">
            <a href="/user_home/{{$item->playname}}" class="fly-link">
                <cite>{{$item->from_name}}</cite>
                <i class="iconfont icon-renzheng" title="认证信息：XXX"></i>
                <i class="layui-badge fly-badge-vip">VIP3</i>
            </a>
            @if($item->user_id==$comment->author)
            <span>(楼主)</span>
            @endif
            <!--
            <span style="color:#5FB878">(管理员)</span>
            <span style="color:#FF9E3F">（社区之光）</span>
            <span style="color:#999">（该号已被封）</span>
            -->
        </div>

        <div class="detail-hits">
            <span>{{$item->created_at}}</span>
        </div>

        <!-- <i class="iconfont icon-caina" title="最佳答案"></i> -->
    </div>
    <div class="detail-body jieda-body photos">
        <p>{!!$item->comment_inner!!}</p>
    </div>
    <div class="jieda-reply">
              <span class="jieda-zan zanok" type="zan">
                <i class="iconfont icon-zan"></i>
                <em>{{$item->praise}}</em>
              </span>
                <span type="reply" class="reply_bt" pid='{{$item->id}}' toid="{{$item->user_id}}">
                <i class="iconfont icon-svgmoban53"></i>
                回复
              </span>
         @if($item->Author==getUserInfo()->id)
            <div class="jieda-admin">
                 <span class="childs-nav" c_id="{{$item->id}}">
                        <span type='edit'>
                            编辑
                        </span>
                        <span type='del'>
                             删除
                        </span>
                 </span>
                <span class="f-nav"><i class="layui-icon">&#xe65f;</i></span>
                <!-- <span class="jieda-accept" type="accept">采纳</span> -->
            </div>
        @endif
    </div>
        <ul style="margin-left: 50px;">
            @include('main::index.fillDatas.childComment')
              @if($item->childs->total>3)
                <p><a href="javascript:void(0)" class="more"  name="{{$item->id}}">共{{$item->childs->total}}条评论,点击查看更多</a></p>
              @endif
        </ul>
             @if(count($item->childs->data>4))
              <div id="c_fpage_{{$item->belong_id}}_{{$item->id}}" name="{{$item->id}}"style="padding-left: 50px;"></div>
             @endif

</li>
@endforeach
@if(count($comment)<1)
    <li class="fly-none">消灭零回复</li> 
@endif
