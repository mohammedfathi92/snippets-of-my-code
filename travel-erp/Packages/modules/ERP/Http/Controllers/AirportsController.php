<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\AirportsDataTable;
use Packages\Modules\ERP\Http\Requests\AirportRequest;
use Packages\Modules\ERP\Models\Airport;

class AirportsController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.airport.resource_url');

        $this->title = 'ERP::module.airport.title';
        $this->title_singular = 'ERP::module.airport.title_singular';

        parent::__construct();
    }

    /**
     * @param AirportRequest $request
     * @param AirportsDataTable $dataTable
     * @return mixed
     */
    public function index(AirportRequest $request, AirportsDataTable $dataTable)
    {
        return $dataTable->render('ERP::airports.index');
    }

    /**
     * @param AirportRequest $request
     * @return $this
     */
    public function create(AirportRequest $request)
    {
        $airport = new Airport();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::airports.create_edit')->with(compact('airport'));
    }

    /**
     * @param AirportRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AirportRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $airport = Airport::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Airport::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param AirportRequest $request
     * @param Airport $airport
     * @return Airport
     */
    public function show(AirportRequest $request, Airport $airport)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $airport->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Airport->hashed_id . '/edit']);

        return view('ERP::airports.show')->with(compact('airport'));
    }

    /**
     * @param AirportRequest $request
     * @param Airport $airport
     * @return $this
     */
    public function edit(AirportRequest $request, Airport $airport)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $airport->name])]);

        return view('ERP::airports.create_edit')->with(compact('airport'));
    }

    /**
     * @param AirportRequest $request
     * @param Airport $airport
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(AirportRequest $request, Airport $airport)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $airport->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Airport::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param AirportRequest $request
     * @param Airport $airport
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(AirportRequest $request, Airport $airport)
    {
        try {
            $airport->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Airport::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}