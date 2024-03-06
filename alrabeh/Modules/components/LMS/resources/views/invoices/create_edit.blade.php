@extends('layouts.crud.create_edit')

@section('css')
<style type="text/css">
    .display-flex{
        display: flex;
        align-items: flex-end;
        margin-bottom: 10px
    }
     .display-flex div:first-child{
        margin: 0 2px;
     }

</style>
@endsection
 
@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('lms_invoice_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-10">
            {!! Form::model($invoice, ['url' => url($resource_url.'/'.$invoice->hashed_id),'method'=>$invoice->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}

             <div class="row">

           <div class="col-md-12">
                    @component('components.box', ['box_title' => __('LMS::attributes.main.general_head')])
                    <div class="row">
                       <div class="col-md-12">
                      <div class="col-md-6">
                         {!! ModulesForm::text('code','LMS::attributes.invoices.code',false,null, $invoice->exists?['disable']:[]) !!}
                        
                      </div>

                     
                      <div class="col-md-6">
                         {!! ModulesForm::select('user_id','LMS::attributes.invoices.full_user_name',\LMS::getUsersList(),true, null, $invoice->exists?['disable']:[],'select2') !!}
                        
                      </div>

                    </div>
                  </div>

                  @php

                  $status_options = [
                    'paid' => __('LMS::attributes.invoices.paid'),
                    'pending' => __('LMS::attributes.invoices.pending'),
                    'cancelled' => __('LMS::attributes.invoices.cancelled'),
                  ];
                  @endphp


                       <div class="row">
                       <div class="col-md-12">

                         <div class="col-md-6">
                         {!! ModulesForm::text('used_coupon','LMS::attributes.invoices.used_coupon',false,null, $invoice->exists?['disable']:[]) !!}
                        
                      </div>

                   <div class="col-md-6">
                         {!! ModulesForm::select('status','LMS::attributes.main.status',$status_options,true, null) !!}
                        
                      </div>

                   

                    </div>
                  </div>

                     <div class="row">
                       <div class="col-md-12">
                         <div class="col-md-12">
                   
                         {!! ModulesForm::textarea('notes','LMS::attributes.invoices.notes',false,null) !!}
                        
                  
</div>
                    

                    </div>

                  </div>
             
    

                             <div class="row">
                       <div class="col-md-12">
                        
                   
                          <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Table of Purchases</h3>
            </div>

            <div class="box-body">
              <p id ="not_purchases_found" @if(countData($invoice->invoicables()))style="display: none;" @endif>No Purchases Found</p>
              <div class="table-responsive no-padding">
  
              <table class="table table-hover" id="invoice-items-table"  @if(!countData($invoice->invoicables()))style="display: none;" @endif>
               
                <tr>
                 
                  <th>Type</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>options</th>

                 
                </tr>
                @php
                $total_price = [];
                @endphp
                @foreach($invoice->invoicables()->get() as $row)
                <tr>
                  <td><span class="label label-success">Approved</span></td>
                  <td>{{$row->title}}</td>
                  <td>{{$row->price}}</td>
                  <td><a href="" class="btn btn-danger">X</a></td>
                </tr>
                @php
                $total_price[] = $row->price;
                @endphp
                @endforeach
           
                 <tr class="last_tr"></tr>
                 <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td><strong>Total Price:</strong> <span id="total_price_value"> {{!empty($total_price)?array_sum($total_price):0}}</span> </td>
                </tr>
              </table>
              </div>
                         <!-- /.box-header -->
            <div class="row">
            <div class="col-md-12">
                <div class="btn-group">
                  <button type="button" class="btn btn-success">Select Items</button>
                  <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="javascript:;" class="open_items_modal" data-url="{{route('ajax.invoices.items_list', ['type' => 'plan', 'session_id' => $session_id])}}">Plans</a></li>
                    <li><a href="javascript:;" class="open_items_modal" data-url="{{route('ajax.invoices.items_list', ['type' => 'course', 'session_id' => $session_id])}}">courses</a></li>
                    <li><a href="javascript:;" class="open_items_modal" data-url="{{route('ajax.invoices.items_list', ['type' => 'quiz', 'session_id' => $session_id])}}">Quizzes</a></li>
                    
                    
                  </ul>
                </div>
              
            </div>
            </div>
            <br>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>

                    </div>
             

                    
                      
                     
                   @endcomponent   

 


                    
            
          </div>
        </div>

            <div class="row">
               <div class="col-md-12">
                @component('components.box')

                    {!! ModulesForm::customFields($invoice) !!}

                    <div class="row">
                        <div class="col-md-12">
                            {!! ModulesForm::formButtons() !!}
                        </div>
                    </div>
                @endcomponent
              </div>
            </div>
            {!! Form::close() !!}

        </div>

          </div>


  <!-- Modal -->
  <div class="modal fade" id="selectItemModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
         
           
           </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  
@endsection



@section('js')

<script src="/assets/themes/admin/plugins/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/assets/themes/admin/plugins/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">

        $( function() {
    
  $('body').on('click','.open_items_modal',function(){

        var url = $(this).data('url');

        $('#selectItemModal').modal('show').find('.modal-body').load(url);
       
});  

});
    

</script>

<script type="text/javascript">
          $( function() {
    
  $('body').on('click','.remove_item',function(){
        var itemRow =  $(this);
        var url = itemRow.data('url');
        var item_price = itemRow.data('price');
        var total_price = $("#total_price_value").text();
       
        $.post(url, function(result, status){

         itemRow.closest('tr').remove();
        var new_total_price = parseInt(total_price) - parseInt(item_price);
        if(new_total_price < 1){
          $("#total_price_value").text(0.00);
         $("#not_purchases_found").show();
        $("#invoice-items-table").hide();
        }else{
           $("#total_price_value").text(new_total_price);
        }
        



        

                
         });
       
});  

});
  
</script>
@endsection