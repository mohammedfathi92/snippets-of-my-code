@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('customer_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">
      <div class="col-md-12">
                

                {!! Form::model($customer, ['url' => url($resource_url.'/'.$customer->hashed_id),'method'=>$customer->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
<div class="row">
           <div class="col-md-8">
            @component('components.box')     
                
                <div class="row form-group">
                    <div class="col-md-12">
                    <!-- customer customer fields here-->

                           
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
                         

                        {!! PackagesForm::text('translated_name['.$code.']','ERP::attributes.main.name',true, $customer->getTranslation('translated_name', $code)) !!}

                        {!! PackagesForm::text('translated_nick_name['.$code.']','ERP::attributes.main.nick_name',false, $customer->getTranslation('translated_nick_name', $code)) !!}
                              {!! PackagesForm::textarea('user_notes['.$code.']','ERP::attributes.main.note',false, $customer->getTranslation('user_notes', $code)) !!}
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}
              

                @php
                $userCode = ERP::codeGenerator('user', 7);
                @endphp

                     <div class="row">
                        <div class="col-md-4">
                            {!! PackagesForm::text('user_code','ERP::attributes.order.data_code',true, $customer->user_code?:$userCode) !!}   
                        </div>
                         <div class="col-md-4" >
                            {!! PackagesForm::select('branch_id','ERP::attributes.main.branch', \ERP::getBranchesList(),false,null) !!}
                         </div>
                         <div class="col-md-4" >
                            {!! PackagesForm::select('agent_id','ERP::attributes.users.agent', \ERP::getAgentsList(),false,null, [], 'select2') !!}
                         </div>
                        
                     </div>
               
                      <div class="row">

                          <div class="col-md-4" >
                             {!! PackagesForm::select('currency_id','ERP::attributes.main.currency',\ERP::getCurrenciesList(),false,null, [], 'select2') !!}
                         </div>

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
                

                     </div>
                    <div class="row">
                        <div class="col-md-12">
                          {!! PackagesForm::text('main_address', 'ERP::attributes.main.address' ) !!}
                           
                            
                        </div>
                    
                    </div>

                     <div class="row">
                        <div class="col-md-4">
                          {!! PackagesForm::text('primary_phone', 'ERP::attributes.main.primary_phone', false, null, ['pattern'=>"^[0-9-+s()]*$"] ) !!}
                           
                            
                        </div>
                        <div class="col-md-4">
                          {!! PackagesForm::text('phone_one', 'ERP::attributes.main.phone_one', false, null, ['pattern'=>"^[0-9-+s()]*$"] ) !!}
                         
                        </div>
                        <div class="col-md-4">
                          {!! PackagesForm::text('phone_two', 'ERP::attributes.main.phone_two', false, null, ['pattern'=>"^[0-9-+s()]*$"] ) !!}
                            
                        </div>
                    
                    </div>

                    @php
                    $gender_types = ['male' => __('ERP::attributes.main.male'), 'female' =>  __('ERP::attributes.main.female')];

                    @endphp

                  <div class="row">
                        <div class="col-md-4">
                          {!! PackagesForm::select('user_gender', 'ERP::attributes.main.user_gender',$gender_types, false ) !!}
                           
                            
                        </div>

                        <div class="col-md-4">

                          {!! PackagesForm::text('passport_number', 'ERP::attributes.users.passport_number' ) !!}
                           
                            
                        </div>


                    
                    
                    </div>

<hr>
                    <div class="row">
                  
                        <div class="col-md-8">
                         {!! PackagesForm::email('email', 'User::attributes.user.email', true) !!}
                           
                            
                        </div>
                        <div class="col-md-4">
                         {!! PackagesForm::password('user_password','User::attributes.user.password', false) !!}
                           
                            
                        </div>

                 
                    
                    </div>
             
                    </div>

                     
             
                    </div>
                     
                </div>

                  @endcomponent

                   <div class="col-md-4">
            @component('components.box')

       
                     <div class="col-md-12">
                       

                        
                        @if($customer->exists && $customer->getFirstMedia('user-picture'))
                        <img src="{{ $customer->picture_thumb }}" class="img-responsive" alt="User Picture" style="max-width: 100%; max-height: 250px" />
                            {!! PackagesForm::checkbox('clear_picture',  'ERP::attributes.main.clear_picture' ) !!}
                        @endif

                         {!! PackagesForm::file('picture_thumb',  'ERP::attributes.main.user_avatar' ) !!}
                    </div>


                            <div class="col-md-12">
                           @if($customer->hasMedia('passport-image'))
                          <div>
                            <img src="{{ $customer->passport_image }}" class="img-responsive" 
                             alt="User Picture" style="max-width: 100%; max-height: 250px">
                          </div>
                          {!! PackagesForm::checkbox('clear_passport',  'ERP::attributes.main.clear_picture' ) !!}
                          @endif
                          <div>
                          {!! PackagesForm::file('passport_image', 'ERP::attributes.users.passport_image') !!}
                         
                          </div> 
                            
                        </div>

                    <div class="col-md-12">

                       {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'), $customer->exists?$customer->status:1) !!}
                      
                    </div>

            @endcomponent    
 
          </div>
          </div>
<div class="row">
<div class="col-md-8">
        @component('components.box')


                {!! PackagesForm::customFields($customer) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>
                
@endcomponent
</div>
</div>


</div> {{-- end general col --}}

                {!! Form::close() !!}
          
    </div>
@endsection

@section('js')
@include('ERP::partials.scripts.get_country_lists')

@endsection