<div id="quiz_duration" data-quiz_duration="{{\LMS::getRemainTime($quiz->duration, $quizLogs->created_at)}}"></div>
<input type="hidden" value="30%" id="question_progress" data-title="30% Complete (success)">

	{!! Form::model($quiz, ['url' => route('quizzes.answer_questions', ['quiz_id' => $quiz->hashed_id, 'logs_id' => $quizLogs->hashed_id]),'method'=>'POST','files'=>true, 'class' => 'ajax_questions_form']) !!}

	<input type="hidden" id="result_template" value=0>

@foreach($questions as $question)

@php

 $questionLogs = $quizLogs->children()->where('lms_loggable_type', 'question')->where('lms_loggable_id', $question->id)->first();

     if(empty($questionLogs)){
            $questionLogs = \Modules\Components\LMS\Models\Logs::create([
            'user_id' => user()->id,
            'lms_loggable_type' => 'question',
            'lms_loggable_id' => $question->id,
            'passed' => false,
            'status' => 0,
            'parent_id' => $quizLogs->id

        ]);

        }

   $showAnswer = isset($showAnswer)?$showAnswer:false;
   $previewQuestion = isset($previewQuestion)?$previewQuestion:false;


$correctAnswersIds = $question->answers()->where('is_correct', 1)->pluck('lms_answers.id')->toArray();
$correctAnswersArray = [];
$userAnswers = [];
$userWrongAnswers = [];
$userCorrectAnswers = [];

foreach ($correctAnswersIds as $key => $value) {
	$correctAnswersArray[] = hashids_encode($value);
}

	if(!empty($questionLogs->options)){
		$optionsArray = json_decode($questionLogs->options, true);
		$userAnswers = $optionsArray['answers'];
		if(!empty($userAnswers)){
			foreach($userAnswers as $answerRow){
				if(!in_array($answerRow, $correctAnswersArray)){
                 $userWrongAnswers[] = $answerRow;

				}else{
					$userCorrectAnswers[] = $answerRow;
				}
			}
		}
	}

	if(!$showAnswer){
$correctAnswersArray = [];
$userWrongAnswers = [];
$userCorrectAnswers = [];
	}

@endphp

<div class="quiz-questions">
<input type="hidden" name="questions[]" value="{{$question->hashed_id}}">
		<ul class="quiz-questions-list">

			<li class="singl-question" >
				<div class="question-name">
					<h3>{{$question->title}}</h3>

					@if($question->preview_video)

					@include('components.embeded_media', ['embeded' => $question->preview_video])
					@endif

					<p>{!! $question->content !!}</p>
				</div>

				@foreach($question->answers()->get() as $answer)
				@if($question->question_type == 'multi_choice')
				   <div class="radio" @if(in_array($answer->hashed_id, $userWrongAnswers))style="background-color: red; color: #fff;" @elseif(in_array($answer->hashed_id, $correctAnswersArray)) style="background-color: #28a745; color: #fff;"@endif>
				    	<label><input type="checkbox" name="answers[{{$question->hashed_id}}][]" value="{{$answer->hashed_id}}" @if(in_array($answer->hashed_id, $userAnswers)) checked="" @endif> {{$answer->title}}  </label>
				    </div>
				   @else
				   <div class="checkbox" @if(in_array($answer->hashed_id, $userWrongAnswers))style="background-color: red; color: #fff;" @elseif(in_array($answer->hashed_id, $correctAnswersArray)) style="background-color: #28a745; color: #fff;"@endif>
				    	<label><input type="radio" name="answers[{{$question->hashed_id}}][]" value="{{$answer->hashed_id}}" @if(in_array($answer->hashed_id, $userAnswers)) checked="" @endif>  {{$answer->title}} </label>
				    </div>
				    @endif
			@endforeach
			<div class="question-meta">
				<div class="show-qs-info">
					<i class="fa fa-info"></i>
					<span>إضافة</span>
					<div class="qs-info alert alert-danger" role="alert">
						ugd hggi ljtgpa fu] ;gi ]i hyfdi ;g;l
					</div>
				</div>
				<div >
					<i class="fa fa-bookmark-o" aria-hidden="true"></i>
					<span>تمييز السؤال</span>
				</div>

				<div>
					<a href="#">
						<i class="fa fa-phone"></i>
						<span>اسال المعلم</span>
					</a>
				</div>
			</div>

			</li>
		</ul>





</div>

@endforeach

{!! Form::close() !!}


{{ $questions->links('quizzes.ajax.tools', ['showAnswer' => $showAnswer, 'quiz' => $quiz, 'quizLogs' => $quizLogs]) }}









