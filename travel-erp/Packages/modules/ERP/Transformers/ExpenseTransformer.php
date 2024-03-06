<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Expense;

class ExpenseTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.expense.resource_url');

        parent::__construct();
    }

    /**
     * @param Expense $expense
     * @return array
     * @throws \Throwable
     */
    public function transform(Expense $expense)
    {
        $show_url = url($this->resource_url . '/' . $expense->hashed_id);



        return [
            'id' => $expense->id,

            'reg_code' => $expense->reg_code,
            // 'type' => "<span class=\"label label-{$types_Color}\"> {$expense_type} </span>",
            'category_id' => $expense->category?$expense->category->name:'--',
            'total_amount' => $expense->total_amount,
             'name' => $expense->name,
            'value_currency_id' => $expense->currency?$expense->currency->name:'--',
            'value_currency_rate' => $expense->value_currency_rate,
            'fees_percent' => $expense->fees_percent,

            'paid_by_id' => $expense->paid_by?$expense->paid_by->translated_name:'--',


            'created_by' => $expense->created_user?$expense->created_user->translated_name.'&nbsp;['.$expense->created_user->user_code.']': '---',

                        'updated_by' => $expense->updated_user?$expense->updated_user->translated_name.'&nbsp;['.$expense->updated_user->user_code.']': '---',
            
            'created_at' => format_date($expense->created_at),
            'updated_at' => format_date($expense->updated_at),
            'status' => getOrderStatusLabel($expense->status),
            'action' => $this->actions($expense)
        ];
    }
}