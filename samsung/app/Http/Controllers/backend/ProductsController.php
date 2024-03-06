<?php


namespace App\Http\Controllers\backend;

use App\Category;
use App\Filter;
use App\Product;

use App\productColors;
use App\productGallery;
use App\updateOut;
use Intervention\Image\Facades\Image;
use Javascript;
use Validator;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Laracasts\Flash\Flash;
use Storage;
use Illuminate\Support\Str;


class ProductsController extends BaseAdminController
{

    // list all products.
    function getIndex()
    {
        $this->data['page_title'] = "Products";
        $this->data['data'] = Product::with('category')->get();


        return view("backend.products.index", $this->data);
    }

    function getCreate()
    {
        $filters = Filter::where('parent', 0)->with('subFilters')->with('products')->get();
        $this->data['page_title'] = "Create a new Product";
        $this->data['categories'] = Category::all();

        return view('backend.products.create', $this->data);
    }


    function postCreate(Request $request)
    {
        //        $request =  Request;

        $rules = [
            'name' => 'required|max:225',
            'category' => 'required',
            'photo' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('admin/products/create')->withErrors($validator)->withInput();
        }


        $prod = new Product();
        $prod->category = $request->input('category');
        $prod->user = Auth::user()->id;
        $prod->sort = $request->input('sort');
        $photo = $request->input('photo');
        $prod->photo = $photo ? config("settings.upload_path") . "/" . $photo : null;
        $prod->created_at = Carbon::now();
        if ($request->has("show_in_home") and (bool)$request->input('show_in_home')) {
            $prod->show_in_home = 1;
            $slide_photo = $request->input('slide_photo');
            $slide_background = $request->input('slide_background');
            $prod->slide_photo = $slide_photo ? config('settings.upload_path') . "/" . $slide_photo : null;
            $prod->slide_background = $slide_background ? config('settings.upload_path') . "/" . $slide_background : null;

        } else {
            $prod->show_in_home = 0;
        }
        if ($prod->save()) {


            // update translations
            foreach (['ar', 'en'] as $locale) {
                $prod->translateOrNew($locale)->name = $request->input('name')[$locale];
                $prod->translateOrNew($locale)->description = $request->input('description')[$locale];
                $prod->translateOrNew($locale)->slide_description = $request->input('slide_description')[$locale];
            }

            $prod->save();
            // insert in update_out table
            $event = [
                'table_name' => 'products',
                'action' => 'create',
                'action_id' => $prod->id,
            ];

            updateOut::create($event);
            // save gallery photos
            if ($request->input('gallery') && is_array($request->input('gallery'))) {
                $images = $request->input('gallery');
                foreach ($images as $photo) {
                    $gallery = new productGallery();
                    $gallery->name = $photo;
                    $gallery->path = config('settings.upload_path') . "/" . $photo;
                    $gallery->product_id = $prod->id;
                    $gallery->created_at = Carbon::now();
                    $gallery->save();


                }

            }

            // save product Properties

            if ($request->has("value") and is_array($request->input("value"))) {
                foreach ($request->input("cat_property_id") as $k => $property) {
                    $value = $request->input('value')[$property];
                    $data = ['value' => json_encode($value)];
                    $prod->properties()->attach($property, $data);
                    $inserted = $prod->properties()->where('property', '=', $property)->withPivot("id")->first()->pivot->id;


                    // insert in update_out table

                    $event = [
                        'table_name' => 'products_properties',
                        'action' => 'create',
                        'action_id' => $inserted,
                    ];

                    updateOut::create($event);
                }

            }


            //save filters

            if ($request->has('filters') and is_array($request->input('filters'))) {
                $sync = $prod->filters()->sync($request->input('filters'));

                // insert in update_out table

                if ($sync['attached']) {
                    foreach ($sync['attached'] as $item) {
                        $event = [
                            'table_name' => 'products_filters',
                            'action' => 'create',
                            'action_id' => $item,
                        ];
                        updateOut::create($event);
                    }
                }
                if ($sync['detached']) {
                    foreach ($sync['detached'] as $item) {
                        $event = [
                            'table_name' => 'products_filters',
                            'action' => 'delete',
                            'action_id' => $item,
                        ];
                        updateOut::create($event);
                    }
                }
                if ($sync['updated']) {
                    foreach ($sync['updated'] as $item) {
                        $event = [
                            'table_name' => 'products_filters',
                            'action' => 'update',
                            'action_id' => $item,
                        ];
                        updateOut::create($event);
                    }
                }


            }


            // save colors
            if ($request->has('colors')) {
                if (is_array($request->input('colors'))) {

                    foreach ($request->input('colors') as $hex) {
                        $color = new productColors();
                        $color->product_id = $prod->id;
                        $color->color = $hex;
                        $color->save();

                    }

                }

            }

            Flash::success(trans('products.message_created_success'));
            return redirect("admin/products");
        }

        return redirect("admin/products");

    }

