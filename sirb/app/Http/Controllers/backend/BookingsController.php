<?php

namespace Sirb\Http\Controllers\backend;

use Sirb\Country;
use Sirb\Booking;
use Sirb\Mail\BookingConfirmation;
use Sirb\Media;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;
use Sirb\Http\Requests;
use Sirb\Http\Controllers\backend\BackendBaseController;

class BookingsController extends BackendBaseController
{
    function index()
    {
        if (!Auth::user()->can("show bookings")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $this->data['data'] = Booking::orderBy("created_at", "desc")->get();

        return view("backend.bookings.index", $this->data);
    }

     function create()
    {
        // if (!Auth::user()->can("create bookings")) {
        //     return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        // }

        

        $this->data['page_title'] = trans("bookings.backend_page_title");
        $this->data['page_header'] = trans("bookings.backend_page_create_header");
       
        $this->data['countries'] = Country::all();

        return view("backend.bookings.create", $this->data);
    }

    function show($id = 0)
    {
        if (!Auth::user()->can("show bookings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $booking = Booking::find($id);
        if (!$booking) {
            return redirect()->back()->with(['message' => trans("bookings.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("bookings.backend_page_title");
        $this->data['page_header'] = trans("bookings.backend_page_create_header");
        $this->data['data'] = $booking;
        $this->data['countries'] = Country::all();

        return view("backend.bookings.show", $this->data);
    }

    function edit($id = 0)
    {
        if (!Auth::user()->can("edit bookings settings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $booking = Booking::find($id);
        if (!$booking) {
            return redirect()->back()->with(['message' => trans("bookings.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("bookings.backend_page_title");
        $this->data['page_header'] = trans("bookings.backend_page_create_header");
        $this->data['data'] = $booking;
        $this->data['countries'] = Country::all();

        return view("backend.bookings.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit bookings settings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $booking = Booking::find($id);
        if (!$booking) {

            return redirect()->back()->with(['message' => trans("bookings.id_not_found"), 'alert-type' => 'error']);
        }
        $bTypes = ["free", 'hotel', 'room', 'package'];
        $booking_type = $request->input("booking_type");
        if (!$booking_type || !in_array($booking_type, $bTypes))
            return redirect()->back()->withInput()->with(["message" => trans("main.error_invalid_data"), 'alert-type' => "error"]);

        $rules = [
            "name"           => "required|max:255|min:5",
            "email"          => "required|max:255|min:5|email",
            "nationality"    => "required|max:255|min:3",
            "mobile"         => "required|max:20|min:5",
            "arrival_date"   => "required|date_format:d-m-Y",
            "departure_date" => "required|date_format:d-m-Y",
            "num_adults"     => "numeric|required|min:1",
            "num_childes"    => "numeric|min:0",
            "num_bags"       => "numeric|min:0",
            "package_type"   => "required",
            "notes"          => "min:3|max:300",
            "country"        => "required",
            "hotel"          => "required_if:booking_type,hotel",
            "room"           => "required_with:hotel",
            "num_rooms"      => "required_with:hotel",
            "package"        => "required_if:booking_type,package",
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $booking->name = $request->input('name');
        $booking->email = $request->input('email');
        $booking->nationality = $request->input('nationality');
        $booking->mobile = $request->input('mobile');
        $booking->country_id = $request->input('country');
        $booking->arrival_date = $request->input('arrival_date') ? date("Y-m-d", strtotime($request->input('arrival_date'))) : null;
        $booking->departure_date = $request->input('departure_date') ? date("Y-m-d", strtotime($request->input('departure_date'))) : null;
        $booking->num_adults = $request->input("num_adults") ?: 1;
        $booking->num_children = $request->input("num_children") ?: 0;
        $booking->num_bags = $request->input("num_bags") ?: 0;
        $booking->notes = $request->input("notes") ?: null;
        $booking->package_type = $request->input("package_type") ?: null;
        $booking->package_id = $request->input("package") ?: null;
        $booking->num_rooms = $request->input("num_rooms") ?: 1;
        $booking->hotel_id = $request->input("hotel") ?: null;
        $booking->room_id = $request->input("room") ?: null;
        $booking->num_rooms = $request->input("num_rooms") ?: 1;
        $booking->updated_by_id = Auth::id();

    
        
        

        if ($booking->save()) {

            // send booking confirmation email
            if ($request->input("booking_type") == "confirmed") {
                Mail::to($booking->email)->send(new BookingConfirmation($booking));
            }

        }

        return redirect($this->data['backend_uri'] . "/bookings")->with(['message' => trans("bookings.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete bookings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $booking = Booking::find($id);
        if (!$booking) {
            return redirect()->back()->with(['message' => trans("bookings.id_not_found"), 'alert-type' => 'error']);
        }

        // get country photos
        $defaultPhoto = $booking->photo;
        $gallery = $booking->gallery;

        if ($booking->delete()) {
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
        if (!Auth::user()->can("delete bookings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $booking = Booking::find($id);

                if ($booking) {
                    $defaultPhoto = $booking->photo;
                    $gallery = $booking->gallery;

                    if ($booking->delete()) {
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

 //        $booking = Booking::find($id);
 //        if (!$booking){abort(404)};

 //            $booking->pay_online = (bool)$request->input("pay_online");
 //            $booking->price = $request->input("price");
 //            $booking->fees = $request->input("fees");
 //            $booking->booking_code = $request->input("booking_code");
 //            $booking->booking_url = $request->input("booking_url");
 //            $booking->save();
          
 // return redirect()->back()->with(['message' => trans("bookings.success_set_pay_online"), 'alert-type' => 'success']);
   
 //    }


}
