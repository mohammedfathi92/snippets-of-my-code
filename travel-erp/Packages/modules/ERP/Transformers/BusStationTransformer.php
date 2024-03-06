<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\BusStation;

class BusStationTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.busstaion.resource_url');

        parent::__construct();
    }

    /**
     * @param BusStation $busstaion
     * @return array
     * @throws \Throwable
     */
    public function transform(BusStation $bus)
    {
        $show_url = url($this->resource_url . '/' . $bus->hashed_id);
               return [
            'id' => $bus->id,
            'country_id' => $bus->country?$bus->country->name:'',
            'city_id' => $bus->city?$bus->city->name:'' .$bus->city_name,
            'name' => $bus->name,

                        'created_by' => $bus->created_by_name,
            'updated_by' => $bus->updated_by_name,

'status' => formatStatusAsLabels($bus->status > 0?'active': 'inactive'),
            'created_at' => format_date($bus->created_at),
            'updated_at' => format_date($bus->updated_at),
            'action' => $this->actions($bus)
            

        ];
    }
}