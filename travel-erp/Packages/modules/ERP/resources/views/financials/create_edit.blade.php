@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('financial_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
@php
$main_currency = getMainCurrency();
@endphp
    <div class="row">

        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($financial, ['url' => url($resource_url.'/'.$financial->hashed_id),'method'=>$financial->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}

                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">


                      <div class="row">

                        <div class="col-md-3" >
                            {!! PackagesForm::select('type','ERP::attributes.financials.label_type', __('ERP::attributes.financials.types'),true,null, ['class' => 'financial-types'], 'select2') !!}
                         </div>

                          <div class="col-md-3">
                          {!! PackagesForm::number('final_value', 'ERP::attributes.financials.value',true, null, ['step'=> ".01", 'placeholder' => '0.00', 'id' => 'financial_value'] ) !!}
                          <p class="must_value_small_than" style="display: none;"> <small style="color: red;"> {{__('ERP::attributes.financials.must_value_not_bigger_than')}} </small> <small class="value_less_than" style="font-weight: bold;">0.00</small></p>
                           
                            
                        </div>


           <div class="row">
            <div class="form-group col-md-3 required-field">
            <label for="row_payment_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_payment_value_currency_id" name="value_currency_id">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach(\ERP::getCurrenciesData() as $row)
              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}">{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-3 required-field">
                   <label for="row_payment_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_payment_value_currency_rate" type="number" name="value_currency_rate" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001">
          </div>

           <input type="hidden" name="old_currency_rate" class="orig-exchange-rate" value="" step=".000000001">

                <input type="hidden" name="main_currency_id" value="{{$main_currency->id}}">

                     <input type="hidden" name="main_currency_rate" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">



        </div>

{{--   <div class="col-md-4" style="display: none;">
                            {!! PackagesForm::select('item_type','ERP::attributes.financials.commission_type', __('ERP::attributes.financials.commission_types'),false,null, ['class' => 'commission-types'], 'select2') !!}
                         </div> --}}

                       </div>

            <div class="fom-user-row row" style="display: none;">
                <div class="col-md-3">
                  {!! PackagesForm::select('from_account_cat_id','ERP::attributes.financials.from_account_type',\ERP::getCategoriesByType('financial_accounts'),true,null, ['id' => 'from_cat_accounts','class' => 'get-category-accounts', 'data-select_accounts' => '#fin_from_account_id', 'data-select_users' => '#from_user_id'],'select2') !!}
                </div>
                        <div class="col-md-3" >
                            {!! PackagesForm::select('from_user_id','ERP::attributes.financials.from_user', \ERP::getUsersList(),false,null, ['id' => 'from_user_id', 'class' => 'get-user-accounts-list','data-select_accounts' => '#fin_from_account_id', 'data-select_cats' => '#from_cat_accounts'], 'select2') !!}
                         </div>

                          <div class="col-md-3">
                            {!! PackagesForm::select('from_account_id','ERP::attributes.financials.from_account', [],false,null, ['id' => 'fin_from_account_id','class' => 'get-account-balance','data-math_type' => 'plus', 'data-total_input' => '#total_from_account'], 'select2') !!}
                         </div>

                         <div class="col-md-3" >
                    

                       {!! PackagesForm::number('value_after_withdrawal', 'ERP::attributes.financials.account_value_after_withdrawal',true, null, ['step'=> ".01", 'placeholder' => '0.00', 'class' => 'balance_input', 'readonly','id' => 'total_from_account'] ) !!}

                    
                       <p class="not_enough_balance_text" style="display: none;"> <small style="color: red;"> {{__('ERP::attributes.financials.account_value_not_enough')}} </small> </p>
                           
                           </div>
                            
                        </div>

              <div class="to-user-row row" style="display: none;">
                <div class="col-md-3">
                  {!! PackagesForm::select('to_account_cat_id','ERP::attributes.financials.to_account_type',\ERP::getCategoriesByType('financial_accounts'),true,null, ['id' => 'to_cat_accounts','class' => 'get-category-accounts', 'data-select_accounts' => '#fin_to_account_id', 'data-select_users' => '#from_user_id'],'select2') !!}
                </div>
                        <div class="col-md-3" >
                            {!! PackagesForm::select('to_user_id','ERP::attributes.financials.to_user', \ERP::getUsersList(),false,null, ['id' => 'to_user_id', 'class' => 'get-user-accounts-list','data-select_accounts' => '#fin_to_account_id', 'data-select_cats' => '#to_cat_accounts'], 'select2') !!}
                         </div>

                          <div class="col-md-3">
                            {!! PackagesForm::select('to_account_id','ERP::attributes.financials.to_account', [],false,null, ['id' => 'fin_to_account_id','class' => 'get-account-balance','data-math_type' => 'plus', 'data-total_input' => '#total_to_account'], 'select2') !!}
                         </div>

                         <div class="col-md-3" >
                       

                       {!! PackagesForm::number('value_after_deposit', 'ERP::attributes.financials.account_value_after_deposit',true, null, ['step'=> ".01", 'placeholder' => '0.00', 'class' => 'balance_input', 'readonly','id' => 'total_to_account'] ) !!}

                    
                       <p class="not_enough_balance_text" style="display: none;"> <small style="color: red;"> {{__('ERP::attributes.financials.account_value_not_enough')}} </small> </p>
                          
                            
                        </div>
                    
                    </div>
                    <div class="row">
                                              <div class="col-md-3">
                          {!! PackagesForm::text('fees_percent','ERP::attributes.main.fees_percent',false,null) !!}
                        </div>

                        <div class="col-md-3">
                          {!! PackagesForm::text('payment_date','ERP::attributes.main.payment_date',false,null,['class' => 'datepicker']) !!}
                         </div> 
                                                               <div class="col-md-3">
                  {!! PackagesForm::select('pay_method_id','ERP::attributes.financials.payment_method',\ERP::getCategoriesByType('payment_methods'),true,null,[],'select2') !!}
                </div>
                 <div class="col-md-3">
                          {!! PackagesForm::select('staff_id','ERP::attributes.financials.staff_supervisor',\ERP::getEmployeesList(),true,null, [], 'select2') !!}
                        </div> 
                    </div>
                    <div class="row">


              

                         <div class="col-md-3">
                          {!! PackagesForm::text('reg_code','ERP::attributes.main.reg_code',$financial->exists?true:false,null) !!}
                         </div>
                        <div class="col-md-3">
                          {!! PackagesForm::text('refrence_code','ERP::attributes.financials.refrence_no',false,null) !!}
                         </div>
                                                 <div class="col-md-3">
                          {!! PackagesForm::select('status','ERP::attributes.main.status',__('ERP::attributes.main.int_status_options'),true,null) !!}
                        </div>   

                    </div>



                    <hr>

                  

                        {{-- translation row --}}
                    <div class="row"> 
                      <div class="col-md-12"> 
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
                         

                        {!! PackagesForm::textarea('description['.$code.']',trans('ERP::attributes.main.description'),false) !!}
                        {!! PackagesForm::textarea('notes['.$code.']','ERP::attributes.main.note',false) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                  </div>
                    </div> {{-- end translation row --}}
               
                     
                    </div>
                     
                </div>
                


                {!! PackagesForm::customFields($financial) !!}

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
<script type="text/javascript">
  $('body').on('change', '.financial-types', function() {
  var type = $(this).val();

  if(type == 'transfer'){
     $('.fom-user-row').show();
     $('.to-user-row').show();
  }else if(type == 'withdrawal' || type == 'refund'){
    $('.to-user-row').hide();
    $('.fom-user-row').show();

 }else if(type == ''){
    $('.to-user-row').hide();
    $('.fom-user-row').hide();
  }else{

    $('.to-user-row').show();
    $('.fom-user-row').hide();

    

  }

});
</script>
<script type="text/javascript">
      $(document).ready(function () {

        $('body').on('change', '.get-currency-rate', function(){

            var currencyId = $(this).val();
            var currentCurrencyRate = $('option:selected', this).data('rate');
            $(this).closest('.row').find('.mod-exchange-rate').val(currentCurrencyRate);
            $(this).closest('.row').find('.orig-exchange-rate').val(currentCurrencyRate)
        });

        });
</script>

<script type="text/javascript">
      $(document).ready(function () {

        $('body').on('change', '.get-category-accounts', function(){

            var cat_id = $(this).val();
            var select_accounts = $(this).data('select_accounts');
            var select_users = $(this).data('select_users')
            var user_id = $(select_users).val();

                $(select_accounts).html('');

            $.ajax({
            method: 'GET',
            url: '/erp/ajax/accounts/get-category-accounts?cat_id='+cat_id+'&user_id='+user_id,

            success: function (result) {

              if(result.success){
                var list = result.list;

                for (var key in list) {
                  if (list.hasOwnProperty(key)) {

                    $(select_accounts).append(new Option(list[key], key));
                 
                  }
                 }
              getAccountBalance(select_accounts);

              }else{
                alert(result.message);

               }
            },

            error: function (result) {
                alert('An error occurred.');

            },
    });
            

        });

        });
</script>

<script type="text/javascript">
      $(document).ready(function () {

        $('body').on('change', '.get-user-accounts-list', function(){

            var user_id = $(this).val();
            var select_accounts = $(this).data('select_accounts');
            var select_cats = $(this).data('select_cats')
            var cat_id = $(select_cats).val();

                $(select_accounts).html('');

            $.ajax({
            method: 'GET',
            url: '/erp/ajax/accounts/get-category-accounts?user_id='+user_id+'&cat_id='+cat_id,

            success: function (result) {

              if(result.success){
                var list = result.list;

                for (var key in list) {
                  if (list.hasOwnProperty(key)) {

                    $(select_accounts).append(new Option(list[key], key));
                 
                  }
                 }
                 getAccountBalance(select_accounts);
              }else{
                alert(result.message);

               }
            },

            error: function (result) {
                alert('An error occurred.');

            },
    });
            

        });

        });
</script>

<script type="text/javascript">
  function getNumber(number, defaultNumber = 0) {
    return isNaN(Number(number)) ? defaultNumber : Number(number);
}
  function getAccountBalance(selector) {
                var account_id = $(selector).val();
            var math_type = $(selector).data('math_type');
            var total_input = $(selector).data('total_input');
            var amount = $('#financial_value').val();

                $(total_input).val(0.0);

            $.ajax({
            method: 'GET',
            url: '/erp/ajax/accounts/get-account-balance?account_id='+account_id,

            success: function (result) {

              if(result.success){
                var balance = result.balance;

                if(math_type == 'plus'){

                  $newValue = getNumber(amount) + getNumber(balance);

                }else{
                   $newValue = getNumber(balance) - getNumber(amount);

                   if($newValue < 0){
                     alert('Account balance not enough to countinue in this process.');
                   }
                }

           $(total_input).val($newValue);

              }else{
                alert(result.message);

               }
            },

            error: function (result) {
                alert('An error occurred.');

            },
    });
}



      $(document).ready(function () {

        $('body').on('change', '.get-account-balance', function(){
               getAccountBalance(this);

          
        });

        });
</script>

{{-- <script type="text/javascript">
  $('body').on('change', '.get-user-accounts-list', function() {
    var thisDiv = $(this);
  var user = $(this).val();
  var otherDiv = $(this).data('other_div');
  var otherList = $(this).data('other_list');
  var selector = $(this).closest('.row').find('.'+otherList);
  var data = {'name': selector.attr('name'), 'label': selector.data('label'), 'required': false, 'selected': '', 'select2': 'select2', 'class': otherList , 'math_type' : selector.data('math_type')};

    $.ajax({
            method: 'GET',
            data: $.param(data),
            url: '/erp/financials/ajax/'+ user +'/get_user_accounts',
           
            success: function (result) {


              $('#'+otherDiv).html(result.data);

              thisDiv.closest('.row').find('.balance_input').val(parseFloat(0).toFixed(2));


            },

            error: function (result) {
                alert('An error occurred.');

            },
    });

});
</script>

<script type="text/javascript">
  $( function() {
  $('body').on('change', '.get_accoun_value', function() {

    var new_balance = 0.00;


     var balance = $('option:selected', this).data('balance');
    var balanceInput = $(this).closest('.row').find('.balance_input');
     //check balance value
    if(typeof balance !== 'undefined' ){ 

      var mathType = $(this).data('math_type');

  var financialValueInput = $('#financial_value');
   var financialValue = financialValueInput.val();

  if(financialValueInput.val() == ''){
    var financialValue = 0.00;
  }

 if(balance === 'null'){
  balance = 0.00
  }
      if(mathType == 'plus'){

       new_balance = parseFloat(balance) + parseFloat(financialValue);
        
      }else{
        new_balance = parseFloat(balance) - parseFloat(financialValue);
      } //end check math type
   
    } //end check balance value


    balanceInput.val(new_balance.toFixed(2));


           if(new_balance < 0){
      alert('{{__('ERP::attributes.financials.must_value_not_bigger_than')}} ['+balance+'] ');
    }


  

});
  });
</script>


<script type="text/javascript">
  
  $( function() {
  $('body').on('keyup', '#financial_value', function() {

    var financialValue = $(this).val();

    if(financialValue == ''){
      financialValue = 0.00;
    }

    $('.get_accoun_value').each(function() {

    var new_balance = 0.00;


     var balance = $('option:selected', this).data('balance');
    var balanceInput = $(this).closest('.row').find('.balance_input');
     //check balance value
    if(typeof balance !== 'undefined' ){ 

      var mathType = $(this).data('math_type');


 if(balance === 'null'){
  balance = 0.00
  }
      if(mathType == 'plus'){

       new_balance = parseFloat(balance) + parseFloat(financialValue);
        
      }else{
        new_balance = parseFloat(balance) - parseFloat(financialValue);
      } //end check math type
   
    } //end check balance value




    balanceInput.val(new_balance.toFixed(2));

        if(new_balance < 0){
       alert('{{__('ERP::attributes.financials.must_value_not_bigger_than')}}');
    }
     
     });

   

 });
});
</script> --}}

@endsection