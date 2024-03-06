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
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    // error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}
Route::get('content-urls/update/{type}',"ContentUrlsUpdaterController@index");
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
})->name("files.url");


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

//Laravel-filemanager get routes overwrite
Route::group([
    'prefix' => 'laravel-filemanager',
], function () {
    $images_url = '/' . \Config::get('lfm.images_folder_name') . '/{base_path}/{image_name}';
    $files_url = '/' . \Config::get('lfm.files_folder_name') . '/{base_path}/{file_name}';
    Route::get($images_url, '\Unisharp\Laravelfilemanager\controllers\RedirectController@getImage')
        ->where('image_name', '.*');
    Route::get($files_url, '\Unisharp\Laravelfilemanager\controllers\RedirectController@getFIle')
        ->where('file_name', '.*');
});


//sitemap

Route::get("/sitemap.xml", "SitemapController@index");
Route::get("/countries-sitemap.xml", "SitemapController@countries");
Route::get("/hotels-sitemap.xml", "SitemapController@hotels");
Route::get("/places-sitemap.xml", "SitemapController@places");
Route::get("/cities-sitemap.xml", "SitemapController@cities");
Route::get("/packages-sitemap.xml", "SitemapController@packages");
Route::get("/news-sitemap.xml", "SitemapController@news");
Route::get("/faq-sitemap.xml", "SitemapController@faq");
Route::get("/landing-pages-sitemap.xml", "SitemapController@landing_pages");
Route::get("/pages-sitemap.xml", "SitemapController@pages");
Route::get("/guide-sitemap.xml", "SitemapController@guide");
Route::get("/main-urls-sitemap.xml", "SitemapController@main_urls");


