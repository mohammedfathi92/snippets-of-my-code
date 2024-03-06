<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Financial;

class FinancialTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.financial.resource_url');

        parent::__construct();
    }

    /**
     * @param Financial $financial
     * @return array
     * @throws \Throwable
     */
    public function transform(Financial $financial)
    {
        $actions = ['edit' => '', 'delete' => ''];
        $show_url = url($this->resource_url . '/' . $financial->hashed_id);

        if (user()->hasPermissionTo('ERP::financial.view')) {
            $actions['show_financial'] = [
                'icon' => 'fa fa-fw fa-eye',
                'href' => url($this->resource_url . '/ajax/' . $financial->hashed_id . '/show'),
                'label' => trans('ERP::attributes.financials.show_financial'),
                'class' => 'modal-load',
                'data' => [
                    'title' => trans('ERP::attributes.financials.show_financial_with_code', ['code' => $financial->code])
                ]

            ];
        }

        $types_Colors = [
            'deposit' => 'success',
            'withdrawal' => 'danger',
            'transfer' => 'primary',
            'refund' => 'warning',
            'commission' => 'info',
            'booking' => 'default',
            'other' => 'warning',
            

        ];

        if(isset($types_Colors[$financial->type])){
            $types_Color = $types_Colors[$financial->type];
        }else{
            $types_Color = 'default';
        }

      $financial_type = __('ERP::attributes.financials.types.'.$financial->type);

        return [
            'id' => $financial->id,

            'code' => $financial->code,
            'type' => "<span class=\"label label-{$types_Color}\"> {$financial_type} </span>",
            'value' => $financial->value,
             'description' => $financial->description,
            'currency' => $financial->currency?$financial->currency->name:\ERP::defaultCurrencyName(),

            'created_by' => $financial->created_user?$financial->created_user->translated_name.'&nbsp;['.$financial->created_user->user_code.']': '---',
            
            'created_at' => format_date($financial->created_at),
            'updated_at' => format_date($financial->updated_at),
            'action' => $this->actions($financial, $actions)
        ];
    }
}