				@php
				$is_subscribed = \Subscriptions::is_subscribed([
					'user' => userLMS(),
					'module' => 'plan',
					'module_id' => $plan->id
				]);

				    $catCoursesCount = 0;
				    $catQuizzesCount =  0;
				    $catQuestionsCount =  0;

				if($categories = $plan->categories()->with('courses')->with('quizzes')){
					$catIds = $categories->pluck('lms_categories.id')->toArray();

				    $catCoursesCount = \Modules\Components\LMS\Models\Course::whereHas('categories', function($q) use ($catIds){
										$q->whereIn('lms_categories.id', $catIds);
									})->count();
				    $catQuizzes = \Modules\Components\LMS\Models\Quiz::whereHas('categories', function($q) use ($catIds){
										$q->whereIn('lms_categories.id', $catIds);
									})->get();
				    if($catQuizzesCount = $catQuizzes->count()){

				    	 $catQuizzesIds = [];

				    $catQuizzesIds = $catQuizzes->pluck('lms_quizzes.id' )->toArray();

            if(in_array(null,  $catQuizzesIds, true)){
                     $catQuestionsCount = \Modules\Components\LMS\Models\Question::whereHas('quizzes', function($q) use ($catQuizzesIds){
										$q->whereIn('lms_quizzes.id', $catQuizzesIds);
									})->count();

            }

				    }

				}


				@endphp
				@php
				if($plan->sale_price > 0){
                 $plan_price = $plan->sale_price?:0;
				}else{
                  $plan_price = $plan->price;
				}
				 
				@endphp

				<div class="col-sm-12 col-lg-4">
					<div class="pricing-grid {{$plan->is_featured? 'colored':'' }} {{$is_subscribed?'subscribed':''}}">

						<div class="pricing_grid">
							<div class="pricing-top ">
								<h3>{{$plan->title}}</h3>
							</div>
								<div class="pricing-info ">
                                @if($plan_price > 0)
								<p>{{$plan_price}}</p>
								@else
								<p>@lang('developnet-lms::labels.spans.span_free')</p>
								@endif
                                
								</div>
							<div class="pricing-bottom">
								<div class="pricing-bottom-bottom">
									<p>{!! $plan->content !!}</p>
{{-- 									@if($coursesCount = $plan->courses()->count() || $catCoursesCount)

									<p><span class="fa fa-check"></span><span> عدد الكورسات : </span> <small> {{$coursesCount + $catCoursesCount}} </small></p>

									@else

									<p><span class="fa fa-times"></span><span> عدد الكورسات : </span> <small> 0 </small></p>

									@endif

								@if($quizzesCount = $plan->quizzes()->count() || $catQuizzesCount)

									<p><span class="fa fa-check"></span><span> عدد  الاختبارات : </span> <small> {{$quizzesCount + $catQuizzesCount}} </small></p>

									@else

									<p><span class="fa fa-times"></span><span> عدد  الاختبارات : </span> <small> 0 </small></p>

								@endif

								@php
								$questionsCount = 0;

								if($plan->quizzes()->count()){
									$quizzesIds = [];
									$quizzesIds = $plan->quizzes()->pluck('lms_quizzes.id')->toArray();

									$questionsCount = \Modules\Components\LMS\Models\Question::whereHas('quizzes', function($q) use ($quizzesIds){
										$q->whereIn('lms_quizzes.id', $quizzesIds);
									})->count();

								}

								@endphp

								@if($questionsCount || $catQuestionsCount)

									<p><span class="fa fa-check"></span><span>  عدد الأسئلة : </span> <small> {{$questionsCount + $catQuestionsCount}} </small></p>

									@else

									<p><span class="fa fa-times"></span><span> عدد الأسئلة : </span> <small> 0 </small></p>

								@endif --}}
								<hr>
								<p style="text-align: center;"><a href="{{route('plans.show', $plan->hashed_id)}}"> - <strong>عرض الباقة</strong> - </a></p>
								<hr>
								</div>
								<div class="buy-btn">

									@if($is_subscribed)

									<a href="javascript:;">
										{{__('developnet-lms::labels.links.you_subscribed')}}
										</a>
										@else
		{!! Form::model($plan, ['url' => route('subscriptions.subscribe',['module' => 'plan', 'module_id'=> $plan->hashed_id]),'method'=>'POST','files'=>true]) !!}
										<button type="submit">
										{{__('developnet-lms::labels.links.link_subscribe_now')}}
										</button>

						{!! Form::close() !!}

										@endif



								</div>
							</div>
						</div>
					</div>
				</div>