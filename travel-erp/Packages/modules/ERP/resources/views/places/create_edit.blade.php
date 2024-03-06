@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('place_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($place, ['url' => url($resource_url.'/'.$place->hashed_id),'method'=>$place->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- place place fields here-->

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
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $place->getTranslation('name', $code)) !!}

                        {!! PackagesForm::textarea('description['.$code.']',trans('ERP::attributes.main.description'),false, $place->getTranslation('description', $code)) !!}

                          {!! PackagesForm::textarea('notes['.$code.']','ERP::attributes.main.note',false, $place->getTranslation('notes', $code)) !!}
                        
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}

                      <div class="row">

                          <div class="col-md-4" >
                             {!! PackagesForm::text('reg_code','ERP::attributes.main.reg_code',$place->exists?true:false) !!}

                          </div>
                          <div class="col-md-4" >
                            {!! PackagesForm::select('category_id','ERP::attributes.accounts.category', \ERP::getCategoriesByType('places'),true,null,[], 'select2') !!}
                            </div>
                      </div>

                      <div class="row">

                            <div class="col-md-4" >
                             {!! PackagesForm::select('currency_id','ERP::attributes.main.currency',\ERP::getCurrenciesList(),false,null, ['id' => 'select_country_currency'], 'select2') !!}
                         </div>

                         <div class="col-md-4" >
                            {!! PackagesForm::select('country_id','ERP::attributes.hotel.country', \ERP::getCountriesList(),true,null, ['class' => 'get_geo_lists', 'data-other_select_id' => 'row_city_id', 'data-item_type' => 'countries', 'data-list_type' => 'cities', 'data-currency_row' => 'select_country_currency'],
                               'select2') !!}
                        </div>

                        <div class="col-md-4">
                            {!! PackagesForm::select('city_id','ERP::attributes.hotel.city', \ERP::getCitiesListByCountry($place->country_id),true,null, ['id' => 'row_city_id'], 'select2') !!}
                            
                        </div>
                

                     </div>


                       <div class="row">
                     <div class="col-md-8">
                            {!! PackagesForm::text('address','ERP::attributes.hotel.address',false) !!}
                            
                        </div>
                         <div class="col-md-4">
                             {!! PackagesForm::select('place_level','ERP::attributes.hotel.level',
                                [
                                    '1' => 'One star' ,
                                    '2' => 'Two stars' ,
                                    '3' => 'Three stars' ,
                                    '4' => 'Four stars' ,
                                    '5' => 'Five stars' ,
                                    '6' => 'Six stars' ,
                                    '7' => 'Seven stars' ,
                                ],false,null) !!} 

                           
                         </div>

                     </div>

                     <div class="row">

                         <div class="col-md-4">
                            {!! PackagesForm::text('latitude','ERP::attributes.hotel.latitude',false)!!}
                         </div>
                         <div class="col-md-4">
                            {!! PackagesForm::text('longitude','ERP::attributes.hotel.longitude',false) !!}
                         </div>
                         <div class="col-md-4">
                            {!! PackagesForm::text('map_location','ERP::attributes.hotel.map_location',false) !!} 
                         </div>
                     </div>

                     <div class="row">
                         <div class="col-md-4">
                            {!! PackagesForm::number('price','ERP::attributes.hotel.price',false,null,['step'=> ".01", 'placeholder' => '00.00']) !!}
                         </div>
                         <div class="col-md-4">
                            {!! PackagesForm::number('new_price','ERP::attributes.hotel.new_price',false, null,['step'=> ".01", 'placeholder' => '00.00']) !!}
                         </div>
                         <div class="col-md-4">
                            {!! PackagesForm::number('season_price','ERP::attributes.hotel.season_price',false, null,['step'=> ".01", 'placeholder' => '00.00']) !!} 
                         </div>
                     </div>

                  
                     
                 <div class="row">
                     <div class="col-md-4">
                            {!! PackagesForm::number('service_fees','ERP::attributes.main.fees_percent',false, null, ['min' => 0, 'max' => '100','step'=> ".01", 'placeholder' => '0.00']) !!} 
                         </div>
                         <div class="col-md-4">



                     {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'), $place->exists?$place->status:1) !!}

                 </div>
             </div>
                    </div>
                     
                </div>

                {!! PackagesForm::customFields($place) !!}

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