<?php
  
namespace Modules\Components\LMS\Http\Controllers\Frontend;

use Modules\Foundation\Http\Controllers\PublicBaseController;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Crypt;
use Modules\Components\LMS\Models\Course;
use Modules\Components\LMS\Models\Category;
use Modules\Components\LMS\Models\Quiz;
use Modules\Components\LMS\Models\Subscription;
use Modules\Components\LMS\Models\Invoice;
use Rinvex\Subscriptions\Models\Plan as BasePlan;
use Rinvex\Subscriptions\Models\PlanFeature;
use Rinvex\Subscriptions\Models\PlanSubscription;
use Rinvex\Subscriptions\Models\PlanSubscriptionUsage;
use Modules\Components\LMS\Models\Plan;
use Modules\Components\LMS\Models\UserLMS;
use Illuminate\Support\Facades\Auth;
use Modules\Components\CMS\Traits\SEOTools;

class SubscriptionsController extends PublicBaseController
{ 
  use SEOTools;

    public function index(){}


    //show

    public function show($id){}




    public function subscribe(Request $request, $module, $module_hash_id){


      $module_id = hashids_decode($module_hash_id);





        if ($request->session()->has('lms_cart')) {

            $request->session()->forget('lms_cart');
       
       }

       $sessionData = [
        'module_url' => url()->previous(),
        'module' => $module,
        'module_id' => $module_id,
       ];

        $request->session()->put('lms_cart', ['data' => $sessionData]);

        if($request->get('auth_type')){

          return redirect()->to(url('/'.$request->get('auth_type'))); //@trans
        }

        
        if(!Auth::check()){

          return redirect()->route('login')->with(['message' => 'LMS::messages.login_error', 'alert_type' => 'danger']); //@trans
        }

      $module_data = \LMS::getModuleData($module, $module_id);

      if(!$module_data){

         return redirect()->back()->with(['message' => 'LMS::messages.cannot_complete_action', 'alert_type' => 'danger']); //@transM
      }


        $user = UserLMS::find(Auth()->id());
          $moduleArray = [
          'module' => $module,
          'module_id' => $module_id,
          'user' => $user,
          'parent' => []

        ];

      if($module == 'plan'){
        return $this->store_subscription($request, $module, $module_data, 0);

         }


      $planned = \Subscriptions::planned($moduleArray);
     

        if($planned['success'] && $planned['status'] < 1){

           return redirect()->back()->with(['message' => 'LMS::messages.cannot_complete_action', 'alert_type' => 'danger']); //@transM
        }




        $invoiceArray = [];



        if(!$planned['success']){
          return $this->store_subscription($request, $module, $module_data, $planned['status']);
        }

       $response = \Subscriptions::subscribe($moduleArray, $invoiceArray);

        if($response['success']){

        if ($request->session()->has('lms_cart')) {

            $request->session()->forget('lms_cart');
       
       }

       if($module == 'course'){
       $enroll = \Logs::enroll($moduleArray);
       }

      
           return redirect()->back()->with(['message' => 'LMS::messages.success_subscription', 'alert_type' => 'success']); //@transM

      // return redirect()->route('account.profile', $user->hashed_id)->with(['message' => 'LMS::messages.success_subscription', 'alert_type' => 'success']); //@transM
        }else{
      return redirect()->back()->with(['message' => $response['message'], 'alert_type' => 'danger']); //@transM
        }

    }

    public function store_subscription($request, $module, $module_data, $planned){

      $module_id = $module_data->id;

      //  $request->merge(['phone_country_code' => '+966']);

      //      $module_data = \LMS::getModuleData($module, $module_id);

      // if(!$module_data){

      //    return redirect()->back()->with(['message' => 'LMS::messages.cannot_complete_action', 'alert_type' => 'danger']); //@transM
      // }

       $user = UserLMS::find(Auth()->id());


        if($module_data->sale_price > 0){
            $modulePrice = $module_data->sale_price;
          }else{
            $modulePrice =  $module_data->price;
          }

       

       if(($modulePrice > 0) || ($planned > 0)){
        $rules = [
          'coupon' => 'required|max:14',
        ];
       }else{
        $rules = [];
       }


        

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->with(['message' => 'LMS::messages.payment_code_required', 'alert_type' => 'danger']);
        }

         $moduleArray = [
          'module' => $module,
          'module_id' => $module_id,
          'user' => $user,
          'parent' => []

        ];



         $coupon_status = false;
         $invoice_status = false;
         $paid = 0.00;

        if($request->get('coupon')){
          $coupon = $request->get('coupon');
          $coupon_array = \Coupon::check($coupon, $moduleArray);
          $coupon_status = $coupon_array['success'];

          if(!$coupon_status){
            return redirect()->back()->with(['message' => $coupon_array['message'], 'alert_type' => 'danger']);
          }




      if($modulePrice > 0){
         $value = $coupon_array['coupon']->value;
         $type = $coupon_array['coupon']->type;

         if($type == 'fixed'){
           $paid = $value;
         }else{
          $paid = ($value * $modulePrice) / 100;
         }
         }
         if($paid > $modulePrice){
          $paid =$modulePrice;
         }
        }
        

        // $data = $request->except('coupon');


        //  $user->update($data);

         $invoiceArray = [
          'module' => $module,
          'module_id' => $module_id,
          'user' => $user,
          'price' => $modulePrice,
          'paid' => $paid,
          'currency' => 'SR',
          'coupon_id' => $coupon_status?\Coupon::get($request->get('coupon'))->id:null,
        ];

         $response = \Subscriptions::subscribe($moduleArray, $invoiceArray);

