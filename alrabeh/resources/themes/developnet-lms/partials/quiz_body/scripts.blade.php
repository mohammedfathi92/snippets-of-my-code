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
<script type="text/javascript">
  $( function() {
  
    $('body').on('click','.stop_here_btn', function() {
      var btn = $(this);
      var quizLogs = btn.data('quiz_logs');

          var page = btn.data('page');

          if(btn.hasClass( "active" )){
            var status = 'remove';


          }else{
           var status = 'add';


          }
       
          $.ajax({
            method: 'POST',
            url: '/quizzes/ajax/'+ quizLogs +'/page/'+ page +'/stop_here?status=' + status,
            cache: false,
            success: function (result) {
             if(status == "remove"){
            btn.removeClass( "btn-danger" );
            btn.addClass( "btn-primary" );
            btn.removeClass( "active" );

          }else{
            btn.removeClass( "btn-primary" );
            btn.addClass( "btn-danger" );
            btn.addClass( "active" );

          }

              

            },

            error: function (result) {
                alert('An error occurred.');

            },
        });

    });
});
</script>
<script type="text/javascript">
      $( function() {


        //get quiz results progress
     $('body').on('click','.showResultsForQuizBtn',function(){
      var url = $(this).data('url');
      if($('#showResultsForQuiz').css('display') == 'none')
       {

         $.get(url, function(response){

          $('#showResultsForQuiz').html(response.view);
          $('#showResultsForQuiz').show();



      });

      }else{

         $('#showResultsForQuiz').hide();

      }


});
     });
</script>
<script type="text/javascript">
    $( function() {


        //Mark as Delayed Question
     $('body').on('click','.delayed-question',function(){
      var url = $(this).data('url');
      var parent_div = $(this).parents('.add-to-delayed').closest('.add-to-delayed');
      var btn = $(this);
      $.get(url, function(response){
        if(response.success){
            parent_div.html(response.view);

    var question = btn.attr('question');
    var quiz = btn.attr('quiz');
    var delaysBtn = $('#delays-btn-'+quiz);
    var countD = delaysBtn.attr('data-count');

  if(parseInt(response.is_delayed) > 0){
    delaysBtn.attr('data-count', parseInt(countD) + 1);
    delaysBtn.removeAttr('disabled');
    delaysBtn.removeClass("btn-default");
    delaysBtn.addClass("btn-warning");
     

  }else{
        delaysBtn.attr('data-count', parseInt(countD) - 1);
        var countD = $('#delays-btn-'+quiz).attr('data-count');

    if(parseInt(countD) < 1){
    delaysBtn.attr('disabled', 'disabled');
        delaysBtn.removeClass("btn-warning");
    delaysBtn.addClass("btn-default");


    }



  }

        }else{
            parent_div.before(response.view);
        }


      });

});

//load ask teacher modal

        $( function() {

  $('body').on('click','.ask_teacher_btn',function(){

        var btn = $(this);
        var quiz_id = btn.data('quiz');
        var question_id = btn.data('question');

        $('#askTeacherModal').modal('show').find('.modal-body').load('/quizzes/ajax/ask_teacher/quizzes/'+quiz_id+'/questions/'+question_id);

});

});

    //submit ask teacher

        $( function() {

  $('body').on('click','.submit_ask_teacher',function(){
    var parentForm = $(this).closest('#askTeacherModal').find('form');
    var dataVal = $('#ask-message-data').val();
    if(dataVal){

                 $.ajax({
            method: 'POST',
            url: parentForm.attr('action'),
            data: parentForm.serialize(),
            cache: false,
            success: function (result) {
              $("#askTeacherModal").modal('hide');
             console.log('sumbitted');
            },

            error: function (result) {
                alert('An error occurred.');

            },
        });

    }else{
      $('.alert-ask-teacher-message').show();
    }


});

});


  $('body').on('click','.check_answer',function(){
    var question_id = $(this).data('question_id');
           $.ajax({
            method: 'POST',
            url: $(this).data('question_url'),
            data:  $('#question_'+question_id +' :input').serialize(),
            cache: false,
            success: function (result) {
              $('#question_'+question_id).html(result.view);
        // var currentQuestionOrder = $('#current-question-order').val();
              // $('#current_question_order').html(currentQuestionOrder);
            },

            error: function (result) {
                alert('An error occurred.');

            },
        });

});

});

</script>

{{-- retakeQuiz --}}

<script type="text/javascript">
    $( function() {

  $('body').on('click','.show_result_btn',function(){
           $.ajax({
            method: 'POST',
            url: $(this).data('url'),
            cache: false,
            success: function (result) {
              $('#quiz_body').html(result.view);
        // var currentQuestionOrder = $('#current-question-order').val();
              // $('#current_question_order').html(currentQuestionOrder);
            },

            error: function (result) {
                alert('An error occurred.');

            },
        });

});

});

</script>
<script type="text/javascript">
    $( function() {

  $('body').on('click','.preview_quiz_btn',function(){
    var parentForm = $(this).parents('form').closest('form');
           $.ajax({
            method: 'GET',
            url: $(this).data('url'),
            data: parentForm.serialize(),
            cache: false,
            success: function (result) {
              $newHtml = $(result.view).filter('#quiz_body').html();
              // $('.questions-meta').show();
              $('#quiz_body').html($newHtml);
        // var currentQuestionOrder = $('#current-question-order').val();
              // $('#current_question_order').html(currentQuestionOrder);
            },

            error: function (result) {
                alert('An error occurred.');

            },
        });

});

});

