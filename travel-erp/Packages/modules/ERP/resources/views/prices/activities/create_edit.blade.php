@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('activityprice_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box',['box_title'=>trans('ERP::attributes.main.general_info')])
                {!! Form::model($activity_price, ['url' => url($resource_url.'/'.$activity_price->hashed_id),'method'=>$activity_price->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
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
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $activity_price->getTranslation('name', $code)) !!}

                       
                        {!! PackagesForm::textArea('notes['.$code.']','ERP::attributes.main.note',false, $activity_price->getTranslation('notes', $code)) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                </div>
                    </div> {{-- end translation row --}}
      
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
                            {!! PackagesForm::select('country_id','ERP::attributes.main.country', \ERP::getCountriesList(),true,null, ['class' => 'get_geo_lists',
                             'data-list_type' => 'cities', 'data-other_select_id'=> 'row_activities_city', 'data-closest_class' => 'row', 'data-item_type'=>'countries'],
                               'select2') !!}
                         </div>

                          <div class="col-md-4">
                           
                            {!! PackagesForm::select('city_id','ERP::attributes.main.city', \ERP::getCitiesListByCountry($activity_price->country_id),true,null, ['class' => 'cities_list_1 get_geo_lists', 'data-list_type' => 'activities', 'data-other_select_id'=> 'row_activities_activity', 'data-closest_class' => 'row', 'data-item_type'=>'cities', 'id'=>'row_activities_city'], 'select2') !!}
                          
                         </div>
                        </div> 

                        <div class="row">
                        <div class="col-md-4">
                            {!! PackagesForm::select('activity_id','ERP::attributes.order.activity', \ERP::getActivitiesList($activity_price->city_id),true,null, ['class' => 'cities_list_1 geo_child', 'data-list_type' => 'activities', 'id' => 'row_activities_activity'], 'select2') !!}
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
    <div class="col-md-4">
        {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'), $activity_price->exists?$activity_price->status:1) !!}
        
    </div>
</div>
                    
                    </div>
                     
                </div>
                     
                   

                {!! PackagesForm::customFields($activity_price) !!}

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