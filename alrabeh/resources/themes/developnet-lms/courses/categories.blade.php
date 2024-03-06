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
						<h3>@lang('developnet-lms::labels.headings.text_categories')</h3>
					</div>
					<div class="other-courses categories">
						<div class="row">
							@if($categories->count())
								@foreach($categories as $category)
								
									<div class="col-md-4 col-sm-6">
							 			@include('courses.partials.grid_categories')
									</div>
									
								@endforeach
							@else
								<center>
									
									@lang('developnet-lms::labels.headings.text_categories_msg')

								</center>							
							@endif 

							
						</div>
					</div>
				</div>
				@include('partials.sidebar')
			</div>
		</div>
	</section>


@endsection