</script>

<script type="text/javascript">
    $( function() {

  $('body').on('click','#start_quiz_btn',function(){
    // var currentQuestionOrder = $('.data-question-order').val();
           $.ajax({
            method: 'POST',
            url: $(this).data('form_url'),
            data: $('#start_quiz_form :input').serialize(),
            cache: false,
            success: function (result) {
              if(result.success){
                location.reload();

                // loadQuestions(result.url);
              }else{
              $('.start-quiz-meta').hide();
              $('.questions-meta').show();
            	$('#quiz_template_body').html(result.view);

              // $('#current_question_order').html(currentQuestionOrder);
              var quizDuration = $('#quiz_duration').data('quiz_duration');
              var result_template = $('#result_template').val();
              if(result_template > 0){
                $('.quiz-meta').hide();
              }
              @if($quiz->duration > 0)
              $('.timer').attr('data-minutes-left', quizDuration);
              $('.timer').startTimer({
                 onComplete: function(element){
            //first finish exam
             finishExam();
              //second show alert

                 if(alert('تم انتهاء وقت  الاختبار !')){}
                 else    window.location.reload();
              }
            });
              @endif
}
            },
            error: function (result) {
                alert('An error occurred.');

            },
        });

});

});

</script>

<script type="text/javascript">

  function loadQuestions(url){

        $.ajax({
            method: 'GET',
            url: url,
            cache: false,
            success: function (result) {
              $('.start-quiz-meta').hide();
              $('.questions-meta').show();

          $('[data-toggle="tooltip"]').tooltip();
           $('[data-toggle="popover"]').popover('toggle')

              $('#quiz_template_body').html(result.view);
              // $('#current_question_order').html(currentQuestionOrder);


              var quizDuration = $('#quiz_duration').data('quiz_duration');
              var result_template = $('#result_template').val();
              if(result_template > 0){
                $('.quiz-meta').hide();
              }
               @if($quiz->duration > 0)
              $('.timer').attr('data-minutes-left', quizDuration);
              $('.timer').startTimer({
                 onComplete: function(element){

                 //first finish exam
             finishExam();
              //second show alert

                 if(alert('تم انتهاء وقت  الاختبار !')){}
                 else    window.location.reload();
              }
            });
              @endif

            },
            error: function (result) {
                alert('An error occurred.');

            },
        });

  }
</script>

{{-- when page load reload questions --}}
{{-- @if(isset($quizTemplate) && $quizTemplate == 'questions')
<script type="text/javascript">
$(document).ready(function(){

           $.ajax({
            method: 'get',
            url: "{{route('quizzes.quizPage', ['quiz' => $quiz->hashed_id])}}?page=1",
            success: function (result) {
              $('.start-quiz-meta').hide();
              $('.questions-meta').show();
              $('#quiz_template_body').html(result.view);
               // var currentQuestionOrder = $('#current-question-order').val();
              // $('#current_question_order').html(currentQuestionOrder);
            var result_template = $('#result_template').val();
              if(result_template > 0){
                $('.quiz-meta').hide();
              }
              var quizDuration = $('#quiz_duration').data('quiz_duration');
              $('.timer').attr('data-minutes-left', quizDuration);
              $('.timer').startTimer({
                 onComplete: function(element){

              }
            }).click(function(){ location.reload() });

            },
            error: function (result) {
                alert('An error occurred.');

            },
        });

});

</script>

@endif --}}



<script type="text/javascript">
    $( function() {


  $('body').on('click','.submit_form_btn',function(e){
    var form = $(".ajax_submit_form_1");
    var url = $(this).data('url');

    $.ajax({
           type: form.attr('method'),
           url: url,
           data: form.serialize(), // serializes the form's elements.
           cache: false,
           success: function(result)
           {
            $('#quiz_template_body').html(result.view);

             // var currentQuestionOrder = $('#current-question-order').val();
            // $('#current_question_order').html(currentQuestionOrder);
               // alert(data);  show response from the php script.

            var result_template = $('#result_template').val();
            console.log(result_template);
              if(result_template > 0){
                $('.quiz-meta').hide();
              }
           }
         });


  e.preventDefault(); // avoid to execute the actual submit of the form.


});
  });

</script>

<script type="text/javascript">
  function finishExam (){
   var form = $('.ajax_questions_form');

                 $.ajax({
                  method: 'POST',
                    url : form.attr('action')+'?finish_quiz=1',
                    data: form.serialize(),
                    cache: false,
                }).done(function (data) {
                    $('#quiz_body').html(data.view);

                }).fail(function () {
                    alert('Quizzes could not be loaded.');
                });
  }
</script>


<script type="text/javascript">
  $('body').on('click','.show-hide-board',function(e){

  $('.alrabeh-board').toggle(
    function(){
        $('#board-panel').animate({
            height: "150", 
            padding:"20px 0",
            backgroundColor:'#000000',
            opacity:.8
        }, 500);

    },
    function(){
        $('#board-panel').animate({
            height: "0", 
            padding:"0px 0",
            opacity:.2
        }, 500);     

});

  });
</script>

