<?php

namespace App\Http\Controllers\backend;

use App\Post;
use App\Product;
use App\updateOut;
use DB;
use Intervention\Image\Facades\Image;
use Validator;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request as Inputs;
use Request;
use App\Category;
use Carbon\Carbon;
use Javascript;
use Illuminate\Support\Str;
use Auth;


use App\Http\Requests;

class CategoriesController extends BaseAdminController
{
    function getIndex()
    {
        $this->data['page_title'] = "Categories";
//        $categories=Category::all()->where("cat_deleted",0)->sortByDesc("created_at");
        $categories = Category::latest()->with('properties')->with('products')->get();
        $this->data['data'] = $categories;
        return view("backend.categories.index", $this->data);

    }

    function getCreate()
    {
        $this->data['page_title'] = "Add Category";
        return view("backend.categories.create", $this->data);
    }

    function postCreate()
    {
        return $this->store();
    }

    function getEdit($id = 0)
    {

        if (intval($id)) {
            $category = Category::find($id);

            $this->data['page_title'] = trans("categories.categories_page_title");
            $this->data['data'] = $category;
            return view("backend.categories.edit", $this->data);

        }
    }

    function postEdit($id = 0)
    {
        return $this->update($id);
    }

    function getDelete($id = 0)
    {
        return $this->delete($id);
    }

    function getProducts($id = 0)
    {
        if (intval($id)) {
            $category = Category::find($id);

            if (!$category) {
                return abort(404);
            }

            $products = $category->products;

            $this->data['page_title'] = trans("categories.categories_page_title");
            $this->data['data'] = $products;
            $this->data['category'] = $category;
            return view("backend.categories.products", $this->data);
        }
    }

    function store(Inputs $request)
    {

        $rules = [
            'title' => 'required|max:225',
//            'slug' => 'required|max:225',
            'photo' => 'mimes:jpeg,png,gif|max:2000'
        ];
        $messages = [
            'title.required' => trans("categories.category_title_required"),
//            'title.unique' => trans("categories.category_title_unique"),
//            'slug.required' => trans("categories.category_slug_required"),
            'photo.mimes' => trans("categories.not_allowed_mimes", ["allowed" => 'jpeg,png,gif']),
            'photo.max' => trans('categories.error_max_file_size', ['size' => '2000 kb'])
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect('admin/categories/create')->withErrors($validator)->withInput();
        }
        $photo = null;
        $filename = null;
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $photo = $request->file('photo');
            $filename = Str::lower(
                "category-" . str_replace(' ','-',pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME))
                . '-'
                . uniqid()
                . '.'
                . $photo->getClientOriginalExtension()
            );
            $photo->move(config('settings.upload_path'), $filename);

