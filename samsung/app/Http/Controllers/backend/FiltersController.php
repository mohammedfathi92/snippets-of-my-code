<?php

namespace App\Http\Controllers\backend;

use App\Category;
use Illuminate\Http\Request;
use App\Filter;
use Request as R;
use App\Http\Controllers\Controller;
use App\updateOut;
use Auth;

class FiltersController extends Controller
{
    function index(Request $request, $cat = 0)
    {

        $category = Category::find($cat);

        $filters = $category->filters()->get();//Filter::where('category', $category->id)->get();
        $this->data['page_title'] = trans("filters.category_filters", ['category' => $category->cat_title]);
        $this->data['category'] = $category;
        $this->data['data'] = $filters;
        return view('backend.categories.filters', $this->data);
    }

//    get all category filters
    function ajaxGetFilters(Request $request, $cat = 0)
    {

        $category = Category::find($cat);
        $filters = $category->filters()->get();
        if ($filters) {
            foreach ($filters as $i => $filter) {
                $filters[$i]->name_ar = $filter->translateOrNew('ar')->name;
                $filters[$i]->name_en = $filter->translateOrNew('en')->name;
            }
        }
        return response()->json(['success' => true, 'data' => $filters]);
    }

//    get filter data
    function ajaxGetFilter(Request $request, $cat = 0, $id = 0)
    {
        $filter = Filter::find($id);
        $filter->name_ar = $filter->translateOrNew('ar')->name;
        $filter->name_en = $filter->translateOrNew('en')->name;
        return response()->json(['success' => true, 'data' => $filter]);
    }

    function ajaxUpdateFilter(Request $request, $cat = 0, $id = 0)
    {
        $filter = Filter::find($id);
        $filter->translateOrNew('ar')->name = $request->input('name_ar');
        $filter->translateOrNew('en')->name = $request->input('name_en');
        $filter->save();


        // insert in update_out table for sync data with offline app
        $event = [
            'table_name' => 'categories_filters',
            'action' => 'update',
            'action_id' => $filter->id,
        ];

        updateOut::create($event);

        return $this->ajaxGetFilters($request, $cat);

    }

    function ajaxDeleteFilter(Request $request, $cat = 0, $id = 0)
    {
        if (Auth::user()->level > 1) {
            return response()->json(['success'=>false,'message'=>trans("main.permission_denied")]);
        }
        $filter = Filter::find($id);
        $filter->delete();
        // insert in update_out table for sync data with offline app
        $event = [
            'table_name' => 'categories_filters',
            'action' => 'delete',
            'action_id' => $filter->id,
        ];

        updateOut::create($event);

        return $this->ajaxGetFilters($request, $cat);

    }

    function create(Request $request, $cat = 0)
    {
        $input = $request->input();
        if ($input) {
            // insert into database.
            $filter = new Filter();
            //$filter->name = $input['name'];
            $filter->category = $input['category'];
            $filter->parent = $input['parent'];
            if ($filter->save()) {
                // insert filter translation
                $filter->translateOrNew('ar')->name = $input['name_ar'];
                $filter->translateOrNew('en')->name = $input['name_en'];
                $filter->save();
                // insert in update_out table for sync data with offline app
                $event = [
                    'table_name' => 'categories_filters',
                    'action' => 'create',
                    'action_id' => $filter->id,
                ];

                updateOut::create($event);

                // get all filters
                $category = Category::find($cat);
                $filters = $category->filters()->get();//Filter::with('category')->get();
                return response()->json(['success' => true, 'data' => $filters]);
            } else {
                return response()->json(['success' => false, 'data' => "data not saved"]);
            }


        }


    }


}
