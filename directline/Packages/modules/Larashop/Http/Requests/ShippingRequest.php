<?php

namespace Packages\Modules\Larashop\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\Larashop\Models\Shipping;

class ShippingRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Shipping::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Shipping::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name' => 'required',
                'shipping_method' => 'required',
                'priority' => 'required|numeric',
                'rate' => 'numeric|required_if:shipping_method,FlatRate',

            ]);
        }


        return $rules;
    }

    /**
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function getValidatorInstance()
    {
        $data = $this->all();

        $data['exclusive'] = array_get($data, 'exclusive', false);
        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }


}
