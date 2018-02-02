
<div class="layui-row layui-col-space15">
    <div class="layui-col-md8">
      <div class="fly-panel">
        <div class="fly-panel-title fly-filter">
          <a>置顶</a>
          <a href="#signin" class="layui-hide-sm layui-show-xs-block fly-right" id="LAY_goSignin" style="color: #FF5722;">去签到</a>
        </div>
      </div>
        <ul class="fly-list" id="setTop">
            {{--置顶区域  ul占位--}}
        </ul>

</div>

<div class="fly-panel" style="margin-bottom: 0;">

    <div class="fly-panel-title fly-filter">
        <a href="" class="layui-this">综合</a>
        <span class="fly-mid"></span>
        <a href="">未结</a>
        <span class="fly-mid"></span>
        <a href="">已结</a>
        <span class="fly-mid"></span>
        <a href="">精华</a>
        <span class="fly-filter-right layui-hide-xs">
            <a href="javascript:void(0);"  id="byNew">按最新</a>
            <span class="fly-mid"></span>
            <a href="javascript:void(0);" id="byHot">按热议</a>
          </span>
    </div>
    <ul class="fly-list" id="setMain">
        {{--ul标签占位--}}
        {{--全部数据展示区--}}
    </ul>

    <div style="text-align: center">
        <div class="laypage-main">
            <a href="javascript:void(0);" class="laypage-next" id="getmore">更多求解</a>
        </div>
    </div>

</div>