<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\City;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\CityTransformer;
use Yajra\DataTables\EloquentDataTable;

class CitiesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.city.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new CityTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param City $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(City $model)
    {
        $country = $this->request->route('country');
        if (!$country) {
            abort('404');
        }

        return $model->newQuery()->where('country_id', $country->id);
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

             'country_id' => ['title' => trans('ERP::attributes.hotel.country'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCountriesList(), 'condition' => 'like', 'active' => true],

        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
 
   }

}
