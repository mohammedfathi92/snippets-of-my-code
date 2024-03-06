<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Provider;

class ProviderTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.provider.resource_url');

        parent::__construct();
    }

    /**
     * @param Provider $provider
     * @return array
     * @throws \Throwable
     */
    public function transform(Provider $provider)
    {
        $show_url = url($this->resource_url . '/' . $provider->hashed_id);
        return [
            'id' => $provider->id,
            'picture_thumb' => '<img src="' . $provider->picture_thumb . '" class="img-responsive" alt="User Picture" width="35"/>',
            'user_code' => $provider->user_code,
            'branch_id' => $provider->branch?$provider->branch->name:'',
            'name' => $provider->name,
            'name_en' => $provider->name_en,

             'country_id' => $provider->country?$provider->country->name:'',

            'city_id' => $provider->city?$provider->city->name:'',

            'address' => $provider->address,
            'primary_phone' => $provider->primary_phone,

            'contact_person' => $provider->contact_person,
            'account_type' => $provider->account_type,

            'phone_one' => $provider->phone_one,

            'phone_two' => $provider->phone_two,

            'email' => $provider->email,

            'notes' => $provider->notes,

            'created_by' => $provider->created_by_name,
            'updated_by' => $provider->updated_by_name,

            'created_at' => format_date($provider->created_at),
            'updated_at' => format_date($provider->updated_at),
            'status' => formatStatusAsLabels($provider->status > 0?'active': 'inactive'),
            'action' => $this->actions($provider)
        ];
    }
}