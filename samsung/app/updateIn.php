<?php

namespace App;


use Curl;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\categoryProperties;
use App\Filter;
use App\Product;
use App\productProperties;
use App\productColors;
use App\productGallery;
use App\productFilters;
use Illuminate\Support\Facades\Log;
use Storage;
use Image;


class updateIn extends Model
{
    protected $table = "update_in";
    public $timestamps = false;
    protected $fillable = ['update_id'];

    function syncData()
    {

        if ($this->checkInternet()) {
            $updates = $this->checkUpdates();
            if ($updates) {
                $this->installUpdates($updates);
                return true;
            }
        }
        return false;
    }

    function checkUpdates()
    {

        Log::info("update: Check new updates ... ");
//            get installed data
        $installed = $this->get();
        $old = [];// installed updates ids

        if ($installed) {
            for ($i = 0; $i < count($installed); $i++) {
                $old[] = $installed[$i]->update_id;
            }

        }

        $updates = updateOut::on('remote')->whereNotIn('id', $old)->get();

        if ($updates && count($updates)) {


            Log::info("update: new updates available and need to install. ");
            return $updates;
        }
        Log::info("update: No new updates, Application Database is up to date. ");
        return false;


    }

    function checkInternet()
    {
        Log::info("update: check internet connection ....");

        $connected = @fopen("http://www.google.com:80", 'r');
        //website, port  (try 80 or 443)
        if ($connected) {
            Log::info("update: internet connection is working ");
            fclose($connected);
            return true;
        }

        Log::warning("update: No internet connection ");
        return false;

    }

    function installUpdates($data = [])
    {
        if ($data) {
            $count = count($data);
            Log::info("update: Installing new $count updates ...");
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            foreach ($data as $value) {
                switch ($value->table_name) {
                    case "categories":
                        switch ($value->action) {
                            case "create":
                                $this->createCategory($value->action_id, $value->id);
                                break;
                            case "update":
                                $this->updateCategory($value->action_id, $value->id);
                                break;
                            case "delete":
                                $this->deleteCategory($value->action_id, $value->id);
                                break;
                        }
                        break;
                    case "categories_properties":
                        switch ($value->action) {
                            case "create":
                                $this->createCategory_property($value->action_id, $value->id);
                                break;
                            case "update":
                                $this->updateCategory_property($value->action_id, $value->id);
                                break;
                            case "delete":
                                $this->deleteCategory_property($value->action_id, $value->id);
                                break;
                        }
                        break;
                    case "categories_filters":
                        switch ($value->action) {
                            case "create":
                                $this->createCategory_filter($value->action_id, $value->id);
                                break;
                            case "update":
                                $this->updateCategory_filter($value->action_id, $value->id);
                                break;
                            case "delete":
                                $this->deleteCategory_filter($value->action_id, $value->id);
                                break;
                        }
                        break;
                    case "products":
                        switch ($value->action) {
                            case "create":
                                $this->createProduct($value->action_id, $value->id);
                                break;
                            case "update":
                                $this->updateProduct($value->action_id, $value->id);
                                break;
                            case "delete":
                                $this->deleteProduct($value->action_id, $value->id);
                                break;
                        }

                        break;
                    case "products_properties":
                        switch ($value->action) {
                            case "create":
                                $this->createProductProperty($value->action_id, $value->id);
                                break;
                            case "update":
                                $this->updateProductProperty($value->action_id, $value->id);
                                break;
                            case "delete":
                                $this->deleteProductProperty($value->action_id, $value->id);
                                break;
                        }
                        break;
                    case "product_colors":
                        switch ($value->action) {
                            case "create":
                                $this->createProductColor($value->action_id, $value->id);
                                break;
                            case "update":
                                $this->updateProductColor($value->action_id, $value->id);
                                break;
                            case "delete":
                                $this->deleteProductColor($value->action_id, $value->id);
                                break;
                        }
                        break;
                    case "product_gallery":
                        switch ($value->action) {

                            case "delete":
                                $this->deleteProductGalleryPhoto($value->action_id, $value->id);
                                break;
                        }
                        break;
                    default:
                        Log::error("No sync structure for table ($value->table_name)");
                        break;

                }
            }
        }

    }

