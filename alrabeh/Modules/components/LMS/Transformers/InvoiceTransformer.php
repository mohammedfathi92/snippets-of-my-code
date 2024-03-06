<?php

namespace Modules\Components\LMS\Transformers;


use Modules\Foundation\Transformers\BaseTransformer;
use Modules\Components\LMS\Models\Invoice;


class InvoiceTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('lms.models.invoice.resource_url');

        parent::__construct();
    }

    /**
     * @param Invoice $invoice
     * @return array
     * @throws \Throwable
     */
    public function transform(Invoice $invoice)
    {
     $actions = ['edit' => '', 'delete' => ''];

        if (user()->hasPermissionTo('LMS::invoice.update')) {
            $actions['change_status'] = [
                'icon' => 'fa fa-fw fa-edit',
                'href' => url($this->resource_url . '/' . $invoice->hashed_id . '/change_status'),
                'label' => trans('LMS::attributes.invoices.show_invoice'),
                'class' => 'modal-load',
                'data' => [
                    'title' => trans('LMS::attributes.invoices.update_invoice', ['code' => $invoice->code])
                ]

            ];
        }

         $status_options = [
                    'paid' => __('LMS::attributes.invoices.paid'),
                    'pending' => __('LMS::attributes.invoices.pending'),
                    'cancelled' => __('LMS::attributes.invoices.cancelled'),
                  ];

        $show_url = url($this->resource_url . '/' . $invoice->hashed_id);
        return [
            'id'           => $invoice->id,
            'user_id' => $invoice->user->name,
            'code'  => $invoice->code,
            'total_price'        => $invoice->total_price,
            'status' => __('LMS::attributes.invoices.'.$invoice->status),
            'created_at'   => format_date($invoice->updated_at),
            // 'updated_at'   => format_date($invoice->updated_at),
            'action'       => $this->actions($invoice, $actions)
        ];
    }
}