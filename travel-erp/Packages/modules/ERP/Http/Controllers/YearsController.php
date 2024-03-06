<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\YearsDataTable;
use Packages\Modules\ERP\Http\Requests\YearRequest;
use Packages\Modules\ERP\Models\Year;

class YearsController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.year.resource_url');

        $this->title = 'ERP::module.year.title';
        $this->title_singular = 'ERP::module.year.title_singular';

        parent::__construct();
    }

    /**
     * @param YearRequest $request
     * @param YearsDataTable $dataTable
     * @return mixed
     */
    public function index(YearRequest $request, YearsDataTable $dataTable)
    {
        return $dataTable->render('ERP::years.index');
    }

    /**
     * @param YearRequest $request
     * @return $this
     */
    public function create(YearRequest $request)
    {
        $year = new Year();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::years.create_edit')->with(compact('year'));
    }

    /**
     * @param YearRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(YearRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $year = Year::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Year::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param YearRequest $request
     * @param Year $year
     * @return Year
     */
    public function show(YearRequest $request, Year $year)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $year->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Year->hashed_id . '/edit']);

        return view('ERP::years.show')->with(compact('year'));
    }

    /**
     * @param YearRequest $request
     * @param Year $year
     * @return $this
     */
    public function edit(YearRequest $request, Year $year)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $year->name])]);

        return view('ERP::years.create_edit')->with(compact('year'));
    }

    /**
     * @param YearRequest $request
     * @param Year $year
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(YearRequest $request, Year $year)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $year->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Year::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param YearRequest $request
     * @param Year $year
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(YearRequest $request, Year $year)
    {
        try {
            $year->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Year::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}