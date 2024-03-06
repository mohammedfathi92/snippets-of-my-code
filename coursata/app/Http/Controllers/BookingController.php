<?php

namespace Corsata\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Corsata\Http\Controllers\backend\BackendBaseController;
use Illuminate\Support\Facades\Auth;
use Corsata\Country;
use Corsata\User;
use Corsata\City;
use Corsata\Booking;
use Corsata\BookedService;
use URL;
use PDF;
use Redirect;
use Illuminate\Support\Facades\Input;
use Corsata\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Paypal as Paypalpayment;

class BookingController extends Controller
{
    private $_apiContext;

    function __construct()
    {
        parent::__construct();
        $this->_apiContext = Paypalpayment::apiContext(config("paypal_payment.Account.ClientId"), config("paypal_payment.Account.ClientSecret"));
    }



    function index(Request $request, $id = 0, $slug = null)
    {

      if (!Auth::user()) {

            return redirect()->route("login")->with(['message' => trans("auth.must_login"), 'alert-type' => 'error']);
        }
  

        $course = Course::published()
            ->with(["institute" => function ($q) {
                $q->with(["services" => function ($s) {
                    $s->groupBy("type");
                }])
                    ->with("housingServices");
                    // ->with("transportingServices");
            }])
            ->with("gallery")
            ->find($id);

        if (!$course) {
            return abort(404);
        }

        // // if (!$course) redirect()->back()->with(["message" => "courses.id_not_found", "alert-type" => "error"]);
        // $total_price = (double)0.0;

        // $weeks = (int)$request->get("weeks") ?: 1;

        // $course->slug = str_slug($course->{"name:en"});
        // $course->url = url("/courses/{$course->id}-{$course->slug}?" . http_build_query($request->all()));
        // $course->price *= $weeks;// calcPrice($course, $course->price);
        // $course->offer_price *= $weeks;// calcPrice($course, $course->offer_price);
        // $course->short_description = str_limit(strip_tags($course->description), 200);
        // $course->photo_path = url("files/{$course->photo}?size=293,220&encode=jpg");
        // $course->institute->url = url("institutes/{$course->institute->id}-" . str_slug($course->institute->{"name:en"}));
        // $shs = $request->query("hType");// Selected Housing Service;
        // $sts = $request->query("tType");// Selected Transporting Service;
        // $total_price += $course->price;

        // foreach ($course->institute->services as $service) {
        //     // if housing service is selected
        //     if ($service->type == 'house' && $shs && $service->id == $shs && $request->query('housing') == 'y') {
        //         $hw = (int)$request->query('hWeeks') ?: 1;
        //         $total_price += ($service->price * $hw) + $service->fees;
        //     }
        //     if ($service->type == 'transport' && $sts && $service->id == $sts && $request->query('transporting') == 'y') {
        //         $total_price += $service->price + $service->fees;
        //     }
        //     if ($service->type == 'insurance' && $request->query('insurance') == 'y') {
        //         $total_price += $service->price + $service->fees;
        //     }
        // }
        

        $course = $this->calculateCourseCost($request,$course);//(double)$total_price;

        $institute = $course->institute;
        $this->data['title'] = trans("bookings.page_title") . " - " . $this->data['title'];
        $this->data['course'] = $course;
        $this->data['institute'] = $institute;
        return view("frontend.booking.index", $this->data);

    }

