@php

	$user = new \Modules\Components\LMS\Models\UserLMS;
	if(Auth::check()){

	$user = \Modules\Components\LMS\Models\UserLMS::find(Auth()->id());

	}

	@endphp


<div class="p-course-item">
	<div class="media course-item-content">
		<img src="{{$quiz->thumbnail}}" alt="course-name">
		<div class="media-body row">
			<div class="row">
				<div class="">
					<div><a href="{{ route('quizzes.show', $quiz->hashed_id) }}">{{$quiz->title}}</a></div>
					<div>
						<p>{!!  str_limit(strip_tags($quiz->content) ,150) !!}</p>
					</div>
				</div>
				<div class="col-sm-3 item-content-badges ">
						@php
							if($quiz->sale_price > 0){

								$quizPrice = $quiz->sale_price;

							}else{
								$quizPrice = $quiz->price;
							}
						@endphp


						@if($quizPrice > 0)

						@if($quiz->sale_price < $quiz->price)
						    <span class="subject-value-deleted">{{$quiz->pric}} ريال</span>
						@endif
						    <span class="badge badge-danger">{{$quizPrice}} ريال</span>
						@else
						    <span class="badge badge-success"> @lang('developnet-lms::labels.spans.span_free')</span>
						@endif
				</div>
			</div>
		</div>
	</div>
	<div class="course-list-desc with-comment">
		<ul>
			@if($quiz->duration && $quiz->duration_unit)
			<li>
				<span>@lang('developnet-lms::labels.spans.exam_duration')</span> :
				<small>

					{{$quiz->duration}} @if($quiz->duration > 2 && $quiz->duration < 11)@lang('LMS::attributes.main.minutes') @else @lang('LMS::attributes.main.minute')
					@endif

				</small>
			</li>
			@endif
			@if($quiz->questions->count())
			<li>
				<span>@lang('developnet-lms::labels.spans.questions_num')</span> :
				<small>

					{{$quiz->questions()->count()}}</small>
			</li>
			@endif

			<li class="text-muted text-small">
				<small>
					<i class="fa fa-group"></i>
					<span>{{$quiz->enrolled_students + $quiz->subscriptions()->count()}}</span>
				</small>

			</li>

		{{-- 	<li class="text-muted text-small">
				<small>
					<i class="fa fa-comment"></i>
  				<span>0</span>
				</small>

			</li> --}}
		</ul>
		 @include('components.favourite_action', ['module' => 'quiz', 'module_hash_id' => $quiz->hashed_id])
	</div>
</div>

