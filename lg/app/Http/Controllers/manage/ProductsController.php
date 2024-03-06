<?php

namespace App\Http\Controllers\manage;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use LaravelLocalization;
use Validator;

class ProductsController extends ManageController
{

    function index(Request $request)
    {
        if ($request->input('category')) {
            $category = Category::find($request->input('category'));
            if (!$category) abort(404);

            $this->data['category'] = $category;
        }

        $products = null;
        if ($request->input('q')) {
            $q = $request->input('q');
            $products = Product::whereTranslationLike("name", "%$q%")->latest()->with('category')->paginate(15);

        } else {
            $products = Product::latest()->with('category')->paginate(10);
        }

        $this->data['page_title'] = trans("products.page_title");
        $this->data['page_header'] = trans("products.page_header");

        $this->data['data'] = $products;
        return view("manage.products.index", $this->data);
    }

    function create(Request $request)
    {
        if ($request->input('category')) {
            $category = Category::find($request->input('category'));
            if (!$category) abort(404);

            $this->data['category'] = $category;
        }

        $this->data['page_title'] = trans("products.page_title");
        $this->data['page_header'] = trans("products.title_create");
        $this->data['categories'] = $this->categoriesList();
        return view("manage.products.create", $this->data);
    }

    private function categoriesList()
    {
        $categories = Category::latest()->get();
        return $categories;
    }

    function store(Request $request)
    {

        $rules = [
            'details'   => "max:500",
            "category"  => "required",
            "price"     => "numeric|min:0",
            "promotion" => "numeric|min:0",
            "type"      => "required",
        ];

        $messages = [
            'name.ar.max'       => trans("products.validation_name_max", ['max' => 255]),
            'name.en.max'       => trans("products.validation_name_max", ['max' => 255]),
            'details.ar.max'    => trans("products.validation_description_max", ['max' => 255]),
            'details.en.max'    => trans("products.validation_description_max", ['max' => 255]),
            'photo.required'    => trans("validation.required", ["attribute" => trans("products.photo")]),
            'category.required' => trans("validation.required", ["attribute" => trans("products.category")]),
            'price.required'    => trans("validation.required", ["attribute" => trans("products.price")]),
            'price.min'         => trans("validation.min", ["attribute" => trans("products.price")]),
            'type.required'     => trans("validation.required", ["attribute" => trans("products.label_type")]),
        ];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if (App::isLocale($locale)) {
                $rules["name.$locale"] = "required|max:255";
                $messages["name.$locale.required"] = trans("products.validation_name_in_locale_required", ['locale' => $locale]);
            } else {
                $rules["name.$locale"] = "max:255";
            }

        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('manage/products/create')
                ->withErrors($validator)
                ->withInput();
        }

        $product = new Product();
        $product->photo = $request->input('photo');
        $product->category_id = $request->input('category');
        $product->created_by = Auth::user()->id;
        $product->updated_by = Auth::user()->id;
        $product->price = $request->input("price");
        $product->product_type = $request->input("type") == "b2b" ? "b2b" : "b2c";
        if ($request->input("promotion"))
            $product->promotion = (float)$request->input("promotion");

        $product->save();

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $product->translateOrNew($locale)->name = $request->input("name.{$locale}") ?: null;
            $product->translateOrNew($locale)->details = $request->input("details.{$locale}") ?: null;
        }
        $product->save();
        flash(trans("products.created_successfully"));
        return redirect("/manage/products");

    }

    function edit(Request $request, $id)
    {

        $product = Product::find($id);
        if (!$product) {
            return redirect("/manage/products")->withErrors([trans('products.error_id_not_found')]);
        }

        $this->data['data'] = $product;
        $this->data['category'] = $product->category()->first();
        $this->data['page_title'] = trans("products.page_title");
        $this->data['page_header'] = trans("products.title_update");
        $this->data['categories'] = $this->categoriesList();
        return view("manage.products.edit", $this->data);
    }

    function update(Request $request, $id)
    {
        $rules = [
            'details'   => "max:500",
            "category"  => "required",
            "price"     => "numeric|min:0",
            "promotion" => "numeric|min:0",
            "type"      => "required",
        ];


        $messages = [

            'name.ar.max'       => trans("products.validation_name_max", ['max' => 255]),
            'name.en.max'       => trans("products.validation_name_max", ['max' => 255]),
            'details.ar.max'    => trans("products.validation_description_max", ['max' => 255]),
            'details.en.max'    => trans("products.validation_description_max", ['max' => 255]),
            'category.required' => trans("validation.required", ["attribute" => trans("products.category")]),
            'price.required'    => trans("validation.required", ["attribute" => trans("products.price")]),
            'price.min'         => trans("validation.min", ["attribute" => trans("products.price")]),
            'type.required'     => trans("validation.required", ["attribute" => trans("products.label_type")]),
        ];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            if (App::isLocale($locale)) {
                $rules["name.$locale"] = "required|max:255";
                $messages["name.$locale.required"] = trans("products.validation_name_in_locale_required", ['locale' => $locale]);
            } else {
                $rules["name.$locale"] = "max:255";
            }

        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect("manage/products/{$id}/edit")
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::find($id);
        $product->photo = $request->input('photo') ? $request->input('photo') : $request->input('old_photo');
        $product->category_id = $request->input('category');
        $product->updated_by = Auth::user()->id;
        $product->price = $request->input("price");
        $product->product_type = $request->input("type") == "b2b" ? "b2b" : "b2c";
        if ($request->input("promotion"))
            $product->promotion = $request->input("promotion");

        $product->save();

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $product->translateOrNew($locale)->name = $request->input("name.{$locale}") ?: null;
            $product->translateOrNew($locale)->details = $request->input("details.{$locale}") ?: null;
        }
        $product->save();
        flash(trans("products.updated_successfully", ['name' => $product->{"name:{$this->data['locale']}"}]), 'success');
        return redirect("/manage/products");
    }

    function delete(Request $request, $id)
    {
        $category = Product::find($id);
        if (!$category) {
            return redirect("/manage/products")->withErrors([trans('products.error_id_not_found')]);
        }
        $category->delete();
        flash(trans("products.deleted_successfully"), 'success');

        return redirect("/manage/products");

    }

    function postUpload(Request $request)
    {

        $photo = null;
        $filename = null;
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $photo = $request->file('file');

            $filename = Str::lower(
                "product-" . str_replace(' ', '-', pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME))
                . '-'
                . uniqid()
                . '.'
                . $photo->getClientOriginalExtension()
            );
            $photo->move(config('settings.upload_path'), $filename);
            $small = Image::make(config('settings.upload_path') . "/" . $filename);
            $small->resize(320, 240);
            $small_destination = config('settings.upload_path') . '/small/';
            $small->save($small_destination . "/" . $filename);
            return response()->json(['success' => true, 'file' => $filename, 'small' => $small_destination . "/" . $filename]);
        }

        return response()->json(['success' => false, "message" => "No files selected to upload!"]);
    }
}
