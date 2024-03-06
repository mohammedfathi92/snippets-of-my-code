<?php

namespace Sirb\Http\Controllers;


use Sirb\Review;
use Sirb\Media;
use Sirb\Hotel;
use Sirb\Place;
use Sirb\Package;
use Sirb\Country;
use Sirb\City;
use Sirb\News;
use Sirb\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;
use Sirb\Http\Requests;
use Sirb\Http\Controllers\Controller;

class ReviewsController extends Controller
{
    function index()
    {

    
    }

    function store(Request $request, $module = null, $module_id = 0)
   {

       
        switch ($module) {
    case 'hotels':

        $hotel = Hotel::find($module_id);
        
        if (!$hotel) { return abort(404);}
        break;

    case 'places':
        $place = Place::find($module_id);
       
        if (!$place) {return abort(404);}
        break;
    case 'packages':
        $package = Package::find($module_id);
        
        if (!$package) { return abort(404);} 
        break;
    case 'countries':
        $country = Country::find($module_id);
        
        if (!$country) { return abort(404);} 
        break; 
    case 'cities':
        $city = City::find($module_id);
        
        if (!$city) { return abort(404);} 
        break; 
          
    case 'news':
        $news = News::find($module_id);
        
        if (!$news) { return abort(404);} 
        break;

     case 'articles':
        $article = Article::find($module_id);
        
        if (!$article) { return abort(404);} 
        break; 
    default: return abort(404);
      }


    $user = Auth::user();

    //method (1)
    // $classes[
    //     'news':News::class, ];
    //if(!$item) return abort(404);

    //=============
    //method (2)
    // $instance=ucfirst(str_singular($type));
    // $item=$instance::find($type_id);
    
    if (!$user) { 
    return redirect()->back()->with(['message' => trans("main.error_happen"), 'alert-type' => 'error']);
}


      
      $rules["review_amount"] = "required";
      $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

$reviews = Review::where('member_id', Auth::id())->where('module_type', $module)->where('module_id', $module_id)->get();

if($reviews->count()){
foreach ($reviews as $review) {
    $review->delete();
}
}
        
        $review = new Review();
        
        $review->module_type = $module;
        $review->module_id = $module_id;
        $review->creator_type = "member";
        $review->member_id = Auth::id();
        $review->amount = $request->input('review_amount');
        $review->save();


        // return redirect(url()->previous().'#comment_row_'.$review->id)->with(['message' => trans("main.success_comment_created"), 'alert-type' => 'success']);

        return redirect()->back()->with(['message' => trans("main.success_review_created"), 'alert-type' => 'success']);
}




}
