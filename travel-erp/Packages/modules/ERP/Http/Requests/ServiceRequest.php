<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Service;

class ServiceRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Service::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Service::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name.*'        => 'required',
                
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
                'reg_code'=> 'required|max:191unique:erp_public_transports,reg_code',
            ]);
        }

        if ($this->isUpdate()) {
            $service = $this->route('service');

            $rules = array_merge($rules, [
                'reg_code'=> 'required|max:191|unique:erp_public_transports,reg_code,'.$service->id,
            ]);
        }

        return $rules;
    }
}
