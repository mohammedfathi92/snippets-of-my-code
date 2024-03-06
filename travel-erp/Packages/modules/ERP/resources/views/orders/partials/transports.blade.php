
<div id="transports_orders">

<div id="row_transports_0" class="transport-row general-row" style="background-color: #eff0f1; padding: 10px;" data-index="0">
   <div class="alert alert-danger" style="display: none;" id="alert_row_transports_0">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>
  <input type="hidden" value="false" class="classfy-prices">
<div class="row">
         
          <div class="form-group col-md-2 day-row required-field">
                   <label for="row_transports_0_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control general-day order-days" name="transports[0][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                <option value="1">1</option>
              </select>
               <input type="hidden" class="hidden_day_val" value="1">
          </div>

        <div class="form-group col-md-2">
            <label for="row_transports_0_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select2" id="row_transports_0_provider" name="transports[0][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
            </div>



           <div class="form-group col-md-2">
            <label for="row_transports_0_from_country">{{__('ERP::attributes.transport.from_country')}}</label>
               <select class="form-control countries-list_1 with-select2 get_geo_lists with-dest-country general_price_input_group" id="row_transports_0_from_country" name="transports[0][from_country_id]" data-list_type= 'cities' data-other_select_id= 'row_transports_0_from_city' data-select2_class= 'with-select2'  data-closest_class ='transport-row' data-item_type='countries' data-currency_div_id="row_transports_0_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2"> 
            <label for="row_transports_0_from_city">{{__('ERP::attributes.transport.from_city')}}</label>
               <select class="form-control with-select2 cities-list_1 with-dest-city get_places_cat" id="row_transports_0_from_city" name="transports[0][from_city_id]" data-place_cat_id="row_transports_0_source_type" data-place_id="row_transports_0_source_place" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>
  
           <div class="form-group col-md-2">
            <label for="row_transports_0_source_type">{{__('ERP::attributes.transport.source_type')}}</label>
               <select class="form-control source-type-list with-select2 get_place_type_lists geo_child" id="row_transports_0_source_type" name="transports[0][sourcable_type]" data-list_type= 'places' data-other_select_id= 'row_transports_0_source_place' data-select2_class= 'with-select2'  data-closest_class ='transport-row' data-item_type='places_types' data-city_div_id="row_transports_0_from_city">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
 
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_transports_0_source_place">{{__('ERP::attributes.transport.source_place')}}</label>
               <select class="form-control with-select2 source-places-list geo_child" id="row_transports_0_source_place" name="transports[0][sourcable_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>

      
      </div> {{-- end row --}}

           <div class="row">


        <div class="form-group col-md-2 required-field"> 
            <label for="row_transports_0_vehicle_type">{{__('ERP::attributes.transport.vehicle_type')}}</label>
               <select class="form-control selected-service with-select2 vehicles_types-list" id="row_transports_0_vehicle_type" name="transports[0][vehicle_type_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($vehiclesTypes as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>

         <div class="form-group col-md-2 required-field">
            <label for="row_transports_0_vehicles_num">{{__('ERP::attributes.order.number')}}</label>
            <input id="row_transports_0_vehicles_num" type="number" name="transports[0][vehicles_num]" placeholder="1" class="form-control general_price_input_group vehicles_num quantity" value="1">
              
        </div>

          <div class="form-group col-md-2">
            <label for="row_transports_0_to_country">{{__('ERP::attributes.transport.to_country')}}</label>
               <select class="form-control countries-list_2 with-select2 get_geo_lists with-dest-country general_price_input_group" id="row_transports_0_to_country" name="transports[0][to_country_id]" data-list_type= 'cities' data-other_select_id= 'row_transports_0_to_city' data-select2_class= 'with-select2'  data-closest_class ='transport-row' data-item_type='countries' data-currency_div_id="row_transports_0_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

        <div class="form-group col-md-2"> 
            <label for="row_transports_0_to_city">{{__('ERP::attributes.transport.to_city')}}</label>
               <select class="form-control with-select2 cities-list_2 with-dest-city get_places_cat" id="row_transports_0_to_city" name="transports[0][to_city_id]" data-place_cat_id="row_transports_0_target_type" data-place_id="row_transports_0_target_place" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>
  
           <div class="form-group col-md-2">
            <label for="row_transports_0_target_type">{{__('ERP::attributes.transport.target_type')}}</label>
               <select class="form-control target-type-list with-select2 get_place_type_lists geo_child" id="row_transports_0_target_type" name="transports[0][targetable_type]" data-list_type= 'places' data-other_select_id= 'row_transports_0_target_place' data-select2_class= 'with-select2'  data-closest_class ='transport-row' data-item_type='places_types' data-city_div_id="row_transports_0_to_city">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
{{--               @foreach($placesType as $key => $value)
               <option value="{{$key}}">{{$value}}</option>
              @endforeach --}}
            </select>
            </div>

        <div class="form-group col-md-2 required-field"> 
            <label for="row_transports_0_target_place">{{__('ERP::attributes.transport.target_place')}}</label>
               <select class="form-control with-select2 target-places-list geo_child" id="row_transports_0_target_place" name="transports[0][targetable_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
        </div>

         
   
           </div> {{-- end row --}}

                    <div class="row">



                   <div class="form-group col-md-2 required-field">
            <label for="row_transports_0_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control transport_price_type" id="row_transports_0_price_type" name="transports[0][price_type]">

                @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_transports_0_price">{{__('ERP::attributes.order.price')}}</label>
               <input id="row_transports_0_price" type="number" name="transports[0][vehicle_price]" placeholder="00.00" class="form-control general_price_input_group price-input" step=".01">
          </div>

  
          <input type="hidden" name="transports[0][auto_vehicle_price]" class="auto_price">


          <div class="form-group col-md-2">
                   <label for="row_transports_0_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_transports_0_total_price" type="text"  placeholder="00.00" class="form-control general_price_input_group total-price" step=".01" readonly="">
          </div>

                    <div class="form-group col-md-2 required-field">
                   <label for="row_transports_0_cost">{{__('ERP::attributes.order.cost')}}</label>
               <input id="row_transports_0_cost" type="number" name="transports[0][vehicle_cost]" placeholder="00.00" class="form-control general_price_input_group cost-input" step=".01">
          </div>

          <input type="hidden" name="transports[0][auto_vehicle_cost]" class="auto_cost">


          <div class="form-group col-md-2">
                   <label for="row_transports_0_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_transports_0_total_cost" type="text"  placeholder="00.00" class="form-control total-cost" step=".01" readonly="">
          </div>

                  <div class="form-group col-md-2">
            <label for="row_transports_0_driver_id">{{__('ERP::attributes.main.driver')}}</label>
               <select class="form-control drivers-list with-select2 " id="row_transports_0_driver_id" name="transports[0][driver_id]" >
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($drivers as $key => $value)

               <option value="{{$key}}">{{$value}}</option>
              @endforeach
            </select>
        </div>



     </div> {{-- end row --}}


      <div class="row">
                  <div class="form-group col-md-2 required-field">
            <label for="row_transports_0_leave_date">{{__('ERP::attributes.order.leave_date')}}</label>
              <input id="row_transports_0_leave_date" type="text" name="transports[0][leave_date]" class="form-control start-date-input datepicker" readonly="">
            </div>

         <div class="form-group col-md-2">
            <label for="row_transports_0_leave_time">{{__('ERP::attributes.order.leave_time')}}</label>
              <input id="row_transports_0_leave_time" type="text" name="transports[0][leave_time]" class="form-control timepicker" >
            </div>



            <div class="form-group col-md-2 required-field">
            <label for="row_transports_0_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_transports_0_value_currency_id" name="transports[0][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_transports_0_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_transports_0_value_currency_rate" type="number" name="transports[0][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="transports[0][old_currency_id]" class="orig-exchange-id" value="">

           <input type="hidden" name="transports[0][old_currency_rate]" class="orig-exchange-rate" value="" step=".000000001">

          <input type="hidden" name="transports[0][main_currency_rate]" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="transports[0][main_currency_id]" value="{{$main_currency->id}}" class="main-currency-id">

          <div class="form-group col-md-2">
            <label for="row_transports_0_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_transports_0_due_date" type="text" name="transports[0][due_date]" class="form-control datepicker">
            </div>
             <div class="form-group col-md-2">
                   <label for="row_transports_0_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_transports_0_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="transports[0][prepay_percent]">
        </div>


     </div> {{-- end row --}}

     <div class="row">

                   <div class="form-group col-md-2">
                   <label for="row_transports_0_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_transports_0_reg_code" type="text" name="transports[0][booking_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}">
          </div>

          <div class="form-group col-md-4">
                   <label for="row_transports_0_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_transports_0_notes" type="text" name="transports[0][order_notes]" class="form-control">
          </div>
     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
        <button type="button" class="btn btn-default get_general_auto_prices"  data-elem_type="transport"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="disabled-form-inputs disabled-row-btn active btn btn-danger" data-row_id="row_transports_0" ><i class="fa fa-times"></i></a>
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
                <button class="btn btn-info ladda-button new-general-row-btn" type="button" data-main_row_id="transports_orders" data-main_row_class="transport-row" data-main_row_prefix="row_transports_"><i class="fa fa-plus-circle"></i> {{__('ERP::attributes.main.add_new_row')}}</button>
        
    </center>
        
    </div>

</div>



