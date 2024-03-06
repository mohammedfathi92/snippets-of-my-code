<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Financial;

class PaymentRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Financial::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Financial::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [   
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                'reg_code'=> 'nullable|max:191|unique:erp_financials,reg_code',
                'status' => 'required|integer',
                'itemable_id' => 'required|integer',
                'itemable_type' => 'required|string',
                'reg_value' => 'required|numeric',
                'value_type' => 'required|max:191',
                'category_id' => 'required|integer',
                'pay_method_id' => 'required|integer',
                'value_currency_id' => 'required|integer',
                'value_currency_rate' => 'required|numeric',
                'commission.reg_value' => 'required_if:select_commission,==,yes',
                'commission.value_type' => 'required_if:select_commission,==,yes',

                'commission.to_user_id' => 'required_if:select_commission,==,yes',
                'commission.to_account_id' => 'required_if:select_commission,==,yes',

                // 'commission.description.*' => 'max:191|required_if:create_commission,==,yes',
            ]);
        }

        if ($this->isUpdate()) {
            $Payment = $this->route('Payment');

            $rules = array_merge($rules, [
                 'status' => 'required|integer',
                'update_reason_id' => 'required|integer',
                                'value_currency_id' => 'required|integer',
                'value_currency_rate' => 'required|numeric',
                // 'reg_code'=> 'required|max:191|unique:erp_financials,reg_code,'.$Payment->id,
            ]);
        }

        return $rules;
    }
}
