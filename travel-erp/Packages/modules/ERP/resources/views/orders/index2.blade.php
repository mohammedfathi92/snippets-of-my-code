@extends('layouts.crud.create_edit')

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
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