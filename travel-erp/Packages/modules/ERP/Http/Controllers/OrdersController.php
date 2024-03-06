<?php

namespace Packages\Modules\ERP\Http\Controllers;

use Packages\Foundation\Http\Controllers\BaseController;
use Packages\Modules\ERP\DataTables\OrdersDataTable;
use Packages\Modules\ERP\Models\ActivityOrder;
use Packages\Modules\ERP\Models\Service;
use Packages\Modules\ERP\Models\ServiceOrder;
use Packages\Modules\ERP\Http\Requests\OrderRequest;
use Packages\Modules\ERP\Models\OrderGuest;
use Packages\Modules\ERP\Http\Requests\GuestRequest;
use Packages\Modules\ERP\Models\Supervisor;
use Packages\Modules\ERP\Http\Requests\SupervisorRequest;
use Packages\Modules\ERP\Models\Financial;
use Packages\Modules\ERP\Http\Requests\PaymentRequest;
use Packages\Modules\ERP\Models\Order;
use Packages\Modules\ERP\Models\HotelOrder;
use Packages\Modules\ERP\Models\FlightOrder;
use Packages\Modules\ERP\Models\FerryOrder;
use Packages\Modules\ERP\Models\BusOrder;
use Packages\Modules\ERP\Models\TransportOrder;
use Packages\Modules\ERP\Models\Customer;
use Packages\Modules\ERP\Models\Hotel;
use Packages\Modules\ERP\Models\HotelPrice;
use Packages\Modules\ERP\Models\Room;
use Packages\Modules\ERP\Models\Voucher;
use Packages\Modules\ERP\Models\UserErp;
use Illuminate\Http\Request;



class OrdersController extends BaseController
{
    protected $excludedRequestParams = [];

    public function __construct()
    {
        $this->resource_url = config('erp.models.order.resource_url');

        $this->title = 'ERP::module.order.title';
        $this->title_singular = 'ERP::module.order.title_singular';

        parent::__construct();
    }

    /**
     * @param OrderRequest $request
     * @param OrdersDataTable $dataTable
     * @return mixed
     */
    public function index(OrderRequest $request, OrdersDataTable $dataTable)
    {

        return $dataTable->render('ERP::orders.index');
    }


    /**
     * @param OrderRequest $request
     * @return $this
     */
    public function create(OrderRequest $request)
    {

        $order = new Order();
       
        $main_currency = getMainCurrency();

        
        $customers = UserErp::where('status', 1)->where('user_type', 'client')->get();

      
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.create_title', ['title' => $this->title_singular])]);
        

        return view('ERP::orders.create_edit')->with(compact('order', 'customers', 'main_currency'));
    }

