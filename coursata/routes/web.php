<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



 //Landing Pages ajax requests
    Route::group(['prefix' => 'builder'], function () {


         Route::get("ajax/countriesList", function (\Illuminate\Http\Request $request) {
        $countries = \Corsata\Country::all();
        
        return response()->json(['success' => true, 'data' => $countries]);
    });

          Route::get("ajax/{code}/cities", function ($code) {
                    $country = \Corsata\Country::whereCode($code)->first();
                    if (!$country){ return response()->json(['success' => false, 'message' => trans('countries.id_not_found')]);
                }else{

                    $cities = $country->cities()->get();

                    if (!$cities->count()) return response()->json(['success' => false, 'message' => trans("cities.no_cities_found", ['country' => $country->name])]);

                    return response()->json(['success' => true, 'data' => $cities]);
                    }
                });



         Route::get("/page/{id}", function ($id) {

            $locale_code = Illuminate\Support\Facades\Input::get("lang")?:"ar";
                  
           return view("builder.show", ['page_title'=>trans("pages.backend_page_title"), 'pageID'=> $id, 'pageLang' => $locale_code]);
          


                });

        Route::get("/get/elements.json", function () {
                  
           return \File::get('builder/elements.json');
          


                });

                 Route::post("/ajax/{id}/store", "PageBuilderController@ajax_store");
                 Route::get("/ajax/{id}/get_json", "PageBuilderController@ajax_get_page");
                 


            });

Route::get('files/{file}', function (\Illuminate\Http\Request $request, $file) {

    $upload_path = config("settings.upload_dir");
    $filename = $upload_path . "/$file";
    $exists = Storage::disk('public')->exists($filename);
    if ($exists) {
        $file_data = Storage::disk("public")->get($filename);

        $image = \Intervention\Image\Facades\Image::make($file_data);

        if ($request->get('size')) {
            $size = explode(",", $request->get('size'));
            $width = $size[0];
            $height = $size[1];
            if ($width && $height) {
                $image->resize($width, $height);
            }
        }
        $encode_list = ['jpg', 'gif', 'png'];
        $encode = strtolower($request->input('encode'));
        if ($encode && in_array($encode, $encode_list)) {
            $image->encode($encode);
        }
        return $image->response();
    }
    return abort(404);
});


Route::get('/setCurrency/{code}', function ($code = null) {
    if(Cookie::has('currencyCode')){
    
    Cookie::forget('currencyCode');
           
       
    }
     return redirect()->back()->withCookie(Cookie::forever('currencyCode', $code));
    
    
});

Route::get('/storage/{dir}/{date}/{file}', function (\Illuminate\Http\Request $request, $dir, $date, $file) {

    $upload_path = config("settings.upload_dir");
    $filename = $upload_path . "/$dir/$date/$file";
    $exists = Storage::disk('public')->exists($filename);
    if ($exists) {
        $file_data = Storage::disk("public")->get($filename);
        $image = \Intervention\Image\Facades\Image::make($file_data);

        if ($request->get('size')) {
            $size = explode(",", $request->get('size'));
            $width = $size[0];
            $height = $size[1];
            if ($width && $height) {
                $image->resize($width, $height);
            }
        }
        $encode_list = ['jpg', 'gif', 'png'];
        $encode = strtolower($request->input('encode'));
        if ($encode && in_array($encode, $encode_list)) {
            $image->encode($encode);
        }
        return $image->response();
    }
    return abort(404);
});

Route::get('video/{file}', function (\Illuminate\Http\Request $request, $file) {

    $upload_path = config("settings.upload_dir");
    $filename = $upload_path . "/$file";
    $exists = Storage::disk('public')->exists($filename);
    if ($exists) {
        $file_data = Storage::disk("public")->get($filename);

        
        return $file_data;
    }
    return abort(404);
});

Route::get('doc/{file}', function (\Illuminate\Http\Request $request, $file) {

    $upload_path = config("settings.upload_dir");
    $filename = $upload_path . "/$file";
    $exists = Storage::disk('public')->exists($filename);
    if ($exists) {
        $file_data = Storage::disk("public")->get($filename);

        
        return $file_data;
    }
    return abort(404);
});



 Route::group(['prefix' => "favorite"], function () {

   

       Route::post('ajax/courses/{id}/add', "FavoriteController@addCourse")->middleware("ajax");
        Route::post('ajax/institutes/{id}/add', "FavoriteController@addInstitute")->middleware("ajax");
        Route::post('ajax/courses/{id}/remove', "FavoriteController@removeCourse")->middleware("ajax");
        Route::post('ajax/institutes/{id}/remove', "FavoriteController@removeInstitute")->middleware("ajax");
     


Route::get('ajax/institutes/list', function (){

            if (Auth::check()) {

            $user = Auth::user();
            $data = $user->favorites(\Corsata\Institute::class)->pluck('id')->toArray();
            return response()->json(["success" => true, 'data' => $data]);

}else{
    return response()->json(["success" => false, 'message' => trans('ERROR: You Must Login To Add Item To Favorites'), 'alert_type' => 'error']);
}
         })->middleware("ajax");


Route::get('ajax/courses/list', function (){

            if (Auth::check()) {

            $user = Auth::user();
            $data =  $user->favorites(\Corsata\Course::class)->pluck('id')->toArray();

            return response()->json(["success" => true, 'data' => $data]);

}else{
    return response()->json(["success" => false, 'message' => trans('msg_error_add_favourite'), 'alert_type' => 'error']);
}
         })->middleware("ajax");

        
       
    });


