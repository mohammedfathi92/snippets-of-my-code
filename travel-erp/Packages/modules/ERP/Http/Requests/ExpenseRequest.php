<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Expense;

class ExpenseRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Expense::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Expense::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'paid_at' => 'required|date',
                'total_amount' => 'required|numeric',
                'category_id' => 'required|integer',
                'paid_by_id' => 'required|integer', 
                                'status' => 'required|integer',


                'pay_method_id' => 'required|integer',
                'value_currency_id' => 'required|integer',
                 'value_currency_rate' => 'required|numeric',


                'repeated_unit_durations' => 'required_if:type,==,repeated_duration',
                'repeated_duration' => 'required_if:type,==,repeated_unit_durations',


            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
            ]);
        }

        if ($this->isUpdate()) {

            $expense = $this->route('expense');

            $rules = array_merge($rules, [
            ]);
        }

        return $rules;
    }
}
