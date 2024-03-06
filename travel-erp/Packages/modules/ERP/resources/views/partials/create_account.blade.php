 @if(!$user->exists)
          <div class="row">
<div class="col-md-8">
   @component('components.box', ['box_title'=>__('ERP::attributes.titles.user_financial_accounts')])

    <div class="row">
      <div class="col-md-12">

       {!! PackagesForm::radio('create_financial_account','ERP::attributes.accounts.create_new_account',false, __('ERP::attributes.main.yes_no'), 'yes', ['class' => 'create_financial_account']) !!}
</div>
    </div>
    <div class="new_financial_account_row" style="display: none;">

                        {{-- translation row --}}
                    <div class="row"> 
                     @if(count(\Settings::get('supported_languages', [])) > 0)   

                     <div class="nav-tabs-custom" id="tabs2">
                        <ul class="nav nav-tabs">
                                @foreach (\Language::allowed() as $code => $name) 
                                  <li class="{{ $code=='ar'?'active':'' }}"><a data-target="#lang_accounts_{{ $code }}" data-toggle="tab"  href>{{ $name }}</a></li>
                                @endforeach 
                        </ul>
                    <div class="tab-content" style="background-color: #efeded;">

                     @foreach (\Language::allowed() as $code => $name) 
                     
                    <div class="{{ $code=='ar'?'active':'' }} tab-pane" id="lang_accounts_{{ $code }}">
                         

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
                            {!! PackagesForm::select('financial_accounts[category_id]','ERP::attributes.accounts.category', \ERP::getCategoriesByType('accounts'),false,null,[], 'select2') !!}
                         </div>


                         <div class="col-md-4" >
                            {!! PackagesForm::select('financial_accounts[account_type]','ERP::attributes.accounts.account_type', __('ERP::attributes.accounts.accounts_type_list'),true,null) !!}
                         </div>

                        <div class="col-md-4">
                          {!! PackagesForm::number('financial_accounts[box_number]', 'ERP::attributes.accounts.account_number' ) !!}
                           
                            
                        </div>
 
                    
                    </div>
                   <div class="row">
                      <div class="col-md-4">
                          {!! PackagesForm::text('financial_accounts[account_code]', 'ERP::attributes.main.reg_code', true ) !!}
                           
                            
                        </div>

                        <div class="col-md-4">
                          {!! PackagesForm::number('financial_accounts[balance]', 'ERP::attributes.accounts.balance' ) !!}
                           
                            
                        </div>
                        <div class="col-md-4">
                          {!! PackagesForm::number('financial_accounts[opening_balance]', 'ERP::attributes.accounts.opening_balance' ) !!}
                           
                            
                        </div>
                    
                    </div>

                  </div>

   @endcomponent
</div>
</div>
@endif