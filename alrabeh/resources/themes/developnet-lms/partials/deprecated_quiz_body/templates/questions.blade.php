
@php
if(!isset($quizQuestions)){
	$quizQuestions = $quiz->questions()->where('status', 1);
}

$correctAnswersIds = $currentQuestion->answers()->where('is_correct', 1)->pluck('lms_answers.id')->toArray();
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
<div id="quiz_duration" data-quiz_duration="{{\LMS::getRemainTime($quiz->duration, $quizLogs->created_at)}}"></div>

<div class="question-palette ">
	<ul class="question-palette-list">
		@foreach($quizQuestions->get() as $row)
@php
$rowLogs = $quizLogs->children()->where('lms_loggable_type', 'question')->where('lms_loggable_id', $row->id)->first();
$answeredStatus =  'not-visited';
 $currentQuestionOrder = $currentQuestion->pivot->order + 1;


if(!empty($rowLogs)){
	if($rowLogs->status < 1){
		$answeredStatus = 'bg-default';
	}

  if($rowLogs->skipped > 0){
  	if($rowLogs->status < 1){

		$answeredStatus = 'bg-warning';
  	}else{
  		$answeredStatus = 'bg-success';
  	}
	}else{
		$answeredStatus = 'bg-success';
	}


	if($rowLogs->lms_loggable_id == $currentQuestion->id){
// dd($rowLogs->lms_loggable_id , $currentQuestion->id);
          $answeredStatus = 'bg-primary';
          $currentQuestionOrder = $loop->index + 1;
	}

}




@endphp
		<li class="palette-element {{-- {{$answeredStatus}} --}}"><a href="{{route('quizzes.handel_enroll_question', ['quiz_log_id' => $quizLogs->hashed_id, 'question_id' => $row->hashed_id])}}"><span class="{{$answeredStatus}}">{{$loop->index + 1}}</span></a></li>
@endforeach


	</ul>
