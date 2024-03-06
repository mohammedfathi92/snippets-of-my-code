@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('flightprice_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box',['box_title'=>trans('ERP::attributes.main.general_info')])
                {!! Form::model($flight_price, ['url' => url($resource_url.'/'.$flight_price->hashed_id),'method'=>$flight_price->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">

                          {{-- translation row --}}
                    <div class="row"> 
                         <div class="col-md-8" >
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
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $flight_price->getTranslation('name', $code)) !!}

                       
                        {!! PackagesForm::textArea('notes['.$code.']','ERP::attributes.main.note',false, $flight_price->getTranslation('notes', $code)) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                </div>
                    </div> {{-- end translation row --}}

                         <div class="row">
                             <div class="col-md-4">
                                {!! PackagesForm::select('airline_id','ERP::attributes.main.airlines', \ERP::getAirlinesList(),true,null,[],'select2') !!}
                             </div>

                        </div>

                        <div class="row">
                             <div class="col-md-4" >
                                {!! PackagesForm::select('currency_id','ERP::attributes.flight.currency_id', \ERP::getCurrenciesList(),true,null,[],'select2') !!}
                             </div>
                             <div class="col-md-4" >
                                 {!! PackagesForm::date('start_date','ERP::attributes.flight.start_date',true,null) !!}
                             </div>
                        </div>

                      <div class="row">

                         <div class="col-md-4" >
                            {!! PackagesForm::select('from_country_id','ERP::attributes.transport.from_country', \ERP::getCountriesList(),true,null, ['class' => 'get_geo_lists',
                              'data-list_type'=> 'cities',
                              'data-other_select_id'=> 'row_from_city',
                               'data-select2_class'=> 'with-select2',
                               'data-closest_class' => 'row',
                               'data-item_type'=> 'countries',
                               'data-geo_child_class'=>"geo_child"],
                               'select2') !!}
                         </div>

                          <div class="col-md-4">
                            <div id="cities_list_div_2">
                            {!! PackagesForm::select('from_city_id','ERP::attributes.transport.from_city', \ERP::getCitiesListByCountry($flight_price->from_country_id),true,null,  ['id' => 'row_from_city'], 'select2') !!}
                            </div>
                         </div>
                        </div> 

                      <div class="row">

                         <div class="col-md-4" >
                            {!! PackagesForm::select('to_country_id','ERP::attributes.transport.to_country', \ERP::getCountriesList(),true,null, ['class' => 'get_geo_lists',
                              'data-list_type'=> 'cities',
                              'data-other_select_id'=> 'row_to_city',
                               'data-select2_class'=> 'with-select2',
                               'data-closest_class' => 'row',
                               'data-item_type'=> 'countries',
                               'data-geo_child_class'=>"geo_child"],
                               'select2') !!}
                         </div>

                          <div class="col-md-4">
                            <div id="cities_list_div_2">
                            {!! PackagesForm::select('to_city_id','ERP::attributes.transport.to_city', \ERP::getCitiesListByCountry($flight_price->to_country_id),true,null,  ['id' => 'row_to_city'], 'select2') !!}
                            </div>
                         </div>
                        </div> 

 

                        <div class="row">
                             <div class="col-md-4" >
                                {!! PackagesForm::number('cost_adult','ERP::attributes.flight.cost_adult',false,null) !!}
                             </div>
                             <div class="col-md-4" >
                                {!! PackagesForm::number('price_adult','ERP::attributes.flight.price_adult',false,null) !!}
                                 
                             </div>
                             
                        </div>
                        <div class="row">
                             <div class="col-md-4" >
                                {!! PackagesForm::number('cost_child','ERP::attributes.flight.cost_child',false,null) !!}
                             </div>
                             <div class="col-md-4" >
                                {!! PackagesForm::number('price_child','ERP::attributes.flight.price_child',false,null) !!}
                                 
                             </div>
                             
                        </div>
                        <div class="row">
                             <div class="col-md-4" >
                                {!! PackagesForm::number('cost_infant','ERP::attributes.flight.cost_infant',false,null) !!}
                             </div>
                             <div class="col-md-4" >
                                {!! PackagesForm::number('price_infant','ERP::attributes.flight.price_infant',false,null) !!}
                                 
                             </div>
                             
                        </div>

                     <div class="row">
                             <div class="col-md-4" >
                                {!! PackagesForm::number('baggage_cost','ERP::attributes.flight.baggage_cost',false,null) !!}
                             </div>
                             <div class="col-md-4" >
                                {!! PackagesForm::number('baggage_price','ERP::attributes.flight.baggage_price',false,null) !!}
                                 
                             </div>
                             
                        </div>

                            <div class="row">
    <div class="col-md-4">
        {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'), $flight_price->exists?$flight_price->status:1) !!}
        
    </div>
</div>
                    
                    </div>
                     
                </div>
                     
                   

                {!! PackagesForm::customFields($flight_price) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
@endsection

@section('js')
@include('ERP::partials.scripts.general_scripts')
@endsection