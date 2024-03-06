<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\PlacesDataTable;
use Packages\Modules\ERP\Http\Requests\PlaceRequest;
use Packages\Modules\ERP\Models\Place;

class PlacesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.place.resource_url');

        $this->title = 'ERP::module.place.title';
        $this->title_singular = 'ERP::module.place.title_singular';

        parent::__construct();
    }

    /**
     * @param PlaceRequest $request
     * @param PlacesDataTable $dataTable
     * @return mixed
     */
    public function index(PlaceRequest $request, PlacesDataTable $dataTable)
    {
        return $dataTable->render('ERP::places.index');
    }

    /**
     * @param PlaceRequest $request
     * @return $this
     */
    public function create(PlaceRequest $request)
    {
        $place = new Place();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::places.create_edit')->with(compact('place'));
    }

    /**
     * @param PlaceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(PlaceRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $place = Place::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Place::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param PlaceRequest $request
     * @param Place $place
     * @return Place
     */
    public function show(PlaceRequest $request, Place $place)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $place->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Place->hashed_id . '/edit']);

        return view('ERP::places.show')->with(compact('place'));
    }

    /**
     * @param PlaceRequest $request
     * @param Place $place
     * @return $this
     */
    public function edit(PlaceRequest $request, Place $place)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $place->name])]);

        return view('ERP::places.create_edit')->with(compact('place'));
    }

    /**
     * @param PlaceRequest $request
     * @param Place $place
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PlaceRequest $request, Place $place)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $place->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Place::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param PlaceRequest $request
     * @param Place $place
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(PlaceRequest $request, Place $place)
    {
        try {
            $place->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Place::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}