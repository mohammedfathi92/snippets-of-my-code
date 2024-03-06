<div dir="{{$page_locale_code == 'ar'?'rtl':'ltr'}}">
            <!-- Main content -->
    <div class="box box-widget" style="border-top: 5px solid #f9a81e;">
       <div class="box-header with-border" style="background-color: #f9f9f9; border-bottom: 1px solid #dadada;">
        <div class="show_header row">
        <div class="col-md-6">
          <div class="show_logo pull-left">
            <a href="{{ \Settings::get('public_site_url')}}" title="logo {{\Settings::get('public_site_name_'.\Language::getCode())}}">
            <img src="{{ \Settings::get('site_logo') }}" class="" style="max-height: 73px;"></a>

         </div>
        </div>

     <div class="col-md-6">
      <div class="show_contacts pull-right">
      <p><a href="{{ \Settings::get('public_site_url')}}" title="{{\Settings::get('public_site_name_'.\Language::getCode())}}"><strong><i class="fa fa-globe" style="color: #f9a81f;"></i> <span style="color: #18a8b6;">{{ \Settings::get('public_site_url')}}</span> </strong></a> </p> 
        <p><strong><i class="fa fa-envelope" style="color: #f9a81f;"></i> <span style="color: #18a8b6;">{{\Settings::get('public_site_email')}}</span> </strong></p> 
        <p><strong><i class="fa fa-phone-square" style="color: #f9a81f;"></i> <span style="color: #18a8b6;">{{\Settings::get('whatsapp_no')}}</span> </strong></p> 
        </div>
     </div>
   </div>
   
          
        <!-- /.col -->
      </div>

    <div class="{{-- box-footer --}}" style="padding: 50px;">
      <!-- info row -->
      <div class="row">
        <div class="col-md-12">
          <h4><strong>{{\Settings::get('voucher_intro_title_sugg_'.$page_locale_code)}}</strong></h4>
        </div>
      </div>
      <br>
      <div class="row invoice-info">
        <h4 style="color: #f9a81e;"><strong>{{__('ERP::attributes.vouchers.details',[],$page_locale_code)}}: </strong></h4>
        <div class="col-md-4">

            <strong>{{__('ERP::attributes.vouchers.name',[],$page_locale_code)}}: </strong><span>&nbsp;{{$order->customer?$order->customer->getTranslation('translated_name', $page_locale_code):''}}</span><br>
            <strong>{{__('ERP::attributes.vouchers.order_id',[],$page_locale_code)}}: </strong><span>&nbsp;{{$order->reg_code}}</span><br>
            <strong>{{__('ERP::attributes.vouchers.nationality',[],$page_locale_code)}}: </strong><span>&nbsp;{{$customerNationality}}</span><br>
            <strong>{{__('ERP::attributes.vouchers.destination',[],$page_locale_code)}}: </strong><span>&nbsp;{{$order->destination?$order->destination->getTranslation('name', $page_locale_code):''}}</span><br>
            <strong>{{__('ERP::attributes.vouchers.purpose',[],$page_locale_code)}}: </strong><span>&nbsp;{{$order->purpose?$order->purpose->getTranslation('name', $page_locale_code):''}}</span><br>
            <strong>{{__('ERP::attributes.vouchers.duration',[],$page_locale_code)}}: </strong><span>&nbsp;{{$order->duration}}&nbsp;<small>{{trans_choice('ERP::attributes.vouchers.nights_no', $order->duration,[],$page_locale_code)}}</small></span><br>
            <strong>{{__('ERP::attributes.vouchers.arrive_date',[],$page_locale_code)}}: </strong><span>&nbsp;{{$order->start_date}}</span><br>
            <strong>{{__('ERP::attributes.vouchers.return_date',[],$page_locale_code)}}: </strong><span>&nbsp;{{$order->end_date}}</span><br>
            <strong>{{__('ERP::attributes.vouchers.mobile',[],$page_locale_code)}}: </strong><span>&nbsp;{{$order->customer?$order->customer->primary_phone:''}}</span><br>
            <strong>{{__('ERP::attributes.vouchers.email',[],$page_locale_code)}}: </strong><span>&nbsp;{{$order->customer?$order->customer->email:''}}</span><br>


        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <br>
          <address style="margin: 10px">
            {!! \Settings::get('voucher_general_order_note_'.$page_locale_code) !!}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-md-4">
          <br>
            <h4><strong style="color: #f9a81e;">&#10004; {{__('ERP::attributes.vouchers.text_best_prices',[],$page_locale_code)}} </strong></h4>

        
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

<br>
<br>
          <div class="box box-default box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{__('ERP::attributes.vouchers.hotels_reservations',[],$page_locale_code)}}</h3>

