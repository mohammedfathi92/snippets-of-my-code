	@php

	$dataArray = [
		'quiz' => $quiz,
		'quizLogs' => isset($quizLogs)?$quizLogs:null,
		'course' => isset($course)?$course:null,
	];

	@endphp

	<div class="exam-section single-quiz" id="quiz_body">

    @if(isset($show_quiz_title) && $show_quiz_title)
	<h4 class=" quiz-title">{{$quiz->title}}</h4>
	@endif
{{-- meta start quiz --}}
<br>

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

	<div id="quiz_template_body">


	@if($quizTemplate == 'quiz_result')

	@include('partials.quiz_body.templates.quiz_result', $dataArray)

	@elseif($quizTemplate == 'questions')
				{{-- meta questions --}}
	<div class="quiz-meta questions-meta">
			<ul class="quiz-meta-list">
			{{-- 	<li class="question-num-field">
					<span class="text">@lang('developnet-lms::labels.spans.question')</span >
					<span class="question-num current_question_order" id="current_question_order">0</span><span>/</span>
					<span class="question-val">{{$quiz->questions()->where('status', 1)->count()}}</span>
				</li> --}}
         @php

            $showRemainTime = false;
            $showFinishedTime = false;
            $createdTime = $quizLogs->created_at;

            $mustFinishedAt = $createdTime->addSeconds($quiz->duration*60);
            if($mustFinishedAt > \Carbon\Carbon::now()){
         $remainTime =  $mustFinishedAt->diffInSeconds(\Carbon\Carbon::now());

            }

            $finished_in = 1;
            if($finished_at = $quizLogs->finished_at){

             $finished_in = $finished_at->diffInSeconds($quizLogs->created_at);
            }



            // {{gmdate("i:s", $finished_in)}}



        @endphp
        @if($quizLogs->status < 1)
				<li class="question-tile-field">
					<span class="text"><i class="fa fa-clock-o" style="color:#0eb523; font-size: 20px;"></i> @lang('developnet-lms::labels.spans.rest_time')</span>

					<span class="timer" data-seconds-left={{$remainTime}} ></span>
				</li>
          @else

    <li class="question-tile-field">
                    <span class="text"><i class="fa fa-clock-o" style="color:#0eb523; font-size: 20px;"></i> إستغرق  الاختبار :</span>

                 <span class="timer">{{gmdate("H:i:s", $finished_in)}}</span>


                </li>

          @endif

			</ul>
			 @include('components.favourite_action', ['module' => 'quiz', 'module_hash_id' => $quiz->hashed_id])

   </div>
{{-- <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
      40% Complete (success)
    </div>
  </div> --}}
  <br>

		<div id="showQuestionForm" class="question_container">

		@include('partials.quiz_body.templates.questions')


							</div>


	{{-- @include('partials.quiz_body.templates.questions', $dataArray) --}}

	@else

	@include('partials.quiz_body.templates.start_quiz', $dataArray)

	@endif

	</div>

</div> {{-- quiz main --}}


@push('child_scripts')
@include('partials.quiz_body.scripts')

    <script type="text/javascript">
        $(function() {
          $('[data-toggle="tooltip"]').tooltip();
            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                $('#quiz_body a').css('color', '#dfecf6');
                // $('.question_container').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/img/spinner.gif" />');

                var url = $(this).attr('href');
                getQuestions(url);
                var current_value  = $('#question_progress').val();
                var current_title  = $('#question_progress').data('title');
                $('.progress-bar').text(current_title).attr('aria-valuenow', current_value).css('width', current_value);
                window.history.pushState("", "", url);
            });

            function getQuestions(url) {
            	var showAnswer = '';

                $.ajax({
                    url : url+showAnswer
                }).done(function (data) {

                	answer_questions();

                    $('.question_container').html(data.view);

                }).fail(function () {
                    alert('Quizzes could not be loaded.');
                });
            }
        });

        function answer_questions(){
        	var form = $('.ajax_questions_form');
        	console.log(form.attr('action'));
        	 $.ajax({
        	 	 method: 'POST',
                 url: form.attr('action'),
                 data: form.serialize(),
                }).done(function (data) {
                    console.log(data);

                }).fail(function () {
                    alert('Quizzes could not be loaded.');
                });

        }



           $(function() {
            $('body').on('click', '.finish_exam', function(e) {
            	var form = $('.ajax_questions_form');
                e.preventDefault();
                 $.ajax({
                 	method: 'POST',
                    url : form.attr('action')+'?finish_quiz=1',
                    data: form.serialize(),
                }).done(function (data) {
                		$('#quiz_body').html(data.view);

                }).fail(function () {
                    alert('Quizzes could not be loaded.');
                });
            });




        });





    </script>

    <script type="text/javascript">
$( function() {
     $('.timer').startTimer({
                 onComplete: function(){
          //first finish exam
             finishExam();
              //second show alert

                 if(alert('تم انتهاء وقت  الاختبار !')){}
                 else    window.location.reload();

              }
            });
 });


</script>
{{-- <script type="text/javascript">
    $(document).ready(function() {
    $("body").on("contextmenu",function(){
       return false;
    });
});
</script> --}}
<!-- iCheck 1.0.1 -->

</script>
<script type="text/javascript">
 $(function () {
  $('[data-toggle="tooltip"]').tooltip();
  $('[data-toggle="popover"]').popover('toggle')
});

 </script>
@endpush











