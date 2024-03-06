<?php

namespace Packages\Modules\Payment\Common\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\Payment\Models\TaxClass;

class TaxClassRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(TaxClass::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(TaxClass::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name' => 'required|max:191',
            ]);
        }


        return $rules;
    }

}
