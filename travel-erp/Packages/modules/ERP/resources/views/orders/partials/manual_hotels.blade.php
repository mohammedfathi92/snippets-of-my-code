
<div id="manualhotels_orders">

<div id="row_manualhotels_0" class="manualhotel-row hotel-row order-hotels" style="background-color: #eff0f1; padding: 10px;" data-index="0">
   <div class="alert alert-danger" style="display: none;" id="alert_row_manualhotels_0">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>
<div class="row">
         
                     <div class="form-group col-md-2 day-row required-field">
                   <label for="row_manualhotels_0_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control hotel-day order-days" name="manual_hotels[0][order_day]">
                <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
                <option value="1">1</option>
              </select>
               <input type="hidden" class="hidden_day_val" value="1">
          </div>

        <div class="form-group col-md-2">
            <label for="row_manualhotels_0_provider">{{__('ERP::attributes.users.provider')}}</label>
               <select class="form-control with-select2" id="row_manualhotels_0_provider" name="manual_hotels[0][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
            </div>



           <div class="form-group col-md-2 required-field">
            <label for="row_manualhotels_0_country">{{__('ERP::attributes.main.country')}}</label>
               <select class="form-control countries-list with-select2 get_geo_lists with-dest-country price_input_group" id="row_manualhotels_0_country" name="manual_hotels[0][country_id]" data-list_type= 'cities' data-other_select_id= 'row_manualhotels_0_city' data-select2_class= 'with-select2'  data-closest_class ='hotel-row' data-item_type='countries' data-currency_div_id="row_manualhotels_0_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}">{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

             <div class="form-group col-md-2 required-field">
              
            <label for="row_manualhotels_0_city">{{__('ERP::attributes.main.city')}}</label>
               <select class="form-control with-select2 cities-list get_geo_lists with-dest-city" id="row_manualhotels_0_city" name="manual_hotels[0][city_id]" data-list_type= 'hotels' data-other_select_id= 'row_manualhotels_0_manualhotel' data-select2_class= 'with-select2'  data-closest_class ='hotel-row' data-item_type='cities'>
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
            </select>
          
        </div>

        @foreach (\Language::allowed() as $code => $name) 

        <div class="form-group col-md-2 required-field">
                   <label for="row_manualhotels_0_hotel_name_{{$code}}">{{__('ERP::attributes.order.hotel_name').' ( '.$code.' )'}}</label>
               <input id="row_manualhotels_0_hotel_name_{{$code}}" type="text" name="manual_hotels[0][hotel_name][{{$code}}]"  class="form-control" placeholder="{{'( '.$name.' )'}}">
          </div>

           @endforeach

           </div> {{-- end row --}}

           <div class="row">

        @foreach (\Language::allowed() as $code => $name) 

        <div class="form-group col-md-2 required-field">
                   <label for="row_manualhotels_0_room_name_{{$code}}">{{__('ERP::attributes.order.room_name').' ( '.$code.' )'}}</label>
               <input id="row_manualhotels_0_room_name_{{$code}}" type="text" name="manual_hotels[0][room_name][{{$code}}]"  class="form-control" placeholder="{{'( '.$name.' )'}}">
          </div>

           @endforeach

         <div class="form-group col-md-2 required-field">
            <label for="row_manualhotels_0_room_type">{{__('ERP::attributes.order.room_type')}}</label>
               <select class="form-control with-select2" id="row_manualhotels_0_room_type" name="manual_hotels[0][category_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($roomsTypes as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
              @endforeach
              
            </select>
            </div>



         <div class="form-group col-md-2 required-field">
            <label for="row_manualhotels_0_checkin">{{__('ERP::attributes.order.checkin')}}</label>
              <input id="row_manualhotels_0_checkin" type="text" name="manual_hotels[0][checkin]" class="form-control checkin-input datepicker" readonly="true">
            </div>
         
            <div class="form-group col-md-2 required-field">
                   <label for="row_manualhotels_0_nights">{{__('ERP::attributes.order.order_nights')}}</label>
               <input id="row_manualhotels_0_nights" type="number" name="manual_hotels[0][nights]" placeholder="1" class="form-control nights-num price_input_group" value="1" min="1">
          </div>

         <div class="form-group col-md-2 required-field">
            <label for="row_manualhotels_0_checkout">{{__('ERP::attributes.order.checkout')}}</label>
              <input id="row_manualhotels_0_checkout" type="text" name="manual_hotels[0][checkout]" class="form-control checkout-input datepicker price_input_group">
         </div>

           </div> {{-- end row --}}

       <div class="row">

            <div class="form-group col-md-2 required-field">
                   <label for="row_manualhotels_0_room_price_night">{{__('ERP::attributes.order.room_price_night')}}</label>
               <input id="row_manualhotels_0_room_price" type="number" name="manual_hotels[0][room_price]" placeholder="00.00" class="form-control price_input_group room-price" step=".01">
          </div>

          <input type="hidden" class="auto_room_price">

          <div class="form-group col-md-2 required-field">
              <label for="row_manualhotels_0_room_cost_night">{{__('ERP::attributes.order.room_cost_night')}}</label>
               <input id="row_manualhotels_0_room_cost" type="number" name="manual_hotels[0][room_cost]" placeholder="00.00" class="form-control price_input_group room-cost" step=".01">
          </div>

          <input type="hidden" class="auto_room_cost">
         

         <div class="form-group col-md-2 required-field">
            <label for="row_manualhotels_0_rooms_num">{{__('ERP::attributes.order.rooms_num')}}</label>
            <input id="row_manualhotels_0_rooms_num" type="number" name="manual_hotels[0][rooms_num]" placeholder="1" class="form-control price_input_group rooms-number">
              
        </div>


         <div class="form-group col-md-2">
            <label for="row_manualhotels_0_extra_beds">{{__('ERP::attributes.order.extra_beds')}}</label>
            <input id="row_manualhotels_0_extra_beds" type="number" name="manual_hotels[0][extra_beds]" placeholder="1" class="form-control extra-beds price_input_group">
              
        </div>


                  <div class="form-group col-md-2 ">
                   <label for="row_manualhotels_0_extra_bed_price">{{__('ERP::attributes.order.extra_bed_price')}}</label>
               <input id="row_manualhotels_0_extra_bed_price" type="number" name="manual_hotels[0][extra_bed_price]" placeholder="00.00" class="form-control price_input_group extra-bed-price" step=".01">
          </div>

          <input type="hidden"  class="auto_extra_bed_price">

        <div class="form-group col-md-2">
                   <label for="row_manualhotels_0_total_extra_beds_prices">{{__('ERP::attributes.order.total_extra_beds_prices')}}</label>
               <input id="row_manualhotels_0_total_extra_beds_prices" type="number" placeholder="00.00" class="form-control price_input_group total-extra-beds-prices" step=".01" readonly="true">
        </div> 

     </div> {{-- end row --}}


      <div class="row">

         <div class="form-group col-md-2">
              <label for="row_manualhotels_0_extra_bed_cost">{{__('ERP::attributes.order.extra_bed_cost')}}</label>
               <input id="row_manualhotels_0_extra_bed_cost" type="number" name="manualhotels[0][extra_bed_cost]" placeholder="00.00" class="form-control price_input_group extra-bed-cost" step=".01">
          </div>

          <input type="hidden"  class="auto_extra_bed_cost">




                  <div class="form-group col-md-2">
            <label for="row_manualhotels_0_total_extra_beds_costs">{{__('ERP::attributes.order.total_extra_beds_costs')}}</label>
               <input id="row_manualhotels_0_total_extra_beds_costs" type="number" placeholder="00.00" class="form-control price_input_group total-extra-beds-costs" step=".01" readonly="true">
        </div>




          <div class="form-group col-md-2 required-field">
            <label for="row_manualhotels_0_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_manualhotels_0_value_currency_id" name="manual_hotels[0][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              

              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2 required-field">
                   <label for="row_manualhotels_0_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_manualhotels_0_value_currency_rate" type="number" name="manual_hotels[0][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="manual_hotels[0][old_currency_id]" class="orig-exchange-id" value="">

           <input type="hidden" name="manual_hotels[0][old_currency_rate]" class="orig-exchange-rate" value="" step=".000000001">

          <input type="hidden" name="manual_hotels[0][main_currency_rate]" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="manual_hotels[0][main_currency_id]" value="{{$main_currency->id}}" class="main-currency-id">

          <div class="form-group col-md-2">
                   <label for="row_manualhotels_0_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_manualhotels_0_total_price" type="text" placeholder="00.00" class="form-control hotel-total-price" step=".01" readonly="true">
        </div> 

              <div class="form-group col-md-2">
                   <label for="row_manualhotels_0_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_manualhotels_0_total_cost" type="text" placeholder="00.00" class="form-control hotel-total-cost" step=".01" readonly="true">
        </div>





     </div> {{-- end row --}}

     <div class="row">

                 <div class="form-group col-md-2">
           <label for="row_manualhotels_0_room_price_type">{{__('ERP::attributes.order.price_type')}}</label>
            <select class="form-control hotel_price_type" id="row_manualhotels_0_room_price_type" readonly="true">

              <option value="manual">{{trans('ERP::attributes.order.manual_or_auto.manual')}}</option>
            </select>
          <input type="hidden" name="manual_hotels[0][room_price_type]" value="manual">
        </div>

        <div class="form-group col-md-2">
            <label for="row_manualhotels_0_breakfast">{{__('ERP::attributes.hotel.breakfast')}}</label>
               <select class="form-control" id="row_manualhotels_0_breakfast" name="manual_hotels[0][breakfast]">

            @foreach([1 => 'Yes', 0 =>'No'] as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
            @endforeach
            </select>
        </div>

          <div class="form-group col-md-2">
            <label for="row_manualhotels_0_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_manualhotels_0_due_date" type="text" name="manual_hotels[0][due_date]" class="form-control datepicker">
            </div>

              <div class="form-group col-md-2">
                   <label for="row_manualhotels_0_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_manualhotels_0_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="manual_hotels[0][prepay_percent]">
        </div>

                   <div class="form-group col-md-2">
                   <label for="row_manualhotels_0_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_manualhotels_0_reg_code" type="text" name="manual_hotels[0][reg_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}">
          </div>

          <div class="form-group col-md-2">
                   <label for="row_manualhotels_0_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_manualhotels_0_notes" type="text" name="manual_hotels[0][order_notes]" class="form-control">
          </div>
     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
         {{-- <button class="btn btn-default get-auto-hotel-prices" type="button"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button> --}}
         <a href="javascript:;" class="disabled-form-inputs disabled-row-btn active btn btn-danger" data-row_id="row_manualhotels_0" ><i class="fa fa-times"></i></a>
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
                 <button class="btn btn-info ladda-button new-hotel-row-btn" type="button" data-main_row_id="manualhotels_orders" data-main_row_class="manualhotel-row" data-main_row_prefix="row_manualhotels_"><i class="fa fa-plus-circle"></i> {{__('ERP::attributes.main.add_new_row')}}</button>
        
    </center>
        
    </div>

</div>



