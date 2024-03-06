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
						<h3>قائمة  مجموعات الأسئلة التدريبية </h3>
					</div>
					@if($exercises->count())
						@foreach($exercises as $exercise)
						
					 		@include('exercises.partials.list_exercise', ['exercise' => $exercise ])
							
						@endforeach
						@else
							<center>
								@lang('developnet-lms::labels.headings.text_exercise_msg')
							</center>
					@endif

					
				</div>	

				<!-- Side bar-->
				@include('partials.sidebar')
			
			</div>
		</div>
	</section>


@endsection
 
