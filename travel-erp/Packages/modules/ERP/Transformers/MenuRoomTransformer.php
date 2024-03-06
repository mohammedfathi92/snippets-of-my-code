<?php

namespace Packages\Modules\ERP\Transformers;

use Packages\Foundation\Transformers\BaseTransformer;
use Packages\Modules\ERP\Models\Room;

class MenuRoomTransformer extends BaseTransformer
{
    public function __construct()
    {
        //$this->resource_url = config('erp.models.room.resource_route');

          $this->resource_url =config('erp.models.menuroom.resource_url');




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
        $url = url($this->resource_url .'/'. $room->hashed_id);

        return [
            'id' => $room->id,
            'name' => '<a href="' . $url . '">' . str_limit($room->name, 50) . '</a>',
            'hotel' => $room->hotel?$room->hotel->name:'',
            'price' =>  $room->price,
            'new_price' => $room->new_price,
            'season_price' => $room->season_price,
            'breakfast' => $room->breakfast,
            'created_at' => format_date($room->created_at),
            'updated_at' => format_date($room->updated_at),
            'action' => $this->actions($room)
        ];
    }
}