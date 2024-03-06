<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
    function products(Request $request, $id = 0)
    {
        $category = Category::find($id);
        if (!$category) {
            return redirect("/")->withErrors(trans("categories.error_id_not_found"));
        }

        $products = $category->products()->where("product_type", Auth::user()->account_type)->paginate(20);

        $this->data['page_title'] = trans("categories.page_title");
        $this->data['page_header'] = trans("categories.page_header");
        $this->data['data'] = $products;
        $this->data['category'] = $category;

        return view("categories.products", $this->data);
    }

    function ajaxProducts(Request $request, $id = 0)
    {
        $category = Category::find($id);
        if (!$category) return abort(404);


        $products = $category->products();
        if (Auth::user()->permission > 1)
            $products->where("product_type", Auth::user()->account_type);


        return response()->json(['success' => true, 'data' => $products->get()]);


    }

}
