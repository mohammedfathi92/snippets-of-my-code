@extends('layouts.crud.create_edit')

@section('css')
<style>
    .top_space{
        margin-top: 25px;
    }
</style>
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('hotelprice_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
           
                {!! Form::model($hotel_price, ['url' => url($resource_url.'/'.$hotel_price->hashed_id),'method'=>$hotel_price->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form',]) !!}
                @component('components.box',['box_title'=>trans('ERP::attributes.main.general_info')])
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">


                    
                    {{-- translation row --}}
                    <div class="row"> 
                     @if(count(\Settings::get('supported_languages', [])) > 0)   

                     <div class="nav-tabs-custom" id="tabs">
                        <ul class="nav nav-tabs">
                                @foreach (\Language::allowed() as $code => $name) 
                                  <li class="{{ $code=='ar'?'active':'' }}"><a data-target="#lang_{{ $code }}" data-toggle="tab"  href>{{ $name }}</a></li>
                                @endforeach 
                        </ul>
                    <div class="tab-content" style="background-color: #efeded;">

                     @foreach (\Language::allowed() as $code => $name) 
                     
                    <div class="{{ $code=='ar'?'active':'' }} tab-pane" id="lang_{{ $code }}">
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $hotel_price->getTranslation('name', $code)) !!}

                        {!! PackagesForm::textArea('notes['.$code.']','ERP::attributes.main.note',false, $hotel_price->getTranslation('notes', $code)) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}


                 <div class="row">
                       <div class="col-md-3">
                            {!! PackagesForm::text('reg_code','ERP::attributes.main.reg_code',$hotel_price->reg_code?true:false) !!}
                         </div>
                        <div class="col-md-3">
                         @php

                         $season_years = [];

                         for ($i=2000; $i <= 2050; $i++) { 
                             $season_years[$i] = $i;     
                         }

                         @endphp

                            {!! PackagesForm::select('season','ERP::attributes.hotel.season',$season_years,true,null,[],'select2') !!}
                            
                        </div>
                         <div class="col-md-3">
                            {!! PackagesForm::date('start_date','ERP::attributes.hotel.start_date',true) !!}
                             
                         </div>
                         <div class="col-md-3">
                           {!! PackagesForm::date('end_date','ERP::attributes.hotel.end_date',true) !!}
                             
                         </div>

                      </div>

                  <div class="row">

  <div class="col-md-3" >
                            {!! PackagesForm::select('country_id','ERP::attributes.hotel.country', \ERP::getCountriesList(),true,null, ['class' => 'get_geo_lists',
                             'data-list_type'=> 'cities', 'data-other_select_id'=> 'row_hotels_city', 'data-select2_class'=> 'with-select2',  'data-closest_class' => 'hotel-row', 'data-item_type'=>'countries', 'data-currency_div_id'=>"row_hotels_value_currency_id", 'data-geo_child_class'=>"geo_child"],
                               'select2') !!}
                         </div>

                          <div class="col-md-3">
                            <div id="cities_list_div">
                            {!! PackagesForm::select('city_id','ERP::attributes.hotel.city', \ERP::getCitiesList($hotel_price->country_id),true,null, ['class' => 'get_geo_lists',  'data-list_type'=> 'hotels', 'data-other_select_id'=> 'row_hotels_hotel',  'data-closest_class' => 'hotel-row', 'data-item_type'=>'cities', 'id'=>"row_hotels_city"], 'select2') !!}
                            </div>
                         </div>
                        <div class="col-md-3">
                            <div id="hotels_list_div">
                            {!! PackagesForm::select('hotel_id','ERP::attributes.hotel.hotel',  \ERP::getHotelsList($hotel_price->city_id),true,null, ['class' => 'get_geo_lists geo_child hotel-input', 'data-list_type'=> 'rooms', 'data-other_select_id'=> 'row_hotels_room', 'data-closest_class' => 'hotel-row', 'data-item_type'=>'hotels', 'id'=>"row_hotels_hotel"], 'select2') !!}
                            </div>
                         </div>

                         <div class="col-md-3">
                            {!! PackagesForm::select('room_id','ERP::attributes.hotel.room', \ERP::getRoomsList($hotel_price->hotel_id),true,null, ['class'=>"geo_child",'id'=>"row_hotels_room"], 'select2') !!}
                         </div>
                         </div>

                     <div class="row">
                      <div class="col-md-3" >
                                {!! PackagesForm::select('currency_id','ERP::attributes.flight.currency_id', \ERP::getCurrenciesList(),true,null,[],'select2') !!}
                             </div>
                        <div class="col-md-3">
                            {!! PackagesForm::number('price','ERP::attributes.hotel.price',true,null,['step'=> ".01", 'placeholder' => '00.00']) !!}
                         </div>
                         <div class="col-md-3">
                            {!! PackagesForm::number('r_code','ERP::attributes.hotelprice.r_code',false, null,['max' => '100','step'=> ".01", 'placeholder' => '00.00']) !!}
                         </div>
                         <div class="col-md-3">
                           {!! PackagesForm::text('s_code','ERP::attributes.hotelprice.s_code',false) !!}
                             
                         </div>

                   
                     </div>

                <div class="row">
                     <div class="col-md-3 top_space">
                            {!! PackagesForm::checkbox('is_promo','ERP::attributes.hotelprice.is_promo',false,$hotel_price->is_promo > 0?true:false) !!}
                           
                             
                         </div>
                      <div class="col-md-3">
                             
                          {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'), $hotel_price->exists?$hotel_price->status:1) !!}
                          
                      </div>
                  </div>

                  </div>

    </div>

 
            @endcomponent
            @component('components.box' ,['box_title'=>trans('ERP::attributes.hotelprice.dates')])

                 <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            @php
                            $selected_days = [];
                            if($hotel_price->exists && $hotel_price->price_days){
                            $selected_days = json_decode($hotel_price->price_days, true);
                           }
                            @endphp
                        {!! PackagesForm::select('days[]','ERP::attributes.hotelprice.days',__('ERP::attributes.days'),false,$selected_days,[ 'class'=>'select_multiple','multiple' => true], 'select2') !!}
                        </div>
                    </div>
                    <br>
                    <hr>

            <div class="row">

                <div class="col-md-10 col-md-offset-1">
                    <div class="table-responsive">
                        <table id="values-table" width="100%"
                               class="table color-table info-table table table-hover table-striped table-condensed">
                            <thead>
                            <tr>
                                <th width="40%">{{trans('ERP::attributes.hotelprice.from_date')}}</th>
                                <th width="40%">{{trans('ERP::attributes.hotelprice.to_date')}}</th>
                                <th width="20%">{{trans('ERP::attributes.hotelprice.remove')}}</th>
                            </tr>
                            </thead>
                            <tbody>

                                @if(!$hotel_price->exists)

                                <tr id="tr_0" data-index="0">
                                    <td>
                                        <div class="form-group">
                                                <input name="dates[0][from_date]" type="date" value="" class="form-control"/>
                                         </div>
                                     </td>
                                    <td>
                                        <div class="form-group">
                                            <input name="dates[0][to_date]" type="date" value="" class="form-control"/>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;" data-index="0">
                                                <i class="fa fa-remove"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endif

                                @php
                                $dates = $hotel_price->hotel_price_dates()->get();
                                @endphp

                                @if($dates)
                                @foreach($dates as $date)
                                <tr id="tr_{{ $loop->index }}" data-index="{{ $loop->index }}">
                                    <td>
                                        <div class="form-group">
                                          
                                            <input name="{{ "dates[$loop->index][from_date]" }}" type="date"
                                                   value="{{ $date->from_date }}" class="form-control"/>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div class="form-group">
                                          
                                            <input name="{{ "dates[$loop->index][to_date]" }}" type="date"
                                                   value="{{ $date->to_date }}" class="form-control"/>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;"
                                                data-index="{{ $loop->index }}">
                                                <i  class="fa fa-remove"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                            @endif

                        </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <button type="button" class="btn btn-success" id="add-value">
                            <i class="fa fa-plus">
                                @lang('ERP::attributes.hotelprice.add_new_option')
                            </i>
                        </button>
                    </div>

               

                    
                    
                   
                    
                    

                </div>
            </div>     
             @endcomponent 

             @component('components.box')       
                   

                {!! PackagesForm::customFields($hotel_price) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent
  
@endsection

@section('js')

@include('ERP::partials.scripts.general_scripts')


<script type="text/javascript">
    var_dates_init = function () {
        if ($("#values-table").length > 0) {
            $('body').on('click', '#add-value', function () {
                var index = $('#values-table tr:last').data('index');
                if (isNaN(index)) {
                    index = 0;
                } else {
                    index++;
                }
                $('#values-table tr:last').after('<tr id="tr_' + index + '" data-index="' + index + '"><td><div class="form-group">' +
                    '<input name="dates[' + index + '][from_date]" type="date"' +
                    'value="" class="form-control"/></div></td><td><div class="form-group">' +
                    '<input name="dates[' + index + '][to_date]" type="date"' +
                    'value="" class="form-control"/></div></td>' +
                    '<td><div class="form-group"><button type="button" class="btn btn-danger btn-sm remove-value" style="margin:0;" data-index="' + index + '">'
                    + '<i class="fa fa-remove"></i></button></div></td>' +
                    '</tr>');
            });

            $(document).on('click', '.remove-value', function () {
                var index = $(this).data('index');
                $("#tr_" + index).remove();
            });
        }
    };

    window.initFunctions.push('var_dates_init');
</script>
@endsection