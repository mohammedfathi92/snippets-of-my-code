@extends('layouts.master')
 
@section('css')
 {!! Theme::css('css/pages.css') !!}
@endsection

@section('content')	 
@php
if($category->parentCategory){
    $breadcrumb = [
        ['name' => __('developnet-lms::labels.links.link_page_home'), 'link' => '/'],
        ['name' => __('developnet-lms::labels.links.link_page_categories'), 'link' => url('/categories')],
        ['name' => $category->parentCategory->name, 'link' => url('/categories/'.$category->parentCategory->hashed_id)],
        ['name' => $category->name, 'link' => false],
    ];
    }else{
    $breadcrumb = [
        ['name' => __('developnet-lms::labels.links.link_page_home'), 'link' => '/'],
        ['name' => __('developnet-lms::labels.links.link_page_categories'), 'link' => url('/categories')],
        ['name' => $category->name, 'link' => false],
    ];

   }
    @endphp
  
	@include('partials.banner', ['page_title' => $category->name, 'breadcrumb' => $breadcrumb])
 
	<section class="page-content">
		<div class="container">
			<div class="row">

			
				
				<div class="col-md-9 course-wrap">
										<div class="page-side-title">
						<h3>الاقسام الفرعية</h3>
					</div>
					<div class="other-courses categories">
						<div class="row">
							@if($child_categories->count())
								@foreach($child_categories as $category)
								
									<div class="col-md-4 col-sm-6">
							 			@include('courses.partials.grid_categories')
									</div>
									
								@endforeach
							@else
								<center>
									
									لا توجد اي اقسام فرعية لهذا القسم .

								</center>							
							@endif 

							
						</div>
					</div>
					<hr>

					@if($plans->count())
							<div class="page-side-title">
								<h3>الباقات</h3>
							</div>
							<div class="other-courses">
								
								<div class="row">
									@foreach($plans as $plan)
									
										
								 			@include('plans.partials.grid_plans', ['plan' => $plan ])
										
										
									@endforeach
								</div>

								                          <hr>
                          <div class="row">
                         {{ $plans->links('partials.paginator') }}
                           
                          </div>
								
							</div>
						@endif
						<br><br>

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
		
				</div>
				@include('partials.sidebar')
			</div>
		</div>
	</section>


@endsection

 