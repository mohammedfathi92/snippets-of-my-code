@extends('layouts.crud.create_edit')

@section('css')
@endsection

@section('content_header')
    @component('components.content_header')
        @slot('page_title')
            {{ $title_singular }}
        @endslot
        @slot('breadcrumb')
            {{ Breadcrumbs::render('expense_create_edit') }}
        @endslot
    @endcomponent
@endsection

@section('content')
@php
$main_currency = getMainCurrency();
@endphp
    <div class="row">

        <div class="col-md-9">
            @component('components.box')
                {!! Form::model($expense, ['url' => url($resource_url.'/'.$expense->hashed_id),'method'=>$expense->exists?'PUT':'POST','files'=>true,'class'=>'ajax-form']) !!}

                <div class="row form-group">
                    <div class="col-md-10 col-md-offset-1">
                      <div class="row">

                         <div class="col-md-4">
                          {!! PackagesForm::text('paid_at','ERP::attributes.main.payment_date',true,null,['class' => 'datepicker']) !!}
                         </div> 

                        <div class="col-md-4">
                          {!! PackagesForm::number('total_amount', 'ERP::attributes.financials.value',true, null, ['step'=> ".01", 'placeholder' => '0.00'] ) !!}

                        </div>

                <div class="col-md-4">
                  {!! PackagesForm::select('category_id','ERP::attributes.expenses.category',\ERP::getCategoriesByType('expenses'),true,null, [],'select2') !!}
                </div>
              </div> {{-- end row --}}
           <div class="row">
                <div class="col-md-4">
                  {!! PackagesForm::select('pay_method_id','ERP::attributes.financials.payment_method',\ERP::getCategoriesByType('payment_methods'),true,null,[],'select2') !!}
                </div>
            <div class="form-group col-md-4 required-field">
            <label for="row_payment_value_currency_id">{{__('ERP::attributes.main.currency')}}</label>
               <select class="form-control with-select2 get-currency-rate" id="row_payment_value_currency_id" name="value_currency_id">


             <option value="">{{__('ERP::attributes.main.select_new_option')}}</option>
             @foreach(\ERP::getCurrenciesData() as $row)
              <option value="{{$row->id}}" data-rate="{{rateForAnyCurrency($row->exchange_rate, $main_currency->exchange_rate)}}" @if($row->id == $expense->value_currency_id) selected="" @endif>{{$row->name}}</option>
              @endforeach
            </select>
        </div>

          <div class="form-group col-md-4 required-field">
                   <label for="row_payment_value_currency_rate">{{__('ERP::attributes.order.currency_rate')}}</label>
              <input id="row_payment_value_currency_rate" type="number" name="value_currency_rate" placeholder="00.00" class="form-control mod-exchange-rate" step=".000000001" value="{{$expense->value_currency_rate}}">
          </div>

           <input type="hidden" name="old_currency_rate" class="orig-exchange-rate" value="" step=".000000001"  value="{{$expense->old_currency_rate}}">

                <input type="hidden" name="main_currency_id" value="{{$main_currency->id}}">

                     <input type="hidden" name="main_currency_rate" value="{{$main_currency->exchange_rate}}" class="main-currency-rate" step=".000000001">



        </div>
        <div class="row">
                              <div class="col-md-4">

                             {!! PackagesForm::select('modulable_id','ERP::attributes.expenses.for_order',\ERP::getCurrentInProgressOrders(),false,null,[],'select2') !!}
                         
                         </div>
                <div class="col-md-4">
                  {!! PackagesForm::text('fees_percent','ERP::attributes.expenses.tax') !!}
                </div>
                    <div class="col-md-4">
                         <div style="display: inline-flex;">
                            {!! PackagesForm::number('repeated_duration', 'ERP::attributes.expenses.repeated_times',false, null, ['step'=> ".01", 'placeholder' => '0.00'] ) !!}
                             {!! PackagesForm::select('repeated_unit_durations','ERP::attributes.expenses.repeated_duration_unite',__('ERP::attributes.expenses.duration_units_typs'),false,null) !!}
                         
                         </div>
                         </div>
        </div>





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
                         

                        {!! PackagesForm::text('name['.$code.']',trans('ERP::attributes.main.name'),false,$expense->getTranslation('name', $code)) !!}
                        {!! PackagesForm::textarea('notes['.$code.']','ERP::attributes.main.notes',false,$expense->getTranslation('notes', $code)) !!}
                        
                      </div>

                      @endforeach

                      </div>
                    </div>
                    @endif
                  </div>
                    </div> {{-- end translation row --}}
               
                     
                    </div>
                     
                </div>
                



            @endcomponent
        </div>
                <div class="col-md-3">
            @component('components.box')
            <div class="row">
                         <div class="col-md-12">
                           @if($expense->hasMedia('erp-receipt-image'))
                          <div>
                            <img src="{{ $expense->receipt_image }}" class="img-responsive" 
                             alt="receipt image" style="max-width: 100%; max-height: 250px">
                          </div>
                          {!! PackagesForm::checkbox('clear_passport',  'ERP::attributes.main.clear_picture' ) !!}
                          @endif
                          <div>
                          {!! PackagesForm::file('receipt_image', 'ERP::attributes.expenses.attach_receipt') !!}
                         
                          </div> 
                            
                        </div>

                                        <div class="col-md-12">
                  {!! PackagesForm::select('paid_by_id','ERP::attributes.expenses.paid_by',\ERP::getStaffList(),true,null,[],'select2') !!}
                </div>

                         <div class="col-md-12">
                          {!! PackagesForm::text('reg_code','ERP::attributes.main.reg_code',$expense->exists?true:false,null) !!}
                         </div>
      


                                                   <div class="col-md-12">
                          {!! PackagesForm::select('status','ERP::attributes.main.status',__('ERP::attributes.main.int_status_options'),true,null) !!}
                        </div> 
            </div>
             @endcomponent
           </div>

    </div>
    <div class="row">
    
     <div class="col-md-9">
       @component('components.box')

                      {!! PackagesForm::customFields($expense) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! PackagesForm::formButtons() !!}
                    </div>
                </div>
                  @endcomponent
                </div>
                </div>
               
                
    {!! Form::close() !!}
 
   

