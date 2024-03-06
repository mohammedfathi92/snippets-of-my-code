<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\FerriesDataTable;
use Packages\Modules\ERP\Http\Requests\FerryRequest;
use Packages\Modules\ERP\Models\Ferry;

class FerriesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.ferry.resource_url');

        $this->title = 'ERP::module.ferry.title';
        $this->title_singular = 'ERP::module.ferry.title_singular';

        parent::__construct();
    }

    /**
     * @param FerryRequest $request
     * @param FerriesDataTable $dataTable
     * @return mixed
     */
    public function index(FerryRequest $request, FerriesDataTable $dataTable)
    {
        return $dataTable->render('ERP::ferries.index');
    }

    /**
     * @param FerryRequest $request
     * @return $this
     */
    public function create(FerryRequest $request)
    {
        $ferry = new Ferry();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::ferries.create_edit')->with(compact('ferry'));
    }

    /**
     * @param FerryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(FerryRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $ferry = Ferry::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Ferry::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param FerryRequest $request
     * @param Ferry $ferry
     * @return Ferry
     */
    public function show(FerryRequest $request, Ferry $ferry)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $ferry->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Ferry->hashed_id . '/edit']);

        return view('ERP::ferries.show')->with(compact('ferry'));
    }

    /**
     * @param FerryRequest $request
     * @param Ferry $ferry
     * @return $this
     */
    public function edit(FerryRequest $request, Ferry $ferry)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $ferry->name])]);

        return view('ERP::ferries.create_edit')->with(compact('ferry'));
    }

    /**
     * @param FerryRequest $request
     * @param Ferry $ferry
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(FerryRequest $request, Ferry $ferry)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $ferry->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Ferry::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param FerryRequest $request
     * @param Ferry $ferry
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(FerryRequest $request, Ferry $ferry)
    {
        try {
            $ferry->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Ferry::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}