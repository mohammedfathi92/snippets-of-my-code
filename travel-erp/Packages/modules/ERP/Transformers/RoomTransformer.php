<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Room;

class RoomTransformer extends BaseTransformer
{
    public function __construct()
    {
        //$this->resource_url = config('erp.models.room.resource_route');

          $this->resource_route =config('erp.models.room.resource_route');




        parent::__construct();
    }

    /**
     * @param Room $room
     * @return array
     * @throws \Throwable
     */
    public function transform(Room $room)
    {
         $actions = [];
        $url = route($this->resource_route, ['hotel' => $room->hotel->hashed_id]);

        return [
            'id' => $room->id,
            'name' => $room->name,
            'hotel' => $room->hotel?$room->hotel->name:'',
            'price' =>  $room->price,
            // 'new_price' => $room->new_price,
            // 'season_price' => $room->season_price,
            'breakfast' => $room->breakfast > 0?__('ERP::attributes.main.yes_no.yes'):__('ERP::attributes.main.yes_no.no'),
            'created_at' => format_date($room->created_at),
            'updated_at' => format_date($room->updated_at),
            'action' => $this->actions($room, $actions, $url),
            'reg_code' => $room->reg_code,

                        'created_by' => $room->created_by_name,
            'updated_by' => $room->updated_by_name,

'status' => formatStatusAsLabels($room->status > 0?'active': 'inactive'),
        ];
    }
}