<?php

namespace Packages\Modules\Payment\Common\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\Payment\Common\Http\Requests\PaymentRequest;


class PaymentsController extends BaseController
{
    public function __construct()
    {
        $this->resource_url = config('payment_common.resource_url');
        $this->title = 'Payment::module.payment.title';
        $this->title_singular = 'Payment::module.payment.title_singular';

        parent::__construct();
    }

    /**
     * @param PaymentRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings(PaymentRequest $request)
    {
        $this->setViewSharedData(['title_singular' => trans('Payment::module.payment_settings.title')]);

        $settings = [];

        foreach (\Payments::getAvailableGateways() as $key => $gateway) {
            $configFile = 'payment_' . strtolower($key);
            if (config($configFile)) {
                $settings[config($configFile . '.key')] = config($configFile);
            }
        }

        return view('Payment::settings')->with(compact('settings'));
    }

    public function saveSettings(PaymentRequest $request)
    {
        try {
            $settings = $request->except('_token');

            foreach ($settings as $key => $value) {
                \Settings::set($key, $value, 'Payment');
            }

            flash(trans('Packages::messages.success.saved', ['item' => trans('Payment::module.payment_settings.title')]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, 'PaymentSettings', 'savedSettings');
        }

        return redirectTo($this->resource_url . '/settings');
    }


}