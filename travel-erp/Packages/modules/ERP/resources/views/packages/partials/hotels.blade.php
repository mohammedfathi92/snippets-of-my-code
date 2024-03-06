    
    <div class="table-responsive">
    <table id="hotels-table" width="100%"
           class="table color-table info-table table table-hover table-striped table-condensed">
        <thead>
        <tr>
            <th>{{trans('ERP::attributes.hotelprice.remove')}}</th>
            <th></th>
            <th>{{trans('ERP::attributes.hotel.country')}}</th>
            <th>{{trans('ERP::attributes.hotel.city')}}</th>
            <th>{{trans('ERP::attributes.hotel.hotel')}}</th>
            <th>{{trans('ERP::attributes.hotel.room')}}</th>
            <th>{{trans('ERP::attributes.order.room_type')}}</th>
            <th>{{trans('ERP::attributes.hotel.rooms_num')}}</th>
            <th>{{trans('ERP::attributes.order.days_numbers')}}</th>
            <th></th>
            <th>{{trans('ERP::attributes.order.room_price')}}</th>
            <th>{{trans('ERP::attributes.order.actual_price')}}</th>
            <th>{{trans('ERP::attributes.order.final_price')}}</th>
            <th>{{trans('ERP::attributes.main.tax')}}</th>
            <th>{{trans('ERP::attributes.hotel.prepay_percent')}}</th>
            <th>{{trans('ERP::attributes.order.agent_id')}}</th>
            <th>{{trans('ERP::attributes.main.email')}}</th>
            <th>{{trans('ERP::attributes.order.year_id')}}</th>
            <th>{{trans('ERP::attributes.hotel.breakfast')}}</th>
            <th>{{trans('ERP::attributes.main.note')}}</th>
        </tr>
        </thead>
        <tbody>

        <tr id="tr_0" data-index="0">
             <td>
                <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;" data-index="0">
                        <i class="fa fa-remove"></i>
                </button>
            </td>
            <td>
                <input type="hidden" name="hotels[0][package_type]" value="package">
            </td>
             <td>
                <div class="form-group">

                {!! Form::select('hotels[0][country_id]', \ERP::getCountriesList(),null,[
                    'placeholder' => trans('ERP::attributes.hotel.country'),
                    'class' => 'form-control hotels_order_country_id',
                    'data-get-city'=>'true',
                    'data-get-tax'=>'true',
                    'data-get-index'=> 0,
                    'data-get-replacedDiv'=>'country_hotel_order',
                    ]) !!}
                </div>
                
             </td>
             
              <td>
                <div class="form-group" id="country_hotel_order_0">
                    {!! Form::select('hotels[0][city_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control',
                    ]) !!}
                </div>
             </td>
             
              <td>
                <div class="form-group" id="city_hotel_order_0">
                        {!! Form::select('hotels[0][hotel_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.hotel.hotel'),
                    'class' => 'form-control',
                    ]) !!}
                </div>
             </td>
            <td>
                <div class="form-group" id="hotel_hotel_order_0">
                    {!! Form::select('hotels[0][room_id]',[],null,[
                        'placeholder' =>trans('ERP::attributes.hotel.room'),
                        'class' => 'form-control hotels_order_price_0',
                    ]) !!}
                 </div>
             </td>
            <td>
                <div class="form-group">
                    {!! Form::select('hotels[0][room_type]',\ERP::getRoomTypesList(),null,[
                        'placeholder' =>trans('ERP::attributes.order.room_type'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>
            
            <td>
                <div class="form-group">
                    {!! Form::select('hotels[0][rooms_num]',
                        ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','12'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30',]
                        ,null,[
                        'placeholder' =>trans('ERP::attributes.hotel.rooms_num'),
                        'class' => 'form-control',
                        'id'    => 'hotels_rooms_numbers_0',

                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::text('hotels[0][days_numbers]',null,[
                        'placeholder' =>trans('ERP::attributes.order.days_numbers'),
                        'class' => 'form-control',
                        'id'    => 'hotels_days_numbers_0',

                    ]) !!}
                </div>
            </td>
            <td>
                <input type="hidden" name="hotels[0][price_type]" value="manual">
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('hotels[0][room_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.room_price'),
                        'class' => 'form-control hotels_room_price',
                        'id'    =>  'hotel_room_price_0',
                        'data-get-index' => 0,
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('hotels[0][actual_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.actual_price'),
                        'class' => 'form-control',
                        'id'    =>  'hotel_actual_price_0',
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('hotels[0][final_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.final_price'),
                        'class' => 'form-control ',
                        'id'    =>  'hotel_final_price_0',
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group" id="hotels_tax_0">
                    {!! Form::number('hotels[0][tax]',null,[
                        'placeholder' =>trans('ERP::attributes.main.tax'),
                        'class' => 'form-control ',
                    
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('hotels[0][prepay_percent]',$hotels_percent,[
                        'placeholder' =>trans('ERP::attributes.hotel.prepay_percent'),
                        'class' => 'form-control ',
                        'id'    =>  'hotel_prepay_percent_0',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::select('hotels[0][agent_id]',\ERP::getAgentsList(),null,[
                        'placeholder' =>trans('ERP::attributes.order.agent_id'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::select('hotels[0][email]',['Yes'=>'Yes','No'=>'No'],null,[
                        'placeholder' =>trans('ERP::attributes.main.email'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::select('hotels[0][year_id]',\ERP::getYearsList(),null,[
                        'placeholder' =>trans('ERP::attributes.order.year_id'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

             <td>
                <div class="form-group">
                    {!! Form::select('hotels[0][breakfast]',['Yes'=>'Yes','No'=>'No'],null,[
                        'placeholder' =>trans('ERP::attributes.hotel.breakfast'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::text('hotels[0][notes]',null,[
                        'placeholder' =>trans('ERP::attributes.main.note'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

           
        </tr>












        @php
            $hotel_orders = $order->hotelOrders;        
        @endphp

        @foreach($hotel_orders as $hotel)
         <tr id="tr_{{ $loop->index }}" data-index="{{ $loop->index }}">
             <td>
                <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;" data-index="{{ $loop->index }}">
                        <i class="fa fa-remove"></i>
                </button>
            </td>
            <td>
                <input type="hidden" name="hotels["{{$loop->index}}"][package_type]" value="package">
            </td>
             <td>
                <div class="form-group">

                {!! Form::select('hotels['.$loop->index.'][country_id]', \ERP::getCountriesList(),$hotel->country_id,[
                    'placeholder' => trans('ERP::attributes.hotel.country'),
                    'class' => 'form-control hotels_order_country_id',
                    'data-get-city'=>'true',
                    'data-get-tax'=>'true',
                    'data-get-index'=> $loop->index,
                    'data-get-replacedDiv'=>'country_hotel_order',
                    ]) !!}
                </div>
                
             </td>
             
              <td>
                <div class="form-group" id="country_hotel_order_{{$loop->index}}">
                    {!! Form::select('hotels['.$loop->index.'][city_id]',ERP::citiesByCountryID($hotel->country_id),$hotel->city_id,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control',
                    ]) !!}
                </div>
             </td>
             
              <td>
                <div class="form-group" id="city_hotel_order_{{$loop->index}}">
                        {!! Form::select('hotels['.$loop->index.'][hotel_id]',ERP::hotelsByCityID($hotel->city_id),$hotel->hotel_id,[
                    'placeholder' => trans('ERP::attributes.hotel.hotel'),
                    'class' => 'form-control',
                    ]) !!}
                </div>
             </td>
            <td>
                <div class="form-group" id="hotel_hotel_order_{{$loop->index}}">
                    {!! Form::select('hotels['.$loop->index.'][room_id]',ERP::roomsByHotelID($hotel->hotel_id),$hotel->room_id,[
                        'placeholder' =>trans('ERP::attributes.hotel.room'),
                        'class' => 'form-control hotels_order_price_'.$loop->index,
                    ]) !!}
                 </div>
             </td>
            <td>
                <div class="form-group">
                    {!! Form::select('hotels['.$loop->index.'][room_type]',\ERP::getRoomTypesList(),$hotel->room_type,[
                        'placeholder' =>trans('ERP::attributes.order.room_type'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>
            
            <td>
                <div class="form-group">
                    {!! Form::select('hotels['.$loop->index.'][rooms_num]',
                        ['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10','12'=>'11','12'=>'12','13'=>'13','14'=>'14','15'=>'15','16'=>'16','17'=>'17','18'=>'18','19'=>'19','20'=>'20','21'=>'21','22'=>'22','23'=>'23','24'=>'24','25'=>'25','26'=>'26','27'=>'27','28'=>'28','29'=>'29','30'=>'30',]
                        ,$hotel->rooms_num,[
                        'placeholder' =>trans('ERP::attributes.hotel.rooms_num'),
                        'class' => 'form-control',
                        'id'    => 'hotels_rooms_numbers_'.$loop->index,

                    ]) !!}
                </div>
            </td>
            

            <td>
                <div class="form-group">
                    {!! Form::text('hotels['.$loop->index.'][days_numbers]',$hotel->days_numbers,[
                        'placeholder' =>trans('ERP::attributes.order.days_numbers'),
                        'class' => 'form-control',
                        'id'    => 'hotels_days_numbers_'.$loop->index,

                    ]) !!}
                </div>
            </td>
             <td>
                <input type="hidden" name="hotels["{{$loop->index}}"][price_type]" value="manual">
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('hotels['.$loop->index.'][room_price]',$hotel->room_price,[
                        'placeholder' =>trans('ERP::attributes.order.room_price'),
                        'class' => 'form-control hotels_room_price',
                        'id'    =>  'hotel_room_price_'.$loop->index,
                        'data-get-index' => $loop->index,


                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('hotels['.$loop->index.'][actual_price]',$hotel->actual_price,[
                        'placeholder' =>trans('ERP::attributes.order.actual_price'),
                        'class' => 'form-control',
                        'id'    =>  'hotel_actual_price_'.$loop->index,
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('hotels['.$loop->index.'][final_price]',$hotel->final_price,[
                        'placeholder' =>trans('ERP::attributes.order.final_price'),
                        'class' => 'form-control',
                        'id'    =>  'hotel_final_price_'.$loop->index,
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group" id="hotels_tax_{{$loop->index}}">
                    {!! Form::number('hotels['.$loop->index.'][tax]',null,[
                        'placeholder' =>trans('ERP::attributes.main.tax'),
                        'class' => 'form-control',
                        'id'    =>  'hotel_tax_'.$loop->index,
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('hotels['.$loop->index.'][prepay_percent]',null,[
                        'placeholder' =>trans('ERP::attributes.hotel.prepay_percent'),
                        'class' => 'form-control ',
                        'id'    =>  'hotel_prepay_percent_'.$loop->index,
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::select('hotels['.$loop->index.'][agent_id]',\ERP::getAgentsList(),$hotel->agent_id,[
                        'placeholder' =>trans('ERP::attributes.order.agent_id'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::select('hotels['.$loop->index.'][email]',['Yes'=>'Yes','No'=>'No'],$hotel->email,[
                        'placeholder' =>trans('ERP::attributes.main.email'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::select('hotels['.$loop->index.'][year_id]',\ERP::getYearsList(),$hotel->year_id,[
                        'placeholder' =>trans('ERP::attributes.order.year_id'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

             <td>
                <div class="form-group">
                    {!! Form::select('hotels['.$loop->index.'][breakfast]',['Yes'=>'Yes','No'=>'No'],$hotel->breakfast,[
                        'placeholder' =>trans('ERP::attributes.hotel.breakfast'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::text('hotels['.$loop->index.'][notes]',$hotel->notes,[
                        'placeholder' =>trans('ERP::attributes.main.note'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

           
        </tr>
        @endforeach



    </tbody>
    </table>
</div> 
<center>
<button type="button" class="btn btn-success add_package_row"  data-row-type="hotels"  data-get-replacedDiv="hotels-table tr:last" id="add_hotel_orders">
    <i class="fa fa-plus"> {{trans('ERP::attributes.order.hotel_packages')}} </i>
</button> 

</center>



@section('js')

<script type="text/javascript">
    var_hotels_init = function () {
        if ($("#hotels-table").length > 0) {
         

            $(document).on('click', '.remove-value', function () {
                var index = $(this).data('index');
                $("#tr_" + index).remove();
            });
        }
    };

    window.initFunctions.push('var_hotels_init');
</script>
@endsection   