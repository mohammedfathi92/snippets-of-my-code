<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Airport;

class AirportTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.airport.resource_url');

        parent::__construct();
    }

    /**
     * @param Airport $airport
     * @return array
     * @throws \Throwable
     */
    public function transform(Airport $airport)
    {
        $show_url = url($this->resource_url . '/' . $airport->hashed_id);
        return [
            'id' => $airport->id,
            'country_id' => $airport->country?$airport->country->name:'',
            'city_id' => $airport->city?$airport->city->name:'' .$airport->city_name,
            'name' => $airport->name,

                        'created_by' => $airport->created_by_name,
            'updated_by' => $airport->updated_by_name,

'status' => formatStatusAsLabels($airport->status > 0?'active': 'inactive'),
            'created_at' => format_date($airport->created_at),
            'updated_at' => format_date($airport->updated_at),
            'action' => $this->actions($airport)
            

        ];
    }
}