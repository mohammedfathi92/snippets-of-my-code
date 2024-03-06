<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\RegionsDataTable;
use Packages\Modules\ERP\Http\Requests\RegionRequest;
use Packages\Modules\ERP\Models\Region;

class RegionsController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.region.resource_url');

        $this->title = 'ERP::module.region.title';
        $this->title_singular = 'ERP::module.region.title_singular';

        parent::__construct();
    }

    /**
     * @param RegionRequest $request
     * @param RegionsDataTable $dataTable
     * @return mixed
     */
    public function index(RegionRequest $request, regionsDataTable $dataTable)
    {
        return $dataTable->render('ERP::regions.index');
    }

    /**
     * @param RegionRequest $request
     * @return $this
     */
    public function create(RegionRequest $request)
    {
        $region = new Region();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::regions.create_edit')->with(compact('region'));
    }

    /**
     * @param RegionRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RegionRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $region = Region::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Region::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param RegionRequest $request
     * @param Region $region
     * @return Region
     */
    public function show(RegionRequest $request, Region $region)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $region->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $region->hashed_id . '/edit']);

        return view('ERP::regions.show')->with(compact('region'));
    }

    /**
     * @param RegionRequest $request
     * @param Region $region
     * @return $this
     */
    public function edit(RegionRequest $request, Region $region)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $region->name])]);

        return view('ERP::regions.create_edit')->with(compact('region'));
    }

    /**
     * @param RegionsRequest $request
     * @param Region $region
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(RegionRequest $request, Region $region)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $region->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Region::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param RegionRequest $request
     * @param Region $region
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RegionRequest $request, Region $region)
    {
        try {
            $region->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Region::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}