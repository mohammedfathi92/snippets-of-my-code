<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 9/24/17
 * Time: 2:13 AM
 */

namespace Corsata\Http\Controllers;

use Corsata\Category;
use Corsata\Course;
use Corsata\Institute;
use Illuminate\Support\Facades\Input;
use Session;

class CompareController extends Controller
{

    function index()
    {

    }

    function show()
    {
        $this->data['title'] = trans("courses.frontend_page_title") . " - " . $this->data['title'];
        $this->data['categories'] = Category::published()->get();
        return view("frontend.courses.index", $this->data);
    }


    function compareCourses()
    {


        if (Input::get('selected') && is_array($ids = Input::get('selected'))) {
            $courses = [];
            foreach ($ids as $id) {
                $courses[] = Course::published()->find($id);


                $this->data['courses'] = $courses;

            }


            return view('frontend.courses.compare', $this->data);
        }

        return redirect()->back()->with(['message' => trans("courses.not_selected"), 'alert-type' => 'error']);

    }

  
    function addToCompare($id)
    {

        $institute = Institute::find($id);
        if (!$institute) {
            return response()->json(["success" => false, "data" => "error: Institute not found"]);
        }
        $compare = [];
        if (Session::has('compare')) {
            $compare = Session::get('compare');
        }
        $compare = collect($compare);
        if (!$compare->contains("id", $id)) {
            $compare->push(['id' => $id, 'name' => $institute->name, 'photo' => url("files/" . $institute->photo)]);
        } else {
            return $this->removeFromCompare($id);
        }

        Session::put('compare', $compare);
        return response()->json(['success' => true, 'data' => $compare->pluck('id')->toArray()]);
//        return view("frontend.compare.ajax_item", $this->data);


    }

    function removeFromCompare($id = 0)
    {

        $institute = Institute::find($id);
        if (!$institute) {
            return response()->json(["success" => false, "data" => "error"]);
        }
        $compare = Session::get('compare');
        if ($compare) {

            $removed = $compare->reject(function ($key, $value) use ($id) {
                return $key["id"] == $id;
            });
            Session::put('compare', $removed);
        }
        $compare = Session::get('compare');
        return response()->json(["success" => true, "data" => $compare->pluck('id')->toArray()]);


    }

    function viewComparePage()
    {

        $institutesIds = [];

        if(Input::has('list')){
            
       $ids = json_decode(Input::get('list'));
            $compare = Institute::whereIn('id', $ids)->get();
            $this->data['data'] = $compare->all();
            $this->data['attrs'] = CompareAttr::orderBy('order', 'ASC')->get();
            
        return view("frontend.compare.list", $this->data);

        }else{
            return abort(404);

        }

    }




}