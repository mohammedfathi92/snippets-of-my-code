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
		<button type="button" class="btn @if($check_fav) btn-success @else btn-default @endif btn-sm favourite-action-questions" title="{{$fav_text}}" data-url="{{route('ajax.favourite', ['module' => $module, 'module_id' => $module_hash_id])}}" data-favs_btn_id="{{isset($favs_btn_id)?$favs_btn_id:'favs-btn-questions'}}" data-module_id='{{$module_hash_id}}' data-q_url="{{isset($q_url)?$q_url:''}}">
		  				<i class="fa fa-heart"></i>
		  				<span>{{$fav_text}}</span>
		  		</button>		
					  	</div>



