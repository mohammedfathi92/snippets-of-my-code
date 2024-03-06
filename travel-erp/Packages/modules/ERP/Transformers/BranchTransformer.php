<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Branch;

class BranchTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.branch.resource_url');

        parent::__construct();
    }

    /**
     * @param Branch $branch
     * @return array
     * @throws \Throwable
     */
    public function transform(Branch $branch)
    {
        $show_url = url($this->resource_url . '/' . $branch->hashed_id);
        return [
            'id' => $branch->id,
            'country_id' => $branch->country?$branch->country->name:'',
            'city_id' => $branch->city?$branch->city->name:'' .$branch->city_name,
            'name' => $branch->name,
            'primary_phone' => $branch->primary_phone,
            'phone_one' => $branch->phone_one,
            'email' => $branch->email,
            'address' => $branch->address,
            'created_by' => $branch->created_by_name,
            'updated_by' => $branch->updated_by_name,
            'created_at' => format_date($branch->created_at),
            'updated_at' => format_date($branch->updated_at),
            'status' => formatStatusAsLabels($branch->status > 0?'active': 'inactive'),
            'action' => $this->actions($branch)
        ];
    }
}