    function getEdit($id = 0)
    {

        $product = Product::find($id);
        $filters = $product->filters()->get();
        $colors = $product->colors()->get();
        $gallery = $product->gallery()->get();
        $this->data['page_title'] = "Update Product";
        $this->data['categories'] = Category::all();
        $this->data['data'] = $product;
        $this->data['gallery'] = $gallery;
        $this->data['filters'] = $filters;
        $this->data['colors'] = $colors ? $colors : [];
        Javascript::put(['productGallery' => $this->data['gallery'], 'productColors' => $this->data['colors']]);
        return view('backend.products.edit', $this->data);
    }

    function getAjaxFilters(Request $request)
    {
        $filters = Filter::where('parent', 0);
        if ($cat = $request->input('category')) {
            $filters = $filters->where('category', $cat);
        }

        $filters = $filters->with('subFilters')->with('products');

        $items = $filters->get();


        if ($request->input('product')) {
            if ($items) {

                foreach ($items as $k => $item) {
                    if ($item->subFilters) {
                        foreach ($item->subFilters as $i => $filter) {
                            // get this filter related products
                            $filterProduct = Product::find($request->input('product'))->filters()->where('filter', $filter->id)->first();
                            if ($filterProduct) {
                                $filter->checked = true;
                            } else {
                                $filter->checked = false;
                            }

                        }
                    }
                }
            }
        }

        return response()->json(['success' => true, 'data' => $items]);

    }

