<?php

namespace Packages\Modules\Larashop\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\Larashop\Models\Wishlist;
use Packages\Modules\Larashop\Transformers\WishlistTransformer;
use Yajra\DataTables\EloquentDataTable;

class MyWishlistDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('ecommerce.models.wishlist.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new WishlistTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Wishlist $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Wishlist $model)
    {
        return $model->myWishlist()->newQuery();
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
            'product' => ['title' => trans('Larashop::attributes.wishlist.product')],
            'created_at' => ['title' => 'Added at']
        ];
    }

    protected function getOptions()
    {
        return ['has_action' => true];
    }
}
