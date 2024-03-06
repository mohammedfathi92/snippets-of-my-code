@if($replacedDiv == 'city')
@if($cities != false)
<div class="col-md-4" >
	{!! PackagesForm::select('city_id','ERP::attributes.hotel.city',$cities,true,null, [], 'select2') !!}
	
</div>
@endif
@endif
{{-- country => city and place 3 --}}
@if($replacedDiv == 'country_city')
@if(!$cities== false)
<div class="col-md-3" >
    {!! PackagesForm::select('city_id','ERP::attributes.hotel.city',$cities,true,null,
        [
        'class'=>'city_id',
        'data-get-hotel'=>'true',
        'data-get-replacedDiv'=>'city_hotels'
        ], 'select2') !!}
    
</div>
@endif
@endif
{{-- country => city and place 3 --}}
@if($replacedDiv == 'city_hotel')
@if(!$cities== false)
<div class="col-md-3" >
	{!! PackagesForm::select('city_id','ERP::attributes.hotel.city',$cities,true,null,
		[
        'class'=>'city_id',
        'data-get-place'=>'true',
        'data-get-replacedDiv'=>'city_place'
        ], 'select2') !!}
	
</div>
@endif
@if(!$places == false)
<div id="city_place">
<div class="col-md-3" >
{!! PackagesForm::select('place_id','ERP::attributes.hotel.place',$places,false,null, [], 'select2') !!}
	
</div>
</div>
@endif
@endif

{{-- country --}}
@if($replacedDiv == 'cityAjax')
@if(!$cities== false)
<div class="col-md-4" >
	{!! PackagesForm::select('city_id','ERP::attributes.hotel.city',$cities,true,null,
		['class'=>'city_id',
	     'data-get-place'=>'true',
	     'data-get-hotel'=>'false',
	     'data-get-replacedDiv'=>'cityAjax'
	    ], 'select2') !!}
	
</div>
@endif

@if(!$hotels==false)
<div class="col-md-4" >
	{!! PackagesForm::select('hotel_id','ERP::attributes.hotel.hotel',$hotels,false,null, [], 'select2') !!}
</div>
@endif
@endif
{{-- from countries --}}

@if($replacedDiv == 'transport')
@if(!$cities== false)
     <div class="col-md-4" >
         {!! PackagesForm::select('from_city_id','ERP::attributes.transport.from_city',$cities,true,null
            ) !!}
     </div>
     <div class="col-md-4" > 
         {!! PackagesForm::select('from_source','ERP::attributes.transport.from_source',[

                'hotel' => trans('ERP::attributes.source.hotel'),
                'airport' => trans('ERP::attributes.source.airport'),
                'bus' => trans('ERP::attributes.source.bus'),
                
                'ferry' => trans('ERP::attributes.source.ferry'),
                'journey' => trans('ERP::attributes.source.journey'),
            
             ],true,null, [], 'select2') !!}
     </div>

    
    
         <div class="col-md-4">
             {!! PackagesForm::select('to_city_id','ERP::attributes.transport.to_city',$cities,true,null,
             	['class'=>'city_id',
	             'data-get-travel'=>'true',
	             'data-get-replacedDiv'=>'city_travels'

	            ], 'select2') !!}
         </div>
         
         <div class="col-md-4">
             {!! PackagesForm::select('to_source','ERP::attributes.transport.to_target',[

                                    'hotel' => trans('ERP::attributes.source.hotel'),
                                    'airport' => trans('ERP::attributes.source.airport'),
                                    'bus' => trans('ERP::attributes.source.bus'),
                                    'bus' => trans('ERP::attributes.source.bus'),
                                    'ferry' => trans('ERP::attributes.source.ferry'),
                                    'tour' => trans('ERP::attributes.source.tour'),
                                    'journey' => trans('ERP::attributes.source.journey'),
                                
                                 ],true,null,['id'=>'to_source' , 'onChange'=>'tour_disable()'], 'select2') !!}
         </div>
                  
         <div id="city_travels">
         <div class="col-md-4">
             {!! PackagesForm::select('travel_id','ERP::attributes.transport.travel',null,true,null,['id'=>'travel', 'disabled'], 'select2') !!}
         </div>
     	</div>


@endif
@endif

{{-- from flight --}}


@if($replacedDiv == 'from_flight')
@if(!$cities == false)
<div class="col-md-4" >
	{!! PackagesForm::select('from_city_id','ERP::attributes.transport.from_city',$cities,false,null, [],'select2') !!}
	
</div>
@endif
@endif
{{-- to countries --}}

@if($replacedDiv == 'to_flight')
@if(!$cities == false)
<div class="col-md-4" >
	{!! PackagesForm::select('to_city_id','ERP::attributes.transport.to_city',$cities,false,null, [], 'select2') !!}
	
</div>
@endif
@endif


{{-- from hotels --}}

@if($replacedDiv == 'from_hotel')
@if(!$cities == false)
<div class="col-md-3" >
	{!! PackagesForm::select('city_id','ERP::attributes.hotel.city',$cities,true,null,
		['class'=>'city_id',
	     'data-get-place'=>'false',
	     'data-get-hotel'=>'true',
	     'data-get-room'=>'true',
	     'data-get-replacedDiv'=>'from_city_hotel'
	    ], 'select2') !!}
	
</div>
@endif
@if(!$places == false)
<div id="from_city_hotel">

<div class="col-md-3" >
{!! PackagesForm::select('place_id','ERP::attributes.hotel.place',$places,true,null, [], 'select2') !!}
	
