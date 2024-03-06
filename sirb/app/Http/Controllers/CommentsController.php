<?php

namespace Sirb\Http\Controllers;


use Sirb\Comment;
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

class CommentsController extends Controller
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
    
    if (!$user) { 
    return redirect()->back()->with(['message' => trans("main.error_happen"), 'alert-type' => 'error']);
}  

      
      $rules["content"] = "required";
      $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $comment = new Comment();
        $comment->parent_id = null;
        $comment->module = $module;
        $comment->module_id = $module_id;
        $comment->local = $request->input('local');
        $comment->creator_type = "member";
        $comment->creator_name = $user->name;
        $comment->creator_email = $user->email;
        $comment->member_id = Auth::id();
        $comment->title = $request->input('title')?:null;
        $comment->content = $request->input('content');
        $comment->save();


        // return redirect(url()->previous().'#comment_row_'.$comment->id)->with(['message' => trans("main.success_comment_created"), 'alert-type' => 'success']);

        return redirect()->back()->with(['message' => trans("main.success_comment_created"), 'alert-type' => 'success']);

    }

    function reply(Request $request, $module = null, $module_id = 0, $parent_id = null)
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
    
    if (!$user) { 
    return redirect()->back()->with(['message' => trans("main.error_happen"), 'alert-type' => 'error']);
} 
   $parent = Comment::find($parent_id);
   if (!$parent) { 
    return redirect()->back()->with(['message' => trans("main.error_happen"), 'alert-type' => 'error']);
} 

      
      $rules["content"] = "required";
      $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $comment = new Comment();
        $comment->parent_id = $parent_id?:null;
        $comment->module = $module;
        $comment->module_id = $module_id;
        $comment->local = $request->input('local');
        $comment->creator_type = "member";
        $comment->creator_name = $user->name;
        $comment->creator_email = $user->email;
        $comment->status = 0;
        $comment->member_id = Auth::id();
        $comment->title = $request->input('title')?:null;
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->back()->with(['message' => trans("main.success_comment_created"), 'alert-type' => 'success']);

    }


}
