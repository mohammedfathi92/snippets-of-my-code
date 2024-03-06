<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\Branch;

class BranchRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Branch::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Branch::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name.*'        => 'required',
                'country_id'    => 'required|integer',
                'city_id'       => 'required|integer',
                'address'       => 'required',
                'status'       => 'required',
            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
            ]);
        }

        if ($this->isUpdate()) {
            $branch = $this->route('branch');

            $rules = array_merge($rules, [
            ]);
        }

        return $rules;
    }
}
