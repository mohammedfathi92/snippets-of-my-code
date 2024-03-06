<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\ActivityPricesDataTable;
use Packages\Modules\ERP\Http\Requests\ActivityPriceRequest;
use Packages\Modules\ERP\Models\ActivityPrice;

class ActivitiesPricesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.activityprice.resource_url');

        $this->title = 'ERP::module.activityprice.title';
        $this->title_singular = 'ERP::module.activityprice.title_singular';

        parent::__construct();
    }

    /**
     * @param ActivityPriceRequest $request
     * @param ActivityPricesDataTable $dataTable
     * @return mixed
     */
    public function index(ActivityPriceRequest $request, ActivityPricesDataTable $dataTable)
    {
        return $dataTable->render('ERP::prices.Ferries.index');
    }

    /**
     * @param ActivityPriceRequest $request
     * @return $this
     */
    public function create(ActivityPriceRequest $request)
    {
        $activity_price = new ActivityPrice();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::prices.activities.create_edit')->with(compact('activity_price'));
    }

    /**
     * @param ActivityPriceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ActivityPriceRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $activity_price = ActivityPrice::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, ActivityPrice::class, 'store');
        }

        return redirectTo($this->resource_url);
    }
 
    /**
     * @param ActivityPriceRequest $request
     * @param ActivityPrice $activityprice
     * @return ActivityPrice
     */
    public function show(ActivityPriceRequest $request, ActivityPrice $activity_price)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $activity_price->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Activity_Price->hashed_id . '/edit']);

        return view('ERP::prices.activities.show')->with(compact('activity_price'));
    }

    /**
     * @param ActivityPriceRequest $request
     * @param ActivityPrice $activityprice
     * @return $this
     */
    public function edit(ActivityPriceRequest $request, $id)
    {
        $id = hashids_decode($id);
        $activity_price = ActivityPrice::find($id);
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => 'Activity Price'])]);

        return view('ERP::prices.activities.create_edit')->with(compact('activity_price'));
    }

    /**
     * @param ActivityPriceRequest $request
     * @param ActivityPrice $activityprice
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ActivityPriceRequest $request, $id)
    {
        try {
            $data = $request->except($this->excludedRequestParams);
            $id = hashids_decode($id);
            $activity_price = ActivityPrice::find($id);
            $activity_price->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, ActivityPrice::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param ActivityPriceRequest $request
     * @param ActivityPrice $activityprice
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ActivityPriceRequest $request, ActivityPrice $activity_price)
    {
        try {
            $activity_price->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, ActivityPrice::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}