</div> 
<div class="quiz-questions">

	<input type="hidden" value="{{$currentQuestionOrder}}" id="current-question-order">
	{!! Form::model($currentQuestion, ['url' => route('quizzes.answer_question', ['quiz_id' => $quiz->hashed_id, 'question_id' => $currentQuestion->hashed_id]),'method'=>'POST','files'=>true, 'class' => 'ajax_submit_form_1']) !!}

	   <input type="hidden" id="result_template" value=0>

		<input type="hidden" name="quiz_logs" value="{{$quizLogs->hashed_id}}">
		<input type="hidden" name="showAnswer" value={{$showAnswer}}>
		<ul class="quiz-questions-list">
			<li class="singl-question" >
				<div class="question-name">
					<h3>{{$currentQuestion->title}}</h3>

					@if($currentQuestion->preview_video)

					@include('components.embeded_media', ['embeded' => $currentQuestion->preview_video])
					@endif

					<p>{!! $currentQuestion->content !!}</p>
				</div>

				@foreach($currentQuestion->answers()->get() as $answer)
				@if($currentQuestion->question_type == 'multi_choice')
				   <div class="radio" @if(in_array($answer->hashed_id, $userWrongAnswers))style="background-color: red; color: #fff;" @elseif(in_array($answer->hashed_id, $correctAnswersArray)) style="background-color: green; color: #fff;"@endif>
				    	<label><input type="checkbox" name="answers[{{$currentQuestion->hashed_id}}][]" value="{{$answer->hashed_id}}" @if(in_array($answer->hashed_id, $userAnswers)) checked="" @endif> {{$answer->title}}  </label>
				    </div>
				   @else 
				   <div class="checkbox" @if(in_array($answer->hashed_id, $userWrongAnswers))style="background-color: red; color: #fff;" @elseif(in_array($answer->hashed_id, $correctAnswersArray)) style="background-color: green; color: #fff;"@endif>
				    	<label><input type="radio" name="answers[{{$currentQuestion->hashed_id}}][]" value="{{$answer->hashed_id}}" @if(in_array($answer->hashed_id, $userAnswers)) checked="" @endif>  {{$answer->title}} </label>
				    </div>
				    @endif
			@endforeach	

			</li>
		</ul>

		
		<div class="question-meta-links">
			 @include('components.favourite_action', ['module' => 'question', 'module_hash_id' => $currentQuestion->hashed_id])
			 <br>
			 @if($previewQuestion)

      
				<button type="button" class="btn btn-dark prev preview_quiz_btn" @if(empty($prevQuestion)) disabled="" @endif @if(!empty($prevQuestion)) data-url="{{route('quizzes.question_answers.preview', ['quiz_id' => $quiz->hashed_id, 'log_id' => $quizLogs->hashed_id, 'question_id' => $prevQuestion->hashed_id ])}}" @endif>
					<i class="fa fa-angle-double-right"></i> @lang('developnet-lms::labels.spans.span_previous') 
				</button>

				<button type="button"  class="btn btn-dark next preview_quiz_btn" @if(!empty($nextQuestion)) data-url="{{route('quizzes.question_answers.preview', ['quiz_id' => $quiz->hashed_id, 'log_id' => $quizLogs->hashed_id, 'question_id' => $nextQuestion->hashed_id ])}}" @endif @if(empty($nextQuestion)) disabled="" @endif>
					@lang('developnet-lms::labels.spans.span_next') <i class="fa fa-angle-double-left"></i>
				</button>

			
				<button type="button" onClick="window.location.reload()" class="btn btn-warning" >
					@lang('developnet-lms::labels.spans.preview_results')
				</button>


				@else 
				{{-- not previewed --}}

						<button type="button" class="btn btn-dark prev submit_form_btn" @if(empty($prevQuestion))disabled="" @endif data-url="{{route('quizzes.answer_question', ['quiz_id' => $quiz->hashed_id, 'question_id' => $currentQuestion->hashed_id]).'?direction=prev'}}">
					<i class="fa fa-angle-double-right"></i> @lang('developnet-lms::labels.spans.span_previous') 
				</button>
				<button type="button"  class="btn btn-dark next submit_form_btn" data-url="{{route('quizzes.answer_question', ['quiz_id' => $quiz->hashed_id, 'question_id' => $currentQuestion->hashed_id]).'?direction=next'}}" @if(empty($nextQuestion)) disabled="" @endif>
					@lang('developnet-lms::labels.spans.span_next') <i class="fa fa-angle-double-left"></i>
				</button>
				<button type="button" class="btn btn-warning skip submit_form_btn" data-url="{{route('quizzes.answer_question', ['quiz_id' => $quiz->hashed_id, 'question_id' => $currentQuestion->hashed_id]).'?direction=next&skipped=true'}}"  @if(empty($nextQuestion)) disabled="" @endif style="color: #fff;">
					@lang('developnet-lms::labels.spans.span_skip')
				</button>
{{-- 	<button type="button"  class="btn btn-dark skip">
					@lang('developnet-lms::labels.spans.span_skip')
				</button> --}}
				{{-- <button type="button" class="btn btn-success finish" data-toggle="modal" data-target="#finishExamModal">
					@lang('developnet-lms::labels.spans.span_finish_exam')
				</button> --}}
				<button type="button" class="btn btn-success finish submit_form_btn" data-url="{{route('quizzes.answer_question', ['quiz_id' => $quiz->hashed_id, 'question_id' => $currentQuestion->hashed_id]).'?direction=next&finish_quiz=true'}}" >
					@lang('developnet-lms::labels.spans.span_finish_exam')
				</button>

				@endif

              
				 
		</div>
		
{!! Form::close() !!}

</div>
{{--  <form>
         <input type="button" value="Click Me" onclick="getConfirmation();" />
      </form> --}}

<script type="text/javascript">
            function getConfirmation(){
               var retVal = confirm("Do you want to continue ?");
               if( retVal == true ){
                  document.write ("User wants to continue!");
                  return true;
               }
               else{
                  document.write ("User does not want to continue!");
                  return false;
               }
            }
         
      </script>


	
{{-- <script type="text/javascript">
    $(function(){
      $('.timer').startTimer({
        onComplete: function(element){
        	alert('hiii');
        }
      }).click(function(){ location.reload() });
    })
</script> --}}