    private function calculateCourseCost(Request $request,$course)
    {


            
              $total_price = (double)0.0;

              $weeks = (int)$request->query("weeks") ?: 1;
              $course->price *= $weeks;// calcPrice($course, $course->price);
              $course->offer_price *= $weeks;// calcPrice($course, $course->offer_price);
              $shs = $request->query("hType");// Selected Housing Service;
              // $sts = $request->query("tType");// Selected Transporting Service;

              
              $total_price += $course->offer_price?:$course->price;
              $selectedServices=[];
              foreach ($course->institute->services as $service) {
                  // if housing service is selected
                  if ($service->type == 'house' && $shs && $service->id == $shs && $request->query('housing') == 'y') {
                      $hw = (int)$request->query('hWeeks') ?: 1;
                      $total_price += ($service->price * $hw) + $service->fees;
                      $servicePrice = ($service->price * $hw) + $service->fees;


                      $selectedServices[]= ['type'=>'house','name'=>$service->name, 'house_type' => $service->house_type, 'service_id'=>$service->id, 'week_price' => $service->price  ,'total_price'=>$servicePrice,'num_weeks'=>$hw];
                  }
                   

                  if ($service->type == 'transport' && $request->query('transporting') == 'y') {
                      $total_price += $service->price + $service->fees;
                      $servicePrice = $service->price + $service->fees;
                      $selectedServices[]=  ['type'=>'transport','name'=>$service->name,'house_type' => null, 'service_id'=>$service->id, 'week_price' => $service->price, 'total_price'=>$servicePrice,'num_weeks'=> null];


                  }
                  if ($service->type == 'insurance' && $request->query('insurance') == 'y') {
                      // $total_price += $service->price + $service->fees;
                      // $servicePrice = $service->price + $service->fees;
                      $total_price += $service->fees;
                      $servicePrice = $service->fees;
                      $selectedServices[]=  ['type'=>'insurance','name'=>$service->name, 'house_type' => null, 'service_id'=>$service->id,'week_price' => $service->price, 'total_price'=>$servicePrice,'num_weeks'=> null];


                     
                  }


                   if ($service->type == 'advisor') {
                      // $total_price += $service->price + $service->fees;
                      // $servicePrice = $service->price + $service->fees;
                      $total_price += $service->fees;
                      $servicePrice = $service->fees;
                      $selectedServices[]=  ['type'=>'advisor','name'=>$service->name, 'house_type' => null, 'service_id'=>$service->id,'week_price' => $service->price, 'total_price'=>$servicePrice,'num_weeks'=> null];


                     
                  }

                  if ($service->type == 'books') {
                      // $total_price += $service->price + $service->fees;
                      // $servicePrice = $service->price + $service->fees;
                      $total_price += $service->fees;
                      $servicePrice = $service->fees;
                      $selectedServices[]=  ['type'=>'books','name'=>$service->name, 'house_type' => null, 'service_id'=>$service->id,'week_price' => $service->price, 'total_price'=>$servicePrice,'num_weeks'=> null];


                     
                  }


              }


              $course->totalCost = (double)$total_price;

              $course->collectServices = collect($selectedServices);
              $course->selectedHousing = $shs;
              // $course->selectedTransport = $sts;
              return $course;
    }

    function store(Request $request,$id=0)
    {



      $course=Course::find($id);
        ## Validate Request
        $this->validate($request, [
            'firstName'      => 'required|max:20',
            'lastName'       => "required|max:20",
            'email'          => "required|max:70",
            'birthDate'      => "required|date",
            'nationality'    => "required",
            'residencePlace' => 'required',
            'city'           => 'required',
            'address_line1'  => 'required',
            'address_line2'  => 'nullable',
           // 'phone'          => 'required|regex:/(01)[0-9]{9}/',
            'phone'          => 'required|min:8|numeric',
            'whatsappNumber' => 'nullable',
            'paymentMethod'  => 'required',
            'card_type'      =>'required_if:paymentMethod,creditCard',
            'card_number'    =>'required_if:paymentMethod,creditCard',
            'expire_month'   =>'required_if:paymentMethod,creditCard',
            'expire_year'    =>'required_if:paymentMethod,creditCard',
            'ccv'            =>'required_if:paymentMethod,creditCard',
        ],[
          'card_type.required_if'=>trans("bookings.validation_card_type_required"),
          'card_number.required_if'=>trans("bookings.validation_card_number_required"),
          'expire_month.required_if'=>trans("bookings.validation_expire_month_required"),
          'expire_year.required_if'=>trans("bookings.validation_expire_year_required"),
          'ccv.required_if'=>trans("bookings.validation_ccv_required"),
        ]);
        $paymentMethod=$request->input('paymentMethod');
        // Checkout using credit cards
        if ($paymentMethod=='creditCard' && in_array($request->input('card_type'), ['visa', 'mastercard', 'AMEX', 'discover'])) {
            return $this->checkoutWithCreditCard($request,$course);

        }elseif ($paymentMethod=='office') {
            return $this->checkoutWithOfficePayment($request,$course);

        } else {
            // checkout using paypal express
            return $this->checkoutWithPaypal($request,$course);
        }
    }

