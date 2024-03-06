	@php
	$module_id = hashids_decode($module_hash_id);
	$check_fav = \Favourite::check($module, $module_id);

	if($check_fav){
		$fav_text = isset($btn_text_unfavourite)?$btn_text_unfavourite:__('developnet-lms::labels.spans.span_remove_from_fav');
	}else{
		$fav_text = isset($btn_text_favourite)?$btn_text_favourite:__('developnet-lms::labels.spans.span_add_to_fav');
	}

	
   @endphp
	<div class="add-to-fav">
		<a href="javascript:;" class="add-to favourite-action" title="{{$fav_text}}" data-url="{{route('ajax.favourite', ['module' => $module, 'module_id' => $module_hash_id])}}">
		  				<i class="fa fa-heart"></i>
		  				<span>{{$fav_text}}</span>
		  		</a>		
					  	</div>

