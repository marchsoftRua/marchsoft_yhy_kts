

@foreach($comment as $item)
<li data-id="111" class="jieda-daan">
    <a name="item-1111111111"></a>
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
        <p>香菇那个蓝瘦，这是一条被采纳的回帖</p>
    </div>
    <div class="jieda-reply">
              <span class="jieda-zan zanok" type="zan">
                <i class="iconfont icon-zan"></i>
                <em>66</em>
              </span>
        <span type="reply">
                <i class="iconfont icon-svgmoban53"></i>
                回复
              </span>
        <div class="jieda-admin">
            <span type="edit">编辑</span>
            <span type="del">删除</span>
            <!-- <span class="jieda-accept" type="accept">采纳</span> -->
        </div>
    </div>
    <pre>
{{$item->childs}}
</pre>

</li>
@endforeach