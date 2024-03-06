<?php

namespace Packages\Modules\ERP\DataTables;

use Packages\Foundation\DataTables\BaseDataTable;
use Packages\Modules\ERP\Models\Account;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Transformers\AccountTransformer;
use Yajra\DataTables\EloquentDataTable;

class AccountsDataTable extends BaseDataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $this->setResourceUrl(config('erp.models.account.resource_url'));

        $dataTable = new EloquentDataTable($query);

        return $dataTable->setTransformer(new AccountTransformer());
    }

    /**
     * Get query source of dataTable.
     * @param Account $model
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function query(Account $model)
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
              'id' => ['visible' => false],

            'account_code' => ['title' => trans('ERP::attributes.accounts.account_code')],

             'name' => ['title' => trans('ERP::attributes.users.name_ar')],

             'name_en' => ['title' => trans('ERP::attributes.users.name_en')],

             'balance' => ['title' => trans('ERP::attributes.accounts.balance')],

             'opening_balance' => ['title' => trans('ERP::attributes.accounts.opening_balance')],


             'user_id' => ['searchable'=>false , 'orderable'=>false,'title' => trans('ERP::attributes.accounts.account_user')],

             
            'updated_at' => ['title' => trans('Packages::attributes.updated_at')],

            'created_at' => ['title' => trans('Packages::attributes.created_at')],
        ];
    }


      protected function getFilters()
    {
        return [

            'name' => ['title' => trans('ERP::attributes.users.name_ar'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],

            'name_en' => ['title' => trans('ERP::attributes.users.name_en'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],

            'account_code' => ['title' => trans('ERP::attributes.accounts.account_code'), 'class' => 'col-md-2', 'type' => 'text', 'condition' => 'like', 'active' => true],

           'user_id' => ['title' => trans('ERP::attributes.accounts.account_user'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getUsersList(), 'condition' => 'like', 'active' => true],

            
            'category_id' => ['title' => trans('ERP::attributes.accounts.category'), 'class' => 'col-md-2', 'type' => 'select2', 'options' => ERP::getCategoriesByType('accounts'), 'condition' => 'like', 'active' => true],

        ];
    }


    protected function getBuilderParameters()
    {
        return ['order' => [5, 'desc']];
    }
}
