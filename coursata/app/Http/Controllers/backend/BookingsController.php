<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\Country;
use Corsata\Booking;
use Corsata\Course;
use Corsata\BookedService;
use Corsata\Institute;
use Corsata\Currency;
use Corsata\Service;
use Corsata\User;
use Corsata\Mail\BookingConfirmation;
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

class BookingsController extends BackendBaseController
{
    function index()
    {
        if (!Auth::user()->can("show bookings")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $this->data['data'] = Booking::orderBy("created_at", "desc")->get();

        $this->data['users'] = User::all();
        return view("backend.bookings.index", $this->data);
    }

    function chooseUser(){

         if (!Auth::user()->can("create bookings")) {
            return response()->json([
    'data' => 'Error']);
        }
        $this->data['data'] = User::all();

        return view("backend.bookings.choose_user", $this->data);

    }

      function create(Request $request)
    {
        if (!Auth::user()->can("create bookings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

         $rules = [
            'user'      => 'required|integer',   
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user_id = (int)$request->input('user');

        $user = User::find($user_id);
        if (!$user){
            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['countries'] = Country::all();
        $this->data['data'] = $user;

        return view("backend.bookings.create", $this->data);
    }

    function store(Request $request)
    {

        
        
        if (!Auth::user()->can("create bookings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }


        $rules = [
            'firstName'      => 'required|max:20',
            'lastName'       => "required|max:20",
            'email'          => "required|max:70",
            'birthDate'      => "required|date",
            'nationality'    => "required",
            'residencePlace' => 'required',
            'city'           => 'required',
            'address_line1'  => 'required',
            'address_line2'  => 'nullable',
            'phone'          => 'required|min:8|numeric',
            'whatsappNumber' => 'nullable|min:8|numeric',
            'institute' => 'required',
            'course' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user_id = (int)$request->input('user_id');

        $user = User::find($user_id);
        if (!$user) {

            return redirect()->back()->with(['message' => trans("bookings.user_id_not_found"), 'alert-type' => 'error']);
        }

        $courseId = $request->input('course');
        $instituteId = $request->input('institute');

        $institute = Institute::find($instituteId);
        if (!$institute){
            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);
        }

        $course = Course::find($courseId);
        if (!$course){
            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);
        }

        $total_price = (double)0.0;

        $selectedServices = [];

        $transport_id = (int)$request->input('transport_service');

        if($transport = Service::find($transport_id)){
        $transportPrice = $request->input('transport_price')?: $transport->price + $transport->fees ;

        $total_price += $transportPrice;

        $selectedServices[]= ['type'=>'transport','name'=>$transport->name, 'house_type' => null, 'service_id'=>$transport_id, 'week_price'=>$transportPrice, 'total_price'=>$transportPrice,'num_weeks'=>null];
}


        $advisor_service_id = (int)$request->input('advisor_service');

        if($advisor_service = Service::find($advisor_service_id)){
        $advisorPrice = $request->input('advisor_price')?: $advisor_service->price + $advisor_service->fees ;

        $total_price += $advisorPrice;

        $selectedServices[]= ['type'=>'advisor','name'=>$advisor_service->name, 'house_type' => null, 'service_id'=>$advisor_service_id, 'week_price'=>$advisorPrice, 'total_price'=>$advisorPrice,'num_weeks'=>null];
}



        $books_id = (int)$request->input('books_service');
        if($books = Service::find($books_id)){
        $booksPrice = $request->input('books_price')?: $books->price + $books->fees ;
        $total_price += $booksPrice;

        $selectedServices[]= ['type'=>'books','name'=>$books->name, 'house_type' => null, 'service_id'=>$books_id, 'week_price'=>$booksPrice, 'total_price'=>$booksPrice,'num_weeks'=>null];

}


        $insurance_id = (int)$request->input('insurance_service');
        if($insurance = Service::find($insurance_id)){
        $insurancePrice = $request->input('insurance_price')?: $insurance->price + $insurance->fees ;
        $total_price += $insurancePrice;

        $selectedServices[]= ['type'=>'insurance','name'=>$insurance->name, 'house_type' => null, 'service_id'=>$insurance_id, 'week_price'=>$insurancePrice, 'total_price'=>$insurancePrice,'num_weeks'=>null];

}
        $house_id = (int)$request->input('house_service');
        if($house = Service::find($house_id)){
        $housePrice = $request->input('house_price')?:$house->price;

        if($request->input('house_price')){
            $houseFees = 0; 

        }else{
           $houseFees = $house->fees; 
        }

        $houseWeeks = (int)$request->input('house_weeks')?: 1;
        $houseTotalPrice = ($houseWeeks * $housePrice) + $houseFees;
        $total_price += $houseTotalPrice;

       $selectedServices[]= ['type'=>'house','name'=>$house->name, 'house_type' => $house->house_type, 'service_id'=>$house_id, 'week_price'=>$housePrice, 'total_price'=>$houseTotalPrice,'num_weeks'=>$houseWeeks];

       }

       $collectServices = collect($selectedServices);

      
        $courseWeeks = (int) $request->input('course_weeks')?: 1;
        
        if($course->offer_price){
            $originCoursePrice = $course->offer_price;

        }else{
             $originCoursePrice = $course->price;

        }
        $coursePrice = $request->input('course_price')?:$originCoursePrice;

        $courseTotalPrice = $courseWeeks * $coursePrice;

        $total_price += $courseTotalPrice;


        if($currency = Currency::find($course->currency_id)){
           $currency_name = $currency->name;
        }

       

        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->email = $request->input('email');
        $user->nationality = $request->input('nationality');
        $user->residence_place = (int)$request->input('residencePlace');
        $user->city_name = $request->input('city');
        $user->state_name = $request->input('state')?: null;
        $user->whatsapp = $request->input('whatsappNumber')?: null;
        $user->address_line1 = $request->input('address_line1');
        $user->address_line2 = $request->input('address_line2');
        $user->birth_date = $request->input('birthDate') ? date("Y-m-d", strtotime($request->input('birthDate'))) : null;
        $user->phone = $request->input('phone');
        $user->zip_code = $request->input('zip_code');
        $user->gender = $request->input('gender');
        $user->save();

        if($user->save()){

        $booking = new Booking();

        $booking->communication_source = $request->input('communication_source');
        $booking->currency = $request->input('currency')?:$currency_name;
        $booking->arrival_date = $request->input('arrival_date');
        $booking->departure_date = $request->input('departure_date');
        $booking->notes = $request->input('notes');
        //$booking->code = rand(100, 10000).Auth::id();
        $booking->institutes_level = $request->input('institutes_level');
        $booking->user_id = (int)$request->input('user_id');
        $booking->advisor_id = $request->input('advisor')?: null;
        $booking->housing_id = $request->input('housing')?: null;
        $booking->payment_method = "office";
        $booking->institute_id = $institute->id;     
        $booking->course_id = $course->id;
        $booking->booking_code = $booking->id.rand(1000, 9000).$user->id.rand(10, 99);        
        $booking->course_weeks =  $courseWeeks;
        $booking->course_week_price = $coursePrice;
        $booking->course_total_price = $courseTotalPrice;
        $booking->total_price = $total_price;

        $booking->status = $request->input("status");
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




        // $user = User::find($request->input('user'));

        //  if ($request->input("advisor") && is_array($request->input('advisor'))) {
        //         $user->advisors()->attach($request->input('advisor'));
        //     }


       if ($booking->save()) {

      if($booking->services()){
       foreach ($booking->services()->get() as $service){

        $service->delete();
       }

       }
       $services = $booking->services()->get();
       if($services->isEmpty()){

        foreach ($collectServices as $service) {
                  // if housing service is selected
          $bookedService = new BookedService();
          $bookedService->service_id = $service['service_id'];
          $bookedService->booking_id = $booking->id;
          $bookedService->user_id = $user_id;
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


            if ($request->input("gallery") and is_array($request->input("gallery"))) {
                $gallery = [];
                foreach ($request->input("gallery") as $image) {

                    $upload_dir = config("settings.upload_dir");
                    $upload_path = config("settings.upload_path");

                    if (Storage::disk("public")->exists($upload_dir . "/$image")) {
                        $ext = File::extension($upload_path . "/$image");
                        $mim = File::mimeType($upload_path . "/$image");
                        $gallery[] = [
                            'title'     => $image,
                            'name'      => $image,
                            'full_path' => Storage::url($upload_dir . "/$image"),
                            'extension' => $ext,
                            'mime_type' => $mim,
                            'module'    => 'bookings',
                            'key'       => 'booking-gallery',
                            'module_id' => $booking->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }  

     
        if ($booking->save()) {


            // send booking confirmation email
            if ($request->input("send_email")) {
                Mail::to($booking->email)->send(new BookingConfirmation($booking));
            }

        }
}
        return redirect($this->data['backend_uri'] . "/bookings")->with(['message' => trans("bookings.success_created"), 'alert-type' => 'success']);


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
        $this->data['user'] = $booking->user()->first();
       
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

        $user = User::find($booking->user_id);
        if (!$user) {
            return redirect()->back()->with(['message' => trans("bookings.id_not_found"), 'alert-type' => 'error']);
        }



        $this->data['page_title'] = trans("bookings.backend_page_title");
        $this->data['page_header'] = trans("bookings.backend_page_create_header");
        $this->data['booking'] =  $booking;
        $this->data['data'] = $user;
        $this->data['house'] = $booking->services()->where('type','house')->first();
        

        $this->data['transport'] = $booking->services()->where('type','transport')->first();
        $this->data['books'] = $booking->services()->where('type','books')->first();
        $this->data['advisor_service'] = $booking->services()->where('type','advisor')->first();
        $this->data['insurance'] = $booking->services()->where('type','insurance')->first();
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

         $user = User::find($booking->user_id);
        if (!$user) {
            return redirect()->back()->with(['message' => trans("bookings.user_id_not_found"), 'alert-type' => 'error']);
        }



        $rules = [
            'firstName'      => 'required|max:20',
            'lastName'       => "required|max:20",
            'email'          => "required|max:70",
            'birthDate'      => "required|date",
            'nationality'    => "required",
            'residencePlace' => 'required',
            'city'           => 'required',
            'address_line1'  => 'required',
            'address_line2'  => 'nullable',
            'phone'          => 'required|min:8|numeric',
            'whatsappNumber' => 'nullable|min:8|numeric',
            'institute' => 'required',
            'course' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $courseId = $request->input('course');
        $instituteId = $request->input('institute');

        $institute = Institute::find($instituteId);
        if (!$institute){
            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);
        }

        $course = Course::find($courseId);
        if (!$course){
            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);
        }

        $total_price = (double)0.0;

        $selectedServices = [];

        $transport_id = $request->input('transport_service');

        if($transport = Service::find($transport_id)){
        $transportPrice = $request->input('transport_price')?: $transport->price + $transport->fees ;

        $total_price += $transportPrice;

        $selectedServices[]= ['type'=>'transport','name'=>$transport->name, 'house_type' => null, 'service_id'=>$transport_id, 'week_price'=>$transportPrice, 'total_price'=>$transportPrice,'num_weeks'=>null];
}

        $advisor_service_id = (int)$request->input('advisor_service');

        if($advisor_service = Service::find($advisor_service_id)){
        $advisorPrice = $request->input('advisor_price')?: $advisor_service->price + $advisor_service->fees ;

        $total_price += $advisorPrice;

        $selectedServices[]= ['type'=>'advisor','name'=>$advisor_service->name, 'house_type' => null, 'service_id'=>$advisor_service_id, 'week_price'=>$advisorPrice, 'total_price'=>$advisorPrice,'num_weeks'=>null];
}



        $books_id = (int)$request->input('books_service');
        if($books = Service::find($books_id)){
        $booksPrice = $request->input('books_price')?: $books->price + $books->fees ;
        $total_price += $booksPrice;

        $selectedServices[]= ['type'=>'books','name'=>$books->name, 'house_type' => null, 'service_id'=>$books_id, 'week_price'=>$booksPrice, 'total_price'=>$booksPrice,'num_weeks'=>null];

}


        $insurance_id = (int)$request->input('insurance_service');
        if($insurance = Service::find($insurance_id)){
        $insurancePrice = $request->input('insurance_price')?: $insurance->price + $insurance->fees ;
        $total_price += $insurancePrice;

        $selectedServices[]= ['type'=>'insurance','name'=>$insurance->name, 'house_type' => null, 'service_id'=>$insurance_id, 'week_price'=>$insurancePrice, 'total_price'=>$insurancePrice,'num_weeks'=>null];

}
        $house_id = (int)$request->input('house_service');
        if($house = Service::find($house_id)){
        $housePrice = $request->input('house_price')?:$house->price;

        if($request->input('house_price')){
            $houseFees = 0; 

        }else{
           $houseFees = $house->fees; 
        }

        $houseWeeks = (int)$request->input('house_weeks')?: 1;
        $houseTotalPrice = ($houseWeeks * $housePrice) + $houseFees;
        $total_price += $houseTotalPrice;

       $selectedServices[]= ['type'=>'house','name'=>$house->name, 'house_type' => $house->house_type, 'service_id'=>$house_id, 'week_price'=>$housePrice, 'total_price'=>$houseTotalPrice,'num_weeks'=>$houseWeeks];

       }

       $collectServices = collect($selectedServices);

        $courseWeeks = (int) $request->input('course_weeks')?: 1;
        
        if($course->offer_price){
            $originCoursePrice = $course->offer_price;

        }else{
             $originCoursePrice = $course->price;

        }
        $coursePrice = $request->input('course_price')?:$originCoursePrice;

        $courseTotalPrice = $courseWeeks * $coursePrice;

        $total_price += $courseTotalPrice;


          
        if($currency = Currency::find($course->currency_id)){
           $currency_name = $currency->name;
        }  
        
        

        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->email = $request->input('email');
        $user->nationality = $request->input('nationality');
        $user->residence_place = $request->input('residencePlace');
        $user->city_name = $request->input('city');
        $user->state_name = $request->input('state')?: null;
        $user->whatsapp = $request->input('whatsappNumber')?: null;
        $user->address_line1 = $request->input('address_line1');
        $user->address_line2 = $request->input('address_line2');
        $user->birth_date = $request->input('birthDate') ? date("Y-m-d", strtotime($request->input('birthDate'))) : null;
        $user->phone = $request->input('phone');
        $user->zip_code = $request->input('zip_code');
        $user->gender = $request->input('gender');
        $user->save();

        if($user->save()){

        $booking->communication_source = $request->input('communication_source');
        $booking->currency = $request->input('currency')?:$currency_name;
        $booking->arrival_date = $request->input('arrival_date');
        $booking->departure_date = $request->input('departure_date');
        $booking->notes = $request->input('notes');
        //$booking->code = rand(100, 10000).Auth::id();
        $booking->institutes_level = $request->input('institutes_level');
        $booking->user_id = (int)$request->input('user_id');
        $booking->advisor_id = $request->input('advisor')?: null;
        $booking->housing_id = $request->input('housing')?: null;
        $booking->payment_method = "office";
        $booking->institute_id = $institute->id;     
        $booking->course_id = $course->id;
        $booking->course_weeks =  $courseWeeks;
        $booking->course_week_price = $coursePrice;
        $booking->course_total_price = $courseTotalPrice;
        $booking->total_price = $total_price;

        $booking->status = $request->input("status");
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

      if($booking->services()){
       foreach ($booking->services()->get() as $service){

        $service->delete();
       }

       }
       $services = $booking->services()->get();
       if($services->isEmpty()){

        foreach ($collectServices as $service) {
                  // if housing service is selected
          $bookedService = new BookedService();
          $bookedService->service_id = $service['service_id'];
          $bookedService->booking_id = $booking->id;
          $bookedService->user_id = $booking->user_id;
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


            if ($request->input("gallery") and is_array($request->input("gallery"))) {
                $gallery = [];
                foreach ($request->input("gallery") as $image) {

                    $upload_dir = config("settings.upload_dir");
                    $upload_path = config("settings.upload_path");

                    if (Storage::disk("public")->exists($upload_dir . "/$image")) {
                        $ext = File::extension($upload_path . "/$image");
                        $mim = File::mimeType($upload_path . "/$image");
                        $gallery[] = [
                            'title'     => $image,
                            'name'      => $image,
                            'full_path' => Storage::url($upload_dir . "/$image"),
                            'extension' => $ext,
                            'mime_type' => $mim,
                            'module'    => 'bookings',
                            'key'       => 'booking-gallery',
                            'module_id' => $booking->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }


     
        // if ($booking->save()) {


        //     // send booking confirmation email
        //     if ($request->input("send_email")) {
        //         Mail::to($booking->email)->send(new BookingConfirmation($booking));
        //     }

        // }

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


}
