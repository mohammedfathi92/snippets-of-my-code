
<div class="table-responsive">
    <table id="flights-table" width="100%"
           class="table color-table info-table table table-hover table-striped table-condensed">
        <thead>
        <tr>
            <th>{{trans('ERP::attributes.hotelprice.remove')}}</th>
            <th></th>
            <th>{{trans('ERP::attributes.main.type')}}</th>
            <th>{{trans('ERP::attributes.order.Transporter')}}</th>
            <th>{{trans('ERP::attributes.transport.from_country')}}</th>
            <th>{{trans('ERP::attributes.transport.from_city')}}</th>
            <th>{{trans('ERP::attributes.transport.to_country')}}</th>
            <th>{{trans('ERP::attributes.transport.to_city')}}</th>
            <th>{{trans('ERP::attributes.order.adult_numbers')}}</th>
            <th>{{trans('ERP::attributes.order.chlid_numbers')}}</th>
            <th>{{trans('ERP::attributes.order.infant_numbers')}}</th>
            <th></th>
            <th>{{trans('ERP::attributes.order.adult_prices')}}</th>
            <th>{{trans('ERP::attributes.order.chlid_prices')}}</th>
            <th>{{trans('ERP::attributes.order.infant_prices')}}</th>
            <th>{{trans('ERP::attributes.order.final_price')}}</th> 
            <th>{{trans('ERP::attributes.main.tax')}}</th>
            <th>{{trans('ERP::attributes.hotel.prepay_percent')}}</th>
            <th>{{trans('ERP::attributes.order.agent_id')}}</th>
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
                <input type="hidden" name="flights[0][package_type]" value="package">
            </td>
            <td>
                <div class="form-group">
                    {!! Form::select('flights[0][type]',[
                        'flight' => trans('ERP::attributes.order.flight'),
                        'ferry' => trans('ERP::attributes.order.ferry'),
                    ],'flight',[
                        'placeholder' =>trans('ERP::attributes.main.type'),
                        'class' => 'form-control flights_order_price_0',
                        'id'=>'transporter_type_0' ,
                         'onChange'=>'flight_toggle_hide(0)'
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">

                    {!! Form::select('flights[0][airline_id]', \ERP::getAirlineList(),null,[
                     'placeholder' => trans('ERP::attributes.order.flight'),
                     'class' => 'form-control',
                      'id'  => 'type_airline_0'
                    ]) !!}

                    {!! Form::select('flights[0][ferry_id]', \ERP::getFerriesList(),null,[
                     'placeholder' => trans('ERP::attributes.order.ferry'),
                     'class' => 'form-control hidden',
                     'id'  => 'type_ferry_0']) !!}
                </div>
                
             </td>
            <td>
                <div class="form-group">

                {!! Form::select('flights[0][from_country_id]', \ERP::getCountriesList(),null,[
                    'placeholder' => trans('ERP::attributes.hotel.country'),
                    'class' => 'form-control flights_order_country_id flights_order_price_0',
                     'data-get-city'=>'true',
                     'data-get-tax'=>'true',
                     'data-get-index'=> 0,
                     'data-get-replacedDiv'=>'from_country_flight_order'
                    
                    ]) !!}
                </div>
                
             </td>
              <td>
                <div class="form-group" id="from_country_flight_order_0">
                    {!! Form::select('flights[0][from_city_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control flights_order_price_0',
                    ]) !!}
                </div>
             </td>
             <td>
                <div class="form-group">

                {!! Form::select('flights[0][to_country_id]', \ERP::getCountriesList(),null,[
                    'placeholder' => trans('ERP::attributes.hotel.country'),
                    'class' => 'form-control country_id flights_order_price_0',
                     'data-get-city'=>'true',
                     'data-get-index'=> 0,
                     'data-get-replacedDiv'=>'to_country_flight_order'
                    ]) !!}
                </div>
                
             </td>
              <td>
                <div class="form-group" id="to_country_flight_order_0">
                    {!! Form::select('flights[0][to_city_id]',[],null,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control flights_order_price_0',
                    ]) !!}
                </div>
             </td>

            <td>
                <div class="form-group">
                    {!! Form::number('flights[0][adult_numbers]',0,[
                        'placeholder' =>trans('ERP::attributes.order.adult_numbers'),
                        'class' => 'form-control',
                        'id'    =>  'flights_adult_numbers_0',

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights[0][chlid_numbers]',0,[
                        'placeholder' =>trans('ERP::attributes.order.chlid_numbers'),
                        'class' => 'form-control',
                        'id'    =>  'flights_chlid_numbers_0',

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights[0][infant_numbers]',0,[
                        'placeholder' =>trans('ERP::attributes.order.infant_numbers'),
                        'class' => 'form-control',
                        'id'    =>  'flights_infant_numbers_0',

                    ]) !!}
                </div>
            </td>
            <td>
                <input type="hidden" name="flights[0][price_type]" value="manual">
            </td>
             
            <td>
                <div class="form-group">
                    {!! Form::number('flights[0][adult_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.adult_prices'),
                        'class' => 'form-control',
                        'id'    =>  'flights_adult_price_0',

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights[0][chlid_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.chlid_prices'),
                        'class' => 'form-control',
                        'id'    =>  'flights_chlid_price_0',

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights[0][infant_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.infant_prices'),
                        'class' => 'form-control',
                        'id'    =>  'flights_infant_price_0',
                        
                    ]) !!}
                </div>
            </td>

             <td>
                <div class="form-group">
                    {!! Form::number('flights[0][final_price]',null,[
                        'placeholder' =>trans('ERP::attributes.order.final_price'),
                        'class' => 'form-control flights_final_price',
                        'id'    =>  'flights_final_price_0',
                        'data-get-index' => 0,

                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group" id="flights_tax_0">
                    {!! Form::number('flights[0][tax]',null,[
                        'placeholder' =>trans('ERP::attributes.main.tax'),
                        'class' => 'form-control ',
                        'id'    =>  'flight_tax_0',
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights[0][prepay_percent]',$flights_percent,[
                        'placeholder' =>trans('ERP::attributes.hotel.prepay_percent'),
                        'class' => 'form-control ',
                        'id'    =>  'flight_prepay_percent_0',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::select('flights[0][agent_id]',\ERP::getAgentsList(),null,[
                        'placeholder' =>trans('ERP::attributes.order.agent_id'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::text('flights[0][notes]',null,[
                        'placeholder' =>trans('ERP::attributes.main.note'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

           
        </tr>










        @php
            $flight_orders = $order->flightOrders;        
        @endphp

        @foreach($flight_orders as $flight)

         <tr id="tr_{{ $loop->index }}" data-index="{{ $loop->index }}">
             <td>
                <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;" data-index="{{ $loop->index }}">
                        <i class="fa fa-remove"></i>
                </button>
            </td>
            <td>
                <input type="hidden" name="flights["{{$loop->index}}"][package_type]" value="package">
            </td>
            <td>
                <div class="form-group">
                    {!! Form::select('flights['.$loop->index.'][type]',[
                        'flight' => trans('ERP::attributes.order.flight'),
                        'ferry' => trans('ERP::attributes.order.ferry'),
                    ],'flight',[
                        'placeholder' =>trans('ERP::attributes.main.type'),
                        'class' => 'form-control flights_order_price_'.$loop->index,
                        'id'=>'transporter_type_'.$loop->index,
                         'onChange'=>'flight_toggle_hide('.$loop->index.')'
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">

                    {!! Form::select('flights['.$loop->index.'][airline_id]', \ERP::getAirlineList(),null,[
                     'placeholder' => trans('ERP::attributes.order.flight'),
                     'class' => 'form-control',
                      'id'  => 'type_airline_'.$loop->index
                    ]) !!}

                    {!! Form::select('flights['.$loop->index.'][ferry_id]', \ERP::getFerriesList(),null,[
                     'placeholder' => trans('ERP::attributes.order.ferry'),
                     'class' => 'form-control hidden',
                     'id'  => 'type_ferry_'.$loop->index]) !!}
                </div>
                
             </td>
            <td>
                <div class="form-group">

                {!! Form::select('flights['.$loop->index.'][from_country_id]', \ERP::getCountriesList(),$flight->from_country_id,[
                    'placeholder' => trans('ERP::attributes.hotel.country'),
                    'class' => 'form-control flights_order_country_id  flights_order_price_'.$loop->index,
                     'data-get-city'=>'true',
                     'data-get-tax'=>'true',
                     'data-get-index'=> $loop->index,
                     'data-get-replacedDiv'=>'from_country_flight_order'
                    
                    ]) !!}
                </div>
                
             </td>
              <td>
                <div class="form-group" id="from_country_flight_order_{{$loop->index}}">
                    {!! Form::select('flights['.$loop->index.'][from_city_id]',ERP::citiesByCountryID($flight->from_country_id),$flight->from_city_id,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control flights_order_price_'.$loop->index,
                    ]) !!}
                </div>
             </td>
             <td>
                <div class="form-group">

                {!! Form::select('flights['.$loop->index.'][to_country_id]', \ERP::getCountriesList(),$flight->to_country_id,[
                    'placeholder' => trans('ERP::attributes.hotel.country'),
                    'class' => 'form-control country_id flights_order_price_'.$loop->index,
                     'data-get-city'=>'true',
                     'data-get-index'=> $loop->index,
                     'data-get-replacedDiv'=>'to_country_flight_order'
                    ]) !!}
                </div>
                
             </td>
              <td>
                <div class="form-group" id="to_country_flight_order_{{$loop->index}}">
                    {!! Form::select('flights['.$loop->index.'][to_city_id]',ERP::citiesByCountryID($flight->to_country_id),null,[
                    'placeholder' => trans('ERP::attributes.hotel.city'),
                    'class' => 'form-control flights_order_price_'.$loop->index,
                    ]) !!}
                </div>
             </td>

            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$loop->index.'][adult_numbers]',$flight->adult_numbers,[
                        'placeholder' =>trans('ERP::attributes.order.adult_numbers'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$loop->index.'][chlid_numbers]',$flight->chlid_numbers,[
                        'placeholder' =>trans('ERP::attributes.order.chlid_numbers'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$loop->index.'][infant_numbers]',$flight->infant_numbers,[
                        'placeholder' =>trans('ERP::attributes.order.infant_numbers'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>
            <td>
                <input type="hidden" name="flights["{{$loop->index}}"][price_type]" value="manual">
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$loop->index.'][adult_price]',$flight->adult_price,[
                        'placeholder' =>trans('ERP::attributes.order.adult_prices'),
                        'class' => 'form-control',
                        'id'    =>  'flights_adult_price_'.$loop->index,

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$loop->index.'][chlid_price]',$flight->chlid_price,[
                        'placeholder' =>trans('ERP::attributes.order.chlid_prices'),
                        'class' => 'form-control',
                        'id'    =>  'flights_chlid_price_'.$loop->index,

                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$loop->index.'][infant_price]',$flight->infant_price,[
                        'placeholder' =>trans('ERP::attributes.order.infant_prices'),
                        'class' => 'form-control',
                        'id'    =>  'flights_infant_price_'.$loop->index,

                    ]) !!}
                </div>
            </td>

             <td>
                <div class="form-group">
                    {!! Form::number('flights['.$loop->index.'][final_price]',$flight->final_price,[
                        'placeholder' =>trans('ERP::attributes.order.final_price'),
                        'class' => 'form-control flights_final_price',
                        'id'    =>  'flights_final_price_'.$loop->index,
                        'data-get-index' => $loop->index,

                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group" id="flights_tax_{{$loop->index}}">
                    {!! Form::number('flights['.$loop->index.'][tax]',null,[
                        'placeholder' =>trans('ERP::attributes.main.tax'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>
            <td>
                <div class="form-group">
                    {!! Form::number('flights['.$loop->index.'][prepay_percent]',null,[
                        'placeholder' =>trans('ERP::attributes.order.prepay_percent'),
                        'class' => 'form-control ',
                        'id'    =>  'flight_prepay_percent_'.$loop->index,
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::select('flights['.$loop->index.'][agent_id]',\ERP::getAgentsList(),$flight->agent_id,[
                        'placeholder' =>trans('ERP::attributes.order.agent_id'),
                        'class' => 'form-control',
                    ]) !!}
                </div>
            </td>

            <td>
                <div class="form-group">
                    {!! Form::text('flights['.$loop->index.'][notes]',$flight->notes,[
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
<button type="button" class="btn btn-success add_package_row" data-row-type="flights"  data-get-replacedDiv="flights-table tr:last" id="add_flight_orders">
    <i class="fa fa-plus"> {{trans('ERP::attributes.order.flight_packages')}} </i>
</button>
</center>    


@section('js')

<script type="text/javascript">
    var_hotels_init = function () {
        if ($("#flights-table").length > 0) {
         

            $(document).on('click', '.remove-value', function () {
                var index = $(this).data('index');
                $("#tr_" + index).remove();
            });
        }
    };

    window.initFunctions.push('var_hotels_init');
</script>
@endsection