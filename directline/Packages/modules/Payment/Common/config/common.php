<?php


return [
    'resource_url' => 'payments',
    'models' => [
        'invoice' => [
            'presenter' => \Packages\Modules\Payment\Common\Transformers\InvoicePresenter::class,
            'resource_url' => 'invoices',
            'statuses' => [
                'paid' => 'Payment::attributes.invoice.invoice_option.paid',
                'failed' => 'Payment::attributes.invoice.invoice_option.failed',
                'pending' => 'Payment::attributes.invoice.invoice_option.pending'
            ]
        ],
        'webhook_call' => [
            'presenter' => \Packages\Modules\Payment\Common\Transformers\WebhookCallPresenter::class,
            'resource_url' => 'webhook-calls',
        ],
        'tax_class' => [
            'presenter' => \Packages\Modules\Payment\Common\Transformers\TaxClassPresenter::class,
            'resource_url' => 'tax/tax-classes',
        ],
        'tax' => [
            'presenter' => \Packages\Modules\Payment\Common\Transformers\TaxPresenter::class,
            'resource_route' => 'tax-classes.taxes.index',
        ],
        'currency' => [
           'presenter' => \Packages\Modules\Payment\Common\Transformers\CurrencyPresenter::class,
           'resource_url' => 'currencies'
        ],
    ]
];

