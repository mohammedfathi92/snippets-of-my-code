<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\ActivitiesDataTable;
use Packages\Modules\ERP\Http\Requests\ActivityRequest;
use Packages\Modules\ERP\Models\Activity;

class ActivitiesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.activity.resource_url');

        $this->title = 'ERP::module.activity.title';
        $this->title_singular = 'ERP::module.activity.title_singular';

        parent::__construct();
    }

    /**
     * @param ActivityRequest $request
     * @param ActivitiesDataTable $dataTable
     * @return mixed
     */
    public function index(ActivityRequest $request, ActivitiesDataTable $dataTable)
    {
        return $dataTable->render('ERP::activities.index');
    }

    /**
     * @param ActivityRequest $request
     * @return $this
     */
    public function create(ActivityRequest $request)
    {
        $activity = new Activity();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::activities.create_edit')->with(compact('activity'));
    }

    /**
     * @param ActivityRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ActivityRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $activity = Activity::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Activity::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param ActivityRequest $request
     * @param Activity $activity
     * @return Activity
     */
    public function show(ActivityRequest $request, Activity $activity)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $activity->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Activity->hashed_id . '/edit']);

        return view('ERP::activities.show')->with(compact('activity'));
    }

    /**
     * @param ActivityRequest $request
     * @param Activity $activity
     * @return $this
     */
    public function edit(ActivityRequest $request, Activity $activity)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $activity->name])]);

        return view('ERP::activities.create_edit')->with(compact('activity'));
    }

    /**
     * @param ActivityRequest $request
     * @param Activity $activity
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ActivityRequest $request, Activity $activity)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $activity->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Activity::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param ActivityRequest $request
     * @param Activity $activity
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ActivityRequest $request, Activity $activity)
    {
        try {
            $activity->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Activity::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}