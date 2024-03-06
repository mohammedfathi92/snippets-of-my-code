<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\TransportOrder;

class TransportOrderTransformer extends BaseTransformer
{


    public function __construct()
    {
        $this->resource_url = config('erp.models.order.resource_url');

        parent::__construct();
    }

    /**
     * @param TransportOrder $transport
     * @return array
     * @throws \Throwable
     */
    public function transform(TransportOrder $transport)
    {


          $actions = [];

        $actions['duplicate'] = [
            'icon' => 'fa fa-fw fa-plus',
            'href' => url($this->resource_url . '/' . $transport->hashed_id . '/duplicateTransport'), //this is url to load modal view
            'label' => 'duplicate',
            'class' => 'modal-load',
            'data' => [
                'title' => 'duplicate'
            ]

        ];



        $show_url = url($this->resource_url . '/' . $transport->hashed_id);
        $from_source = $transport->from_source;
        $to_source = $transport->to_source;

        if ($from_source == "hotel") {
            $source_name = "sourceHotel";

        }elseif($from_source == "airport"){
            $source_name = "sourceAirport";

        }elseif($from_source == "ferry"){
            $source_name = "sourceFerry";

        }elseif($from_source == "journey"){
            $source_name = "sourceJourney";

        }elseif($from_source == "bus"){
            $source_name = "sourceBusStation";

        }else{
            $source_name = "";

        }

        if ($to_source == "hotel") {
            $target_name = "targetHotel";

        }elseif($to_source == "airport"){
            $target_name = "targetAirport";

        }elseif($to_source == "ferry"){
            $target_name = "targetFerry";

        }elseif($to_source == "journey"){
            $target_name = "targetJourney";

        }elseif($to_source == "bus"){
            $target_name = "targetBusStation";

        }elseif($to_source == "tour"){
            $target_name = "targetTravel";

        }else{
            $target_name = "";

        }
        return [
            'id' => $transport->id,
            'order_code' => $transport->order?$transport->order->order_code:'',
            'order_status' => $transport->order?$transport->order->order_status:'',
            'country_id' => $transport->country?$transport->country->name:'',
            'from_city'    => $transport->from_city?$transport->from_city->name:'' ,
            'from_source'    => $transport->from_source,
            'source_name'    => $transport->$source_name?$transport->$source_name->name:'' ,
            'to_city'      => $transport->to_city?$transport->to_city->name:'' ,
            'to_source'      => $transport->to_source,
            'target_name'      => $transport->$target_name?$transport->$target_name->name:'' ,
            'driver_id'      => $transport->driver?$transport->driver->name:'' ,
            'vehicle_id'      => $transport->vehicle?$transport->vehicle->name:'' ,
            'price_type' => $transport->price_type,
            'actual_price' => $transport->actual_price,
            'final_price' => $transport->final_price,
            'agent_id' => $transport->agent?$transport->agent->name:'',
            'date' => $transport->date,
            'time' => $transport->time,
            'transport_order' => $transport->transport_order,
            'sms' => $transport->sms,
            'notes' => $transport->notes,
            'created_at' => format_date($transport->created_at),
            'updated_at' => format_date($transport->updated_at),
            'action' => $this->actions($transport,$actions)

        ];
    }
}