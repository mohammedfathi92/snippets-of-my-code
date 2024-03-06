
<div id="services_orders">

<div id="row_services_0" class="service-row general-row" style="background-color: #eff0f1; padding: 10px;" data-index="0">
   <div class="alert alert-danger" style="display: none;" id="alert_row_services_0">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>

    <input type="hidden" value="false" class="classfy-prices">


<div class="row">
         
         <div class="form-group col-md-2 day-row required-field">
                   <label for="row_services_0_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control general-day order-days" name="services[0][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                <option value="1">1</option>
              </select>
               <input type="hidden" class="hidden_day_val" value="1">
          </div>

 <div class="form-group col-md-2 required-field">
            <label for="row_services_0_start_date">{{__('ERP::attributes.order.start_date')}}</label>
              <input id="row_services_0_start_date" type="text" name="services[0][start_date]" class="form-control start-date-input datepicker" readonly="">
        </div>

        <div class="form-group col-md-2">
            <label for="row_services_0_start_time">{{__('ERP::attributes.order.start_time')}}</label>
              <input id="row_services_0_start_time" type="text" name="services[0][start_time]" class="form-control timepicker" >
        </div>

           <div class="form-group col-md-2">
            <label for="row_services_0_country">{{__('ERP::attributes.main.country')}}</label>
               <select class="form-control countries-list_1 with-select2 get_geo_lists with-dest-country general_price_input_group" id="row_services_0_country" name="services[0][country_id]" data-list_type= 'cities' data-other_select_id= 'row_services_0_city' data-select2_class= 'with-select2'  data-closest_class ='service-row' data-item_type='countries' data-currency_div_id="row_services_0_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
           </div>

        <div class="form-group col-md-2"> 
            <label for="row_services_0_city">{{__('ERP::attributes.main.city')}}</label>
               <select class="form-control with-select2 cities-list_1 with-dest-city get_geo_lists" id="row_services_0_city" name="services[0][city_id]" data-list_type= 'services' data-other_select_id= 'row_services_0_service' data-select2_class= 'with-select2'  data-closest_class ='service-row' data-item_type='cities'>
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>

  
           <div class="form-group col-md-2 required-field">
            <label for="row_services_0_service">{{__('ERP::attributes.order.service')}}</label>
               <select class="form-control selected-service with-select2 geo_child" id="row_services_0_service" name="services[0][service_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             
             
            </select>
            </div>

      
           </div> {{-- end row --}}


           <div class="row">



          <div class="form-group col-md-2 required-field">
            <label for="row_services_0_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control service_price_type" id="row_services_0_price_type" name="services[0][price_type]">

                @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>

            <div class="form-group col-md-2 required-field">
                   <label for="row_services_0_quantity">{{__('ERP::attributes.order.quantity')}}</label>
               <input id="row_services_0_quantity" type="number" name="services[0][quantity]" placeholder="1" class="form-control general_price_input_group quantity" value="1">
          </div>


          <div class="form-group col-md-2 required-field">
                   <label for="row_services_0_price">{{__('ERP::attributes.order.price')}}</label>
               <input id="row_services_0_price" type="number" name="services[0][price]" placeholder="00.00" class="form-control general_price_input_group price-input" step=".01">
          </div>

  
          <input type="hidden" name="services[0][auto_price]" class="auto_price">


          <div class="form-group col-md-2">
                   <label for="row_services_0_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_services_0_total_price" type="text"  placeholder="00.00" class="form-control total-price" step=".01" readonly="">
          </div>

            <div class="form-group col-md-2 required-field">
                   <label for="row_services_0_cost">{{__('ERP::attributes.order.cost')}}</label>
               <input id="row_services_0_cost" type="number" name="services[0][cost]" placeholder="00.00" class="form-control general_price_input_group cost-input" step=".01">
          </div>

          <input type="hidden" name="services[0][auto_cost]" class="auto_cost">


          <div class="form-group col-md-2">
                   <label for="row_services_0_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_services_0_total_cost" type="text"  placeholder="00.00" class="form-control cost_input_group total-cost" step=".01" readonly="">
          </div>


     </div> {{-- end row --}}

  

          <div class="row">


          <div class="form-group col-md-2">
            <label for="row_services_0_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select2" id="row_services_0_provider" name="services[0][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
        </div>


            <div class="form-group col-md-2 required-field">
            <label for="row_services_0_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_services_0_value_currency_id" name="services[0][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_services_0_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_services_0_value_currency_rate" type="number" name="services[0][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="services[0][old_currency_id]" class="orig-exchange-id" value="">

           <input type="hidden" name="services[0][old_currency_rate]" class="orig-exchange-rate" value="" step=".000000001">

          <input type="hidden" name="services[0][main_currency_rate]" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="services[0][main_currency_id]" value="{{$main_currency->id}}" class="main-currency-id">

          <div class="form-group col-md-2">
            <label for="row_services_0_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_services_0_due_date" type="text" name="services[0][due_date]" class="form-control datepicker">
            </div>

             <div class="form-group col-md-2">
                   <label for="row_services_0_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_services_0_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="services[0][prepay_percent]">
        </div>
                   <div class="form-group col-md-2">
                   <label for="row_services_0_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_services_0_reg_code" type="text" name="services[0][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}">
          </div>


        

       


     </div> {{-- end row --}}



     <div class="row">

             

          <div class="form-group col-md-4">
                   <label for="row_services_0_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_services_0_notes" type="text" name="services[0][booking_notes]" class="form-control">
          </div>
     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
         <button type="button" class="btn btn-default get_general_auto_prices"  data-elem_type="service"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="disabled-form-inputs disabled-row-btn active btn btn-danger" data-row_id="row_services_0" ><i class="fa fa-times"></i></a>
         <span></span>
       </div>
      </div>

     </div>

       </div> 

<br>
</div>
   <div class="row">
    <div class="col-md-12">
            <center>
                <button class="btn btn-info ladda-button new-general-row-btn" type="button" data-main_row_id="services_orders" data-main_row_class="service-row" data-main_row_prefix="row_services_"><i class="fa fa-plus-circle"></i> {{__('ERP::attributes.main.add_new_row')}}</button>
        
    </center>
        
    </div>

</div>



