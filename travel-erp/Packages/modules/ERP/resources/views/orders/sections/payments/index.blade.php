@extends('layouts.crud.create_edit')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('order_create_edit') }}
        @endslot
    @endcomponent
@endsection

@php
$hotels = $order->hotelsOrders()->get();
$flights = $order->flightsOrders()->get();
$transports = $order->transportsOrders()->get();
$services = $order->servicesOrders()->get();
$activities = $order->activitiesOrders()->get();
$ferries = $order->ferriesOrders()->get();
$buses = $order->busesOrders()->get();

$payments = $order->payments()->get();
@endphp

@php
$main_currency = getMainCurrency();
@endphp

@section('content')
    <div class="row">
        <div class="col-md-12">


          @include('ERP::orders.components.steps', ['order' => $order, 'current_step' => 3])
                  

        <div class="col-md-12">
          <div class="box box-success">
                  <div class="box-header with-border">
              <h3 class="box-title">{{trans('ERP::attributes.order.tabs.payment')}}</h3>

              <div class="box-tools pull-right">
               <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#create_new_payment" style="margin-left: 10px;">{!! trans('Packages::labels.create') !!}</button>
              <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#table_columns_visible" style="margin-left: 10px;"><i class="fa fa-gear"></i> {!! trans('ERP::attributes.main.btn_table_settings') !!}</button>
              </div>
              <!-- /.box-tools -->
            </div>
            <div class="box-body">

              <div id="create_new_payment" class="collapse" style="background-color: rgb(250, 250, 255);">
             @include('ERP::orders.sections.payments.create_payment')


             </div>

           <div id="table_columns_visible" class="collapse" style="background-color: rgb(250, 250, 255);">

            @php
            $columns = [ 0 => __('ERP::attributes.main.reg_code'),
                 1 => __('ERP::attributes.financials.payment_item'),
                 2 => __('ERP::attributes.financials.value'),
                 3 => __('ERP::attributes.financials.to_account'),
                 4 => __('ERP::attributes.financials.to_user'),
                 5 => __('ERP::attributes.financials.payment_method'),
                 6 => __('ERP::attributes.main.currency'),
                 7 => __('ERP::attributes.order.currency_rate'),
                 8 => __('ERP::attributes.main.fees_percent'),
                 9 => __('ERP::attributes.main.payment_date'),
                 10 => __('ERP::attributes.financials.refrence_code'),
                 11 => __('ERP::attributes.financials.recipient'),
                 12 => __('ERP::attributes.financials.parent_process'),
                 13 => __('ERP::attributes.main.status'),

                 14 => __('ERP::attributes.main.created_by'), 
                 15 => __('ERP::attributes.main.updated_by'),
                 16 => __('ERP::attributes.main.last_update'),
                 17 => __('ERP::attributes.main.created_at'),
                 18 => __('ERP::attributes.main.actions') ];
            @endphp
            <p><strong>{{__('packages-admin::labels.component.choose_column_to_visible')}}</strong></p> 
            <hr> 
            <ul class="vs-columns-list">   
            @foreach($columns as $key => $value)        
             <li class="vs-one-column-list"><input class="toggle-vis" type="checkbox" name="visible_column" @if($loop->index > 17 || $loop->index < 14) checked="" @endif data-column="{{$loop->index}}">{{$value}}</li>
             @endforeach 
           </ul>
             </div>


            <div class="col-md-12 table-responsive m-t-10">
              <table id="datatable-payments-2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>{{__('ERP::attributes.main.reg_code')}}</th>
                  <th>{{__('ERP::attributes.financials.payment_item')}}</th>
                  <th>{{__('ERP::attributes.financials.value')}}</th>
                  <th>{{__('ERP::attributes.financials.to_account')}}</th>
                  <th>{{__('ERP::attributes.financials.to_user')}}</th>
                  <th>{{__('ERP::attributes.financials.payment_method')}}</th>
                  <th>{{__('ERP::attributes.main.currency')}}</th>
                  <th>{{__('ERP::attributes.order.currency_rate')}}</th>
                  <th>{{__('ERP::attributes.main.fees_percent')}}</th>
                  <th>{{__('ERP::attributes.main.payment_date')}}</th>
                  <th>{{__('ERP::attributes.financials.refrence_code')}}</th>
                  <th>{{__('ERP::attributes.financials.recipient')}}</th>
                  <th>{{__('ERP::attributes.financials.parent_process')}}</th>
                  <th>{{__('ERP::attributes.main.status')}}</th>

                  <th>{{__('ERP::attributes.main.created_by')}}</th> 
                  <th>{{__('ERP::attributes.main.updated_by')}}</th>
                  <th>{{__('ERP::attributes.main.last_update')}}</th>
                  <th>{{__('ERP::attributes.main.created_at')}}</th> 
                  <th>{{__('ERP::attributes.main.actions')}}</th> 
                </tr>
                </thead>
                <tbody>
                  @foreach($payments as $row)
                <tr>
                  <td>{{$row->reg_code}}</td>
                  <td>{{__('ERP::attributes.financials.orders_sub_types_options.'.$row->sub_type)}}</td>
                  @if($row->value_type == 'percent')
                  <td>{{$row->final_value}} ({{$row->reg_value}})</td>
                  @else
                  <td>{{$row->reg_value}}</td>
                  @endif
                  <td>{{$row->to_account?$row->to_account->name:''}}</td>
                  <td>{{$row->to_user?$row->to_user->translated_name:''}}</td>
                  <td>{{$row->pay_method?$row->pay_method->name:''}}</td>
                  <td>{{$row->currency?$row->currency->name:''}}</td>
                  <td>{{$row->value_currency_rate}}</td>
                  <td>{{$row->fees_percent}}%</td>
                  <td>{{$row->payment_date}}</td>
                  <td>{{$row->refrence_code}}</td>
                  <td>{{$row->recipient?$row->recipient->translated_name:''}}</td>

                  <td>No. {{$row->parent?$row->parent->reg_code:''}}</td>
                  <td>{!! getOrderStatusLabel($row->status) !!}</td>
                  <td>{{$row->data_created_by?$row->data_created_by->translated_name:''}}</td>
                  <td>{{$row->data_updated_by?$row->data_updated_by->translated_name:''}}</td>
                  <td>{{format_date($row->data_updated)}}</td>
                   <td>{{format_date($row->created_at)}}</td>
                   <td>
                    <div class="item-actions pull-left">
                    <div class="btn-group pull-right">
                      <button type="button" class="btn btn-sm btn-default dropdown-toggle" style="padding: 2px 8px 0 8px;" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v" style="font-size: 1.2em;"></i></button>
                      <ul class="dropdown-menu" role="menu">
                        <li>
                          <a target="_self" href="javascript:;" data-url="{{url('erp/orders/'.$order->hashed_id.'/payments/ajax/'.$row->hashed_id.'/edit')}}" class="open_financial_modal">
                            <i class=""></i> <i class="fa fa-fw fa-pencil"></i> {{__('ERP::attributes.main.update_btn')}}
                          </a>
                        </li>

                        <li>
                          <a target="_self" href="javascript:;" data-url="{{url('erp/orders/'.$order->hashed_id.'/payments/ajax/'.$row->hashed_id.'/show')}}" class="open_financial_modal">
                            <i class=""></i> <i class="fa fa-eye"></i> {{__('ERP::attributes.main.show_btn')}}
                          </a>
                          @if($row->type == 'booking')
                          <a target="_self" href="javascript:;" data-url="{{url('erp/orders/'.$order->hashed_id.'/payments/ajax/'.$row->hashed_id.'/voucher')}}" class="open_financial_modal">
                            <i class=""></i> <i class="fa fa-list"></i> {{__('ERP::attributes.financials.receipt_voucher')}}
                          </a>
                          @endif
                        </li>

                      </ul>
                    </div>
                  </div>
                </td>

                </tr>
                @endforeach
               </tbody>
              </table>
              </div>
              </div>
           </div>
         </div>

        </div>
    </div>

  <!-- Modal -->
  <div class="modal fade" id="updatePaymentModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">

                <div class="modal-body">
          <p>Loading .... .</p>
        </div>

      </div>
      
    </div>
  </div>