    // categories

    private function createCategory($action_id = 0, $update_id = 0)
    {


        $row = Category::on('remote')->find($action_id);
        if ($row) {
            $create = null;

            $exists = Category::find($action_id);

            if (!$exists) {
                $create = new Category();
                $create->id = $row->id;
            } else {
                $create = $exists;
            }

            $create->cat_slug = $row->cat_slug;
            $create->cat_photo = $row->cat_photo;
            $create->created_at = $row->created_at;
            $create->updated_at = $row->updated_at;
            $create->save();


//            get remote translation for category
            $newTrans = DB::connection('remote')->table("category_translations")->where("category_id", "=", $row->id)->get();

            // delete old translation
            DB::table("category_translations")->where("category_id", "=", $row->id)->delete();
            $trans = [];
            foreach ($newTrans as $locale) {
                Log::info("Update: save $locale->locale translation for Category No: $create->id");
                $trans[] = [
                    'category_id' => $locale->category_id,
                    'cat_title' => $locale->cat_title,
                    'cat_description' => $locale->cat_description,
                    'locale' => $locale->locale
                ];
            }
            if (count($trans) && DB::table("category_translations")->insert($trans)) {
                Log::info("Update : translation saved");
            }


            // check if category image exists
            if (!Storage::disk('public')->exists($row->cat_photo) && @exif_imagetype(config('settings.remote_url') . "/" . $row->cat_photo)) {
                // get category photo in save it in locale
//                Image::make(config('settings.remote_url') . "/" . $row->cat_photo)->save($row->cat_photo);
                Log::info("update:Downloading category  ($row->id) photo - image :$row->cat_photo , category:$action_id, Update:$update_id");
//                    Storage::disk('public')->put($this->remove_upload_path($row->cat_photo), config('settings.remote_url') . "/" . $row->cat_photo);
                $image = Image::make(config('settings.remote_url') . "/" . $row->cat_photo);
                if ($image->save(public_path($row->cat_photo))) {
                    Log::info("update:category image downloaded - image $row->cat_photo , category:$action_id, Update:$update_id");
                }

            }

            $this->create(['update_id' => $update_id]);

            Log::info("new category created online: category_id=$action_id and update_id=$update_id");
            return true;
        }


        Log::warning("new category created online: category_id=$action_id and update_id=$update_id");
        return false;


    }

    private function updateCategory($action_id = 0, $update_id = 0)
    {
//        $row = DB::connection("remote")->select("categories")->where("id", "=", $action_id)->first();
        $row = Category::on('remote')->find($action_id);

        if ($row) {

            $create = null;

            $exists = Category::find($action_id);

            if (!$exists) {
                $create = new Category();
                $create->id = $row->id;
            } else {
                $create = $exists;
            }
            $create->cat_slug = $row->cat_slug;
            $create->cat_photo = $row->cat_photo;
            $create->created_at = $row->created_at;
            $create->updated_at = $row->updated_at;
            $create->save();

//            get remote translation for product
            $newTrans = DB::connection('remote')->table("category_translations")->where("category_id", "=", $row->id)->get();

            // delete old translation
            DB::table("category_translations")->where("category_id", "=", $create->id)->delete();
            $trans = [];
            foreach ($newTrans as $locale) {
                Log::info("Update: save $locale->locale translation for Category No: $create->id");
                $trans[] = [
                    'category_id' => $locale->category_id,
                    'cat_title' => $locale->cat_title,
                    'cat_description' => $locale->cat_description,
                    'locale' => $locale->locale
                ];
            }

            if (count($trans) && DB::table("category_translations")->insert($trans)) {
                Log::info("Update : translation saved");
            }


            // check if category image exists
            if (!Storage::disk('public')->exists($row->cat_photo)) {
                // get category photo in save it in locale
                Log::info("update:Downloading category  ($row->id) photo - image :$row->cat_photo , category:$action_id, Update:$update_id");
//                    Storage::disk('public')->put($this->remove_upload_path($row->cat_photo), config('settings.remote_url') . "/" . $row->cat_photo);
                $image = Image::make(config('settings.remote_url') . "/" . $row->cat_photo);
                if ($image->save(public_path($row->cat_photo))) {
                    Log::info("update:category image downloaded - image $row->cat_photo , category:$action_id, Update:$update_id");
                }

            }
            $this->create(['update_id' => $update_id]);
        }
    }


