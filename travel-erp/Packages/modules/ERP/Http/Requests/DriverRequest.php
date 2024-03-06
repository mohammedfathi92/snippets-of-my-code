<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Driver;

class DriverRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Driver::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Driver::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'translated_name.*' => 'required|max:240',
                'account_type' => 'required',
                'country_id' => 'required',
                'city_id' => 'required',
                'financial_accounts.translated_name.*' => 'required_if:create_financial_account,==,yes',
                'financial_accounts.account_type' => 'required_if:create_financial_account,==,yes',
                'financial_accounts.account_code' => 'required_if:create_financial_account,==,yes'
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
            'email' => 'required|email|max:191|unique:users,email',
            'user_code' => 'required|max:191|unique:users,user_code',
            ]);
        }

        if ($this->isUpdate()) {
            $driver = $this->route('driver');

            $rules = array_merge($rules, [
                'email' => 'required|email|max:191|unique:users,email,' . $driver->id,
                'user_code' => 'required|max:191|unique:users,user_code,' . $driver->id,
            ]);
        }

        return $rules;
    }
}
