@php

	$user = new \Modules\Components\LMS\Models\UserLMS;
	if(Auth::check()){

	$user = \Modules\Components\LMS\Models\UserLMS::find(Auth()->id());

	}
@endphp


<div class="p-course-item">
	<div class="media course-item-content">
		<img src="{{$course->thumbnail}}" alt="course-name">
		<div class="media-body row">
			<div class="row">
				<div class="">
					<div><a href="{{ route('quizzes.show', $course->hashed_id) }}">{{$course->title}}</a></div>
					<div>
						<p>{!!  str_limit(strip_tags($course->content) ,150) !!}</p>
					</div>
				</div>
				<div class="col-sm-3 item-content-badges">


					@if($course->sale_price)
						@if($course->sale_price ==0)
							<span class="badge badge-success"> @lang('developnet-lms::labels.spans.span_free')</span>
						@elseif($course->sale_price == $course->price || $course->price < $course->sale_price )

							<span class="badge badge-danger">{{$course->sale_price}} ريال</span>
						@else
						<span class="subject-value-deleted">{{$course->price}} ريال</span>
							<span class="badge badge-danger">{{$course->sale_price}} ريال</span>
						@endif

					@endif


				</div>
			</div>
		</div>
	</div>
	<div class="course-list-desc with-comment">
		<ul>
			@if($course->duration && $course->duration_unit)
			<li>
				<span>@lang('developnet-lms::labels.spans.exam_duration')</span> :
				<small>

					{{$course->duration}} @if($course->duration > 2 && $course->duration < 11)@lang('LMS::attributes.main.minutes') @else @lang('LMS::attributes.main.minute')
					@endif

				</small>
			</li>
			@endif
		@if($course->lessons->count())
			<li>
				<span>@lang('developnet-lms::labels.spans.lessons_num')</span> :
				<small>

					{{$course->lessons()->count()}}</small>
			</li>
			@endif
			@if($course->quizzes->count())
			<li>
				<span>@lang('developnet-lms::labels.spans.questions_num')</span> :
				<small>

					{{$course->quizzes()->count()}}</small>
			</li>
			@endif

			<li class="text-muted text-small">
				<small>
					<i class="fa fa-group"></i>
					<span>{{$course->enrolled_students + $course->subscriptions()->count()}}</span>
				</small>

			</li>

		{{-- 	<li class="text-muted text-small">
				<small>
					<i class="fa fa-comment"></i>
  				<span>0</span>
				</small>

			</li> --}}
		</ul>
		 @include('components.favourite_action', ['module' => 'quiz', 'module_hash_id' => $course->hashed_id])
	</div>
</div>

