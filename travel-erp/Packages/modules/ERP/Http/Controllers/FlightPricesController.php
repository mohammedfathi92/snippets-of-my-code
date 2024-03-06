<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\FlightPricesDataTable;
use Packages\Modules\ERP\Http\Requests\FlightPriceRequest;
use Packages\Modules\ERP\Models\FlightPrice;

class FlightPricesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.flightprice.resource_url');

        $this->title = 'ERP::module.flightprice.title';
        $this->title_singular = 'ERP::module.flightprice.title_singular';

        parent::__construct();
    }

    /**
     * @param FlightPriceRequest $request
     * @param FlightPricesDataTable $dataTable
     * @return mixed
     */
    public function index(FlightPriceRequest $request, FlightPricesDataTable $dataTable)
    {
        return $dataTable->render('ERP::prices.flights.index');
    }

    /**
     * @param FlightPriceRequest $request
     * @return $this
     */
    public function create(FlightPriceRequest $request)
    {
        $flight_price = new FlightPrice();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::prices.flights.create_edit')->with(compact('flight_price'));
    }

    /**
     * @param FlightPriceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(FlightPriceRequest $request)
    {
        try {
            $data = $request->except($this->excludedRequestParams);
            //dd($data);

            $flight_price = FlightPrice::create($data);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, FlightPrice::class, 'store');
        }

        return redirectTo($this->resource_url);
    }
 
    /**
     * @param FlightPriceRequest $request
     * @param FlightPrice $flightprice
     * @return FlightPrice
     */
    public function show(FlightPriceRequest $request, FlightPrice $flight_price)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $flight_price->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Flight_Price->hashed_id . '/edit']);

        return view('ERP::prices.flights.show')->with(compact('flight_price'));
    }

    /**
     * @param FlightPriceRequest $request
     * @param FlightPrice $flightprice
     * @return $this
     */
    public function edit(FlightPriceRequest $request, $id)
    {
         $id = hashids_decode($id);
        $flight_price = FlightPrice::find($id);
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => 'Flight Price'])]);

        return view('ERP::prices.flights.create_edit')->with(compact('flight_price'));
    }

    /**
     * @param FlightPriceRequest $request
     * @param FlightPrice $flightprice
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(FlightPriceRequest $request, $id)
    {
        try {
              $id = hashids_decode($id);
              $flight_price = FlightPrice::find($id);
            $data = $request->except($this->excludedRequestParams);

            $flight_price->update($data);

            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, FlightPrice::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param FlightPriceRequest $request
     * @param FlightPrice $flightprice
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(FlightPriceRequest $request, FlightPrice $flight_price)
    {
        try {
            $flight_price->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, FlightPrice::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}