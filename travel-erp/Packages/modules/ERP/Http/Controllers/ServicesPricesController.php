<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\ServicePricesDataTable;
use Packages\Modules\ERP\Http\Requests\ServicePriceRequest;
use Packages\Modules\ERP\Models\ServicePrice;
use Packages\Modules\ERP\Models\ServiceVehiclePrice;
use Packages\Modules\ERP\Models\Vehicle;
use Packages\Modules\ERP\Models\Category;



class ServicesPricesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.serviceprice.resource_url');

        $this->title = 'ERP::module.serviceprice.title';
        $this->title_singular = 'ERP::module.serviceprice.title_singular';

        parent::__construct();
    }

    /**
     * @param ServicePriceRequest $request
     * @param ServicePricesDataTable $dataTable
     * @return mixed
     */
    public function index(ServicePriceRequest $request, ServicePricesDataTable $dataTable)
    {
        return $dataTable->render('ERP::prices.services.index');
    }

    /**
     * @param ServicePriceRequest $request
     * @return $this
     */
    public function create(ServicePriceRequest $request)
    {
        $service_price = new ServicePrice();


        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::prices.services.create_edit')->with(compact('service_price'));
    }

    /**
     * @param ServicePriceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ServicePriceRequest $request)
    {
        try {
                $data = $request->except('vehicles');
                $service_price =ServicePrice::create($data);
            

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, ServicePrice::class, 'store');
        }

        return redirectTo($this->resource_url);
    }
 
    /**
     * @param ServicePriceRequest $request
     * @param ServicePrice $service_price
     * @return ServicePrice
     */
    public function show(ServicePriceRequest $request, ServicePrice $service_price)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $service_price->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $ServicePrice->hashed_id . '/edit']);

        return view('ERP::prices.services.show')->with(compact('service_price'));
    }

    /**
     * @param ServicePriceRequest $request
     * @param ServicePrice $service_price
     * @return $this
     */
    public function edit(ServicePriceRequest $request,$hashed_id)
    {
// dd($service_price->id);
        // $id = hashids_decode($id);

        $service_price = ServicePrice::find(hashids_decode($hashed_id));

        if(!$service_price){
            abort(404);
        }
 



        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $service_price->name])]);

        return view('ERP::prices.services.create_edit')->with(compact('service_price'));
    }

    /**
     * @param ServicePriceRequest $request
     * @param ServicePrice $service_price
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ServicePriceRequest $request ,$hashed_id)
    {
        try {
         $service_price = ServicePrice::find(hashids_decode($hashed_id));

        if(!$service_price){
            abort(404);
        }

          $data = $request->except('vehicles');
                $service_price->update($data);


         flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, ServicePrice::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param ServicePriceRequest $request
     * @param ServicePrice $service_price
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(ServicePriceRequest $request, $id)
    {
        try {
            $id = hashids_decode($id);
            $service_price = ServicePrice::find($id);
            $service_price->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, ServicePrice::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}