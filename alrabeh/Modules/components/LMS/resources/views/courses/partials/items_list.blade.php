   <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            	         <div id="alert_error_items_section"></div>

    <div  class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>
              <table id="courseItemsListDT" class="table table-bordered table-striped">
                <thead>
                  
                <tr>
                  <th>{{ __('LMS::attributes.main.title') }}</th>
                 
                  <th>{{ __('LMS::attributes.main.options') }}</th>
                </tr>
              
                </thead>
                <tbody>



               @foreach($courseItems as $row)
                <tr id="courseItem_row_{{ $row->id }}">
                  <td>{{ $row->title }}</td>
                 
                  <td><button type="button" class="btn btn-success btn-sm" style="margin:0;"
                                data-index="{{$row->id }}" onclick="itemAddToCourse('{{$item_type}}', '{{$row->id}}')"><i
                                    class="fa fa-plus-circle"></i>
                        </button></td>
                </tr>
                @endforeach
         
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box --> 

   <script type="text/javascript">
 $('#courseItemsListDT').DataTable();
   </script>


<script type="text/javascript">

var section_id = "{{$section_id}}";


    function itemAddToCourse(item_type, item_id) {

   	  $.post('/lms/ajax/courses/'+section_id+'/'+item_type+'/'+item_id+'/{{$course_session_id}}/add_to_section', function(result, status){
                 if($.isEmptyObject(result.error)){
                $(".print-error-msg").hide();
                $('#new_section_item_row_'+section_id).before(result);
                $('#courseItem_row_' + item_id).fadeOut(300, function(){ $(this).remove();});
          
    
                    }else{
                    printErrorMsg(result.error);
                         $("#alert_error_items_section").animate({ scrollTop: 0 }, "slow");
                  }
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
