@if($replacedDiv == 'hotels-table tr:last')
    
    <tr id="tr_{{$index}}" data-index="{{$index}}">
             <td>
                <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:'.$index.';" data-index="{{$index}}">
                        <i class="fa fa-remove"></i>
                </button>
            </td>
            <td>
                <input type="hidden" name="hotels["{{$index}}"][package_type]" value="package">
            </td>
             <td>
                <div class="form-group">

                {!! Form::select('hotels['.$index.'][country_id]', \ERP::getCountriesList(),null,[
                    'placeholder' => trans('ERP::attributes.hotel.country'),
                    'class' => 'form-control hotels_order_country_id',
                    'data-get-city'=>'true',
                    'data-get-tax'=>'true',
                    'data-get-index'=> $index,
                    'data-get-replacedDiv'=>'country_hotel_order'
                    ]) !!}
                </div>
                
             </td>
             
              <td>
                <div class="form-group" id="country_hotel_order_{{$index}}">
                    {!! Form::select('hotels['.$index.'][city_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control city_id',
                    'data-get-hotel'=>'true',
                    'data-get-index'=> $index,
                    'data-get-replacedDiv'=>'city_hotel_order'
                    ]) !!}
                </div>
             </td>
            
              <td>
                <div class="form-group" " id="city_hotel_order_{{$index}}">
                        {!! Form::select('hotels['.$index.'][hotel_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.hotel.hotel'),
                    'class' => 'form-control',
                    ]) !!}
                </div>
             </td>
            <td>
                <div class="form-group" id="hotel_hotel_order_{{$index}}">
                    {!! Form::select('hotels['.$index.'][room_id]',[],null,[
                        'placeholder' =>trans('ERP::attributes.hotel.room'),
                        'class' => 'form-control hotels_order_price_'.$index,
                    ]) !!}
                 </div>
             </td>
            <td>
                <div class="form-group">
                    {!! Form::select('hotels['.$index.'][room_type]',\ERP::getRoomTypesList(),null,[
                        'placeholder' =>trans('ERP::attributes.order.room_type'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>
            
            <td>
                <div class="form-group">
                    {!! Form::select('hotels['.$index.'][rooms_num]',
                        ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','12'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30',]
                        ,null,[
                        'placeholder' =>trans('ERP::attributes.hotel.rooms_num'),
                        'class' => 'form-control',
                        'id'    => 'hotels_rooms_numbers_'.$index,

                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::text('hotels['.$index.'][days_numbers]',null,[
                        'placeholder' =>trans('ERP::attributes.order.days_numbers'),
                        'class' => 'form-control',
                        'id'    => 'hotels_days_numbers_'.$index,
                    ]) !!}
                </div>
            </td>
            <td>
                <input type="hidden" name="hotels["{{$index}}"][price_type]" value="manual">
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('hotels['.$index.'][room_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.room_price'),
                        'class' => 'form-control hotels_room_price ',
                        'disabled',
                        'id'    =>  'hotel_room_price_'.$index,
                        'data-get-index' => $index,

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('hotels['.$index.'][actual_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.actual_price'),
                        'class' => 'form-control',
                        'disabled',
                        'id'    =>  'hotel_actual_price_'.$index,
                        'data-get-index' => $index,

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('hotels['.$index.'][final_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.final_price'),
                        'class' => 'form-control',
                        'disabled',
                        'id'    =>  'hotel_final_price_'.$index,
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group" id="hotels_tax_{{$index}}">
                    {!! Form::number('hotels['.$index.'][tax]',null,[
                        'placeholder' =>trans('ERP::attributes.main.tax'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('hotels['.$index.'][prepay_percent]',$hotels_percent,[
                        'placeholder' =>trans('ERP::attributes.hotel.prepay_percent'),
                        'class' => 'form-control ',
                        'id'    =>  'hotel_prepay_percent_'.$index,
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::select('hotels['.$index.'][agent_id]',\ERP::getAgentsList(),null,[
                        'placeholder' =>trans('ERP::attributes.order.agent_id'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::select('hotels['.$index.'][email]',['Yes'=>'Yes','No'=>'No'],null,[
                        'placeholder' =>trans('ERP::attributes.main.email'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::select('hotels['.$index.'][year_id]',\ERP::getYearsList(),null,[
                        'placeholder' =>trans('ERP::attributes.order.year_id'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

             <td>
                <div class="form-group">
                    {!! Form::select('hotels['.$index.'][breakfast]',['Yes'=>'Yes','No'=>'No'],null,[
                        'placeholder' =>trans('ERP::attributes.hotel.breakfast'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::text('hotels['.$index.'][notes]',null,[
                        'placeholder' =>trans('ERP::attributes.main.note'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

           
        </tr>



@endif



{{-- add row for flights order table --}}


@if($replacedDiv == 'flights-table tr:last')
    
    <tr id="tr_{{$index}}" data-index="{{$index}}">
             <td>
                <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;" data-index="{{$index}}">
                        <i class="fa fa-remove"></i>
                </button>
            </td>
            <td>
                <input type="hidden" name="flights["{{$index}}"][package_type]" value="package">
            </td>
             <td>
                <div class="form-group">
                    {!! Form::select('flights['.$index.'][type]',[
                        'flight' => trans('ERP::attributes.order.flight'),
                        'ferry' => trans('ERP::attributes.order.ferry'),
                    ],'flight',[
                        'placeholder' =>trans('ERP::attributes.main.type'),
                        'class' => 'form-control flights_order_price_'.$index,
                        'id'=>'transporter_type_'.$index ,
                         'onChange'=>'flight_toggle_hide('.$index.')'
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">

                    {!! Form::select('flights['.$index.'][airline_id]', \ERP::getAirlineList(),null,[
                     'placeholder' => trans('ERP::attributes.order.flight'),
                     'class' => 'form-control',
                     'id'  => 'type_airline_'.$index
                    ]) !!}

                    {!! Form::select('flights['.$index.'][ferry_id]', \ERP::getFerriesList(),null,[
                     'placeholder' => trans('ERP::attributes.order.ferry'),
                     'class' => 'form-control hidden',
                     'id'  => 'type_ferry_'.$index
                    ]) !!}
                </div>
                
             </td>
            <td>
                <div class="form-group">

                {!! Form::select('flights['.$index.'][from_country_id]', \ERP::getCountriesList(),null,[
                    'placeholder' => trans('ERP::attributes.hotel.country'),
                    'class' => 'form-control flights_order_country_id flights_order_price_'.$index,
                     'data-get-city'=>'true',
                     'data-get-tax'=>'true',
                     'data-get-index'=> $index,
                     'data-get-replacedDiv'=>'from_country_flight_order'
                    ]) !!}
                </div>
                
             </td>
              <td>
                <div class="form-group" id="from_country_flight_order_{{$index}}">
                    {!! Form::select('flights['.$index.'][from_city_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control flights_order_price_'.$index,
                    ]) !!}
                </div>
             </td>
             <td>
                <div class="form-group">

                {!! Form::select('flights['.$index.'][to_country_id]', \ERP::getCountriesList(),null,[
                    'placeholder' => trans('ERP::attributes.hotel.country'),
                    'class' => 'form-control country_id flights_order_price_'.$index,
                     'data-get-city'=>'true',
                     'data-get-index'=> $index,
                     'data-get-replacedDiv'=>'to_country_flight_order'
                    ]) !!}
                </div>
                
             </td>
              <td>
                <div class="form-group" id="to_country_flight_order_{{$index}}">
                    {!! Form::select('flights['.$index.'][to_city_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control  flights_order_price_'.$index,
                    ]) !!}
                </div>
             </td>

            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$index.'][adult_numbers]',0,[
                        'placeholder' =>trans('ERP::attributes.order.adult_numbers'),
                        'class' => 'form-control',
                        'id'    =>  'flights_adult_numbers_'.$index,

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$index.'][chlid_numbers]',0,[
                        'placeholder' =>trans('ERP::attributes.order.chlid_numbers'),
                        'class' => 'form-control',
                        'id'    =>  'flights_chlid_numbers_'.$index,

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$index.'][infant_numbers]',0,[
                        'placeholder' =>trans('ERP::attributes.order.infant_numbers'),
                        'class' => 'form-control',
                        'id'    =>  'flights_infant_numbers_'.$index,

                    ]) !!}
                </div>
            </td>
              <td>
                <input type="hidden" name="flights["{{$index}}"][price_type]" value="manual">
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$index.'][adult_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.adult_prices'),
                        'class' => 'form-control',
                        'id'    =>  'flights_adult_price_'.$index,

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$index.'][chlid_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.chlid_prices'),
                        'class' => 'form-control',
                        'id'    =>  'flights_chlid_price_'.$index,

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$index.'][infant_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.infant_prices'),
                        'class' => 'form-control',
                        'id'    =>  'flights_infant_price_'.$index,

                    ]) !!}
                </div>
            </td>

             <td>
                <div class="form-group">
                    {!! Form::number('flights['.$index.'][final_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.final_price'),
                        'class' => 'form-control flights_final_price',
                        'id'    =>  'flights_final_price_'.$index,
                        'data-get-index' => $index,

                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group" id="flights_tax_{{$index}}">
                    {!! Form::number('flights['.$index.'][tax]',null,[
                        'placeholder' =>trans('ERP::attributes.main.tax'),
                        'class' => 'form-control',
                        'id'    =>  'flight_tax_'.$index,
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$index.'][prepay_percent]',$flights_percent,[
                        'placeholder' =>trans('ERP::attributes.hotel.prepay_percent'),
                        'class' => 'form-control ',
                        'id'    =>  'flight_prepay_percent_'.$index,
                    ]) !!}
                </div>
            </td>


            <td>
                <div class="form-group">
                    {!! Form::select('flights['.$index.'][agent_id]',\ERP::getAgentsList(),null,[
                        'placeholder' =>trans('ERP::attributes.order.agent_id'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::text('flights['.$index.'][notes]',null,[
                        'placeholder' =>trans('ERP::attributes.main.note'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

           
        </tr>


@endif





{{-- add row for transports order table --}}


@if($replacedDiv == 'transports-table tr:last')
    
    <tr id="tr_{{$index}}" data-index="{{$index}}">
             <td>
                <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;" data-index="{{$index}}">
                        <i class="fa fa-remove"></i>
                </button>
            </td>
            <td>
                <input type="hidden" name="transports["{{$index}}"][package_type]" value="package">
            </td>
            <td>
                <div class="form-group">

                {!! Form::select('transports['.$index.'][country_id]', \ERP::getCountriesList(),null,[
                    'placeholder' => trans('ERP::attributes.hotel.country'),
                    'class' =>'form-control transport_country_id transports_order_price_'.$index,
                     'data-get-city'=>'true',
                     'data-get-driver'=>'true',
                     'data-get-tax'=>'true',
                     'data-get-index'=> $index,
                     'data-get-replacedDiv'=>'country_transport_order'
                    ]) !!}
                </div>
                
             </td>
              <td>
                <div class="form-group" id="td_from_city_{{$index}}">
                    {!! Form::select('transports['.$index.'][from_city_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control transports_order_price_'.$index,
                    ]) !!}
                </div>
             </td>
             <td>
                <div class="form-group" id="city_from_source_order_{{$index}}">
                    {!! Form::select('transports['.$index.'][from_source]',
                        [
                            'hotel' => trans('ERP::attributes.source.hotel'),
                            'airport' => trans('ERP::attributes.source.airport'),
                            'bus' => trans('ERP::attributes.source.bus'),
                            'ferry' => trans('ERP::attributes.source.ferry'),
                            'journey' => trans('ERP::attributes.source.journey'),
                        
                        ]
                        ,null,[
                    'placeholder' => trans('ERP::attributes.transport.from_source'),
                    'class' => 'form-control transports_order_price_'.$index,
                    ]) !!}
                </div>
             </td>
             <td>
                <div class="form-group" id="from_source_name_order_{{$index}}">

                    {!! Form::select('transports['.$index.'][source_name]', [],null,[
                        'placeholder' => trans('ERP::attributes.order.source_name'),
                        'class' => 'form-control',
                    ]) !!}
    
                </div>
                
             </td>
              <td>
                <div class="form-group" id="td_to_city_{{$index}}">
                    {!! Form::select('transports['.$index.'][to_city_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control transports_order_price_'.$index,
                    ]) !!}
                </div>
             </td>
         

             <td>
                <div class="form-group" id="city_to_source_order_{{$index}}">
                    {!! Form::select('transports['.$index.'][to_source]',
                        [
                            'hotel' => trans('ERP::attributes.source.hotel'),
                            'airport' => trans('ERP::attributes.source.airport'),
                            'bus' => trans('ERP::attributes.source.bus'),
                            'ferry' => trans('ERP::attributes.source.ferry'),
                            'tour' => trans('ERP::attributes.source.tour'),
                            'journey' => trans('ERP::attributes.source.journey'),
                        
                        ]
                        ,null,[
                    'placeholder' => trans('ERP::attributes.transport.to_target'),
                    'class' => 'form-control transports_order_price_'.$index,
                    ]) !!}
                </div>
             </td>
             <td>
                <div class="form-group" id="to_source_name_order_{{$index}}">

                    {!! Form::select('transports['.$index.'][target_name]', [],null,[
                        'placeholder' => trans('ERP::attributes.order.target_name'),
                        'class' => 'form-control',
                    ]) !!}
    
                </div>
                
             </td>

             <td>
                <div class="form-group">

                {!! Form::select('transports['.$index.'][vehicle_id]', \ERP::getVehicleList(),null,[
                    'placeholder' => trans('ERP::attributes.transport.vehicle_id'),
                    'class' => 'form-control transports_order_price_'.$index,
                    ]) !!}
                </div>
                
             </td>

             <td>
                <div class="form-group" id="td_driver_{{$index}}">

                {!! Form::select('transports['.$index.'][driver_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.order.driver_id'),
                    'class' => 'form-control',
                    ]) !!}
                </div>
                
            </td>
            <td>
                <input type="hidden" name="transports["{{$index}}"][price_type]" value="manual">
            </td>

             <td>
                <div class="form-group">
                    {!! Form::number('transports['.$index.'][final_price]',null,[
                        'placeholder' =>trans('ERP::attributes.transport.price'),
                        'class' => 'form-control',
                        'id'    =>  'transports_final_price_'.$index,

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('transports['.$index.'][actual_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.actual_price'),
                        'class' => 'form-control',
                        'id'    =>  'transports_actual_price_'.$index,
                        
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group" id="transport_tax_{{$index}}">
                    {!! Form::number('transports['.$index.'][tax]',null,[
                        'placeholder' =>trans('ERP::attributes.main.tax'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('transports['.$index.'][prepay_percent]',$transports_percent,[
                        'placeholder' =>trans('ERP::attributes.hotel.prepay_percent'),
                        'class' => 'form-control ',
                        'id'    =>  'transport_prepay_percent_'.$index,
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::text('transports['.$index.'][sms]',null,[
                        'placeholder' =>trans('ERP::attributes.order.sms'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::text('transports['.$index.'][notes]',null,[
                        'placeholder' =>trans('ERP::attributes.main.note'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

           
        </tr>


@endif


