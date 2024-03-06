<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\BusPricesDataTable;
use Packages\Modules\ERP\Http\Requests\BusPriceRequest;
use Packages\Modules\ERP\Models\BusPrice;

class BusPricesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.busprice.resource_url');

        $this->title = 'ERP::module.busprice.title';
        $this->title_singular = 'ERP::module.busprice.title_singular';

        parent::__construct();
    }

    /**
     * @param BusPriceRequest $request
     * @param BusPricesDataTable $dataTable
     * @return mixed
     */
    public function index(BusPriceRequest $request, BusPricesDataTable $dataTable)
    {
        return $dataTable->render('ERP::prices.buses.index');
    }

    /**
     * @param BusPriceRequest $request
     * @return $this
     */
    public function create(BusPriceRequest $request)
    {
        $bus_price = new BusPrice();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::prices.buses.create_edit')->with(compact('bus_price'));
    }

    /**
     * @param BusPriceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(BusPriceRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);
            //dd($data);

            $bus_price = BusPrice::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, BusPrice::class, 'store');
        }

        return redirectTo($this->resource_url);
    }
 
    /**
     * @param BusPriceRequest $request
     * @param BusPrice $busprice
     * @return BusPrice
     */
    public function show(BusPriceRequest $request, BusPrice $bus_price)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $bus_price->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Bus_Price->hashed_id . '/edit']);

        return view('ERP::prices.buses.show')->with(compact('bus_price'));
    }

    /**
     * @param BusPriceRequest $request
     * @param BusPrice $busprice
     * @return $this
     */
    public function edit(BusPriceRequest $request, $id)
    {
         $id = hashids_decode($id);
        $bus_price = BusPrice::find($id);
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => 'Bus Price'])]);

        return view('ERP::prices.buses.create_edit')->with(compact('bus_price'));
    }

    /**
     * @param BusPriceRequest $request
     * @param BusPrice $busprice
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(BusPriceRequest $request, $id)
    {
        try {
              $id = hashids_decode($id);
              $bus_price = BusPrice::find($id);
            $data = $request->except($this->excludedRequestParams);

            $bus_price->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, BusPrice::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param BusPriceRequest $request
     * @param BusPrice $busprice
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(BusPriceRequest $request, BusPrice $bus_price)
    {
        try {
            $bus_price->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, BusPrice::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}