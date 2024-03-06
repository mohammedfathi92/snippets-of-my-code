<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Facades\ERP;
use Packages\Modules\ERP\Models\UserErp;
use Packages\Modules\ERP\Models\Customer;
use Packages\Modules\ERP\Models\user;
use Packages\Modules\ERP\Models\Branch;


class CustomerTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.customer.resource_url');

        parent::__construct();
    }

    /**
     * @param UserErp $user
     * @return array
     * @throws \Throwable
     */
    public function transform(UserErp $user)
    {


        $show_url = url($this->resource_url . '/' . $user->hashed_id);

        return [
            'id' => $user->id,
            'picture_thumb' => '<img src="' . $user->picture_thumb . '" class="img-circle img-responsive" alt="User Picture" width="35"/>',
            'user_code' => $user->user_code,
            'branch_id' => $user->branch?$user->branch->name:'',
            'user' =>$user->user?$user->user->name:'',
            'name' => $user->name,
            'name_en' => $user->name_en,
            'nick_name' => $user->nick_name,
            'nick_name_en' => $user->nick_name_en,

            'country_id' => $user->country?$user->country->name:'',

            'city_id' => $user->city?$user->city->name:'',

            'address' => $user->address,
            'primary_phone' => $user->primary_phone,

            'contact_person' => $user->contact_person,
            'account_type' => $user->account_type,

            'phone_one' => $user->phone_one,

            'phone_two' => $user->phone_two,

            'email' => $user->email,

            'notes' => $user->notes,
            'created_by' => $user->created_by_name,
            'updated_by' => $user->updated_by_name,

            'created_at' => format_date($user->created_at),
            'updated_at' => format_date($user->updated_at),
            'status' => formatStatusAsLabels($user->status > 0?'active': 'inactive'),
            'action' => $this->actions($user)
        ];
    }
}