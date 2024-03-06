<div class="table-responsive">
    <table id="transports-table" width="100%"
           class="table color-table info-table table table-hover table-striped table-condensed">
        <thead>
        <tr>
            <th>{{trans('ERP::attributes.hotelprice.remove')}}</th>
            <th></th>
            <th>{{trans('ERP::attributes.hotel.country')}}</th>
            <th>{{trans('ERP::attributes.transport.from_city')}}</th>
            <th>{{trans('ERP::attributes.transport.from_source')}}</th>
            <th>{{trans('ERP::attributes.order.source_name')}}</th>
            <th>{{trans('ERP::attributes.transport.to_city')}}</th>
            <th>{{trans('ERP::attributes.transport.to_target')}}</th>
            <th>{{trans('ERP::attributes.order.target_name')}}</th>
            <th>{{trans('ERP::attributes.transport.vehicle_id')}}</th>
            <th>{{trans('ERP::attributes.order.driver_id')}}</th>
            <th></th>
            <th>{{trans('ERP::attributes.transport.price')}}</th>
            <th>{{trans('ERP::attributes.order.actual_price')}}</th>
            <th>{{trans('ERP::attributes.main.tax')}}</th>
            <th>{{trans('ERP::attributes.hotel.prepay_percent')}}</th>
            <th>{{trans('ERP::attributes.order.sms')}}</th>
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
                <input type="hidden" name="transports[0][package_type]" value="package">
            </td>
            <td>
                <div class="form-group">

                {!! Form::select('transports[0][country_id]', \ERP::getCountriesList(),null,[
                    'placeholder' => trans('ERP::attributes.hotel.country'),
                    'class' => 'form-control transport_country_id transports_order_price_0',
                     'data-get-city'=>'true',
                     'data-get-driver'=>'true',
                     'data-get-tax'=>'true',
                     'data-get-index'=> 0,
                     'data-get-replacedDiv'=>'country_transport_order'
                    ]) !!}
                </div>
                
             </td>


            {{-- <td id="country_transport_order_0"> --}}
            <td >

                <div class="form-group" id="td_from_city_0">
                    {!! Form::select('transports[0][from_city_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control transports_order_price_0',
                    ]) !!}
                </div>
             </td>
             <td>
                <div class="form-group" id="city_from_source_order_0">
                    {!! Form::select('transports[0][from_source]',
                        [
                            'hotel' => trans('ERP::attributes.source.hotel'),
                            'airport' => trans('ERP::attributes.source.airport'),
                            'bus' => trans('ERP::attributes.source.bus'),
                            'ferry' => trans('ERP::attributes.source.ferry'),
                            'journey' => trans('ERP::attributes.source.journey'),
                        
                        ]
                        ,null,[
                    'placeholder' => trans('ERP::attributes.transport.from_source'),
                    'class' => 'form-control transports_order_price_0',
                    ]) !!}
                </div>
             </td>
             <td>
                <div class="form-group" id="from_source_name_order_0">

                    {!! Form::select('transports[0][source_name]', [],null,[
                        'placeholder' => trans('ERP::attributes.order.source_name'),
                        'class' => 'form-control',
                    ]) !!}
    
                </div>
                
             </td>
              <td>
                <div class="form-group" id="td_to_city_0">
                    {!! Form::select('transports[0][to_city_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control transports_order_price_0',
                    ]) !!}
                </div>

             </td>
            {{-- </td> --}}
             {{-- end of country div --}}


             <td>
                <div class="form-group" id="city_to_source_order_0" >
                    {!! Form::select('transports[0][to_source]',
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
                    'class' => 'form-control transports_order_price_0',
                    ]) !!}
                </div>
             </td>
             <td>
                <div class="form-group" id="to_source_name_order_0">

                    {!! Form::select('transports[0][target_name]', [],null,[
                        'placeholder' => trans('ERP::attributes.order.target_name'),
                        'class' => 'form-control',
                    ]) !!}
    
                </div>
                
             </td>

             <td>
                <div class="form-group">

                {!! Form::select('transports[0][vehicle_id]', \ERP::getVehicleList(),null,[
                    'placeholder' => trans('ERP::attributes.transport.vehicle_id'),
                    'class' => 'form-control transports_order_price_0',
                    ]) !!}
                </div>
                
             </td>

             <td>
                <div class="form-group" id="td_driver_0">

                {!! Form::select('transports[0][driver_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.order.driver_id'),
                    'class' => 'form-control',
                    ]) !!}
                </div>
                
             </td>
             <td>
                <input type="hidden" name="transports[0][price_type]" value="manual">
            </td>
             <td>
                <div class="form-group">
                    {!! Form::number('transports[0][final_price]',null,[
                        'placeholder' =>trans('ERP::attributes.transport.price'),
                        'class' => 'form-control',
                        'id'    =>  'transports_final_price_0',

                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::number('transports[0][actual_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.actual_price'),
                        'class' => 'form-control',
                        'id'    =>  'transports_actual_price_0',

                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group" id="transport_tax_0">
                    {!! Form::number('transports[0][tax]',null,[
                        'placeholder' =>trans('ERP::attributes.main.tax'),
                        'class' => 'form-control',
                        'id'    =>  'transport_tax_0',
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('transports[0][prepay_percent]',$transports_percent,[
                        'placeholder' =>trans('ERP::attributes.order.prepay_percent'),
                        'class' => 'form-control ',
                        'id'    =>  'transport_prepay_percent_0',
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::text('transports[0][sms]',null,[
                        'placeholder' =>trans('ERP::attributes.order.sms'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::text('transports[0][notes]',null,[
                        'placeholder' =>trans('ERP::attributes.main.note'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

           
        </tr>










        @php
            $transport_orders = $order->transportOrders;        
        @endphp

        @foreach($transport_orders as $transport)

        <tr id="tr_{{ $loop->index }}" data-index="{{ $loop->index }}">
             <td>
                <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;" data-index="{{ $loop->index }}">
                        <i class="fa fa-remove"></i>
                </button>
            </td>
             <td>
                <input type="hidden" name="transports["{{$loop->index}}"][package_type]" value="package">
            </td>
            <td>
                <div class="form-group">

                {!! Form::select('transports['.$loop->index.'][country_id]', \ERP::getCountriesList(),$transport->country_id,[
                    'placeholder' => trans('ERP::attributes.hotel.country'),
                    'class' => 'form-control transport_country_id transports_order_price_'.$loop->index,
                     'data-get-city'=>'true',
                     'data-get-driver'=>'true',
                     'data-get-tax'=>'true',
                     'data-get-index'=> $loop->index,
                     'data-get-replacedDiv'=>'country_transport_order'
                    ]) !!}
                </div>
                
             </td>


            {{-- <td id="country_transport_order_{{ $loop->index }}"> --}}
            <td >

                <div class="form-group" id="td_from_city_{{$loop->index}}">
                    {!! Form::select('transports['.$loop->index.'][from_city_id]',ERP::citiesByCountryID($transport->country_id),$transport->from_city_id,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control transports_order_price_'.$loop->index,
                    ]) !!}
                </div>
             </td>
             <td>
                <div class="form-group" id="city_from_source_order_{{$loop->index}}">
                    {!! Form::select('transports['.$loop->index.'][from_source]',
                        [
                            'hotel' => trans('ERP::attributes.source.hotel'),
                            'airport' => trans('ERP::attributes.source.airport'),
                            'bus' => trans('ERP::attributes.source.bus'),
                            'ferry' => trans('ERP::attributes.source.ferry'),
                            'journey' => trans('ERP::attributes.source.journey'),
                        
                        ]
                        ,$transport->from_source,[
                    'placeholder' => trans('ERP::attributes.transport.from_source'),
                    'class' => 'form-control transports_order_price_'.$loop->index,
                    ]) !!}
                </div>
             </td>
             <td>
                <div class="form-group" id="from_source_name_order_{{$loop->index}}">

                    {!! Form::select('transports['.$loop->index.'][source_name]',ERP::getSourceByType($transport->from_source,$transport->from_city_id),$transport->source_name,[
                        'placeholder' => trans('ERP::attributes.order.source_name'),
                        'class' => 'form-control',
                    ]) !!}
    
                </div>
                
             </td>
              <td>
                <div class="form-group" id="td_to_city_{{$loop->index}}">
                    {!! Form::select('transports['.$loop->index.'][to_city_id]',ERP::citiesByCountryID($transport->country_id),$transport->to_city_id,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control transports_order_price_'.$loop->index,
                    ]) !!}
                </div>

             </td>
            {{-- </td> --}}
             {{-- end of country div --}}


             <td>
                <div class="form-group" id="city_to_source_order_{{$loop->index}}" >
                    {!! Form::select('transports['.$loop->index.'][to_source]',
                        [
                            'hotel' => trans('ERP::attributes.source.hotel'),
                            'airport' => trans('ERP::attributes.source.airport'),
                            'bus' => trans('ERP::attributes.source.bus'),
                            'ferry' => trans('ERP::attributes.source.ferry'),
                            'tour' => trans('ERP::attributes.source.tour'),
                            'journey' => trans('ERP::attributes.source.journey'),
                        
                        ]
                        ,$transport->to_source,[
                    'placeholder' => trans('ERP::attributes.transport.to_target'),
                    'class' => 'form-control transports_order_price_'.$loop->index,
                    ]) !!}
                </div>
             </td>
             <td>
                <div class="form-group" id="to_source_name_order_{{$loop->index}}">

                    {!! Form::select('transports['.$loop->index.'][target_name]',ERP::getSourceByType($transport->to_source,$transport->to_city_id),$transport->target_name,[
                        'placeholder' => trans('ERP::attributes.order.target_name'),
                        'class' => 'form-control',
                    ]) !!}
    
                </div>
                
             </td>

             <td>
                <div class="form-group">

                {!! Form::select('transports['.$loop->index.'][vehicle_id]', \ERP::getVehicleList(),$transport->vehicle_id,[
                    'placeholder' => trans('ERP::attributes.transport.vehicle_id'),
                    'class' => 'form-control transports_order_price_'.$loop->index,
                    ]) !!}
                </div>
                
             </td>

             <td>
                <div class="form-group" id="td_driver_{{$loop->index}}">

                {!! Form::select('transports['.$loop->index.'][driver_id]',ERP::driversByCountryID($transport->country_id),$transport->driver_id,[
                    'placeholder' => trans('ERP::attributes.order.driver_id'),
                    'class' => 'form-control',
                    ]) !!}
                </div>
                
             </td>
              <td>
                <input type="hidden" name="transports["{{$loop->index}}"][price_type]" value="manual">
            </td>
             <td>
                <div class="form-group">
                    {!! Form::number('transports['.$loop->index.'][final_price]',$transport->final_price,[
                        'placeholder' =>trans('ERP::attributes.transport.price'),
                        'class' => 'form-control',
                        'id'    =>  'transports_final_price_'.$loop->index,

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('transports['.$loop->index.'][actual_price]',$transport->actual_price,[
                        'placeholder' =>trans('ERP::attributes.order.actual_price'),
                        'class' => 'form-control',
                        'id'    =>  'transports_actual_price_'.$loop->index,
                        
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group" id="transport_tax_{{$loop->index}}">
                    {!! Form::number('transports['.$loop->index.'][tax]',null,[
                        'placeholder' =>trans('ERP::attributes.main.tax'),
                        'class' => 'form-control',
                        'id'    =>  'transport_tax_'.$loop->index,
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('transports['.$loop->index.'][prepay_percent]',null,[
                        'placeholder' =>trans('ERP::attributes.order.prepay_percent'),
                        'class' => 'form-control ',
                        'id'    =>  'transport_prepay_percent_'.$loop->index,
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::text('transports['.$loop->index.'][sms]',$transport->sms,[
                        'placeholder' =>trans('ERP::attributes.order.sms'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::text('transports['.$loop->index.'][notes]',$transport->notes,[
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
<button type="button" class="btn  btn-success add_package_row" data-row-type="transports"  data-get-replacedDiv="transports-table tr:last" id="add_transport_orders">
    <i class="fa fa-plus"> {{trans('ERP::attributes.order.transport_packages')}} </i>
</button>

</center>    


@section('js')

<script type="text/javascript">
    var_hotels_init = function () {
        if ($("#transports-table").length > 0) {
         

            $(document).on('click', '.remove-value', function () {
                var index = $(this).data('index');
                $("#tr_" + index).remove();
            });
        }
    };

    window.initFunctions.push('var_hotels_init');
</script>
@endsection