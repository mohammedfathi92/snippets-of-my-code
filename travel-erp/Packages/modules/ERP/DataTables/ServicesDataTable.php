<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Service;
use Packages\Modules\ERP\Transformers\ServiceTransformer;
use Yajra\DataTables\EloquentDataTable;

class ServicesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.service.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new ServiceTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Service $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Service $model)
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
            'name' => ['title' => trans('ERP::attributes.main.name')],
             'reg_code' => ['title' => trans('ERP::attributes.main.reg_code')],
 'email' => ['title' => trans('ERP::attributes.hotel.email')],
             'primary_phone' => ['title' => trans('ERP::attributes.main.primary_phone')],

           'phone_one' => ['visible' => false,'title' => trans('ERP::attributes.main.phone_one')],
            'phone_two' => ['visible' => false,'title' => trans('ERP::attributes.main.phone_two')],
            'website_link' => ['visible' => false,'title' => trans('ERP::attributes.main.website_link')],
            // 'rooms_num' => ['title' => trans('ERP::attributes.hotel.rooms_num')],
             'created_by' => ['title' => trans('ERP::attributes.main.created_by'), 'visible' => false],
            'updated_by' => ['title' => trans('ERP::attributes.main.updated_by'), 'visible' => false],
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
            'status'          =>['title' => trans('Packages::attributes.status')],
        ];

    }

    protected function getFilters()
    {
        return [
            'name[*]' => ['title' => trans('ERP::attributes.main.name'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'email'   => ['title' => trans('ERP::attributes.main.email'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'primary_phone'   => ['title' => trans('ERP::attributes.main.primary_phone'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'reg_code' => ['title' => trans('ERP::attributes.main.reg_code'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
        
        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
    
}