@endsection

@section('js')
<script type="text/javascript">
  $('body').on('change', '.expense-types', function() {
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
            var amount = $('#expense_value').val();

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
            url: '/erp/expenses/ajax/'+ user +'/get_user_accounts',
           
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

  var expenseValueInput = $('#expense_value');
   var expenseValue = expenseValueInput.val();

  if(expenseValueInput.val() == ''){
    var expenseValue = 0.00;
  }

 if(balance === 'null'){
  balance = 0.00
  }
      if(mathType == 'plus'){

       new_balance = parseFloat(balance) + parseFloat(expenseValue);
        
      }else{
        new_balance = parseFloat(balance) - parseFloat(expenseValue);
      } //end check math type
   
    } //end check balance value


    balanceInput.val(new_balance.toFixed(2));


           if(new_balance < 0){
      alert('{{__('ERP::attributes.expenses.must_value_not_bigger_than')}} ['+balance+'] ');
    }


  

});
  });
</script>


<script type="text/javascript">
  
  $( function() {
  $('body').on('keyup', '#expense_value', function() {

    var expenseValue = $(this).val();

    if(expenseValue == ''){
      expenseValue = 0.00;
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

       new_balance = parseFloat(balance) + parseFloat(expenseValue);
        
      }else{
        new_balance = parseFloat(balance) - parseFloat(expenseValue);
      } //end check math type
   
    } //end check balance value




    balanceInput.val(new_balance.toFixed(2));

        if(new_balance < 0){
       alert('{{__('ERP::attributes.expenses.must_value_not_bigger_than')}}');
    }
     
     });

   

 });
});
</script> --}}

@endsection