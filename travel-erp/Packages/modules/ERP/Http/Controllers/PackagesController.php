<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\PackagesDataTable;
use Packages\Modules\ERP\DataTables\HotelsPackagesDataTable;
use Packages\Modules\ERP\DataTables\ManualHotelsPackagesDataTable;
use Packages\Modules\ERP\DataTables\FlightsPackagesDataTable;
use Packages\Modules\ERP\DataTables\TransportsPackagesDataTable;
use Packages\Modules\ERP\DataTables\CurrentCustomersDataTable;
use Packages\Modules\ERP\DataTables\CustomerPackagesDataTable;
use Packages\Modules\ERP\Http\Requests\PackageRequest;
use Packages\Modules\ERP\Models\Order;
use Packages\Modules\ERP\Models\HotelOrder;
use Packages\Modules\ERP\Models\FlightOrder;
use Packages\Modules\ERP\Models\TransportOrder;
use Packages\Modules\ERP\Models\Customer;
use Packages\Modules\ERP\Models\Hotel;
use Packages\Modules\ERP\Models\HotelPrice;
use Packages\Modules\ERP\Models\Room;
use Packages\Modules\ERP\Models\UserErp;





class PackagesController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.package.resource_url');

        $this->title = 'ERP::module.package.title';
        $this->title_singular = 'ERP::module.package.title_singular';

        parent::__construct();
    }

    /**
     * @param PackageRequest $request
     * @param PackagesDataTable $dataTable
     * @return mixed
     */
    public function index(PackageRequest $request, PackagesDataTable $dataTable)
    {
        return $dataTable->render('ERP::packages.index');
    }

    /**
     * @param PackageRequest $request
     * @param HotelsPackagesDataTable $dataTable
     * @return mixed
     */
    public function getHotelsPackages(PackageRequest $request, HotelsPackagesDataTable $dataTable)
    {
        return $dataTable->render('ERP::packages.lists.hotels');
    }


        /**
     * @param PackageRequest $request
     * @param FlightsPackagesDataTable $dataTable
     * @return mixed
     */
    public function getFlightsPackages(PackageRequest $request, FlightsPackagesDataTable $dataTable)
    {
        return $dataTable->render('ERP::packages.lists.flights');
    }

         /**
     * @param PackageRequest $request
     * @param TransportsPackagesDataTable $dataTable
     * @return mixed
     */
    public function getTransportsPackages(PackageRequest $request, TransportsPackagesDataTable $dataTable)
    {
        return $dataTable->render('ERP::packages.lists.transports');
    }




    /**
     * @param PackageRequest $request
     * @param PackagesDataTable $dataTable
     * @param HotelOrder $order
     * @return mixed
     */
    public function getDuplicateHotel(PackageRequest $request,HotelOrder $order , PackagesDataTable $dataTable){
       // dd($customer);
        return $dataTable->render('ERP::packages.duplicates.hotels' ,compact('order'));
    }


      /**
     * @param PackageRequest $request
     * @return \Illuminate\Http\Redirec  AR1tResponse|\Illuminate\Routing\Redirector
     */
    public function postDuplicateHotel(PackageRequest $request , $id)
    {

               
        try {
                
                //dd($request->get('manual_hotels'));
                $data = $request->except('dates');
                $order =Order::create($data);

                $id = hashids_decode($id);
                $model = HotelOrder::find($id);

                $hotel = $request->get('dates');

                $model->entry_date = $hotel['entry_date'];
                $model->leave_date = $hotel['leave_date'];
                $model->reserve_code = $hotel['reserve_code'];


                $model->order_id = $order->id;

               
               // $model->save();


                $newModel = $model->replicate();
                $newModel->push();


                foreach($model->getRelations() as $relation => $items){
                    foreach($items as $item){
                        unset($item->id);
                        $newModel->{$relation}()->create($item->toArray());
                    }
                }
                
               

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'store');
        }
       // return $dataTable->render('ERP::orders.lists.hotels');
        $this->hotel_order = config('erp.models.hotel_order.resource_url');


        return redirectTo($this->hotel_order);
    }



    /**
     * @param PackageRequest $request
     * @param PackagesDataTable $dataTable
     * @param FlightOrder $order
     * @return mixed
     */
    public function getDuplicateFlight(PackageRequest $request,FlightOrder $order , PackagesDataTable $dataTable){
       // dd($customer);
        return $dataTable->render('ERP::packages.duplicates.flights' ,compact('order'));
    }


      /**
     * @param PackageRequest $request
     * @return \Illuminate\Http\Redirec  AR1tResponse|\Illuminate\Routing\Redirector
     */
    public function postDuplicateFlight(PackageRequest $request , $id)
    {

               
        try {
                
                //dd($request->get('manual_hotels'));
                $data = $request->except('dates');
                $order =Order::create($data);

                $id = hashids_decode($id);
                $model = FlightOrder::find($id);

                $model->order_id = $order->id;
               // $model->save();

                $flight = $request->get('dates');

                $model->flight_date = $flight['flight_date'];
                $model->leave_time  = $flight['leave_time'];
                $model->arrive_time = $flight['arrive_time'];
                $model->reserve_code = $flight['reserve_code'];
                $model->confirmed_reserve_code = $flight['confirmed_reserve_code'];


                $newModel = $model->replicate();
                $newModel->push();


                foreach($model->getRelations() as $relation => $items){
                    foreach($items as $item){
                        unset($item->id);
                        $newModel->{$relation}()->create($item->toArray());
                    }
                }
                
               

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'store');
        }
       // return $dataTable->render('ERP::orders.lists.hotels');
        $this->flight_order = config('erp.models.flight_order.resource_url');


        return redirectTo($this->flight_order);
    }





    /**
     * @param PackageRequest $request
     * @param PackagesDataTable $dataTable
     * @param TransportOrder $order
     * @return mixed
     */
    public function getDuplicateTransport(PackageRequest $request,TransportOrder $order , PackagesDataTable $dataTable){
       // dd($customer);
        return $dataTable->render('ERP::packages.duplicates.transports' ,compact('order'));
    }


      /**
     * @param PackageRequest $request
     * @return \Illuminate\Http\Redirec  AR1tResponse|\Illuminate\Routing\Redirector
     */
    public function postDuplicateTransport(PackageRequest $request , $id)
    {

               
        try {
                
                $data = $request->except('dates');
                $order =Order::create($data);

                $id = hashids_decode($id);
                $model = TransportOrder::find($id);

                $model->order_id = $order->id;
               // $model->save();
                $transport = $request->get('dates');

                $model->date = $transport['date'];
                $model->time = $transport['time'];
                $model->transport_order = $transport['transport_order'];


                $newModel = $model->replicate();
                $newModel->push();


                foreach($model->getRelations() as $relation => $items){
                    foreach($items as $item){
                        unset($item->id);
                        $newModel->{$relation}()->create($item->toArray());
                    }
                }
                
               

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'store');
        }
       // return $dataTable->render('ERP::orders.lists.hotels');
        $this->transport_order = config('erp.models.transport_order.resource_url');


        return redirectTo($this->transport_order);
    }

     /**
     * @param PackageRequest $request
     * @param PackagesDataTable $dataTable
     * @param TransportOrder $order
     * @return mixed
     */
    public function getDuplicateManualHotel(PackageRequest $request,HotelOrder $order , PackagesDataTable $dataTable){
       // dd($customer);
        return $dataTable->render('ERP::orders.duplicates.manual_hotels' ,compact('order'));
    }


      /**
     * @param PackageRequest $request
     * @return \Illuminate\Http\Redirec  AR1tResponse|\Illuminate\Routing\Redirector
     */
    public function postDuplicateManualHotel(PackageRequest $request , $id)
    {

               
        try {
                
                //dd($request->get('manual_hotels'));
                $data = $request->except('dates');
                $order =Order::create($data);

                $id = hashids_decode($id);
                $model = HotelOrder::find($id);

                $model->order_id = $order->id;
               // $model->save();

                $hotel = $request->get('dates');

                $model->entry_date = $hotel['entry_date'];
                $model->leave_date = $hotel['leave_date'];


                $newModel = $model->replicate();
                $newModel->push();


                foreach($model->getRelations() as $relation => $items){
                    foreach($items as $item){
                        unset($item->id);
                        $newModel->{$relation}()->create($item->toArray());
                    }
                }
                
               

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'store');
        }
       // return $dataTable->render('ERP::orders.lists.hotels');
        $this->manual_hotel_order = config('erp.models.manual_hotel_order.resource_url');


        return redirectTo($this->manual_hotel_order);
    }





    /**
     * @param PackageRequest $request
     * @return $this
     */
    public function create(PackageRequest $request)
    {
        $order = new Order();

      
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);

        return view('ERP::packages.create_edit')->with(compact('order'));
    }

    /**
     * @param PackageRequest $request
     * @return \Illuminate\Http\Redirec  AR1tResponse|\Illuminate\Routing\Redirector
     */
    public function store(PackageRequest $request)
    {

               
        try {
                

                //dd($request->get('manual_hotels'));
                $data = $request->except('hotels','flights','transports');
                $order =Order::create($data);
                $this->saveOrderHotels($request,$order);
                $this->saveOrderFlights($request,$order);
                $this->saveOrderTransports($request,$order);

            flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

    // save hotel orders data
    protected function saveOrderHotels($request,$order){
        $hotels =  $request->get('hotels');
        $order->hotelOrders()->where('order_id', $order->id)->delete();
        $index = 0;
        foreach($hotels as $hotel ){
            $country_id=$request->input("hotels.{$index}.country_id");
            if($country_id){
                $hotels_data = array_merge($hotel, ['order_id' => $order->id]);

             $hotel =HotelOrder::create($hotels_data);
            }
            $index ++;
        }
    }

     // save flight orders data
    protected function saveOrderFlights($request,$order){
        $flights =  $request->get('flights');
        $order->flightOrders()->where('order_id', $order->id)->delete();
        $index = 0;
        foreach($flights as $flight ){
            $country_id=$request->input("flights.{$index}.from_country_id");
            if($country_id){
                $flights_data = array_merge($flight, ['order_id' => $order->id]);

             $flight =FlightOrder::create($flights_data);
            }

            $index++;
        }
    }

     // save transport orders data
    protected function saveOrderTransports($request,$order){
        $transports =  $request->get('transports');
        $order->transportOrders()->where('order_id', $order->id)->delete();
        $index = 0;
        foreach($transports as $transport ){
            $country_id=$request->input("transports.{$index}.country_id");
            if($country_id){
                $transports_data = array_merge($transport, ['order_id' => $order->id]);

             $transport =TransportOrder::create($transports_data);
            }
            $index++;
        }
    }

    



    /**
     * @param PackageRequest $request
     * @param Order $order
     * @return Order
     */
    public function show(PackageRequest $request, Order $order)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $order->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Order->hashed_id . '/edit']);

        return view('ERP::orders.show')->with(compact('order'));
    }

    /**
     * @param PackageRequest $request
     * @param Order $order
     * @return $this
     */
    public function edit(PackageRequest $request,$id)
    {

        $id = hashids_decode($id);
        $order = Order::with('hotelOrders','flightOrders','transportOrders')->find($id);
       

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $this->title_singular])]);

        return view('ERP::packages.create_edit')->with(compact('order'));
    }

    /**
     * @param PackageRequest $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(PackageRequest $request ,$id)
    {
        try {
                $id = hashids_decode($id);
                $order = Order::find($id);
                $data = $request->except('hotels','flights','transports');
                $order->update($data);

                $this->saveOrderHotels($request,$order);
                $this->saveOrderFlights($request,$order);
                $this->saveOrderTransports($request,$order);

             


            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'update');
        }

        return redirectTo($this->resource_url);
    }


    /**
     * @param PackageRequest $request
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(PackageRequest $request, $id)
    {
        try {
            $id = hashids_decode($id);
            $order = Order::find($id);
            $order->delete();

            $message = ['level' => 'success', 'message' => trans('Packages::messages.success.deleted', ['item' => $this->title_singular])];
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'destroy');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];
        }

        return response()->json($message);
    }
}