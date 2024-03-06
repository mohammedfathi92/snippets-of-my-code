<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\HotelsDataTable;
use Packages\Modules\ERP\Http\Requests\HotelRequest;
use Packages\Modules\ERP\Models\Hotel;

class HotelsController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.hotel.resource_url');

        $this->title = 'ERP::module.hotel.title';
        $this->title_singular = 'ERP::module.hotel.title_singular';

        parent::__construct();
    }

    /**
     * @param HotelRequest $request
     * @param HotelsDataTable $dataTable
     * @return mixed
     */
    public function index(HotelRequest $request, HotelsDataTable $dataTable)
    {
        return $dataTable->render('ERP::hotels.index');
    }

    /**
     * @param HotelRequest $request
     * @return $this
     */
    public function create(HotelRequest $request)
    {
        $hotel = new Hotel();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::hotels.create_edit')->with(compact('hotel'));
    }

    /**
     * @param HotelRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(HotelRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $hotel = Hotel::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Hotel::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param HotelRequest $request
     * @param Hotel $hotel
     * @return Hotel
     */
    public function show(HotelRequest $request, Hotel $hotel)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $hotel->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Hotel->hashed_id . '/edit']);

        return view('ERP::hotels.show')->with(compact('hotel'));
    }

    /**
     * @param HotelRequest $request
     * @param Hotel $hotel
     * @return $this
     */
    public function edit(HotelRequest $request, Hotel $hotel)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $hotel->name])]);

        return view('ERP::hotels.create_edit')->with(compact('hotel'));
    }

    /**
     * @param HotelRequest $request
     * @param Hotel $hotel
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(HotelRequest $request, Hotel $hotel)
    {
        
        try {
            $data = $request->except($this->excludedRequestParams);

            $hotel->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Hotel::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param HotelRequest $request
     * @param Hotel $hotel
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(HotelRequest $request, Hotel $hotel)
    {
        try {
            $hotel->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Hotel::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}