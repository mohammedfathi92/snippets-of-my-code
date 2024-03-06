<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\BusesDataTable;
use Packages\Modules\ERP\Http\Requests\BusRequest;
use Packages\Modules\ERP\Models\Bus;

class BusesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.bus.resource_url');

        $this->title = 'ERP::module.bus.title';
        $this->title_singular = 'ERP::module.bus.title_singular';

        parent::__construct();
    }

    /**
     * @param BusRequest $request
     * @param BusesDataTable $dataTable
     * @return mixed
     */
    public function index(BusRequest $request, BusesDataTable $dataTable)
    {
        return $dataTable->render('ERP::buses.index');
    }

    /**
     * @param BusRequest $request
     * @return $this
     */
    public function create(BusRequest $request)
    {
        $bus = new Bus();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::buses.create_edit')->with(compact('bus'));
    }

    /**
     * @param BusRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BusRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $bus = Bus::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Bus::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param BusRequest $request
     * @param Bus $bus
     * @return Bus
     */
    public function show(BusRequest $request, Bus $bus)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $bus->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Bus->hashed_id . '/edit']);

        return view('ERP::buses.show')->with(compact('bus'));
    }

    /**
     * @param BusRequest $request
     * @param Bus $bus
     * @return $this
     */
    public function edit(BusRequest $request, Bus $bus)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $bus->name])]);

        return view('ERP::buses.create_edit')->with(compact('bus'));
    }

    /**
     * @param BusRequest $request
     * @param Bus $bus
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(BusRequest $request, Bus $bus)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $bus->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Bus::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param BusRequest $request
     * @param Bus $bus
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BusRequest $request, Bus $bus)
    {
        try {
            $bus->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Bus::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}