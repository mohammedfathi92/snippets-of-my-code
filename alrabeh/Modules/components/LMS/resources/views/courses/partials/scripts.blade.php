


 <script src="/assets/themes/admin/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/themes/admin/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
  $( function() {
    $( "#course-items-list-group" ).sortable({ 
        handle : '.handle', 
    }); 
});

  // $( function() {
  //   $( "#sortable" ).sortable({ 
  //           handle : '.handle', 
  //           update : function () { 
  //               var order = $('#sortable').sortable('serialize'); 
  //                console.log(order);
                     // $("#info").load("process-sortable.php?"+order); 

  //           } 
  //       }); 


  // });
</script>


<script type="text/javascript">
   function createCourseItem(item, divId) {
        $.ajax({
            method: 'POST',
            url: '/lms/ajax/courses/0/'+item+'/{{$course_session_id}}/create',
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

    };

     function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
        }
</script>




<script type="text/javascript">

        $( function() {
    
  $('body').on('click','.select_section_items',function(){

        var item = $(this);
        var type = item.attr('data-item-type');
        var section = item.attr('data-section-id');

        $('#selectCourseItemsModal').modal('show').find('.modal-body').load('/lms/ajax/courses/'+section+'/'+type+'/{{$course_session_id}}/list');
       
});  

});
    

</script>


<script type="text/javascript">

    $( function() {
    
  $('body').on('click','.update_course_item',function(){

        var item = $(this);
        var item_id = item.attr('data-id');
        var type = item.attr('data-type');
        var parent_div = item.parents('.ajax_submit_inputs').closest('.ajax_submit_inputs');

     $.ajax({
            method: 'PUT',
            url: '/lms/ajax/courses/'+item_id+'/'+type+'/update',
            data: parent_div.children('input').serialize(),

            success: function (result) {
                  if($.isEmptyObject(result.error)){
                $(".print-error-msg").hide();


                if(type == 'section'){

                $('#section_title_'+item_id).html('<i class="fa fa-list grabbing handle" style="color:#111"></i> ' +result.title); 

                    $('#sectionEditModal').modal('hide');

                }else{

                var inputTitle = $(parent_div).children("input.course_item_title").first();
                 inputTitle.val(result.title);
              

            
                }
               
                
    
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




<script type="text/javascript">

    $( function() {
    
  $('body').on('click','.openEditSection',function(){
     var section_id = $(this).attr('data-id');  
     $('#sectionEditModal').modal('show').find('.modal-body').load('/lms/ajax/courses/section/'+section_id+'/edit_section');
});  

});
</script>

<script type="text/javascript">

    $( function() {
    
  $('body').on('click','.add_section_item',function(){
    var item = $(this);
    var section_id = item.attr('data-section-id');
    var type = item.attr('data-item-type');
    var parent_div = item.parents('.ajax_submit_inputs').closest('.ajax_submit_inputs');

        $.ajax({
            method: 'POST',
            url: '/lms/ajax/courses/'+section_id+'/'+type+'/{{$course_session_id}}/create',
            data: parent_div.children('input').serialize(),

            success: function (result) {
                  if($.isEmptyObject(result.error)){
                $(".print-error-msg").hide();
               
                $('#new_section_item_row_'+section_id).before(result);
    
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


<script type="text/javascript">

    

     $('body').on('click','.remove_course_item',function(){
        var id = $(this).attr('data-id');
        var type = $(this).attr('data-type');
        console.log(type);
if(type == 'section'){

    var parent_div = $(this).parents('.parent_section_row').closest('.parent_section_row');

    


}else{

    var parent_div = $(this).parents('.parent_item_row').closest('.parent_item_row');

      

}

   $.post('/lms/ajax/courses/'+type+'/'+id+'/{{$course_session_id}}/remove_from_course', function(result, status){
                
                     
          
parent_div.remove();
                  
    });



       




 

              
            });

</script>

<script type="text/javascript">
   $( function() {
    
  $('body').on('click','.btn_private_item',function(){

    var itemId = $(this).data('item_id');
    console.log(itemId);
    var is_private = $('#'+itemId).val();
    console.log(is_private);

    if(is_private > 0){
      $('#'+itemId).val(0);
      $(this).css("color", "#a2a7a2");
     

    }else{
           
      $('#'+itemId).val(1);
      $(this).css("color", "#4caf50");
     
    }


       
});  

});
  

</script>

      



