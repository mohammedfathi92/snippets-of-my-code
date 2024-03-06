<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\RoomTypesDataTable;
use Packages\Modules\ERP\Http\Requests\RoomTypeRequest;
use Packages\Modules\ERP\Models\RoomType;

class RoomTypesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.roomtype.resource_url');

        $this->title = 'ERP::module.roomtype.title';
        $this->title_singular = 'ERP::module.roomtype.title_singular';

        parent::__construct();
    }

    /**
     * @param RoomTypeRequest $request
     * @param RoomTypesDataTable $dataTable
     * @return mixed
     */
    public function index(RoomTypeRequest $request, RoomTypesDataTable $dataTable)
    {
        return $dataTable->render('ERP::roomtypes.index');
    }

    /**
     * @param RoomTypeRequest $request
     * @return $this
     */
    public function create(RoomTypeRequest $request)
    {
        $roomtype = new RoomType();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::roomtypes.create_edit')->with(compact('roomtype'));
    }

    /**
     * @param RoomTypeRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(RoomTypeRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $roomtype = RoomType::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, RoomType::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param RoomTypeRequest $request
     * @param RoomType $roomtype
     * @return RoomType
     */
    public function show(RoomTypeRequest $request, RoomType $roomtype)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $roomtype->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $RoomType->hashed_id . '/edit']);

        return view('ERP::roomtypes.show')->with(compact('roomtype'));
    }

    /**
     * @param RoomTypeRequest $request
     * @param RoomType $roomtype
     * @return $this
     */
    public function edit(RoomTypeRequest $request, RoomType $roomtype)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $roomtype->name])]);

        return view('ERP::roomtypes.create_edit')->with(compact('roomtype'));
    }

    /**
     * @param RoomTypeRequest $request
     * @param RoomType $roomtype
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(RoomTypeRequest $request, RoomType $roomtype)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $roomtype->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, RoomType::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param RoomTypeRequest $request
     * @param RoomType $roomtype
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(RoomTypeRequest $request, RoomType $roomtype)
    {
        try {
            $roomtype->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, RoomType::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}