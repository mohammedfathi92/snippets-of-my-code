
	  @php

	  $correctAnswersCount = $quizLogs->children()->where('status', 1)->where('passed', true)->where('skipped', false)->count();
	  $wrongAnswersCount = $quizLogs->children()->where('status', 1)->where('passed', false)->where('skipped', false)->count();
	  $questionsCount = $quiz->questions()->where('status', 1)->count();
	  $skippedAnswersCount = $questionsCount - ($correctAnswersCount + $wrongAnswersCount);
	  if($skippedAnswersCount < 0){
         $skippedAnswersCount = 0;
	  }


     if($quizLogs->status == 1){

	  $finished_at = $quizLogs->finished_at;

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

@endphp
<br>
	  <div id='quiz_result_container' style="border: 1px;">

	   <input type="hidden" id="result_template" value=1>

			<div class="quiz-results faild">
				<h3 class="result-title">
					@lang('developnet-lms::labels.spans.span_result')
				</h3>
				<div class="result-summary">
					<div class="result-field correct">
						<span>
						@lang('developnet-lms::labels.spans.span_correct')</span>
						<span class="value">{{$correctAnswersCount}}</span>
					</div>
					<div class="result-field wrong">
						<span>
						@lang('developnet-lms::labels.spans.span_wrongs')</span>
						<span class="value">{{ $wrongAnswersCount}}</span>
					</div>
					<div class="result-field empty">
						<span>
						@lang('developnet-lms::labels.spans.span_skipped')</span>
						<span class="value">{{$skippedAnswersCount}}</span>
					</div>
					<div class="result-field points">
						<span>
						@lang('developnet-lms::labels.spans.span_questions')</span>
						<span class="value">{{$questionsCount}}</span>
					</div>
					<div class="result-field time">
						<span>
						@lang('developnet-lms::labels.spans.span_time')</span>
						<span class="value">@if($quizLogs->status == 1){{gmdate("H:i:s", $finishTime)}} @else غير متوفر @endif</span>
					</div>
				</div>

				@if($quizLogs->passed)
				<div class="message message-success alert alert-success" role="alert"role="alert">
					<i class="fa"></i>{!! __('developnet-lms::labels.messages.quiz_pass_result', ['user' => Auth()->user()->name, 'degree' => number_format($user_passing_grade, 1).'%', 'passing_grade' => $quiz_passing_grade.'%']) !!}
				</div>
				@else
					<div class="message message-error alert alert-danger" role="alert">
					<i class="fa"></i> {!! __('developnet-lms::labels.messages.quiz_failed_result', ['degree' =>   number_format($user_passing_grade, 1).'%', 'passing_grade' => $quiz_passing_grade.'%']) !!}
				</div>
				@endif
			</div>


			<center>
				<div style="display: inline-flex;">
@if(!$hide_btns)

			<div id="start_quiz_form" style="margin: 5px">
		{!! Form::model($quiz, ['url' => route('quizzes.retakeQuiz', ['quiz_id' => $quiz->hashed_id]),'method'=>'POST','files'=>true]) !!}

		<input type="hidden" name="create_new_logs" value="1">
              <input type="hidden" name="quiz_retake" value="1">
              <a href="{{route('quizzes.quizPage', ['quiz' => $quiz->hashed_id])}}?page={{$quizLogs->current_page?:3}}" type="button" class="btn btn-success" style="color: #fff;"> الإستكمال من حيث توقفت</a>
				<button type="submit" class="btn btn-primary" id="retake_quiz_btn" style="color: #fff;"> إعادة  الاختبار مرة اخرى </button> @if($quizLogsNum > 1 || $quizLogsNum < 11) <small>تم إعادة  الاختبار  {{$quizLogsNum}} مرات </small> @else<small>تم إعادة  الاختبار  {{$quizLogsNum}} مرة </small>  @endif

		{!! Form::close() !!}
			</div>
			@endif

			</div>
			</center>

		{{-- 	<div class="content-item-description">
				<p>We provide an awesome testing with many types of questions. Making a test with those questions is never easier than that. Enjoy!</p>
			</div> --}}
	</div> {{-- end container --}}

	<br>
