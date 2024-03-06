<?php

namespace Packages\Modules\ERP\Http\Requests;


use Packages\Foundation\Http\Requests\BaseRequest;
use Packages\Modules\ERP\Models\UserErp;

class AjaxCustomerRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
         $this->setModel(UserErp::class);

        return $this->isAuthorized();

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $this->setModel(UserErp::class);
        $rules = parent::rules();

        if ($this->isUpdate() || $this->isStore()) {
               // dd('i am in the request');

            $rules = array_merge($rules, [
                    'user_data.translated_name.*' => 'required|max:191',
                 
                ]
            );
        }
 
        if ($this->isStore()) {
            $rules = array_merge($rules, [
                    'user_data.email' => 'required|email|max:191|unique:users,email',
                    'user_data.user_code' => 'required|max:191|unique:users,user_code',
                    
                ]
            );
        }

        if ($this->isUpdate()) {
            $user = $this->route('customer');

            $rules = array_merge($rules, [
                    'user_data.email' => 'required|email|max:191|unique:users,email,' . $user->id,
                    'user_data.user_code' => 'required|max:191|unique:users,user_code,' . $user->id,
                  
                ]
            );
        }

        return $rules;
    }
}
