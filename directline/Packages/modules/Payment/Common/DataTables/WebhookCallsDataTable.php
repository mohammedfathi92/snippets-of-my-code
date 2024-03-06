<?php

namespace Packages\Modules\Payment\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\Payment\Models\WebhookCall;
use Packages\Modules\Payment\Common\Transformers\WebhookCallTransformer;
use Yajra\DataTables\EloquentDataTable;

class WebhookCallsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('payment_common.models.webhook_call.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new WebhookCallTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param WebhookCall $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(WebhookCall $model)
    {
        return $model->newQuery();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id' => ['visible' => false],
            'event_name' => ['title' => trans('Payment::attributes.webhook_call.event_name')],
            'payload' => ['title' => trans('Payment::attributes.webhook_call.payload')],
            'exception' => ['title' => trans('Payment::attributes.webhook_call.exception')],
            'gateway' => ['title' => trans('Payment::attributes.webhook_call.gateway')],
            'processed' => ['title' => trans('Payment::attributes.webhook_call.processed')],
            'created_at' => ['title' => trans('Packages::attributes.created_at')]
        ];
    }

    protected function getOptions()
    {
        return ['has_action' => false];
    }
}
