<div class="item subject-block">
  	<a href="{{route('plans.category',['plan' => $plan->hashed_id , 'category' => $category->hashed_id])}}" class="subject-img">
  		<img src="{{$category->thumbnail}}">
  		<span class="subject-read-more">@lang('developnet-lms::labels.links.link_read_more')</span>
  	</a>
  	<div class="subject-content">
		<a href="{{route('categories.show',$category->hashed_id)}}" class="sub-content-title">{{$category->name}}</a>
  	</div> 
</div> 