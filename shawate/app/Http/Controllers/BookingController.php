<?php

namespace App\Http\Controllers;

use App\Booking;
use App\Hotel;
use App\Mail\BookingConfirmation;
use App\Mail\NewBookingNotification;
use App\Package;
use App\Room;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    // free booking
    function index()
    {
        $this->data['title'] = trans("bookings.page_title") . " - " . $this->data['title'];
        return view("frontend.booking.index", $this->data);

    }

    function hotel($id = 0, $slug = null)
    {
        $hotel = Hotel::published()->find($id);
        if (!$hotel) redirect()->back()->with(["message" => "hotels.id_not_found", "alert-type" => "error"]);

        $this->data['hotel'] = $hotel;
        $this->data['title'] = trans("bookings.page_title") . " - " . $this->data['title'];
        return view("frontend.booking.hotel", $this->data);

    }

    function package($id = 0, $slug = null)
    {
        $package = Package::published()->find($id);
        if (!$package) redirect()->back()->with(["message" => "packages.id_not_found", "alert-type" => "error"]);

        $this->data['package'] = $package;
        $this->data['title'] = trans("bookings.page_title") . " - " . $this->data['title'];
        return view("frontend.booking.package", $this->data);

    }

    function room($id = 0, $slug = null)
    {
        $room = Room::published()->find($id);
        if (!$room) redirect()->back()->with(["message" => "rooms.id_not_found", "alert-type" => "error"]);

        $hotel = $room->hotel;

        $this->data['room'] = $room;
        $this->data['hotel'] = $hotel;

        $this->data['title'] = trans("bookings.page_title") . " - " . $this->data['title'];
        return view("frontend.booking.room", $this->data);

    }

    function store(Request $request)
    {

        $bTypes = ["free", 'hotel', 'room', 'package'];
        $booking_type = $request->input("booking_type");
        if (!$booking_type || !in_array($booking_type, $bTypes))
            return redirect()->back()->withInput()->with(["message" => trans("main.error_invalid_data"), 'alert-type' => "error"]);


        $rules = [
            "name"         => "required|max:255|min:5",
            "email"        => "required|max:255|min:5|email",
            "nationality"  => "required|max:255|min:3",
            "mobile"       => "required|max:20|min:5",
            "date_from"    => "required|date_format:d-m-Y",
            "date_to"      => "required|date_format:d-m-Y",
            "num_adults"   => "numeric|required|min:1",
            "num_childes"  => "numeric|min:0",
            "num_bags"     => "numeric|min:0",
            "num_rooms"    => "numeric|min:1",
            "package_type" => "required_without_all:hotel_id,package_id|numeric|min:0",
            "hotel_level"  => "required_without_all:hotel_id,package_id,room_id|numeric|min:1|max:7",
            "notes"        => "min:3|max:300",
        ];

        if ($booking_type == "free") {
            $rules["country"] = "required";
        }

        switch ($booking_type) {
            case "hotel":
                if (!$request->input("hotel_id"))
                    return redirect()->back()->withInput()->with(["message" => trans("main.error_invalid_data"), 'alert-type' => "error"]);
                $rules['num_rooms'] = "required|numeric|min:1";
                break;
            case "package":
                if (!$request->input("package_id"))
                    return redirect()->back()->withInput()->with(["message" => trans("main.error_invalid_data"), 'alert-type' => "error"]);
                $rules['num_rooms'] = "required|numeric|min:1";
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $gResponse = \ReCaptcha::parseInput($request->input('g-recaptcha-response'));

        if (!$gResponse->isSuccess()) {
            return redirect()->back()->with(['message' => trans("main.captcha_not_valid"), 'alert-type' => 'error'])->withInput();
        }

        $booking = new Booking();
        $booking->booking_type = $request->input('booking_type');
        $booking->name = $request->input('name');
        $booking->email = $request->input('email');
        $booking->nationality = $request->input('nationality');
        $booking->mobile = $request->input('mobile');

        if ($request->input("country")) {
            $booking->country_id = $request->input('country');
        }

        $booking->arrival_date = $request->input('date_from') ? date("Y-m-d", strtotime($request->input('date_from'))) : null;
        $booking->departure_date = $request->input('date_from') ? date("Y-m-d", strtotime($request->input('date_to'))) : null;
        $booking->num_adults = (int)$request->input("num_adults") ?: 1;
        $booking->num_children = (int)$request->input("num_children") ?: 0;
        $booking->num_bags = (int)$request->input("num_bags") ?: 0;
        $booking->notes = $request->input("notes") ?: null;
        $booking->num_rooms = (int)$request->input("num_rooms") ?: 1;

        if ($booking_type == "free") {
            $booking->hotels_level = $request->input("hotel_level");
            $booking->package_type_id = $request->input("package_type");
        }

        if ($booking_type == "hotel") {
            $booking->hotel_id = $request->input("hotel_id");
            $booking->room_id = $request->input("room_id") ?: null;
            $hotel = Hotel::published()->find($request->input("hotel_id"));
            if ($hotel) {
                $booking->country_id = $hotel->country->id;
            }
        }

        if ($booking_type == "room") {
            $booking->hotel_id = $request->input("hotel_id");
            $booking->room_id = $request->input("room_id") ?: null;
            $room = Room::published()->find($request->input("room_id"));

            if ($room) {
                $hotel = $room->hotel;
                $booking->country_id = $hotel->country->id;
            }
        }

        if ($booking_type == "package") {
            $booking->package_id = $request->input("package_id");
            $package = Package::published()->find($request->input("package_id"));
            if ($package) {
                $booking->country_id = $package->country->id;
            }
        }

        if ($booking->save()) {
            // send email notification to receivers in settings// send email notification to receivers in settings
            $emails = explode(PHP_EOL, Setting::get("receivers_emails"));
            if($emails && is_array($emails)){
                $emails=array_map('trim', $emails);
                Mail::to($emails)->send(new NewBookingNotification($booking));
            }
            // send booking confirmation email
            Mail::to($booking->email)->send(new BookingConfirmation($booking));
            return redirect("/booking/thank_you")->with(['booking_status' => true]);
        }
    }

    function thank_you()
    {
        if (!Session::get("booking_status") == true) {
            return redirect("/");
        }
        return view("frontend.booking.thankyou", $this->data);
    }
}
