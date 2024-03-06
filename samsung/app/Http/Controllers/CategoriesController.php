<?php

namespace App\Http\Controllers;

use App\Category;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;


class CategoriesController extends Controller
{
    //list all categories
    function getIndex()
    {
//        return view("categories.index",$this->data);
    }

    function listAll(Request $request)
    {
        $categories = Category::all();
        if ($request->ajax()) {
            return response()->json(['success' => true, 'data' => $categories]);
        } else {
            die("bad Request");
        }
    }

    function getAjaxCategoryFilters(Request $request, $slug = null)
    {
        $category = Category::where('cat_slug', $slug)->first();
        $filters = null;
        if ($category) {
            $filters = $category->filters()->where('parent', 0)->with('subFilters')->get();
        }

        return response()->json(['success' => true, 'data' => $filters]);
    }

    function products(Request $request, $slug = null)
    {

        if ($request->ajax()) {
            $category = Category::where("cat_slug", $slug)->first();
//        $products=Product::where('category','=',$category->cat_id)->with('filters')->get();
            $products = $category->products()->with('translations')->with('filters')->get();

            if(!count($products)){
                return null;
            }else{
                return  view('frontend.products.ajax_products_list', ['products' => $products]);
            }


//            return response()->json(['success' => true, 'data' => $data]);
        } else {
            die("bad Request");
        }
    }

    function showProduct(Request $request, $id = 0)
    {

        $products = Product::find($id);
        if (!$request->ajax()) {
            return response()->json(['success' => true, 'data' => $products]);
        } else {
            die("bad Request");
        }
    }


}
