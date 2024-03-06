<div id="hotels_orders">
@foreach($orderHotelsList as $hotelOrder)

<div id="row_hotels_{{$loop->index}}" class="hotel-row" style="background-color: #eff0f1; padding: 10px;" data-index="{{$loop->index}}">
   <div class="alert alert-danger" style="display: none;" id="alert_row_hotels_{{$loop->index}}">
    {!!__('ERP::messages.orders.delete_section_alert')!!}
    
  </div>
<div class="row">

                 <input type="hidden" name="hotels[{{$loop->index}}][hotel_order_id]" value="{{$hotelOrder->hashed_id}}">

         
          <div class="form-group col-md-2 day-row required-field">
            <label for="row_hotels_{{$loop->index}}_day">{{__('ERP::attributes.order.order_day')}}</label>
              <select class="form-control hotel-day order-days" name="hotels[{{$loop->index}}][order_day]">
                @for($i=1; $i <= $order->duration; $i++)
                <option value="{{$i}}" @if($i == $hotelOrder->order_day) selected="true" @endif>{{$i}}</option>
                @endfor
              </select>
               <input type="hidden" class="hidden_day_val" value="{{$hotelOrder->order_day}}">
          </div>

        <div class="form-group col-md-2">
            <label for="row_hotels_{{$loop->index}}_provider">{{__('ERP::attributes.users.provider')}}</label>
            <select class="form-control with-select2" id="row_hotels_{{$loop->index}}_provider" name="hotels[{{$loop->index}}][provider_id]">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($providers as $key => $value)
              <option value="{{$key}}" @if($key == $hotelOrder->provider_id) selected="true" @endif>{{$value}}</option>
              @endforeach
              
            </select>
        </div>

           <div class="form-group col-md-2">
            <label for="row_hotels_{{$loop->index}}_country">{{__('ERP::attributes.main.country')}}</label>
               <select class="form-control countries-list with-select2 get_geo_lists with-dest-country" id="row_hotels_{{$loop->index}}_country" name="hotels[{{$loop->index}}][country_id]" data-list_type= 'cities' data-other_select_id= 'row_hotels_{{$loop->index}}_city' data-select2_class= 'with-select2'  data-closest_class ='hotel-row' data-item_type='countries' data-currency_div_id="row_hotels_{{$loop->index}}_value_currency_id" data-geo_child_class="geo_child">
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach($countries as $row)
               <option value="{{$row->id}}" data-currency="{{$row->currency_id}}" @if($row->id == $hotelOrder->country_id) selected="true" @endif>{{$row->name}}</option>
              @endforeach
              
            </select>
            </div>

             <div class="form-group col-md-2">
              
            <label for="row_hotels_{{$loop->index}}_city">{{__('ERP::attributes.main.city')}}</label>
               <select class="form-control with-select2 cities-list get_geo_lists with-dest-city" id="row_hotels_{{$loop->index}}_city" name="hotels[{{$loop->index}}][city_id]" data-list_type= 'hotels' data-other_select_id= 'row_hotels_{{$loop->index}}_hotel' data-select2_class= 'with-select2'  data-closest_class ='hotel-row' data-item_type='cities'>
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
              @foreach(\ERP::getCitiesListByCountry($hotelOrder->country_id) as $key => $value)
               <option value="{{$key}}"@if($key == $hotelOrder->city_id) selected="true" @endif>{{$value}}</option>
              @endforeach
            </select>
          
        </div>
  
             <div class="form-group col-md-2">
              <div id="hotels_list_div">
            <label for="row_hotels_{{$loop->index}}_hotel">{{__('ERP::attributes.main.hotel')}}</label>
               <select class="form-control with-select2 get_geo_lists geo_child hotel-input" id="row_hotels_{{$loop->index}}_hotel" name="hotels[{{$loop->index}}][hotel_id]" data-list_type= 'rooms' data-other_select_id= 'row_hotels_{{$loop->index}}_room' data-select2_class= 'with-select2'  data-closest_class ='hotel-row' data-item_type='hotels'>
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>

              @foreach(\ERP::getHotelsList($hotelOrder->city_id) as $key => $value)
               <option value="{{$key}}"@if($key == $hotelOrder->hotel_id) selected="true" @endif>{{$value}}</option>
              @endforeach
              
            </select>
          </div>
        </div>
  
         <div class="form-group col-md-2 required-field">
             
            <label for="row_hotels_{{$loop->index}}_room">{{__('ERP::attributes.hotel.room')}}</label>
               <select class="form-control with-select2 geo_child room-input" id="row_hotels_{{$loop->index}}_room" name="hotels[{{$loop->index}}][room_id]" data-item_type = 'rooms'>
              <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>

              @foreach(\ERP::getRoomsList($hotelOrder->hotel_id) as $key => $value)
               <option value="{{$key}}"@if($key == $hotelOrder->room_id) selected="true" @endif>{{$value}}</option>
              @endforeach
              
            </select>
         
         </div>

      
           </div> {{-- end row --}}

           <div class="row">


          <div class="form-group col-md-2 required-field">
                   <label for="row_hotels_{{$loop->index}}_room_price_night">{{__('ERP::attributes.order.room_price_night')}}</label>
               <input id="row_hotels_{{$loop->index}}_room_price" type="number" name="hotels[{{$loop->index}}][room_price]" placeholder="00.00" class="form-control price_input_group room-price" step=".01" value="{{$hotelOrder->room_price}}">
          </div>

         <input type="hidden" name="hotels[{{$loop->index}}][auto_room_price]" class="auto_room_price" value="{{$hotelOrder->auto_room_price}}">

          <div class="form-group col-md-2 required-field">
              <label for="row_hotels_{{$loop->index}}_room_cost_night">{{__('ERP::attributes.order.room_cost_night')}}</label>
               <input id="row_hotels_{{$loop->index}}_room_cost" type="number" name="hotels[{{$loop->index}}][room_cost]" placeholder="00.00" class="form-control price_input_group room-cost" step=".01" value="{{$hotelOrder->room_cost}}">
          </div>

          <input type="hidden" name="hotels[{{$loop->index}}][auto_room_cost]" class="auto_room_cost" value="{{$hotelOrder->auto_room_cost}}">
         

         <div class="form-group col-md-2 required-field">
            <label for="row_hotels_{{$loop->index}}_rooms_num">{{__('ERP::attributes.order.rooms_num')}}</label>
            <input id="row_hotels_{{$loop->index}}_rooms_num" type="number" name="hotels[{{$loop->index}}][rooms_num]" placeholder="1" class="form-control price_input_group rooms-number"  value="{{$hotelOrder->rooms_num}}">
              
        </div>

          <div class="form-group col-md-2 required-field">
            <label for="row_hotels_{{$loop->index}}_checkin">{{__('ERP::attributes.order.checkin')}}</label>
              <input id="row_hotels_{{$loop->index}}_checkin" type="text" name="hotels[{{$loop->index}}][checkin]" class="form-control checkin-input datepicker" readonly="true" value="{{$hotelOrder->checkin}}">
            </div>
         
            <div class="form-group col-md-2">
                   <label for="row_hotels_{{$loop->index}}_nights">{{__('ERP::attributes.order.order_nights')}}</label>
               <input id="row_hotels_{{$loop->index}}_nights" type="number" name="hotels[{{$loop->index}}][nights]" placeholder="1" class="form-control nights-num price_input_group"  min="1" value="{{$hotelOrder->nights}}">
          </div>

         <div class="form-group col-md-2">
            <label for="row_hotels_{{$loop->index}}_checkout">{{__('ERP::attributes.order.checkout')}}</label>
              <input id="row_hotels_{{$loop->index}}_checkout" type="text" name="hotels[{{$loop->index}}][checkout]" class="form-control checkout-input datepicker price_input_group" value="{{$hotelOrder->checkout}}">
            </div>

           </div> {{-- end row --}}

          <div class="row">



          <div class="form-group col-md-2 required-field">
            <label for="row_hotels_{{$loop->index}}_room_price_type">{{__('ERP::attributes.order.price_type')}}</label>
               <select class="form-control hotel_price_type" id="row_hotels_{{$loop->index}}_room_price_type" name="hotels[{{$loop->index}}][room_price_type]">

              @foreach(trans('ERP::attributes.order.manual_or_auto') as $key => $value)
              <option value="{{$key}}" @if($key == $hotelOrder->room_price_type) selected="" @endif>{{$value}}</option>
              @endforeach
            </select>
        </div>

        <div class="form-group col-md-2">
            <label for="row_hotels_{{$loop->index}}_extra_beds">{{__('ERP::attributes.order.extra_beds')}}</label>
            <input id="row_hotels_{{$loop->index}}_extra_beds" type="number" name="hotels[{{$loop->index}}][extra_beds]" placeholder="1" class="form-control extra-beds price_input_group" value="{{$hotelOrder->extra_beds}}">
              
        </div>

          <div class="form-group col-md-2">
                   <label for="row_hotels_{{$loop->index}}_extra_bed_price">{{__('ERP::attributes.order.extra_bed_price')}}</label>
               <input id="row_hotels_{{$loop->index}}_extra_bed_price" type="number" name="hotels[{{$loop->index}}][extra_bed_price]" placeholder="00.00" class="form-control price_input_group extra-bed-price" step=".01" value="{{$hotelOrder->extra_bed_price}}">
          </div>

              <input type="hidden" name="hotels[{{$loop->index}}][auto_extra_bed_price]" class="auto_extra_bed_price" value="{{$hotelOrder->auto_extra_bed_price}}">

        <div class="form-group col-md-2">
            <label for="row_hotels_{{$loop->index}}_total_extra_beds_prices">{{__('ERP::attributes.order.total_extra_beds_prices')}}</label>
               <input id="row_hotels_{{$loop->index}}_total_extra_beds_prices" type="number" placeholder="00.00" class="form-control total-extra-beds-prices" step=".01" readonly="true" value="{{$hotelOrder->extra_bed_price * $hotelOrder->extra_beds}}">
        </div> 


          <div class="form-group col-md-2">
              <label for="row_hotels_{{$loop->index}}_extra_bed_cost">{{__('ERP::attributes.order.extra_bed_cost')}}</label>
               <input id="row_hotels_{{$loop->index}}_extra_bed_cost" type="number" name="hotels[{{$loop->index}}][extra_bed_cost]" placeholder="00.00" class="form-control price_input_group extra-bed-cost" step=".01" value="{{$hotelOrder->extra_bed_cost}}">
          </div>

          <input type="hidden" name="hotels[{{$loop->index}}][auto_extra_bed_cost]" class="auto_extra_bed_cost" value="{{$hotelOrder->auto_extra_bed_cost}}">

          <div class="form-group col-md-2">
            <label for="row_hotels_{{$loop->index}}_total_extra_beds_costs">{{__('ERP::attributes.order.total_extra_beds_costs')}}</label>
               <input id="row_hotels_{{$loop->index}}_total_extra_beds_costs" type="number" placeholder="00.00" class="form-control price_input_group total-extra-beds-costs" step=".01" readonly="true" value="{{$hotelOrder->extra_bed_cost * $hotelOrder->extra_beds}}">
        </div>




     </div> {{-- end row --}}


      <div class="row">

          <div class="form-group col-md-2 required-field">
            <label for="row_hotels_{{$loop->index}}_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_hotels_{{$loop->index}}_value_currency_id" name="hotels[{{$loop->index}}][new_currency_id]">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach($currencies as $row)
              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}" @if($row->id == $hotelOrder->new_currency_id) selected="" @endif>{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-2">
                   <label for="row_hotels_{{$loop->index}}_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_hotels_{{$loop->index}}_value_currency_rate" type="number" name="hotels[{{$loop->index}}][new_currency_rate]" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001" value="{{$hotelOrder->new_currency_rate}}">
          </div>

           <input type="hidden" name="hotels[{{$loop->index}}][old_currency_id]" class="orig-exchange-id" value="{{$hotelOrder->old_currency_id}}">

           <input type="hidden" name="hotels[{{$loop->index}}][old_currency_rate]" class="orig-exchange-rate" value="{{$hotelOrder->old_currency_rate}}" step=".000000001">

          <input type="hidden" name="hotels[{{$loop->index}}][main_currency_rate]" value="{{$hotelOrder->main_currency_rate}}" class="main-currency-rate" step=".000000001">
          <input type="hidden" name="hotels[{{$loop->index}}][main_currency_id]" value="{{$hotelOrder->main_currency_id}}" class="main-currency-id">

        <div class="form-group col-md-2">
            <label for="row_hotels_{{$loop->index}}_breakfast">{{__('ERP::attributes.hotel.breakfast')}}</label>
            <select class="form-control" id="row_hotels_{{$loop->index}}_breakfast" name="hotels[{{$loop->index}}][breakfast]">

            @foreach([1 => 'Yes', 0 =>'No'] as $key => $value)
              <option value="{{$key}}" @if($key == $hotelOrder->breakfast) selected="" @endif>{{$value}}</option>
            @endforeach
            </select>
        </div>

          <div class="form-group col-md-2">
            <label for="row_hotels_{{$loop->index}}_due_date">{{__('ERP::attributes.order.due_date')}}</label>
              <input id="row_hotels_{{$loop->index}}_due_date" type="text" name="hotels[{{$loop->index}}][due_date]" class="form-control datepicker" value="{{$hotelOrder->due_date}}">
            </div>

          <div class="form-group col-md-2">
                   <label for="row_hotels_{{$loop->index}}_total_price">{{__('ERP::attributes.order.total_price')}}</label>
               <input id="row_hotels_{{$loop->index}}_total_price" type="text" placeholder="00.00" class="form-control hotel-total-price" step=".01" readonly="true" value="{{$hotelOrder->room_price * $hotelOrder->rooms_num}}">
        </div> 

      <div class="form-group col-md-2">
                   <label for="row_hotels_{{$loop->index}}_total_cost">{{__('ERP::attributes.order.total_cost')}}</label>
               <input id="row_hotels_{{$loop->index}}_total_cost" type="text" placeholder="00.00" class="form-control hotel-total-cost" step=".01" readonly="true" value="{{$hotelOrder->room_cost * $hotelOrder->rooms_num}}">
        </div> 


     </div> {{-- end row --}}
     <div class="row">
         <div class="form-group col-md-2">
                   <label for="row_hotels_{{$loop->index}}_prepay_percent">{{__('ERP::attributes.hotel.prepay_percent')}} (%)</label>
               <input id="row_hotels_{{$loop->index}}_prepay_percent" type="number" placeholder="00.00" class="form-control" step=".01" name="hotels[{{$loop->index}}][prepay_percent]" value="{{$hotelOrder->prepay_percent}}">
        </div>

          <div class="form-group col-md-2">
                   <label for="row_hotels_{{$loop->index}}_reg_code">{{__('ERP::attributes.main.reg_code')}}</label>
               <input id="row_hotels_{{$loop->index}}_reg_code" type="text" name="hotels[{{$loop->index}}][reg_code]" class="form-control" placeholder="{{__('ERP::attributes.main.reg_code')}}" value="{{$hotelOrder->reg_code}}">
          </div>

          <div class="form-group col-md-4">
                   <label for="row_hotels_{{$loop->index}}_notes">{{__('ERP::attributes.main.notes')}}</label>
               <input id="row_hotels_{{$loop->index}}_notes" type="text" name="hotels[{{$loop->index}}][order_notes]" class="form-control" value="{{$hotelOrder->order_notes}}">
          </div>
     </div> {{-- end row --}}

     <div class="row">
      <div class="col-md-12">
               <div class="pull-right">
         <button class="btn btn-default get-auto-hotel-prices" type="button"><i class="fa fa-calculator"></i>  {{__('ERP::attributes.order.get_auto_prices')}} </button>
         <a href="javascript:;" class="disabled-row-btn active btn btn-danger" data-row_id="row_hotels_{{$loop->index}}" ><i class="fa fa-times"></i></a>
         <span></span>
       </div>
      </div>

     </div>

       </div> 

<br>
  @endforeach
</div>

<div class="row">
    <div class="col-md-12">
            <center>
                 <button class="btn btn-info ladda-button new-hotel-row-btn" type="button" data-main_row_id="hotels_orders" data-main_row_class="hotel-row" data-main_row_prefix="row_hotels_"><i class="fa fa-plus-circle"></i> {{__('ERP::attributes.main.add_new_row')}}</button>
        
    </center>
        
    </div>

</div>



