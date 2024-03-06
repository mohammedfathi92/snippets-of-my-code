@extends('layouts.master')

@section('css')
 {!! Theme::css('css/pages.css') !!}
@endsection

@section('content')	

	@include('partials.banner') 

	<section class="page-content">
		<div class="container">
			<div class="row">
				
				<!-- Page Content-->
				<div class="col-md-9">
					<div class="page-side-title">
						<h3>@lang('developnet-lms::labels.headings.text_all_quizzes')</h3>
					</div>
					@if($quizzes->count())
						@foreach($quizzes as $quiz)
						
					 		@include('quizzes.partials.list_quiz', ['quiz' => $quiz ])
							
						@endforeach
						<hr>
                          <div class="row">
                         {{ $quizzes->links('partials.paginator') }}
                           
                          </div>
						@else
							<center>
								@lang('developnet-lms::labels.headings.text_quiz_msg')
							</center>
					@endif

					
				</div>	

				<!-- Side bar-->
				@include('partials.sidebar')
			
			</div>
		</div>
	</section>


@endsection
 