            $small=Image::make(config('settings.upload_path')."/".$filename);
            $small->resize(320,240);
            $small->save(config('settings.upload_path').'/small/'.config('settings.upload_path')."/".$filename);

        }

        $slug = str_slug($request->input('title')['ar']);
        $check_slug = Category::where('cat_slug', '=', $slug)->first();
        if ($check_slug) {
            return redirect("admin/categories/create")->withErrors(['title' => trans("categories.category_title_exists", ['title' => $request->input('title')['ar']])])->withInput();
        }

        $category               = new Category();
        $category->cat_slug     = $slug;
        $category->cat_photo    = $photo ? config('settings.upload_path') . "/" . $filename : ($request->input("old_photo") ? $request->input("old_photo") : null);
        $category->created_at   = Carbon::now();
        if ($category->save()) {

            // insert in update_out table
            $event = [
                'table_name' => 'categories',
                'action' => 'create',
                'action_id' => $category->id,
            ];

            updateOut::create($event);

            // translations
            foreach (['ar', 'en'] as $locale) {
                $category->translateOrNew($locale)->cat_title = $request->input('title')[$locale];
                $category->translateOrNew($locale)->cat_description = $request->input('description')[$locale];
            }

            $category->save();

            Flash::success(trans('categories.success_category_created'));
            return redirect("admin/categories");
        }

        return redirect("admin/categories/");


    }

    function update(Inputs $request, $id = 0)
    {
        $rules = [
            'title' => 'required|max:225',
//            'slug' => 'required|max:225',
            'photo' => 'mimes:jpeg,png,gif|max:2000'
        ];
        $messages = [
            'title.required' => trans("categories.category_title_required"),
//            'slug.required' => trans("categories.category_slug_required"),
            'photo.mimes' => trans("main.not_allowed_mimes", ["allowed" => 'jpeg,png,gif']),
            'photo.max' => trans('main.error_max_file_size', ['size' => '2000 kb'])
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect("admin/categories/edit/$id")->withErrors($validator)->withInput();
        }
        $photo = null;
        $filename = null;
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {

            $photo = $request->file('photo');
            $filename = Str::lower(
                "category-" . str_replace(' ','-',pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME))
                . '-'
                . uniqid()
                . '.'
                . $photo->getClientOriginalExtension()
            );
            $photo->move(config('settings.upload_path'), $filename);
            $small=Image::make(config('settings.upload_path')."/".$filename);
            $small->resize(320,240);
            $small->save(config('settings.upload_path').'/small/'.config('settings.upload_path')."/".$filename);

        }

        $slug = str_slug($request->input('title')['ar']);
        $check_slug = Category::where('cat_slug', '=', $slug)->where('id', '!=', $id)->first();
        if ($check_slug) {
            return redirect("admin/categories/edit/$id")->withErrors(['title' => trans("categories.category_title_exists", ['title' => $request->input('title')['ar']])])->withInput();

        }
        $category = Category::find($id);
        $category->cat_slug = $slug;
        $category->cat_photo = $photo ? config('settings.upload_path') . "/" . $filename : ($request->input("old_photo") ? $request->input("old_photo") : null);
        if ($category->save()) {

            // translations
            foreach (['ar', 'en'] as $locale) {
                $category->translateOrNew($locale)->cat_title = $request->input('title')[$locale];
                $category->translateOrNew($locale)->cat_description = $request->input('description')[$locale];
            }
            $category->save();

            // insert in update_out table
            $event = [
                'table_name' => 'categories',
                'action' => 'update',
                'action_id' => $category->id,
            ];

            updateOut::create($event);

            Flash::success(trans('categories.success_category_updated'));
            return redirect("admin/categories");
        }

        return redirect("admin/categories/");


    }

    function getCategoryProperties(Inputs $request, $id = 0)
    {
        $response = ['success' => false, 'message' => null];

        $category = Category::findOrFail($id);
        $properties = [];
        if ($request->has('product')) {
            $proId = $request->input('product');
            $properties = $this->productWithProperties($proId);
        } else {
            $properties = $category->properties()->get();
        }

        if (!$properties) {
            $properties = $category->properties()->get();
        }
        $response = ['success' => true, 'data' => $properties];
        return response()->json($response);


    }

    private function productWithProperties($id)
    {

        $product = Product::find($id);

        // get category properties
        $catProp = $product->category()->first()->properties()->get();
        // get product properties values
        $properties = $product->properties()->get();

        // merge properties with it's values
        $pv = [];
        if ($catProp) {
            foreach ($catProp as $k => $v) {
                if (count($properties) and isset($properties[$k])) {
                    $catProp[$k]->{"value"} = $properties[$k]->value;
                } else {
                    $catProp[$k]->{"value"} = null;
                }
            }
        }

        $catProp;
        return $catProp;
    }


    function delete($id = 0)
    {
        if (Auth::user()->level > 1) {
            return redirect()->back()->withErrors(trans("main.permission_denied"));
        }
        $cat = Category::find($id);
        if ($cat) {

            $products=$cat->products()->get();
            if($products){
                foreach ($products as $product){
                    $event = [
                        'table_name' => 'products',
                        'action' => 'delete',
                        'action_id' => $product->id,
                    ];
                    updateOut::create($event);

                }
                $cat->products()->delete();
            }

            $event = [
                'table_name' => 'categories',
                'action' => 'delete',
                'action_id' => $cat->id,
            ];

            updateOut::create($event);
            $cat->delete();
            Flash::success(trans('categories.success_category_deleted'));
        } else {
            Flash::error(trans('categories.error_category_delete'));
        }
        return redirect("admin/categories");
    }
}
