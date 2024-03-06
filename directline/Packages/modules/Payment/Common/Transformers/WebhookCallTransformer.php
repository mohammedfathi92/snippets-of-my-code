<?php

namespace Packages\Modules\Payment\Common\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\Payment\Models\WebhookCall;

class webhookCallTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('payment_common.models.webhook_call.resource_url');

        parent::__construct();
    }

    /**
     * @param WebhookCall $webhookCall
     * @return array
     * @throws \Throwable
     */
    public function transform(WebhookCall $webhookCall)
    {
        $hide_actions = ['edit' => '', 'delete' => ''];

        return [
            'id' => $webhookCall->id,
            'event_name' => $webhookCall->event_name,
            'payload' => generatePopover($webhookCall->getOriginal('payload')),
            'exception' => $webhookCall->exception ? generatePopover($webhookCall->getOriginal('exception')) : '-',
            'gateway' => $webhookCall->gateway,
            'processed' => $webhookCall->processed ? '<i class="fa fa-check text-success"></i>' : '-',
            'created_at' => format_date($webhookCall->created_at),
            'updated_at' => format_date($webhookCall->updated_at),
            'action' => $this->actions($webhookCall, $hide_actions)
        ];
    }
}