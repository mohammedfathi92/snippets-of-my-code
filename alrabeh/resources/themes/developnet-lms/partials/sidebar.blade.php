@php
$lastCreatedCourses= \LMS::leatestCourses();

$lastCreatedQuizzes = \LMS::leatestQuizzes();
@endphp
<div class="col-md-3 side-bar">
	@if(isset($show_plan_grid))
	@include('plans.partials.grid_plan_1', ['plan' => $plan, 'is_subscribed' => $is_subscribed])
	@endif
	<div class="side-news">
		
		@if($lastCreatedCourses->count())
			<div class="page-side-title">
				<h4>@lang('developnet-lms::labels.headings.text_latest_courses')</h4>
			</div>
			

			@foreach($lastCreatedCourses->get() as $row)
			@php

			if($row->sale_price > 0){
				$rowPrice = $row->sale_price;
			}else{
				$rowPrice = $row->price;
			}

			@endphp

				<div class="media">
					<img src="{{$row->thumbnail}}">
					<div class="media-body">
						<div class="news-title">
							<a href="{{route('courses.show',$row->hashed_id)}}">{{$row->title}}</a>
						</div>
						<div class="news-meta">

							@if($rowPrice > 0)
							<span class="subject-value"> {{$rowPrice}}$</span>
							    @if($row->sale_price > 0 && $row->sale_price < $row->price)

							<span class="subject-value-deleted">{{$row->price}} $</span>
							@endif
							@else

							<span class="subject-value-free"> @lang('developnet-lms::labels.spans.span_free')</span>

							@endif	

							

						</div>
					</div>	
				</div>
			@endforeach
		@endif

		@if($lastCreatedQuizzes->count())
			<div class="page-side-title">
				<h4>@lang('developnet-lms::labels.headings.text_latest_quizzes')</h4>
			</div>
		@foreach($lastCreatedQuizzes->get() as $row)
			@php

			if($row->sale_price > 0){
				$rowPrice = $row->sale_price;
			}else{
				$rowPrice = $row->price;
			}

			@endphp
				<div class="media">
					<img src="{{$row->thumbnail}}">
					<div class="media-body">
						<div class="news-title">
							<a href="{{route('quizzes.show',$row->hashed_id)}}">{{$row->title}}</a>
						</div>
						<div class="news-meta">

							@if($rowPrice > 0)
							<span class="subject-value"> {{$rowPrice}}$</span>
							   @if($row->sale_price > 0 && $row->sale_price < $row->price)
							<span class="subject-value-deleted">{{$row->price}} $</span>
							@endif

							@else

							<span class="subject-value-free"> @lang('developnet-lms::labels.spans.span_free')</span>

							@endif	

							

						</div>
					</div>	
				</div>
			@endforeach

		@endif
	</div>
	@if(\Settings::get('sidebar_bannar_img'))
	<div class="side-adv">
		<a href="{{\Settings::get('sidebar_bannar_url')}}"><img src="{{\Settings::get('sidebar_bannar_img')}}"></a>							
	</div>
	@endif
</div>