    private function deleteCategory($action_id = 0, $update_id = 0)
    {
        if ($action_id) {
            $cat = Category::find($action_id);
            if ($cat) {
                // delete category image
                if (Storage::disk('public')->has($cat->cat_photo)) {
                    Storage::disk('public')->delete($cat->cat_photo);
                }
                $cat->delete();
                $this->create(['update_id' => $update_id]);
                Log::info("update: category id: $action_id deleted successfully in update number ID: $update_id");
                return true;
            }
            Log::warning("update: failed to delete category id:$action_id in update number ID: $update_id");
            return false;


        }
    }

    // category properties

    private function createCategory_property($action_id = 0, $update_id = 0)
    {
        $property = categoryProperties::on('remote')->find($action_id);
        if ($property) {

            $data = [
                'id' => $property->id,
                'icon' => $property->icon,
                'icon_size' => $property->icon_size,
                'sort' => $property->sort,
                'category_id' => $property->category_id,
                'created_at' => $property->created_at,
                'updated_at' => $property->updated_at
            ];

            $exists = categoryProperties::find($property->id);
            $create = null;
            if ($exists) {
                $exists->update($data);
                $create = $exists;
            } else {
                $data['id'] = $property->id;
                $create = categoryProperties::create($data);
            }

//            get remote translation for product
            $newTrans = DB::connection('remote')->table("categories_properties_translations")->where("category_properties_id", "=", $property->id)->get();

            // delete old translation
            DB::table("categories_properties_translations")->where("category_properties_id", "=", $property->id)->delete();

            $trans = [];
            foreach ($newTrans as $locale) {
                Log::info("Update: save $locale->locale translation for Category No: $property->id");
                $trans[] = [
                    'category_properties_id' => $create->id,
                    'name' => $locale->name,
                    'locale' => $locale->locale
                ];
            }

            if (count($trans) && DB::table("categories_properties_translations")->insert($trans)) {
                Log::info("Update : translation saved");
            }

            $this->create(['update_id' => $update_id]);
            Log::info("update:property created id:$action_id, update id: $update_id");
            return true;
        }

        Log::warning("update: update fail update id : $update_id");

        return false;

    }

    private function updateCategory_property($action_id = 0, $update_id = 0)
    {
        $property = categoryProperties::on('remote')->find($action_id);

        if ($property) {

            $data = [
                'icon' => $property->icon,
                'icon_size' => $property->icon_size,
                'sort' => $property->sort,
                'category_id' => $property->category_id,
                'created_at' => $property->created_at,
                'updated_at' => $property->updated_at
            ];
            $exists = categoryProperties::find($property->id);
            $create = null;
            if ($exists) {
                $exists->update($data);
                $create = $exists;
            } else {
                $data['id'] = $property->id;
                $create = categoryProperties::create($data);
            }


//            get remote translation for product
            $newTrans = DB::connection('remote')->table("categories_properties_translations")
                ->where("category_properties_id", "=", $property->id)
                ->get();

            // delete old translation
            DB::table("categories_properties_translations")
                ->where("category_properties_id", "=", $property->id)
                ->delete();

            $trans = [];
            foreach ($newTrans as $locale) {
                Log::info("Update: save $locale->locale translation for Category No: $property->id");
                $trans[] = [
                    'category_properties_id' => $create->id,
                    'name' => $locale->name,
                    'locale' => $locale->locale
                ];
            }

            if (count($trans) && DB::table("categories_properties_translations")->insert($trans)) {
                Log::info("Update : translation saved");
            }


            $this->create(['update_id' => $update_id]);

            Log::info("update:property created id:$action_id, update id: $action_id");
            return true;


        }
        Log::warning("update: update fail update id : $action_id");
        return false;
    }

    private function deleteCategory_property($action_id = 0, $update_id = 0)
    {
        $pro = categoryProperties::find($action_id);
        if ($pro) {
            $pro->delete();
            $this->create(['update_id' => $update_id]);
            Log::info("update:property deleted id:$action_id, update id: $update_id");
            return true;

        }
        Log::warning("update:Fail to delete property id:$action_id, update id: $update_id");
        return false;


    }


