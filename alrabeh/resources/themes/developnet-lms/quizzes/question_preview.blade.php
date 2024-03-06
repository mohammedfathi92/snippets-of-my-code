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
                <div class="col-md-8 course-wrap">

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

                        </ul>


                    </div>

                    <div>

                        @php

                            $correctAnswersIds = $question->answers()->where('is_correct', 1)->pluck('lms_answers.id')->toArray();
        $correctAnswersArray = [];
        foreach ($correctAnswersIds as $key => $value) {
            $correctAnswersArray[] = hashids_encode($value);
        }

                            if(user()->id == $quiz->author_id or user()->can('LMS::quiz.show')){

                             $showAnswer = true;
                            }else{

                             $showAnswer = false;

                            }


                        @endphp

                        {{--    Start question section --}}

                        <div class="quiz-questions" id="question_{{$question->hashed_id}}">
                            <input type="hidden" name="questions[]" value="{{$question->hashed_id}}">
                            <ul class="quiz-questions-list">
                                <li class="singl-question">


                                    <div class="question-name">

                                        @include('partials.quiz_body.paragraph', ['question' => $question])
                                        <br>
                                        @if($question->show_question_title)
                                            <h3>{{$question->title}}</h3>
                                        @endif

                                        @if($question->preview_video)

                                            @include('components.embeded_media', ['embeded' => $question->preview_video])
                                        @endif

                                        <p style="line-height: 1.8; font-size: 17px; font-weight: bold;">{!! $question->content !!}</p>

                                    </div>

                                    @foreach($question->answers()->get() as $answer)
                                        @if($question->question_type == 'multi_choice')
                                            <div class="checkbox"
                                                 @if(in_array($answer->hashed_id, $correctAnswersArray)) style="background-color: #28a745; color: #fff;"
                                                 @else style="font-weight: bold;" @endif>
                                                <label style="font-size: 14px;"><input type="checkbox"
                                                                                       name="answers[{{$question->hashed_id}}][]"
                                                                                       value="{{$answer->hashed_id}}"> {{$answer->title}}
                                                </label>
                                            </div>
                                        @else
                                            <div class="radio"
                                                 @if(in_array($answer->hashed_id, $correctAnswersArray)) style="background-color: #28a745; color: #fff;"
                                                 @else style="font-weight: bold;" @endif>
                                                <label style="font-size: 14px;"><input type="radio"
                                                                                       name="answers[{{$question->hashed_id}}][]"
                                                                                       data-answers="{{$answer->hashed_id}}"
                                                                                       value="{{$answer->hashed_id}}"> {{$answer->title}}
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div id="{{'show_hint_'.$question->hashed_id}}" class="collapse"
                                         style="background-color: #f1f1f1; margin-top: 10px; padding: 10px;">
                                        @if($question->question_explanation){!! $question->question_explanation !!} @else
                                            <p> لا توجد إضافة .</p> @endif
                                    </div>
                                    <div class="question-meta">

                                        <div>
                                            <a @if($question->question_explanation) href="{{'#show_hint_'.$question->hashed_id}}"
                                               data-toggle="collapse"
                                               data-target="{{'#show_hint_'.$question->hashed_id}}"
                                               @else href="javascript:;"
                                               style="cursor: no-drop; color: #e9e8e8;" @endif>
                                                <i class="fa fa-info"></i>
                                                <span style="font-weight: bold;">إضافة</span>
                                            </a>
                                            {{-- <div class="qs-info alert alert-danger" role="alert">
                                                ugd hggi ljtgpa fu] ;gi ]i hyfdi ;g;l
                                            </div> --}}
                                        </div>
                                        {{--
                                         <div>
                                             <a href="javascript:;" class="ask_teacher_btn" data-quiz="{{$quiz->hashed_id}}" data-question="{{$question->hashed_id}}" style="font-weight: bold;">
                                                 <i class="fa fa-phone"></i>
                                                 <span>اسال المعلم</span>
                                             </a>
                                         </div> --}}
                                    </div>

                                </li>
                            </ul>

                        </div>


                        {{-- end question section --}}
                    </div>


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
@section('js')
{{--     <script>
        var collapses = $(".question-name [data-toggle='collapse']");
        collapses.on("click touchstart", function () {
            var target = $(this).data('target');
            var status = $(this).attr('aria-expanded') || false;
            localStorage.setItem("question_collapses", JSON.stringify({target: target, status: status}))
        });
        var storage = localStorage.getItem("question_collapses");
        if (storage) {
            var storageData = JSON.parse(storage);
            if (storageData.target && (storageData.status == true || storageData.status == "true")) {
                $(".question-name").find(storageData.target).attr("aria-expanded", true);
            }
        }

    </script> --}}
@endsection



