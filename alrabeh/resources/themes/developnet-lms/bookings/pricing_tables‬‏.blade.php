@extends('layouts.master')

@section('css')
 {!! Theme::css('css/pages.css') !!}
@endsection

@section('content')	

	@include('partials.banner')	
	<!-- Page Content-->
	<section class="pricing-sec pt-50">
		<div class="container">
			@if($plans->count())
			<div class="page-side-title">
				<h3>@lang('developnet-lms::labels.headings.text_all_plans')</h3>
			</div>
			<div class="pricing-grids row">
				@foreach($plans as $plan)
				<div class="col-sm-6 col-lg-3">
					<div class="pricing-grid colored ">
						<div class="pricing_grid">
							<div class="pricing-top">
					 			<h3>{{$plan->title}}</h3>
							</div>
								<div class="pricing-info">
									@if($sale_price !=null)
										@if($sale_price == 0 )
											<p><big>@lang('developnet-lms::labels.spans.span_free')</big></p>
										@else
											<p><del>${{$plane->price}}</del><span>${{$plane->sale_price}}</span>
										 
											</p>
										@endif
									@endif
								</div>
							<div class="pricing-bottom">
								<div class="pricing-bottom-bottom">
									@if($plan->content)
									<p>
										<span class="fa fa-check"></span> 

										<small>{!! str_limit(strip_tags($plan->content) ,90) !!}</small>
									</p>
									@endif
									@if($plane->duration_type)
									<p><span class="fa fa-times"></span>
										<span>@lang('developnet-lms::labels.spans.plans_duration_type')</span> 
										<small>{{$plane->duration_type}}</small>
									</p>
									@endif
									@if($plane->duration)
									<p>
										<span class="fa fa-check"></span>
										<span>@lang('developnet-lms::labels.spans.plans_duration')</span> 
										<small>{{$plane->duration}}</small>
										 
									</p>
									@endif
									@if(count($plan->courses))
									<p>
										<span class="fa fa-check"></span> 
										<span>@lang('developnet-lms::labels.spans.courses_num')</span>
										<small>{{count($plan->courses)}}</small>
									</p>
									@endif
									@if(count($plan->quizzes))
									<p>
										<span class="fa fa-check"></span> 
										<span>@lang('developnet-lms::labels.spans.quizzes_num')</span>
										<small>{{count($plan->quizzes)}}</small>
									</p>
									@endif
								</div>
								<div class="buy-btn">
									<a href="booking.html">
										@lang('developnet-lms::labels.links.link_book_now')
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
				{{-- <div class="col-sm-6 col-lg-3">
					<div class="pricing-grid colored ">
						<div class="pricing_grid">
							<div class="pricing-top ">
								<h3>تربيه قوميه</h3>
							</div>
								<div class="pricing-info ">
									
									<p>@lang('developnet-lms::labels.spans.span_free')</p>
								</div>
							<div class="pricing-bottom">
								<div class="pricing-bottom-bottom">
									<p><span class="fa fa-times"></span><span>مستوي الكورس:</span> <small>صعب</small></p>
									<p><span class="fa fa-check"></span><span>عدد الساعات:</span> <small>18</small></p>

									<p><span class="fa fa-times"></span><span>عدد الامتحانات :</span> <small>15</small></p>  
									<p><span class="fa fa-times"></span><span>الايام:</span> <small>10</small></p>
									<p class="text"><span class="fa fa-times"></span><span>الاجتياز:</span> <small>70%</small></p>
								</div>
								<div class="buy-btn">
									<a href="booking.html">
										@lang('developnet-lms::labels.links.link_book_now')
									</a>
								</div>
							</div>
						</div>
					</div>
				</div> --}}
			</div>
			@else
			@lang('developnet-lms::labels.headings.text_plans_msg')
			<br><br>
			@endif
		</div>
	</section>
@endsection
 