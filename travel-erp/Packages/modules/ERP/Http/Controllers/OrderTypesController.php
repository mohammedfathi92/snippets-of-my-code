<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\OrderTypesDataTable;
use Packages\Modules\ERP\Http\Requests\OrderTypeRequest;
use Packages\Modules\ERP\Models\OrderType;

class OrderTypesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.ordertype.resource_url');

        $this->title = 'ERP::module.ordertype.title';
        $this->title_singular = 'ERP::module.ordertype.title_singular';

        parent::__construct();
    }

    /**
     * @param OrderTypeRequest $request
     * @param OrderTypesDataTable $dataTable
     * @return mixed
     */
    public function index(OrderTypeRequest $request, OrderTypesDataTable $dataTable)
    {
        return $dataTable->render('ERP::ordertypes.index');
    }

    /**
     * @param OrderTypeRequest $request
     * @return $this
     */
    public function create(OrderTypeRequest $request)
    {
        $ordertype = new OrderType();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::ordertypes.create_edit')->with(compact('ordertype'));
    }

    /**
     * @param OrderTypeRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(OrderTypeRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $ordertype = OrderType::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, OrderType::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param OrderTypeRequest $request
     * @param OrderType $ordertype
     * @return OrderType
     */
    public function show(OrderTypeRequest $request, OrderType $ordertype)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $ordertype->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $OrderType->hashed_id . '/edit']);

        return view('ERP::ordertypes.show')->with(compact('ordertype'));
    }

    /**
     * @param OrderTypeRequest $request
     * @param OrderType $ordertype
     * @return $this
     */
    public function edit(OrderTypeRequest $request, OrderType $ordertype)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $ordertype->name])]);

        return view('ERP::ordertypes.create_edit')->with(compact('ordertype'));
    }

    /**
     * @param OrderTypeRequest $request
     * @param OrderType $ordertype
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(OrderTypeRequest $request, OrderType $ordertype)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $ordertype->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, OrderType::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param OrderTypeRequest $request
     * @param OrderType $ordertype
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(OrderTypeRequest $request, OrderType $ordertype)
    {
        try {
            $ordertype->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, OrderType::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}