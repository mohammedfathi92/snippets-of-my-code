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
@endphp

@php
$main_currency = getMainCurrency();
@endphp

@section('content')
    <div class="row">
        <div class="col-md-12">

          @include('ERP::orders.components.steps', ['order' => $order, 'current_step' => 3])

          {!! Form::model($payment, ['url' => url($resource_url.'/'.$order->hashed_id.'/payments/store'),'method'=>'POST','files'=>true,'class'=>'ajax-form']) !!}
            @component('components.box',['box_title'=>trans('ERP::attributes.order.tabs.payment')])

              <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- payments fields here-->
                        <div class="row">

                        <div class="col-md-4">
                          {!! PackagesForm::text('reg_code','ERP::attributes.main.reg_code',$payment->exists?true:false,null) !!}
                         </div>

                <div class="col-md-4">
                  {!! PackagesForm::select('sub_type','ERP::attributes.financials.payment_item',__('ERP::attributes.financials.orders_sub_types_options'),true) !!}
                </div>

                         <input type="hidden" name="main_order_id" value="{{$order->id}}">

                         <input type="hidden" name="itemable_id" value="{{$order->id}}">
                         <input type="hidden" name="itemable_type" value="erp_main_order">

{{--            <div class="form-group col-md-4 required-field">
            <label for="row_payment_items">{{__('ERP::attributes.financials.payment_item')}}</label>
               <select class="form-control with-select2" id="row_payment_items" name="itemable_id">

             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>

              <option value="{{$order->id}}" data-type="erp_main_order">{{__('ERP::attributes.financials.for_all_order')}}
              </option>

             @if($hotels->count())

                 <optgroup label="{{__('ERP::attributes.financials.order_groups.hotels')}}">
                 @foreach($hotels as $row)   
                  <option value="{{$row->id}}" data-type="erp_hotel_order">{{$row->hotel?$row->hotel->name:''}}</option>
                  @endforeach
                 </optgroup>
              @endif
              @if($flights->count())   
                <optgroup label="{{__('ERP::attributes.financials.order_groups.flights')}}">
                 @foreach($flights as $row)   
                  <option value="{{$row->id}}" data-type="erp_flight_order">{{$row->airline?$row->airline->name:''}}</option>
                  @endforeach
                </optgroup>
               @endif
              @if($ferries->count())   
                <optgroup label="{{__('ERP::attributes.financials.order_groups.ferries')}}">
                 @foreach($ferries as $row)   
                  <option value="{{$row->id}}" data-type="erp_ferry_order">{{$row->ferry?$row->ferry->name:''}}</option>
                  @endforeach
                </optgroup>
               @endif
                  @if($buses->count())   
                <optgroup label="{{__('ERP::attributes.financials.order_groups.buses')}}">
                 @foreach($buses as $row)   
                  <option value="{{$row->id}}" data-type="erp_bus_order">{{$row->bus?$row->bus->name:''}}</option>
                  @endforeach
                </optgroup>
               @endif
               @if($transports->count())   
                <optgroup label="{{__('ERP::attributes.financials.order_groups.transports')}}">
                 @foreach($transports as $row)   
                  <option value="{{$row->id}}" data-type="erp_transport_order">{{$row->vehicleType?$row->vehicleType->name:''}}</option>
                  @endforeach
                </optgroup>
               @endif

               @if($services->count())   
                <optgroup label="{{__('ERP::attributes.financials.order_groups.services')}}">
                 @foreach($services as $row)   
                  <option value="{{$row->id}}" data-type="erp_service_order">{{$row->service?$row->service->name:''}}</option>
                  @endforeach
                </optgroup>
               @endif
               @if($activities->count())   
                <optgroup label="{{__('ERP::attributes.financials.order_groups.activities')}}">
                 @foreach($activities as $row)   
                  <option value="{{$row->id}}" data-type="erp_activity_order">{{$row->activity?$row->activity->name:''}}</option>
                  @endforeach
                </optgroup>
               @endif


            </select>
            <input type="hidden" name="itemable_type" class="itemable-type">
        </div> --}}

         <div class="col-md-4">
         {!! PackagesForm::number('reg_value', 'ERP::attributes.financials.value',true, null, ['step'=> ".01", 'placeholder' => '0.00', 'id' => 'final_value'] ) !!}
             <input type="hidden" name="value_type" value="amount">
             </div>



                        </div>
               <div class="row">
                <div class="col-md-4">
                  {!! PackagesForm::select('category_id','ERP::attributes.financials.account_type',\ERP::getCategoriesByType('financial_accounts'),true,null, ['class' => 'get-category-accounts', 'data-other_id' => 'fin_to_account_id'],'select2') !!}
                </div>

                 <div class="col-md-4">
                  {!! PackagesForm::select('to_account_id','ERP::attributes.financials.to_account',[],true,null, ['id' => 'fin_to_account_id'],'select2') !!}
                </div>

                 <div class="col-md-4">
                  {!! PackagesForm::select('pay_method_id','ERP::attributes.financials.payment_method',\ERP::getCategoriesByType('payment_methods'),true,null,[],'select2') !!}
                </div>
                

               </div>         

           <div class="row">
            <div class="form-group col-md-4 required-field">
            <label for="row_payment_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_payment_value_currency_id" name="value_currency_id">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach(\ERP::getCurrenciesData() as $row)
              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-4 required-field">
                   <label for="row_payment_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_payment_value_currency_rate" type="number" name="value_currency_rate" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="old_currency_rate" class="orig-exchange-rate" value="" step=".000000001">

                <input type="hidden" name="main_currency_id" value="{{$main_currency->id}}">

                     <input type="hidden" name="main_currency_rate" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">


                        <div class="col-md-4">
                          {!! PackagesForm::text('fees_percent','ERP::attributes.main.fees_percent',$payment->exists?true:false,null) !!}
                        </div>

        </div>


                    <div class="row">
                        <div class="col-md-4">
                          {!! PackagesForm::text('payment_date','ERP::attributes.main.payment_date',false,null,['class' => 'datepicker']) !!}
                         </div> 

                        <div class="col-md-4">
                          {!! PackagesForm::text('refrence_code','ERP::attributes.financials.refrence_code',true,null) !!}
                         </div> 

                       <div class="col-md-4">
                          {!! PackagesForm::select('recipient_id','ERP::attributes.financials.recipient',\ERP::getEmployeesList(),true,null, [], 'select2') !!}
                        </div>  
                        
                    </div>

                    <hr>

                <div class="row">
                        <div class="col-md-4">
                            {!! PackagesForm::radio('select_commission','ERP::attributes.financials.select_commission',false, __('ERP::attributes.main.yes_no'), 'yes', ['class' => 'create_commission']) !!}

                        </div>
                    </div>

                    <div class="row commission-row" style="display: none;">
                        <div class="col-md-3">
                         <div style="display: inline-flex;">
                            {!! PackagesForm::number('commission[reg_value]', 'ERP::attributes.financials.commission_value',false, null, ['step'=> ".01", 'placeholder' => '0.00', 'id' => 'commission_reg_value'] ) !!}
                             {!! PackagesForm::select('commission[value_type]','ERP::attributes.financials.label_commission_type',__('ERP::attributes.financials.commission_type_options'),false,null, ['class' => 'commission-type']) !!}
                         
                         </div>
                         </div>


                        <div class="col-md-3">
                          {!! PackagesForm::select('commission[to_user_id]','ERP::attributes.financials.to_user',\ERP::getAgentsList(),true,null, ['class' => 'get-user-account', 'data-other_id' => 'commission_to_account'], 'select2') !!}
                        </div>

                         <div class="col-md-3">
                          {!! PackagesForm::select('commission[to_account_id]','ERP::attributes.financials.to_account',[],true,null, ['id' => 'commission_to_account'], 'select2') !!}
                        </div>

                        <div class="col-md-3">
                          {!! PackagesForm::text('commission[reg_code]','ERP::attributes.main.reg_code',$payment->exists?true:false,null) !!}
                         </div>
 

