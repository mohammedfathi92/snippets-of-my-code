<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    function details(Request $request, $id = 0)
    {
        $product = Product::where("type", Auth::user()->account_type)->find($id);

        if (!$product) abort(404);

        $this->data['data'] = $product;

        return view("products.details", $this->data);

    }
}
