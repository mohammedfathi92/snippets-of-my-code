@php

    $correctAnswersCount = $quizLogs->children()->where('status', 1)->where('passed', true)->where('skipped', false)->count();
    $wrongAnswersCount = $quizLogs->children()->where('status', 1)->where('passed', false)->where('skipped', false)->where('options', '!=', null)->count();
    $questionsCount = $quiz->questions()->count();
    $skippedAnswersCount = $questionsCount - ($correctAnswersCount + $wrongAnswersCount);
    if($skippedAnswersCount < 0){
       $skippedAnswersCount = 0;
    }


   if($quizLogs->status == 1){

    $finished_at = $quizLogs->finished_at;

    if(!$finished_at){
        $quizLogs->update(['finished_at' => $quizLogs->updated_at?:Carbon::now()]);
        $finished_at = $quizLogs->finished_at?:Carbon::now();
    }

   //$finished_at  = strtotime($finished_at);

    $finishTime = $finished_at->diffInSeconds($quizLogs->created_at);

    }

   $quiz_passing_grade = $quizLogs->passing_grade;

   $user_passing_grade = $quizLogs->degree;

   // check retake times

   $quizTakeCount = $quiz->retake_count;

   $quizLogsNum = $quizLogs->where('parent_id', null)->count();


   $quizRetake = false;

  if($quizTakeCount > $quizLogsNum){

       $quizRetake = true;

   }

   if(!$quizTakeCount){

       $quizRetake = true;

   }

  if($quizLogs->parent_id){
       $quizRetake = false;
   }

@endphp

@php
    if($quizLogs->parent_id && $course){
        $quizCourseId = $course->hashed_id;
    }else{
        $quizCourseId = null;
    }



        if(!empty($course)){
                $is_course_element = true;
            }else{
               $is_course_element = false;
            }

            if($is_course_element){
                $quizUrl = route('courses.quiz', ['course_id' => $course->hashed_id, 'quiz_id' => $quiz->hashed_id]);
            }else{
                $quizUrl = route('quizzes.quizPage', ['quiz' => $quiz->hashed_id]);
            }


@endphp
<div id='quiz_result_container'>

    <input type="hidden" id="result_template" value=1>

    <div class="quiz-results faild">
        <h3 class="result-title">
            @lang('developnet-lms::labels.spans.span_result')
        </h3>
        <div class="result-summary">
            <div class="result-field correct">
						<span>
						{{-- @lang('developnet-lms::labels.spans.span_correct') --}} الإجابات الصحيحة</span>
                <span class="value">{{$correctAnswersCount}}</span>
            </div>
            <div class="result-field wrong">
						<span>
						{{-- @lang('developnet-lms::labels.spans.span_wrongs') --}} الإجابات الخاطئة</span>
                <span class="value">{{ $wrongAnswersCount}}</span>
            </div>
            <div class="result-field empty">
						<span>
						{{-- @lang('developnet-lms::labels.spans.span_skipped') --}}المُتَخَطَّى </span>
                <span class="value">{{$skippedAnswersCount}}</span>
            </div>
            <div class="result-field points">
						<span>
						@lang('developnet-lms::labels.spans.span_questions')</span>
                <span class="value">{{$questionsCount}}</span>
            </div>
            @if($quiz->duration > 0)
                <div class="result-field time">
						<span>
						{{-- @lang('developnet-lms::labels.spans.span_time') --}} الوقت المستهلك</span>

                    <span class="value">@if($quizLogs->status == 1){{gmdate("H:i:s", $finishTime)}} @else غير
                        متوفر @endif</span>


                </div>
            @endif

        </div>

        @if($quizLogs->passed)
            <div class="message message-success alert alert-success" role="alert" role="alert">
                <i class="fa"></i>{!! __('developnet-lms::labels.messages.quiz_pass_result', ['user' => Auth()->user()->name, 'degree' => number_format($user_passing_grade, 1).'%', 'passing_grade' => $quiz_passing_grade.'%']) !!}
            </div>
        @elseif($user_passing_grade < $quiz_passing_grade)

            <div class="message message-error alert alert-danger" role="alert">
                <i class="fa"></i> {!! __('developnet-lms::labels.messages.quiz_failed_result',
                 ['degree' =>   number_format($user_passing_grade, 1).'%', 'passing_grade' => $quiz_passing_grade.'%']) !!}
            </div>
        @endif
    </div>

    <div class="text-center" style="display: inline-flex;">
        @if($quizLogs->status == 1)
            <div id="preview_quiz_form" style="margin: 5px">

                {!! Form::model($quiz, ['url' => $quizUrl.'?show_answer=1','method'=>'GET','files'=>true]) !!}

                <a href="javascript:;" class="btn btn-success preview_quiz_btn" style="color: #fff;"
                   data-url="{{$quizUrl.'?show_answers=true'}}"> @lang('developnet-lms::labels.spans.preview_answers') </a>

                {!! Form::close() !!}
            </div>
        @else

            <a href="{{$quizUrl.'?page='.$quizLogs->current_page}}" class="btn btn-primary"> إستكمال </a>

        @endif
        @if($quizRetake)
            <div id="start_quiz_form" style="margin: 5px">
                {!! Form::model($quiz, ['url' => route('quizzes.retakeQuiz', ['quiz_id' => $quiz->hashed_id]),'method'=>'POST','files'=>true]) !!}
                <input type="hidden" name="quiz_retake" value="1">
                <button type="submit" class="btn btn-primary" id="retake_quiz_btn" style="color: #fff;"> إعادة
                    الاختبار مرة أخرى
                </button> @if($quizLogsNum > 1 || $quizLogsNum < 11)
                    <small>تم إعادة الاختبار {{$quizLogsNum}} مرات</small> @else
                    <small>تم إعادة الاختبار {{$quizLogsNum}} مرة</small>  @endif

                {!! Form::close() !!}
            </div>
        @endif
    </div>


    {{-- 	<div class="content-item-description">
            <p>We provide an awesome testing with many types of questions. Making a test with those questions is never easier than that. Enjoy!</p>
        </div> --}}
</div> {{-- end container --}}