    // category filters
    private function createCategory_filter($action_id = 0, $update_id = 0)
    {

        $filter = Filter::on('remote')->find($action_id);
        if ($filter) {
            $create = new Filter();
            $exists = Filter::find($filter->id);

            if ($exists) $create = $exists;

            $create->id = $filter->id;
            $create->parent = $filter->parent;
            $create->category = $filter->category;
            $create->created_at = $filter->created_at;
            $create->created_at = $filter->created_at;

            $updated = $create->save();
            /*
            foreach (['ar', 'en'] as $locale) {
                $create->translateOrNew($locale)->name = $filter->translateOrNew($locale)->name;
            }*/

            //            get remote translation for product
            $newTrans = DB::connection('remote')->table("categories_filters_translations")
                ->where("filter_id", "=", $filter->id)
                ->get();

            // delete old translation
            DB::table("categories_filters_translations")
                ->where("filter_id", "=", $filter->id)
                ->delete();

            $trans = [];
            foreach ($newTrans as $locale) {
                Log::info("Update: save $locale->locale translation for Category Filter No: $create->id");
                $trans[] = [
                    'filter_id' => $locale->filter_id,
                    'name' => $locale->name,
                    'locale' => $locale->locale
                ];
            }

            if (count($trans) && DB::table("categories_filters_translations")->insert($trans)) {
                Log::info("Update : translation saved");
            }

            if ($updated) {
                $this->create(['update_id' => $update_id]);
                Log::info("update:Filter created id:$updated, update id: $update_id");
                return true;
            }

            Log::warning("update: update fail update id : $update_id");

            return false;
        }
    }

    private function updateCategory_filter($action_id = 0, $update_id = 0)
    {
        $filter = Filter::on('remote')->find($action_id);

        if ($filter) {
            $create = new Filter();
            $exists = Filter::find($filter->id);

            if ($exists) $create = $exists;

            $create->id = $filter->id;
            $create->parent = $filter->parent;
            $create->category = $filter->category;
            $create->created_at = $filter->created_at;
            $create->created_at = $filter->created_at;
            $updated = $create->save();
            //            get remote translation for product
            $newTrans = DB::connection('remote')->table("categories_filters_translations")
                ->where("filter_id", "=", $filter->id)
                ->get();

            // delete old translation
            DB::table("categories_filters_translations")
                ->where("filter_id", "=", $filter->id)
                ->delete();

            $trans = [];
            foreach ($newTrans as $locale) {
                Log::info("Update: save $locale->locale translation for Category Filter No: $create->id");
                $trans[] = [
                    'filter_id' => $locale->filter_id,
                    'name' => $locale->name,
                    'locale' => $locale->locale
                ];
            }

            if (count($trans) && DB::table("categories_filters_translations")->insert($trans)) {
                Log::info("Update : translation saved");
            }


            if ($updated) {
                $this->create(['update_id' => $update_id]);
                Log::info("update:Filter updated id:$updated, update id: $action_id");
                return true;
            }

            Log::warning("update: fail to update filter id:$action_id - update id : $update_id");
            return false;
        }
    }

    private function deleteCategory_filter($action_id = 0, $update_id = 0)
    {
        $filter = Filter::find($action_id);

        if ($filter) {

            $filter->delete();
            $this->create(['update_id' => $update_id]);
            Log::info("update:filter deleted id:$action_id - update id: $update_id");
            return true;
        }

        Log::warning("update:Fail to delete filter id:$action_id, update id: $update_id");

        return false;


    }

    private function remove_upload_path($file = null)
    {
        /*if ($file) {
            $file = str_replace(config("settings.upload_dir") . "/", "", $file);
        }*/
        return $file;
    }