{{--                         <input type="hidden" name="commission[description]" value="{{__('ERP::attributes.financials.disacriptions.commission_order', ['order' => $order->reg_code])}}"> --}}

                    </div>

                    <br>
                    

                                         {{-- translation row --}}
                    <div class="row">
                     @if(count(\Settings::get('supported_languages', [])) > 0)   

                     <div class="nav-tabs-custom" id="tabs">
                        <ul class="nav nav-tabs">
                                @foreach (\Language::allowed() as $code => $name) 
                                  <li class="{{ $code=='ar'?'active':'' }}"><a data-target="#lang_{{ $code }}" data-toggle="tab"  href>{{ $name }}</a></li>
                                @endforeach 
                        </ul>
                    <div class="tab-content" style="background-color: #efeded;">

                     @foreach (\Language::allowed() as $code => $name) 
                     
                    <div class="{{ $code=='ar'?'active':'' }} tab-pane" id="lang_{{ $code }}">

                        {!! PackagesForm::text('description['.$code.']','ERP::attributes.financials.brief_description',true,null,['maxlength' => '100']) !!}

                       {!! PackagesForm::textarea('notes['.$code.']','ERP::attributes.main.notes',false) !!}
                  
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}


              </div>      




        
            @endcomponent
                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>
        </div>
    </div>
     {!! Form::close() !!}


@endsection

@section('js')
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
@endsection