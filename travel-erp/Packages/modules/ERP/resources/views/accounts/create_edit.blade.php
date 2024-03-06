@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('account_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
    <div class="row">

        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($account, ['url' => url($resource_url.'/'.$account->hashed_id),'method'=>$account->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}

                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                    <!-- account account fields here-->
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
                         

                        {!! PackagesForm::text('financial_accounts[translated_name]['.$code.']','ERP::attributes.main.name',true) !!}

                        {!! PackagesForm::textarea('financial_accounts[description]['.$code.']',trans('ERP::attributes.main.description'),false) !!}
                        {!! PackagesForm::text('financial_accounts[notes]['.$code.']','ERP::attributes.main.note',false) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                    </div> {{-- end translation row --}}

                      <div class="row">
                        <div class="col-md-4" >
                            {!! PackagesForm::select('financial_accounts[user_id]','ERP::attributes.accounts.account_user', \ERP::getUsersList(),false,null, [], 'select2') !!}
                         </div>

                       </div>

           <div class="row">
                        <div class="col-md-4" >
                            {!! PackagesForm::select('financial_accounts[category_id]','ERP::attributes.accounts.category', \ERP::getCategoriesByType('financial_accounts'),false,null, [], 'select2') !!}
                         </div>


                         <div class="col-md-4" >
                            {!! PackagesForm::select('financial_accounts[account_type]','ERP::attributes.accounts.account_type', __('ERP::attributes.accounts.accounts_type_list'),false,null) !!}
                         </div>

                        <div class="col-md-4">
                          {!! PackagesForm::number('financial_accounts[account_number]', 'ERP::attributes.accounts.account_number' ) !!}
                           
                            
                        </div>
 
                    
                    </div>
                   <div class="row">
                      <div class="col-md-4">
                          {!! PackagesForm::text('financial_accounts[account_code]', 'ERP::attributes.accounts.account_code' ) !!}
                           
                            
                        </div>

                        <div class="col-md-4">
                          {!! PackagesForm::number('financial_accounts[balance]', 'ERP::attributes.accounts.balance' ) !!}
                           
                            
                        </div>
                        <div class="col-md-4">
                          {!! PackagesForm::number('financial_accounts[opening_balance]', 'ERP::attributes.accounts.opening_balance' ) !!}
                           
                            
                        </div>
                    
                    </div>
                     
                    </div>
                     
                </div>
                


                {!! PackagesForm::customFields($account) !!}

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

@endsection