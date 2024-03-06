<?php

namespace Sirb\Http\Controllers\backend;

use Sirb\Comment;
use Sirb\Hotel;
use Sirb\Place;
use Sirb\Package;
use Sirb\Country;
use Sirb\City;
use Sirb\News;
use Sirb\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Sirb\Http\Requests;
use Sirb\Http\Controllers\backend\BackendBaseController;

class CommentsController extends BackendBaseController
{
    function index()
    {
        if (!Auth::user()->can("show comments")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $this->data['data'] = Comment::orderBy("created_at", "desc")->get();

        return view("backend.comments.index", $this->data);
    }

    function show($id = 0)
    {
        if (!Auth::user()->can("show comments")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $comment = Comment::find($id);
        if (!$comment) {
            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);
        }

        $module = $comment->module;
        $module_id = $comment->module_id;

    switch ($module) {
    case 'hotels':
    $hotel = Hotel::find($module_id);

        $url = "hotels/" . $hotel->id . "/" . str_slug($hotel->{"name:en"});
        
        break;

    case 'places':
        $place = Place::find($module_id);

        $url = "places/" . $place->id . "/" . str_slug($place->{"name:en"});
       
        break;
    case 'packages':
        $package = Package::find($module_id);
        
        $url = "packages/" . $package->id . "/" . str_slug($package->{"name:en"});
        break;
    case 'countries':
        $country = Country::find($module_id);
        
        $url = "country/" . $country->id . "/" . str_slug($country->{"name:en"});

        break; 
    case 'cities':
        $city = City::find($module_id);
        
       $url = "city/" . $city->id . "/" . str_slug($city->{"name:en"});
        break; 
          
    case 'news':
        $news = News::find($module_id);
        
        $url = "news/" .  $news->id . "/" . str_slug($news->{"name:en"});
        break;

     case 'articles':
        $topic = Article::find($module_id);

         $url = "guide/" . $topic->category_id . "/topic/" . $topic->id . "/" . str_slug($topic->{"name:en"});
        
        break; 
    default: $url = "#";
      }


        $this->data['page_title'] = trans("main.backend_comment_page_title");
        $this->data['page_header'] = trans("main.backend_comment_page_create_header");
        $this->data['comment_url'] = $url;
        $this->data['data'] = $comment;
       
        return view("backend.comments.show", $this->data);
    }


    function update(Request $request, $id = 0)
    {
      
        if (!Auth::user()->can("edit comments")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $comment = Comment::find($id);
        if (!$comment) {

            return redirect()->back()->with(['message' => trans("bookings.id_not_found"), 'alert-type' => 'error']);
        }

        $comment->status = (boolean)$request->input('status');
        $comment->save();
            return redirect()->back()->with(['message' => trans("main.comment_msg_changing_status"), 'alert-type' => 'success']);
       

    }



    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete comments")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $comment = Comment::find($id);
        if (!$comment) {

            return redirect()->back()->with(['message' => trans("main.id_not_found"), 'alert-type' => 'error']);
        }

        if($comment->children){

        foreach ($comment->children()->get() as $child) {
            $child->delete();
        }

    }

        $comment->delete();
            return redirect()->back()->with(['message' => trans("main.comment_msg_changing_status"), 'alert-type' => 'success']);
       

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete bookings")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $comment = Booking::find($id);
        $deleted++;
                
            }

            return redirect()->back()->with(['message' => trans("bookings.success_multi_delete", ['count' => $deleted]), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("bookings.error_multi_delete_empty"), 'alert-type' => 'warning']);

    }


}
