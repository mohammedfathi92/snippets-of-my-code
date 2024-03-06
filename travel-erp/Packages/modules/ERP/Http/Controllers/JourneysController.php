<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\JourneysDataTable;
use Packages\Modules\ERP\Http\Requests\JourneyRequest;
use Packages\Modules\ERP\Models\Journey;

class JourneysController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.journey.resource_url');

        $this->title = 'ERP::module.journey.title';
        $this->title_singular = 'ERP::module.journey.title_singular';

        parent::__construct();
    }

    /**
     * @param JourneyRequest $request
     * @param JourneysDataTable $dataTable
     * @return mixed
     */
    public function index(JourneyRequest $request, JourneysDataTable $dataTable)
    {
        return $dataTable->render('ERP::journeys.index');
    }

    /**
     * @param JourneyRequest $request
     * @return $this
     */
    public function create(JourneyRequest $request)
    {
        $journey = new Journey();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::journeys.create_edit')->with(compact('journey'));
    }

    /**
     * @param JourneyRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(JourneyRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $journey = Journey::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Journey::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param JourneyRequest $request
     * @param Journey $journey
     * @return Journey
     */
    public function show(JourneyRequest $request, Journey $journey)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $journey->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Journey->hashed_id . '/edit']);

        return view('ERP::journeys.show')->with(compact('journey'));
    }

    /**
     * @param JourneyRequest $request
     * @param Journey $journey
     * @return $this
     */
    public function edit(JourneyRequest $request, Journey $journey)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $journey->name])]);

        return view('ERP::journeys.create_edit')->with(compact('journey'));
    }

    /**
     * @param JourneyRequest $request
     * @param Journey $journey
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(JourneyRequest $request, Journey $journey)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $journey->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Journey::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param JourneyRequest $request
     * @param Journey $journey
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(JourneyRequest $request, Journey $journey)
    {
        try {
            $journey->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Journey::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}