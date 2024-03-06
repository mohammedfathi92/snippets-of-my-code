<?php

namespace Packages\Modules\Payment\Cash\Providers;

use Packages\Foundation\Providers\BaseUninstallModuleServiceProvider;
use Packages\Settings\Models\Setting;
use Packages\User\Models\User;

class UninstallModuleServiceProvider extends BaseUninstallModuleServiceProvider
{
    protected function booted()
    {
        $supported_gateways = \Settings::get('supported_payment_gateway', []);

        if (is_array($supported_gateways)) {
            unset($supported_gateways['Cash']);
        }

        \Settings::set('supported_payment_gateway', json_encode($supported_gateways));

        Setting::where('code', 'like', 'payment_cash%')->delete();

        User::where('gateway', 'Cash')->update(['gateway' => NULL]);
    }
}
