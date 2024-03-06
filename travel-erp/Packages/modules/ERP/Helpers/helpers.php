<?php
if (!function_exists('rateForAnyCurrency')) {
    /**
     * @return mixed
     */
    function rateForAnyCurrency($fromRate, $toRate)
    {
        if(!$fromRate || !$toRate){
          return 0;
        }

        // 17.5 pound = 1 dollar

      // Dollar = $fromRate or $toRate
     //two rates based on dollar
     $fromRateForDollar = 1/($fromRate > 0?$fromRate:1);
     $fromRateForToCurrency = $fromRateForDollar*$toRate;
     return round($fromRateForToCurrency, 4);
        
    }
}

if (!function_exists('amountCurrencyChange')) {
    /**
     * @return mixed
     */
    function amountCurrencyChange($amount, $fromRate, $toRate = 1)
    {

                if(!$fromRate || !$toRate){
          return 0;
        }

      $newRate =  rateForAnyCurrency($fromRate, $toRate);
      $newAmount = $newRate * $amount;
      return $newAmount;
        
    }
}

if (!function_exists('getOrderStatusLabel')) {
    /**
     * @return mixed
     */
    function getOrderStatusLabel($status)
    {
      if($status == 0 || $status == 'pending'){

        $class = 'label-warning';
        $name = __('ERP::attributes.main.int_status_options.0');

      }elseif ($status == 1 || $status == 'active') {
        $class = 'label-success';
        $name = __('ERP::attributes.main.int_status_options.1');
      }elseif ($status == 2 || $status == 'canceled'){
        $class = 'label-danger';
        $name = __('ERP::attributes.main.int_status_options.2');

      }


      return '<span class="label '.$class.'">'.$name.'</span>';

     }
   }

   if (!function_exists('generalOrderStatusLabel')) {
    /**
     * @return mixed
     */
    function generalOrderStatusLabel($status)
    {
      if($status == 0){

        $class = 'label-warning';
        $name = __('ERP::attributes.order.order_int_status_options.0');

      }elseif ($status == 1) {
        $class = 'label-warning';
        $name = __('ERP::attributes.order.order_int_status_options.1');
      }elseif ($status == 2) {
        $class = 'label-info';
        $name = __('ERP::attributes.order.order_int_status_options.2');
      }elseif ($status == 3) {
        $class = 'label-primary';
        $name = __('ERP::attributes.order.order_int_status_options.3');
      }elseif ($status == 4) {
        $class = 'label-success';
        $name = __('ERP::attributes.order.order_int_status_options.4');
      }elseif ($status == 5) {
        $class = 'label-default';
        $name = __('ERP::attributes.order.order_int_status_options.5');
      }elseif ($status == 6) {
        $class = 'label-danger';
        $name = __('ERP::attributes.order.order_int_status_options.6');
      }elseif ($status == 7) {
        $class = '';
        $name = __('ERP::attributes.order.order_int_status_options.7');
      }




      return '<span class="label '.$class.'">'.$name.'</span>';

     }
   }

if (!function_exists('getMainCurrency')) {
    /**
     * @return mixed
     */
    function getMainCurrency()
    {
      // Dollar = mainCurrency

    $currency = \Packages\Modules\ERP\Models\Currency::where('as_main', true)->orderBy('updated_at', 'desc')->first();

    if(!$currency){
     $currency = \Packages\Modules\ERP\Models\Currency::where('code', 'USD')->first();
      

    }
     
      return $currency;
        
    }
}