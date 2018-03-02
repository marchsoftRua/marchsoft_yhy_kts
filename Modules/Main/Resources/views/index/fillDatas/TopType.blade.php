@if($lists->current_page-1>0)
<li><i class="layui-icon page_switch" page_num="{{$lists->current_page-1}}" bt-type='left'>&#xe603;</i></li>
@endif
	<li  class="layui-hide-xs layui-this"><a href="/">全部</a></li>
@foreach($lists->data as $item)
	@if($current_path==$item->url)
		<li  class="layui-hide-xs layui-this"><a href="{{$item->url}}">{{ $item->type_name}}</a></li>
	@else
		<li><a href="{{$item->url}}" >{{ $item->type_name}}</a></li>
	@endif
@endforeach
@if($lists->current_page<$lists->last_page)
<li><i class="layui-icon page_switch" page_num="{{$lists->current_page+1}}">&#xe602;</i></li>
@endif