@php

	$user = new \Modules\Components\LMS\Models\UserLMS;
	if(Auth::check()){

	$user = \Modules\Components\LMS\Models\UserLMS::find(Auth()->id());

	}

	@endphp


<div class="p-course-item">
	<div class="media course-item-content">
		<img src="{{$exercise->thumbnail}}" alt="course-name">
		<div class="media-body row">
			<div class="row">
				<div class="">
					<div><a href="{{ route('exercises.show', $exercise->hashed_id) }}">{{$exercise->title}}</a></div>
					<div>
						<p>{!!  str_limit(strip_tags($exercise->content) ,150) !!}</p>
					</div>
				</div>
				<div class="col-sm-3 item-content-badges ">


					@if($exercise->sale_price)
						@if($exercise->sale_price ==0)
							<span class="badge badge-success"> @lang('developnet-lms::labels.spans.span_free')</span>
						@elseif($exercise->sale_price == $exercise->price || $exercise->price < $exercise->sale_price )

							<span class="badge badge-danger">{{$exercise->sale_price}}$</span>
						@else
						<span class="subject-value-deleted">{{$exercise->price}}$</span>
							<span class="badge badge-danger">{{$exercise->sale_price}}$</span>
						@endif

					@endif


				</div>
			</div>
		</div>
	</div>
	<div class="course-list-desc with-comment">
		<ul>
			@if($exercise->categories()->count())
			<li>
				<span>تصنيفات </span> :
			@foreach($exercise->categories()->get() as $category)
				<small>{{$category->name}},</small>
		    @endforeach
			</li>
			@endif
			@if($exercise->questions->count())
			<li>
				<span>@lang('developnet-lms::labels.spans.questions_num')</span> :
				<small>

					{{$exercise->questions()->count()}}</small>
			</li>
			@endif

			<li class="text-muted text-small">
				<small>
					<i class="fa fa-group"></i>
					<span>{{$exercise->enrolled_students + $exercise->subscriptions()->count()}}</span>
				</small>

			</li>

		{{-- 	<li class="text-muted text-small">
				<small>
					<i class="fa fa-comment"></i>
  				<span>0</span>
				</small>

			</li> --}}
		</ul>
		 @include('components.favourite_action', ['module' => 'exercise', 'module_hash_id' => $exercise->hashed_id])
	</div>
</div>

