             @foreach($item->childs->data as $cc)
             <li style="margin: 10px 0;">
                 
                <div class="fly-detail-user">
                    <a href="" class="fly-link">
                        <cite>贤心</cite>
                        <i class="iconfont icon-renzheng" title="认证信息：XXX"></i>
                        <i class="layui-badge fly-badge-vip">VIP3</i>
                    </a>

                    <span>(楼主):</span><span>
                        {{$cc->comment_inner}}
                    </span>
                    <!--
                    <span style="color:#5FB878">(管理员)</span>
                    <span style="color:#FF9E3F">（社区之光）</span>
                    <span style="color:#999">（该号已被封）</span>
                    -->
                </div>
                <div class="jieda-reply">
                      <span class="jieda-zan zanok" type="zan">
                        <i class="iconfont icon-zan"></i>
                        <em>66</em>
                      </span>
                       <span type="reply" class="reply_bt" pid="{{$cc->parent_id}}">
                        <i class="iconfont icon-svgmoban53"></i>
                        回复
                      </span>
                        <div class="jieda-admin">
                            <span type="edit">编辑</span>
                            <span type="del">删除</span>
                            <!-- <span class="jieda-accept" type="accept">采纳</span> -->
                        </div>
                </div>
             </li>
             @endforeach
