<?php

namespace Corsata\Http\Controllers;

use Corsata\Http\Requests;
use Corsata\User;
use Corsata\StudentTip;
use Corsata\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class UsersController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $this->data['data'] = $user;
        $this->data['title'] = "Profile";
        $this->data['meta_description'] = "test";
        $this->data['meta_keywords'] = "test";
        $this->data['related'] = "test";
        $this->data['application_name'] = "test";
        return view('frontend.users.profile', $this->data);

    }


    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $rules = [
            'name' => "required|max:255",
            'about' => "max:500",
            //"email"  => "email|required|max:255|unique:users,email,{$user->id}",
            //'gender' => "required|max:10",
        ];


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

      $residencePlace = Country::where('code', $request->input('residencePlace'))->first();
        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->nationality = $request->input('nationality');
        $user->residence_place = $residencePlace->id;
        $user->city_name = $request->input('city');
        $user->state_name = $request->input('state');
        $user->whatsapp = $request->input('whatsappNumber');
        $user->address_line1 = $request->input('address_line1');
        $user->address_line2 = $request->input('address_line2');
        $user->birth_date = $request->input('birthDate') ? date("Y-m-d", strtotime($request->input('birthDate'))) : null;
        $user->phone = $request->input('phone');
        $user->zip_code = $request->input('zip_code')?: null;
        $user->gender = $request->input('gender');
        $user->save();


        if ($user->save()) {

            return redirect()->back()->with(['message' => trans("users.success_updated"), 'alert-type' => 'success']);

        }

        return redirect()->back()->with(['message' => 'users.error_create', 'alert-type' => 'error'])->withInput();

    }

    public function settings()
    {


        $user = User::find(Auth::id());
        if (!$user) {
            return redirect()->back()->with(['message' => trans("users.id_not_found"), 'alert-type' => 'warning']);
        }
        $this->data['data'] = $user;
        $this->data['title'] = "Profile";
        $this->data['meta_description'] = "test";
        $this->data['meta_keywords'] = "test";
        $this->data['related'] = "test";
        $this->data['application_name'] = "test";
        return view('frontend.users.settings', $this->data);

    }


    public function updateSettings(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $rules = [

            "email"    => "email|required|max:255|unique:users,email,{$user->id}",
            'password' => 'required|min:6|confirmed',

        ];


        /**
         * if (!Hash::check($request->get("old_password"),  Auth::user()->password) {
         * return redirect()->back()->with(['message'=>"Not valid Old Password",'alert-type'=>"error"]);
         * }
         **/


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $user->email = $request->input("email");

        if ($request->input("password"))
            $user->password = bcrypt($request->input("password"));


        if ($user->save()) {

            return redirect()->back()->with(['message' => trans("users.success_updated"), 'alert-type' => 'success']);

        }

        return redirect()->back()->with(['message' => 'users.error_create', 'alert-type' => 'error'])->withInput();

    }

    public function bookings()
    {
       $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $this->data['title'] = "Profile";

        $this->data['data'] = $user;

        return view('frontend.users.bookings.index', $this->data);
    }

    public function student_tips()
    {
        $this->data['title']=trans("student_tips.frontend_title_tips")." - ".$this->data['title'];
         $this->data['data']= StudentTip::whereStatus(true)->paginate(10);

        return view("frontend.users.guide", $this->data);
    }

    public function bookingInfo($id = 0, $code = 0)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        
        $booking = Booking::find($id);
        if (!$booking) {
            return abort(404);
        }

        $advisor = $booking->advisor()->get();


        $this->data['title'] = "bookings";
        $this->data['data'] = $user;
        $this->data['booking'] = $booking;
        $this->data['course'] = $booking->course()->first();

        return view('frontend.users.bookings.show', $this->data);
    }

     public function myAdvisor($id = 0, $booking_id = 0)
    {

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        
        $booking = Booking::find($id);
        if (!$booking) {
            return abort(404);
        }

        

        $this->data['title'] = "bookings";
        $this->data['booking'] = $booking;
        $this->data['advisor'] = $booking->advisor()->first();
        $this->data['data'] = $user;

        return view('frontend.users.bookings.advisor', $this->data);
    }


    public function myAccommodation($id = 0, $slug = null)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        
        $booking = Booking::find($id);
        if (!$booking) {
            return abort(404);
        }

        

        $this->data['title'] = "bookings";
        $this->data['booking'] = $booking;
        $this->data['housing'] = $booking->housing()->first();
        $this->data['data'] = $user;

        return view('frontend.users.bookings.housing', $this->data);
    }

}
