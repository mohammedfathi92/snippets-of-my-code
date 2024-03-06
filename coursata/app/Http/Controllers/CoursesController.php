<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 12/29/16
 * Time: 2:13 AM
 */

namespace Corsata\Http\Controllers;

use Corsata\Category;
use Corsata\Course;
use Illuminate\Support\Facades\Input;
use Validator;
use Request;

class CoursesController extends Controller
{
    function index()
    {
        $this->data['title'] = trans("courses.frontend_page_title") . " - " . $this->data['title'];
        $this->data['categories'] = Category::published()->get();
        return view("frontend.courses.index", $this->data);
      
     
    }

    function ajaxSearch()
    {
        // check filters request
        $courses = Course::published()
            ->with("institute")
            ->with(["services" => function ($q) {
                $q->groupBy("type");
            }])
            ->orderBy("updated_at", "DESC");

        if (Input::all()) {
            // quick search
            if ($q = Input::get("q")) {
                $courses->whereTranslationLike("name", "%$q%");
            }

             // get country filter
            if (Input::get("country") && Input::get("category")) {
                $courses->whereHas("institute", function ($q) {
                    $q->whereHas("country", function ($c) {
                        $c->whereCode(Input::get("country"));
                    });
                })->whereHas("category", function($cat){
                            $cat->whereId(Input::get("category"));
                        });
            }

            // get category
            // if (Input::get("category")) {

            //     $courses->whereHas("category", function ($q) {
            //         $q->whereId(Input::get("category"));
            //     });

            // }
            if (Input::get("sort")) {
                $sort = Input::get("sort");
                switch ($sort) {
                    case "lRating":
                        $courses->orderBy("courses.locale_rate", "DESC");
                        break;
                    case "iRating":
                        $courses->orderBy("courses.international_rate", "DESC");
                        break;
                    case "lower":
                        $courses->orderBy("courses.price", "ASC");
                        break;
                    case "higher":
                        $courses->orderBy("courses.price", "DESC");
                        break;
                    case "oldest":
                        $courses->orderBy("courses.updated_at", "asc");
                        break;
                    case "newest":
                        $courses->latest();
                        break;
                }
            }

              // international rating filter
        if ($ir = Input::get("filter.rating.international")) {
            if (is_array($ir)) {
                $courses->whereIn("international_rate", $ir);
            }
        }
        // international rating filter
        if ($lr = Input::get("filter.rating.locale")) {
            if (is_array($lr)) {
                $courses->whereIn("locale_rate", $lr);
            }
        }
        // Location filter
        if ($location = Input::get("filter.location")) {

            if (is_array($location)) {
                $courses->whereIn("location_type", $location);
         
         
        }
        }
    }

        $results = $courses->paginate(20);
        if (Request::ajax()) {
            if ($results->count()) {
                foreach ($results as $k => $item) {
                    $item->slug = str_slug($item->{"name:en"});
                    $item->url = url("/courses/{$item->id}-{$item->slug}?" . http_build_query(Request::input()));
                    $item->price = calcPrice($item, $item->price);
                    $item->offer_price = calcPrice($item, $item->offer_price);
                    $item->short_description = str_limit(strip_tags($item->description), 200);
                    $item->photo_path = url("files/{$item->photo}?size=293,220&encode=jpg");
                     $item->institute->name = $item->institute->name;
                     $item->institute->logo = $item->institute->logo?url("files/{$item->institute->logo}?size=27,27&encode=jpg") :false; 
                 
                    $item->institute->url = url("institutes/{$item->institute->id}-" . str_slug($item->institute->{"name:en"}));
                }
            }

            return response()->json(["success" => true, 'data' => $results]);
        }

    }

    function ajaxDetails(Input $request)
    {
        $id = $request->get('course_id');
        $course = Course::published()->with(["institute" => function ($q) {
            $q->with(["services" => function ($s) {
                $s->groupBy("type");
            }])->with("housingServices"); 
            // ->with("transportingServices")
        }])->with("gallery")->find($id);
        if (!$course) {
            return abort(404);
        }
        $weeks = (int)$request->get("weeks") ?: 1;
        $course->slug = str_slug($course->{"name:en"});
        $course->url = url("/courses/{$course->id}-{$course->slug}?" . http_build_query(Request::input()));
        $course->price *= $weeks;// calcPrice($course, $course->price);
        $course->offer_price *= $weeks;// calcPrice($course, $course->offer_price);
        $course->short_description = str_limit(strip_tags($course->description), 500);
        $course->photo_path = url("files/{$course->photo}?size=293,220&encode=jpg");
        $course->institute->url = url("institutes/{$course->institute->id}-" . str_slug($course->institute->{"name:en"}));

        $first_housing = true;
        // $first_transporting = true;

        if ($course->institute->housingServices->count()) {
            foreach ($course->institute->housingServices as $service) {
                $service->selected = false;
                if ($service->type == "house") {
                    if ($sPrice = $request->get("hWeeks")) {
                        $service->price = $service->price * $sPrice;
                        $service->shortDescription = strip_tags(str_limit($service->description, 100));
                    }

                    if ($first_housing) {
                        $service->selected = true;
                        $first_housing = false;
                    }
                }
                // if ($service->type == "transport" && $first_transporting) {
                //     $service->selected = true;
                //     $first_transporting = false;
                // }
            }
        }
        // if ($course->institute->transportingServices->count()) {
        //     foreach ($course->institute->transportingServices as $service) {
        //         $service->selected = false;

        //         if ($service->type == "transport" && $first_transporting) {
        //             $service->selected = true;
        //             $first_transporting = false;
        //         }
        //     }
        // }

        return response()->json(["success" => true, "data" => $course]);

    }

    function show($id = 0, $slug = null)
    {
        $course = Course::published()->find($id);
        if (!$course) {
            return abort(404);
        }

        $institute = $course->institute;
        $relatedCourses = $institute
            ->courses($course->id)
            ->orderBy("updated_at", "DESC")
            ->take("5")
            ->get();

        $this->data['institute'] = $course->institute;
        $this->data['course'] = $course;
        $this->data['title'] = $course->name . " - " . $this->data['title'];
        $this->data['meta_description'] = $course->meta_description ?: $this->data['meta_description'];
        $this->data['meta_keywords'] = $course->meta_keywords ?: $this->data['meta_keywords'];
        $this->data['releated'] = $relatedCourses;
        return view("frontend.courses.show", $this->data);
    }



    function compareCourses()
    {

        
        if ( Input::get('selected') && is_array($ids = Input::get('selected'))) {
                $courses = [];
        foreach ($ids as $id) {
            $courses[] = Course::published()->find($id);


            $this->data['courses'] = $courses;

        }


        return view('frontend.courses.compare', $this->data);
        }

        return redirect()->back()->with(['message' => trans("courses.not_selected"), 'alert-type' => 'error']);
    
    }


}