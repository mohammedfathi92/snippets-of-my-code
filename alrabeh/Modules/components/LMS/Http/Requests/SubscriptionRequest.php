<?php

namespace Modules\Components\LMS\Http\Requests;

use Modules\Foundation\Http\Requests\BaseRequest;
use Modules\Components\LMS\Models\Subscription;

class SubscriptionRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->setModel(Subscription::class);

        return $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(Subscription::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
            $rules = array_merge($rules, [
                'name' => 'required',
                'status' => 'required',
            ]);


        }

            if ($this->isStore()) {
            $rules = array_merge($rules, [
                'slug' => 'required|max:191|unique:lms_subscriptions,slug'
            ]);
        }

        if ($this->isUpdate()) {
            $subscription = $this->route('subscription');

            $rules = array_merge($rules, [
                'slug' => 'required|max:191|unique:lms_subscriptions,slug,' . $subscription->id,
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

        $this->getInputSource()->replace($data);

        return parent::getValidatorInstance();
    }
}