    /**
     * @param OrderRequest $request
     * @return \Illuminate\Http\Redirec  AR1tResponse|\Illuminate\Routing\Redirector
     */
    public function store(OrderRequest $request)
    {       
    try {
        
         $mainOrder = Order::create($request->general_data);

         //hotels orders
         $hotels = $this->storeHotelOrder($request->get('hotels', []), $mainOrder);

        //flights orders
         $flights = $this->storeFlightOrder($request->get('flights', []), $mainOrder);

        //ferries orders
         $ferries = $this->storeFerryOrder($request->get('ferries', []), $mainOrder);

        //buses orders
         $buses = $this->storeBusOrder($request->get('buses', []), $mainOrder);

        //transports orders
         $transports = $this->storeTransportOrder($request->get('transports', []), $mainOrder);

        //services orders
         $services = $this->storeServiceOrder($request->get('services', []), $mainOrder);

        //activities orders
         $activities = $this->storeActivityOrder($request->get('activities', []), $mainOrder);

        //manual hotels orders
         $manual_hotels = $this->storeManualHotelOrder($request->get('manual_hotels', []), $mainOrder);

        //manual services orders
         $manual_services = $this->storeManualServiceOrder($request->get('manual_services', []), $mainOrder);


        flash(trans('Packages::messages.success.created', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'store');
        }

        return redirectTo($this->resource_url);
    }

         public function show_guests(GuestRequest $request, $order_hashed_id){
       $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);

       if(!$order){
        abort(404);
       }

        $guests = $order->guests()->get();


       $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $this->title_singular])]);
       
        return view('ERP::orders.sections.guests.index')->with(compact('order', 'guests'));
     }


    public function store_guests(GuestRequest $request, $order_hashed_id){
       $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);

       if(!$order){
        abort(404);
       }

        $guests = $order->guests()->delete();
        $guests_row = []; 

        foreach ($request->get('guests', []) as $guest) {
         $guest['order_id'] = $order->id;
         $guest = OrderGuest::create($guest);
         $guests_row[] = $guest;
        }


        flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();

     return redirectTo($this->resource_url.'/'.$order->hashed_id.'/guests');
     }

     public function show_supervisors(SupervisorRequest $request, $order_hashed_id){
       $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);

       if(!$order){
        abort(404);
       }

        $supervisors = $order->supervisors()->get();


       $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $this->title_singular])]);
       
        return view('ERP::orders.sections.supervisors.index')->with(compact('order', 'supervisors'));
     }


    public function store_supervisors(SupervisorRequest $request, $order_hashed_id){
       $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);

       if(!$order){
        abort(404);
       }

        $supervisors = $order->supervisors()->delete();
        $supervisors_row = []; 

        foreach ($request->get('supervisors', []) as $supervisor) {
         $supervisor = Supervisor::create([
          'supervisorable_id' => $order->id,
          'supervisorable_type' => 'erp_main_order',
          'user_id' => $supervisor['user_id'],
          'permissions' => json_encode(isset($supervisor['permissions'])?$supervisor['permissions']:[]),
          'roles' => json_encode(isset($supervisor['roles'])?$supervisor['roles']:[]),
         ]);
         $supervisors_row[] = $supervisor;
        }


        flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();

     return redirectTo($this->resource_url.'/'.$order->hashed_id.'/supervisors');
     }

     


      public function generate_pdf(Request $request, $order_hashed_id){
       $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);
       if(!$order){
        return abort(404);
       }

      
        if($order->voucher){

          $voucher = $order->voucher()->first();

        }else{

          $voucher = new Voucher;

        }


        $show_as = $request->get('show_as')?:'web';
        $show_original = $request->get('show_original')?:'false';


       $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => __('ERP::attributes.vouchers.voucher')])]);
       $data = [];
      $view = html_entity_decode(view('ERP::orders.sections.vouchers.create_edit')->with(compact('order', 'voucher', 'show_as','show_original')));
      $pdf = \App::make('dompdf.wrapper');

      $pdf->loadHTML($view);
     return $pdf->stream();



       
        return view('ERP::orders.sections.vouchers.create_edit')->with(compact('order', 'voucher', 'show_as','show_original'));
     }


      public function edit_voucher(Request $request, $order_hashed_id){
       $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);
       if(!$order){
        return abort(404);
       }

      
        if($order->voucher){

          $voucher = $order->voucher()->first();

        }else{

          $voucher = new Voucher;

        }


        $show_as = $request->get('show_as')?:'web';
        $show_original = $request->get('show_original')?:'false';


       $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => __('ERP::attributes.vouchers.voucher')])]);
       
        return view('ERP::orders.sections.vouchers.create_edit')->with(compact('order', 'voucher', 'show_as','show_original'));
     }

      public function store_voucher(Request $request, $order_hashed_id){
        try{
       $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);

       if(!$order){
        return abort(404);
       }

       $records = [];

       $records['settings'] = json_encode($request->get('settings', []));
       if($request->get('show_as') == 'web'){
        $records['web_html_content'] = $request->get('web_html_content');
       }else{
        $records['text_html_content'] = $request->get('text_html_content');
       }

       if($order->voucher){
        $order->voucher()->first()->update($records);
        $voucher = $order->voucher;
       }else{
         $voucher = $order->voucher()->create($records);
       }


       $show_as = $request->get('show_as')?:'web';

       $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $this->title_singular])]);

       flash(trans('Packages::messages.success.updated', ['item' => __('ERP::attributes.vouchers.voucher')]))->success();
       
        return redirectTo($this->resource_url.'/'.$order->hashed_id.'/edit_voucher?show_as='.$show_as);
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'store');
        }
     }

     




     public function show_payments($order_hashed_id){
       $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);

       if(!$order){
        return abort(404);
       }


        $payment = new Financial;

       $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $this->title_singular])]);
       
        return view('ERP::orders.sections.payments.index')->with(compact('order', 'payment'));
     }

     public function create_payment($order_hashed_id){
       $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);

       if(!$order){
        return abort(404);
       }


        $payment = new Financial;

       $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => $this->title_singular])]);
       
        return view('ERP::orders.sections.payments.create_edit')->with(compact('order', 'payment'));
     }




    public function store_payment(PaymentRequest $request, $order_hashed_id){

      $data = $request->except(['select_commission', 'commission']);
      $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);

      if(!$order){
        return abort(404);
       }

       $data['math_type']='plus';
       $data['type']='booking';
       $data['final_value'] = $data['reg_value'];
       $main_description = ['en'=> __('ERP::attributes.financials.disacriptions.main_payment_order', ['type' => __('ERP::attributes.financials.orders_sub_types_options.'.$data['sub_type'],[], 'en'), 'order_code' => $order->reg_code ],'en'), 'ar' =>__('ERP::attributes.financials.disacriptions.main_payment_order', ['type' => __('ERP::attributes.financials.orders_sub_types_options.'.$data['sub_type'],[], 'ar'), 'order_code' => $order->reg_code ],'ar') ];
       if(empty($request->input('description.ar')) && empty($request->input('description.en'))){
         $data['description'] = $main_description;
       }

      $financial = Financial::create($data);



      if($request->get('select_commission') == 'yes'){
        $request_commession = $request->get('commission', []);
        $com_description = ['en'=> __('ERP::attributes.financials.disacriptions.commission_order', ['order' => $order->reg_code],'en'), 'ar' =>__('ERP::attributes.financials.disacriptions.commission_order', ['order' => $order->reg_code],'ar') ];
        if($request_commession['value_type'] == 'percent'){
          $request_commession['final_value'] = $data['reg_value'] * ((float)$request_commession['reg_value']/100);

        }else{
          $request_commession['final_value'] = $request_commession['reg_value'];
        }

        $request_commession['parent_relation_type'] = 'minus';

        $request_commession['parent_id'] = $financial->id;
       $request_commession['sub_type']='commission';
        $request_commession['description']= $com_description;
        $removeKeys = ['fees_percent', 'category_id', 'pay_method_id', 'payment_date', 'recipient_id','notes','refrence_code'];
        $data = array_diff_key($data, array_flip($removeKeys));

        $commission_data = array_merge($data,$request_commession);

       $commission = Financial::create($commission_data);
       //Store payments in financial accounts
      }

      if($request->get('status') == 1){

        $amount_value_1 = (float)$data['final_value'] - (float)$request_commession['final_value'];
        if($amount_value_1 < 0){
          $amount_value_1 = 0;
        }

        if($to_account = $financial->to_account()->first()){
          $old_amount = $financial->to_account->balance;

        $financial->to_account()->update(['balance' => (float)amountCurrencyChange($amount_value_1,$paymentCurrencyRate,$to_account_currency_rate) + (float)$old_amount]);

               //create new deposet to account of this process

        if($request->get('select_commission') == 'yes'){
          $real_value = (float)$data['final_value'] - (float)$request_commession['final_value'];
        }else{

          $real_value = (float)$data['final_value'];

        }

          $new_financial = Financial::create([
              'type' => 'deposit',
              'sub_type' => 'confirm',
              'math_type' => 'plus',
              'value_type' => 'amount',
              'parent_relation_type' => 'balanced',
              'parent_id' => $financial->id,
              'reg_value' => $real_value,
              'final_value' => $real_value,
              'status' => 1,
              'value_currency_rate' => $data['value_currency_rate'],
              'old_currency_rate' => $data['old_currency_rate'],
              'main_currency_rate' => $data['main_currency_rate'],
              'to_account_rate' => $to_account->currency?$to_account->currency->exchange_rate:1,
              'to_account_currency_id' => $to_account->currency?$to_account->currency->id:null,
              'to_account_id' => $to_account->id,
              'value_currency_id' => $data['value_currency_id'],
              'main_currency_id' => $data['main_currency_id'],
              'pay_method_id' => $data['pay_method_id'],
              'fees_percent' => $data['fees_percent'],
            ]);
      }

      if(isset($commission) && $commission->to_account){
        $old_amount = $commission->to_account->balance;
        $commission->to_account()->update(['balance' => (float)$old_amount + (float)$request_commession['final_value']]);

                  $new_financial = Financial::create([
              'type' => 'deposit',
              'sub_type' => 'confirm',
              'math_type' => 'plus',
              'value_type' => 'amount',
              'parent_relation_type' => 'balanced',
              'parent_id' => $commission->id,
              'reg_value' => (float)$request_commession['final_value'],
              'final_value' => (float)$request_commession['final_value'],
              'status' => 1,
              'value_currency_rate' => $data['value_currency_rate'],
              'old_currency_rate' => $data['old_currency_rate'],
              'main_currency_rate' => $data['main_currency_rate'],
              'to_account_rate' => $to_account->currency?$to_account->currency->exchange_rate:1,
              'to_account_currency_id' => $to_account->currency?$to_account->currency->id:null,
              'to_account_id' => $to_account->id,
              'value_currency_id' => $data['value_currency_id'],
              'main_currency_id' => $data['main_currency_id'],
              'pay_method_id' => $data['pay_method_id'],
            ]);
      }

    } //end status


        flash(trans('Packages::messages.success.created', ['item' => __('ERP::attributes.financials.payment_no_msg_name', ['code' => $data['reg_code']])]))->success();

     return redirectTo($this->resource_url.'/'.$order->hashed_id.'/payments');
     }

    public function ajax_voucher_payment($order_hashed_id, $payment_hashed_id){
       $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);

       if(!$order){
        return abort(404);
       }

        $payment_id = hashids_decode($payment_hashed_id);

        $payment = Financial::find($payment_id);

       if(!$payment){
        return abort(404);
       }
       
        return view('ERP::orders.sections.payments.ajax_voucher')->with(compact('order', 'payment'));
     }

           public function ajax_show_payment($order_hashed_id, $payment_hashed_id){
       $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);

       if(!$order){
        return abort(404);
       }

        $payment_id = hashids_decode($payment_hashed_id);

        $payment = Financial::find($payment_id);

       if(!$payment){
        return abort(404);
       }
       
        return view('ERP::orders.sections.payments.ajax_show')->with(compact('order', 'payment'));
     }

     

      public function ajax_edit_payment($order_hashed_id, $payment_hashed_id){
       $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);

       if(!$order){
        return abort(404);
       }

        $payment_id = hashids_decode($payment_hashed_id);

        $payment = Financial::find($payment_id);

       if(!$payment){
        return abort(404);
       }
       
        return view('ERP::orders.sections.payments.ajax_edit')->with(compact('order', 'payment'));
     }



      public function ajax_update_payment(PaymentRequest $request,$order_hashed_id, $payment_hashed_id){

           try{


      $data = $request->except(['select_commission', 'commission']);
      $order_id = hashids_decode($order_hashed_id);
       $order = Order::find($order_id);

      if(!$order){
        $message = ['level' => 'error', 'message' => 'not found order'];
        return response()->json($message);

       }

       $payment_id = hashids_decode($payment_hashed_id);
       $payment = Financial::find($payment_id);

      if(!$payment){
        $message = ['level' => 'error', 'message' => 'not found this financial process'];
        return response()->json($message);

       }



      $payment->update($data);

      if(!$data['status'] == $payment->status){

          $children_value = $payment->children()->where('parent_relation_type', 'minus')->sum('final_value');
          $real_value = $payment->final_value - $children_value;
          if($real_value < 0){
            $real_value = 0;
          }

          $paymentCurrencyRate = $data['value_currency_rate'];


        if($data['status'] == 1){

          if($to_account = $payment->to_account()->first()){
            $to_account_currency_rate = $to_account->currency?$to_account->currency->exchange_rate:1;
            $to_account_new_value = (float)$to_account->balance +  (float)amountCurrencyChange($real_value,$paymentCurrencyRate,$to_account_currency_rate);
            $payment->to_account()->update(['balance' => $to_account_new_value]);

            //create new modified financial process for this process

            $new_financial = Financial::create([
              'type' => 'deposit',
              'sub_type' => 'modify',
              'math_type' => 'plus',
              'value_type' => 'amount',
              'parent_relation_type' => 'balanced',
              'parent_id' => $payment->id,
              'reg_value' => $real_value,
              'final_value' => $real_value,
              'status' => 1,
              'value_currency_rate' => $data['value_currency_rate'],
              'old_currency_rate' => $data['old_currency_rate'],
              'main_currency_rate' => $data['main_currency_rate'],
              'to_account_rate' => $to_account->currency?$to_account->currency->exchange_rate:1,
              'to_account_currency_id' => $to_account->currency?$to_account->currency->id:null,
              'to_account_id' => $to_account->id,
              'value_currency_id' => $data['value_currency_id'],
              'main_currency_id' => $data['main_currency_id'],
              'pay_method_id' => $payment->pay_method_id,
              'fees_percent' => $payment->fees_percent,
            ]);

          }

        }else{
          if($payment->status == 1){



           if($to_account = $payment->to_account()->first()){
            $to_account_currency_rate = $to_account->currency?$to_account->currency->exchange_rate:1;
            $to_account_new_value = (float)$to_account->balance -  (float)amountCurrencyChange($real_value,$paymentCurrencyRate,$to_account_currency_rate);
            if($to_account_new_value < 0){
                          $message = [
                'level' => 'error', 'message' => __('ERP::messages.financials.account_not_have_credit_to_refund',['no' => $to_account->account_code])
            ];

              return response()->json($message);
            }
            $payment->to_account()->update(['balance' => $to_account_new_value]);

        //create new modified financial process for this process

            $new_financial = Financial::create([
              'type' => 'withdrawal',
              'sub_type' => 'modify',
              'math_type' => 'minus',
              'value_type' => 'amount',
              'parent_relation_type' => 'balanced',
              'parent_id' => $payment->id,
              'reg_value' => $real_value,
              'final_value' => $real_value,
              'status' => 1,
              'value_currency_rate' => $data['value_currency_rate'],
              'old_currency_rate' => $data['old_currency_rate'],
              'main_currency_rate' => $data['main_currency_rate'],
              'from_account_rate' => $to_account->currency?$to_account->currency->exchange_rate:1,
              'from_account_currency_id' => $to_account->currency?$to_account->currency->id:null,
              'from_account_id' => $to_account->id,
              'value_currency_id' => $data['value_currency_id'],
              'main_currency_id' => $data['main_currency_id'],
              'pay_method_id' => $payment->pay_method_id,

            ]);

          }
        } //end payment status

        } //end else

      }
            


            $message = [
                'action' => 'redirectTo', 'url' => url($this->resource_url.'/'.$order->hashed_id.'/payments'),
                'level' => 'success', 'message' => trans('Packages::messages.success.updated', ['item' => __('ERP::attributes.financials.payment_no_msg_name', ['code' => $data['reg_code']])])
            ];
        } catch (\Exception $exception) {
            log_exception($exception, Setting::class, 'update');
            $message = ['level' => 'error', 'message' => $exception->getMessage()];

        }

        return response()->json($message);
     }






    public function storeHotelOrder($request, $mainOrder)
    {

     $hotel_orders = [];
     if(!empty($request)){
        
         foreach ($request as $hotel) {
            if($hotel['room_price_type'] == 'auto'){
              $hotel['price'] = $hotel['auto_room_price'];
              $hotel['cost'] = $hotel['auto_room_cost'];
              $hotel['extra_bed_price'] = $hotel['auto_extra_bed_price'];
              $hotel['extra_bed_cost'] = $hotel['auto_extra_bed_cost'];

             }
            $id = null;
             if (isset($hotel['hotel_order_id'])) {
             $hotel_hashed_id = $hotel['hotel_order_id'];
             $id = hashids_decode($hotel_hashed_id);
              }

             unset($hotel['auto_room_price'], $hotel['auto_room_cost'], $hotel['auto_extra_bed_price'], $hotel['auto_extra_bed_cost'], $hotel['hotel_order_id']);
             if($id){

                $hotel_order = $mainOrder->hotelsOrders()->where('id', $id)->first();
                if($hotel_order){
                   $hotel_order->update($hotel);
                   $hotel_orders[] = $hotel_order;
                }
                

             }else{
             $hotel['order_id'] = $mainOrder->id;
             $hotel_order = HotelOrder::create($hotel);
             $hotel_orders[] = $hotel_order;
             }
         }
     }

     return $hotel_orders;

     }


    public function storeFlightOrder($request, $mainOrder)
    {

     $flight_orders = [];
     if(!empty($request)){
        
         foreach ($request as $flight) {

            if($flight['price_type'] == 'auto'){

              $flight['adult_price'] = $flight['auto_adult_price'];
              $flight['adult_cost'] = $flight['auto_adult_cost'];

              $flight['child_price'] = $flight['auto_child_price'];
              $flight['child_cost'] = $flight['auto_child_cost'];

              $flight['infant_price'] = $flight['auto_infant_price'];
              $flight['infant_cost'] = $flight['auto_infant_cost'];

              $flight['baggage_price'] = $flight['auto_baggage_price'];
              $flight['baggage_cost'] = $flight['auto_baggage_cost'];

             }
            $id = null;
             if (isset($flight['flight_order_id'])) {
             $flight_hashed_id = $flight['flight_order_id'];
             $id = hashids_decode($flight_hashed_id);
              }

             unset($flight['auto_adult_price'], $flight['auto_adult_cost'], $flight['auto_child_price'], $flight['auto_child_cost'],$flight['auto_infant_price'], $flight['auto_infant_cost'], $flight['auto_baggage_price'], $flight['auto_baggage_cost'],$flight['flight_order_id']);

                          if($id){

                $flight_order = $mainOrder->flightsOrders()->where('id', $id)->first();
                if($flight_order){
                   $flight_order->update($flight);
                   $flight_orders[] = $flight_order;
                }
                

             }else{
             $flight['order_id'] = $mainOrder->id;
             $flight_order = FlightOrder::create($flight);
             $flight_orders[] = $flight_order;
         }
         }
     }

     return $flight_orders;

     }


    public function storeFerryOrder($request, $mainOrder)
    {

     $ferry_orders = [];
     if(!empty($request)){
        
         foreach ($request as $ferry) {

            if($ferry['price_type'] == 'auto'){

              $ferry['adult_price'] = $ferry['auto_adult_price'];
              $ferry['adult_cost'] = $ferry['auto_adult_cost'];

              $ferry['child_price'] = $ferry['auto_child_price'];
              $ferry['child_cost'] = $ferry['auto_child_cost'];

              $ferry['infant_price'] = $ferry['auto_infant_price'];
              $ferry['infant_cost'] = $ferry['auto_infant_cost'];

              $ferry['baggage_price'] = $ferry['auto_baggage_price'];
              $ferry['baggage_cost'] = $ferry['auto_baggage_cost'];

             }

                         $id = null;
             if (isset($ferry['ferry_order_id'])) {
             $ferry_hashed_id = $ferry['ferry_order_id'];
             $id = hashids_decode($ferry_hashed_id);
              }

             unset($ferry['auto_adult_price'], $ferry['auto_adult_cost'], $ferry['auto_child_price'], $ferry['auto_child_cost'],$ferry['auto_infant_price'], $ferry['auto_infant_cost'], $ferry['auto_baggage_price'], $ferry['auto_baggage_cost'],$ferry['ferry_order_id']);
                if($id){

                $ferry_order = $mainOrder->ferriesOrders()->where('id', $id)->first();
                if($ferry_order){
                   $ferry_order->update($ferry);
                   $ferry_orders[] = $ferry_order;
                }
                

             }else{
             $ferry['order_id'] = $mainOrder->id;
             $ferry_order = FerryOrder::create($ferry);
             $ferry_orders[] = $ferry_order;
         }
         }
     }

     return $ferry_orders;

     }


    public function storeBusOrder($request, $mainOrder)
    {

     $bus_orders = [];
     if(!empty($request)){
        
         foreach ($request as $bus) {

            if($bus['price_type'] == 'auto'){

              $bus['adult_price'] = $bus['auto_adult_price'];
              $bus['adult_cost'] = $bus['auto_adult_cost'];

              $bus['child_price'] = $bus['auto_child_price'];
              $bus['child_cost'] = $bus['auto_child_cost'];

              $bus['infant_price'] = $bus['auto_infant_price'];
              $bus['infant_cost'] = $bus['auto_infant_cost'];

              $bus['baggage_price'] = $bus['auto_baggage_price'];
              $bus['baggage_cost'] = $bus['auto_baggage_cost'];

             }

            $id = null;
             if (isset($bus['bus_order_id'])) {
             $bus_hashed_id = $bus['bus_order_id'];
             $id = hashids_decode($bus_hashed_id);
              }

             unset($bus['auto_adult_price'], $bus['auto_adult_cost'], $bus['auto_child_price'], $bus['auto_child_cost'],$bus['auto_infant_price'], $bus['auto_infant_cost'], $bus['auto_baggage_price'], $bus['auto_baggage_cost'], $bus['bus_order_id']);

              if($id){

                $bus_order = $mainOrder->busesOrders()->where('id', $id)->first();
                if($bus_order){
                   $bus_order->update($bus);
                   $bus_orders[] = $bus_order;
                }
                

             }else{

             $bus['order_id'] = $mainOrder->id;
             $bus_order = BusOrder::create($bus);
             $bus_orders[] = $bus_order;
         }
         }
     }

     return $bus_orders;

     }


    public function storeActivityOrder($request, $mainOrder)
    {

     $activity_orders = [];
     if(!empty($request)){
        
         foreach ($request as $activity) {

            if($activity['price_type'] == 'auto'){

              $activity['adult_price'] = $activity['auto_adult_price'];
              $activity['adult_cost'] = $activity['auto_adult_cost'];

              $activity['child_price'] = $activity['auto_child_price'];
              $activity['child_cost'] = $activity['auto_child_cost'];

              $activity['infant_price'] = $activity['auto_infant_price'];
              $activity['infant_cost'] = $activity['auto_infant_cost'];

             }

            $id = null;
             if (isset($activity['activity_order_id'])) {
             $activity_hashed_id = $activity['activity_order_id'];
             $id = hashids_decode($activity_hashed_id);
              }

             unset($activity['auto_adult_price'], $activity['auto_adult_cost'], $activity['auto_child_price'], $activity['auto_child_cost'],$activity['auto_infant_price'], $activity['auto_infant_cost'], $activity['auto_baggage_price'], $activity['auto_baggage_cost'], $activity['activity_order_id']);
            if($id){

                $activity_order = $mainOrder->activitiesOrders()->where('id', $id)->first();
                if($activity_order){
                   $activity_order->update($activity);
                   $activity_orders[] = $activity_order;
                }
                

             }else{
             $activity['order_id'] = $mainOrder->id;
             $activity_order = ActivityOrder::create($activity);
             $activity_orders[] = $activity_order;
         }
         }
     }

     return $activity_orders;

     }



    public function storeTransportOrder($request, $mainOrder)
    {

     $transport_orders = [];
     if(!empty($request)){
        
         foreach ($request as $transport) {

            if($transport['price_type'] == 'auto'){

              $transport['vehicle_price'] = $transport['auto_vehicle_price'];
              $transport['vehicle_cost'] = $transport['auto_vehicle_cost'];

             }
                         $id = null;
             if (isset($transport['transport_order_id'])) {
             $transport_hashed_id = $transport['transport_order_id'];
             $id = hashids_decode($transport_hashed_id);
              }

             unset($transport['auto_vehicle_price'], $transport['auto_vehicle_cost'], $transport['transport_order_id']);

                         if($id){

                $transport_order = $mainOrder->transportsOrders()->where('id', $id)->first();
                if($transport_order){
                   $transport_order->update($transport);
                   $transport_orders[] = $transport_order;
                }
                

             }else{

             $transport['order_id'] = $mainOrder->id;
             $transport_order = TransportOrder::create($transport);
             $transport_orders[] = $transport_order;

         }
         }
     }

     return $transport_orders;

     }


    public function storeServiceOrder($request, $mainOrder)
    {

     $service_orders = [];
     if(!empty($request)){
        
         foreach ($request as $service) {

            if($service['price_type'] == 'auto'){

              $service['price'] = $service['auto_price'];
              $service['cost'] = $service['auto_cost'];

             }

                         $id = null;
             if (isset($service['service_order_id'])) {
             $service_hashed_id = $service['service_order_id'];
             $id = hashids_decode($service_hashed_id);
              }

             unset($service['auto_price'], $service['auto_cost'], $service['service_order_id']);

                         if($id){

                $service_order = $mainOrder->servicesOrders()->where('id', $id)->first();
                if($service_order){
                   $service_order->update($service);
                   $service_orders[] = $service_order;
                }
                

             }else{

             $service['order_id'] = $mainOrder->id;
             $service_order = ServiceOrder::create($service);
             $service_orders[] = $service_order;
         }
         }
     }
     return $service_orders;

     }



    public function storeManualHotelOrder($request, $mainOrder)
    {

     $hotel_orders = [];
     if(!empty($request)){
        
         foreach ($request as $hotel) {

            $hotel_data = [
                'name' => $hotel['hotel_name'],
                'country_id' => $hotel['country_id'],
                'city_id' => $hotel['city_id'],
                'status' => 1
            ];

            $new_hotel = Hotel::create($hotel_data);

            $room_data = [
                'name' => $hotel['room_name'],
                'hotel_id' => $new_hotel->id,
                'category_id' => $hotel['category_id'],
                'status' => 1
            ];

            $new_room = Room::create($room_data);

             unset($hotel['hotel_name'], $hotel['room_name'], $hotel['category_id']);

             $hotel['hotel_id'] = $new_hotel->id;
             $hotel['room_id'] = $new_room->id;
             $hotel['order_id'] = $mainOrder->id;

             $hotel_order = HotelOrder::create($hotel);
             $hotel_orders[] = $hotel_order;
         }
     }

     return $hotel_orders;

     }



    public function storeManualServiceOrder($request, $mainOrder)
    {

     $service_orders = [];
     if(!empty($request)){
        
         foreach ($request as $service) {

            $service_data = [
                'name' => $service['service_name'],
                'country_id' => $service['country_id'],
                'city_id' => $service['city_id'],
                'status' => 1
            ];

            $new_service = Service::create($service_data);

             unset($service['service_name']);

             $service['order_id'] = $mainOrder->id;
             $service['service_id'] = $new_service->id;
             $service_order = ServiceOrder::create($service);
             $service_orders[] = $service_order;
         }
     }
     return $service_orders;

     }



    /**
     * @param OrderRequest $request
     * @param Order $order
     * @return Order
     */
    public function show(OrderRequest $request, Order $order)
    {
        $this->setViewSharedData(['title_singular' => trans('Packages::labels.show_title', ['title' => $order->name])]);

        $this->setViewSharedData(['edit_url' => $this->resource_url . '/' . $Order->hashed_id . '/edit']);

        return view('ERP::orders.show')->with(compact('order'));
    }

    /**
     * @param OrderRequest $request
     * @param Order $order
     * @return $this
     */
    public function edit(OrderRequest $request,$hashed_id)
    {

        $id = hashids_decode($hashed_id);
        $order = Order::with('hotelsOrders', 'ferriesOrders')->find($id);

        if(!$order){
            return abort(404);
        }

         $main_currency = getMainCurrency();

        
        $customers = UserErp::where('status', 1)->where('user_type', 'client')->get();

      

        $this->setViewSharedData(['title_singular' => trans('Packages::labels.update_title', ['title' => trans('ERP::attributes.order.order').'-'.$order->reg_code])]);

        return view('ERP::orders.create_edit')->with(compact('order', 'main_currency', 'customers'));
    }

    /**
     * @param OrderRequest $request
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(OrderRequest $request ,$hashed_id)
    {
        try {

                $id = hashids_decode($hashed_id);
                $mainOrder = Order::find($id);

                        if(!$mainOrder){
            return abort(404);
        }

         $mainOrder->update($request->general_data);

         //hotels orders
         $hotels = $this->storeHotelOrder($request->get('hotels', []), $mainOrder);

        // //flights orders
         $flights = $this->storeFlightOrder($request->get('flights', []), $mainOrder);

        // //ferries orders
         $ferries = $this->storeFerryOrder($request->get('ferries', []), $mainOrder);

        // //buses orders
         $buses = $this->storeBusOrder($request->get('buses', []), $mainOrder);

        // //transports orders
         $transports = $this->storeTransportOrder($request->get('transports', []), $mainOrder);

        // //services orders
         $services = $this->storeServiceOrder($request->get('services', []), $mainOrder);

        //activities orders
         $activities = $this->storeActivityOrder($request->get('activities', []), $mainOrder);

        // //manual hotels orders
         $manual_hotels = $this->storeManualHotelOrder($request->get('manual_hotels', []), $mainOrder);

        // //manual services orders
         $manual_services = $this->storeManualServiceOrder($request->get('manual_services', []), $mainOrder);



             


            flash(trans('Packages::messages.success.updated', ['item' => $this->title_singular]))->success();
        } catch (\Exception $exception) {
            log_exception($exception, Order::class, 'update');
        }

        return redirectTo($this->resource_url);
    }



      // update hotel orders data
    protected function updateOrderHotels($request,$order){
        $hotels =  $request->get('hotels');
       // $order->hotelOrders()->sync($hotels , false);

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


    /**
     * @param OrderRequest $request
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(OrderRequest $request, $id)
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