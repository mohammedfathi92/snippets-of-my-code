<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Provider;

class ProviderRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Provider::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Provider::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'translated_name.*' => 'required|max:240',
                'country_id' => 'required',
                'city_id' => 'required',
                'account_type' => 'required',
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
            $provider = $this->route('provider');

            $rules = array_merge($rules, [
                'email' => 'required|email|max:191|unique:users,email,' . $provider->id,
                'user_code' => 'required|max:191|unique:users,user_code,' . $provider->id,
            ]);
        }

        return $rules;
    }
}
