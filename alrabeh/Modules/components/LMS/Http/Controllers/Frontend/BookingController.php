<?php

namespace Modules\Components\LMS\Http\Controllers\Frontend;

use Modules\Foundation\Http\Controllers\PublicBaseController;
use Modules\Components\LMS\Models\Plan;
use Modules\Components\LMS\Models\Invoice;
use Modules\Components\LMS\Models\Invoicable;
use Illuminate\Http\Request;
use Modules\Components\LMS\Models\UserLMS;
use Modules\User\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class BookingController extends PublicBaseController
{
     

 
    function show(){
  
        return view('bookings.show');

    }
     function pricingTables(){
        
        $plans = Plan::all();

        return view('bookings.pricing_tables‬‏')->with(compact(
            'plans'

        ));

    }
     function invoices($user_hashed_id){
         $user_id =  hashids_decode($user_hashed_id);
         $userBase = User::find($user_id);
         $userLMS = UserLMS::find($user_id);
          if(!\LMS::profilePermissions($userBase, 'LMS::invoice.view'))
            return abort(404);
          if(!$userBase)
            return abort(404);     


        $subscriptions = $userLMS->subscriptions()->get();
        $userInvoices = $userLMS->invoices()->get();
        $hasSubscriptions = !empty($subscriptions)?true:false;


        return view('bookings.invoices')->with(compact('userLMS','userBase', 'subscriptions', 'hasSubscriptions', 'userInvoices'));
    }
    function ajax_show_invoice(Request $request, $user_hashed_id, $invoice_hashed_id){
      if(!$request->ajax()){
          return abort(404);
      }
      $user_id =  hashids_decode($user_hashed_id);
      $user = User::find($user_id);
       if(!\LMS::profilePermissions($user, 'LMS::invoice.view'))
        return abort(404);

      $invoice_id =  hashids_decode($invoice_hashed_id);
      $invoice = Invoice::find($invoice_id);
      $invoicables = $invoice->invoicables()->get();

    	return view('bookings.partials.invoice_modal')->with(compact('invoicables', 'invoice'));
    }
}