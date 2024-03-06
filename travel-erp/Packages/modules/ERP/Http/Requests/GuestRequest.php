<?php

namespace Packages\Modules\ERP\Http\Requests;

use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\OrderGuest;

class GuestRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(OrderGuest::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(OrderGuest::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'guests.*.name' => 'required|max:191',
                'guests.*.gender' => 'required|max:191',
                'guests.*.age_level' => 'required|max:191',
                // 'guests.*.passport_num' => 'required|max:191',

            ]);
        }

        if ($this->isStore()) {
            $rules = array_merge($rules, [
            ]);
        }

        if ($this->isUpdate()) {
            $guest = $this->route('guest');

            $rules = array_merge($rules, [
            ]);
        }

        return $rules;
    }
}
