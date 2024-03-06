@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('busprice_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box',['box_title'=>trans('ERP::attributes.main.general_info')])
                {!! Form::model($bus_price, ['url' => url($resource_url.'/'.$bus_price->hashed_id),'method'=>$bus_price->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
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
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $bus_price->getTranslation('name', $code)) !!}

                       
                        {!! PackagesForm::textArea('notes['.$code.']','ERP::attributes.main.note',false, $bus_price->getTranslation('notes', $code)) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                </div>
                    </div> {{-- end translation row --}}

                        <div class="row">
                             <div class="col-md-4" >
                                {!! PackagesForm::select('currency_id','ERP::attributes.bus.currency_id', \ERP::getCurrenciesList(),true,null,[],'select2') !!}
                             </div>
                             <div class="col-md-4" >
                                 {!! PackagesForm::date('start_date','ERP::attributes.bus.start_date',true,null) !!}
                             </div>
                        </div>

                     <div class="row">

                         <div class="col-md-4" >
                            {!! PackagesForm::select('from_country_id','ERP::attributes.transport.from_country', \ERP::getCountriesList(),true,null, ['class' => 'get-country-lists',
                             'data-other_div' => 'cities_list_div_1',
                             'data-other_type' => 'cities',
                              'data-other_list' => 'cities_list_1','data-required_div' => 'true'],
                               'select2') !!}
                         </div>

                          <div class="col-md-4">
                            <div id="cities_list_div_1">
                            {!! PackagesForm::select('from_city_id','ERP::attributes.transport.from_city', [],true,null, ['class' => 'cities_list_1', 'data-label' => __('ERP::attributes.transport.from_city')], 'select2') !!}
                            </div>
                         </div>
                        </div> 

                      <div class="row">

                         <div class="col-md-4" >
                            {!! PackagesForm::select('to_country_id','ERP::attributes.transport.to_country', \ERP::getCountriesList(),true,null, ['class' => 'get-country-lists',
                             'data-other_div' => 'cities_list_div_2',
                             'data-other_type' => 'cities',
                              'data-other_list' => 'cities_list_2','data-required_div' => 'true'],
                               'select2') !!}
                         </div>

                          <div class="col-md-4">
                            <div id="cities_list_div_2">
                            {!! PackagesForm::select('to_city_id','ERP::attributes.transport.to_city', [],true,null, ['class' => 'cities_list_2', 'data-label' => __('ERP::attributes.transport.to_city')], 'select2') !!}
                            </div>
                         </div>
                        </div> 

 

                        <div class="row">
                             <div class="col-md-4" >
                                {!! PackagesForm::number('cost_adult','ERP::attributes.bus.cost_adult',false,null) !!}
                             </div>
                             <div class="col-md-4" >
                                {!! PackagesForm::number('price_adult','ERP::attributes.bus.price_adult',false,null) !!}
                                 
                             </div>
                             
                        </div>
                        <div class="row">
                             <div class="col-md-4" >
                                {!! PackagesForm::number('cost_child','ERP::attributes.bus.cost_child',false,null) !!}
                             </div>
                             <div class="col-md-4" >
                                {!! PackagesForm::number('price_child','ERP::attributes.bus.price_child',false,null) !!}
                                 
                             </div>
                             
                        </div>
                        <div class="row">
                             <div class="col-md-4" >
                                {!! PackagesForm::number('cost_infant','ERP::attributes.bus.cost_infant',false,null) !!}
                             </div>
                             <div class="col-md-4" >
                                {!! PackagesForm::number('price_infant','ERP::attributes.bus.price_infant',false,null) !!}
                                 
                             </div>
                             
                        </div>

                     <div class="row">
                             <div class="col-md-4" >
                                {!! PackagesForm::number('baggage_cost','ERP::attributes.bus.baggage_cost',false,null) !!}
                             </div>
                             <div class="col-md-4" >
                                {!! PackagesForm::number('baggage_price','ERP::attributes.bus.baggage_price',false,null) !!}
                                 
                             </div>
                             
                        </div>

                            <div class="row">
    <div class="col-md-4">
        {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'), $bus_price->exists?$bus_price->status:1) !!}
        
    </div>
</div>
                    
                    </div>
                     
                </div>
                     
                   

                {!! PackagesForm::customFields($bus_price) !!}

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
@include('ERP::partials.scripts.get_country_lists')
@endsection