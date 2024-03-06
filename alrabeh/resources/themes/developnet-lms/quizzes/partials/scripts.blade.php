<script type="text/javascript">
	$( function() {
    
  $('body').on('click','#startQuizBtn',function(){

  	        $.ajax({
            method: 'POST',
            url: '/lms/ajax/courses/0/'+item+'/create',
            data: $('#createCourseSection :input').serialize(),
            success: function (result) {
                  if($.isEmptyObject(result.error)){
                $(".print-error-msg").hide();
                $(".panel-collapse").removeClass('in').attr('aria-expanded', false).attr('style', '');
                $('#new_course_item_row').before(result);

    
                    }else{
                        printErrorMsg(result.error);
                         $("#alert_error_section").animate({ scrollTop: 0 }, "slow");
                    }
            },
            error: function (result) {
                alert('An error occurred.');

            },
        });


});  

});
</script>