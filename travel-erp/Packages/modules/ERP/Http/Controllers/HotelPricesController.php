<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\HotelPricesDataTable;
use Packages\Modules\ERP\Http\Requests\HotelPriceRequest;
use Packages\Modules\ERP\Models\HotelPrice;
use Packages\Modules\ERP\Models\HotelPriceDate;
use Packages\Modules\ERP\Models\Day;



class HotelPricesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.hotelprice.resource_url');

        $this->title = 'ERP::module.hotelprice.title';
        $this->title_singular = 'ERP::module.hotelprice.title_singular';

        parent::__construct();
    }

    /**
     * @param HotelPriceRequest $request
     * @param HotelPricesDataTable $dataTable
     * @return mixed
     */
    public function index(HotelPriceRequest $request, HotelPricesDataTable $dataTable)
    {
        return $dataTable->render('ERP::prices.hotels.index');
    }

    /**
     * @param HotelPriceRequest $request
     * @return $this
     */
    public function create(HotelPriceRequest $request)
    {
        $hotel_price = new HotelPrice();

        
        $dates = $hotel_price->hotel_price_dates();


        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::prices.hotels.create_edit')->with(compact('hotel_price','dates'));
    }

    /**
     * @param HotelPriceRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(HotelPriceRequest $request,HotelPrice $hotel_price)
    {
        try {
            if($price_days = $request->get('days', [])){

            $request->merge(['price_days' => json_encode($price_days)]);

            }
            
                $data = $request->except('dates','days');
                

                $hotel_price =HotelPrice::create($data);

               
               if($dates =  $request->get('dates', [])){



                 foreach ($dates as $row) {
                   $hotel_price->hotel_price_dates()->create($row);

                }

               }





            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, HotelPrice::class, 'store');
        }

        return redirectTo($this->resource_url);
    }
 
    /**
     * @param HotelPriceRequest $request
     * @param HotelPrice $hotel_price
     * @return HotelPrice
     */
    public function show(HotelPriceRequest $request, HotelPrice $hotel_price)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $hotel_price->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $HotelPrice->hashed_id . '/edit']);

        return view('ERP::prices.hotels.show')->with(compact('hotel_price'));
    }

    /**
     * @param HotelPriceRequest $request
     * @param HotelPrice $hotel_price
     * @return $this
     */
    public function edit(HotelPriceRequest $request,$hashed_id)
    {

       // $vehicles = Vehicle::select('id','name')->get();
        $id = hashids_decode($hashed_id);
        $hotel_price = HotelPrice::with('hotel_price_dates')->find($id);

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $hotel_price->name])]);

        return view('ERP::prices.hotels.create_edit')->with(compact('hotel_price','days'));
    }

    /**
     * @param HotelPriceRequest $request
     * @param HotelPrice $hotel_price
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(HotelPriceRequest $request ,$hashed_id)
    {
        try {
           // dd($request->all());
                

                $id = hashids_decode($hashed_id);
                $hotel_price = HotelPrice::find($id);

                if(!$hotel_price){
                    abort(404);
                }

                

          if($price_days = $request->get('days', [])){

            $request->merge(['price_days' => json_encode($price_days)]);

            }
            
                $data = $request->except('dates','days');
                $hotel_price->update($data);

               
                $hotel_price->hotel_price_dates()->delete();

               if($dates =  $request->get('dates', [])){



                 foreach ($dates as $row) {
                   $hotel_price->hotel_price_dates()->create($row);

                }

               }


                     
                
            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (Exception $exception) {
            log_exception($exception, HotelPrice::class, 'update');
        }

        return redirectTo($this->resource_url);
    }

    /**
     * @param HotelPriceRequest $request
     * @param HotelPrice $hotel_price
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(HotelPriceRequest $request, $id)
    {
        try {
            $id = hashids_decode($id);
            $hotel_price = HotelPrice::find($id);
            $hotel_price->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, HotelPrice::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}