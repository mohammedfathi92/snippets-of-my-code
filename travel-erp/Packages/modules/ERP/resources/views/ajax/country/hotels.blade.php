@if($replacedDiv == 'hotel')
@if(!$rooms==false)
   <div class="col-md-3">

		{!! PackagesForm::select('room_id','ERP::attributes.hotel.room',$rooms,true,null) !!}
	</div>	
@endif
@endif

@if($replacedDiv == 'hotel_hotel_order')
@if(!$rooms == false)
    
    {!! Form::select('hotels['.$index.'][room_id]',$rooms,null,[
        'placeholder' => trans('ERP::attributes.hotel.room'),
        'class' => 'form-control hotels_order_price_'.$index])
    !!}
       
@endif
@endif