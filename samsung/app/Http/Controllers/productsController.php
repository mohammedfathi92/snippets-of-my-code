<?php
/**
 * Created by PhpStorm.
 * User: Mohammed
 * Date: 5/5/16
 * Time: 3:28 AM
 */

namespace app\Http\Controllers;

use App\Category;
use App\Filter;
use App\Product;
use Illuminate\Http\Request;


class productsController extends Controller
{
    function index()
    {

    }

    function listAllProducts(Request $request)
    {

        if ($request->ajax()) {
            $products = Product::with('colors')->orderBy('sort','asc')->get();
            return response()->json(['success' => true, 'data' => $products]);
        } else {
            die("bad Request");
        }
    }

    function getSearch(Request $request, $word = null)
    {

        if ($request->ajax()) {
//            $products = Product::where("name", 'like', '%' . $word . '%')->get();
            $products = Product::whereTranslationLike("name", '%' . $word . '%')->get();
            return response()->json(['success' => true, 'data' => $products]);
        } else {
            die("bad Request");
        }
    }

    private function productWithProperties( $id = 0)
    {

        $product = Product::with('gallery')->with('colors')->find($id);

        // get category properties
        $category = $product->category()->first();//->first()->properties()->with('translations')->get();
        $catProp = $category->properties()->with('translations')->get();

        // get product properties values
        $properties = $product->properties()->get();

        // merge properties with it's values
        $pv = [];
        if ($catProp) {
            foreach ($catProp as $k => $v) {
                $catProp[$k]->name_ar=$v->translateOrNew('ar')->name;
                $catProp[$k]->name_en=$v->translateOrNew('en')->name;
                if (count($properties) and isset($properties[$k])) {
                    $catProp[$k]->value = @json_decode($properties[$k]->pivot->value);//json_decode();
                } else {
                    $catProp[$k]->value = (object)['ar'=>null,'en'=>null];
                }
            }
        }
        $product->name_ar=$product->translateOrNew('ar')->name;
        $product->name_en=$product->translateOrNew('en')->name;
        $product->properties=$catProp;


        return $product;
    }

    function getAjaxHomeSlides(Request $request)
    {
        if ($request->ajax()) {
            $slides = Product::where('show_in_home', 1)->orderBy('sort','asc')->take(10)->get();
            if ($slides) {
                return response()->json(['success' => true, 'data' => $slides]);
            }
            return response()->json(['success' => false, 'message' => null, 'data' => null]);
        }
        return "Nothing here to show";
    }

    function getAjaxFiltersProducts(Request $request, $cat = null)
    {

        $products = [];
        $pids = [];
        $category = Category::where('cat_slug', $cat)->first();
        if ($request->input('filters')) {

            $filters = Filter::whereIn('id', $request->input('filters'))->with('products')->get();


            if ($filters) {
                foreach ($filters as $filter) {

                    if ($filter->products) {

                        foreach ($filter->products as $product) {

                            if (!in_array($product->id, $pids) and $product->category == $category->id) {
                                $products[] = $product;
                                $pids[] = $product->id;
                            }
                        }
                    }
                }
            }

            //return response()->json(['success' => true, 'data' => $products]);
        }else{
            $products=$category->products()->orderBy('sort','asc')->get();
        }
        return view('frontend.products.ajax_products_list',['products'=>$products]);



    }

    function showProduct(Request $request, $id = 0)
    {
        $product = $this->productWithProperties($id);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'data' => $product]);
        } else {
            die("bad Request");
        }
    }

    // set and get compare productes
    function compare(Request $request)
    {

            $response = ['success' => false, 'data' => null];

//            $request->session()->forget('compareProducts');
            if (!$request->session()->has('compareProducts')) {
                /*session hasn't created yet for compare products*/
                $request->session()->put('compareProducts', []);
            }

            // coming request to remove product form comparing list
            if ($request->has('remove') && intval($request->input('remove'))) {
                $r = $request->input('remove');
                $pp = $request->session()->get('compareProducts');
                if (($key = array_search($r, $pp)) !== false) {

                    unset($pp[$key]);
                    $request->session()->put('compareProducts', $pp);
                }
            }

            /*if get product id then set this id in session for comparing*/
            $id = $request->input('product');
            if ($request->has('product') && intval($id)) {

                if (!in_array($id, $request->session()->get('compareProducts'))) {
                    /*  if the requested product not in same category of first one
                     *  then clear compare session and create a new one
                     **/
                    $items = $request->session()->get('compareProducts');
                    if (count($items)) {

                        // get data of first item
                        $first = Product::find($items[0]);

                        $current = Product::find($id);

                        if ($first->category !== $current->category) {
                            //$request->session()->forget('compareProducts');
                            $request->session()->put('compareProducts', []);
                        }
                    }

                    /*session is exists and the requested product is not added before then add it in session*/
                    $request->session()->push("compareProducts", $id);
                }
            }

            $products = [];


            // get products ids from session
            $ids = $request->session()->get('compareProducts');

            if ($ids) {
                foreach ($ids as $p) {
                    if ($p) {
                        $products[] = $this->productWithProperties($p);
                    }

                }
                $response = ['success' => true, 'data' => $products];

            }

            return response()->json($response);



    }

    function getAjaxResetCompare(Request $request)
    {

        $request->session()->put('compareProducts', []);
        return response()->json(['success' => true, 'data' => null]);
    }

}
