@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('transportprice_create_edit') }}
        @endslot
    @endcomponent
@endsection
@php
 @endphp
@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box',['box_title'=>trans('ERP::attributes.transport.transportprices')])
                {!! Form::model($transport_price, ['url' => url($resource_url.'/'.$transport_price->hashed_id),'method'=>$transport_price->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
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
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $transport_price->getTranslation('name', $code)) !!}

                        {!! PackagesForm::textarea('description['.$code.']',trans('ERP::attributes.main.description'),false, $transport_price->getTranslation('description', $code)) !!}
                        {!! PackagesForm::text('notes['.$code.']','ERP::attributes.main.note',false, $transport_price->getTranslation('notes', $code)) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}


                <div class="row">
                         <div class="col-md-4">
                            {!! PackagesForm::text('reg_code','ERP::attributes.main.reg_code',$transport_price->exists?true:false) !!}
                             
                         </div>
                         <div class="col-md-4" >
                            {!! PackagesForm::select('provider_id','ERP::attributes.users.supplier', \ERP::getProvidersList(),false,null, [], 'select2') !!}
                         </div>
                              <div class="col-md-4" >
                             {!! PackagesForm::select('currency_id','ERP::attributes.main.currency',\ERP::getCurrenciesList(),false,null, [], 'select2') !!}
                         </div>
                     </div>
                  <hr>                 
                    <div class="row">
                         <div class="col-md-3" >
                        {!! PackagesForm::select('from_country_id',
                            'ERP::attributes.transport.from_country',
                             \ERP::getCountriesList(),true,null,
                             ['class' => 'get_geo_lists',
                              'data-list_type'=> 'cities',
                              'data-other_select_id'=> 'row_transports_from_city',
                               'data-select2_class'=> 'with-select2',
                               'data-closest_class' => 'row',
                               'data-item_type'=> 'countries',
                               'data-geo_child_class'=>"geo_child"],
                               'select2') !!}
                         </div>

                          <div class="col-md-3">
                            {!! PackagesForm::select('from_city_id','ERP::attributes.transport.from_city', \ERP::getCitiesListByCountry($transport_price->from_country_id),true,null, ['id' => 'row_transports_from_city','class' => 'get_places_cat', 'data-place_cat_id'=> "row_transports_source_type", 'data-place_id'=>"row_transports_source_place", 'data-geo_child_class'=>"geo_child"], 'select2') !!}
                         </div>


                         <div class="col-md-3" > 
                           
                           {!! PackagesForm::select('sourcable_type','ERP::attributes.transport.source_type', $transport_price->exists?__('ERP::attributes.transport_places'):[],true,null, ['id' => 'row_transports_source_type','class' =>'get_place_type_lists geo_child', 'data-list_type' => 'places', 'data-other_select_id'=> 'row_transports_source_place',  'data-closest_class' => 'row', 'data-item_type'=>'places_types', 'data-city_div_id'=>"row_transports_from_city"], 'select2') !!}
                         </div>

                      <div class="col-md-3">
                            {!! PackagesForm::select('sourcable_id','ERP::attributes.transport.source_place', \ERP::getPlacesByType($transport_price->sourcable_type,$transport_price->sourcable_id),true,null, ['class' => 'source-places-list geo_child', 'id'=>'row_transports_source_place'], 'select2') !!}
                         </div>


                     </div>

                  <div class="row">

                         <div class="col-md-3" >
                            {!! PackagesForm::select('to_country_id','ERP::attributes.transport.to_country', \ERP::getCountriesList(),true,null, ['class' => 'get_geo_lists',
                             'data-list_type'=> 'cities', 'data-other_select_id'=> 'row_transports_to_city',  'data-closest_class' => 'row', 'data-item_type'=>'countries',  'data-geo_child_class'=>"geo_child"],
                               'select2') !!}
                         </div>

                          <div class="col-md-3">
                            {!! PackagesForm::select('to_city_id','ERP::attributes.transport.to_city',\ERP::getCitiesListByCountry($transport_price->to_city_id),true,null, ['id'=>"row_transports_to_city",'class' => 'get_places_cat', 'data-place_cat_id'=>"row_transports_target_type", 'data-place_id'=>"row_transports_target_place", 'data-geo_child_class'=>"geo_child"], 'select2') !!}
                         </div>


                         <div class="col-md-3" > 
                           
                           {!! PackagesForm::select('targetable_type','ERP::attributes.transport.target_type', $transport_price->exists?__('ERP::attributes.transport_places'):[],true,null, ['id'=>"row_transports_target_type",'class' => 'get_place_type_lists geo_child',
                            'data-list_type'=> 'places', 'data-other_select_id'=> 'row_transports_target_place', ' data-closest_class' =>'row', 'data-item_type'=>'places_types',' data-city_div_id'=>"row_transports_to_city"], 'select2') !!}
                         </div>

                      <div class="col-md-3">
                            {!! PackagesForm::select('targetable_id','ERP::attributes.transport.target_place', \ERP::getPlacesByType($transport_price->targetable_type, $transport_price->targetable_id),true,null, ['id'=>"row_transports_target_place",'class' => 'target-places-list geo_child'], 'select2') !!}
                         </div>


                        </div>

    <div class="row">
    <div class="col-md-4">
        {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'), $transport_price->exists?$transport_price->status:1) !!}
        
    </div>
</div>
                        

                    </div>
                     
                </div>

            @endcomponent
            @component('components.box' ,['box_title'=>trans('ERP::attributes.transport.vehicles')])

                <div class="row">
                    <div class="col-md-10 col-md-offset-1 form-group">
                    
                         <table class="table table-hover table-striped table-bordered">

                            <thead>
                                <th>{{trans('ERP::attributes.transport.vehicle_id')}}</th>
                                <th>{{trans('ERP::attributes.transport.cost')}}</th>
                                <th>{{trans('ERP::attributes.transport.commission_one')}}</th>
                                <th>{{trans('ERP::attributes.transport.commission_two')}}</th>
                                <th>{{trans('ERP::attributes.transport.price')}}</th>

                            </thead>
                            <tbody>

                                @foreach($vehiclesTypes as $type)

                                <tr>
                                    @php 
                                    $vData=$transport_price->vehicles_prices()->where('category_id',$type->id)->first();
                                 
                                    @endphp
                                    <th><input class="form-control" name="vehicles[{{$type->id}}][category_id]" type="hidden" value="{{$type->id}}"><span>{{$type->name}}</span></th>
                                    <td><input class="form-control" type="number" name="vehicles[{{$type->id}}][cost]" value="{{$vData?$vData->cost:0}}"></td>
                                    <td><input class="form-control" type="number" name="vehicles[{{$type->id}}][commission_one]" value="{{$vData?$vData->commission_one:0}}"></td>
                                    <td><input class="form-control" type="number" name="vehicles[{{$type->id}}][commission_two]" value="{{$vData?$vData->commission_two:0}}"></td>
                                    <td><input class="form-control" type="number" name="vehicles[{{$type->id}}][price]" value="{{$vData?$vData->price:0}}"></td> 
                                </tr>
                                @endforeach
                            </tbody>
                        </table>                       

                    </div>
                    
                </div>
                     
                   

                {!! PackagesForm::customFields($transport_price) !!}

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
@include('ERP::partials.scripts.get_category_places')

@endsection