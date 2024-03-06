<?php

namespace Corsata\Helpers\Developnet;


use Illuminate\Support\Facades\DB;
use Swap\Laravel\Facades\Swap;
use Session;
 
class Currency {
    /**
     * @param int $value
     * 
     * @return string
     */
    public static function convert ($value) {

        $currency = Session::get('currencyCode')?:"USD";
        $currencyRate = Swap::latest('USD/'.$currency)->getValue();
        $amount = intval($currencyRate * $value);
        
         
        return ($amount);
    }
}