<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Financial;

class FinancialRequest extends BaseRequest
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
                'value_after_withdrawal' => 'nullable|min:0|numeric',
                'value_after_deposit' => 'nullable|min:0|numeric',
                'type'   => 'required',
                'from_user_id' => 'required_if:type,==,transfer|required_if:type,==,withdrawal|required_if:type,==,refund',

                'from_account_id' => 'required_if:type,==,transfer|required_if:type,==,withdrawal|required_if:type,==,refund',

                'to_user_id' => 'required_if:type,==,deposit|required_if:type,==,booking|required_if:type,==,commission|required_if:type,==,transfer',

                'to_account_id' => 'required_if:type,==,deposit|required_if:type,==,booking|required_if:type,==,commission|required_if:type,==,transfer',

                'final_value'     => 'required|min:1|numeric',
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                'reg_code'=> 'required|max:191|unique:erp_financials,reg_code',
            ]);
        }

        if ($this->isUpdate()) {

            $financial = $this->route('financial');

            $rules = array_merge($rules, [
                'reg_code'=> 'required|max:191|unique:erp_financials,reg_code,'.$financial->id,
            ]);
        }

        return $rules;
    }
}
