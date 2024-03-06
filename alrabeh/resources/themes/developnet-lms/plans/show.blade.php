@extends('layouts.master')
 
@section('css')
 {!! Theme::css('css/pages.css') !!}
@endsection

@section('content')	 
@php
    $breadcrumb = [
        ['name' => __('developnet-lms::labels.links.link_page_home'), 'link' => '/'],
        ['name' => __('developnet-lms::labels.links.link_page_plans'), 'link' => url('/packages')],
        ['name' => $plan->title, 'link' => false],
    ];


				$is_subscribed = \Subscriptions::is_subscribed([
					'user' => userLMS(),
					'module' => 'plan',
					'module_id' => $plan->id
				]);


    @endphp
  
	@include('partials.banner', ['page_title' => $plan->title, 'breadcrumb' => $breadcrumb])
 
	<section class="page-content">
		<div class="container">
			<div class="row">
				<div class="col-md-9 course-wrap">

					<div class="page-side-title">
						<h3>الاقسام الفرعية</h3>
					</div>
					<div class="other-courses categories">
						<div class="row">
							@if($categories->count())
								@foreach($categories as $category)
								
									<div class="col-md-4 col-sm-6">
							 			@include('plans.partials.grid_categories', ['category' => $category, 'plan' => $plan])
									</div>
									
								@endforeach
						
							@endif 

							
						</div>
					</div>
					<hr>
			
						@if($courses->count())
							<div class="page-side-title">
								<h3>@lang('developnet-lms::labels.headings.text_courses_related_category')</h3>
							</div>
							<div class="other-courses">
								
								<div class="row">
									@foreach($courses as $course)
									
										<div class="col-lg-11">
								 			@include('courses.partials.list_courses_1', ['course' => $course ])
										</div>
										
									@endforeach
								</div>

								                          <hr>
                          <div class="row">
                         {{ $courses->links('partials.paginator') }}
                           
                          </div>
								
							</div>
						@endif
						<br><br>
						<div class="row">
							<div class="col-lg-11">	
								@if($quizzes->count())
								<div class="page-side-title">
									<h3>@lang('developnet-lms::labels.headings.text_quizzes_related_category')</h3>
								</div>
								<div class="other-courses">
									
									<div class="row">
										@foreach($quizzes as $quiz)
										
									 			@include('quizzes.partials.list_quiz', ['quiz' => $quiz ])
											
										@endforeach
									</div>

									<hr>
                          <div class="row">
                         {{ $quizzes->links('partials.paginator') }}
                           
                          </div>
									
								</div>
							@endif
							</div>
						</div>

												<br><br>
{{-- 						<div class="row">
							<div class="col-lg-11">	
								@if($books->count())
								<div class="page-side-title">
									<h3>الكتب </h3>
								</div>
								<div class="other-courses">
									
									<div class="row">
										@foreach($books as $book)
										
									 			@include('books.partials.list_books', ['book' => $book])
											
										@endforeach
									</div>

									<hr>
                          <div class="row">
                         {{ $books->links('partials.paginator') }}
                           
                          </div>
									
								</div>
							@endif
							</div>
						</div> --}}
					
				</div>
				@include('partials.sidebar', ['show_plan_grid' => true, 'plan' => $plan, 'is_subscribed' => $is_subscribed])
			</div>
		</div>
	</section>


@endsection


@php
$planned = [
	'success' => false,
	'status' => 0
];
$subscriptionStatus = [
	'success' => $is_subscribed,
];
				if($plan->sale_price > 0){
                 $plan_price = $plan->sale_price?:0;
				}else{
                  $plan_price = $plan->price;
				}

@endphp
	

@push('child_after_content')
@include('components.subscribe_modal', ['modal_id' => 'subPlan_'.$plan->hashed_id, 'subscriptionStatus' => $subscriptionStatus, 'planned' => $planned, 'module_data' => $plan, 'module' => 'plan', 'finalPrice' => $plan_price])
@endpush

@section('js')
@if($errors->has('coupon'))
<script type="text/javascript">
$(document).ready(function(){
        $("#{{'subPlan_'.$plan->hashed_id}}").modal('show');
    });
</script>
@endif
@endsection


 