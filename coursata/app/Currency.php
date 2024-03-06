<?php

namespace Corsata;

use Illuminate\Database\Eloquent\Model;
use Swap\Laravel\Facades\Swap;

class Currency extends Model
{
    protected $table = 'currencies';
    protected $fillable = ['name', 'code', 'symbol_left', 'symbol_right', 'value', 'decimal_place', 'status'];

    function updateRates()
    {
        $currencies = $this->where('status', 1)->get();
        $base = strtoupper(config('settings.base_currency') ?: "USD");
        $updated = 0;
        if ($currencies) {

            foreach ($currencies as $currency) {
                $rate = Swap::latest("$currency->code/$base");
                $value = $rate->getValue();

//                if ($value && round($value, 4) != round($currency->value, 4)) {
                if ($value && $value != $currency->value) {
                    // update currency with a new rate.

                    $currency->value = $value;
                    $save = $currency->save();
                    if ($save) {
                        $updated++;
                    }

                }
            }
            return $updated;
        }

        return false;
    }

    function scopePublished()
    {
        return $this->whereStatus(true);
    }
}
