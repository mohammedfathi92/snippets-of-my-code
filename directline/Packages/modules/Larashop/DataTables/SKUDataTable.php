<?php

namespace Packages\Modules\Larashop\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\Larashop\Models\SKU;
use Packages\Modules\Larashop\Transformers\SKUTransformer;
use Yajra\DataTables\EloquentDataTable;

class SKUDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('ecommerce.models.sku.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new SKUTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param SKU $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(SKU $model)
    {
        $product = $this->request->route('product');
        if (!$product) {
            abort('404');
        }

        return $model->newQuery()->where('product_id', $product->id);
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
            'image' => ['width' => '50px', 'title' => trans('Larashop::attributes.sku.image'), 'orderable' => false, 'searchable' => false],
            'code' => ['title' => trans('Larashop::attributes.sku.code')],
            'price' => ['title' => trans('Larashop::attributes.sku.price')],
            'inventory' => ['title' => trans('Larashop::attributes.sku.inventory')],
            'dt_options' => ['title' => trans('Larashop::attributes.sku.dt_options'), 'orderable' => false, 'searchable' => false],
            'status' => ['title' => trans('Packages::attributes.status')],
            'created_at' => ['title' => trans('Packages::attributes.created_at')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
        ];
    }
}