     private function checkoutWithOfficePayment(Request $request,Course $course)
    {
      

        $course = $this->calculateCourseCost($request, $course);


        $residencePlace = Country::where('code', $request->input('residencePlace'))->first();

        $user = User::find(Auth::id());

        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->email = $request->input('email');
        $user->nationality = $request->input('nationality');
        $user->residence_place = $residencePlace->id;
        $user->city_name = $request->input('city');
        $user->state_name = $request->input('state');
        $user->whatsapp = $request->input('whatsappNumber');
        $user->address_line1 = $request->input('address_line1');
        $user->address_line2 = $request->input('address_line2');
        $user->birth_date = $request->input('birthDate') ? date("Y-m-d", strtotime($request->input('birthDate'))) : null;
        $user->phone = $request->input('phone');
        $user->zip_code = $request->input('zip_code');
        $user->gender = $request->input('gender');
        $user->save();

if($user->save()){
         

        $booking = new Booking();
      
        $booking->payment_method = $request->input('paymentMethod');
        $booking->communication_source = $request->input('communication_source');
        $booking->currency = $request->input('currency');
        $booking->booking_code = $booking->id.rand(1000, 9000).$user->id.rand(10, 99);
        $booking->passport_photo = $request->input('passport_photo');
        $booking->arrival_date = $request->input('arrival_date');
        $booking->departure_date = $request->input('departure_date');
        $booking->notes = $request->input('notes');
        $booking->institutes_level = $request->input('institutes_level');
        $booking->user_id = Auth::id();
        $booking->housing_id = $request->input('housing_id')?: null;
        // $booking->institute_id = $institute_id;
        $booking->course_id = $course->id;

        if($course->offer_price){
            $originCoursePrice = $course->offer_price;

        }else{
             $originCoursePrice = $course->price;

        }

        $courseWeeks = (int)$request->get("weeks") ?: 1;

        $courseTotalPrice =  $courseWeeks * $originCoursePrice;
        $booking->course_week_price = $originCoursePrice;
        $booking->course_total_price = $courseTotalPrice;
        $booking->course_weeks =  $courseWeeks;
        $booking->total_price = $course->totalCost;
        $booking->status = $request->input("status")?:1;
       // $booking->message = $request->input('message');
        $booking->save();

      if ($request->input("media") and is_array($request->input("media"))) {
                $media = [];
                foreach ($request->input("media") as $file) {

                    $upload_dir = config("settings.upload_dir");
                    $upload_path = config("settings.upload_path");

                    if (Storage::disk("public")->exists($upload_dir . "/$file")) {
                        $ext = File::extension($upload_path . "/$file");
                        $mim = File::mimeType($upload_path . "/$file");
                        $media[] = [
                            'title'     => $file,
                            'name'      => $file,
                            'full_path' => Storage::url($upload_dir . "/$file"),
                            'extension' => $ext,
                            'mime_type' => $mim,
                            'module'    => 'booking',
                            'key'       => 'booking-media',
                            'module_id' => $booking->id,
                        ];
                    }

                }

                Media::insert($media);
            }



        if ($booking->save() && $course->collectServices) {              
      

          foreach ($course->collectServices as $service) {
                  // if housing service is selected
          $bookedService = new BookedService();
          $bookedService->service_id = $service['service_id'];
          $bookedService->booking_id = $booking->id;
          $bookedService->user_id = (int)$request->input('user');
          $bookedService->type = $service['type'];
          $bookedService->week_price = $service['week_price'];
          $bookedService->house_type = $service['house_type'];
          $bookedService->name = $service['name'];
          $bookedService->num_weeks = $service['num_weeks'];
          $bookedService->total_price = $service['total_price'];
          $bookedService->save();
     }
         }
        }


   return redirect("/account/bookings/".$booking->id."/".$booking->booking_code."/show")->with(['message' => trans("courses.success_created"), 'alert-type' => 'success']);
        

        
        //return view("frontend.booking.thankyou", $this->data);
        

        
    }

