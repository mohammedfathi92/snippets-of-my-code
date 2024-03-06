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

Route::get('files/small/{file}', function (\Illuminate\Http\Request $request, $file) {
    $upload_path = config("settings.upload_dir");
    $filename = $upload_path . "/" . config("settings.thumbnails_dir") . "/$file";
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

     Route::get("/bill/{id}/view", "bookingController@showBill")->name("booking.bill");


// Start backend routes
    Route::group([
        'prefix'    => Settings::get('backend_uri') ?: config("settings.backend_uri"),
        'namespace' => "backend",
    ], function () {

         Route::get("login", "Auth\LoginController@showLoginForm");
         Route::post("login", "Auth\LoginController@postLogin");
         Route::post("logout", "Auth\LoginController@logout");
         Route::get("password/forget", "Auth\ForgotPasswordController@showLinkRequestForm");


         Route::post("password/forget", "Auth\ForgotPasswordController@sendResetLinkEmail");

         Route::get("password/reset", "Auth\ResetPasswordController@showResetForm");

         Route::post("password/reset", "Auth\ResetPasswordController@reset");
        // Auth::routes();
        Route::group(["middleware" => "auth.admin"], function () {

            Route::get("/", "HomeController@index");

             // Permissions
                Route::group(['prefix' => 'permissions'], function () {
                    Route::get("/", "PermissionsController@index");
                    Route::get("/create", "PermissionsController@create");
                    Route::post("/create", "PermissionsController@store");
                    Route::get("/{id}/edit", "PermissionsController@edit");
                    Route::put("/{id}/edit", "PermissionsController@update");
                    Route::get("/{id}/delete", "PermissionsController@delete");
                    Route::delete("/delete", "PermissionsController@multiDelete");
                });


    

            // Ajax Routes
            Route::group(['prefix' => 'ajax'], function () {

                Route::get("country/{code}/institutes", function ($code) {
                    $country = \Corsata\Country::whereCode($code)->first();
                    if (!$country) return response()->json(['success' => false, 'message' => trans('countries.id_not_found')]);

                    $institutes = $country->institutes;

                    if (!$institutes->count()) return response()->json(['success' => false, 'message' => trans("institutes.message_no_institutes_in_country", ['country' => $country->name])]);

                    return response()->json(['success' => true, 'data' => $institutes->get()]);
                });

                Route::get("country/{code}/cities", function ($code) {
                    $country = \Corsata\Country::whereCode($code)->first();
                    if (!$country) return response()->json(['success' => false, 'message' => trans('countries.id_not_found')]);

                    $cities = $country->cities;

                    if (!$cities->count()) return response()->json(['success' => false, 'message' => trans("cities.no_cities_found", ['country' => $country->name])]);

                    return response()->json(['success' => true, 'data' => $cities->get()]);
                });


                Route::get("cities/{id}/getInstitutesList", function ($id) {
                    $city = \Corsata\City::find($id);
                    if (!$city) return response()->json(['success' => false, 'message' => trans('cities.id_not_found')]);

                    $institutes = $city->institutes();
                    if (!$institutes->count()) return response()->json(['success' => false, 'message' => trans("institutes.message_no_institutes_in_city", ['city' => $city->name])]);

                    return response()->json(['success' => true, 'data' => $institutes->get()]);
                });

                Route::get("institutes/{id}/getCoursesList", function ($id) {
                    $institute = \Corsata\Institute::find($id);
                    if (!$institute) return response()->json(['success' => false, 'message' => trans('institutes.id_not_found')]);

                    $courses = $institute->courses();
                    if (!$courses->count()) return response()->json(['success' => false, 'message' => trans("courses.message_no_courses_in_institute", ['institute' => $institute->name])]);

                    return response()->json(['success' => true, 'data' => $courses->get()]);
                });

                Route::get("transports/getTransportTypes", function () {
                    $types = ['ship' => trans('transports.transport_type.ship'), 'bus' => trans('transports.transport_type.bus'), 'car' => trans('transports.transport_type.car'), 'tran' => trans('transports.transport_type.tran')];

                    return response()->json(['success' => true, 'data' => $types]);
                });

                Route::get("transports/{type}/getTypeTransports", function ($type) {

                    if (!$type) return response()->json(['success' => false, 'message' => trans('transports.message_transport_type_not_found')]);
                    $transports = \Corsata\Transport::where('type', $type);

                    if (!$transports->count()) return response()->json(['success' => false, 'message' => trans('transports.message_type_dose_not_have_transports')]);
                    return response()->json(['success' => true, 'data' => $transports->get()]);
                });


            });
//            Countries and cities
            Route::group(['prefix' => 'countries'], function () {
                Route::get("/", "CountriesController@index");
                Route::get("/create", "CountriesController@create");
                Route::post("/create", "CountriesController@store");
                Route::get("/{id}/edit", "CountriesController@edit");
                Route::put("/{id}/edit", "CountriesController@update");
                Route::get("/{id}/delete", "CountriesController@delete");
                Route::delete("/delete", "CountriesController@multiDelete");

                // ajax requests
                Route::get("/ajax/{id}/institutes", function ($id) {
                    $country = \Corsata\Country::find($id);
                    if (!$country) {
                        return response()->json(['success' => false, 'message' => trans("countries.id_not_found")]);
                    }
                    $institutes = $country->institutes();
                    if (!$institutes->count()) {
                        return response()->json(['success' => false, 'message' => trans("institutes.no_institutes_found")]);
                    }
                    return response()->json(['success' => true, 'data' => $institutes->get()]);
                });
                Route::get("/ajax/{id}/packages_types", function ($id) {
                    $country = \Corsata\Country::find($id);
                    if (!$country) {
                        return response()->json(['success' => false, 'message' => trans("countries.id_not_found")]);
                    }
                    $packages = $country->package_types();
                    if (!$packages->count()) {
                        return response()->json(['success' => false, 'message' => trans("packages.no_packages_found")]);
                    }
                    return response()->json(['success' => true, 'data' => $packages->get()]);
                });

                Route::get("/ajax/{id}/packages", function ($id) {
                    $country = \Corsata\Country::find($id);
                    if (!$country) {
                        return response()->json(['success' => false, 'message' => trans("countries.id_not_found")]);
                    }
                    $packages = $country->packages();
                    if (!$packages->count()) {
                        return response()->json(['success' => false, 'message' => trans("packages.no_packages_found")]);
                    }
                    return response()->json(['success' => true, 'data' => $packages->get()]);
                });

                Route::group(['prefix' => '{country_id}/tabs'], function () {

                    Route::get("/", "CountriesTabsController@index");
                    Route::get("/create", "CountriesTabsController@create");
                    Route::post("/", "CountriesTabsController@store");
                    Route::post("/create", "CountriesTabsController@store");
                    Route::get("/{id}/edit", "CountriesTabsController@edit");
                    Route::put("/{id}/edit", "CountriesTabsController@update");
                    Route::get("/{id}/delete", "CountriesTabsController@delete");
                    Route::delete("/delete", "CountriesTabsController@multiDelete");
                });

                //cities
                Route::group(['prefix' => "{country_id}/cities"], function () {

                    Route::get("/", "CitiesController@index");
                    Route::get("/create", "CitiesController@create");
                    Route::post("/create", "CitiesController@store");
                    Route::get("/{id}/edit", "CitiesController@edit");
                    Route::put("/{id}/edit", "CitiesController@update");
                    Route::get("/{id}/delete", "CitiesController@delete");
                    Route::delete("/delete", "CitiesController@multiDelete");

                    Route::group(['prefix' => '{city_id}/tabs'], function () {

                        Route::get("/", "CitiesTabsController@index");
                        Route::get("/create", "CitiesTabsController@create");
                        Route::post("/", "CitiesTabsController@store");
                        Route::post("/create", "CitiesTabsController@store");
                        Route::get("/{id}/edit", "CitiesTabsController@edit");
                        Route::put("/{id}/edit", "CitiesTabsController@update");
                        Route::get("/{id}/delete", "CitiesTabsController@delete");
                        Route::delete("/delete", "CitiesTabsController@multiDelete");
                    });
                });

                Route::get("{country_id}/getCitiesList", function ($country_id) {
                    $country = \Corsata\Country::find($country_id);
                    if ($country) {
                        $cities = $country->cities;
                        return response()->json(['success' => true, 'data' => $cities]);

                    }
                    return response()->json(['success' => false, 'data' => trans('countries.id_not_found')]);
                });
            });

          

            //   Institutes and courses
            Route::group(['prefix' => 'institutes'], function () {

                Route::get("{institute_id}/getHouseServicesList", function ($institute_id) {
                    $institute = \Corsata\Institute::find($institute_id);
                    if ($institute) {
                        $services = $institute->services()->where('type', 'house')->get();
                        return response()->json(['success' => true, 'data' => $services]);

                    }
                    return response()->json(['success' => false, 'data' => trans('institutes.id_not_found')]);
                });

                Route::get("{institute_id}/getTransportServicesList", function ($institute_id) {
                    $institute = \Corsata\Institute::find($institute_id);
                    if ($institute) {
                        $services = $institute->services()->where('type', 'transport')->get();
                        return response()->json(['success' => true, 'data' => $services]);

                    }
                    return response()->json(['success' => false, 'data' => trans('institutes.id_not_found')]);
                });

                Route::get("{institute_id}/getInsuranceServicesList", function ($institute_id) {
                    $institute = \Corsata\Institute::find($institute_id);
                    if ($institute) {
                        $services = $institute->services()->where('type', 'insurance')->get();
                        return response()->json(['success' => true, 'data' => $services]);

                    }
                    return response()->json(['success' => false, 'data' => trans('institutes.id_not_found')]);
                });

                Route::get("{institute_id}/getBooksServicesList", function ($institute_id) {
                    $institute = \Corsata\Institute::find($institute_id);
                    if ($institute) {
                        $services = $institute->services()->where('type', 'books')->get();
                        return response()->json(['success' => true, 'data' => $services]);

                    }
                    return response()->json(['success' => false, 'data' => trans('institutes.id_not_found')]);
                });

                 Route::get("{institute_id}/getAdvisorServiceList", function ($institute_id) {
                    $institute = \Corsata\Institute::find($institute_id);
                    if ($institute) {
                        $services = $institute->services()->where('type', 'advisor')->get();
                        return response()->json(['success' => true, 'data' => $services]);

                    }
                    return response()->json(['success' => false, 'data' => trans('institutes.id_not_found')]);
                });


                  Route::get("{institute_id}/getCoursesList", function ($institute_id) {
                    $institute = \Corsata\Institute::find($institute_id);
                    if ($institute) {
                        $courses = $institute->courses;
                        return response()->json(['success' => true, 'data' => $courses]);

                    }
                    return response()->json(['success' => false, 'data' => trans('institutes.id_not_found')]);
                });
                Route::get("/list", "InstitutesController@index");
                Route::get("/create", "InstitutesController@create");
                Route::post("/create", "InstitutesController@store");
                Route::get("/{id}/edit", "InstitutesController@edit");
                Route::put("/{id}/edit", "InstitutesController@update");
                Route::get("/{id}/delete", "InstitutesController@delete");
                Route::delete("/delete", "InstitutesController@multiDelete");
                Route::get('compare/list', 'InstitutesController@compareInstitutes')->name('compare.institutes');
                 

                  //  Institutes Basic Services
                Route::group(['prefix' => '/basic-services'], function () {
                    Route::get("/", "BasicServicesController@index");
                    Route::get("/create", function () {
                        return view("backend.services.ajaxCreate", ['method' => 'post']);
                    })->middleware('ajax');
                    Route::get("/create", "BasicServicesController@create");
                    Route::post("/", "BasicServicesController@store");
                    Route::post("/create", "BasicServicesController@store");
                    Route::get("/{id}/edit", "BasicServicesController@edit");
                    Route::put("/{id}/edit", "BasicServicesController@update");
                    Route::get("/{id}/delete", "BasicServicesController@delete");
                    Route::delete("/delete", "BasicServicesController@multiDelete");
                });


                //  Institutes Sub Services
                Route::group(['prefix' => '{institute_id}/services'], function () {
                    Route::get("/", "ServicesController@index");
                    Route::get("/create", function () {
                        return view("backend.services.ajaxCreate", ['method' => 'post']);
                    })->middleware('ajax');
                    Route::get("/create", "ServicesController@create");
                    Route::post("/", "ServicesController@store");
                    Route::post("/create", "ServicesController@store");
                    Route::get("/{id}/edit", "ServicesController@edit");
                    Route::put("/{id}/edit", "ServicesController@update");
                    Route::get("/{id}/delete", "ServicesController@delete");
                    Route::delete("/delete", "ServicesController@multiDelete");
                    Route::post("/add-basic-services", "ServicesController@addBasicServices");
                });


                //Courses
                Route::get("{institute_id}/", "CoursesController@index");
                Route::get("{institute_id}/courses", "CoursesController@index");
                Route::get("{institute_id}/courses/create", "CoursesController@create");
                Route::post("{institute_id}/courses/create", "CoursesController@store");
                Route::get("{institute_id}/courses/{id}/edit", "CoursesController@edit");
                Route::put("{institute_id}/courses/{id}/edit", "CoursesController@update");
                Route::get("{institute_id}/courses/{id}/delete", "CoursesController@delete");
                Route::delete("{institute_id}/courses/delete", "CoursesController@multiDelete");

            });

            //  Housings
            Route::group(['prefix' => 'housings'], function () {
                Route::get("/", "BookedHousingsController@index");
                Route::get("/create", "BookedHousingsController@create");
                Route::post("/create", "BookedHousingsController@store");
                Route::get("/{id}/edit", "BookedHousingsController@edit");
                Route::put("/{id}/edit", "BookedHousingsController@update");
                Route::get("/{id}/delete", "BookedHousingsController@delete");
                Route::delete("/delete", "BookedHousingsController@multiDelete");
            });

            //  Places
            Route::group(['prefix' => 'places'], function () {
                Route::get("/", "PlacesController@index");
                Route::get("/create", "PlacesController@create");
                Route::post("/create", "PlacesController@store");
                Route::get("/{id}/edit", "PlacesController@edit");
                Route::put("/{id}/edit", "PlacesController@update");
                Route::get("/{id}/delete", "PlacesController@delete");
                Route::delete("/delete", "PlacesController@multiDelete");


                Route::group(['prefix' => '{place_id}/tabs'], function () {

                    Route::get("/", "PlacesTabsController@index");
                    Route::get("/create", "PlacesTabsController@create");
                    Route::post("/", "PlacesTabsController@store");
                    Route::post("/create", "PlacesTabsController@store");
                    Route::get("/{id}/edit", "PlacesTabsController@edit");
                    Route::put("/{id}/edit", "PlacesTabsController@update");
                    Route::get("/{id}/delete", "PlacesTabsController@delete");
                    Route::delete("/delete", "PlacesTabsController@multiDelete");
                });


            });

            //  Categories
            Route::group(['prefix' => 'categories'], function () {
                Route::get("/", "CategoriesController@index");
                Route::get("{id}/articles", "ArticlesController@category");
                 Route::get("{id}/student-tips", "StudentTipsController@category");
                Route::get("/create", "CategoriesController@create");
                Route::post("/create", "CategoriesController@store");
                Route::post("/ajax/create", "CategoriesController@ajaxStore")->middleware('ajax')->name('categories.ajax.create');
                Route::get("/{id}/edit", "CategoriesController@edit");
                Route::put("/{id}/edit", "CategoriesController@update");
                Route::get("/{id}/delete", "CategoriesController@delete");
                Route::delete("/delete", "CategoriesController@multiDelete");

            });

            //  Articles
            Route::group(['prefix' => 'articles'], function () {
                Route::get("/", "ArticlesController@index");
                Route::get("/create", "ArticlesController@create");
                Route::post("/create", "ArticlesController@store");
                Route::get("/{id}/edit", "ArticlesController@edit");
                Route::put("/{id}/edit", "ArticlesController@update");
                Route::get("/{id}/delete", "ArticlesController@delete");
                Route::delete("/delete", "ArticlesController@multiDelete");


                Route::group(['prefix' => '{article_id}/tabs'], function () {

                    Route::get("/", "ArticlesTabsController@index");
                    Route::get("/create", "ArticlesTabsController@create");
                    Route::post("/", "ArticlesTabsController@store");
                    Route::post("/create", "ArticlesTabsController@store");
                    Route::get("/{id}/edit", "ArticlesTabsController@edit");
                    Route::put("/{id}/edit", "ArticlesTabsController@update");
                    Route::get("/{id}/delete", "ArticlesTabsController@delete");
                    Route::delete("/delete", "ArticlesTabsController@multiDelete");
                });
            });

            //studet tips
            
            Route::group(['prefix' => 'student-tips'], function () {
                Route::get("/", "StudentTipsController@index");
                Route::get("/create", "StudentTipsController@create");
                Route::post("/create", "StudentTipsController@store");
                Route::get("/{id}/edit", "StudentTipsController@edit");
                Route::put("/{id}/edit", "StudentTipsController@update");
                Route::get("/{id}/delete", "StudentTipsController@delete");
                Route::delete("/delete", "StudentTipsController@multiDelete");

             });

            //  News
            Route::group(['prefix' => 'news'], function () {
                Route::get("/", "NewsController@index");
                Route::get("/create", "NewsController@create");
                Route::post("/create", "NewsController@store");
                Route::get("/{id}/edit", "NewsController@edit");
                Route::put("/{id}/edit", "NewsController@update");
                Route::get("/{id}/delete", "NewsController@delete");
                Route::delete("/delete", "NewsController@multiDelete");

            });

            //  News
            Route::group(['prefix' => 'transports'], function () {
                Route::get("/", "TransportsController@index");
                Route::get("/create", "TransportsController@create");
                Route::post("/create", "TransportsController@store");
                Route::get("/{id}/edit", "TransportsController@edit");
                Route::put("/{id}/edit", "TransportsController@update");
                Route::get("/{id}/delete", "TransportsController@delete");
                Route::delete("/delete", "TransportsController@multiDelete");

            });



            //Landing Pages
            Route::group(['prefix' => 'landing-pages'], function () {


                Route::get("/", "LandingPagesController@index");
                Route::get("/create", "LandingPagesController@create");
                Route::post("/create", "LandingPagesController@store");
                Route::get("/{id}/edit", "LandingPagesController@edit");
                Route::put("/{id}/edit", "LandingPagesController@update");
                Route::get("/{id}/delete", "LandingPagesController@delete");
                Route::delete("/delete", "LandingPagesController@multiDelete");

            });


            //  Pages
            Route::group(['prefix' => 'pages'], function () {
                Route::get("/", "PagesController@index");
                Route::get("/create", "PagesController@create");
                Route::post("/create", "PagesController@store");
                Route::get("/{id}/edit", "PagesController@edit");
                Route::put("/{id}/edit", "PagesController@update");
                Route::get("/{id}/delete", "PagesController@delete");
                Route::delete("/delete", "PagesController@multiDelete");

                Route::group(['prefix' => '{page_id}/tabs'], function () {

                    Route::get("/", "PagesTabsController@index");
                    Route::get("/create", "PagesTabsController@create");
                    Route::post("/", "PagesTabsController@store");
                    Route::post("/create", "PagesTabsController@store");
                    Route::get("/{id}/edit", "PagesTabsController@edit");
                    Route::put("/{id}/edit", "PagesTabsController@update");
                    Route::get("/{id}/delete", "PagesTabsController@delete");
                    Route::delete("/delete", "PagesTabsController@multiDelete");
                });

            });

            // Bookings
            Route::group(['prefix' => 'bookings'], function () {
                Route::get("/", "BookingsController@index");
                Route::get("/{id}/edit", "BookingsController@edit");
                Route::get("/create", "BookingsController@create")->name('bookings.create');
                Route::post("/create", "BookingsController@store");
                Route::get("/{id}/show", "BookingsController@show");
                Route::put("/{id}/edit", "BookingsController@update");
                Route::get("/{id}/delete", "BookingsController@delete");
                Route::delete("/delete", "BookingsController@multiDelete");
                Route::get("/status/", "BookingsController@changeStatus");
                Route::get("/ajax_choose_user", "BookingsController@chooseUser");
            });

            // advisors
            Route::group(['prefix' => 'advisors'], function () {
                Route::get("/", "BookingsController@index");
                Route::get("/students/list", "AdvisorsController@studentsList");
                Route::get("/students/{booking_id}/show", "AdvisorsController@viewStudent");
                Route::post("/create", "BookingsController@store");
                Route::get("/{id}/show", "BookingsController@show");
                Route::put("/{id}/edit", "BookingsController@update");
                Route::get("/{id}/delete", "BookingsController@delete");
                Route::delete("/delete", "BookingsController@multiDelete");
                Route::get("/status/", "BookingsController@changeStatus");
            });

            //  Slides
            Route::group(['prefix' => 'slides'], function () {
                Route::get("/", "SlidesController@index");
                Route::get("/create", "SlidesController@create");
                Route::post("/create", "SlidesController@store");
                Route::get("/{id}/edit", "SlidesController@edit");
                Route::put("/{id}/edit", "SlidesController@update");
                Route::get("/{id}/delete", "SlidesController@delete");
                Route::delete("/delete", "SlidesController@multiDelete");

            });

            //  Packages Types
            Route::group(['prefix' => 'packages_types'], function () {
                Route::get("/", "PackagesTypesController@index");
                Route::get("/create", "PackagesTypesController@create");
                Route::post("/create", "PackagesTypesController@store");
                Route::get("/{id}/edit", "PackagesTypesController@edit");
                Route::put("/{id}/edit", "PackagesTypesController@update");
                Route::get("/{id}/delete", "PackagesTypesController@delete");
                Route::delete("/delete", "PackagesTypesController@multiDelete");

                Route::get("/ajax/{id}/packages", function ($id) {
                    $type = \Corsata\PackageType::find($id);
                    if (!$type) {
                        return response()->json(['success' => false, 'message' => trans("packages_types.id_not_found")]);
                    }
                    $packages = $type->packages();
                    if (!$packages->count()) {
                        return response()->json(['success' => false, 'message' => trans("packages.no_packages_found")]);
                    }
                    return response()->json(['success' => true, 'data' => $packages->get()]);
                });
            });

            Route::group(['prefix' => 'currencies'], function () {
                Route::get("/", "CurrenciesController@index");
                Route::get("/update_rates", "CurrenciesController@updateRates");
                Route::get("/create", "CurrenciesController@create");
                Route::post("/create", "CurrenciesController@store");
                Route::get("/{id}/edit", "CurrenciesController@edit");
                Route::put("/{id}/edit", "CurrenciesController@update");
                Route::get("/{id}/delete", "CurrenciesController@delete");
                Route::delete("/delete", "CurrenciesController@multiDelete");
            });

            //  Packages
            Route::group(['prefix' => 'packages'], function () {
                Route::get("/", "PackagesController@index");
                Route::get("/create", "PackagesController@create");
                Route::post("/create", "PackagesController@store");
                Route::get("/{id}/edit", "PackagesController@edit");
                Route::put("/{id}/edit", "PackagesController@update");
                Route::get("/{id}/delete", "PackagesController@delete");
                Route::delete("/delete", "PackagesController@multiDelete");
            });
            Route::get("/account", "UsersController@account");
            Route::put("/account", "UsersController@updateAccount");


            //            Users management Routes
            Route::group(['prefix' => 'users'], function () {
                Route::get("/", "UsersController@index");
                Route::get("/create", "UsersController@create");
                Route::post("/create", "UsersController@store");
                Route::get("/{id}/edit", "UsersController@edit");
                Route::put("/{id}/edit", "UsersController@update");
                Route::get("/{id}/delete", "UsersController@delete");
                Route::delete("/delete", "UsersController@multiDelete");

            });

            //  FAQ
            Route::group(['prefix' => 'faq'], function () {
                Route::get("/", "FAQController@index");
                Route::get("/create", "FAQController@create");
                Route::post("/create", "FAQController@store");
                Route::get("/{id}/edit", "FAQController@edit");
                Route::put("/{id}/edit", "FAQController@update");
                Route::get("/{id}/delete", "FAQController@delete");
                Route::delete("/delete", "FAQController@multiDelete");

                // Questions
                Route::group(['prefix' => '{category_id}/questions'], function () {
                    Route::get("/", "FaqQuestionsController@index");
                    Route::get("/create", "FaqQuestionsController@create");
                    Route::post("/create", "FaqQuestionsController@store");
                    Route::get("/{id}/edit", "FaqQuestionsController@edit");
                    Route::put("/{id}/edit", "FaqQuestionsController@update");
                    Route::get("/{id}/delete", "FaqQuestionsController@delete");
                    Route::delete("/delete", "FaqQuestionsController@multiDelete");
                });

            });

            Route::group(['prefix' => 'messages'], function () {
                Route::get("/", "ContactUsController@index");
                Route::get("/{id}/show", "ContactUsController@show");
                Route::post("/{id}/show", "ContactUsController@reply");
                Route::get("{id}/delete", "ContactUsController@delete");
                Route::delete("{id}/delete", "ContactUsController@delete");
                Route::get("/settings", "ContactUsController@settings");
                Route::put("/settings", "ContactUsController@storeSettings");

            });

            // Menu Routes
            Route::group(['prefix' => 'menus'], function () {
                Route::get("/", "MenusController@index");
                Route::get("/create", "MenusController@create");
                Route::post("/create", "MenusController@store");
                Route::get("/{id}/edit", "MenusController@edit");
                Route::put("/{id}/edit", "MenusController@update");
                Route::get("/{id}/delete", "MenusController@delete");
                Route::delete("/delete", "MenusController@multiDelete");

                Route::group(['prefix' => '{menu_id}/items'], function () {
                    Route::get("/", "MenuItemsController@index");
                    Route::get("/create", "MenuItemsController@create");
                    Route::post("/create", "MenuItemsController@store");
                    Route::get("/{id}/edit", "MenuItemsController@edit");
                    Route::put("/{id}/edit", "MenuItemsController@update");
                    Route::get("/{id}/delete", "MenuItemsController@delete");
                    Route::delete("/delete", "MenuItemsController@multiDelete");
                });
            });
//            Settings Routes
            Route::group(['prefix' => 'settings'], function () {
                Route::get('/', 'SettingsController@index');
                Route::post('/', 'SettingsController@save');
                Route::post('create', 'SettingsController@create');
                Route::delete('{id}', 'SettingsController@delete');
                Route::get('move_up/{id}', 'SettingsController@move_up');
                Route::get('move_down/{id}', 'SettingsController@move_down');
                Route::get('delete_value/{id}', 'SettingsController@delete_value');
            });

            Route::post('upload', "UploaderController@upload");
            Route::delete('upload/{file}', "UploaderController@delete");
        });

    });


});


