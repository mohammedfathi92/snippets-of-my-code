<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\OrderType;

class OrderTypeRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(OrderType::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(OrderType::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name.*'        => 'required',
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
            ]);
        }

        if ($this->isUpdate()) {
            $ordertype = $this->route('ordertype');

            $rules = array_merge($rules, [
            ]);
        }

        return $rules;
    }
}
