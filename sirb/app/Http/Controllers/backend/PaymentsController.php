<?php

namespace Sirb\Http\Controllers\backend;

use Sirb\Country;
use Sirb\BookingPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;
use Sirb\Http\Requests;
use Sirb\Http\Controllers\backend\BackendBaseController;

class PaymentsController extends BackendBaseController
{
    function index()
    {
        // if (!Auth::user()->can("show bookings")) {

        //     return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        // }
        $this->data['data'] = BookingPayment::orderBy("created_at", "desc")->get();

        return view("backend.payments.index", $this->data);
    }

     function create()
    {
        // if (!Auth::user()->can("create bookings")) {
        //     return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        // }

        

        $this->data['page_title'] = trans("bookings.backend_page_title");
        $this->data['page_header'] = trans("bookings.backend_page_create_header");
       
        $this->data['countries'] = Country::all();

        return view("backend.payments.create", $this->data);
    }

    function store(Request $request)
    {
        // if (!Auth::user()->can("edit bookings settings")) {
        //     return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        // }

        $rules = [
             "first_name"           => "required|max:255|min:2",
            "last_name"          => "required|max:255|min:2",
            "full_name"    => "required|max:255|min:3",
            "mobile"         => "max:20|min:5",
            "details"          => "min:3|max:300",
            "price"         => "required",
           
           
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $payment = new BookingPayment;

        $payment->full_name  = $request->input('full_name');
        $payment->last_name  = $request->input('last_name');
        $payment->first_name  = $request->input('first_name');
        $payment->payer_email = $request->input('payer_email');
        $payment->nationality = $request->input('nationality');
        $payment->package_num = $request->input('package_num');
        $payment->title = $request->input('title');
        $payment->whatsapp  = $request->input('whatsapp');
        $payment->details = $request->input('details');
        $payment->price = $request->input('price');
        $payment->fees = $request->input('fees');
        $payment->created_by = Auth::id();
        // $payment->status = $request->input('status')?:0;
        if($payment->save()){

    $strRand = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'.$payment->id;

    $payment_url = substr(str_shuffle(str_repeat($strRand, 15)), 0, 15);
        $payment->payment_code = rand(100, 1000).$payment->id.rand(10, 9100);
        $payment->payment_url = $payment_url;
        $payment->save();
    }
        

        return redirect($this->data['backend_uri'] . "/payments")->with(['message' => trans("bookings.success_stored"), 'alert-type' => 'success']);


    }


    function show($id = 0)
    {
        if (!Auth::user()->can("show bookings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $payment = BookingPayment::find($id);
        if (!$payment) {
            return redirect()->back()->with(['message' => trans("bookings.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("bookings.backend_page_title");
        $this->data['page_header'] = trans("bookings.backend_page_create_header");
        $this->data['data'] = $payment;
        $this->data['countries'] = Country::all();

        return view("backend.payments.show", $this->data);
    }

    function edit($id = 0)
    {
        // if (!Auth::user()->can("edit bookings settings")) {
        //     return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        // }

        $payment = BookingPayment::find($id);
        if (!$payment) {
            return redirect()->back()->with(['message' => trans("bookings.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("bookings.backend_page_title");
        $this->data['page_header'] = trans("bookings.backend_page_create_header");
        $this->data['data'] = $payment;
        $this->data['countries'] = Country::all();

        return view("backend.payments.edit", $this->data);
    }

    function update(Request $request, $id = 0)
        {
        // if (!Auth::user()->can("edit bookings settings")) {
        //     return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        // }

        $rules = [
            "first_name"           => "required|max:255|min:2",
            "last_name"          => "required|max:255|min:2",
            "full_name"    => "required|max:255|min:3",
            "whatsapp"         => "max:20|min:5",
            "details"          => "min:3|max:300",
            "price"         => "required",
           
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $payment = BookingPayment::find($id);
        $payment->full_name  = $request->input('full_name');
        $payment->last_name  = $request->input('last_name');
        $payment->first_name  = $request->input('first_name');
        $payment->payer_email = $request->input('payer_email');
        $payment->nationality = $request->input('nationality');
        $payment->package_num = $request->input('package_num');
        $payment->whatsapp  = $request->input('whatsapp');
        $payment->title = $request->input('title');
        $payment->details = $request->input('details');
        $payment->price = $request->input('price');
        $payment->fees = $request->input('fees');
        $payment->created_by = Auth::id();
        // $payment->status = $request->input('status')?:0;
        if($payment->save()){

    $strRand = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'.$payment->id;

    $payment_url = substr(str_shuffle(str_repeat($strRand, 15)), 0, 15);
        $payment->payment_code = rand(100, 1000).$payment->id.rand(10, 9100);
        $payment->payment_url = $payment_url;
        $payment->save();
    }
        

        return redirect($this->data['backend_uri'] . "/payments")->with(['message' => trans("bookings.success_stored"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        // if (!Auth::user()->can("delete bookings")) {
        //     return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        // }

        $payment = BookingPayment::find($id);
        if (!$payment) {
            return redirect()->back()->with(['message' => trans("bookings.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $payment->photo;
        $gallery = $payment->gallery;

        if ($payment->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("bookings.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("bookings.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        // if (!Auth::user()->can("delete bookings")) {
        //     return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        // }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $payment = BookingPayment::find($id);

                if ($payment) {
                    $defaultPhoto = $payment->photo;
                    $gallery = $payment->gallery;

                    if ($payment->delete()) {
                        $uploader = new UploaderController();
                        $uploader->delete($defaultPhoto);
                        // delete photos from storage and database
                        if ($gallery) {
                            foreach ($gallery as $file) {

                                $uploader->delete($file->name);
                            }
                        }
                    }

                    $deleted++;
                }
            }

            return redirect()->back()->with(['message' => trans("bookings.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("bookings.error_multi_delete_empty"), 'alert-type' => 'warning']);

    }

 //     function set_pay_online(Request $request, $id = 0)
 //    {
 //         $rules = [
 //            "price"           => "required",
 //            "pay_online"           => "required",
 //            "booking_code"          => "required",
 //            "booking_url"          => "required",
 //                   ];
 //        $validator = Validator::make($request->all(), $rules);

 //        if ($validator->fails()) {
 //            return redirect()->back()
 //                ->withErrors($validator)
 //                ->withInput();
 //        }

 //        $payment = Booking::find($id);
 //        if (!$payment){abort(404)};

 //            $payment->pay_online = (bool)$request->input("pay_online");
 //            $payment->price = $request->input("price");
 //            $payment->fees = $request->input("fees");
 //            $payment->booking_code = $request->input("booking_code");
 //            $payment->booking_url = $request->input("booking_url");
 //            $payment->save();
          
 // return redirect()->back()->with(['message' => trans("bookings.success_set_pay_online"), 'alert-type' => 'success']);
   
 //    }


}