</div>
</div>
@endif
@if(!$hotels == false)
<div id="from_city">
<div class="col-md-3" >
	{!! PackagesForm::select('hotel_id','ERP::attributes.hotel.hotel',$hotels,true,null,
		['class'=>'hotel_id',
	     'data-get-room'=>'true',
	     'data-get-replacedDiv'=>'hotel'
	    ], 'select2') !!}
</div>
</div>
@endif
@if(!$rooms == false)
<div id="hotel">
<div class="col-md-3" >
	{!! PackagesForm::select('room_id','ERP::attributes.hotel.room',$rooms,true,null,[], 'select2') !!}
</div>
</div>
@endif
@endif




{{-- from country at the hotel order table --}}

@if($replacedDiv == 'country_hotel_order')
@if(!$cities == false)
    
    <td>
        <div class="form-group" id="country_hotel_order_{{$index}}">
        {!! Form::select('hotels['.$index.'][city_id]',$cities,null,[
            'placeholder' => trans('ERP::attributes.hotel.city'),
            'class' => 'form-control city_id',
            'data-get-hotel'=>'true',
            'data-get-index'=> $index,
            'data-get-replacedDiv'=>'city_hotel_order'], 'select2')
        !!}
        </div>
    </td>
    
       
@endif
@if(!$tax == false)
    
    <td>
    <div class="form-group" id="hotels_tax_{{$index}}">
            {!! Form::number('hotels['.$index.'][tax]',$tax,[
                'placeholder' =>trans('ERP::attributes.main.taxss'),
                'class' => 'form-control',
            ], 'select2') !!}
    </div>
    </td>

@endif
@endif


{{-- from country at the flight order table --}}

@if($replacedDiv == 'from_country_flight_order')
@if(!$cities == false)
    <td>
        <div class="form-group" id="from_country_flight_order_{{$index}}">
        {!! Form::select('flights['.$index.'][from_city_id]',$cities,null,[
            'placeholder' => trans('ERP::attributes.hotel.city'),
            'class' => 'form-control flights_order_price_'.$index], 'select2')
        !!}
        </div>
    </td>
       
@endif
@if(!$tax == false)
    
    <td>
    <div class="form-group" id="flights_tax_{{$index}}">
            {!! Form::number('flights['.$index.'][tax]',$tax,[
                'placeholder' =>trans('ERP::attributes.main.taxss'),
                'class' => 'form-control',
            ], 'select2') !!}
    </div>
    </td>

@endif
@endif

{{-- to country at the flight order table --}}

@if($replacedDiv == 'to_country_flight_order')
@if(!$cities == false)
    
    {!! Form::select('flights['.$index.'][to_city_id]',$cities,null,[
        'placeholder' => trans('ERP::attributes.hotel.city'),
        'class' => 'form-control flights_order_price_'.$index], 'select2')
    !!}
       
@endif
@endif



{{-- from country at the manual hotel order table --}}

@if($replacedDiv == 'country_manual_hotel_order')
@if(!$cities == false)
    <td>
    <div class="form-group" id="country_manual_hotel_order_{{$index}}">
    {!! Form::select('manual_hotels['.$index.'][city_id]',$cities,null,[
        'placeholder' => trans('ERP::attributes.hotel.city'),
        'class' => 'form-control'], 'select2')
    !!}
    </div>
    </td>
@endif
@if(!$tax == false)
    
    <td>
    <div class="form-group" id="manual_hotel_tax_{{$index}}">
            {!! Form::number('manual_hotels['.$index.'][tax]',$tax,[
                'placeholder' =>trans('ERP::attributes.main.taxss'),
                'class' => 'form-control',
            ], 'select2') !!}
    </div>
    </td>

@endif
@endif



{{-- from country at the transports order table --}}

@if($replacedDiv == 'country_transport_order')
@if(!$cities == false)

    <td>
        <div class="form-group" id="td_from_city_{{$index}}">
            {!! Form::select('transports['.$index.'][from_city_id]',$cities,null,[
            'placeholder' => trans('ERP::attributes.hotel.city'),
            'class' => 'form-control city_id transports_order_price_'.$index,
            'data-get-source'=>'true',
            'data-get-index'=> $index,
            'data-get-replacedDiv'=>'city_from_source_order'
            ], 'select2') !!}
        </div>
     </td>
    
  
      <td>
        <div class="form-group" id="td_to_city_{{$index}}">
            {!! Form::select('transports['.$index.'][to_city_id]',$cities,null,[
            'placeholder' => trans('ERP::attributes.hotel.city'),
            'class' => 'form-control city_id transports_order_price_'.$index,
            'data-get-source'=>'true',
            'data-get-index'=> $index,
            'data-get-replacedDiv'=>'city_to_source_order'
            ], 'select2') !!}
        </div>
     </td>
       
@endif
@if(!$drivers == false)


     <td>
        <div class="form-group" id="td_driver_{{$index}}">

        {!! Form::select('transports['.$index.'][driver_id]',$drivers,null,[
            'placeholder' => trans('ERP::attributes.order.driver_id'),
            'class' => 'form-control',
            ], 'select2') !!}
        </div>
        
     </td>
       
@endif
@if(!$tax == false)

     <td>
        <div class="form-group" id="transport_tax_{{$index}}">
            {!! Form::number('transports['.$index.'][tax]',$tax,[
                'placeholder' =>trans('ERP::attributes.main.tax'),
                'class' => 'form-control',
            ], 'select2') !!}
        </div>
    </td>
@endif
@endif