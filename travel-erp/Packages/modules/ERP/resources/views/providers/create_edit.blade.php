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

        
                {!! Form::model($provider, ['url' => url($resource_url.'/'.$provider->hashed_id),'method'=>$provider->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}
<div class="row">
           <div class="col-md-8">
            @component('components.box', ['box_title'=>__('ERP::attributes.titles.account_details')])     
                
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
                         

                        {!! PackagesForm::text('translated_name['.$code.']','ERP::attributes.main.name',true, $provider->getTranslation('translated_name', $code)) !!}

                        
                    {!! PackagesForm::textarea('user_notes['.$code.']','ERP::attributes.main.note',false, $provider->getTranslation('user_notes', $code)) !!}
                  
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}
                  

                @php
                $userCode = ERP::codeGenerator('provider','int', 7);
                @endphp

                     <div class="row">
                        <div class="col-md-4">
                            {!! PackagesForm::text('user_code','ERP::attributes.main.reg_code',true, $provider->user_code?:$userCode) !!}   
                        </div>
                         <div class="col-md-4" >
                            {!! PackagesForm::select('branch_id','ERP::attributes.main.branch', \ERP::getBranchesList(),false,null) !!}
                         </div>
                         <div class="col-md-4" >
                            {!! PackagesForm::text('contact_person', 'ERP::attributes.users.contact_person' ) !!}
                         </div>
                        
                     </div>

                       <div class="col-md-4" >
                             {!! PackagesForm::select('currency_id','ERP::attributes.main.currency',\ERP::getCurrenciesList(),false,null, ['id' => 'select_country_currency'], 'select2') !!}
                         </div>

                         <div class="col-md-4" >
                            {!! PackagesForm::select('country_id','ERP::attributes.hotel.country', \ERP::getCountriesList(),true,null, ['class' => 'get_geo_lists', 'data-other_select_id' => 'row_city_id', 'data-item_type' => 'countries', 'data-list_type' => 'cities', 'data-currency_row' => 'select_country_currency'],
                               'select2') !!}
                        </div>

                        <div class="col-md-4">
                            <div id="cities_list_div">
                            {!! PackagesForm::select('city_id','ERP::attributes.hotel.city', \ERP::getCitiesListByCountry($provider->country_id),true,null, ['id' => 'row_city_id'], 'select2') !!}
                            </div>
                        </div>
               

                    <div class="row">
                        <div class="col-md-12">
                          {!! PackagesForm::text('main_address', 'ERP::attributes.main.address' ) !!}
                           
                            
                        </div>
                    
                    </div>

                    @php
                    $gender_types = ['male' => __('ERP::attributes.main.male'), 'female' =>  __('ERP::attributes.main.female')];

                    @endphp

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

                    <div class="row">
                        <div class="col-md-4">
                            {!! PackagesForm::text('fax_number', 'ERP::attributes.main.fax', false, null, ['pattern'=>"^[0-9-+s()]*$"] ) !!}
                         
                           
                            
                        </div>

                    <div class="col-md-4">
                          {!! PackagesForm::text('website_link', 'ERP::attributes.users.website_link' ) !!}
                           
                            
                        </div> 
                         <div class="col-md-4" >
                             {!! PackagesForm::select('account_type','ERP::attributes.users.account_type',__('ERP::attributes.users.account_types'),true) !!}
                         </div>

                       {{--  <div class="col-md-4" >
                              {!! PackagesForm::number('tax_value', 'ERP::attributes.users.tax_value' ) !!}
                         </div>  --}}  
                    
                    </div>
      

<hr>
                    <div class="row">
                  
                        <div class="col-md-8">
                         {!! PackagesForm::email('email', 'ERP::attributes.main.email', true) !!}
                           
                            
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

            <div class="col-md-12" >
                            {!! PackagesForm::select('category_id','ERP::attributes.accounts.category', \ERP::getCategoriesByType('providers'),false,null,[], 'select2') !!}
                         </div>

            
                     <div class="col-md-12">
                        {!! PackagesForm::file('picture_thumb',  'ERP::attributes.main.logo_or_avatar' ) !!}

                        
                        @if($provider->exists && $provider->getFirstMedia('user-picture'))
                        <img src="{{ $provider->picture_thumb }}" class="img-responsive" style="max-width: 100%; max-height: 250px"
                             alt="User Picture"/>
                            {!! PackagesForm::checkbox('clear_picture',  'User::attributes.user.default_picture' ) !!}
                        @endif
                    </div>

                    <div class="col-md-12">

                       {!! PackagesForm::radio('status','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'), $provider->exists?$provider->status:1) !!}
                      
                    </div>

            @endcomponent    
 
          </div>
          </div>
    

    @include('ERP::partials.create_account', ['user' => $provider, 'user_type' => 'provider'])     
          
<div class="row">
<div class="col-md-8">
        @component('components.box')


                {!! PackagesForm::customFields($provider) !!}

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
@include('ERP::partials.scripts.general_scripts')

<script type="text/javascript">
  $(window).on("load", function () {

    var input = $('.create_financial_account');

     if (input.val() == 'yes') {
           $('.new_financial_account_row').show();
        }

    });
  $('body').on('change', 'input:radio[name="create_financial_account"]', function(){
         if (this.checked && this.value == 'yes') {
           $('.new_financial_account_row').show();
        }else{

            $('.new_financial_account_row').hide();

        }
});

</script>
@endsection