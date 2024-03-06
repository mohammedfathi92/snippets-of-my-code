<?php
/**
 * Created by PhpStorm.
 * User: DevelopNet
 * Date: 7/15/18
 * Time: 8:45 AM
 */

namespace Modules\Components\LMS\DataTables;

use Modules\Foundation\DataTables\BaseDataTable;
use Modules\Components\LMS\Models\Certificate;
use Modules\Components\LMS\Transformers\CertificateTransformer;
use Yajra\DataTables\EloquentDataTable;

class CertificatesDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('lms.models.certificate.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new CertificateTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Certificate $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Certificate $model)
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
            'id'        => ['visible' => false],
            'thumbnail' => ['title' => trans('LMS::attributes.main.thumbnail'), 'searchable' => false, 'orderable' => false],
           
            'title'     => ['title' => trans('LMS::attributes.main.title')],


             'status'       =>['title'=> trans('LMS::attributes.main.status')],
             'updated_at' => ['title' => trans('LMS::attributes.main.updated_at')],

        ];
    }
}
