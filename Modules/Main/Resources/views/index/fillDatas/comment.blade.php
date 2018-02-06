
@foreach($comment as $key=>$item )
<li id="p_id_{{$item->id}}" class="jieda-daan">
    <div class="detail-about detail-about-reply">
        <a class="fly-avatar" href="">
            <img src="https://tva1.sinaimg.cn/crop.0.0.118.118.180/5db11ff4gw1e77d3nqrv8j203b03cweg.jpg" alt=" ">
        </a>
        <div class="fly-detail-user">
            <a href="" class="fly-link">
                <cite>贤心</cite>
                <i class="iconfont icon-renzheng" title="认证信息：XXX"></i>
                <i class="layui-badge fly-badge-vip">VIP3</i>
            </a>

            <span>(楼主)</span>
            <!--
            <span style="color:#5FB878">(管理员)</span>
            <span style="color:#FF9E3F">（社区之光）</span>
            <span style="color:#999">（该号已被封）</span>
            -->
        </div>

        <div class="detail-hits">
            <span>2017-11-30</span>
        </div>

        <i class="iconfont icon-caina" title="最佳答案"></i>
    </div>
    <div class="detail-body jieda-body photos">
        <p>{{$item->comment_inner}}</p>
    </div>
    <div class="jieda-reply">
              <span class="jieda-zan zanok" type="zan">
                <i class="iconfont icon-zan"></i>
                <em>66</em>
              </span>
                <span type="reply" class="reply_bt" pid='{{$item->id}}'>
                <i class="iconfont icon-svgmoban53"></i>
                回复
              </span>
        <div class="jieda-admin">
            <span type="edit">编辑</span>
            <span type="del">删除</span>
            <!-- <span class="jieda-accept" type="accept">采纳</span> -->
        </div>
    </div>
        <ul style="margin-left: 50px;">
            @include('main::index.fillDatas.childComment')
              @if($item->childs->total>3)
                <p><a href="javascript:void(0)" class="more"  name="{{$item->id}}">共{{$item->childs->total}}条评论,点击查看更多</a></p>
              @endif
        </ul>
             @if(count($item->childs->data>4))
              <div id="c_fpage_{{$item->article_id}}_{{$key+1}}" name="{{$item->id}}"style="padding-left: 50px;"></div>
             @endif

</li>
@endforeach