         if($response['success']){


        if ($request->session()->has('lms_cart')) {

            $request->session()->forget('lms_cart');
       
       }

            return redirect()->back()->with(['message' => 'LMS::messages.success_subscription', 'alert_type' => 'success']); //@transM
        }else{

           return redirect()->back()->with(['message' => 'LMS::messages.cannot_complete_action', 'alert_type' => 'danger']); //@transM


        }

    }


     public function subscriptionPage($module, $module_hash_id){

      $module_id = hashids_decode($module_hash_id);

      $module_data = \LMS::getModuleData($module, $module_id);
      
      $page_title = 'اشتراك جديد';




      if(!$module_data){

         return redirect()->back()->with(['message' => 'LMS::messages.cannot_complete_action', 'alert_type' => 'danger']); //@transM
      }

             $item = [
            'title' => 'اشتراك جديد',
            'meta_description' => 'صفحة تسجيل اشتراك جديد',
            'url' => url("/"),
            'type' => 'subscription',
            'image' => \settings::get('site_logo'),
            'meta_keywords' => 'اشتراك, اشتراك جديد'
        ];

        $this->setSEO((object)$item);
     


        if (session()->has('lms_cart')) {

            session()->forget('lms_cart');
       
       }

       $sessionData = [
        'module_url' => url()->previous(),
        'module' => $module,
        'module_id' => $module_id,
       ];


        if(!Auth::check()){
          session()->put('lms_cart', ['data' => $sessionData]);
          return redirect()->route('login')->with(['message' => 'LMS::messages.login_error', 'alert_type' => 'danger']);
        }

      $moduleArray = [
          'module' => $module,
          'module_id' => $module_id,
          'user' => UserLMS::find(Auth()->id())

        ];


         $response = \Subscriptions::is_subscribed($moduleArray);
        


        if($response){

           return redirect()->back()->with(['message' => 'LMS::messages.cannot_complete_action', 'alert_type' => 'danger']); //@transM

        }



        return view('bookings.create')->with(compact('module_data', 'module', 'module_hash_id', 'page_title'));
     }


             /**
     * @param InvoiceRequest $request
     * @return $this
     */
    public function get_pay_code_form(Request $request, $invoice)
    {

        return view('bookings.partials.payment_code_form')->with(compact('invoice'))->render();
    }

    /**
     * @param InvoiceRequest $request
     * @return $this
     */
    public function submit_pay_code(Request $request, $hashed_id)
    {
    
        $data = $request->all();
        $id = hashids_decode($hashed_id);

          if(!Auth::check()){
          $message = "عفوًا  ... حدث خطأ ما حاول مرة ثانية.";
          $view = view('components.ajax_errors')->with(compact('message'))->render();

          return redirect()->back()->with(['message' => $message, 'alert_type' => 'danger']);

        }


        if(!$request->get('coupon')){

           $message = "عفوًا لم تقم بإدخال كود الدفع.";
          $view = view('components.ajax_errors')->with(compact('message'))->render();

          return redirect()->back()->with(['message' => $message, 'alert_type' => 'danger']); 

        }


         $coupon_status = false;
         $paid = 0.00;

          $invoice_status = 'pending';

        $invoice = Invoice::find($id);
        if(!$invoice){

           $message = "عفوًا  ... حدث خطأ ما حاول مرة ثانية.";

          return redirect()->back()->with(['message' => $message, 'alert_type' => 'danger']);

        }




        if(user()->id != $invoice->user_id){
          $message = "عفوًا  ... حدث خطأ ما حاول مرة ثانية.";

          return redirect()->back()->with(['message' => $message, 'alert_type' => 'danger']);

        }
        

       

        //get first invoice item

        $firstInvoiceItem = $invoice->invoicables()->first();

          if(!$firstInvoiceItem){

           $message = "عفوًا  ... حدث خطأ ما حاول مرة ثانية.";

          return redirect()->back()->with(['message' => $message, 'alert_type' => 'danger']);

        }

        

        $modulePrice = $firstInvoiceItem->price;

        $moduleArray = [
          'user' => user(),
          'module' => $firstInvoiceItem->lms_invoicable_type, 
          'module_id' => $firstInvoiceItem->lms_invoicable_id,
        ];

          $coupon = $request->get('coupon');


          $coupon_array = \Coupon::check($coupon, $moduleArray);
          $coupon_status = $coupon_array['success'];

          if(!$coupon_status){
           $message = "الكود الذي ادخلته غير صحيح .. حاول مرة اخرى.";
         return redirect()->back()->with(['message' => $message, 'alert_type' => 'danger']);
          }

      if($modulePrice > 0){
         $value = $coupon_array['coupon']->value;
         $type = $coupon_array['coupon']->type;

         if($type == 'fixed'){
           $paid = $value;
         }else{
          $paid = ($value * $modulePrice) / 100;
         }
         }

         if($paid > $modulePrice){
          $paid =$modulePrice;
         }
        
     if($paid >= $modulePrice){
        $invoice_status = 'paid';
      }

          $invoice->update([
                'status' => $invoice_status,
                'coupon_id' => $coupon_array['coupon']->id,
               
            ]);

  
            $firstInvoiceItem->update([
                'paid' =>  $paid,
                'coupon_id' => $coupon_array['coupon']->id
               
            ]);
     

        $invoice->subscriptions()->update([
            'status' => ($invoice_status != 'paid')?0:1,
        ]);


      $message = "مبروك .. تم  تأكيد عملية الدفع بنجاح.";
         return redirect()->back()->with(['message' => $message, 'alert_type' => 'success']);

    }

}