@endsection

@section('css')
{!! \Html::style('assets/packages/plugins/datatables.net-bs/css/dataTables.bootstrap4.min.css') !!}
{!! \Html::style('assets/packages/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') !!}

<style type="text/css">
    .vs-columns-list {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
}

.vs-one-column-list {
  @if(\Language::isRTL())
  float: right;
  @else
  float: left;
  @endif
  display: block;
  /*text-align: center;*/
  padding: 16px;
}


</style>
@endsection

@section('js')
{!! \Html::script('assets/packages/plugins/datatables.net/js/jquery.dataTables.min.js') !!}
{!! \Html::script('assets/packages/plugins/datatables.net-bs/js/dataTables.bootstrap4.min.js') !!}
{!! \Html::script('assets/packages/plugins/datatables-buttons/js/dataTables.buttons.min.js') !!}
{!! \Html::script('assets/packages/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') !!}
{!! \Html::script('assets/packages/plugins/datatables.net/js/buttons.server-side.js') !!}

<script type="text/javascript">
    $(document).ready(function () {

        $('body').on('change', '.get-currency-rate', function(){

            var currencyId = $(this).val();
            var currentCurrencyRate = $('option:selected', this).data('rate');
            $(this).closest('.row').find('.mod-exchange-rate').val(currentCurrencyRate);
            $(this).closest('.row').find('.orig-exchange-rate').val(currentCurrencyRate)
        });

        });

            $(document).ready(function () {

        $('body').on('change', '.get-category-accounts', function(){

            var user_id = $(this).val();
            var other_id = $(this).data('other_id');

            var selectDiv = $('#'+other_id);
                selectDiv.html('');

            $.ajax({
            method: 'GET',
            url: '/erp/ajax/accounts/'+ user_id +'/get-category-accounts',

            success: function (result) {

              if(result.success){
                var list = result.list;

                for (var key in list) {
                  if (list.hasOwnProperty(key)) {

                    $('#'+other_id).append(new Option(list[key], key));
                 
                  }
                 }
              }else{
                alert(result.message);

               }
            },

            error: function (result) {
                alert('An error occurred.');

            },
    });
            

        });

        });

        $(document).ready(function () {

        $('body').on('change', '.get-user-account', function(){

            var user_id = $(this).val();
            var other_id = $(this).data('other_id');

            $.ajax({
            method: 'GET',
            url: '/erp/ajax/accounts/'+ user_id +'/get-user-accounts',

            success: function (result) {

              if(result.success){
                var list = result.list;

                var selectDiv = $('#'+other_id);
                selectDiv.html('');
                for (var key in list) {
                  if (list.hasOwnProperty(key)) {

                    $('#'+other_id).append(new Option(list[key], key));
                 
                  }
                 }
              }else{
                alert(result.message);

               }
            },

            error: function (result) {
                alert('An error occurred.');

            },
    });
            

        });

        });


            $(document).ready(function () {

        $('body').on('change', '#row_payment_items', function(){
            var type = $('option:selected', this).data('type');
            $(this).closest('.row').find('.itemable-type').val(type);
        });

        });

    


</script>
<script type="text/javascript">
  $(window).on("load", function () {

    var input = $('.create_commission');

     if (input.val() == 'yes') {
           $('.commission-row').show();
        }

    });
  $('body').on('change', '.create_commission', function(){
         if (this.checked && this.value == 'yes') {
           $('.commission-row').show();
        }else{

            $('.commission-row').hide();

        }
});

</script>


<script type="text/javascript">
    $(function () {
      
    var payDTable =$('#datatable-payments-2').DataTable({
       responsive: true,

         'columnDefs' : [
        { 'visible': false, 'targets': [14,15,16,17] }    ]
    });

  })
</script>
<script type="text/javascript">
          $('body').on( 'change','.toggle-vis', function () {
          var table = $('#datatable-payments-2').DataTable();
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
        // Toggle the visibility
        column.visible( ! column.visible() );
    });
</script>
<script type="text/javascript">

  $('body').on( 'click','.open_financial_modal', function () {
   var url = $(this).data('url');
    $('#updatePaymentModal').modal('show').find(".modal-content").load(url);
});
</script>

@endsection