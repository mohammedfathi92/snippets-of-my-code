@extends('layouts.master')

@section('css')
    {!! Theme::css('css/pages.css') !!}
    <style>
        .grade-statics li {
            margin-bottom: 10px;
        }

        .grade-statics li span {
            font-size: 17px;
            display: inline-block;
            margin-left: 10px;
            width: 180px;
            text-align: right;
        }

        .course-grades-content {
            border: transparent;
            align-items: initial;
        }

        .course-grades {
            background: #fcfcfc;
            border: 1px solid #ddd;
            padding-bottom: 10px
        }

        .grades {
            margin-top: 10px
        }
    </style>

@endsection


@php

    $breadcrumb = [
        ['name' => __('developnet-lms::labels.links.link_page_home'), 'link' => '/'],
        ['name' => __('developnet-lms::labels.links.link_page_courses'), 'link' => route('courses.index')],
        ['name' => $course->title, 'link' => false],
    ];
@endphp

@section('content')
    @php
        $authUser = new \Modules\Components\LMS\Models\UserLMS;
        if(Auth::check()){
        $authUser = \Modules\Components\LMS\Models\UserLMS::find(Auth()->id());
        }

    @endphp

    @include('partials.banner', ['page_title' => $course->title, 'breadcrumb' => $breadcrumb])

    <section class="page-content">
        <div class="container">
            <div class="row">

                {{-- 	<div class="course-title">
                        <h3>{{$course->title}}</h3>
                    </div> --}}
                <div class="col-md-9 course-wrap">

                    @php
                        $planned = \Subscriptions::planned(['module' => 'course','module_id' => $course->id, 'user' => $authUser]);
                    @endphp

                    @if($planned['success'] && !$subscriptionStatus['success'])
                        @if($planned['status'] < 1)

                            <div class="message message-danger alert alert-danger" role="alert" role="alert">
                                <i class="fa"></i>
                                <p><strong>عفوًا ...</strong> لديك باقة تمكنك من الإشتراك بهذه الدورة التدريبية ولكن يجب
                                    عليك تفعيل اشتراكك بالباقة لتتمكن من الإشتراك بهذه الدورة التدريبية. </p>
                                <a href="{{url('/info-payment')}}" target="_blank">عرض طريقة تفعيل الإشتراك</a></div>

                        @else

                            <div class="message message-warning alert alert-warning" role="alert" role="alert">
                                <i class="fa"></i>
                                <p> @lang('developnet-lms::labels.messages.planned_quiz_hint') </p>
                            </div>
                        @endif
                    @endif

                    <div class="course-guide-info">
                        <ul class="course-guide-list">
                            @if($course->categories->count())
                                <li>
                                    <div class="title-span"><span>
								@lang('developnet-lms::labels.spans.span_category')
								</span></div>
                                    <div class="span-link">
                                        @foreach($course->categories as $category)
                                            <span><a href="{{ route('categories.show', $category->id) }}">{{$category->name}}</a></span>
                                        @endforeach
                                    </div>
                                </li>
                            @endif
                            <li>

                                <!-- add favourite button -->
                                @include('components.favourite_action', ['module' => 'course', 'module_hash_id' => $course->hashed_id])

                            </li>
                            {{-- @deleted_reviews --}}
                            {{--         <li>
                                            <div class="title-span"><span>
                                            @lang('developnet-lms::labels.spans.span_review')</span></div>
                                            <div class="review-rates ">
                                                <div class="review-stars">
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star checked"></span>
                                                    <span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                </div>
                                                 <span class="review-num">(0 @lang('developnet-lms::labels.spans.span_reviews'))</span>
                                            </div>
                                        </li>   --}}
                        </ul>
                        {{-- 	<div class="add-to-fav">
                                      <a href="#" class="add-to" title="{{__('developnet-lms::labels.spans.span_add_to_fav')}}">
                                          <i class="fa fa-heart"></i>
                                          <span>@lang('developnet-lms::labels.spans.span_add_to_fav')</span>
                                      </a>
                              </div> --}}
                        <div class="take-it">

                            @php

                                if($course->sale_price > 0){

                                    $coursePrice = $course->sale_price;

                                }else{
                                    $coursePrice = $course->price;
                                }
                            @endphp
                            @if(!$subscriptionStatus['success'])

                             
                                @if($coursePrice > 0)
                                    <span class="money">{{$coursePrice}} ريال</span>
                                    @if($course->sale_price > 0 && $course->sale_price < $course->price)

                                        <span class="subject-value-deleted">{{$course->price}} ريال</span>
                                    @endif
                                @else
                                    <span class="take-free "> @lang('developnet-lms::labels.spans.span_free')</span>
                                @endif


                                <button type="button"  data-toggle="modal" data-target="{{'#subCourse_'.$course->hashed_id}}" class="colored-btn-red"
                                        @if(($planned['success'] && $planned['status'] < 1) || ($subscriptionStatus['success'])) disabled=''
                                        style="background-color: #949596;" @endif>@lang('developnet-lms::labels.spans.span_subscribe_now')</button>

                               

                            @else
                                <a href="javascript:;" class="colored-btn-red"
                                   style="background-color: #f8b032; ">@lang('developnet-lms::labels.spans.span_booked')</a>

                            @endif

                        </div>

                    </div>

                    @if($course->preview_video)

                        @include('components.embeded_media', ['embeded' => $course->preview_video])
                    @else
                        @if($course->thumbnail)
                            <div class="course-media">
                                <img src="{{$course->thumbnail}}" alt="{{$course->title}}"
                                     style="max-width: 100%; height: 400px; vertical-align: middle;">
                            </div>
                        @endif

                    @endif
                    <div class="course-details">
                        <ul class="nav nav-tabs custom" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview"
                                   role="tab" aria-controls="overview" aria-selected="true">
                                    <i class="fa fa-bookmark"></i><span>
						    	@lang('developnet-lms::labels.tabs.tab_overview')</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="curriculum-tab" data-toggle="tab" href="#curriculum" role="tab"
                                   aria-controls="curriculum" aria-selected="false">
                                    <i class="fa fa-cube"></i><span>
						    	@lang('developnet-lms::labels.tabs.tab_curriclum')</span>
                                </a>
                            </li>
                            {{-- @deleted_reviews_1 --}}
                            {{--  <li class="nav-item">
                               <a class="nav-link" id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">
                                   <i class="fa fa-comments"></i>
                                   <span>
                                       @lang('developnet-lms::labels.tabs.tab_reviews')
                                   </span>
                               </a>
                             </li> --}}
                        </ul>

                        <div class="tab-content custom" id="myTabContent">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel"
                                 aria-labelledby="overview-tab">
                                <div class="row">
                                    <div class="thim-course-content col-md-8">
                                        @if($course->content)
                                            {!! $course->content !!}
                                        @else
                                            @lang('developnet-lms::labels.headings.text_content_msg')
                                        @endif
                                    </div>
                                    <div class="thim-course-info col-md-4">
                                        <h4 class="title">
                                            @lang('developnet-lms::labels.headings.text_course_details')
                                        </h4>
                                        <ul>
                                            @if(count($course->lessons))
                                                <li class="lectures-feature">
                                                    <i class="fa fa-files-o"></i>
                                                    <span class="label">@lang('developnet-lms::labels.spans.lectures')</span>

                                                    <span class="value">{{count($course->lessons)}}</span>
                                                </li>
                                            @endif
                                            @if($course->quizzes->count())
                                                <li class="quizzes-feature">
                                                    <i class="fa fa-puzzle-piece"></i>
                                                    <span class="label">
							  					@lang('developnet-lms::labels.spans.quizzes')
							  					</span>
                                                    <span class="value">{{$course->quizzes->count()}}</span>
                                                </li>
                                            @endif
                                            @if($course->duration && $course->duration_unit)
                                                <li class="duration-feature">
                                                    <i class="fa fa-clock-o"></i>
                                                    <span class="label">@lang('developnet-lms::labels.spans.duration')</span>
                                                    <span class="value">{{$course->duration}} {{$course->duration_unit}}</span>
                                                </li>
                                            @endif
                                            @if($course->enrolled_students)
                                                <li class="students-feature">
                                                    <i class="fa fa-users"></i>
                                                    <span class="label">@lang('developnet-lms::labels.spans.students')</span>
                                                    <span class="value">{{$course->enrolled_students}}</span>
                                                </li>
                                            @endif
                                            @if($course->sale_price)
                                                <li class="assessments-feature">
                                                    <i class="fa fa-check-square-o"></i>
                                                    <span class="label ">
							  						@lang('developnet-lms::labels.spans.price')
							  					</span>
                                                    @if($coursePrice > 0)
                                                        <span class="money value">{{$coursePrice}} ريال </span>
                                                        @if($course->sale_price > 0)
                                                            <span class="subject-value-deleted">{{$course->price}} ريال</span>
                                                        @endif
                                                    @else
                                                        <span class="take-free"
                                                              style="color: #28c14b;"> @lang('developnet-lms::labels.spans.span_free')</span>
                                                    @endif

                                                </li>
                                            @endif

                                        </ul>
                                    </div>

                                    {{-- 		<div class="text-right col-sm-12">
                                                                              <div class="add-to-fav ">
                                                                                      <a href="#" class="add-to" title="{{__('developnet-lms::labels.spans.span_add_to_fav')}}">
                                                                                          <i class="fa fa-heart"></i>
                                                                                          <span>@lang('developnet-lms::labels.spans.span_add_to_fav')</span>
                                                                                      </a>
                                                                              </div>
                                                                          </div> --}}

                                </div>
                            </div>
                            <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
                                @if($course->lessons->count())
                                    <ul class="curriculum-sections">

                                        @foreach($courseSections->orderBy('order','asc')
                                           ->with('lessons')->with('quizzes')->get() as $courseSection)

                                            @include('courses.partials.course_menu', ['section' =>  $courseSection, 'courseSections' => $courseSections,
                                            'user' => $authUser, 'course'=> $course])
                                        @endforeach
                                        @auth()
                                            <li class="course-item text-center" style="">

                                                <a class="btn btn-dark"
                                                   href="{{route('courses.results', ['course_id' => $course->hashed_id ])}}"><i
                                                            class="fa fa-list"></i> @lang('developnet-lms::labels.spans.show_results')
                                                </a>
                                            </li>
                                        @endauth
                                    </ul>
                                @else
                                    @lang('developnet-lms::labels.headings.text_curriclum_msg')
                                @endif
                            </div>
                            {{-- @deleted_reviews_2 --}}
                            {{-- 						  	<div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
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
                        </div>
                    </div>
                    @include('partials.media_share')

                    @if($relatedCourses->count())
                        <div class="page-side-title">
                            <h4>@lang('developnet-lms::labels.headings.text_related_courses')</h4>
                        </div>
                        <div class="other-courses">
                            <div class="row">
                                @foreach($relatedCourses->get() as $relatedCourse)

                                    <div class="col-md-4 col-sm-6">
                                        @include('courses.partials.grid_courses_1', ['course' =>  $relatedCourse]) {{-- @deletedComments --}}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
                @include('partials.sidebar')
            </div>
        </div>
    </section>


@endsection

@section('after_content')

    {{--  <div class="book-popup">
         <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button><br>
           <div class="book-popup-cont">
                    <div class="text-cener">
                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة
                </div>
                <br>
                <center>
                    <button type="button" class="btn btn-outline-info">العوده</button>
                    <button type="button" class="btn btn-outline-dark">استكمال الحجز</button>
                </center>
           </div>
          </div>
     </div> --}}

@endsection

 @push('child_after_content')

@include('components.subscribe_modal', ['modal_id' => 'subCourse_'.$course->hashed_id,'subscriptionStatus' => $subscriptionStatus, 'planned' => $planned, 'module_data' => $course, 'module' => 'course', 'finalPrice' => $coursePrice])




@endpush

@section('js')
@if($errors->has('coupon'))
<script type="text/javascript">
$(document).ready(function(){
        $("#{{'subCourse_'.$course->hashed_id}}").modal('show');
    });
</script>
@endif
@endsection

@section('js')



    {!! Theme::js('js/circles.min.js"') !!}
    <script>
        Circles.create({
            id: 'circles-course-{{$course->hashed_id}}',
            value: 95,
            radius: 60,
            width: 8,
            duration: 1,
            colors: ['#d1e4d6', '#28a745 ']
        });
    </script>
@stop
