<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Room;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\MenuRoomTransformer;
use Yajra\DataTables\EloquentDataTable;

class MenuRoomsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.room.resource_route'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new MenuRoomTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Category $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */

     public function query(Room $model)
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
            'hotel' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.hotel.hotel')],
            'price' => ['title' => trans('ERP::attributes.hotel.price')],
           
            'breakfast' => ['title' => trans('ERP::attributes.hotel.breakfast')],
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
            'price' => ['title' => trans('ERP::attributes.hotel.price'), 'class' => 'col-md-2', 'type' => 'number', 'condition' => 'like', 'active' => true],
             'hotel_id' => ['title' => trans('ERP::attributes.hotel.hotel'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getHotelsList(), 'condition' => 'like', 'active' => true],

        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
