<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Agent;

class AgentTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.agent.resource_url');

        parent::__construct();
    }

    /**
     * @param Agent $agent
     * @return array
     * @throws \Throwable
     */
    public function transform(Agent $agent)
    {
        $show_url = url($this->resource_url . '/' . $agent->hashed_id);
         return [
            'id' => $agent->id,
            'picture_thumb' => '<img src="' . $agent->picture_thumb . '" class="img-responsive" alt="User Picture" width="35"/>',
            'user_code' => $agent->user_code,
            'branch_id' => $agent->branch?$agent->branch->name:'',
            'name' => $agent->name,
            'name_en' => $agent->name_en,

             'country_id' => $agent->country?$agent->country->name:'',

            'city_id' => $agent->city?$agent->city->name:'',

            'address' => $agent->address,
            'primary_phone' => $agent->primary_phone,

            'contact_person' => $agent->contact_person,
            'account_type' => $agent->account_type,

            'phone_one' => $agent->phone_one,

            'phone_two' => $agent->phone_two,

            'email' => $agent->email,

            'notes' => $agent->notes,
            'created_by' => $agent->created_by_name,
            'updated_by' => $agent->updated_by_name,

            'created_at' => format_date($agent->created_at),
            'updated_at' => format_date($agent->updated_at),
            'status' => formatStatusAsLabels($agent->status > 0?'active': 'inactive'),
            'action' => $this->actions($agent)
        ];
    }
}