//End sitemaps indexs

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
//    'middleware' => ['localeSessionRedirect', 'localizationRedirect'],
], function () {


    //landingPages for users

    Route::group(['prefix' => 'my'], function () {

        Route::get('{slug}', "LandingPagesController@show")->name("landing_page.user_show");

    });

    // Front-end Routes
    Route::get('/', "HomeController@index");
    Route::group(['prefix' => 'country'], function () {
        Route::any('/{id}/ajax/gallery', function ($id) {
            $country = \Sirb\Country::published()->find($id);
            if (!$country) {
                return response()->json(['success' => false, 'message' => 'Country ID is not valid']);
            }
            $gallery = $country->gallery();

            if (!$gallery->count()) {
                return response()->json(['success' => false, 'message' => 'Country dose not have Photo Gallery']);
            }

            return $gallery->get();
        });

        Route::get('{id}/{slug}', "CountriesController@show")->name("country.details");
        Route::get('{id}/{slug}/cities', "CountriesController@cities")->name("country.cities");
        Route::get('{id}/{slug}/guide', "CountriesController@guide")->name("country.guide");
        Route::get('{id}/{slug}/hotels', "CountriesController@hotels")->name("country.hotels");
        Route::get('{id}/{slug}/places', "CountriesController@places")->name("country.places");
        Route::get('{id}/{slug}/packages', "CountriesController@packages")->name("country.packages");
        Route::get('{id}/{slug}/photos', "CountriesController@photos")->name("country.photos");
    });

    Route::group(["prefix" => 'guide'], function () {
        Route::get('{id}/{slug}', "GuidesController@show")->name("guide.index");
        Route::get('{id}/topic/{topic_id}/{slug}', "GuidesController@topic")->name("guide.topic");
    });
    Route::group(['prefix' => "city"], function () {
        Route::any('/ajax/{id}/gallery', function ($id) {
            $city = \Sirb\City::Published()->find($id);
            if (!$city) {
                return response()->json(['success' => false, 'message' => 'City ID is not valid']);
            }
            $gallery = $city->gallery();

            if (!$gallery->count()) {
                return response()->json(['success' => false, 'message' => 'City dose not have Photo Gallery']);
            }

            return view("frontend.cities.ajax_gallery", ['gallery' => $gallery->get(), "city" => $city]);
        })->middleware("ajax");

        Route::get('{id}/{slug}', "CitiesController@show")->name("city.details");
        Route::get('{id}/{slug}/hotels', "CitiesController@hotels")->name("city.hotels");
        Route::get('{id}/{slug}/places', "CitiesController@places")->name("city.places");
        Route::get('{id}/{slug}/packages', "CitiesController@packages")->name("city.packages");
        Route::get('{id}/{slug}/photos', "CitiesController@photos")->name("city.photos");
    });

    Route::group(['prefix' => 'hotels'], function () {
        Route::any('/ajax/{id}/gallery', function ($id) {
            $hotel = \Sirb\Hotel::Published()->find($id);
            if (!$hotel) {
                return response()->json(['success' => false, 'message' => 'Hotel ID is not valid']);
            }
            $gallery = $hotel->gallery();

            if (!$gallery->count()) {
                return response()->json(['success' => false, 'message' => 'Hotel dose not have Photo Gallery']);
            }

            return view("frontend.hotels.ajax_gallery", ['gallery' => $gallery->get(), "hotel" => $hotel]);
        })->middleware("ajax");
        Route::any('/ajax/{id}/rooms/{room_id}/gallery', function ($id, $room_id) {
            $hotel = \Sirb\Hotel::Published()->find($id);
            if (!$hotel) {
                return response()->json(['success' => false, 'message' => 'Hotel ID is not valid']);
            }
            $room = $hotel->rooms()->find($room_id);
            $gallery = $room->gallery();
            if (!$gallery->count()) {
                return response()->json(['success' => false, 'message' => 'Hotel dose not have Photo Gallery']);
            }

            return view("frontend.rooms.ajax_gallery", ['gallery' => $gallery->get(), "room" => $room, "hotel" => $hotel]);
        })->middleware("ajax");
        Route::get("/", "HotelsController@index")->name("hotels.index");
        Route::get('{id}/{slug}', "HotelsController@show")->name("hotels.show");
        Route::get('{id}/{slug}/rooms', "HotelsController@rooms")->name("hotels.rooms");
        Route::get('{id}/{slug}/photos', "HotelsController@photos")->name("hotels.photos");
    });

    Route::group(['prefix' => "rooms"], function () {
        Route::any('/ajax/{id}/gallery', function ($id) {
            $room = \Sirb\Room::published()->find($id);

            if (!$room) {
                return response()->json(['success' => false, 'message' => 'Hotel ID is not valid']);
            }
            $hotel = $room->hotel;
            $gallery = $room->gallery();
            if (!$gallery->count()) {
                return response()->json(['success' => false, 'message' => 'Hotel dose not have Photo Gallery']);
            }

            return view("frontend.rooms.ajax_gallery", ['gallery' => $gallery->get(), "room" => $room, "hotel" => $hotel]);
        })->middleware("ajax");
    });

    Route::group(['prefix' => 'places'], function () {
        Route::any('/ajax/{id}/gallery', function ($id) {
            $place = \Sirb\Place::Published()->find($id);
            if (!$place) {
                return response()->json(['success' => false, 'message' => 'Place ID is not valid']);
            }
            $gallery = $place->gallery();

            if (!$gallery->count()) {
                return response()->json(['success' => false, 'message' => 'Place dose not have Photo Gallery']);
            }

            return view("frontend.places.ajax_gallery", ['gallery' => $gallery->get(), "place" => $place]);
        })->middleware("ajax");
        Route::get("/", "PlacesController@index")->name("places.index");
        Route::get('{id}/{slug}', "PlacesController@show")->name("places.show");
    });

    Route::group(['prefix' => "packages"], function () {
        Route::any('/ajax/{id}/gallery', function ($id) {
            $package = \Sirb\Package::Published()->find($id);
            if (!$package) {
                return response()->json(['success' => false, 'message' => 'Package ID is not valid']);
            }
            $gallery = $package->gallery();

            if (!$gallery->count()) {
                return response()->json(['success' => false, 'message' => 'Package dose not have Photo Gallery']);
            }

            return view("frontend.packages.ajax_gallery", ['gallery' => $gallery->get(), "package" => $package]);
        })->middleware("ajax");
        Route::get("/", "PackagesController@index")->name("packages.index");
        Route::get("/{id}/{slug}", "PackagesController@show")->name("packages.show");
        Route::get("type/{id}/{slug}", "PackagesController@type")->name("packages.type");
    });

    Route::group(['prefix' => "faq",'as'=>'faq.'], function () {

        Route::get("/", "FAQController@index")->name("index");
        Route::get("/search", "FAQController@search")->name("search");
        Route::get("/{slug}", "FAQController@show")->name("show");
    });

    Route::group(['prefix' => "news"], function () {
        Route::get("/", "NewsController@index");
        Route::get("/{id}/{slug}", "NewsController@show");
        Route::get("/search", "NewsController@search");
    });

    Route::group(['prefix' => "page"], function () {
        Route::get("/{slug}", "PagesController@show");
    });

    Route::group(['prefix' => "contact-us"], function () {
        Route::get("/", "ContactUsController@index");
        Route::post("/", "ContactUsController@sendMessage");
    });

       Route::group(['prefix' => "pay"], function () {
        Route::get("/{slug}", "PaymentsController@index")->name("checkout");

        Route::get("/status", "PaymentsController@getPaymentStatus")->name("payment.status");
        Route::get("/thank_you/{url}", "PaymentsController@thank_you")->name('Payment.thank');
         Route::post("/{slug}", "PaymentsController@store")->name('btcheckout');
        Route::post("/{slug}", "PaymentsController@checkout")->name('payment.store');
        // Route::get("notify", function () {
        //     $user = \Sirb\User::first();
        //     $order = new \Sirb\Booking();
        //     $order->save();
        //     $user->notify(new \Sirb\Notifications\BookingOrderSent($order));
        //     return "success";
        // });
    });

    Route::group(['prefix' => "booking"], function () {
        Route::get("/", "BookingController@index")->name("booking.free");
        Route::get("/thank_you", "BookingController@thank_you");
        Route::get("/package/{id}/{slug}", "BookingController@package")->name("booking.package");
        Route::get("/hotel/{id}/{slug}", "BookingController@hotel");
        Route::get("/room/{id}/{slug}", "BookingController@room")->name("booking.room");
        Route::post("/", "BookingController@store");
    });



    Route::group(['prefix' => "testimonials"], function () {
        Route::get("/", "TestimonialsController@index");
        Route::get("/videos", "TestimonialsController@videos");
        Route::get("/videos/destination/{id}/{slug}", "TestimonialsController@videosDestination");
        Route::get("/destination/{id}/{slug}", "TestimonialsController@destination");
        Route::get("/create", "TestimonialsController@create");
        Route::post("/create", "TestimonialsController@store");
        Route::get("/thank_you", "TestimonialsController@thank_you");

    });

    //comments
    Route::group(['prefix' => "{module}/{module_id}/comments"], function () {
        Route::post("/create", "CommentsController@store")->name('comments');
        Route::post("/reply/{parent_id}", "CommentsController@reply")->name('replies');
        Route::post("/{id}/edit", "CommentsController@update");
        Route::post("/{id}/delete", "CommentsController@delete");
    });

    //reviews
    Route::group(['prefix' => "{module}/{module_id}/reviews"], function () {
        Route::post("/create", "ReviewsController@store")->name('review');
        Route::post("/update", "ReviewsController@update")->name('update_review');
        Route::post("/{id}/edit", "ReviewsController@update");
        Route::post("/{id}/delete", "ReviewsController@delete");
    });

    //my_account

    Route::group(['prefix' => "profile"], function () {
        Route::get("/", "UsersController@profile")->name('profile');
        Route::put("/update", "UsersController@update_profile")->name('update_profile');

    });


    Route::post('upload', "UploaderController@upload");
    Route::delete('upload/{file}', "UploaderController@delete");

 // Start backend routes
    Route::group([
        'prefix'    => Settings::get('backend_uri') ?: config("settings.backend_uri"),
        'namespace' => "backend",
    ],
        function () {

         

        });

    Auth::routes();
});
