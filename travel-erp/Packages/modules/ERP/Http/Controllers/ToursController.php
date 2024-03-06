<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\ToursDataTable;
use Packages\Modules\ERP\Http\Requests\TourRequest;
use Packages\Modules\ERP\Models\Tour;

class ToursController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.tour.resource_url');

        $this->title = 'ERP::module.tour.title';
        $this->title_singular = 'ERP::module.tour.title_singular';

        parent::__construct();
    }

    /**
     * @param TourRequest $request
     * @param ToursDataTable $dataTable
     * @return mixed
     */
    public function index(TourRequest $request, ToursDataTable $dataTable)
    {
        return $dataTable->render('ERP::tours.index');
    }

    /**
     * @param TourRequest $request
     * @return $this
     */
    public function create(TourRequest $request)
    {
        $tour = new Tour();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::tours.create_edit')->with(compact('tour'));
    }

    /**
     * @param TourRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TourRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $tour = Tour::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Tour::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param TourRequest $request
     * @param Tour $tour
     * @return Tour
     */
    public function show(TourRequest $request, Tour $tour)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $tour->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Tour->hashed_id . '/edit']);

        return view('ERP::tours.show')->with(compact('tour'));
    }

    /**
     * @param TourRequest $request
     * @param Tour $tour
     * @return $this
     */
    public function edit(TourRequest $request, Tour $tour)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $tour->name])]);

        return view('ERP::tours.create_edit')->with(compact('tour'));
    }

    /**
     * @param TourRequest $request
     * @param Tour $tour
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TourRequest $request, Tour $tour)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $tour->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Tour::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param TourRequest $request
     * @param Tour $tour
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(TourRequest $request, Tour $tour)
    {
        try {
            $tour->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Tour::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}