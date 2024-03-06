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
                  <th>{{ __('LMS::attributes.main.price') }}</th>
                  <th>{{ __('LMS::attributes.main.options') }}</th>
                </tr>
              
                </thead>
              

        @foreach($invoiceItems as $row)
            @php

							if($row->sale_price > 0){

								$rowPrice = $row->sale_price;

							}else{

								$rowPrice = $row->price;

							}
						@endphp

            <tr id="added_Item_row_{{ $row->id }}">
                  <td>{{ $row->title }}</td>
                  <td>
              <div class="input-group margin">
              	 <input type="number" class="form-control" name="item_price" id="item_price_{{$item_type.'_'.$row->id}}" value="{{$rowPrice}}">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">Action
                    <span class="fa fa-caret-down"></span></button>
                  <ul class="dropdown-menu">
                    <li><a href="javascript:;">Sala Price [{{$row->sale_price}}]</a></li>
                    <li><a href="javascript:;">original Price [{{$row->price}}]</a></li>
                   
                  </ul>
                </div>
                <!-- /btn-group -->
               
              </div></td>
                 
                  <td><button type="button" class="btn btn-success btn-sm" style="margin:0;"
                                data-index="{{$row->id }}" onclick="itemAddToInvoice('{{$item_type}}', '{{$row->id}}', '{{$row->title}}')"><i
                                    class="fa fa-plus-circle"></i>
                        </button></td>
                </tr>
                @endforeach
         
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box --> 

   <script type="text/javascript">
 $('#courseItemsListDT').DataTable();
   </script>


<script type="text/javascript">




    function itemAddToInvoice(item_type, item_id, title) {

    	var item_price = $("#item_price_"+item_type+'_'+item_id).val();
  

   	  $.post('/lms/ajax/invoices/'+item_type+'/'+item_id+'/{{$session_id}}/add_to_invoice?item_price='+item_price+'&item_title='+title, function(result, status){

   	  	$("#invoice-items-table .last_tr:last").before(result);
        $("#not_purchases_found").hide();
        $("#invoice-items-table").show();
        var total_price = $("#total_price_value").text();
        var new_total_price = parseInt(item_price) + parseInt(total_price);
        $("#total_price_value").text(new_total_price);

        $('#added_Item_row_' + item_id).fadeOut(300, function(){ $(this).remove();});

                
         });



    };


</script>
