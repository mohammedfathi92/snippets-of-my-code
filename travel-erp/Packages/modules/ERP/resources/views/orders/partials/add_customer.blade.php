    <div class="row">
      <div class="col-md-12">
                

                {!! Form::model($customer, ['url' => route('erp.ajax.create_customer'),'method'=>'POST','files'=>true,'class'=>'ajax-form-order-user', 'id' => 'ajax-form-order-user']) !!}
<div class="row">
           <div class="col-md-12">
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
                         

                        {!! PackagesForm::text('user_data[translated_name]['.$code.']','ERP::attributes.main.name',true, $customer->getTranslation('translated_name', $code)) !!}

                        {!! PackagesForm::text('user_data[translated_nick_name]['.$code.']','ERP::attributes.main.nick_name',false, $customer->getTranslation('translated_nick_name', $code)) !!}
                              {!! PackagesForm::textarea('user_data[user_notes]['.$code.']','ERP::attributes.main.note',false, $customer->getTranslation('user_notes', $code)) !!}
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
                            {!! PackagesForm::text('user_data[user_code]','ERP::attributes.order.data_code',true, $customer->user_code?:$userCode) !!}   
                        </div>
                         <div class="col-md-4" >
                            {!! PackagesForm::select('user_data[branch_id]','ERP::attributes.main.branch', \ERP::getBranchesList(),false,null) !!}
                         </div>
                         <div class="col-md-4" >
                            {!! PackagesForm::select('user_data[agent_id]','ERP::attributes.order.agent_id', \ERP::getAgentsList(),false,null, [], 'select2') !!}
                         </div>
                        
                     </div>
               
                      <div class="row">

                          <div class="col-md-4" >
                             {!! PackagesForm::select('user_data[currency_id]','ERP::attributes.main.currency',\ERP::getCurrenciesList(),false,null, [], 'select2') !!}
                         </div>

                    <div class="col-md-4" >
                            {!! PackagesForm::select('user_data[country_id]','ERP::attributes.hotel.country', \ERP::getCountriesList(),true,null, ['class' => 'get_geo_lists', 'data-other_select_id' => 'row_cust_city_id', 'data-item_type' => 'countries', 'data-list_type' => 'cities', 'data-currency_row' => 'select_country_currency'],
                               'select2') !!}
                         </div>

                          <div class="col-md-4">
                            <div id="cities_list_div">
                            {!! PackagesForm::select('user_data[city_id]','ERP::attributes.hotel.city', \ERP::getCitiesListByCountry($customer->country_id),true,null, ['id' => 'row_cust_city_id'], 'select2') !!}
                            </div>
                         </div>
                

                     </div>
                    <div class="row">
                        <div class="col-md-12">
                          {!! PackagesForm::text('user_data[main_address]', 'ERP::attributes.main.address' ) !!}
                           
                            
                        </div>
                    
                    </div>

                     <div class="row">
                        <div class="col-md-4">
                          {!! PackagesForm::text('user_data[primary_phone]', 'ERP::attributes.main.primary_phone', false, null, ['pattern'=>"^[0-9-+s()]*$"] ) !!}
                           
                            
                        </div>
                        <div class="col-md-4">
                          {!! PackagesForm::text('user_data[phone_one]', 'ERP::attributes.main.phone_one', false, null, ['pattern'=>"^[0-9-+s()]*$"] ) !!}
                         
                        </div>
                        <div class="col-md-4">
                          {!! PackagesForm::text('user_data[phone_two]', 'ERP::attributes.main.phone_two', false, null, ['pattern'=>"^[0-9-+s()]*$"] ) !!}
                            
                        </div>
                    
                    </div>

                    @php
                    $gender_types = ['male' => __('ERP::attributes.main.male'), 'female' =>  __('ERP::attributes.main.female')];

                    @endphp

                  <div class="row">
                        <div class="col-md-4">
                          {!! PackagesForm::select('user_data[user_gender]', 'ERP::attributes.main.user_gender',$gender_types, false ) !!}
                           
                            
                        </div>

                        <div class="col-md-4">

                          {!! PackagesForm::text('user_data[passport_number]', 'ERP::attributes.users.passport_number' ) !!}
                           
                            
                        </div>


                    
                    
                    </div>

<hr>
                    <div class="row">
                  
                        <div class="col-md-8">
                         {!! PackagesForm::email('user_data[email]', 'User::attributes.user.email', true) !!}
                           
                            
                        </div>
                        <div class="col-md-4">
                         {!! PackagesForm::password('user_data[user_password]','User::attributes.user.password', false) !!}
                           
                            
                        </div>

                 
                    
                    </div>
             
                    </div>

                     
             
                    </div>
                     
                </div>

                  @endcomponent

                   <div class="col-md-12">
            @component('components.box')

       
                     <div class="col-md-6">
                       

                        
                        @if($customer->exists && $customer->getFirstMedia('user-picture'))
                        <img src="{{ $customer->picture_thumb }}" class="img-responsive" alt="User Picture" style="max-width: 100%; max-height: 250px" />
                            {!! PackagesForm::checkbox('user_data[clear_picture]',  'ERP::attributes.main.clear_picture' ) !!}
                        @endif

                         {!! PackagesForm::file('user_data[picture_thumb]',  'ERP::attributes.main.user_avatar' ) !!}
                    </div>


                            <div class="col-md-6">
                           @if($customer->hasMedia('user_data[passport-image]'))
                          <div>
                            <img src="{{ $customer->passport_image }}" class="img-responsive" 
                             alt="User Picture" style="max-width: 100%; max-height: 250px">
                          </div>
                          {!! PackagesForm::checkbox('user_data[clear_passport]',  'ERP::attributes.main.clear_picture' ) !!}
                          @endif
                          <div>
                          {!! PackagesForm::file('user_data[passport_image]', 'ERP::attributes.users.passport_image') !!}
                         
                          </div> 
                            
                        </div>

                    <div class="col-md-12">

                       {!! PackagesForm::radio('user_data[status]','ERP::attributes.main.status',true, trans('ERP::attributes.main.status_options'), $customer->exists?$customer->status:1) !!}
                      
                    </div>

            @endcomponent    
 
          </div>
          </div>
<div class="row">
<div class="col-md-12">
        @component('components.box')


                {!! PackagesForm::customFields($customer) !!}

                <div class="row">
                    <div class="col-md-12">
                        
                          <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> {{__('ERP::attributes.users.create_new_customer')}}</button>
                    </div>
                  
               
                </div>
                
@endcomponent
</div>
</div>


</div> {{-- end general col --}}

                {!! Form::close() !!}
          
    </div>