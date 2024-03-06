<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\AirlinesDataTable;
use Packages\Modules\ERP\Http\Requests\AirlineRequest;
use Packages\Modules\ERP\Models\Airline;

class AirlinesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.airline.resource_url');

        $this->title = 'ERP::module.airline.title';
        $this->title_singular = 'ERP::module.airline.title_singular';

        parent::__construct();
    }

    /**
     * @param AirlineRequest $request
     * @param AirlinesDataTable $dataTable
     * @return mixed
     */
    public function index(AirlineRequest $request, AirlinesDataTable $dataTable)
    {
        return $dataTable->render('ERP::airlines.index');
    }

    /**
     * @param AirlineRequest $request
     * @return $this
     */
    public function create(AirlineRequest $request)
    {
        $airline = new Airline();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::airlines.create_edit')->with(compact('airline'));
    }

    /**
     * @param AirlineRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(AirlineRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $airline = Airline::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Airline::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param AirlineRequest $request
     * @param Airline $airline
     * @return Airline
     */
    public function show(AirlineRequest $request, Airline $airline)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $airline->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Airline->hashed_id . '/edit']);

        return view('ERP::airlines.show')->with(compact('airline'));
    }

    /**
     * @param AirlineRequest $request
     * @param Airline $airline
     * @return $this
     */
    public function edit(AirlineRequest $request, Airline $airline)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $airline->name])]);

        return view('ERP::airlines.create_edit')->with(compact('airline'));
    }

    /**
     * @param AirlineRequest $request
     * @param Airline $airline
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(AirlineRequest $request, Airline $airline)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $airline->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Airline::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param AirlineRequest $request
     * @param Airline $airline
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(AirlineRequest $request, Airline $airline)
    {
        try {
            $airline->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Airline::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}