<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\BusStationsDataTable;
use Packages\Modules\ERP\Http\Requests\BusStationRequest;
use Packages\Modules\ERP\Models\BusStation;

class BusStationsController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.busstation.resource_url');

        $this->title = 'ERP::module.busstation.title';
        $this->title_singular = 'ERP::module.busstation.title_singular';

        parent::__construct();
    }

    /**
     * @param BusStationRequest $request
     * @param BusStationsDataTable $dataTable
     * @return mixed
     */
    public function index(BusStationRequest $request, BusStationsDataTable $dataTable)
    {
        return $dataTable->render('ERP::busstations.index');
    }

    /**
     * @param BusStationRequest $request
     * @return $this
     */
    public function create(BusStationRequest $request)
    {
        $bus_station = new BusStation();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::busstations.create_edit')->with(compact('bus_station'));
    }

    /**
     * @param BusStationRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BusStationRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $busstation = BusStation::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, BusStation::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param BusStationRequest $request
     * @param BusStation $busstation
     * @return BusStation
     */
    public function show(BusStationRequest $request, BusStation $bus_station)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $bus_station->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $BusStation->hashed_id . '/edit']);

        return view('ERP::busstations.show')->with(compact('bus_station'));
    }

    /**
     * @param BusStationRequest $request
     * @param BusStation $busstation
     * @return $this
     */
    public function edit(BusStationRequest $request, BusStation $bus_station)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $bus_station->name])]);

        return view('ERP::busstations.create_edit')->with(compact('bus_station'));
    }

    /**
     * @param BusStationRequest $request
     * @param BusStation $busstation
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(BusStationRequest $request, BusStation $busstation)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $busstation->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, BusStation::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param BusStationRequest $request
     * @param BusStation $busstation
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BusStationRequest $request, BusStation $busstation)
    {
        try {
            $busstation->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, BusStation::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}