    // products
    private function createProduct($action_id = 0, $update_id = 0)
    {


        $product = Product::on('remote')->find($action_id);

        if ($product) {

            $exists = Product::find($product->id);

            $create = null;

            if (!$exists) {
                $create = new Product();
                $create->id = $product->id;
            } else {
                $create = $exists;
            }
            $create->user = $product->user;
            $create->category = $product->category;
            $create->photo = $product->photo;
            $create->show_in_home = $product->show_in_home;
            $create->slide_photo = $product->slide_photo;
            $create->slide_background = $product->slide_background;
            $create->deleted_at = $product->deleted_at;
            $create->created_at = $product->created_at;
            $create->updated_at = $product->updated_at;

            $create->save();


            // update translations

//            get remote translation for product
            $newTrans = DB::connection('remote')->table("product_translations")->where("product_id", "=", $product->id)->get();

            // delete old translation
            DB::table("product_translations")->where("product_id", "=", $product->id)->delete();
            $trans = [];
            foreach ($newTrans as $locale) {
                Log::info("Update: save $locale->locale translation for Product No: $create->id");
                $trans[] = [
                    'product_id' => $product->id,
                    'name' => $locale->name,
                    'description' => $locale->description,
                    'slide_description' => $locale->slide_description,
                    'locale' => $locale->locale
                ];
            }
            if (count($trans) && DB::table("product_translations")->insert($trans)) {
                Log::info("Update : translation saved");
            }


            // check if Product image exists
            if ($product->photo && @exif_imagetype(config('settings.remote_url') . "/" . $product->photo) && !Storage::disk('public')->exists($product->photo)) {
                // get product photo in save it in locale
                Log::info("update:Downloading product ($product->id) image - image $product->photo , category:$action_id, Update:$update_id");
//                    Storage::disk('public')->put($this->remove_upload_path($product->photo), config('settings.remote_url') . "/" . $product->photo);
//                    Storage::disk('public')->put($this->remove_upload_path($product->photo), config('settings.remote_url') . "/small/" . $product->photo);
                $image = Image::make(config('settings.remote_url') . "/" . $product->photo);
                if ($image->save(public_path($product->photo))) {

                    $small = Image::make(config('settings.remote_url') . "/" . config("settings.upload_dir") . "/small/" . $product->photo);
                    if ($small) {
                        $small->save(public_path(config("settings.upload_dir") . "/small/" . $product->photo));
                    }
                    Log::info("update:Product image downloaded - image $product->photo , category:$action_id, Update:$update_id");
                }

            }
            // check if product slide image exists
            if ($product->slide_photo && @exif_imagetype(config('settings.remote_url') . "/" . $product->slide_photo) && !Storage::disk('public')->exists($product->slide_photo)) {
                // get product slide photo in save it in locale

                Log::info("update:Downloading product  ($product->id) photo slide - image :$product->slide_photo , category:$action_id, Update:$update_id");
//                    Storage::disk('public')->put($this->remove_upload_path($product->slide_photo), config('settings.remote_url') . "/" . $product->slide_photo);
                $image = Image::make(config('settings.remote_url') . "/" . $product->slide_photo);

                if ($image->save(public_path($product->slide_photo))) {

                    $small = Image::make(config('settings.remote_url') . "/" . config("settings.upload_dir") . "/small/" . $product->slide_photo);
                    if ($small) {
                        $small->save(public_path(config("settings.upload_dir") . "/small/" . $product->slide_photo));
                    }
                    Log::info("update:Product slide image downloaded - image :$product->slide_photo , category:$action_id, Update:$update_id");
                }


            }
            // check if slide_background image exists
            if ($product->slide_background && @exif_imagetype(config('settings.remote_url') . "/" . $product->slide_photo) && !Storage::disk('public')->exists($product->slide_background)) {
                // get category photo in save it in locale

                Log::info("update:Downloading product  ($product->id) slide Background - image :$product->slide_background , category:$action_id, Update:$update_id");
//                    Storage::disk('public')->put($this->remove_upload_path($product->slide_background), config('settings.remote_url') . "/" . $product->slide_background);
                $image = Image::make(config('settings.remote_url') . "/" . $product->slide_background);

                if ($image->save(public_path($product->slide_background))) {

                    $small = Image::make(config('settings.remote_url') . "/" . config("settings.upload_dir") . "/small/" . $product->slide_background);
                    if ($small) {
                        $small->save(public_path(config("settings.upload_dir") . "/small/" . $product->slide_background));
                    }
                    Log::info("update:Product background image downloaded - image :$product->slide_background , category:$action_id, Update:$update_id");
                }

            }
            $this->updateProductFilter($product->id);

            $this->createProductGallery($product->id);

            $this->createProductColor($product->id);

            $this->create(['update_id' => $update_id]);

            Log::info("update:Product created id:$action_id, update id: $update_id");

            return true;
        }

        Log::warning("update: Fail to create Product id : $action_id -  update id : $update_id");

        return false;
    }


