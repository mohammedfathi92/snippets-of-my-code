<?php
/**
 * @project     : blog
 * @file        : HomeController.php
 * @created_at  : 3/5/16 - 12:57 AM
 * @author      : Mohammed Fathi (mohammedfathi1113@gmail.com)
 **/


namespace App\Http\Controllers;


use App\Category;
use App\Product;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    function index()
    {


        $products = Product::where('show_in_home', 1)->orderBy('sort','asc')->get();
        $this->data['page_title'] = "";

        if ($products) {
            foreach ($products as $i => $product) {
                $products[$i]->ar = (object)['name', 'description', 'slide_description'];
                $products[$i]->en = (object)['name', 'description', 'slide_description'];
                foreach (['ar', 'en'] as $locale) {

                    $products[$i]->$locale->name = $product->translateOrNew($locale)->name;

                    $products[$i]->$locale->description = $product->translateOrNew($locale)->description;
                    $products[$i]->$locale->slide_description = $product->translateOrNew($locale)->slide_description;
                }

                // set the base object language


            }
        }
//        dd($products);

        $this->data['homeSlides'] = $products;


        //$this->data['categories']=Category::all();
        return view("frontend.home.index", $this->data);
    }

    function getAjaxHomeSlides()
    {
        $homeSlides = Product::where('show_in_home', 1)->orderBy('sort','asc')->get();

        return view('frontend.home.ajax_home_slider', ['homeSlides' => $homeSlides]);
    }

}