<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Place;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\PlaceTransformer;
use Yajra\DataTables\EloquentDataTable;

class PlacesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.place.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new PlaceTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Place $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Place $model)
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
             'reg_code' => ['title' => trans('ERP::attributes.main.reg_code')],
            'name' => ['title' => trans('ERP::attributes.main.name')],
            'country_id' => ['title' => trans('ERP::attributes.hotel.country')],
            'city_id' => ['title' => trans('ERP::attributes.hotel.city')],
            'address' => ['title' => trans('ERP::attributes.hotel.address')],
            'price' => ['title' => trans('ERP::attributes.hotel.price'), 'visible' => false],
            'new_price' => ['title' => trans('ERP::attributes.hotel.new_price'), 'visible' => false],
            'season_price' => ['title' => trans('ERP::attributes.hotel.season_price'), 'visible' => false],
            'place_level' => ['title' => trans('ERP::attributes.hotel.level')],
            'category_id' => ['title' => trans('ERP::attributes.main.category')],
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

             'country_id' => ['title' => trans('ERP::attributes.hotel.country'), 'class' => ' country_filter col-md-2', 'type' => 'select2', 'options' => \ERP::getCountriesList(), 'condition' => 'like', 'active' => true],
             'city_id' => ['title' => trans('ERP::attributes.hotel.city'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => [], 'condition' => 'like', 'active' => true],

             'category_id' => ['title' => trans('ERP::attributes.main.category'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => \ERP::getCategoriesByType('places'), 'condition' => 'like', 'active' => true],
             

        
        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
