<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Tour;

class TourTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.tour.resource_url');

        parent::__construct();
    }

    /**
     * @param Tour $tour
     * @return array
     * @throws \Throwable
     */
    public function transform(Tour $tour)
    {
        $show_url = url($this->resource_url . '/' . $tour->hashed_id);
        return [
            'id' => $tour->id,
            'country_id' => $tour->country?$tour->country->name:'',
            'city_id' => $tour->city?$tour->city->name:'',
            'name' => $tour->name,
            'reg_code' => $tour->reg_code,
            'tour_url' => '<a href="' . $tour->tour_url . '" target="_blank"><i class="fa fa-external-link"></i>'.__('ERP::attributes.main.show_url').'</a>',
            'created_at' => format_date($tour->created_at),
            'updated_at' => format_date($tour->updated_at),
        'created_by' => $tour->created_by_name,
            'updated_by' => $tour->updated_by_name,
            'status' => formatStatusAsLabels($tour->status > 0?'active': 'inactive'),
            'action' => $this->actions($tour)
        ];
    }
}