Route::group([
    'prefix'     => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect'],
], function () {

    // Frontend Routes
    
    Route::post('upload', "UploaderController@upload");
    Route::delete('upload/{file}', "UploaderController@delete");

    Route::get('/', "HomeController@index");

    Route::group(['prefix' => 'actions'], function () {
         Route::post('/removeCompare/{id}', "CompareController@removeFromCompare");
         Route::post('/addCompare/{id}', "CompareController@addToCompare");

        Route::get('/compare/list', 'CompareController@viewComparePage')->name('compare.courses');
        Route::get("compare/index", function () {
                        return view("frontend.compare.index");
                    });
    });

     Route::get("compare/ajax/institutes/list", function () {

        $compare = Session::get('compare');

       $ids = [];
        if($compare){
            $ids = $compare->pluck('id')->toArray();

             }

        $institutes = \Corsata\Institute::whereIn('id', $ids)->get();
                
            if ($institutes->count()) {
                foreach ($institutes as $k => $item) {
                    $item->country_name = $item->country->name;
                    $item->city_name = $item->city->name;
                    $item->featured = $item->featured;
                    $item->slug = str_slug($item->{"name:en"});
                    $item->url = url("/institutes/{$item->id}-{$item->slug}?" . http_build_query(Request::input()));
                    
                    $item->short_description = str_limit(strip_tags($item->description), 400);
                    $item->photo_path = url("files/{$item->photo}?size=293,220&encode=jpg");
                    if ($item->logo) {
                        $item->logo_path = url("files/{$item->logo}?size=293,220&encode=jpg");
                    }else{
                        $item->logo_path = "/images/no_image.png";

                    }
                    
                   
                }
            }

        

       return response()->json(["success" => true, "data" => $institutes, "ids"=>$ids]);


     });
     





    Route::group(['prefix' => 'country'], function () {
        Route::any('/{id}/ajax/gallery', function ($id) {
            $country = \Corsata\Country::published()->find($id);
            if (!$country) {
                return response()->json(['success' => false, 'message' => 'Country ID is not valid']);
            }
            $gallery = $country->gallery();

            if (!$gallery->count()) {
                return response()->json(['success' => false, 'message' => 'Country dose not have Photo Gallery']);
            }

            return $gallery->get();
        })->middleware("ajax");
        Route::get("{code}/ajax/institutes", function ($code) {
            $country = \Corsata\Country::whereCode($code)->first();
            if (!$country) return response()->json(['success' => false, 'message' => trans('countries.id_not_found')]);

            $institutes = $country->institutes;

            if (!$institutes->count())
                return response()->json([
                    'success' => false,
                    'message' => trans("institutes.message_no_institutes_in_country",
                        ['country' => $country->name]),
                ]);

            return response()->json(['success' => true, 'data' => $institutes]);
        })->middleware("ajax");
        Route::get("{code}/ajax/cities", function ($code) {
            $country = \Corsata\Country::whereCode($code)->first();
            if (!$country) return response()->json(['success' => false, 'message' => trans('countries.id_not_found')]);

            $cities = $country->cities;

            if (!$cities->count())
                return response()->json([
                    'success' => false,
                    'message' => trans("countries.message_no_cities_in_country",
                        ['country' => $country->name]),
                ]);

            return response()->json(['success' => true, 'data' => $cities]);
        })->middleware("ajax");
        Route::get('{code}', "CountriesController@show");
        Route::get('{code}/institutes', "CountriesController@institutes");
        Route::get('{code}/places', "CountriesController@places");
        Route::get('{code}/cities', "CountriesController@cities");
    });

    Route::group(['prefix' => "city"], function () {
        Route::get("{id}/ajax/institutes", function ($id) {
            $city = \Corsata\City::find($id);
            if (!$city) return response()->json(['success' => false, 'message' => trans('cities.id_not_found')]);

            $institutes = $city->institutes;

            if (!$institutes->count())
                return response()->json([
                    'success' => false,
                    'message' => trans("institutes.message_no_institutes_in_city",
                        ['city' => $city->name]),
                ]);

            return response()->json(['success' => true, 'data' => $institutes]);
        })->middleware("ajax");
        Route::get('{id}-{slug}', "CitiesController@show");
        Route::get('{id}/{slug}/institutes', "CitiesController@institutes");
        Route::get('{id}/{slug}/places', "CitiesController@places");
        Route::get('{id}/{slug}/packages', "CitiesController@packages");
        Route::get('{id}/{slug}/photos', "CitiesController@photos");
    });

    Route::group(['prefix' => 'institutes'], function () {
        Route::any('/ajax/{id}/gallery', function ($id) {
            $institute = \Corsata\Institute::Published()->find($id);
            if (!$institute) {
                return response()->json(['success' => false, 'message' => 'Institute ID is not valid']);
            }
            $gallery = $institute->gallery();

            if (!$gallery->count()) {
                return response()->json(['success' => false, 'message' => 'Institute dose not have Photo Gallery']);
            }

            return view("frontend.institutes.ajax_gallery", ['gallery' => $gallery->get(), "institute" => $institute]);
        })->middleware("ajax");
        Route::any('/ajax/{id}/courses/{course_id}/gallery', function ($id, $course_id) {
            $institute = \Corsata\Institute::Published()->find($id);
            if (!$institute) {
                return response()->json(['success' => false, 'message' => 'Institute ID is not valid']);
            }
            $course = $institute->courses()->find($course_id);
            $gallery = $course->gallery();
            if (!$gallery->count()) {
                return response()->json(['success' => false, 'message' => 'Institute dose not have Photo Gallery']);
            }

            return view("frontend.courses.ajax_gallery", ['gallery' => $gallery->get(), "course" => $course, "institute" => $institute]);
        })->middleware("ajax");
        Route::get("/", "InstitutesController@index")->name("institutes.index");
         Route::post("/ajax/search", "InstitutesController@ajaxSearch")->middleware("ajax");
        Route::get('{id}-{slug}', "InstitutesController@show")->name("institute.details");
        Route::get('{id}/brochures/{file_name}/download', "InstitutesController@downloadFile")->name("institute.download.brochures");
        Route::get('{id}/{slug}/courses', "InstitutesController@courses");
        Route::get('{id}/{slug}/photos', "InstitutesController@photos");
    });

    Route::group(['prefix' => "courses"], function () {
        Route::any('/ajax/{id}/gallery', function ($id) {
            $course = \Corsata\Course::published()->find($id);

            if (!$course) {
                return response()->json(['success' => false, 'message' => 'Institute ID is not valid']);
            }
            $institute = $course->institute;
            $gallery = $course->gallery();
            if (!$gallery->count()) {
                return response()->json(['success' => false, 'message' => 'Institute dose not have Photo Gallery']);
            }

            return view("frontend.courses.ajax_gallery", ['gallery' => $gallery->get(), "course" => $course, "institute" => $institute]);
        })->middleware("ajax");

        Route::get('compare/list', 'CoursesController@compareCourses')->name('compare.courses');

        Route::post("/ajax/search", "CoursesController@ajaxSearch")->middleware("ajax");
        Route::post("ajax/details", "CoursesController@ajaxDetails")->middleware("ajax");
        Route::get("/", "CoursesController@index")->name("courses.index");
        Route::get("/{id}-{slug}", "CoursesController@show")->name("course.details");
    });
   

    Route::group(['prefix' => "countries"], function () {
        Route::get("/", "CountriesController@index")->name("countries.index");
        Route::get("{code}-{slug}", "CountriesController@show")->name("countries.show");
        Route::get("{code}-{slug}/cities", "CountriesController@cities")->name("countries.cities");
        Route::get("institutes", "CountriesController@institutes")->name("countries.institutes");

    });

    Route::get('/ajax/booking/course/{id}', 'BookingController@index');

    Route::get("/ajax/services/{id}/price",function($id){
        $service=\Corsata\Service::findOrFail($id);
        if($service){
            return response()->json(['success'=>true,'data'=>$service->price]);
        }
    });



    Route::get("ajax/country/{code}/cities", function ($code) {
        $country = \Corsata\Country::whereCode($code)->first();
        if (!$country) return response()->json(['success' => false, 'message' => trans('countries.id_not_found')]);

        $cities = $country->cities;

        if (!$cities->count()) return response()->json(['success' => false, 'message' => trans("cities.no_cities_found", ['country' => $country->name])]);

        return response()->json(['success' => true, 'data' => $cities]);
    });
    Route::group(['prefix' => 'places'], function () {
        Route::any('/ajax/{id}/gallery', function ($id) {
            $place = \Corsata\Place::Published()->find($id);
            if (!$place) {
                return response()->json(['success' => false, 'message' => 'Place ID is not valid']);
            }
            $gallery = $place->gallery();

            if (!$gallery->count()) {
                return response()->json(['success' => false, 'message' => 'Place dose not have Photo Gallery']);
            }

            return view("frontend.places.ajax_gallery", ['gallery' => $gallery->get(), "place" => $place]);
        })->middleware("ajax");
        Route::get("/", "PlacesController@index");
        Route::get('{id}/{slug}', "PlacesController@show");
    });
    Route::group(['prefix' => "faq"], function () {

        Route::get("/", "FAQController@index");
        Route::get("/search", "FAQController@search");
        Route::get("/{slug}", "FAQController@show");
    });
    Route::get("ajax/countriesList", function (\Illuminate\Http\Request $request) {
        $countries = \Corsata\Country::latest()->with("cities");
        if ($request->get("hasInstitutes")) {
            $countries->whereHas("institutes");
        }
        return response()->json(['success' => true, 'data' => $countries->get()]);
    });
     Route::get("ajax/courses/categories", function (\Illuminate\Http\Request $request) {
        $categories = \Corsata\Category::all();
        
        return response()->json(['success' => true, 'data' => $categories]);
    });
     Route::get("ajax/institutes/categories", function (\Illuminate\Http\Request $request) {
        $categories = \Corsata\Category::all();
        
        return response()->json(['success' => true, 'data' => $categories]);
    });
    Route::group(['prefix' => "news"], function () {
        Route::get("/", "NewsController@index");
        Route::get("/{id}/{slug}", "NewsController@show");
        Route::get("/search", "NewsController@search");
    });//
    Route::group(['prefix' => "page"], function () {
        Route::get("/{slug}", "PagesController@show");
    });
    Route::group(['prefix' => "contact-us"], function () {
        Route::get("/", "ContactUsController@index");
        Route::post("/", "ContactUsController@sendMessage");
    });

     Route::group(["prefix" => 'guide'], function () {
        Route::get('/', "StudentTipsController@index")->name('student.tips');
        Route::get('/{id}/{slug}/show', "StudentTipsController@show")->name('student.tips.show');
    });



    Route::group(['prefix' => "booking"], function () {

        Route::get("/status", "BookingController@getPaymentStatus")->name("payment.status");
        Route::get("/thank_you", "BookingController@thank_you");
        Route::get("/{id}-{slug}", "BookingController@index")->name("checkout");
        Route::post("/{id}-{slug}", "BookingController@store")->name('booking.store');
        Route::get("notify", function () {
            $user = \Corsata\User::first();
            $order = new \Corsata\Booking();
            $order->save();
            $user->notify(new \Corsata\Notifications\BookingOrderSent($order));
            return "success";
        });
    });

    Auth::routes();

// Talk
    Route::get('testss', 'MessageController@tests');

    Route::get('/homee', 'HomeeController@index');


    Route::get('message/{id}', 'MessageController@chatHistory')->name('message.read');

    Route::group(['prefix' => 'ajax', 'as' => 'ajax::'], function () {
        Route::post('message/send', 'MessageController@ajaxSendMessage')->name('message.new');
        Route::delete('message/delete/{id}', 'MessageController@ajaxDeleteMessage')->name('message.delete');
    });

//End-Talk

    Route::get('/show', function () {
        return view('frontend.courses.show');
    });

    Route::group(['prefix' => 'account', 'middleware' => "auth"], function () {
        Route::get('/favorites', "FavoriteController@index");
        Route::get('/', 'UsersController@index')->name('account');
        Route::get('/guide', 'UsersController@student_tips')->name('account.tips');
        Route::put('/', 'UsersController@updateProfile')->name('user_update');
        Route::get('/settings', 'UsersController@settings');
        Route::put('/settings', 'UsersController@updateSettings')->name('user_settings_update');

        Route::group(['prefix' => 'bookings'], function () {
               Route::get('/', 'UsersController@bookings');
               Route::get('/{id}/{code}/show', 'UsersController@bookingInfo');
               Route::get('/{booking_id}/{code}/advisor', 'UsersController@myAdvisor');
               Route::get('/{booking_id}/{code}/housing', 'UsersController@myAccommodation');
               
         });      




    });
      Route::get("/bill/{id}/pdf", "BookingController@downloadBill")->name("booking.bill_pdf");
     Route::get("/bill/{id}/view", "BookingController@showBill")->name("booking.bill");


// Start backend routes
    Route::group([
        'prefix'    => Settings::get('backend_uri') ?: config("settings.backend_uri"),
        'namespace' => "backend",
    ], function () {


    });


});