{{--               <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> --}}
              <!-- /.box-tools -->

               <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
                    <div class="row">
        <div class="col-md-12">
                  <h4  style="color: #18a8b6; text-align: center;"><strong>&#10004; {!!__('ERP::attributes.vouchers.discount_with_value', ['value' => $order->hotels_discount],$page_locale_code) !!}</strong></h4>

        </div>
      </div>
      <br>
                    <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered table-striped table-orders">
            <thead>
            <tr>
              <th>-</th>
              <th>{{__('ERP::attributes.vouchers.cities_duration',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.checkin_checkout',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.accommodation_details',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.cost_details',[],$page_locale_code)}} <br><small>{{__('ERP::attributes.vouchers.price_no_nights',[],$page_locale_code)}}</small></th>
              <th>{{__('ERP::attributes.vouchers.reservation_code',[],$page_locale_code)}}</th>

            </tr>
            </thead>
            <tbody>
              @foreach($hotels as $row)
              @php
             // change from item currency to order main currency
              $order_currency_rate = $order->currency?$order->currency->exchange_rate:0;
              $item_currency_rate = $row->currency?$row->currency->exchange_rate:0;

              $total_with_discount = (((float)$row->room_price * (float)$row->rooms_num * (float)$row->nights) * (1 - ((float)$order->hotels_discount/100))) + ((float)$row->extra_bed_price * (float)$row->extra_beds * (float)$row->nights);

              $total_without_discount = (((float)$row->room_price * (float)$row->rooms_num * (float)$row->nights)) + ((float)$row->extra_bed_price * (float)$row->extra_beds * (float)$row->nights);


              if(floatval($order->hotels_discount) > 0){
                $total_row_amount =  $total_with_discount;
               }else{
                 $total_row_amount = $total_without_discount;

               }

              $modifiedRowAmount = amountCurrencyChange($total_row_amount, $item_currency_rate, $order_currency_rate);

              $hotels_costs[] = $modifiedRowAmount;
              @endphp
            <tr>
              <td>{{$loop->index + 1}}</td>
              <td class="table-content-center"><strong>{{$row->city?$row->city->getTranslation('name', $page_locale_code):''}}</strong><br>{{$row->nights}} &nbsp;<small>{{trans_choice('ERP::attributes.vouchers.nights_no', $row->nights,[],$page_locale_code)}}</small></td>
              <td class="table-content-center"><strong>{{__('ERP::attributes.vouchers.checkin_date',[],$page_locale_code)}}</strong><br>
                {{format_date($row->checkin, 'd/m/Y g:i A')}} <br>
                <strong>{{__('ERP::attributes.vouchers.checkout_date')}}</strong><br>
                {{format_date($row->checkout, 'd/m/Y g:i A')}} <br>
              </td>
              <td>
                <h5 style="color: #f9a81e;">{{$row->hotel?$row->hotel->getTranslation('name', $page_locale_code):''}}</h5>
                <strong>{{__('ERP::attributes.vouchers.level',[],$page_locale_code)}}:&nbsp;</strong>{{$row->hotel?$row->hotel->hotel_level:''}}&nbsp;{{__('ERP::attributes.vouchers.stars',[],$page_locale_code)}}<br>
                <strong>{{__('ERP::attributes.vouchers.the_category',[],$page_locale_code)}}:&nbsp;</strong>{{$row->room?$row->room->getTranslation('name', $page_locale_code):''}}<br>
                <strong>{{__('ERP::attributes.vouchers.category_no',[],$page_locale_code)}}:&nbsp;</strong>{{$row->rooms_num}}<br>
                <strong>{{__('ERP::attributes.vouchers.breakfast',[],$page_locale_code)}}:&nbsp;</strong>{{trans_choice('ERP::attributes.vouchers.bool_yes_no', $row->breakfast,[],$page_locale_code)}}<br>
                @if($order->status > 0)
                <strong>{{__('ERP::attributes.vouchers.reservation_id',[],$page_locale_code)}}:&nbsp;</strong>{{$row->reserve_code?:'#####'}}<br>
                @endif
                <strong>{{__('ERP::attributes.vouchers.hotel_phone',[],$page_locale_code)}}:&nbsp;</strong><a href="{{$row->hotel?$row->hotel->primary_phone:''}}">{{$row->hotel?$row->hotel->primary_phone:''}}</a><br>
               <p class="table-content-center">@if($row->hotel)<a target="_blank" href="{{$row->hotel_link?:\Settings::get('public_site_url')}}">{{__('ERP::attributes.vouchers.hotel_read_more',[],$page_locale_code)}}</a>@endif<strong></strong></p>
              </td>
              <td>

              @if(floatval($order->hotels_discount) > 0)  <small>{{-- {{__('ERP::attributes.vouchers.before_discount',[],$page_locale_code)}}:&nbsp; --}}<strike style="color: red;">{{amountCurrencyChange($row->room_price, $item_currency_rate, $order_currency_rate)}}{{-- &nbsp;{{$row->currency?$row->currency->code:''}} --}}</strike></small><br> @endif
             <span style="color: green;"> {{amountCurrencyChange((float)$row->room_price - ((float)$row->room_price * (float)$order->hotels_discount/100), $item_currency_rate, $order_currency_rate)}}</span> * <span>{{$row->rooms_num}}&nbsp;{{__('ERP::attributes.vouchers.category',[],$page_locale_code)}}</span> * <span>{{$row->nights}}&nbsp;{{trans_choice('ERP::attributes.vouchers.nights_no', $row->nights,[],$page_locale_code)}}</span><br>
           @if(floatval($row->extra_beds)>0) <span> {{amountCurrencyChange((float)$row->extra_bed_price, $item_currency_rate, $order_currency_rate)}}</span> * <span>{{$row->extra_beds}}&nbsp;{{trans_choice('ERP::attributes.vouchers.bed', (float)$row->extra_beds,[],$page_locale_code)}}</span> * <span>{{$row->nights}}&nbsp;{{trans_choice('ERP::attributes.vouchers.nights_no', $row->nights,[],$page_locale_code)}}</span><br>@endif
             <strong>{{__('ERP::attributes.vouchers.total_price',[],$page_locale_code)}}:</strong>&nbsp;<strong style="color: green;">{{$modifiedRowAmount}}&nbsp;{{$order_currency_name}}</strong><br>@if(floatval($order->hotels_discount) > 0) <span class="pull-right">{{__('ERP::attributes.vouchers.before_discount',[],$page_locale_code)}}:&nbsp;<strike>{{amountCurrencyChange($total_without_discount, $item_currency_rate, $order_currency_rate)}}&nbsp;{{$order_currency_name}}</strike></span>@endif
              </td>
                                <td class="table-content-center"><br>{{$row->booking_code}}</td>

            </tr>
            @endforeach


            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

            </div>
            <!-- /.box-body -->
          </div>
          
          <div class="voucher_hotel_notes row">
            <div class="col-md-12">
              <br>

              {!! \Settings::get('voucher_hotel_notes_'.$page_locale_code) !!}

              
            </div>
          </div>
           <br>

                    <div class="box box-default box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{__('ERP::attributes.vouchers.internal_flight_reservations',[],$page_locale_code)}}</h3>

{{--               <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> --}}
              <!-- /.box-tools -->

               <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
                    <div class="row">
{{--         <div class="col-md-12">
                  <h4  style="color: #18a8b6; text-align: center;"><strong>&#10004; {!!__('ERP::attributes.vouchers.discount_with_value', ['value' => $order->flights_discount],$page_locale_code) !!}</strong></h4>

        </div> --}}
      </div>
      <br>
                    <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered table-striped table-orders">
            <thead>
            <tr>
              <th>-</th>
              <th>{{__('ERP::attributes.vouchers.cities_arrive_leave',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.appointments',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.transporting_company',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.cost_details',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.reservation_code',[],$page_locale_code)}}</th>


            </tr>
            </thead>
            <tbody>
              @foreach($flights as $row)

             @php
             // change from item currency to order main currency
              $order_currency_rate = $order->currency?$order->currency->exchange_rate:0;
              $item_currency_rate = $row->currency?$row->currency->exchange_rate:0;
              $total_row_amount = ((float)$row->adult_numbers * (float)$row->adult_price) + ((float)$row->child_numbers * (float)$row->child_price) + ((float)$row->infant_numbers * (float)$row->infant_price) + ((float)$row->baggage_weight * (float)$row->baggage_price);

              $modifiedRowAmount = amountCurrencyChange($total_row_amount, $item_currency_rate, $order_currency_rate);

              $flights_costs[] = $modifiedRowAmount;
              @endphp

            <tr>
              <td>{{$loop->index + 1}}</td>
              <td class="table-content-center">{{$row->from_city?$row->from_city->getTranslation('name', $page_locale_code):''}}&nbsp; {{__('ERP::attributes.vouchers.to',[],$page_locale_code)}}&nbsp; {{$row->to_city?$row->to_city->getTranslation('name', $page_locale_code):''}}</td>
               <td class="table-content-center">
                {{format_date($row->leave_date, 'd/m/Y')}}
                <hr>
                <strong>{{__('ERP::attributes.vouchers.flight_take_off',[],$page_locale_code)}}:</strong>&nbsp;{{$row->leave_time}}<br>
                @if($row->arrive_time)
                <strong>{{__('ERP::attributes.vouchers.arrival',[],$page_locale_code)}}:</strong>&nbsp;{{$row->arrive_time}}<br>
                @endif

               </td>

                <td class="table-content-center">
                   {{$row->airline?$row->airline->getTranslation('name', $page_locale_code):''}}

                </td>
                 <td>
                  @if($row->adult_numbers)
                  {{$row->adult_numbers}}&nbsp;{{trans_choice('ERP::attributes.vouchers.adults', $row->adult_numbers,[],$page_locale_code)}}&nbsp;×&nbsp;{{amountCurrencyChange($row->adult_price, $item_currency_rate, $order_currency_rate)}}&nbsp;{{__('ERP::attributes.vouchers.per_one',[],$page_locale_code)}}<br>
                  @endif
                  @if($row->child_numbers)
                  {{$row->child_numbers}}&nbsp;{{trans_choice('ERP::attributes.vouchers.children', $row->child_numbers,[],$page_locale_code)}}&nbsp;×&nbsp;{{amountCurrencyChange($row->child_price, $item_currency_rate, $order_currency_rate)}}&nbsp;{{__('ERP::attributes.vouchers.per_one',[],$page_locale_code)}}<br>
                 @endif
                 @if($row->infant_numbers)
                  {{$row->infant_numbers}}&nbsp;{{trans_choice('ERP::attributes.vouchers.infants', $row->infant_numbers,[],$page_locale_code)}}&nbsp;×&nbsp;{{amountCurrencyChange($row->infant_price, $item_currency_rate, $order_currency_rate)}}&nbsp;{{__('ERP::attributes.vouchers.per_one',[],$page_locale_code)}}<br>
                  @endif
                  @if($row->baggage_weight)
                  {{$row->baggage_weight}}&nbsp;{{trans_choice('ERP::attributes.vouchers.kg', $row->baggage_weight,[],$page_locale_code)}}&nbsp;×&nbsp;{{amountCurrencyChange($row->baggage_price, $item_currency_rate, $order_currency_rate)}}&nbsp;{{__('ERP::attributes.vouchers.per_kg',[],$page_locale_code)}}<br>
                  @endif
                  <hr>

                  <strong>{{__('ERP::attributes.vouchers.total_price',[],$page_locale_code)}}:</strong>&nbsp;{{$modifiedRowAmount}}&nbsp;{{$order_currency_name}}
                 </td>
                  <td class="table-content-center"><br>{{$row->booking_code}}</td>


            </tr>
            @endforeach



            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

            </div>
            <!-- /.box-body -->

          </div>

         <div class="voucher_flights_notes row" >
            <div class="col-md-12">
              <br>

              {!! \Settings::get('voucher_flights_notes_'.$page_locale_code) !!}

              
            </div>
          </div>
           <br>



       <div class="box box-default box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{__('ERP::attributes.vouchers.internal_transportations_reservations',[],$page_locale_code)}}</h3>

{{--               <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> --}}
              <!-- /.box-tools -->

               <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
                    <div class="row">
{{--         <div class="col-md-12">
                  <h4  style="color: #18a8b6; text-align: center;"><strong>&#10004; {!!__('ERP::attributes.vouchers.discount_with_value', ['value' => $order->flights_discount],$page_locale_code) !!}</strong></h4>

        </div> --}}
      </div>
      <br>
                    <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered table-striped table-orders">
            <thead>
            <tr>
              <th>-</th>
              <th>{{__('ERP::attributes.vouchers.transport_type',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.cities_arrive_leave',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.appointments',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.transporting_company',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.cost_details',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.reservation_code',[],$page_locale_code)}}</th>


            </tr>
            </thead>
            <tbody>
            @foreach($arr_ferries_buses as $item)
          @php
          if($item['transport_type'] == 'ferry'){
            $row = $ferries->where('id', $item['id'])->first();
          }else{
            $row = $buses->where('id', $item['id'])->first();

          }
          @endphp

          @php
             // change from item currency to order main currency
              $order_currency_rate = $order->currency?$order->currency->exchange_rate:0;
              $item_currency_rate = $row->currency?$row->currency->exchange_rate:0;
              $total_row_amount = ((float)$row->adult_numbers * (float)$row->adult_price) + ((float)$row->child_numbers * (float)$row->child_price) + ((float)$row->infant_numbers * (float)$row->infant_price) + ((float)$row->baggage_weight * (float)$row->baggage_price);

              $modifiedRowAmount = amountCurrencyChange($total_row_amount, $item_currency_rate, $order_currency_rate);

              $ferries_buses_costs[] = $modifiedRowAmount;
           @endphp
            <tr>
              <td>{{$loop->index + 1}}</td>
              <td class="table-content-center">{{__('ERP::attributes.vouchers.'.$row->transport_type,[],$page_locale_code)}}</td>
              <td class="table-content-center">{{$row->from_city?$row->from_city->getTranslation('name', $page_locale_code):''}}&nbsp; {{__('ERP::attributes.vouchers.to',[],$page_locale_code)}}&nbsp; {{$row->to_city?$row->to_city->getTranslation('name', $page_locale_code):''}}</td>
               <td class="table-content-center">
                {{format_date($row->leave_date, 'd/m/Y')}}
                <hr>
                <strong>{{__('ERP::attributes.vouchers.departure',[],$page_locale_code)}}:</strong>&nbsp;{{$row->leave_time}}<br>
                @if($row->arrive_time)
                <strong>{{__('ERP::attributes.vouchers.arrival',[],$page_locale_code)}}:</strong>&nbsp;{{$row->arrive_time}}<br>
                @endif

               </td>

                <td class="table-content-center">
                   {{$row->provider?$row->provider->getTranslation('translated_name', $page_locale_code):''}}

                </td>
                 <td>
                  @if($row->adult_numbers)
                  {{$row->adult_numbers}}&nbsp;{{trans_choice('ERP::attributes.vouchers.adults', $row->adult_numbers,[],$page_locale_code)}}&nbsp;×&nbsp;{{amountCurrencyChange($row->adult_price, $item_currency_rate, $order_currency_rate)}}&nbsp;{{__('ERP::attributes.vouchers.per_one',[],$page_locale_code)}}<br>
                  @endif
                  @if($row->child_numbers)
                  {{$row->child_numbers}}&nbsp;{{trans_choice('ERP::attributes.vouchers.children', $row->child_numbers,[],$page_locale_code)}}&nbsp;×&nbsp;{{amountCurrencyChange($row->child_price, $item_currency_rate, $order_currency_rate)}}&nbsp;{{__('ERP::attributes.vouchers.per_one',[],$page_locale_code)}}<br>
                 @endif
                 @if($row->infant_numbers)
                  {{$row->infant_numbers}}&nbsp;{{trans_choice('ERP::attributes.vouchers.infants', $row->infant_numbers,[],$page_locale_code)}}&nbsp;×&nbsp;{{amountCurrencyChange($row->infant_price, $item_currency_rate, $order_currency_rate)}}&nbsp;{{__('ERP::attributes.vouchers.per_one',[],$page_locale_code)}}<br>
                  @endif
                  @if($row->baggage_weight)
                  {{$row->baggage_weight}}&nbsp;{{trans_choice('ERP::attributes.vouchers.kg', $row->baggage_weight,[],$page_locale_code)}}&nbsp;×&nbsp;{{amountCurrencyChange($row->baggage_price, $item_currency_rate, $order_currency_rate)}}&nbsp;{{__('ERP::attributes.vouchers.per_kg',[],$page_locale_code)}}<br>
                  @endif
                  <hr>
                  <strong>{{__('ERP::attributes.vouchers.total_price',[],$page_locale_code)}}:</strong>&nbsp;{{$modifiedRowAmount}}&nbsp;{{$order_currency_name}}
                 </td>
                  <td class="table-content-center"><br>{{$row->booking_code}}</td>


            </tr>
            @endforeach



            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

            </div>
            <!-- /.box-body -->

          </div>

           <div class="voucher_internal_trans_notes row">
            <div class="col-md-12">
              <br>

              {!! \Settings::get('voucher_internal_trans_notes_'.$page_locale_code) !!}

              
            </div>
          </div>
           <br>


          <div class="box box-default box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{__('ERP::attributes.vouchers.transports_tours_reservations',[],$page_locale_code)}}</h3>

{{--               <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> --}}
              <!-- /.box-tools -->

               <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
                    <div class="row">
{{--         <div class="col-md-12">
                  <h4  style="color: #18a8b6; text-align: center;"><strong>&#10004; {!!__('ERP::attributes.vouchers.discount_with_value', ['value' => $order->flights_discount],$page_locale_code) !!}</strong></h4>

        </div> --}}
      </div>
      <br>
                    <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered table-striped table-orders">
            <thead>
            <tr>
              <th>-</th>
              <th>{{__('ERP::attributes.vouchers.days',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.the_cities',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.move_from',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.go_to',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.appointments',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.car_size',[],$page_locale_code)}}<br>{{__('ERP::attributes.vouchers.the_time',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.cost_details',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.reservation_code',[],$page_locale_code)}}</th>



            </tr>
            </thead>
            <tbody>
            @foreach($transports as $row)

          @php
             // change from item currency to order main currency
              $order_currency_rate = $order->currency?$order->currency->exchange_rate:0;
              $item_currency_rate = $row->currency?$row->currency->exchange_rate:0;
              $total_row_amount = ((float)$row->vehicles_num * (float)$row->vehicle_price);

              $modifiedRowAmount = amountCurrencyChange($total_row_amount, $item_currency_rate, $order_currency_rate);

              $transports_costs[] = $modifiedRowAmount;
           @endphp

            <tr>
              <td>{{$loop->index + 1}}</td>
              <td class="table-content-center">{{__('ERP::attributes.vouchers.the_day',['word' =>__('ERP::attributes.order_numbers_word.'.$row->order_day,[],$page_locale_code)],$page_locale_code)}}</td>
              @if($row->from_city_id == $row->to_city_id)
              <td class="table-content-center">{{$row->from_city?$row->from_city->getTranslation('name', $page_locale_code):''}}</td>
              @else
              <td class="table-content-center">{{$row->from_city?$row->from_city->getTranslation('name', $page_locale_code):''}}&nbsp; {{__('ERP::attributes.vouchers.to',[],$page_locale_code)}}&nbsp; {{$row->to_city?$row->to_city->getTranslation('name', $page_locale_code):''}}</td>
               @endif

                <td class="table-content-center">

                   {{$row->sourcable?$row->sourcable->getTranslation('name', $page_locale_code):''}}

                </td>
                 <td class="table-content-center">
                   {{$row->targetable?$row->targetable->getTranslation('name', $page_locale_code):''}}
                 </td>
               <td class="table-content-center">
                {{format_date($row->leave_date, 'd/m/Y')}}
                <hr>
                <strong>{{__('ERP::attributes.vouchers.departure',[],$page_locale_code)}}:</strong>&nbsp;{{$row->leave_time}}<br>
                @if($row->arrive_time)
                <strong>{{__('ERP::attributes.vouchers.arrival',[],$page_locale_code)}}:</strong>&nbsp;{{$row->arrive_time}}<br>
                @endif

               </td>
               <td class="table-content-center">{{$row->vehicleType?$row->vehicleType->getTranslation('name', $page_locale_code):''}}<br> @if($row->hours_num >= 1){{$row->hours_num}}&nbsp;{{trans_choice('ERP::attributes.vouchers.hours_num_text', $row->hours_num,[],$page_locale_code)}}@else {{$row->hours_num * 100}}&nbsp;{{trans_choice('ERP::attributes.vouchers.minutes_num_text', ($row->hours_num * 100),[],$page_locale_code)}}@endif</td>
               <td><strong>{{__('ERP::attributes.vouchers.total_price',[],$page_locale_code)}}:</strong>&nbsp;{{$modifiedRowAmount}}&nbsp;{{$order_currency_name}}
                 </td>
                  <td class="table-content-center"><br>{{$row->booking_code}}</td>

            </tr>
            @endforeach



            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

            </div>
            <!-- /.box-body -->

          </div>     {{-- end transports  --}}  

                     <div class="voucher_transports_notes row">
            <div class="col-md-12">
              <br>

              {!! \Settings::get('voucher_transports_notes_'.$page_locale_code) !!}

              
            </div>
          </div>
           <br>



                    <div class="box box-default box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{__('ERP::attributes.vouchers.extra_activities_reservations',[],$page_locale_code)}}</h3>

{{--               <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> --}}
              <!-- /.box-tools -->

               <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
                    <div class="row">
{{--         <div class="col-md-12">
                  <h4  style="color: #18a8b6; text-align: center;"><strong>&#10004; {!!__('ERP::attributes.vouchers.discount_with_value', ['value' => $order->flights_discount],$page_locale_code) !!}</strong></h4>

        </div> --}}
      </div>
      <br>

                    <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered table-striped table-orders">
            <thead>
            <tr>
              <th>-</th>
              <th>{{__('ERP::attributes.vouchers.the_city',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.the_activity',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.appointments',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.cost_details',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.reservation_code',[],$page_locale_code)}}</th>


            </tr>
            </thead>
            <tbody>
              @foreach($activities as $row)
            @php
             // change from item currency to order main currency
              $order_currency_rate = $order->currency?$order->currency->exchange_rate:0;
              $item_currency_rate = $row->currency?$row->currency->exchange_rate:0;
              $total_row_amount = ((float)$row->adult_numbers * (float)$row->adult_price) + ((float)$row->child_numbers * (float)$row->child_price) + ((float)$row->infant_numbers * (float)$row->infant_price);

              $modifiedRowAmount = amountCurrencyChange($total_row_amount, $item_currency_rate, $order_currency_rate);

              $activities_costs[] = $modifiedRowAmount;
           @endphp
            <tr>
              <td>{{$loop->index + 1}}</td>
              <td class="table-content-center"><strong>{{$row->city?$row->city->getTranslation('name', $page_locale_code):''}}</strong><br>{{$row->country?$row->country->getTranslation('name', $page_locale_code):''}}</td>
                              <td class="table-content-center">
                   {{$row->activity?$row->activity->getTranslation('name', $page_locale_code):''}}

                </td>
               <td class="table-content-center">
                {{format_date($row->start_date, 'd/m/Y')}}
                <hr>
                <strong>{{__('ERP::attributes.vouchers.start_time',[],$page_locale_code)}}:</strong>&nbsp;{{$row->start_time}}<br>
                @if($row->end_time)
                <strong>{{__('ERP::attributes.vouchers.end_time',[],$page_locale_code)}}:</strong>&nbsp;{{$row->end_time}}<br>
                @endif

               </td>

                 <td>
                  @if($row->adult_numbers)
                  {{$row->adult_numbers}}&nbsp;{{trans_choice('ERP::attributes.vouchers.adults', $row->adult_numbers,[],$page_locale_code)}}&nbsp;×&nbsp;{{amountCurrencyChange($row->adult_price, $item_currency_rate, $order_currency_rate)}}&nbsp;{{__('ERP::attributes.vouchers.per_one',[],$page_locale_code)}}<br>
                  @endif
                  @if($row->child_numbers)
                  {{$row->child_numbers}}&nbsp;{{trans_choice('ERP::attributes.vouchers.children', $row->child_numbers,[],$page_locale_code)}}&nbsp;×&nbsp;{{amountCurrencyChange($row->child_price, $item_currency_rate, $order_currency_rate)}}&nbsp;{{__('ERP::attributes.vouchers.per_one',[],$page_locale_code)}}<br>
                 @endif
                 @if($row->infant_numbers)
                  {{$row->infant_numbers}}&nbsp;{{trans_choice('ERP::attributes.vouchers.infants', $row->infant_numbers,[],$page_locale_code)}}&nbsp;×&nbsp;{{amountCurrencyChange($row->infant_price, $item_currency_rate, $order_currency_rate)}}&nbsp;{{__('ERP::attributes.vouchers.per_one',[],$page_locale_code)}}<br>
                  @endif
                  <hr>
                  <strong>{{__('ERP::attributes.vouchers.total_price',[],$page_locale_code)}}:</strong>&nbsp;{{$modifiedRowAmount}}&nbsp;{{$order_currency_name}}
                 </td>
                  <td class="table-content-center"><br>{{$row->booking_code}}</td>


            </tr>
            @endforeach



            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

            </div>
            <!-- /.box-body -->

          </div> {{-- end activities --}}

          <div class="voucher_activities_notes row">
            <div class="col-md-12">
              <br>

              {!! \Settings::get('voucher_activities_notes_'.$page_locale_code) !!}

              
            </div>
          </div>
           <br>


          <div class="box box-default box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">{{__('ERP::attributes.vouchers.extra_services_reservations',[],$page_locale_code)}}</h3>

{{--               <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div> --}}
              <!-- /.box-tools -->

               <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="">
                    <div class="row">
{{--         <div class="col-md-12">
                  <h4  style="color: #18a8b6; text-align: center;"><strong>&#10004; {!!__('ERP::attributes.vouchers.discount_with_value', ['value' => $order->flights_discount],$page_locale_code) !!}</strong></h4>

        </div> --}}
      </div>
      <br>
                    <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-bordered table-striped table-orders">
            <thead>
            <tr>
              <th>-</th>
              <th>{{__('ERP::attributes.vouchers.the_city',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.the_service',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.appointments',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.cost_details',[],$page_locale_code)}}</th>
              <th>{{__('ERP::attributes.vouchers.reservation_code',[],$page_locale_code)}}</th>


            </tr>
            </thead>
            <tbody>
              @foreach($services as $row)
          @php
             // change from item currency to order main currency
              $order_currency_rate = $order->currency?$order->currency->exchange_rate:0;
              $item_currency_rate = $row->currency?$row->currency->exchange_rate:0;
              $total_row_amount = ((float)$row->quantity * (float)$row->price);

              $modifiedRowAmount = amountCurrencyChange($total_row_amount, $item_currency_rate, $order_currency_rate);

              $services_costs[] = $modifiedRowAmount;
           @endphp
            <tr>
              <td>{{$loop->index + 1}}</td>
              <td class="table-content-center"><strong>{{$row->city?$row->city->getTranslation('name', $page_locale_code):''}}</strong><br>{{$row->country?$row->country->getTranslation('name', $page_locale_code):''}}</td>
                              <td class="table-content-center">
                   {{$row->service?$row->service->getTranslation('name', $page_locale_code):''}}

                </td>
               <td class="table-content-center">
                {{format_date($row->start_date, 'd/m/Y')}}
                <hr>
                <strong>{{__('ERP::attributes.vouchers.start_time',[],$page_locale_code)}}:</strong>&nbsp;{{$row->start_time}}<br>
                @if($row->end_time)
                <strong>{{__('ERP::attributes.vouchers.end_time',[],$page_locale_code)}}:</strong>&nbsp;{{$row->end_time}}<br>
                @endif

               </td>

                 <td class="table-content-center">

                  <strong>{{__('ERP::attributes.vouchers.total_price',[],$page_locale_code)}}:</strong>&nbsp;{{$modifiedRowAmount}}&nbsp;{{$order_currency_name}}
                 </td>
                  <td class="table-content-center"><br>{{$row->booking_code}}</td>


            </tr>
            @endforeach



            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

            </div>
            <!-- /.box-body -->

          </div> {{-- end services --}}

          <div class="voucher_services_notes row">
            <div class="col-md-12">
              <br>

              {!! \Settings::get('voucher_services_notes_'.$page_locale_code) !!}

              
            </div>
          </div>
           <hr>


      <div class="row">
        <!-- accepted payments column -->
        <div class="col-md-6 col-xs-12">
{{--           <p class="lead">Payment Methods:</p>
          <img src="/assets/themes/admin/img/credit/visa.png" alt="Visa">
          <img src="/assets/themes/admin/img/credit/mastercard.png" alt="Mastercard">
          <img src="/assets/themes/admin/img/credit/american-express.png" alt="American Express">
          <img src="/assets/themes/admin/img/credit/paypal2.png" alt="Paypal"> --}}
          <div class="voucher_general_notes">
             {!! \Settings::get('voucher_general_notes_'.$page_locale_code) !!}
          </div>
           <div class="voucher_require_orders text-muted well well-sm no-shadow">
             {!! \Settings::get('voucher_require_orders_'.$page_locale_code) !!}
          
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-xs-12">
          <h4>{{__('ERP::attributes.vouchers.reservation_total_amount',[],$page_locale_code)}}</h4>

          @php

          @endphp
<hr>
          <div class="table-responsive">
            <table class="text-align-{{$page_locale_code}} table">
              @if($hotels)
              <tr>
                <th>{{__('ERP::attributes.vouchers.hotels_total_cost',[],$page_locale_code)}}</th>
                <td><span><strong>{{(float)array_sum($hotels_costs)}}</strong> &nbsp;{{$order_currency_name}}</span></td>
              </tr>
             @endif
                           @if($flights)
              <tr>
                <th >{{__('ERP::attributes.vouchers.flights_total_cost',[],$page_locale_code)}}</th>
                <td><span><strong>{{(float)array_sum($flights_costs)}}</strong> &nbsp;{{$order_currency_name}}</span></td>
              </tr>
             @endif
 
                           @if(!empty($arr_ferries_buses))
              <tr>
                <th >{{__('ERP::attributes.vouchers.pub_trans_total_cost',[],$page_locale_code)}}</th>
                <td><span><strong>{{(float)array_sum($ferries_buses_costs)}}</strong> &nbsp;{{$order_currency_name}}</span></td>
              </tr>
             @endif


                           @if($transports)
              <tr>
                <th >{{__('ERP::attributes.vouchers.trans_tours_total_cost',[],$page_locale_code)}}</th>
                <td><span><strong>{{(float)array_sum($transports_costs)}}</strong> &nbsp;{{$order_currency_name}}</span></td>
              </tr>
             @endif
                                       @if($activities)
              <tr>
                <th >{{__('ERP::attributes.vouchers.activities_total_cost',[],$page_locale_code)}}</th>
                <td><span><strong>{{(float)array_sum($activities_costs)}}</strong> &nbsp;{{$order_currency_name}}</span></td>
              </tr>
             @endif
                           @if($services)
              <tr>
                <th >{{__('ERP::attributes.vouchers.services_total_cost',[],$page_locale_code)}}</th>
                <td><span><strong>{{(float)array_sum($services_costs)}}</strong> &nbsp;{{$order_currency_name}}</span></td>
              </tr>
             @endif

              <tr style="background-color: #ddd;">
                <th >{{__('ERP::attributes.vouchers.total_cost',[],$page_locale_code)}}</th>
                <td><span><strong>{{(float)array_sum($services_costs) + (float)array_sum($hotels_costs) + (float)array_sum($flights_costs) + (float)array_sum($ferries_buses_costs) + (float)array_sum($transports_costs) + (float)array_sum($activities_costs) + (float)array_sum($services_costs)}}</strong> &nbsp;{{$order_currency_name}}</span></td>
              </tr>
             
            </table>
          </div>
    
          <div class="voucher_prepayment_notes">   
          @php
          if(\Settings::get('voucher_prepayment_notes_'.$page_locale_code)){
            $prepayment_text = str_replace('#code_prepay_cost', $order->prepay_percent, \Settings::get('voucher_prepayment_notes_'.$page_locale_code));
          }
          
          @endphp         
            {!! $prepayment_text !!}
            </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- this row will not appear when printing -->
{{--       <div class="row no-print">
        <div class="col-xs-12">
          <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
          <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment
          </button>
          <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
            <i class="fa fa-download"></i> Generate PDF
          </button>
        </div>
      </div> --}}
    </div> {{-- body --}}
    </div>

    <!-- /.content -->
</div> {{-- end dir --}} 