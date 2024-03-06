<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\PayAgent;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\PayAgentTransformer;
use Yajra\DataTables\EloquentDataTable;

class PayAgentsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.payagent.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new PayAgentTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param PayAgent $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(PayAgent $model)
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
             'country' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.country')],
            'name' => ['title' => trans('ERP::attributes.main.name')],
            'address' => ['title' => trans('ERP::attributes.main.address')],
            'email' => ['title' => trans('ERP::attributes.main.email')],
            'phone' => ['title' => trans('ERP::attributes.main.phone')],
            'contact_with' => ['title' => trans('ERP::attributes.main.contact_with')],
            'notes' => ['title' => trans('ERP::attributes.main.note')],
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
        ];
    }

     protected function getFilters()
    {
       return [
            
            'name[*]' => ['title' => trans('ERP::attributes.main.name'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],

             'country_id' => ['title' => trans('ERP::attributes.hotel.country'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],
             
             'email'   => ['title' => trans('ERP::attributes.main.email'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'phone'   => ['title' => trans('ERP::attributes.main.phone'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'address'   => ['title' => trans('ERP::attributes.main.address'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],


        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
