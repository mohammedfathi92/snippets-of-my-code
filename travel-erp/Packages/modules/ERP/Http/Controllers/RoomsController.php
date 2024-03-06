<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\Classes\ERP;
use Packages\Modules\ERP\DataTables\RoomsDataTable;
use Packages\Modules\ERP\Http\Requests\RoomRequest;
use Packages\Modules\ERP\Models\Room;
use Packages\Modules\ERP\Models\Hotel;
use Illuminate\Http\Request;

class RoomsController extends BaseController
{
    public function __construct()
    {
         $this->resource_url = route(
            config('erp.models.room.resource_route'),
            ['hotel' => request()->route('hotel')]
        );

        

        $this->title = 'ERP::module.room.title';
        $this->title_singular = 'ERP::module.room.title_singular';

        parent::__construct();
    }

    /**
     * @param RoomRequest $request
     * @param Hotel $hotel
     * @param RoomsDataTable $dataTable
     * @return mixed
     */
    public function index(RoomRequest $request, Hotel $hotel, RoomsDataTable $dataTable)
    {
        $this->setViewSharedData(['title' => trans('ERP::module.room.title',['name' => $hotel->name ,'title' => $this->title])]);

        return $dataTable->render('ERP::rooms.index', compact('hotel'));
    }

    /**
     * @param RoomRequest $request
     * @param Hotel $hotel
     * @return $this
     */
    public function create(RoomRequest $request, Hotel $hotel)
    {
        
        $room = new Room();
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);
        $has_hotel = true;

        return view('ERP::rooms.create_edit')->with(compact('room', 'hotel', 'has_hotel'));
    }

    /**
     * @param RoomRequest $request
     * @param Hotel $hotel
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RoomRequest $request, Hotel $hotel)
    {
        try {
                
            $data = $request->except('country_id','city_id');
            $room = $hotel->rooms()->create($data);


            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Room::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

 

    /**
     * @param RoomRequest $request
     * @param Hotel $hotel
     * @param Room $room
     * @return $this
     */
    public function show(RoomRequest $request, Hotel $hotel, Room $room)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $hotel->name])]);

        return view('ERP::rooms.show')->with(compact('room', 'hotel'));
    }

    /**
     * @param RoomRequest $request
     * @param Hotel $hotel
     * @param Room $room
     * @return $this
     */
    public function edit(RoomRequest $request, Hotel $hotel, Room $room)
    {
        $this->setViewSharedData(['title_singular' => "Update Room"]);
        $has_hotel = true;

        return view('ERP::rooms.create_edit')->with(compact('room', 'hotel', 'has_hotel'));
    }

    /**
     * @param RoomRequest $request
     * @param Hotel $hotel
     * @param Room $room
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(RoomRequest $request, Hotel $hotel, Room $room)
    {
        try {
            $data = $request->except('country_id','city_id');

            $room->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Room::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param Room $room
     * @param bool $create
     * @return bool
     * @throws \Exception
     */
    protected function createUpdateGatewayRoomSend(Room $room, $create = false, $gateway = null)
    {
        if ($gateway) {
            $gateways = [$gateway];
        } else {
            $gateways = \Payments::getAvailableGateways();
        }

        $exceptionMessage = '';
        foreach ($gateways as $gateway => $gateway_title) {

            try {
                $ERP = new ERP($gateway);


                if (!$ERP->gateway->getConfig('manage_remote_room')) {
                    continue;
                }
                if ($ERP->gateway->getGatewayIntegrationId($room)) {
                    $ERP->updateRoom($room);
                } else {
                    $ERP->createRoom($room);
                }
            } catch (\Exception $exception) {
                $exceptionMessage .= $exception->getMessage();
            }
        }
        if (!empty($exceptionMessage)) {
            throw new \Exception($exceptionMessage);
        }
    }


    /**
     * @param RoomRequest $request
     * @param Hotel $hotel
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RoomRequest $request, Hotel $hotel, Room $room)
    {
        try {

            $gateways = \Payments::getAvailableGateways();

            foreach ($gateways as $gateway => $gateway_title) {

                $ERP = new ERP($gateway);
                if (!$ERP->gateway->getConfig('manage_remote_room')) {
                    continue;
                }
                $ERP->deleteRoom($room);
                $room->setGatewayStatus($this->gateway->getName(), 'DELETED', null);

            }

            $room->clearMediaCollection('ecommerce-room-image');
            $room->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Room::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }

    /**
     * @param Request $request
     * @param Hotel $hotel
     * @param Room $room
     * @return \Illuminate\Http\JsonResponse
     */
    public function createGatewayRoom(Request $request, Hotel $hotel, Room $room)
    {
        user()->can('ERP::hotel.create', Hotel::class);

        $gateway = $request->get('gateway');
        try {
            $this->createUpdateGatewayRoomSend($room, true, $gateway);

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.created', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Room::class, 'createGatewayRoom');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}