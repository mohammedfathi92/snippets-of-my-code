<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\FerryPricesDataTable;
use Packages\Modules\ERP\Http\Requests\FerryPriceRequest;
use Packages\Modules\ERP\Models\FerryPrice;

class FerryPricesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.ferryprice.resource_url');

        $this->title = 'ERP::module.ferryprice.title';
        $this->title_singular = 'ERP::module.ferryprice.title_singular';

        parent::__construct();
    }

    /**
     * @param FerryPriceRequest $request
     * @param FerryPricesDataTable $dataTable
     * @return mixed
     */
    public function index(FerryPriceRequest $request, FerryPricesDataTable $dataTable)
    {
        return $dataTable->render('ERP::prices.Ferries.index');
    }

    /**
     * @param FerryPriceRequest $request
     * @return $this
     */
    public function create(FerryPriceRequest $request)
    {
        $ferry_price = new FerryPrice();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::prices.ferries.create_edit')->with(compact('ferry_price'));
    }

    /**
     * @param FerryPriceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(FerryPriceRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);

            $ferry_price = FerryPrice::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, FerryPrice::class, 'store');
        }

        return redirectTo($this->resource_url);
    }
 
    /**
     * @param FerryPriceRequest $request
     * @param FerryPrice $ferryprice
     * @return FerryPrice
     */
    public function show(FerryPriceRequest $request, FerryPrice $ferry_price)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $ferry_price->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Ferry_Price->hashed_id . '/edit']);

        return view('ERP::prices.ferries.show')->with(compact('ferry_price'));
    }

    /**
     * @param FerryPriceRequest $request
     * @param FerryPrice $ferryprice
     * @return $this
     */
    public function edit(FerryPriceRequest $request, $id)
    {
        $id = hashids_decode($id);
        $ferry_price = FerryPrice::find($id);
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => 'Ferry Price'])]);

        return view('ERP::prices.ferries.create_edit')->with(compact('ferry_price'));
    }

    /**
     * @param FerryPriceRequest $request
     * @param FerryPrice $ferryprice
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(FerryPriceRequest $request, $id)
    {
        try {
            $data = $request->except($this->excludedRequestParams);
            $id = hashids_decode($id);
            $ferry_price = FerryPrice::find($id);
            $ferry_price->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, FerryPrice::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param FerryPriceRequest $request
     * @param FerryPrice $ferryprice
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(FerryPriceRequest $request, FerryPrice $ferry_price)
    {
        try {
            $ferry_price->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, FerryPrice::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}