@extends('layouts.master')
 
@section('css')
 {!! Theme::css('css/pages.css') !!} 
@endsection

@section('content')	 
 
	@include('partials.banner')
 
	<section class="page-content">
		<div class="container">
			<div class="row">
				<div class="col-md-9 course-wrap">
					<div class="page-side-title">
						<h3>@lang('developnet-lms::labels.headings.text_all_courses')</h3>
					</div>
					<div class="other-courses">
						@if($courses->count())
						<div class="row">
							@foreach($courses as $course)
							
								<div class="col-md-4 col-sm-6">
						 			@include('courses.partials.grid_courses_1', ['course' => $course ])
								</div>
								
							@endforeach
						</div>
						<hr>
                          <div class="row">
                         {{ $courses->links('partials.paginator') }}
                           
                          </div>
						@else
							@lang('developnet-lms::labels.headings.text_course_msg')
						@endif
					</div>
				</div>
				@include('partials.sidebar')
			</div>
		</div>
	</section>


@endsection

 