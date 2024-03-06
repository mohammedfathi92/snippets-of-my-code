	@php

	$dataArray = [
		'quiz' => $quiz,
		'quizLogs' => isset($quizLogs)?$quizLogs:null,
		'course' => isset($course)?$course:null,
		'nextQuestion' => isset($nextQuestion)?$nextQuestion:null,
		'prevQuestion' => isset($prevQuestion)?$prevQuestion:null,
		'currentQuestion' => isset($currentQuestion)?$currentQuestion:null,
	];

	@endphp

	<div class="exam-section single-quiz" id="quiz_body">
    
    @if(isset($show_quiz_title) && $show_quiz_title)
	<h4 class=" quiz-title">{{$quiz->title}}</h4>
	@endif
{{-- meta start quiz --}}
	<div class="quiz-meta start-quiz-meta" @if($quizTemplate != 'start_quiz') style="display: none;" @endif>
			<ul class="quiz-meta-list">
				<li class="question-num-field">
					<span class="text">@lang('developnet-lms::labels.spans.questions_num')</span >
					<span class="question-num" style="font-weight: bold; color: red;">{{$quiz->questions()->count()}}</span>
				</li>
				<li class="question-tile-field" style="display: inline-flex;">
					<span class="text">@lang('developnet-lms::labels.spans.quiz_duration')</span>  &nbsp; 
					<span >[ {{$quiz->duration?:1}} ] </span> &nbsp; <span>
						@if(1 < $quiz->duration && $quiz->duration < 11 ) @lang('developnet-lms::labels.spans.duration_units.minute')
					@else
					@lang('developnet-lms::labels.spans.duration_unit.minute')

					@endif

				</span>

				</li>
				
			</ul>
		

		</div>
		@php
		$currentQuestionOrder = 1;
	if(isset($currentQuestion)){
		$currentQuestionOrder = $currentQuestion->order;
	}
	@endphp
			{{-- meta questions --}}
	<div class="quiz-meta questions-meta" @if(!$quizTemplate != 'questions') style="display: none;" @endif>
			<ul class="quiz-meta-list">
				<li class="question-num-field">
					<span class="text">@lang('developnet-lms::labels.spans.question')</span >
					<span class="question-num current_question_order" id="current_question_order">0</span><span>/</span>
					<span class="question-val">{{$quiz->questions()->where('status', 1)->count()}}</span>
				</li>
				<li class="question-tile-field">
					<span class="text">@lang('developnet-lms::labels.spans.rest_time')</span>
				
					<span class="timer" data-seconds-left={{$quiz->duration*60}} ></span>
				</li>
				
			</ul>
			 @include('components.favourite_action', ['module' => 'quiz', 'module_hash_id' => $quiz->hashed_id])
	
   </div>


	
	<div id="quiz_template_body">


	@if($quizTemplate == 'quiz_result')

	@include('partials.quiz_body.templates.quiz_result', $dataArray)

	@elseif($quizTemplate == 'questions')
	<center>
		<div id="showQuestionForm">
			<input type="hidden" name="course_id" value="{{$course->hashed_id}}">
								<div>
									<a href="javascript:;" id="question_form" data-form_url="{{route('quizzes.handel_enroll_question', ['quiz_log_id' => $quizLogs->hashed_id, 'question_id' => $currentQuestion->hashed_id])}}">Wait .... .</a>
								</div>
							</div>
 </center>							

	{{-- @include('partials.quiz_body.templates.questions', $dataArray) --}}

	@else

	@include('partials.quiz_body.templates.start_quiz', $dataArray)

	@endif
		
	</div>

</div> {{-- quiz main --}}










