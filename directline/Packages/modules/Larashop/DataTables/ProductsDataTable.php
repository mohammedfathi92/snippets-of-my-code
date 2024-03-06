<?php

namespace Packages\Modules\Larashop\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\Larashop\Models\Product;
use Packages\Modules\Larashop\Transformers\ProductTransformer;
use Yajra\DataTables\EloquentDataTable;

class ProductsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('ecommerce.models.product.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new ProductTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Product $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Product $model)
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
            'image' => ['width' => '50px', 'title' => trans('Larashop::attributes.product.image'), 'orderable' => false, 'searchable' => false],
            'name' => ['title' => trans('Larashop::attributes.product.name')],
            'type' => ['title' => trans('Larashop::attributes.product.type')],
            'price' => ['title' => trans('Larashop::attributes.product.price'), 'orderable' => false, 'searchable' => false],
            'shippable' => ['title' => trans('Larashop::attributes.product.shippable'), 'orderable' => false, 'searchable' => false],
            'brand' => ['title' => trans('Larashop::attributes.product.brand'), 'orderable' => false, 'searchable' => false],
            'categories' => ['title' => trans('Larashop::attributes.product.categories'), 'orderable' => false, 'searchable' => false],
            'tags' => ['title' => trans('Larashop::attributes.product.tags'), 'orderable' => false, 'searchable' => false, 'width' => '5%'],
            'status' => ['title' => trans('Packages::attributes.status')],
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],
        ];
    }

    protected function getFilters()
    {
        return [
            'name' => ['title' => trans('Larashop::attributes.product.title_name'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'description' => ['title' => trans('Larashop::attributes.product.description'), 'class' => 'col-md-3', 'type' => 'text', 'condition' => 'like', 'active' => true],
            'brand.id' => ['title' =>  trans('Larashop::attributes.product.brand'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => \Larashop::getBrandsList(), 'active' => true],
            'status' => ['title' => trans('Larashop::attributes.product.status_product'), 'class' => 'col-md-2', 'checked_value' => 'active', 'type' => 'boolean', 'active' => true],
        ];
    }
}
