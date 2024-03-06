<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\Country;
use Corsata\Booking;
use Corsata\Course;
use Corsata\BookedService;
use Corsata\BookedHousing;
use Corsata\Institute;
use Corsata\Service;
use Corsata\User;
use Corsata\Media;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;
use Corsata\Http\Requests;
use Corsata\Http\Controllers\backend\BackendBaseController;

class AdvisorsController extends BackendBaseController
{
    function index()
    {

    }

    function studentsList()
    {
        // if (!Auth::user()->can("show students")) {

        //     return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        // }

        $booking = Booking::where('advisor_id', Auth::id())->get();
        $this->data['data'] = $booking;
      

        return view("backend.advisors.students", $this->data);
    }

     function viewStudent($booking_id)
    {
        // if (!Auth::user()->can("show students")) {

        //     return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        // }

         $booking = Booking::find($booking_id);
        if (!$booking) {
            return redirect()->back()->with(['message' => trans("institutes.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['booking'] = $booking;

        $this->data['data'] = User::find($booking->user_id);
        $this->data['institute'] = $booking->institute()->first();
        $this->data['course'] = $booking->course()->first();
        $this->data['housing'] = $booking->housing()->first();
    
    
      

        return view("backend.advisors.view_student", $this->data);
    }

}