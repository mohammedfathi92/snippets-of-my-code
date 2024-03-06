<?php

namespace App\Http\Controllers\backend;

use App\Category;
use App\categoryPropertiesTranslation;
use App\updateOut;
use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\categoryProperties;
use Auth;

class PropertiesController extends Controller
{

    function index(Request $request, $cat = 0)
    {
        $category = Category::find($cat);
        $properties = [];
        if ($category)
            $properties = $category->properties()->get();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'data' => $properties]);
        } else {
            $this->data['page_title'] = trans('categories.properties');
            $this->data['category'] = $category;
            $this->data['data'] = $properties;
            return view('backend.categories.properties', $this->data);
        }
    }

    function ajaxGetProperties(Request $request, $cat = 0)
    {
        $category = Category::find($cat);
        $properties = [];
        if ($category)
            $properties = $category->properties()->with('translations')->get();

        return response()->json(['success' => true, 'data' => $properties]);
    }

    function ajaxCreate(Request $request, $cat = 0)
    {
        $property = new categoryProperties();
//        dd($request->input());
        $property->icon = $request->input('icon');
        $property->icon_size = $request->input('icon_size');
        $property->sort = $request->input('sort');
        $property->category_id = $cat;

        if ($property->save()) {

            $locales = ['ar', 'en'];

            foreach ($locales as $locale) {
                $property->translateOrNew($locale)->name = $request->input("name_{$locale}");
            }

            $property->save();
            $event = [
                'table_name' => 'categories_properties',
                'action' => 'create',
                'action_id' => $property->id,
            ];
            updateOut::create($event);
        }

        return $this->ajaxGetProperties($request, $cat);

    }

    function ajaxGetProperty(Request $request, $cat = 0, $id = 0)
    {
        $property = categoryProperties::with('translations')->find($id);

        return response()->json(['success' => true, 'data' => $property]);
    }

    function ajaxUpdateProperty(Request $request, $cat = 0, $id = 0)
    {
        if ($request->input()) {
            $property = categoryProperties::find($id);
            $property->icon = $request->input('icon');
            $property->icon_size = $request->input('icon_size');
            $property->sort = $request->input('sort');
            $property->category_id = $cat;

            if ($property->save()) {

                $locales = ['ar', 'en'];

                foreach ($locales as $locale) {
                    $property->translateOrNew($locale)->name = $request->input("name_{$locale}");
                }

                $property->save();

                $event = [
                    'table_name' => 'categories_properties',
                    'action' => 'update',
                    'action_id' => $property->id,
                ];
                updateOut::create($event);
            }


        }
        return $this->ajaxGetProperties($request, $cat);
    }

    function removeProperty(Request $request, $cat = 0, $id = 0)
    {

        if (Auth::user()->level > 1) {
            return response()->json(['success'=>false,'message'=>trans("main.permission_denied")]);
        }

        $property = categoryProperties::find($id);
        if ($property) {


            $event = [
                'table_name'    => 'categories_properties',
                'action'        => 'delete',
                'action_id'     => $property->id,
            ];
            updateOut::create($event);
            $property->delete();
        }
        return $this->ajaxGetProperties($request, $cat);
    }

    function ajaxGetProductProperties(Request $request, $cat = 0)
    {
        $response = ['success' => false, 'message' => null];

        $category = Category::find($cat);
        $properties = [];
        if ($request->has('product')) {
            $proId = $request->input('product');
            $properties = $this->productWithProperties($cat, $proId);
        }

        if (!$properties) {
            $properties = $category->properties()->with('translations')->get();
        }
        $response = ['success' => true, 'data' => $properties];
        return response()->json($response);


    }

    private function productWithProperties($cat = 0, $id = 0)
    {

        $product = Product::find($id);

        // get category properties
        $category = Category::find($cat);//->first()->properties()->with('translations')->get();
        $catProp = $category->properties()->with('translations')->get();

        // get product properties values
        $properties = $product->properties()->get();

        // merge properties with it's values
        $pv = [];
        if ($catProp) {
            foreach ($catProp as $k => $v) {
                if (count($properties) and isset($properties[$k])) {
                    $catProp[$k]->value = $properties[$k]->pivot->value;//json_decode();
                } else {
                    $catProp[$k]->value = null;
                }
            }
        }

        return $catProp;
    }

}