    private function updateProduct($action_id = 0, $update_id = 0)
    {

        $product = Product::on('remote')->find($action_id);

        if ($product) {
            Log::info("update:Updating product No:$action_id ...");

            $create = Product::find($product->id);

            if (!$create) {
                Log::info("update:Product No:$action_id not found ... trying to create it.");
                $create = new Product();
                $create->id = $product->id;
            }

            $create->user = $product->user;
            $create->category = $product->category;
            $create->photo = $product->photo;
            $create->show_in_home = $product->show_in_home;
            $create->slide_photo = $product->slide_photo;
            $create->slide_background = $product->slide_background;
            $create->deleted_at = $product->deleted_at;
            $create->created_at = $product->created_at;
            $create->updated_at = $product->updated_at;
            $create->save();


            // update translations

//            get remote translation for product
            $newTrans = DB::connection('remote')->table("product_translations")->where("product_id", "=", $product->id)->get();

            // delete old translation
            DB::table("product_translations")->where("product_id", "=", $product->id)->delete();
            $trans = [];
            foreach ($newTrans as $locale) {
                Log::info("Update: save $locale->locale translation for Product No: $create->id");
                $trans[] = [
                    'product_id' => $product->id,
                    'name' => $locale->name,//$product->{"name:$locale"},
                    'description' => $locale->description,//$product->{"description:$locale"},
                    'slide_description' => $locale->slide_description,//$product->{"slide_description:$locale"},
                    'locale' => $locale->locale
                ];
            }
            if (count($trans) && DB::table("product_translations")->insert($trans)) {
                Log::info("Update : translation saved");
            }
// check if Product image exists
            if ($product->photo && @exif_imagetype(config('settings.remote_url') . "/" . $product->photo) && !Storage::disk('public')->exists($product->photo)) {
                // get product photo in save it in locale
                Log::info("update:Downloading product ($product->id) image - image $product->photo , category:$action_id, Update:$update_id");
//                    Storage::disk('public')->put($this->remove_upload_path($product->photo), config('settings.remote_url') . "/" . $product->photo);
//                    Storage::disk('public')->put($this->remove_upload_path($product->photo), config('settings.remote_url') . "/small/" . $product->photo);
                $image = Image::make(config('settings.remote_url') . "/" . $product->photo);
                if ($image->save(public_path($product->photo))) {

                    $small = Image::make(config('settings.remote_url') . "/" . config("settings.upload_dir") . "/small/" . $product->photo);
                    if ($small) {
                        $small->save(public_path(config("settings.upload_dir") . "/small/" . $product->photo));
                    }
                    Log::info("update:Product image downloaded - image $product->photo , category:$action_id, Update:$update_id");
                }

            }
            // check if product slide image exists
            if ($product->slide_photo && @exif_imagetype(config('settings.remote_url') . "/" . $product->slide_photo) && !Storage::disk('public')->exists($product->slide_photo)) {
                // get product slide photo in save it in locale

                Log::info("update:Downloading product  ($product->id) photo slide - image :$product->slide_photo , category:$action_id, Update:$update_id");
//                    Storage::disk('public')->put($this->remove_upload_path($product->slide_photo), config('settings.remote_url') . "/" . $product->slide_photo);
                $image = Image::make(config('settings.remote_url') . "/" . $product->slide_photo);

                if ($image->save(public_path($product->slide_photo))) {

                    $small = Image::make(config('settings.remote_url') . "/" . config("settings.upload_dir") . "/small/" . $product->slide_photo);
                    if ($small) {
                        $small->save(public_path(config("settings.upload_dir") . "/small/" . $product->slide_photo));
                    }

                    Log::info("update:Product slide image downloaded - image :$product->slide_photo , category:$action_id, Update:$update_id");
                }


            }
            // check if slide_background image exists
            if ($product->slide_background && @exif_imagetype(config('settings.remote_url') . "/" . $product->slide_background) && !Storage::disk('public')->exists($product->slide_background)) {
                // get category photo in save it in locale

                Log::info("update:Downloading product  ($product->id) slide Background - image :$product->slide_background , category:$action_id, Update:$update_id");
//                    Storage::disk('public')->put($this->remove_upload_path($product->slide_background), config('settings.remote_url') . "/" . $product->slide_background);
                $image = Image::make(config('settings.remote_url') . "/" . $product->slide_background);

                if ($image->save(public_path($product->slide_background))) {

                    $small = Image::make(config('settings.remote_url') . "/" . config("settings.upload_dir") . "/small/" . $product->slide_background);
                    if ($small) {
                        $small->save(public_path(config("settings.upload_dir") . "/small/" . $product->slide_background));
                    }
                    Log::info("update:Product background image downloaded - image :$product->slide_background , category:$action_id, Update:$update_id");
                }

            }

            $this->updateProductFilter($product->id);

//            delete all old gallery photos
            $this->deleteProductGallery($product->id);
            $this->createProductGallery($product->id);

            // delete all old product colors then create a new colors rows
            $this->deleteProductColor($product->id);
            $this->createProductColor($product->id);

            $this->create(['update_id' => $update_id]);
            Log::info("update:Product updated id:$action_id, update id: $update_id");
            return true;


        }
    }