    function postEdit(Request $request, $id)
    {
        $rules = [
            'name' => 'required|max:225',
            'category' => 'required',

        ];

        if (!$request->input("old_photo")) {
            $rules['photo'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect("admin/products/edit/{$id}")->withErrors($validator)->withInput();
        }


        $prod = Product::find($id);
        $prod->category = $request->input('category');
        $prod->user = Auth::user()->id;
        $prod->sort = $request->input('sort');
        $photo = $request->input('photo');
        $prod->photo = $photo ? config("settings.upload_path") . "/" . $photo : ($request->input("old_photo") ? $request->input("old_photo") : null);
        $prod->updated_at = Carbon::now();
        if ($request->has("show_in_home") and (bool)$request->input('show_in_home')) {
            $prod->show_in_home = 1;
//            $prod->slide_description    = $request->input('slide_description');
            $slide_photo = $request->input('slide_photo');
            $slide_background = $request->input('slide_background');
            if ($slide_photo) {
                $prod->slide_photo = config("settings.upload_path") . "/" . $slide_photo;
            }
            if ($slide_background) {
                $prod->slide_background = config("settings.upload_path") . "/" . $slide_background;
            }


        } else {
            $prod->show_in_home = 0;
        }
        if ($prod->save()) {

            // update translations
            foreach (['ar', 'en'] as $locale) {
                $prod->translateOrNew($locale)->name = $request->input('name')[$locale];
                $prod->translateOrNew($locale)->description = $request->input('description')[$locale];
                $prod->translateOrNew($locale)->slide_description = $request->input('slide_description')[$locale];
            }

            $prod->save();
            // insert in update_out table
            $event = [
                'table_name' => 'products',
                'action' => 'update',
                'action_id' => $prod->id,
            ];

            updateOut::create($event);


            // save gallery photos
            if ($request->input('gallery') && is_array($request->input('gallery'))) {
                $images = $request->input('gallery');
                $event = [];
                foreach ($images as $photo) {
                    $gallery = new productGallery();
                    $gallery->name = $photo;
                    $gallery->path = config('settings.upload_path') . "/" . $photo;
                    $gallery->product_id = $prod->id;
                    $gallery->created_at = Carbon::now();
                    $gallery->save();

                }


            }


            // save product Properties

            if ($request->has("value") and is_array($request->input("value"))) {

                foreach ($request->input("cat_property_id") as $k => $property) {
                    $prod->properties()->detach($request->input('cat_property_id')[$k]);
                    $value = $request->input('value')[$property];
                    $data = ['value' => json_encode($value)];
                    $prod->properties()->attach($property, $data);
                    $inserted = $prod->properties()->where('property', '=', $property)->withPivot("id")->first()->pivot->id;


                    // insert in update_out table

                    $event = [
                        'table_name' => 'products_properties',
                        'action' => 'create',
                        'action_id' => $inserted,
                    ];
                    updateOut::create($event);

                }

            }
            if ($request->has('filters') and is_array($request->input('filters'))) {

                $sync = $prod->filters()->sync($request->input('filters'));

            }
            // save colors
            if ($request->has('colors')) {

                if (is_array($request->input('colors'))) {
                    // delete current colors
                    $prod->colors()->delete();

                    foreach ($request->input('colors') as $hex) {
                        $color = new productColors();
                        $color->product_id = $prod->id;
                        $color->color = $hex;
                        $color->save();

                    }


                }

            }else{
                $prod->colors()->delete();
            }
            Flash::success(trans('products.message_updated_success'));
            return redirect("admin/products");
        }

        return redirect("admin/products");

    }

    function getDelete($id = 0)
    {
        if (Auth::user()->level > 1) {
            return redirect()->back()->withErrors(trans("main.permission_denied"));
        }
        $pro = Product::find($id);
        if ($pro) {
            $event = [
                'table_name' => 'products',
                'action' => 'delete',
                'action_id' => $pro->id,
            ];
            updateOut::create($event);
            $pro->delete();
            Flash::success(trans('products.message_deleted_success'));
        } else {
            Flash::error(trans('products.error_product_delete'));
        }
        return redirect("admin/products");
    }

    private function categoriesList()
    {
        $categories = Category::all();

        $options = [];
        if ($categories) {

            foreach ($categories as $option) {
                $options[$option->cat_id] = $option->cat_title;
            }

        }

        return $options;

    }

    function removeGalleryPhoto(Request $request, $id)
    {

        if (!$request->ajax()) {
            //remove file from storage
            $response = ['success' => false, "message" => null];
            $photo = productGallery::find($id);
            $file = $photo->path;
            if (Storage::disk('public')->has($file)) {
                if (Storage::disk('public')->delete($file)) {
                    $event = [
                        'table_name' => 'product_gallery',
                        'action' => 'delete',
                        'action_id' => $photo->id,
                    ];

                    updateOut::create($event);
                    $photo->delete();
                    $response = ["success" => true, "message" => trans("main.success_file_deleted")];
                } else {
                    $response = ['success' => false, "message" => trans("main.error_can_not_delete_file")];
                }
            } else {
                $response = ['success' => false, "message" => trans("main.error_file_not_found")];
            }
            return response()->json($response);
        }
        echo "nothing here to show";

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
            $small->resize(100, 100);
            $small_destination = config('settings.upload_path') . '/small/' . config('settings.upload_path');
            $small->save($small_destination . "/" . $filename);
            return response()->json(['success' => true, 'file' => $filename, 'small' => $small_destination . "/" . $filename]);
        }

        return response()->json(['success' => false, "message" => "No files selected to upload!"]);
    }

}
