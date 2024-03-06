<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Branch;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\BranchTransformer;
use Yajra\DataTables\EloquentDataTable;

class BranchesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.branch.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new BranchTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Branch $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Branch $model)
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
             'country_id' => ['title' => trans('ERP::attributes.hotel.country')],
            'city_id' => ['title' => trans('ERP::attributes.hotel.city')],
            'primary_phone' => ['title' => trans('ERP::attributes.main.primary_phone')],
            'phone_one' => ['title' => trans('ERP::attributes.main.phone_one')],
            'address' => ['visible' => false, 'title' => trans('ERP::attributes.main.address')],
            // 'notes' => ['title' => trans('ERP::attributes.main.note')],
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

            'primary_phone' => ['title' => trans('ERP::attributes.main.primary_phone'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],

            'email' => ['title' => trans('ERP::attributes.main.email'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],

             'country_id' => ['title' => trans('ERP::attributes.hotel.country'), 'class' => 'country_filter col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],
             'city_id' => ['title' => trans('ERP::attributes.hotel.city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => [], 'condition' => 'like', 'active' => true],

        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