    private function deleteProduct($action_id = 0, $update_id = 0)
    {
        $product = Product::find($action_id);

        if ($product) {

            // check if Product image exists
            if ($product->photo && Storage::disk('public')->exists($product->photo)) {
                // get product photo in save it in locale
                Storage::disk('public')->delete($product->photo);
            }
            // check if product slide image exists
            if ($product->slide_photo && Storage::disk('public')->exists($product->slide_photo)) {
                Storage::disk('public')->delete($product->slide_photo);
            }
            // check if slide_background image exists
            if ($product->slide_background && Storage::disk('public')->exists($product->slide_background)) {
                Storage::disk('public')->delete($product->slide_background);
            }
            $this->deleteProductFilters($product->id);

            $product->delete();
            $this->create(['update_id' => $update_id]);
            Log::info("update:Product deleted id:$action_id - update id: $update_id");
            return true;
        }

        Log::warning("update:Fail to delete Product id:$action_id, update id: $update_id");

        return false;


    }

    // products properties
    private function createProductProperty($action_id = 0, $update_id = 0)
    {

        $property = productProperties::on('remote')->find($action_id);

        if ($property) {

            $data = [
                'id' => $property->id,
                'property' => $property->property,
                'product' => $property->product,
                'value' => $property->value,
                'created_at' => $property->created_at,
                'updated_at' => $property->updated_at,
            ];

            $created = productProperties::create($data);

            if ($created) {
                $this->create(['update_id' => $update_id]);
                Log::info("update:Product Property created id:$action_id, update id: $update_id");
                return true;
            }

            Log::warning("update: Fail to create Product Property id : $action_id -  update id : $update_id");

            return false;
        }
    }

    private function updateProductProperty($action_id = 0, $update_id = 0)
    {

        $property = productProperties::on('remote')->find($action_id);

        if ($property) {

            $data = [
                'property' => $property->property,
                'product' => $property->product,
                // 'category' => $property->category,
                'value' => $property->value,
                'created_at' => $property->created_at,
                'updated_at' => $property->updated_at,
            ];

            $p = productProperties::find($action_id);

            $updated = $p->update($data);

            if ($updated) {
                $this->create(['update_id' => $update_id]);
                Log::info("update:Product updated id:$action_id, update id: $update_id");
                return true;
            }


            Log::warning("update: fail to update Product id:$action_id - update id : $update_id");
            return false;
        }
    }

    private function deleteProductProperty($action_id = 0, $update_id = 0)
    {
        $property = productProperties::find($action_id);

        if ($property) {

            $property->delete();
            $this->create(['update_id' => $update_id]);
            Log::info("update:Product Property deleted id:$action_id - update id: $update_id");
            return true;
        }

        Log::warning("update:Fail to delete Product Property id:$action_id - update id: $update_id");

        return false;


    }

