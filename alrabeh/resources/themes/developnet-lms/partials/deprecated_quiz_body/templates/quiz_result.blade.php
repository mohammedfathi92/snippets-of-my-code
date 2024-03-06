	 
	  @php

	  $correctAnswersCount = $quizLogs->children()->where('passed', true)->where('skipped', false)->count();
	  $wrongAnswersCount = $quizLogs->children()->where('passed', false)->where('skipped', false)->count();
	  $skippedAnswersCount = $quizLogs->children()->where('skipped', true)->count();
	  $questionsCount = $quiz->questions()->count();

	  $finished_at = $quizLogs->finished_at;

	  // $finished_at  = strtotime($finished_at);

     // dd($quizLogs->created_at);
	  $finishTime = $finished_at->diffInSeconds($quizLogs->created_at);

	 $quiz_passing_grade = $quizLogs->passing_grade;

	 $user_passing_grade = $quizLogs->degree;

	 // check retake times

	  $quizTakeCount = $quiz->retake_count;

	 $quizLogsNum = \Modules\Components\LMS\Models\Logs::where('user_id', Auth()->id())->where('lms_loggable_type', 'quiz')->where('lms_loggable_id', $quiz->id)->where('parent_id', null)->count();

	 $quizRetake = false;

	if($quizTakeCount < $quizLogsNum){

	 	$quizRetake = true;

	 }


	if(isset($parent) && $parent){

	 	$quizRetake = false;

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
						<span class="value">{{gmdate("i:s", $finishTime)}}</span>
					</div>
				</div>
			
				@if($quizLogs->passed)
				<div class="message message-success alert alert-success" role="alert"role="alert"> 
					<i class="fa"></i>{!! __('developnet-lms::labels.messages.quiz_pass_result', ['user' => Auth()->user()->name, 'degree' => $user_passing_grade.'%', 'passing_grade' => $quiz_passing_grade.'%']) !!}
				</div>
				@else
					<div class="message message-error alert alert-danger" role="alert"> 
					<i class="fa"></i> {!! __('developnet-lms::labels.messages.quiz_failed_result', ['degree' =>  $user_passing_grade.'%', 'passing_grade' => $quiz_passing_grade.'%']) !!} 
				</div>
				@endif
			</div>

		@php
		$firstQuestion = $quiz->questions()->orderBy('order', 'asc')->first();
		if(!empty($firstQuestion)){
			$firstQuestionId = $firstQuestion->hashed_id;
		}else{
           $firstQuestionId = null;
		}
		@endphp	
			<center>
				<div style="display: inline-flex;">
	<div id="preview_quiz_form" style="margin: 5px">
		{!! Form::model($quiz, ['url' => route('quizzes.question_answers.preview', ['quiz_id' => $quiz->hashed_id, 'log_id' => $quizLogs->hashed_id, 'question_id' => $firstQuestionId ]),'method'=>'GET','files'=>true]) !!}
             
				<a href="javascript:;" class="btn btn-success preview_quiz_btn"  style="color: #fff;" data-url="{{route('quizzes.question_answers.preview', ['quiz_id' => $quiz->hashed_id, 'log_id' => $quizLogs->hashed_id, 'question_id' => $firstQuestionId ])}}"> @lang('developnet-lms::labels.spans.preview_answers') </a>

		{!! Form::close() !!}
			</div>
				@if($quizRetake)
			<div id="start_quiz_form" style="margin: 5px">
		{!! Form::model($quiz, ['url' => route('quizzes.retakeQuiz', ['quiz_id' => $quiz->hashed_id]),'method'=>'POST','files'=>true]) !!}
              <input type="hidden" name="quiz_retake" value="1">
				<button type="submit" class="btn btn-primary" id="retake_quiz_btn" style="color: #fff;"> Retake Quiz Number ({{$quizLogsNum + 1}})</button>

		{!! Form::close() !!}
			</div>
			@endif
			</div>
			</center>
			
		{{-- 	<div class="content-item-description">
				<p>We provide an awesome testing with many types of questions. Making a test with those questions is never easier than that. Enjoy!</p>
			</div> --}}
	</div> {{-- end container --}}