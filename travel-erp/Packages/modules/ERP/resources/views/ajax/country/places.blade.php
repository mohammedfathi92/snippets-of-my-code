{{-- city place 4 --}}
@if($replacedDiv == 'cityAjax')
@if(!$places==false)
   <div class="col-md-4">

		{!! PackagesForm::select('place_id','ERP::attributes.hotel.place',$places,false,null) !!}
	</div>	
@endif

@if(!$hotels==false)
<div class="col-md-4" >
	{!! PackagesForm::select('hotel_id','ERP::attributes.hotel.hotel',$hotels,false,null) !!}
</div>
@endif
@endif
{{-- from cities --}}

@if($replacedDiv == 'from_city')

@if(!$places==false)
<div class="col-md-4" >
{!! PackagesForm::select('from_place_id','ERP::attributes.transport.from_place',$places,false,null) !!}
	
</div>
@endif
@if(!$hotels==false)
<div class="col-md-4" >
	{!! PackagesForm::select('from_hotel_id','ERP::attributes.transport.from_hotel',$hotels,false,null) !!}
</div>
@endif
@endif
{{-- to cities --}}

@if($replacedDiv == 'to_city')
@if(!$places==false)
<div class="col-md-4" >
{!! PackagesForm::select('to_place_id','ERP::attributes.transport.to_place',$places,false,null) !!}
	
</div>
@endif
@if(!$hotels==false)
<div class="col-md-4" >
	{!! PackagesForm::select('to_hotel_id','ERP::attributes.transport.to_hotel',$hotels,false,null) !!}
</div>
@endif
@endif

{{-- from cities --}}
@if($replacedDiv == 'city_hotels')

@if(!$hotels == false)
<div id="city_hotels">
<div class="col-md-3" >
  {!! PackagesForm::select('hotel_id','ERP::attributes.hotel.hotel',$hotels,true,null) !!}
</div>
</div>
@endif
@endif

@if($replacedDiv == 'from_city_hotel')

@if(!$hotels == false)
<div id="from_city">
<div class="col-md-3" >
	{!! PackagesForm::select('hotel_id','ERP::attributes.hotel.hotel',$hotels,true,null,
		['class'=>'hotel_id',
	     'data-get-room'=>'true',
	     'data-get-replacedDiv'=>'hotel'
	    ]) !!}
</div>
</div>
@endif
@if(!$rooms == false)
<div id="hotel">
<div class="col-md-3" >
	{!! PackagesForm::select('room_id','ERP::attributes.hotel.room',$rooms,true,null) !!}
</div>
</div>
@endif
@endif

{{-- city => place 3 --}}
@if($replacedDiv == 'city_place')
@if(!$places==false)
   <div class="col-md-3">

		{!! PackagesForm::select('place_id','ERP::attributes.hotel.place',$places,false,null) !!}
	</div>	
@endif
@endif

{{-- city => travels 4 --}}
@if($replacedDiv == 'city_travels')
@if(!$travels==false)
   <div class="col-md-4">
      {!! PackagesForm::select('travel_id','ERP::attributes.transport.travel',$travels,true,null,['id'=>'travel', 'disabled']) !!}
	</div>	
@endif
@endif
 {{-- get hotel from city  hotel order --}}
@if($replacedDiv == 'city_hotel_order')
@if(!$hotels == false)
    
    {!! Form::select('hotels['.$index.'][hotel_id]',$hotels,null,[
        'placeholder' => trans('ERP::attributes.hotel.hotel'),
        'class' => 'form-control hotel_id',
        'data-get-room'=>'true',
        'data-get-index'=> $index,
        'data-get-replacedDiv'=>'hotel_hotel_order'])
    !!}
       
@endif
@endif

{{-- get the sources types and city_id transport order --}}

@if($replacedDiv == 'city_from_source_order')
@if(!$source == false)
    

    {!! Form::select('transports['.$index.'][from_source]',
        [
 		  'hotel' => trans('ERP::attributes.source.hotel'),
          'airport' => trans('ERP::attributes.source.airport'),
          'bus' => trans('ERP::attributes.source.bus'),
          'ferry' => trans('ERP::attributes.source.ferry'),
          'journey' => trans('ERP::attributes.source.journey'),
        ],null,[
    	'placeholder' => trans('ERP::attributes.transport.from_source'),
    	'class' => 'form-control source_type transports_order_price_'.$index,
        'city_id'=>$city_id,
        'data-get-index'=> $index,
        'data-get-replacedDiv'=>'from_source_name_order']) !!}
       
