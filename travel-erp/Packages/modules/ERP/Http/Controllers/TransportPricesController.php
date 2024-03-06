<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\TransportPricesDataTable;
use Packages\Modules\ERP\Http\Requests\TransportPriceRequest;
use Packages\Modules\ERP\Models\TransportPrice;
use Packages\Modules\ERP\Models\TransportVehiclePrice;
use Packages\Modules\ERP\Models\Vehicle;
use Packages\Modules\ERP\Models\Category;



class TransportPricesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.transportprice.resource_url');

        $this->title = 'ERP::module.transportprice.title';
        $this->title_singular = 'ERP::module.transportprice.title_singular';

        parent::__construct();
    }

    /**
     * @param TransportPriceRequest $request
     * @param TransportPricesDataTable $dataTable
     * @return mixed
     */
    public function index(TransportPriceRequest $request, TransportPricesDataTable $dataTable)
    {
        return $dataTable->render('ERP::prices.transports.index');
    }

    /**
     * @param TransportPriceRequest $request
     * @return $this
     */
    public function create(TransportPriceRequest $request)
    {
        $transport_price = new TransportPrice();

        $vehiclesTypes = Category::where('type', 'vehicles')->select('id','name')->get();


        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::prices.transports.create_edit')->with(compact('transport_price','vehiclesTypes'));
    }

    /**
     * @param TransportPriceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(TransportPriceRequest $request)
    {
        try {
                $data = $request->except('vehicles');
                $transport_price =TransportPrice::create($data);
            

                $vehicles =  $request->get('vehicles');


         if($vehicles){

            foreach ($vehicles as $vehicle) {
                    $vehicle_data = array_merge($vehicle, ['price_id' => $transport_price->id]);

                     $vehicle =TransportVehiclePrice::create($vehicle_data);
                }

         }

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, TransportPrice::class, 'store');
        }

        return redirectTo($this->resource_url);
    }
 
    /**
     * @param TransportPriceRequest $request
     * @param TransportPrice $transport_price
     * @return TransportPrice
     */
    public function show(TransportPriceRequest $request, TransportPrice $transport_price)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $transport_price->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $TransportPrice->hashed_id . '/edit']);

        return view('ERP::prices.transports.show')->with(compact('transport_price'));
    }

    /**
     * @param TransportPriceRequest $request
     * @param TransportPrice $transport_price
     * @return $this
     */
    public function edit(TransportPriceRequest $request,$hashed_id)
    {
// dd($transport_price->id);
        // $id = hashids_decode($id);

        $transport_price = TransportPrice::find(hashids_decode($hashed_id));

        if(!$transport_price){
            abort(404);
        }
 

        $vehiclesTypes = Category::where('type', 'vehicles')->select('id','name')->get();

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $transport_price->name])]);

        return view('ERP::prices.transports.create_edit')->with(compact('transport_price','vehiclesTypes'));
    }

    /**
     * @param TransportPriceRequest $request
     * @param TransportPrice $transport_price
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(TransportPriceRequest $request ,$hashed_id)
    {
        try {
         $transport_price = TransportPrice::find(hashids_decode($hashed_id));

        if(!$transport_price){
            abort(404);
        }

          $data = $request->except('vehicles');
                $transport_price->update($data);

         $transport_price->vehicles_prices()->delete();

         $vehicles =  $request->get('vehicles');

         if($vehicles){

            foreach ($vehicles as $vehicle) {
                    $vehicle_data = array_merge($vehicle, ['price_id' => $transport_price->id]);

                     $vehicle =TransportVehiclePrice::create($vehicle_data);
                }

         }


         flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, TransportPrice::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param TransportPriceRequest $request
     * @param TransportPrice $transport_price
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(TransportPriceRequest $request, $id)
    {
        try {
            $id = hashids_decode($id);
            $transport_price = TransportPrice::find($id);
            $transport_price->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, TransportPrice::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}