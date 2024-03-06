
<style type="text/css">

  .card p {
      margin-top: 0;
    margin-bottom: 0;
}

  .card .question-content {
      margin: 10px;
}


.card table[style] {
     width: 100% !important;
}

.card table {
     width: 100% !important;
}

  #quiz_body img{
    max-width: 100% !important;

  }


  .q-redius-box {border: 2px solid #E0E0E0;
    padding: 10px;
    border-radius: 50px 20px;}
    .row-pagination{
    justify-content: center;
}
.pagination{
    display: contents;
}
.pagination li{
    margin-bottom:3px;
}

</style>
<style>
.q-scrollbar
{
    min-width: 100% !important;
/*    margin-left: 30px;
*/    float: left;
    height: auto;
    background: #F5F5F5;
    overflow-y: scroll;
       border: 1px solid rgba(0,0,0,.125);
/*    margin-bottom: 25px;
*/}

.q-force-overflow
{
    max-height: 400px;
}

/*
 *  STYLE 3
 */

.q-scrollbar::-webkit-scrollbar-track
{
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

.q-scrollbar::-webkit-scrollbar
{
    width: 6px;
    background-color: #F5F5F5;
}

.q-scrollbar::-webkit-scrollbar-thumb
{
    background-color: #000000;
}
</style>
<style>
    .ck-button {
/*            position:absolute;
*/
    margin:4px;
    background-color:#EFEFEF;
    border-radius:4px;
    border:1px solid #D0D0D0;
/*    overflow:auto;
*/    /*float:left;*/
    width:100%;
}

.ck-button label {
/*    float:left;
*/    width:100%;
margin-bottom: 0px; 
}

.ck-button label .main_span {
/*    text-align:center;
*/    padding: 2px;
padding-right: 10px;
    display:block;
    border-radius:4px;
    font-size: 21px !important;
}
.main_span strong{
    font-size: 21px !important;
    font-family: "Sakkal Majalla";
}
.main_span span{
    font-size: 21px !important;
    font-family: "Sakkal Majalla";
        font-weight: bold;
}

.main_span span[style]{
    font-size: 21px !important;
    font-family:"Sakkal Majalla";
        font-weight: bold;
}

.main_span  * {
      font-size: 21px !important;
    font-family:"Sakkal Majalla" !important;
        font-weight: bold;
}


.ck-button label input {
/*    position:absolute;
    top:-20px;*/
}

.ck-button input:hover + .main_span {
    background-color:#ebfaf1;
}

.ck-button input:checked + .main_span {
    background-color:#02b4a3;
    color:#fff;
}

.ck-button input:checked:hover + .main_span {
    background-color:#06998b;
    color:#fff;
}
.mouse-pointer {cursor: pointer;}
.not-allowed {cursor: not-allowed;}
</style>
	@php

	$dataArray = [
		'quiz' => $quiz,
		'quizLogs' => isset($quizLogs)?$quizLogs:null,
		'course' => isset($course)?$course:null,
	];

	@endphp

	<div class="exam-section single-quiz discpaction" id="quiz_body">

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
					  @if($quiz->duration > 0) <span >[ {{$quiz->duration?:1}} ] </span> &nbsp; <span>
						@if(1 < $quiz->duration && $quiz->duration < 11 ) @lang('developnet-lms::labels.spans.duration_units.minute')
					@else
					@lang('developnet-lms::labels.spans.duration_unit.minute')

					@endif

				</span>
                 @else
                 | <span style="color: red; font-weight: bold;" class="question-num"> &nbsp; غير محددة   </span>

                 @endif

				</li>


			</ul>
		</div>

	<div id="quiz_template_body">




	@if($quizTemplate == 'quiz_result')

	@include('partials.quiz_body.templates.quiz_result', $dataArray)

	@elseif($quizTemplate == 'questions')
				{{-- meta questions --}}

         @if($quiz->duration > 0)
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
            $remainTime = 0;
            if($mustFinishedAt > \Carbon\Carbon::now()){
         $remainTime =  $mustFinishedAt->diffInSeconds(\Carbon\Carbon::now());

            }


            $finished_in = 1;
            if($finished_at = $quizLogs->finished_at){

             $finished_in = $finished_at->diffInSeconds($quizLogs->created_at);
             if($finished_in > ($quiz->duration*60)){

             $finished_in = ($quiz->duration*60);

             }

            }



            // {{gmdate("i:s", $finished_in)}}

        @endphp

         @if($quiz->duration > 0 && $quizLogs->status < 1)
				<li class="question-tile-field">
					<span class="text"><i class="fa fa-clock-o" style="color:#0eb523; font-size: 20px;"></i> @lang('developnet-lms::labels.spans.rest_time')</span>

					<span class="timer" data-seconds-left="{{$remainTime}}" ></span>
				</li>

          @else

    <li class="question-tile-field">
                    <span class="text"><i class="fa fa-clock-o" style="color:#0eb523; font-size: 20px;"></i> إستغرق  الاختبار :</span>

                 <span class="timer">{{gmdate("H:i:s", $finished_in)}}</span>


                </li>

          @endif

			</ul>
			 {{-- @include('components.favourite_action', ['module' => 'quiz', 'module_hash_id' => $quiz->hashed_id]) --}}

   </div>
     @endif {{-- end if not have duration  --}}

{{-- <div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
      40% Complete (success)
    </div>
  </div> --}}


		<div id="showQuestionForm" class="question_container">

		@include('partials.quiz_body.templates.questions')


							</div>


	{{-- @include('partials.quiz_body.templates.questions', $dataArray) --}}

	@else

	@include('partials.quiz_body.templates.start_quiz', $dataArray)

	@endif

	</div>

</div> {{-- quiz main --}}

       @push('child_after_content')
       @include('partials.quiz_body.components.ask_teacher_modal')
       @include('partials.quiz_body.components.finish_modal')

      @endpush

@push('child_scripts')

@include('partials.quiz_body.scripts')

<script type="text/javascript">
     //Favourite Scripts
     $('body').on('click','.favourite-action-questions',function(e){
      var button = $(this);
      var url = $(this).data('url');
      var parent_div = $(this).parents('.add-to-fav').closest('.add-to-fav');
      var favs_btn_id = button.data('favs_btn_id');
      var module_id = button.data('module_id');
      var q_url = button.data('q_url');
      var favs_btn = $('#'+favs_btn_id);
      var favs_count = favs_btn.attr('data-count');

      $.get(url, function(response){
        if(response.success){
            parent_div.html(response.view);
             if(response.actionType == 'add'){
             
                favs_btn.removeAttr('disabled');
                favs_btn.attr('data-count', parseInt(favs_count) + 1);
             }


           if(response.actionType == 'remove'){
                favs_btn.attr('data-count', parseInt(favs_count) - 1);

                           if(favs_count <= 1){
            favs_btn.attr('disabled','');
           }

           }


            @if(isset($q_delete_row) && $q_delete_row)
            var q_search_list = $("#questions-list-menu").find("#q_list_"+module_id);

            if(response.actionType == 'remove'){
              q_search_list.remove();


              var showAnswer = '';
                $.ajax({
                   cache: false,
                    url : q_url+showAnswer
                }).done(function (data) {

                    $('.question_container').html(data.view);

                }).fail(function () {
                    alert('Quizzes could not be loaded.');
                });
        

            }
             @endif

        }else{
            parent_div.before(response.view);
        }


        

      });
// e.stopImmediatePropagation();

});
</script>


    <script type="text/javascript">
        $(function() {
          $('[data-toggle="tooltip"]').tooltip();
            $('body').on('click', '.pagination .ajax-paginate ', function(e) {
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


        });

                   function getQuestions(url) {
              var showAnswer = '';

                $.ajax({
                   cache: false,
                    url : url+showAnswer
                }).done(function (data) {

                  answer_questions();

                  var questionNiew = $('.question_container').html(data.view);

                                   // reset the scroll to top
        var questionId =  questionNiew.find('.quiz-questions').attr('id');  
 
var position = $('#'+questionId).position();


  $('#q-scrollbar').scrollTop(position.top - 200 );

                }).fail(function () {
                    alert('Quizzes could not be loaded.');
                });
            }
       


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
@php
if(isset($course) && !empty($course)){
$course_id = $course->hashed_id;
}else{
    $course_id = null;
}
@endphp

           $(function() {
            $('body').on('click', '.finish_exam', function(e) {
            	var form = $('.ajax_questions_form');
                e.preventDefault();
                 $.ajax({
                 	method: 'POST',
                    url : form.attr('action')+'?finish_quiz=1&course={{$course_id}}',
                    data: form.serialize(),
                    cache: false,
                }).done(function (data) {
                		$('#quiz_body').html(data.view);

                }).fail(function () {
                    alert('Quizzes could not be loaded.');
                });
            });




        });





    </script>
 @if($quiz->duration > 0)
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
@endif
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
 <script type="text/javascript">
    function getQuestionName() {
  var input, filter, ul, li, a, i;
  input = document.getElementById("questions-list-search");
  filter = input.value.toUpperCase();
  ul = document.getElementById("questions-list-menu");
  li = ul.getElementsByTagName("li");
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}

 </script>
{{--  <script type="text/javascript">
    @php
    $pageIndex = \Request::get('page');
    @endphp
    $(window).load(function(){
         $('#q-force-overflow').animate({
        scrollTop: $("#q_list_{{$pageIndex?:1}}").offset().top
    }, 2000);
     });
 </script> --}}

 <script type="text/javascript">
                $(function() {
            $('body').on('click', '.answer-row', function(e) {
                var questionId = $(this).data('question');
                $('#question-card-'+questionId).find('.check-ans-msg').remove();

            });
        });
 </script>
@endpush