@endif
@endif
{{-- get the sources types and city_id transport order --}}

@if($replacedDiv == 'city_to_source_order')
@if(!$source == false)
    

    {!! Form::select('transports['.$index.'][to_source]',
        [
            'hotel' => trans('ERP::attributes.source.hotel'),
            'airport' => trans('ERP::attributes.source.airport'),
            'bus' => trans('ERP::attributes.source.bus'),
            'ferry' => trans('ERP::attributes.source.ferry'),
            'tour' => trans('ERP::attributes.source.tour'),
            'journey' => trans('ERP::attributes.source.journey'),
        ] ,null,[
    	'placeholder' => trans('ERP::attributes.transport.to_target'),
    	'class' => 'form-control source_type transports_order_price_'.$index,
        'city_id'=>$city_id,
        'data-get-index'=> $index,
        'data-get-replacedDiv'=>'to_source_name_order']) !!}
                
       
@endif
@endif

{{-- get the source names from source types and city_id transport order --}}

@if($replacedDiv == 'from_source_name_order')

@if(!$source_hotels == false)

       {!! Form::select('transports['.$index.'][source_name]',$source_hotels ,null,[
        'placeholder' => trans('ERP::attributes.order.source_name'),
        'class' => 'form-control', ]) !!}
@endif

@if(!$source_airports == false)

       {!! Form::select('transports['.$index.'][source_name]',$source_airports ,null,[
        'placeholder' => trans('ERP::attributes.order.source_name'),
        'class' => 'form-control', ]) !!}
@endif

@if(!$source_bus == false)

       {!! Form::select('transports['.$index.'][source_name]',$source_bus ,null,[
        'placeholder' => trans('ERP::attributes.order.source_name'),
        'class' => 'form-control', ]) !!}
@endif

@if(!$source_ferries == false)

       {!! Form::select('transports['.$index.'][source_name]',$source_ferries ,null,[
        'placeholder' => trans('ERP::attributes.order.source_name'),
        'class' => 'form-control', ]) !!}
@endif

@if(!$source_journey == false)

       {!! Form::select('transports['.$index.'][source_name]',$source_journey ,null,[
        'placeholder' => trans('ERP::attributes.order.source_name'),
        'class' => 'form-control', ]) !!}
@endif

@endif

{{-- get the source names from source types and city_id transport order --}}

@if($replacedDiv == 'to_source_name_order')

@if(!$source_hotels == false)
    
    {!! Form::select('transports['.$index.'][target_name]',$source_hotels,null,[
	    'placeholder' => trans('ERP::attributes.order.target_name'),
    	'class' => 'form-control' ]) !!}
                
       
@endif

@if(!$source_airports == false)
    
    {!! Form::select('transports['.$index.'][target_name]',$source_airports,null,[
	    'placeholder' => trans('ERP::attributes.order.target_name'),
    	'class' => 'form-control' ]) !!}
                
       
@endif

@if(!$source_bus == false)
    
    {!! Form::select('transports['.$index.'][target_name]',$source_bus,null,[
	    'placeholder' => trans('ERP::attributes.order.target_name'),
    	'class' => 'form-control' ]) !!}
                
       
@endif

@if(!$source_ferries == false)
    
    {!! Form::select('transports['.$index.'][target_name]',$source_ferries,null,[
	    'placeholder' => trans('ERP::attributes.order.target_name'),
    	'class' => 'form-control' ]) !!}
                
       
@endif

@if(!$source_travels == false)
    
    {!! Form::select('transports['.$index.'][target_name]',$source_travels,null,[
	    'placeholder' => trans('ERP::attributes.order.target_name'),
    	'class' => 'form-control' ]) !!}
                
       
@endif

@if(!$source_journey == false)
    
    {!! Form::select('transports['.$index.'][target_name]',$source_journey,null,[
	    'placeholder' => trans('ERP::attributes.order.target_name'),
    	'class' => 'form-control' ]) !!}
                
       
@endif

@endif