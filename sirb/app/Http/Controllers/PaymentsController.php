<?php

namespace Sirb\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Sirb\BookingPayment;
use URL;
use Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Paypal as Paypalpayment;

class PaymentsController  extends Controller
{
    private $_apiContext;

    function __construct()
    {
        parent::__construct();
        $this->_apiContext = Paypalpayment::apiContext(config("paypal_payment.Account.ClientId"), config("paypal_payment.Account.ClientSecret"));
    }

    // free booking
    function index($slug = null)
    {
          /** Get the payment ID before session clear **/
        // Session::put('payment_url', $slug);
        $this->data['data'] = BookingPayment::where('payment_url', $slug)->first();
      
        $this->data['title'] = trans("bookings.title_paymeny_request") . " - " . $this->data['title'];

        return view("frontend.payments.index", $this->data);

    }


    private function calculateBookingPaymentCost(Request $request, $bookingPayment)
    {


            
             $total_price = (double)0.0;
             $total_price += (double)$bookingPayment->price + (double)$bookingPayment->fees;

              $bookingPayment->totalCost = (double)$total_price;

              
              return $bookingPayment;
    }

    function store(Request $request, $slug = null)
    {



      $bookingPayment = BookingPayment::where('payment_url', $slug)->first();
    
        ## Validate Request
        $this->validate($request, [
            
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
            return $this->checkoutWithCreditCard($request,$bookingPayment);

        

        } else {
            // checkout using paypal express
            return $this->checkoutWithPaypal($request,$bookingPayment);
        }
    }


    private function checkoutWithPaypal(Request $request,BookingPayment $bookingPayment){ 



      // Session::put('payment',$request)
        
        // ### Payer
        // A resource representing a Payer that funds a payment
        // Use the List of `FundingInstrument` and the Payment Method
        // as 'credit_card'
      
        $payer = Paypalpayment::payer();
        $payer->setPaymentMethod("paypal");

        $bookingPayment=$this->calculateBookingPaymentCost($request, $bookingPayment);
        $total_price=$bookingPayment->totalCost;


        $item1 = Paypalpayment::item();
        $item1->setName($bookingPayment->title)
                ->setDescription($bookingPayment->details)
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
            ->setDescription($bookingPayment->title)
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
      return Redirect::route('checkout', ['slug'=>$bookingPayment->payment_url])->with(['message' => trans("bookings.payment_error_msg"), 'alert-type' => 'error']);


    }

      public function getPaymentStatus(){

        $slug = Session::get('payment_url');
        /** Get the payment ID before session clear **/
        $paymentId = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('payment_url');
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('checkout', ['slug'=> $slug])->with(['message' => trans("bookings.payment_error_msg"), 'alert-type' => 'error']);
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
            return Redirect::route('Payment.thank')->with(['message' => trans("bookings.payment_success_msg"), 'alert-type' => 'success']);
        }
        \Session::put('error','Payment failed');

    return Redirect::route('checkout', ['slug', $slug])->with(['message' => trans("bookings.payment_error_msg"), 'alert-type' => 'error']);
    }

    private function checkoutWithCreditCard(Request $request,BookingPayment $bookingPayment)
    {

       $bookingPayment=$this->calculateBookingPaymentCost($request, $bookingPayment);
        $total_price=$bookingPayment->totalCost;
    // ### CreditCard
        $card = Paypalpayment::creditCard();
        $card->setType($request->input('card_type'))
            ->setNumber($request->input('card_number'))
            ->setExpireMonth(sprintf("%02d", $request->input('expire_month')))
            ->setExpireYear($request->input('expire_year'))
            ->setCvv2($request->input('ccv'))
            ->setFirstName($bookingPayment->first_name)
            ->setLastName($bookingPayment->last_name);

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

       

        $item1 = Paypalpayment::item();
        $item1->setName($bookingPayment->title)
                ->setDescription($bookingPayment->description)
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
            ->setDescription($bookingPayment->title)
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
        }  catch (\Exception $ex) {
           
 echo $ex->getCode(); // Prints the Error Code
    echo $ex->getData(); // Prints the detailed error message 
    die($ex);
          
        }


        

    
    
         if ($payment->getState() == 'approved') { 
            
            /** it's all right **/ 
            

          $this->savePayment($request, $bookingPayment, $payment);
 
        }else{

         return redirect()->back()->with(['message' => trans("bookings.payment_error_msg"), 'alert-type' => 'error']);
        }
        
        
    }


    private function savePayment(Request $request, BookingPayment $bookingPayment, $payment){

       

      $bookingPayment = $this->calculateBookingPaymentCost($request, $bookingPayment);
      $payment = $this->checkoutWithCreditCard($request, $bookingPayment, $payment);
    
       $bookingPayment->status = 1;
       $bookingPayment->save();
       if($bookingPayment->save()){
        Session::put("booking_status", true);
       }

        

      return Redirect::route('payment.thank',['url' => $bookingPayment->payment_url]);


        }


        public function checkout(Request $request, $url) 
     {

        $payload = $request->input('payment_method_nonce');
        
        $bookingPayment = BookingPayment::where('payment_url', $url)->first();
                $payload = $request->input('payload', false);
                $nonce = $payload['nonce'];
                // process the customer payment
                // $client_nonce = \Braintree_PaymentMethodNonce::create($customer->braintree_nonce);
                $result = \Braintree_Transaction::sale([
                     'amount' => $bookingPayment->price,
                     'options' => [ 'submitForSettlement' => True ],
                     'paymentMethodNonce' => $nonce
                ]);

                

                // check to see if braintree has processed
                // our client purchase transaction
                if( !empty($result->transaction) ) {
                    // your customer payment is done successfully 
                    return Redirect::route('checkout', ['slug'=>$bookingPayment->payment_url])->with(['message' => trans("bookings.payment_error_msg"), 'alert-type' => 'error']); 
                }

                 $bookingPayment->status = 1;
                 $bookingPayment->save();
           

          return Redirect::route('Payment.thank',['url' => $bookingPayment->payment_url]);
     }
    

    function thank_you($url)
    {


        $this->data['data'] = BookingPayment::where('payment_url', $url)->first();
        $this->data['title'] = trans("bookings.page_title") . " - " . $this->data['title'];
        return view("frontend.payments.thankyou", $this->data);
    }


}
