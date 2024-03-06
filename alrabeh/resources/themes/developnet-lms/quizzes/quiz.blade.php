@extends('layouts.master')

@section('css')
 {!! Theme::css('css/pages.css') !!}



@endsection



	@php
$breadcrumb = [
	['name' => __('developnet-lms::labels.links.link_page_home'), 'link' => '/'],
	['name' => __('developnet-lms::labels.links.link_page_quizzes'), 'link' => route('quizzes.index')],
	['name' => $quiz->title, 'link' => false],
];
@endphp

@section('content')
	@php
		$authUser = new \Modules\Components\LMS\Models\UserLMS;
		if(Auth::check()){
		$authUser = \Modules\Components\LMS\Models\UserLMS::find(Auth()->id());
		}
		@endphp

	@include('partials.banner', ['page_title' => $quiz->title, 'breadcrumb' => $breadcrumb])

	<section class="page-content">
		<div class="container">
			<div class="row">
				<div class="col-md-9 course-wrap">
		@php

		$moduleArray = ['module' => 'quiz','module_id' => $quiz->id, 'user' => $authUser];
		$planned = \Subscriptions::planned($moduleArray);

		@endphp

			@if($planned['success'] && !$subscriptionStatus['success'])
				<div class="message message-warning alert alert-warning" role="alert"role="alert">
					<i class="fa"></i> <p> @lang('developnet-lms::labels.messages.planned_quiz_hint') </p>
					</div>
		    @endif

				{{-- 	<div class="course-title">
						<h3>{{$quiz->title}}</h3>
					</div> --}}
					<div class="course-guide-info">
						<ul class="course-guide-list">
							@if($quiz->categories->count())
							<li>
								<div class="title-span"><span>
								@lang('developnet-lms::labels.spans.span_category')
								</span></div>
								<div class="span-link">
									@foreach($quiz->categories as $category)
									<span><a href="{{ route('categories.show', $category->id) }}" >{{$category->name}}</a></span>
									@endforeach
								</div>
							</li>
							@endif
					{{-- 		<li>
								<div class="title-span"><span>
								@lang('developnet-lms::labels.spans.span_review')</span></div>
								<div class="review-rates ">
									<div class="review-stars">
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star checked"></span>
										<span class="fa fa-star"></span>
										<spanstar"></span>
									</d class="fa fa-iv>
									 <span class="review-num">(0 @lang('developnet-lms::labels.spans.span_reviews'))</span>
								</div>
							</li>  --}}
						</ul>
						@php



					@endphp
		 @include('components.favourite_action', ['module' => 'quiz', 'module_hash_id' => $quiz->hashed_id])
								<div class="take-it">

							@php

							if($quiz->sale_price > 0){

								$quizPrice = $quiz->sale_price;

							}else{
								$quizPrice = $quiz->price;
							}
							@endphp
							@if(!$subscriptionStatus['success'])

							{!! Form::model($quiz, ['url' => route('subscriptions.subscribe', ['module_id' => $quiz->hashed_id, 'module'=> 'quiz']),'method'=>'POST','files'=>true]) !!}
							@if($quizPrice > 0)
							<span class="money">{{$quizPrice}} ريال </span>
							@if($quiz->sale_price > 0)
							<span class="subject-value-deleted">{{$quiz->price}} ريال</span>
							@endif
							@else
							<span class="take-free "> @lang('developnet-lms::labels.spans.span_free')</span>
							@endif


							<button type="submit" class="colored-btn-red">@lang('developnet-lms::labels.spans.span_book_quiz')</button>

							{!! Form::close() !!}

							@else

	                        <a href="javascript:;" class="colored-btn-red" style="background-color: #f8b032; ">@lang('developnet-lms::labels.spans.span_booked')</a>
	                        {{-- <a data-toggle="modal" href="#showQuizModal" class="btn btn-danger"> عرض  الاختبار</a> --}}

	                        <a href="{{route('quizzes.show_questions', ['quiz_id' => $quiz->hashed_id])}}" class="btn btn-danger"> عرض الأسئلة</a>

							@endif

						</div>
					</div>
					@if($quiz->preview_video)

					@include('components.embeded_media', ['embeded' => $quiz->preview_video])
					@else

					@if($quiz->thumbnail)

					<div class="course-media">
						<img src="{{$quiz->thumbnail}}" alt="{{$quiz->title}}" style="max-width: 100%; height: auto; vertical-align: middle;">
                     </div>
                     @endif

					@endif
					<div class="course-details">
						<ul class="nav nav-tabs custom" id="myTab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">
						    	<i class="fa fa-bookmark"></i><span>@lang('developnet-lms::labels.tabs.tab_overview')</span></a>
						  </li>
				{{-- 		  <li class="nav-item">
						    <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">
						    	<i class="fa fa-comments"></i>
						    	<span>@lang('developnet-lms::labels.tabs.tab_reviews')</span>
						    </a>
						  </li> --}}
						</ul>
						<div class="tab-content custom" id="myTabContent">
						  	<div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
						  		<div class="row">
							  		<div class="thim-course-content col-md-8">

							  			@if($quiz->content)
							  			{!! $quiz->content !!}
							  			@else
								 	 	@lang('developnet-lms::labels.headings.text_quiz_msg')
								 	 	@endif
							  		</div>
							  		<div class="thim-course-info col-md-4">
							  			<h4 class="title">
							  				@lang('developnet-lms::labels.headings.text_course_details')
							  			</h4>
							  			<ul>
							  				@if($quiz->questions->count())
							  				<li class="lectures-feature">
							  					<i class="fa fa-files-o"></i>
							  					<span class="label">@lang('developnet-lms::labels.spans.questions')</span>
							  					 <span class="value">{{$quiz->questions->count()}}</span>
							  				</li>
							  				@endif

							  				@if($quiz->duration > 0 && $quizLogs->status < 1)
							  				<li class="duration-feature">
							  					<i class="fa fa-clock-o"></i>
							  					 <span class="label">@lang('developnet-lms::labels.spans.duration')</span>
							  					 <span class="value">{{$quiz->duration}} @if($quiz->duration > 2 && $quiz->duration < 11)@lang('LMS::attributes.main.minutes') @else @lang('LMS::attributes.main.minute')
					@endif</span>
							  				</li>
							  				@endif

							  				@if($quiz->sale_price)
							  				<li class="assessments-feature">
							  					<i class="fa fa-check-square-o"></i>
							  					<span class="label ">
							  						@lang('developnet-lms::labels.spans.price')
							  					</span>

							  					@if($quiz->sale_price ==0)
							  					<span class="take-free value"> @lang('developnet-lms::labels.spans.span_free')</span>
							  					@elseif($quiz->sale_price == $quiz->price || $quiz->price < $quiz->sale_price )
												<span class="money value">{{$quiz->sale_price}} ريال</span>
												@else
												<span class=" value">
													<small class="subject-value-deleted">{{$quiz->price}} ريال</small>
													<span class="money">{{$quiz->sale_price}} ريال</span>
												@endif
												</span>

							  				</li>
							  				@endif
							  			</ul>
							  		</div>
{{-- 							 <div class="text-right col-sm-12">
@include('components.favourite_action', ['module' => 'quiz', 'module_hash_id' => $quiz->id])
							  		</div> --}}
						  		</div>
						  	</div>
						  {{-- 	<div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
						  		<div class="row">
							  		<div class="course-rating col-sm-4">
							  			<div class="course-rating-content">
								  			<h4>@lang('developnet-lms::labels.headings.text_course_review')</h4>
								  			<div class="average-rating">
								  				<p class="rating-title">
								  					@lang('developnet-lms::labels.spans.span_review_average')
								  				</p>
								  				<div class="average-value">3</div>
								  				<div class="review-stars">
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star checked"></span>
													<span class="fa fa-star"></span>
													<span class="fa fa-star"></span>
												</div>
												<div class="review-amount">5 @lang('developnet-lms::labels.spans.span_reviews')</div>
								  			</div>
							  			</div>
							  		</div>
							  		<div class="col-sm-8">
							  			<div class="detailed-rating ">
								  			<h4>@lang('developnet-lms::labels.headings.text_review_details')</h4>
								  			<ul class="detailed-rating-list">
								  				<li>
								  					<div class="key">
								  					@lang('developnet-lms::labels.rating_option.5')</div>
								  					<div class="rate-progress">
								  						<div class="progress">
														 	<div class="progress-bar bg-warning" style="width:100%"></div>
														</div>
								  					</div>
								  					<span>100%</span>
								  				</li>
								  				<li>
								  					<div class="key">@lang('developnet-lms::labels.rating_option.4')</div>
								  					<div class="rate-progress">
								  						<div class="progress">
														 	<div class="progress-bar bg-warning" style="width:0"></div>
														</div>
								  					</div>
								  					<span>0</span>
								  				</li>
								  				<li>
								  					<div class="key">@lang('developnet-lms::labels.rating_option.3')</div>
								  					<div class="rate-progress">
								  						<div class="progress">
														 	<div class="progress-bar bg-warning" style="width:0"></div>
														</div>
								  					</div>
								  					<span>0</span>
								  				</li>
								  				<li>
								  					<div class="key">@lang('developnet-lms::labels.rating_option.2')</div>
								  					<div class="rate-progress">
								  						<div class="progress">
														 	<div class="progress-bar bg-warning" style="width:0"></div>
														</div>
								  					</div>
								  					<span>0</span>
								  				</li>
								  				<li>
								  					<div class="key">@lang('developnet-lms::labels.rating_option.1')</div>
								  					<div class="rate-progress">
								  						<div class="progress">
														 	<div class="progress-bar bg-warning" style="width:0"></div>
														</div>
								  					</div>
								  					<span>100%</span>
								  				</li>
								  			</ul>
								  		</div>
							  		</div>

						  		</div>
						  		<div class="course-add-rate">
					  				<ul>
					  					<li>
					  						@lang('developnet-lms::labels.spans.span_rate_course')
					  					</li>
					  					<li>
											<fieldset class="rating">
											    <input type="radio" id="star5" name="rating" value="5" />
											    <label class = "full" for="star5" title="Awesome - 5 stars"></label>

											    <input type="radio" id="star4half" name="rating" value="4 and a half" />
											    <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>

											    <input type="radio" id="star4" name="rating" value="4" />
											    <label class = "full" for="star4" title="Pretty good - 4 stars"></label>

											    <input type="radio" id="star3half" name="rating" value="3 and a half" />
											    <label class="half" for="star3half" title="Meh - 3.5 stars"></label>

											    <input type="radio" id="star3" name="rating" value="3" />
											    <label class = "full" for="star3" title="Meh - 3 stars"></label>

											    <input type="radio" id="star2half" name="rating" value="2 and a half" />
											    <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>

											    <input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>

											    <input type="radio" id="star1half" name="rating" value="1 and a half" />
											    <label class="half" for="star1half" title="Meh - 1.5 stars"></label>

											    <input type="radio" id="star1" name="rating" value="1" />
											    <label class = "full" for="star1" title="Sucks big time - 1 star"></label>

											    <input type="radio" id="starhalf" name="rating" value="half" />
											    <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
											</fieldset>
					  					</li>
					  				</ul>
						  		</div>
						  		<div class="course-review-comments">
						  			<ul>
						  				<li class="course-review-comment">
						  					<div class="media">
						  						<img src="/assets/themes/developnet-lms/img/user.png">
						  						<div class="media-body">
						  							<div class="comment-stars">
						  								<span>Mikle</span>
						  								<div class="review-stars">
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star"></span>
															<span class="fa fa-star"></span>
														</div>
						  							</div>
						  							<div class="comment-title">
						  								Beautiful theme - Awesome plugin
						  							</div>
						  							<p>Admin bar avatar Minhluu
														Beautiful theme - Awesome plugin

														5 stars for this theme too. Education WP theme brings the best LMS experience ever with super friendly UX and complete eLearning features. Really satisfied.
													</p>
													<span class="reply">@lang('developnet-lms::labels.spans.span_reply_comment')</span>
													<div class="reply-form contact-form">
														<form>
											       		<div class="form-group form-inline">
											              <div class="col-lg-12">
											                <textarea class="form-control" name="’Message" placeholder="التعليق" style="height: 150px;"></textarea>
											              </div>
											              <div class="col-md-4">
											                <input type="text" class="form-control" name="Name" placeholder="الاسم">
											              </div>
											              <div class="col-md-4">
											                <input type="mail" class="form-control" name="Mail" placeholder="الايميل">
											              </div>
											              <div class="col-md-4">
											                <input type="text" class="form-control" name="Title" placeholder="عنوان التعليق">
											              </div>
											              <div class="col-lg-12">
											                <input type="submit" name="Submit" value="تعليق" title="@lang('developnet-lms::attributes.inputs.input_add_comment')" class="colored-btn">
											              </div>
											            </div>
										            	</form>
										            </div>
						  						</div>
						  					</div>
						  				</li>
						  				<li class="course-review-comment">
						  					<div class="media">
						  						<img src="/assets/themes/developnet-lms/img/user.png">
						  						<div class="media-body">
						  							<div class="comment-stars">
						  								<span>Mikle</span>
						  								<div class="review-stars">
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star"></span>
															<span class="fa fa-star"></span>
														</div>
						  							</div>
						  							<div class="comment-title">
						  								Beautiful theme - Awesome plugin
						  							</div>
						  							<p>Admin bar avatar Minhluu
														Beautiful theme - Awesome plugin

														5 stars for this theme too. Education WP theme brings the best LMS experience ever with super friendly UX and complete eLearning features. Really satisfied.
													</p>
													<span class="reply">@lang('developnet-lms::labels.spans.span_reply_comment')</span>
													<div class="reply-form contact-form">
														<form>
											       		<div class="form-group form-inline">
											              <div class="col-lg-12">
											                <textarea class="form-control" name="’Message" placeholder="التعليق" style="height: 150px;"></textarea>
											              </div>
											              <div class="col-md-4">
											                <input type="text" class="form-control" name="Name" placeholder="الاسم">
											              </div>
											              <div class="col-md-4">
											                <input type="mail" class="form-control" name="Mail" placeholder="الايميل">
											              </div>
											              <div class="col-md-4">
											                <input type="text" class="form-control" name="Title" placeholder="عنوان التعليق">
											              </div>
											              <div class="col-lg-12">
											                <input type="submit" name="Submit" value="تعليق" title="@lang('developnet-lms::attributes.inputs.input_add_comment')" class="colored-btn">
											              </div>
											            </div>
										            	</form>
										            </div>
						  						</div>
						  					</div>
						  				</li>
						  				<li class="course-review-comment">
						  					<div class="media">
						  						<img src="/assets/themes/developnet-lms/img/user.png">
						  						<div class="media-body">
						  							<div class="comment-stars">
						  								<span>Mikle</span>
						  								<div class="review-stars">
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star checked"></span>
															<span class="fa fa-star"></span>
															<span class="fa fa-star"></span>
														</div>
						  							</div>
						  							<div class="comment-title">
						  								Beautiful theme - Awesome plugin
						  							</div>
						  							<p>Admin bar avatar Minhluu
														Beautiful theme - Awesome plugin

														5 stars for this theme too. Education WP theme brings the best LMS experience ever with super friendly UX and complete eLearning features. Really satisfied.
													</p>
													<span class="reply">@lang('developnet-lms::labels.spans.span_reply_comment')</span>
													<div class="reply-form contact-form">
														<form>
											       		<div class="form-group form-inline">
											              <div class="col-lg-12">
											                <textarea class="form-control" name="’Message" placeholder="التعليق" style="height: 150px;"></textarea>
											              </div>
											              <div class="col-md-4">
											                <input type="text" class="form-control" name="Name" placeholder="الاسم">
											              </div>
											              <div class="col-md-4">
											                <input type="mail" class="form-control" name="Mail" placeholder="الايميل">
											              </div>
											              <div class="col-md-4">
											                <input type="text" class="form-control" name="Title" placeholder="عنوان التعليق">
											              </div>
											              <div class="col-lg-12">
											                <input type="submit" name="Submit" value="تعليق" title="@lang('developnet-lms::attributes.inputs.input_add_comment')" class="colored-btn">
											              </div>
											            </div>
										            	</form>
										            </div>
						  						</div>
						  					</div>
						  				</li>
						  			</ul>
						  		</div>
					  			<div class="add-comment contact-form ">
							       		<h4>@lang('developnet-lms::labels.headings.text_add_comment')</h4>
							       	<form>
						       		<div class="form-group form-inline">
						              <div class="col-lg-12">
						                <textarea class="form-control" name="Message" placeholder="{{__('developnet-lms::attributes.inputs.input_comment')}}" style="height: 250px;"></textarea>
						              </div>
						              <div class="col-md-4">
						                <input type="text" class="form-control" name="Name" placeholder="{{__('developnet-lms::attributes.inputs.input_name')}}">
						              </div>
						              <div class="col-md-4">
						                <input type="mail" class="form-control" name="Mail" placeholder="{{__('developnet-lms::attributes.inputs.input_email')}}">
						              </div>
						              <div class="col-md-4">
						                <input type="text" class="form-control" name="Title" placeholder="{{__('developnet-lms::attributes.inputs.input_comment_title')}}">
						              </div>
						              <div class="col-lg-12">
						                <input type="submit" name="Submit" value="{{__('developnet-lms::attributes.inputs.btn_comment')}}" title="@lang('developnet-lms::attributes.inputs.input_add_comment')" class="colored-btn">
						              </div>
						            </div>
					            </form>
						       	</div>
						  	</div> --}}
                         @include('partials.media_share')
						</div>

					</div>


					@if($relatedQuizzes->count())
					<div class="page-side-title">
						<h4>@lang('developnet-lms::labels.headings.text_related_quizzes')</h4>
					</div>
					<div class="other-courses">
						<div class="row">
							@foreach($relatedQuizzes->get() as $relatedQuiz)

							<div class="col-md-4 col-sm-6">
								@include('quizzes.partials.grid_quiz_1', ['quiz' =>  $relatedQuiz])
							</div>
							@endforeach
						</div>
					</div>
					@endif

				</div>

				<!-- Side bar-->
				@include('partials.sidebar')
			</div>
		</div>
	</section>


@endsection

@section('after_content')
@include('partials.quiz_body.show_modal', ['modal_id' => 'showQuizModal'])

@endsection


