<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Place;

class PlaceTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.place.resource_url');

        parent::__construct();
    }

    /**
     * @param Place $place
     * @return array
     * @throws \Throwable
     */
    public function transform(Place $place)
    {
        $show_url = url($this->resource_url . '/' . $place->hashed_id);
        return [
            'id' => $place->id,
            'name' => $place->name,
            'country_id' => $place->country?$place->country->name:'',
            'city_id' =>  $place->city?$place->city->name:'',
            'category_id' =>  $place->category?$place->category->name:'',
            'address' => $place->address,
            'reg_code' => $place->reg_code,
            'price' => $place->price,
            'new_price' => $place->new_price,
            'season_price' => $place->season_price,
            'place_level' => $place->place_level > 1? $place->place_level.' stars':$place->place_level.' star',
            'created_at' => format_date($place->created_at),
            'updated_at' => format_date($place->updated_at),
             'created_by' => $place->created_by_name,
            'updated_by' => $place->updated_by_name,

'status' => formatStatusAsLabels($place->status > 0?'active': 'inactive'),
            'action' => $this->actions($place)
        ];
    }
}