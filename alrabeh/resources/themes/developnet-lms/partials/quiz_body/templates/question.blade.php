@php


		if(\Request::segment(1) == 'courses'){
			$is_course_element = true;
		}else{
           $is_course_element = false;
		}
          $is_delayed = false;
		  if(\Request::segment(3) == 'delayed'){
        	 $is_delayed = true;
        }

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
   // $previewQuestion = isset($previewQuestion)?$previewQuestion:false;


$correctAnswersIds = $question->answers()->where('is_correct', 1)->pluck('lms_answers.id')->toArray();
$correctAnswersArray = [];
$userAnswers = [];
$userWrongAnswers = [];
$userCorrectAnswers = [];

foreach ($correctAnswersIds as $key => $value) {
	$correctAnswersArray[] = hashids_encode($value);
}
$is_answered = false;
	if(!empty($questionLogs->options)){
		$optionsArray = json_decode($questionLogs->options, true);
		$userAnswers = $optionsArray['answers'];
		if(!empty($userAnswers)){
			$is_answered = true;
			foreach($userAnswers as $answerRow){
				if(!in_array($answerRow, $correctAnswersArray)){
                 $userWrongAnswers[] = $answerRow;

				}else{
					$userCorrectAnswers[] = $answerRow;
				}
			}
		}
	}

	$checkAnswer = $questionLogs->preview;

	if(!$showAnswer || !$checkAnswer){
$correctAnswersArray = [];
$userWrongAnswers = [];
$userCorrectAnswers = [];
	}


@endphp


	<input type="hidden" name="questions[]" value="{{$question->hashed_id}}">
		<div class="card" style="border-top: 3px solid #02475f; margin-bottom: 20px " id="question-card-{{$question->hashed_id}}">
			<div class="card-body">

				 @if(!$is_course_element)
				<div class="row">
					<div class="col-md-12">

						<div class="pull-right">
							@php
							$newFavPage = \Request::get('get')?:1;
							@endphp
				@include('components.q_favourite_action', ['module' => 'question', 'module_hash_id' => $question->hashed_id, 'favs_btn_id' => 'favs-btn-questions','q_url' => \Request::url().'?page='.$newFavPage])
				</div>
			@if(!$is_delayed  && $quizLogs->status < 1)

				<div class="pull-left">
					@php
					$current_page_id = \Request::get('page')?:1;
					@endphp
				<button  type="button" class="stop_here_btn @if($current_page_id == $quizLogs->current_page ) btn btn-danger btn-sm active @else btn btn-primary btn-sm @endif " data-page='{{$current_page_id}}' data-quiz_logs="{{$quizLogs->hashed_id}}" title="توقف هنا" ><i class="fa fa-stop-circle"></i> توقف هنا </button>
				</div>
@endif

					</div>
				</div>
				@endif
				<br>
				<div class="q-redius-box">
				<div class="question-name">

                   @include('partials.quiz_body.paragraph', ['question' => $question])

					@if($question->show_question_title)
					<h3>{{$question->title}}</h3>
					<hr>
					@endif

					@if($question->preview_video)

					@include('components.embeded_media', ['embeded' => $question->preview_video])
					@endif

					

				</div>
				<div class="question-content" style="display:inline-block;">
				<p style="line-height: 1.8; font-size: 17px; font-weight: bold;">{!! $question->content !!}</p>
				<br>
				</div>
				</div>
			
<br>
				@php

				if($questionLogs->preview > 0){
					$answer_mouse_class = 'not-allowed';
				}else{
					$answer_mouse_class = 'mouse-pointer';
				}

				@endphp

				@foreach($question->answers()->get() as $answer)
				@if($question->question_type == 'multi_choice')
				   <div class="form-group checkbox ck-button answer-row" data-question="{{$question->hashed_id}}">
				    	<label><input type="checkbox" name="answers[{{$question->hashed_id}}][]" value="{{$answer->hashed_id}}" @if(in_array($answer->hashed_id, $userAnswers)) class="form-control" checked="" @endif @if($questionLogs->preview > 0)disabled="true" @endif hidden  > <span class="main_span {{$answer_mouse_class}}" @if(in_array($answer->hashed_id, $userWrongAnswers)) style="background-color: red; color: #fff;" @elseif(in_array($answer->hashed_id, $correctAnswersArray)) style="background-color: #28a745; color: #fff;"@endif>{!! $answer->title !!}</span></label>
				    </div>
				   @else
				   <div class="form-group radio ck-button answer-row" data-question="{{$question->hashed_id}}">
				    	<label><input type="radio" name="answers[{{$question->hashed_id}}][]" data-answers ="{{$answer->hashed_id}}" value="{{$answer->hashed_id}}" @if(in_array($answer->hashed_id, $userAnswers)) class="form-control" checked=""  @endif @if($questionLogs->preview > 0)disabled="true" @endif hidden><span class="main_span {{$answer_mouse_class}}"  @if(in_array($answer->hashed_id, $userWrongAnswers)) style="background-color: red; color: #fff;" @elseif(in_array($answer->hashed_id, $correctAnswersArray)) style="background-color: #28a745; color: #fff;" @endif >{!! $answer->title !!}</span>  </label>
				    </div>
				    @endif
			@endforeach
			<br>

		<div style="display: flex; ">
	@if(!$quizLogs->status && $quiz->show_check_answer)
	<button data-checked="{{$questionLogs->preview}}" type="button" class="btn btn-danger check_answer check-ans-btn" data-question_id="{{$question->hashed_id}}" data-question_url="{{route('quizzes.check_answers', ['quiz_id' => $quiz->hashed_id, 'log_id' => $quizLogs->hashed_id, 'question_id' => $question->hashed_id])}}"  @if($questionLogs->preview > 0) disabled="" @endif> تحقق من الإجابة  </button> &nbsp;

		@endif