    private function checkoutWithPaypal(Request $request,Course $course){ 



      // Session::put('payment',$request)
        
        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
      
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("paypal");

        $course=$this->calculateCourseCost($request, $course);
        $total_price=$course->totalCost;


        $item1 = Paypalpayment::item();
        $item1->setName($course->name)
                ->setDescription($course->description)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setTax(0)
                ->setPrice($total_price);


        $itemList = Paypalpayment::itemList();
        $itemList->setItems([$item1]);


        $details = Paypalpayment::details();
        $details->setShipping("0")
                ->setTax("0")
                //total of items prices
                ->setSubtotal($total_price);

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal($total_price)
                ->setDetails($details);

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types

        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment for". $course->name)
            ->setInvoiceNumber(uniqid());

        // ### Redirect URL
        $redirect_urls = Paypalpayment::redirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status')) /** Specify return URL **/
        ->setCancelUrl(URL::route('payment.status'));

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'

        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            $payment->create($this->_apiContext);
        }  catch (\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {

                return redirect()->back()->with(['message' => trans("bookings.payment_error_msg"), 'alert-type' => 'error']);
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                return redirect()->back()->with(['message' => trans("bookings.payment_error_msg"), 'alert-type' => 'error']);
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }

         foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

       

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
         

        if(isset($redirect_url)) {
            /** redirect to paypal **/
            return redirect()->away($redirect_url);
        }

        \Session::put('error','Unknown error occurred');
      return Redirect::route('checkout');


    }

