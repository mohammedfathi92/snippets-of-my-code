<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\VehiclesDataTable;
use Packages\Modules\ERP\Http\Requests\VehicleRequest;
use Packages\Modules\ERP\Models\Vehicle;

class VehiclesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.vehicle.resource_url');

        $this->title = 'ERP::module.vehicle.title';
        $this->title_singular = 'ERP::module.vehicle.title_singular';

        parent::__construct();
    }

    /**
     * @param VehicleRequest $request
     * @param VehiclesDataTable $dataTable
     * @return mixed
     */
    public function index(VehicleRequest $request, VehiclesDataTable $dataTable)
    {
        return $dataTable->render('ERP::vehicles.index');
    }

    /**
     * @param VehicleRequest $request
     * @return $this
     */
    public function create(VehicleRequest $request)
    {
        $vehicle = new Vehicle();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::vehicles.create_edit')->with(compact('vehicle'));
    }

    /**
     * @param VehicleRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(VehicleRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $vehicle = Vehicle::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Vehicle::class, 'store');
        }

        return redirectTo($this->resource_url);
    }
 
    /**
     * @param VehicleRequest $request
     * @param Vehicle $vehicle
     * @return Vehicle
     */
    public function show(VehicleRequest $request, Vehicle $vehicle)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $vehicle->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Vehicle->hashed_id . '/edit']);

        return view('ERP::vehicles.show')->with(compact('vehicle'));
    }

    /**
     * @param VehicleRequest $request
     * @param Vehicle $vehicle
     * @return $this
     */
    public function edit(VehicleRequest $request, Vehicle $vehicle)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $vehicle->name])]);

        return view('ERP::vehicles.create_edit')->with(compact('vehicle'));
    }

    /**
     * @param VehicleRequest $request
     * @param Vehicle $vehicle
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(VehicleRequest $request, Vehicle $vehicle)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $vehicle->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Vehicle::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param VehicleRequest $request
     * @param Vehicle $vehicle
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(VehicleRequest $request, Vehicle $vehicle)
    {
        try {
            $vehicle->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Vehicle::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}