    private function updateProductFilter($product_id = 0)
    {

        $filters = productFilters::on('remote')->where("product", $product_id)->get();
        // delete old filters
        $this->deleteProductFilters($product_id);

        if ($filters) {
            foreach ($filters as $filter) {
                $data = [
                    'product' => $filter->product,
                    'filter' => $filter->filter,
                ];
                productFilters::create($data);

            }

            Log::info("update:filters of product ($product_id) updated");

            return true;

        }
        return false;
    }

    private function deleteProductFilters($product_id = 0)
    {
        return productFilters::where("product", $product_id)->delete();
    }

    // products colors
    private function createProductColor($product_id = 0)
    {

        $colors = productColors::on('remote')->where("product_id", '=', $product_id)->get();

        if ($colors) {

            foreach ($colors as $color) {

                $data = [
                    'product_id' => $product_id,
                    'color' => $color->color,
                    'created_at' => $color->created_at,
                    'updated_at' => $color->updated_at,
                ];
                productColors::create($data);

            }

            Log::info("update:Product ($product_id) Colors created ");
            return true;
        }
        return false;
    }

    private function deleteProductColor($product_id = 0)
    {
        $product = Product::find($product_id);
        $colors = $product->colors();

        if ($colors) {

            $colors->delete();

            Log::info("update:Product ($product_id) Colors Deleted");
            return true;
        }

        return false;


    }

    // products Gallery
    private function createProductGallery($product = 0)
    {

        // get product gallery
        $gallery = productGallery::on("remote")->where("product_id", $product)->get();
        // insert a new product gallery
        if ($gallery) {
            $data = [];
            foreach ($gallery as $photo) {
                $data = [
                    'id' => $photo->id,
                    'name' => $photo->name,
                    'path' => $photo->path,
                    'product_id' => $photo->product_id,
                    'deleted_at' => $photo->deleted_at,
                    'created_at' => $photo->created_at,
                    'updated_at' => $photo->updated_at,
                ];
                productGallery::create($data);

                // check if Product Gallery image exists
                if ($photo->path && @exif_imagetype(config('settings.remote_url') . "/" . $photo->path) && !Storage::disk('public')->exists($photo->path)) {
                    // get product photo in save it in locale

                    Log::info("update:Downloading gallery  ($photo->id) photo - image :$photo->path ");
//                    Storage::disk('public')->put($this->remove_upload_path($photo->path), config('settings.remote_url') . "/" . $photo->path);
                    $image = Image::make(config('settings.remote_url') . "/" . $photo->path);
                    if (@$image->save(public_path($photo->path))) {
                        $small = Image::make(config('settings.remote_url') . "/" . config("settings.upload_dir") . "/small/" . $photo->path);
                        if ($small) {
                            @$small->save(public_path(config("settings.upload_dir") . "/small/" . $photo->path));
                        }

                        Log::info("update:Product Gallery Image downloaded - image $photo->path ");
                    }
                }
            }

            Log::info("update:Product($product) Gallery created");
            return true;
        }
        return false;
    }


    private function deleteProductGallery($product_id = 0)
    {
        $product = Product::find($product_id);
        $gallery = $product->gallery;

        if ($gallery) {
            foreach ($gallery as $photo) {
                // check if slide_background image exists
                if ($photo->path && Storage::disk('public')->exists($photo->path)) {
                    Storage::disk('public')->delete($photo->path);
                }
                $photo->delete();
            }

            Log::info("update:Product ($product_id) Gallery deleted ");
            return true;
        }
        return false;


    }


    private function deleteProductGalleryPhoto($action_id = 0, $update_id = 0)
    {

        $photo = productGallery::find($action_id);
        if ($photo) {
            // check if slide_background image exists
            if ($photo->path && Storage::disk('public')->exists($photo->path)) {
                Storage::disk('public')->delete($photo->path);
            }
            Log::info("update:Product ($photo->product_id) Gallery Photo Id: $action_id deleted  on update Id: $update_id");

            $photo->delete();
        }

        $this->create(['update_id' => $update_id]);
        return true;


    }


}