      public function getPaymentStatus(){


        // $course = $this->calculateCourseCost($request, $course);
        /** Get the payment ID before session clear **/
        $paymentId = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('checkout');
        }
        $payment = Payment::getById($paymentId, $this->_apiContext);
        /** PaymentExecution object includes information necessary **/
        /** to execute a PayPal account payment. **/
        /** The payer_id is added to the request query parameters **/
        /** when the user is redirected from paypal back to your site **/
        $execution = Paypalpayment::PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution,$this->_apiContext);
        /** dd($result);exit; /** DEBUG RESULT, remove it later **/
        if ($result->getState() == 'approved') { 

          
            
            /** it's all right **/
            /** Here Write your database logic like that insert record or value in database if you want **/

            \Session::put('success','Payment success');
            return Redirect::route('booking.bill');
        }
        \Session::put('error','Payment failed');

    return Redirect::route('checkout');
    }

    private function checkoutWithCreditCard(Request $request,Course $course)
    {
      $city = City::find($request->input('city'));

           // ### Address
        // Base Address object used as shipping or billing
        // address in a payment. [Optional]
        $addr= Paypalpayment::address();
         $addr->setLine1($request->input('address_line1'));
        $addr->setLine2($request->input('address_line1', null));
        if($city){
          $addr->setCity($city->name ?: null);
        }
        $addr->setCountryCode($request->input('residencePlace'));
        $addr->setPhone($request->input('phone'));
        // ### CreditCard
        $card = Paypalpayment::creditCard();
        $card->setType($request->input('card_type'))
            ->setNumber($request->input('card_number'))
            ->setExpireMonth(sprintf("%02d", $request->input('expire_month')))
            ->setExpireYear($request->input('expire_year'))
            ->setCvv2($request->input('ccv'))
            ->setFirstName($request->input('firstName'))
            ->setLastName($request->input('lastName'));

        // ### FundingInstrument
        // A resource representing a Payer's funding instrument.
        // Use a Payer ID (A unique identifier of the payer generated
        // and provided by the facilitator. This is required when
        // creating or using a tokenized funding instrument)
        // and the `CreditCardDetails`
        $fi = Paypalpayment::fundingInstrument();
        $fi->setCreditCard($card);

        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("credit_card")
            ->setFundingInstruments(array($fi));

        $course=$this->calculateCourseCost($request, $course);
        $total_price=$course->totalCost;

        $item1 = Paypalpayment::item();
        $item1->setName($course->name)
                ->setDescription($course->description)
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setTax(0)
                ->setPrice($total_price);


        $itemList = Paypalpayment::itemList();
        $itemList->setItems([$item1]);


        $details = Paypalpayment::details();
        $details->setShipping("0")
                ->setTax("0")
                //total of items prices
                ->setSubtotal($total_price);

        //Payment Amount
        $amount = Paypalpayment::amount();
        $amount->setCurrency("USD")
                // the total is $17.8 = (16 + 0.6) * 1 ( of quantity) + 1.2 ( of Shipping).
                ->setTotal($total_price)
                ->setDetails($details);

        // ### Transaction
        // A transaction defines the contract of a
        // payment - what is the payment for and who
        // is fulfilling it. Transaction is created with
        // a `Payee` and `Amount` types

        $transaction = Paypalpayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment for". $course->name)
            ->setInvoiceNumber(uniqid());

        // // ### Redirect URL
        // $redirect_urls = Paypalpayment::redirectUrls();
        // $redirect_urls->setReturnUrl(URL::route('payment.status')) /** Specify return URL **/
        //     ->setCancelUrl(URL::route('payment.status'));

        // ### Payment
        // A Payment Resource; create one using
        // the above types and intent as 'sale'

        $payment = Paypalpayment::payment();

        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setTransactions(array($transaction));

        try {
            // ### Create Payment
            // Create a payment by posting to the APIService
            // using a valid ApiContext
            // The return object contains the status;
            $payment->create($this->_apiContext);
        }  catch (\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {

                return redirect()->back()->with(['message' => trans("bookings.payment_error_msg"), 'alert-type' => 'error']);
                /** echo "Exception: " . $ex->getMessage() . PHP_EOL; **/
                /** $err_data = json_decode($ex->getData(), true); **/
                /** exit; **/
            } else {
                return redirect()->back()->with(['message' => trans("bookings.payment_error_msg"), 'alert-type' => 'error']);
                /** die('Some error occur, sorry for inconvenient'); **/
            }
        }

        

       
    
         if ($payment->getState() == 'approved') { 
            
            /** it's all right **/ 
            

          $this->savePayment($request, $course, $payment);
 
        }else{

         return redirect()->back()->with(['message' => trans("bookings.payment_error_msg"), 'alert-type' => 'error']);
        }
        
        
    }


    private function savePayment(Request $request, Course $course, $payment){

      $course = $this->calculateCourseCost($request, $course);
      $payment = $this->checkoutWithCreditCard($request, $course, $payment);

      Session::put("booking_status", true);
  
        $residencePlace = Country::where('code', $request->input('residencePlace'))->first();
         

        $user = User::find(Auth::id());

        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->email = $request->input('email');
        $user->nationality = $request->input('nationality');
        $user->residence_place = $residencePlace->id;
        $user->city_name = $request->input('city');
        $user->state_name = $request->input('state');
        $user->whatsapp = $request->input('whatsappNumber');
        $user->address_line1 = $request->input('address_line1');
        $user->address_line2 = $request->input('address_line2');
        $user->birth_date = $request->input('birthDate') ? date("Y-m-d", strtotime($request->input('birthDate'))) : null;
        $user->phone = $request->input('phone');
        $user->zip_code = $request->input('zip_code');
        $user->gender = $request->input('gender');
        $user->save();

if($user->save()){
         

        $booking = new Booking();
      
        $booking->payment_method = $request->input('paymentMethod');
        $booking->communication_source = $request->input('communication_source');
        $booking->currency = $request->input('currency');
        $booking->passport_photo = $request->input('passport_photo')?:null;
        $booking->arrival_date = $request->input('arrival_date');
        $booking->departure_date = $request->input('departure_date');
        $booking->notes = $request->input('notes');
        $booking->booking_code = $booking->id.rand(1000, 9000).$user->id.rand(10, 99);        
        $booking->institutes_level = $request->input('institutes_level');
        $booking->user_id = Auth::id();
        $booking->housing_id = $request->input('housing_id')?: null;
        // $booking->institute_id = $institute_id;
        $booking->course_id = $course->id;

        if($course->offer_price){
            $originCoursePrice = $course->offer_price;

        }else{
             $originCoursePrice = $course->price;

        }

        $courseWeeks = (int)$request->get("weeks") ?: 1;

        $courseTotalPrice =  $courseWeeks * $originCoursePrice;
        $booking->course_week_price = $originCoursePrice;
        $booking->course_total_price = $courseTotalPrice;
        $booking->course_weeks =  $courseWeeks;
        $booking->total_price = $course->totalCost;
        $booking->status = $request->input("status")?:1;
       // $booking->message = $request->input('message');
        $booking->save();

    
  if ($request->input("media") and is_array($request->input("media"))) {
                $media = [];
                foreach ($request->input("media") as $file) {

                    $upload_dir = config("settings.upload_dir");
                    $upload_path = config("settings.upload_path");

                    if (Storage::disk("public")->exists($upload_dir . "/$file")) {
                        $ext = File::extension($upload_path . "/$file");
                        $mim = File::mimeType($upload_path . "/$file");
                        $media[] = [
                            'title'     => $file,
                            'name'      => $file,
                            'full_path' => Storage::url($upload_dir . "/$file"),
                            'extension' => $ext,
                            'mime_type' => $mim,
                            'module'    => 'booking',
                            'key'       => 'booking-media',
                            'module_id' => $booking->id,
                        ];
                    }

                }

                Media::insert($media);
            }


        if ($booking->save()) {


               foreach ($course->collectServices as $service) {
                  // if housing service is selected
          $bookedService = new BookedService();
          $bookedService->service_id = $service['service_id'];
          $bookedService->booking_id = $booking->id;
          $bookedService->user_id = (int)$request->input('user');
          $bookedService->type = $service['type'];
          $bookedService->week_price = $service['week_price'];
          $bookedService->house_type = $service['house_type'];
          $bookedService->name = $service['name'];
          $bookedService->num_weeks = $service['num_weeks'];
          $bookedService->total_price = $service['total_price'];
          $bookedService->save();
     }
         }
        } 
      return Redirect::route('booking.bill',['id' => $booking->id]);


        
        
        //return view("frontend.booking.thankyou", $this->data);



        }
    

    function thank_you()
    {
        if (!Session::get("booking_status") == true) {
            return redirect("/");
        }
        return view("frontend.booking.thankyou", $this->data);
    }


     function showBill(Request $request, $booking_id = 0)

     {


      $booking = Booking::find($booking_id);
      if (!$booking) {

            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);
        } 
        $user = User::find($booking->user_id);


      if (!$user) {
            return redirect()->route('login');
        }  

      

      if (!Auth::user()->can("show bookings") || Auth::id() != $booking->user_id) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }


        $this->data['booking'] = $booking;
        $this->data['buyer'] = $user;
  
        // $pdf = PDF::loadView('frontend.booking.bill', $this->data);
          
  //       $pdf = PDF::loadView('frontend.booking.bill', $this->data);
  // return $pdf->stream('frontend.booking.bill');
       // return $pdf->download('frontend.booking.bill.pdf');

        return view("frontend.users.bookings.invoice", $this->data);

       
    }

    

     function downloadBill(Request $request, $booking_id = 0)

     {


      $booking = Booking::find($booking_id);
      if (!$booking) {

            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);
        } 
        $user = User::find($booking->user_id);


      if (!$user) {
            return redirect()->route('login');
        }  

      

      if (!Auth::user()->can("show bookings") || Auth::id() != $booking->user_id) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }


        $this->data['booking'] = $booking;
        $this->data['buyer'] = $user;
  
        // $pdf = PDF::loadView('frontend.booking.bill', $this->data);
          
        $pdf = PDF::loadView('frontend.users.bookings.invoice', $this->data);
  return $pdf->stream('invoice');
        // return $pdf->download('frontend.booking.bill.pdf');

        // return view("frontend.booking.bill", $this->data);

       
    }

}
