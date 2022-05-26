@if(@$totalData !== 0)
	@foreach (@$lists as $list)	
		<li id="l_{{@$list->id}}">
			<img class="selectimage" dataimage="{{URL::to('/public/img/media_gallery')}}/{{@$list->images}}" id="s_{{@$list->id}}" dataid="{{@$list->id}}" width="100" height="100" src="{{URL::to('/public/img/media_gallery')}}/{{@$list->images}}">
			<a href="javascript:;" class="removeimage" removeid="sho_{{@$list->id}}" id="{{@$list->id}}"><i class="fa fa-times"></i></a>
		</li>
	@endforeach	
@else
		
@endif 