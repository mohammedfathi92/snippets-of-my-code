@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('room_create_edit', $hotel) }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($room, ['url' => trim(url($resource_url.'/'.$room->hashed_id),'/'),'method'=>$room->exists?'PUT':'POST','files'=>true,'class'=>'ajax']) !!}
                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- place room fields here-->

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
                         

                        {!! PackagesForm::text('name['.$code.']','ERP::attributes.main.name',true, $room->getTranslation('name', $code)) !!}

                        {!! PackagesForm::textarea('description['.$code.']',trans('ERP::attributes.main.description'),false, $room->getTranslation('description', $code)) !!}
                        {!! PackagesForm::textarea('notes['.$code.']','ERP::attributes.main.note',false, $room->getTranslation('notes', $code)) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}

                @if(!$has_hotel) 
                  <div class="row">

  <div class="col-md-4" >
                            {!! PackagesForm::select('country_id','ERP::attributes.hotel.country', \ERP::getCountriesList(),true,null, ['class' => 'get-country-lists',
                             'data-other_div' => 'cities_list_div',
                             'data-other_type' => 'cities',
                              'data-other_list' => 'cities_list','data-required_div' => 'true'],
                               'select2') !!}
                         </div>

                          <div class="col-md-4">
                            <div id="cities_list_div">
                            {!! PackagesForm::select('city_id','ERP::attributes.hotel.city', [],true,null, ['class' => 'cities_list', 'data-label' => __('ERP::attributes.hotel.city')], 'select2') !!}
                            </div>
                         </div>
                                    <div class="col-md-4">
                            <div id="hotels_list_div">
                            {!! PackagesForm::select('hotels_id','ERP::attributes.hotel.hotel', [],true,null, ['class' => 'hotels_list', 'data-label' => __('ERP::attributes.hotel.hotel')], 'select2') !!}
                            </div>
                         </div>

                     </div>
                     @else
                     <input type="hidden" name="hotel_id" value="{{$hotel->id}}">
                @endif
                     <div class="row">
                             <div class="col-md-4">
                            {!! PackagesForm::text('reg_code','ERP::attributes.main.reg_code',true) !!}
                             
                         </div>
                        <div class="col-md-4">
                            {!! PackagesForm::select('breakfast','ERP::attributes.hotel.breakfast',[1 => 'Yes', 0 =>'No'],false,null) !!}
                         </div>
                         <div class="col-md-4">
                            {!! PackagesForm::number('price','ERP::attributes.hotel.price_per_night',false, null, ['min' => 0,'step'=> ".01", 'placeholder' => '00.00']) !!}
                         </div>
{{--        <div class="col-md-3">
                            {!! PackagesForm::number('new_price','ERP::attributes.hotel.new_price',false) !!}
                         </div>
                         <div class="col-md-3"> 
                            {!! PackagesForm::number('season_price','ERP::attributes.hotel.season_price',false) !!} 
                         </div> --}}
                     </div>

                      <div class="row">
                             <div class="col-md-4" >
                            {!! PackagesForm::select('category_id','ERP::attributes.order.room_type', \ERP::getCategoriesByType('rooms'),false,null, [], 'select2') !!}
                         </div>

                         <div class="col-md-4"> 
                            {!! PackagesForm::number('rooms_num','ERP::attributes.hotel.rooms_num',true,$room->exists?$room->rooms_num:1) !!} 
                         </div>

                       <div class="col-md-4">
                             {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'), $room->exists?$room->status:1) !!}

                         </div>

                



                            

                     
                         </div>

                    
                    </div>
                     
                </div>

                {!! PackagesForm::customFields($room) !!}

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
@include('ERP::partials.scripts.get_city_lists', ['list_type' => 'hotels'])
@endsection