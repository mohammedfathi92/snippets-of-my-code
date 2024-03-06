<?php

namespace Packages\Modules\Payment\Classes;


use Packages\Modules\Payment\Models\TaxClass;
use Money\Currencies\ISOCurrencies;
use Money\Currency;


class Payments
{
    /**
     * Products constructor.
     */
    function __construct()
    {
    }

    public function getCodeList(){
        $codes = \Packages\Modules\Payment\Models\Currency::pluck('code','code');
        return $codes;
    }

    public function getAvailableGateways()
    {
        $supported_gateways = \Settings::get('supported_payment_gateway', []);
        return $supported_gateways;
    }

    public function setAvailableGateways($supported_gateways)
    {
        \Settings::set('supported_payment_gateway', json_encode($supported_gateways));

    }


    public function isGatewaySupported($gateway)
    {
        return array_key_exists($gateway, $this->getAvailableGateways());
    }


    public function getTaxClassesList()
    {
        return TaxClass::orderBy('name')->pluck('name', 'id')->toArray();
    }


    /**
     * @param $taxable
     * @param array $address
     * @return array
     * @throws \Exception
     */
    public function calculateTax($taxable, $address = [])
    {
        try {
            $taxes = [];
            foreach ($taxable->tax_classes as $tax_class) {
                //$tax_included = $taxable->tax_inclusive;
                $class_taxes = $tax_class->getTaxByPriority();
                $rate = 0;
                $applied_country = [];
                $applied_state = [];
                $applied_zip = [];
                $state = strtolower($address['state']);
                foreach ($class_taxes as $tax) {


                    $calculate = false;
                    if ($tax->country == '' && !isset($applied_country[$tax->name])) {
                        $calculate = true;
                        $applied_country[$tax->name] = $tax->rate;

                    } else if ($tax->country == $address['country'] && !isset($applied_country[$tax->name])) {

                        if ($tax->state == $state && !isset($applied_state[$tax->name])) {
                            if (($tax->zip == $address['zip'] || $tax->zip == "") && !isset($applied_zip[$tax->name])) {
                                $calculate = true;
                                $applied_country[$tax->name] = $tax->rate;
                                $applied_state[$tax->name] = $tax->rate;
                                $applied_zip[$tax->name] = $tax->rate;
                            }
                        } else if ($tax->state == '' && !isset($applied_state[$tax->name])) {
                            $calculate = true;
                            $applied_country[$tax->name] = $tax->rate;
                            $applied_state[$tax->name] = $tax->rate;
                            $applied_zip[$tax->name] = $tax->rate;
                        }
                    }
                    if ($calculate) {
                        if ($tax->compound == 1) {
                            $rate += $tax->rate;
                            $taxes[$tax->id] = ['name' => $tax->name, 'rate' => ($rate / 100)];
                        } else {
                            $taxes[$tax->id] = ['name' => $tax->name, 'rate' => ($tax->rate / 100)];
                        }
                    }
                }

            }
            return $taxes;
        } catch (\Exception $ex) {
            throw new \Exception(trans('Payment::exception.tax.error_calculating_tax', ['message' => $ex->getMessage()]));
        }
    }

    function currency($amount, $currency = null)
    {
        if (is_null($amount)) {
            $amount = 0;
        }

        if ($currency) {
            return currency()->format($amount, $currency);
        }

        return currency($amount, \Settings::get('admin_currency_code', 'USD'), $this->session_currency());
    }

    function session_currency()
    {
        return currency()->getUserCurrency();
    }

    function currency_convert($amount, $from = null, $to = null, $format = true)
    {
        if ($from == $to) {
            return $amount;
        }
        if (!$from) {
            $from = \Settings::get('admin_currency_code', 'USD');
        }
        if (!$to) {
            $to = $this->session_currency();
        }
        $conversion = currency()->convert($amount, $from, $to, $format);
        $iso_currencies = new ISOCurrencies();
        $currency = new Currency($to);
        if ($currency) {
            $decimals = $iso_currencies->subunitFor($currency);
            return number_format((float)$conversion, $decimals, '.', '');
        } else {
            return $conversion;
        }

    }

    function admin_currency($amount)
    {
        return currency()->format($amount, \Settings::get('admin_currency_code', 'USD'));
    }

    function getActiveCurrenciesList()
    {
        $currencies = currency()->getActiveCurrencies();
        $active_currencies = [];
        foreach ($currencies as $currency) {
            $active_currencies[$currency['code']] = $currency['code'] . " " . $currency['symbol'];
        }
        return $active_currencies;
    }

}