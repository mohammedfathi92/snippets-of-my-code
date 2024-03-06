<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Corsata\Http\Controllers;

use Corsata\Institute;
use Corsata\Category;
use Illuminate\Support\Facades\Input;
use Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class InstitutesController extends Controller
{

    function index(Request $request)
    {
        $institute = Institute::published();
        if ($sort = Input::get("sort", 'lrh')) {
            switch ($sort) {
                // sort by Higher locale rate
                case "lrh":
                    $institute->orderBy("locale_rate", "DESC");
                    break;
                // sort by Lower locale rate
                case "lrl":
                    $institute->orderBy("locale_rate", "ASC");
                    break;
                // sort by Higher International rate
                case "irh":
                    $institute->orderBy("international_rate", "DESC");
                    break;
                // sort by Lower International rate
                case "lrl":
                    $institute->orderBy("international_rate", "ASC");
                    break;
            }
        }

        // international rating filter
        if ($ir = Input::get("global_rating")) {
            if (is_array($ir)) {
                $institute->whereIn("international_rate", $ir);
            }
        }
        // international rating filter
        if ($lr = Input::get("local_rating")) {
            if (is_array($lr)) {
                $institute->whereIn("locale_rate", $lr);
            }
        }
        // Location filter
        if ($location = Input::get("location_type")) {

            if (is_array($location)) {
                $institute->whereIn("location_type", $location);
            }
        }
        $this->data['title'] = trans("institutes.page_title") . " - " . $this->data['title'];
        $this->data['institutes'] = $institute->paginate(10);

//        dd(\DB::getQueryLog());
        $this->data['view'] = Input::get('view') == "grid" ?: "list";

        return view("frontend.institutes.index", $this->data);
    }

     function ajaxSearch()
    {
        // check filters request
        $institutes = Institute::published()
            ->with(["services" => function ($q) {
                $q->groupBy("type");
            }])
            ->orderBy("updated_at", "DESC");

           

        if (Input::all()) {
            // quick search
            if ($q = Input::get("q")) {
                $institutes->whereTranslationLike("name", "%$q%");
            }

             // get country filter
             if (Input::get("country")) {

                $institutes->whereHas("country", function ($q) {
                    $q->whereCode(Input::get("country"));
                });

            }

             // get city filter
             if (Input::get("city")) {

                $institutes->whereHas("city", function ($q) {
                    $q->whereId(Input::get("city"));
                });

            }
           
            if ($sort = Input::get("sort", 'lrh')) {
            switch ($sort) {
                // sort by Higher locale rate
                case "lrh":
                    $institutes->orderBy("locale_rate", "DESC");
                    break;
                // sort by Lower locale rate
                case "lrl":
                    $institutes->orderBy("locale_rate", "ASC");
                    break;
                // sort by Higher International rate
                case "irh":
                    $institutes->orderBy("international_rate", "DESC");
                    break;
                // sort by Lower International rate
                case "lrl":
                    $institutes->orderBy("international_rate", "ASC");
                    break;
            }
        }

        // international rating filter
        if ($ir = Input::get("gRating")) {
            if (is_array($ir)) {
                $institutes->whereIn("international_rate", $ir);
            }
        }
        // international rating filter
        if ($lr = Input::get("lRating")) {
            if (is_array($lr)) {
                $institutes->whereIn("locale_rate", $lr);
            }
        }
        // Location filter
        if ($location = Input::get("nearPlace")) {

            if (is_array($location)) {
                $institutes->whereIn("location_type", $location);
            }
        }
        }



        $results = $institutes->paginate(20);
        if (Request::ajax()) {
            if ($results->count()) {

                foreach ($results as $k => $item) {
                     $getServices=[];

              $houses_count = $item->services()->where('type','house')->first();

              $transport_count = $item->services()->where('type','transport')->first();

              $insurance_count = $item->services()->where('type','insurance')->first();

              if($houses_count)
                $getServices[]= ['type'=>'house', 'name'=>trans('institutes.label_house_service')];
            if($transport_count)
                $getServices[]= ['type'=>'transport', 'name'=>trans('institutes.label_transport_service')];
            if($insurance_count)
                $getServices[]= ['type'=>'insurance', 'name'=>trans('institutes.label_insurance_service')];
           $item->getServices = collect($getServices);

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

            return response()->json(["success" => true, 'data' => $results]);
        }

    }


    function show($id = 0, $slug = null)
    {

        $institute = Institute::published()->find($id);

        if (!$institute) {
            return abort(404);
        }

        $this->data['institute'] = $institute;
        $this->data['courses'] = $institute->courses()->whereStatus(true)->paginate(7);
        $this->data['country'] = $institute->country;
        $this->data['city'] = $institute->city;
        $this->data['title'] = $institute->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $institute->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $institute->meta_keywords ?: $this->data['meta_keywords'];

        return view("frontend.institutes.show", $this->data);
    }

    function downloadFile($id = 0, $file_name = null)
    {

        $institute = Institute::published()->find($id);

        if (!$institute) {
            return response()->json(["success" => false]);
        }

        $file = $institute->brochures;
        //$path = Storage::url("files/".$file);
        $path = storage_path("app/public/files/".$file);
        $headers = ['Content-Type' => 'application/pdf'];
  
     
        return response()->download($path, $file, $headers);
    }


    
    function compareInstitutes()
    {

        
        if ( Input::get('selected') && is_array($ids = Input::get('selected'))) {
                $institutes = [];
        foreach ($ids as $id) {
            $institutes[] = Institute::published()->find($id);


            $this->data['institutes'] = $courses;

        }


        return view('frontend.institutes.compare', $this->data);
        }

        return redirect()->back()->with(['message' => trans("courses.not_selected"), 'alert-type' => 'error']);
    
    }
}