@if($quizLogs->status == 1)

  @if($showAnswer)
  @if($is_answered)
		@if($questionLogs->passed) <span style="color: #2bc04d;" class="check-ans-msg"> جوابك صحيح. ... احسنت</span> @else <span style="color: #f10b21"> إجاباتك  خاطئة   </span> @endif

@else

<span style="color:#007bff" class="check-ans-msg">لم تقم بالإجابة على هذا السؤال.</span>

@endif
@endif

@else {{-- not completed quiz --}}

 @if($questionLogs->preview_num > 0)


		@if($questionLogs->passed) <span style="color: #2bc04d;"> جوابك صحيح  ... احسنت</span>

		@elseif(!$questionLogs->passed && $questionLogs->preview > 0)
		 @if($is_answered)

		 <span style="color: #f10b21"> جوابك خطأ</span>

		 @else


<span style="color:#007bff">لم تقم بالإجابة على هذا السؤال.</span>

		 @endif

		@else
		 @if($is_answered) 

       <span style="color: #f10b21" class="check-ans-msg"> جوابك خطأ ... أعد المحاولة مرة  اخرى. </span>

        @else


<span style="color:#007bff" class="check-ans-msg">لم تقم بالإجابة على هذا السؤال. .. حاول مرة اخرى.</span>

		 @endif

		 @endif


@endif
@endif
	</div>
						<div id="{{'show_hint_'.$question->hashed_id}}" class="collapse" style="background-color: #f1f1f1; margin-top: 10px; padding: 10px;">
														<div style="display: inline-block; width: 100%;">

						@if($question->question_explanation){!! $question->question_explanation !!} @else <p> لا توجد إضافة .</p> @endif
					</div>
					</div>
			<div class="question-meta">

				<div style="background-color: {{($question->question_explanation && $questionLogs->preview > 0)?'#28a745' : '#bcbcbc'}};">
					<a @if($question->question_explanation && $questionLogs->preview > 0) href="{{'#show_hint_'.$question->hashed_id}}"  data-toggle="collapse" data-target="{{'#show_hint_'.$question->hashed_id}}" @else href="javascript:;" style="cursor: no-drop; color: #e9e8e8;" @endif>
					<span style="font-weight: bold;">إضافة</span>
					@if($question->question_explanation)
					<span class="badge badge-danger">  <i class="fa fa-bell"></i></span>
					@endif
					</a>
					{{-- <div class="qs-info alert alert-danger" role="alert">
						ugd hggi ljtgpa fu] ;gi ]i hyfdi ;g;l
					</div> --}}
				</div>
				@if(!$is_course_element)
				<div class="add-to-delayed" style="background-color: #f8b032;">

					@include('partials.quiz_body.delayed', ['quiz' => $quiz, 'quizLogs' => $quizLogs, 'question' => $question, 'is_delayed' => !empty($questionLogs)?$questionLogs->delayed:0 ])
				</div>
				@endif
				<div style="background-color: #007bff;">
					<a href="javascript:;" class="ask_teacher_btn" data-quiz="{{$quiz->hashed_id}}" data-question="{{$question->hashed_id}}" style="font-weight: bold;">
						<i class="fa fa-phone"></i>
						<span>اسال المعلم</span>
					</a>
				</div>
			</div>

			</div>
		</div>



    <script>
        $(function () {
            var storage = localStorage.getItem("question_collapses");
            if (storage) {
                var storageData = JSON.parse(storage);
                console.log(storageData.status);
                console.log(typeof storageData.status);
                if (storageData.target && (storageData.status === true || storageData.status === 'true')) {
                    $(storageData.target).addClass("show").show();
                } else {
                    $(storageData.target).removeClass("show").hide();
                }
            }
            var collapses = $(".collapse-btn");
            $('.collapse-btn').on("click", function () {
                var target = $(this).data('div_target');

                var status = $(target).hasClass('show');
                console.log(target);
                if(status  === true || status === 'true'){
                  // $(this).attr("aria-expanded", true);
                  $(target).removeClass("show").hide(500);
                  status = false;
                }else{
                  $(target).addClass("show").show(500);
                  status = true;

                }

        
                localStorage.setItem("question_collapses", JSON.stringify({target: target, status: status}));
            });
        });
    </script>












