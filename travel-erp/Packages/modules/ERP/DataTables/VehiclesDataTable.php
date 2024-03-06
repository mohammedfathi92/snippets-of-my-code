<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Vehicle;
use Packages\Modules\ERP\Transformers\VehicleTransformer;
use Yajra\DataTables\EloquentDataTable;

class VehiclesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.vehicle.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new VehicleTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Vehicle $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Vehicle $model)
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
            'category_id' => ['title' => trans('ERP::attributes.main.vehicle_type')],
            'country_id' => ['title' => trans('ERP::attributes.hotel.country')],
            'driver_id' => ['title' => trans('ERP::attributes.main.driver')],
            'vehicle_number' => ['title' => trans('ERP::attributes.vehicles.vehicle_number')],
            'vehicle_model' => ['title' => trans('ERP::attributes.vehicles.vehicle_model')],
             'model_year' => ['title' => trans('ERP::attributes.vehicles.model_year')],

           'created_by' => ['title' => trans('ERP::attributes.main.created_by'), 'visible' => false],
            'updated_by' => ['title' => trans('ERP::attributes.main.updated_by'), 'visible' => false],

            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],

             'status'  =>['title' => trans('Packages::attributes.status')],


        ];
    }


    // protected function getFilters()
    // {
    //     return [
            
    //         'name[*]' => ['title' => trans('ERP::attributes.main.name'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],

    //     ];
    // }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
