{{-- retakeQuiz --}}


<script type="text/javascript">
    $( function() {

  $('body').on('click','.preview_quiz_btn',function(){
    var parentForm = $(this).parents('form').closest('form');
           $.ajax({
            type: parentForm.attr('method'),
            url: parentForm.attr('action'),
            data: parentForm.serialize(),
            success: function (result) {
              $('.questions-meta').show();
              $('#quiz_body').html(result.view);
        var currentQuestionOrder = $('#current-question-order').val();
              $('#current_question_order').html(currentQuestionOrder);
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
    var currentQuestionOrder = $('.data-question-order').val();
           $.ajax({
            method: 'POST',
            url: $(this).data('form_url'),
            data: $('#start_quiz_form :input').serialize(),
            success: function (result) {
              $('.start-quiz-meta').hide();
              $('.questions-meta').show();
            	$('#quiz_template_body').html(result.view);
              $('#current_question_order').html(currentQuestionOrder);
              var quizDuration = $('#quiz_duration').data('quiz_duration');
              var result_template = $('#result_template').val();
              if(result_template > 0){
                $('.quiz-meta').hide();
              }
              $('.timer').attr('data-seconds-left', quizDuration);
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

});
    
</script>

{{-- when page load reload first question --}}
@if(isset($quizTemplate) && $quizTemplate == 'questions')
<script type="text/javascript">
$(document).ready(function(){
    
           $.ajax({
            method: 'get',
            url: $('#question_form').data('form_url'),
            data: $('#showQuestionForm :input').serialize(),
            success: function (result) {
              $('.start-quiz-meta').hide();
              $('.questions-meta').show();
              $('#quiz_template_body').html(result.view);
               var currentQuestionOrder = $('#current-question-order').val();
              $('#current_question_order').html(currentQuestionOrder);
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

@endif



<script type="text/javascript">
    $( function() {


  $('body').on('click','.submit_form_btn',function(e){
    var form = $(".ajax_submit_form_1");
    var url = $(this).data('url');
  
    $.ajax({
           type: form.attr('method'),
           url: url,
           data: form.serialize(), // serializes the form's elements.
           success: function(result)
           {
            $('#quiz_template_body').html(result.view);

             var currentQuestionOrder = $('#current-question-order').val();
            $('#current_question_order').html(currentQuestionOrder);
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

