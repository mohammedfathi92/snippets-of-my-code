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

            $relatedIds = $quiz->categories->pluck('id')->toArray();
            $relatedQuizzes = \Modules\Components\LMS\Models\Quiz::whereHas('categories',  function ($q)use ($relatedIds) {
                $q->whereIn('id',$relatedIds);
            })->where('status', true);

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
                <div class="col-md-12 course-wrap" @if($subscriptionStatus['success']) style="display: none;" @endif>
                    @php

                        $moduleArray = ['module' => 'quiz','module_id' => $quiz->id, 'user' => $authUser];
                        $planned = \Subscriptions::planned($moduleArray);

                    @endphp

                    @if($planned['success'] && !$subscriptionStatus['success'])
                        <div class="message message-warning alert alert-warning" role="alert" role="alert">
                            <i class="fa"></i>
                            <p> @lang('developnet-lms::labels.messages.planned_quiz_hint') </p>
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
                                            <span><a href="{{ route('categories.show', $category->id) }}">{{$category->name}}</a></span>
                                        @endforeach
                                    </div>
                                </li>
                            @endif
                            {{-- 							<li>
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
                      {{--   @include('components.favourite_action', ['module' => 'quiz', 'module_hash_id' => $quiz->hashed_id])
                        <div class="take-it"> --}}

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
                                    <span class="money">{{$quizPrice}}$ </span>
                                    @if($quiz->sale_price > 0)
                                        <span class="subject-value-deleted">{{$quiz->price}} $</span>
                                    @endif
                                @else
                                    <span class="take-free "> @lang('developnet-lms::labels.spans.span_free')</span>
                                @endif

                                @if($subscriptionStatus['success'])
                                    <button type="submit"
                                            class="colored-btn-red">@lang('developnet-lms::labels.spans.span_book_quiz')</button>

                                @else

                                @endif

                                {!! Form::close() !!}

                            @else

                               {{--  <a href="javascript:;" class="colored-btn-red"
                                   style="background-color: #f8b032; ">@lang('developnet-lms::labels.spans.span_booked')</a> --}}


                                {{--  <a href="{{route('quizzes.handel_quiz', ['quiz' => $quiz->hashed_id])}}" class="btn btn-danger"> عرض  الاختبار</a> --}}

                            @endif

                        </div>
                    </div>
                      </div>
                    <div class="row">
                    <div class="course-details col-md-9" style="margin: 5px 0; ">
                        @include('partials.quiz_body.index')



                    </div>
                                                             <div class="col-md-3" style="margin-top: 40px;">
        <div class="card" style="border-top: 3px solid #02475f;">
            <div class="card-body">
                <div class="form-group">
{{--                     <label for="search">ابحث</label> --}}                        
<input class="form-control" placeholder="بحث ...." id="questions-list-search" name="search" type="text" onkeyup="getQuestionName()">
<br>
<div class="q-scrollbar" id="q-scrollbar">
    <div class="q-force-overflow" id="q-force-overflow">
           <ul id="questions-list-menu" class="list-group list-group-unbordered">
        @foreach($questionsList as $row)
      <li class="list-group-item" id="q_list_{{($row->hashed_id)}}"><a href="{{\Request::url().'?page='.($loop->index+1)}}">{{str_limit(strip_tags($row->content),100)  }}</a></li>
      @endforeach


    </ul>  
    </div>
</div>

</div>



        </div>
    </div>
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

             

                <!-- Side bar-->

                {{-- @include('partials.sidebar') --}}
          
        </div>
    </section>


@endsection

{{-- @section('after_content')
@include('partials.quiz_body.show_modal', ['modal_id' => 'showQuizModal'])

@endsection --}}


