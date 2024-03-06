<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Currency;

class CurrencyTransformer extends BaseTransformer
{

    public function __construct()
    {
        $this->resource_url = config('erp.models.currency.resource_url');

        parent::__construct();
    }

    /**
     * @param Currency $currency
     * @return array
     * @throws \Throwable
     */
    public function transform(Currency $currency)
    {
        return [
            'id' => $currency->id,
            'name' => $currency->name,
            'code' => $currency->code,
            'symbol' => $currency->symbol,
            'format' => $currency->format,
            'exchange_rate' => $currency->exchange_rate,
            'active' => formatStatusAsLabels($currency->active),
            'created_at' => format_date($currency->created_at),
            'updated_at' => format_date($currency->updated_at),
            'status' => formatStatusAsLabels($currency->status > 0?'active': 'inactive'),
            'action' => $this->actions($currency, ['delete' => ''])
        ];

    }

}