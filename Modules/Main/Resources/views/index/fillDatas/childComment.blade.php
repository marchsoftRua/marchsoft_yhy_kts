             @foreach($item->childs->data as $cc)
             <li style="margin: 10px 0;">
                 
                <div class="fly-detail-user">
                    <a href="/user_home/{{$cc->send_user->user_playname}}" class="fly-link">
                        <cite>{{$cc->send_user->name}}</cite>
                        <i class="iconfont icon-renzheng" title="认证信息：XXX"></i>
                        <!-- <i class="layui-badge fly-badge-vip">VIP3</i> -->

                    </a>
                   @if($item->author==$cc->send_user->id)
                     <span style="font-size: 13px;color: #999">(楼主)</span>
                    @endif
                    <span>回复</span>
                    <!-- <cite>回复<a href="">{{$cc->send_user->name}}</a>:</cite> -->
                    <a href="/user_home/{{$cc->rec_user->user_playname}}" class="fly-link">
                        <cite>{{$cc->rec_user->name}}</cite>
                        <i class="iconfont icon-renzheng" title="认证信息：XXX"></i>
                        <!-- <i class="layui-badge fly-badge-vip">VIP3</i> -->
                    </a>
                    @if($item->childs->author==$cc->rec_user->id)
                     <span style="font-size: 13px;color: #999">(楼主)</span>
                    @endif
                    <span>
                        {!!$cc->comment_inner!!}
                    </span>

                    <!--
                    <span style="color:#5FB878">(管理员)</span>
                    <span style="color:#FF9E3F">（社区之光）</span>
                    <span style="color:#999">（该号已被封）</span>
                    -->
                </div>
                <div class="jieda-reply">
                      <span class="jieda-zan" type="zan">
                        <i class="iconfont icon-zan"></i>
                        <em>0</em>
                      </span>
                       <span type="reply" class="reply_bt" pid="{{$cc->parent_id}}" toid="{{$cc->user_id}}">
                        <i class="iconfont icon-svgmoban53"></i>
                        回复
                      </span>
                      <span>{{$cc->created_at}}</span>
                        @if($item->author==getUserInfo()->id)
                        <div class="jieda-admin">
                            <span class="childs-nav" c_id="{{$cc->id}}">
                                  <span type="edit">
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
             </li>
             @endforeach
