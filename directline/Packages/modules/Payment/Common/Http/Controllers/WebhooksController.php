<?php

namespace Packages\Modules\Payment\Common\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Packages\Modules\Payment\DataTables\WebhookCallsDataTable;

class WebhooksController extends BaseController
{
    public function __construct()
    {
        $this->Packages_middleware_except = ['__invoke'];
        parent::__construct();

    }

    public function __invoke(Request $request, $gateway)
    {
        $handler = config('payment_' . strtolower($gateway) . '.webhook_handler');

        if ($handler) {
            $handler::webhookHandler($request);
        }
    }

    public function webhookCalls(Request $request, WebhookCallsDataTable $dataTable)
    {
        if (!user()->hasPermissionTo('Payment::webhook.view')) {
            abort(403);
        }

        $this->setViewSharedData([
            'title' => trans('Payment::module.webhook.title'),
            'hide_sidebar' => false
        ]);

        return $dataTable->render('Payment::webhook_calls');
    }
}