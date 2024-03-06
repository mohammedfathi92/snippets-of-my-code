<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\FlightOrder;

class FlightPackageTransformer extends BaseTransformer
{
    public function __construct()
    {
        $this->resource_url = config('erp.models.package.resource_url');

        parent::__construct();
    }

    /**
     * @param FlightOrder $flight
     * @return array
     * @throws \Throwable
     */
    public function transform(FlightOrder $flight)
    {

         $actions = [];

        $actions['Create Order'] = [
            'icon' => 'fa fa-fw fa-plus',
            'href' => url($this->resource_url . '/' . $flight->hashed_id . '/duplicateFlight'), //this is url to load modal view
            'label' => 'Create Order',
            'class' => 'modal-load',
            'data' => [
                'title' => 'Create Order'
            ]

        ];





        $show_url = url($this->resource_url . '/' . $flight->hashed_id);
        if ($flight->type == "flight") {
            $transporter = "airline";
        }else{
            $transporter = "ferry";
        }
        return [
            'id' => $flight->id,
            'order_code' => $flight->order?$flight->order->order_code:'',
            'type' => $flight->type,
            'transporter' => $flight->$transporter?$flight->$transporter->name:'',
            'from_country' => $flight->from_country?$flight->from_country->name:'',
            'from_city'    => $flight->from_city?$flight->from_city->name:'' ,
            'to_country'   => $flight->to_country?$flight->to_country->name:'',
            'to_city'      => $flight->to_city?$flight->to_city->name:'' ,
            'adult_numbers' => $flight->adult_numbers,
            'chlid_numbers' => $flight->chlid_numbers,
            'infant_numbers' => $flight->infant_numbers,
            'adult_price' => $flight->adult_price,
            'chlid_price' => $flight->chlid_price,
            'infant_price' => $flight->infant_price,
            'final_price' => $flight->final_price,
            'agent_id' => $flight->agent?$flight->agent->name:'',
            'notes' => $flight->notes,
            'created_at' => format_date($flight->created_at),
            'updated_at' => format_date($flight->updated_at),
            'action' => $this->actions($flight,$actions)

        ];
    }
}