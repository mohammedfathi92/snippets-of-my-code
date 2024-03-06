<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Artisan;
use Ixudra\Curl\Facades\Curl;
use Javascript;
use Auth;
use Illuminate\Support\Facades\Lang;
use App\Category;
use App\CategoryTranslation;
use DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [];


    function __construct()
    {
        // push configurations to javascript .
        $user = null;
        if (Auth::user()) {
            $user = Auth::user();
        }

        if (session('lang')) {
            session()->put('lang', App::getLocale());
        }

        $javascript_vars = [
            "appUrl" => url("/"),
            "assetPath" => asset(""),
            "uploadPath" => config("settings.upload_path"),
            "uploadDir" => config("settings.upload_dir"),
            "appTitle" => config("settings.app_title"),
            "checkUpdatesTimer" => config('settings.updates_timer'),
            "csrfToken" => csrf_token(),
            "lang" => session('lang'),
            "user" => $user
        ];
        Javascript::put($javascript_vars);

        $this->data["page_title"] = null;

    }


    function translateTables(Request$request,$module='categories'){
        switch ($module){
            case "categories":
                // get categories name
                $categories=DB::table("categories")->get();
                if($categories){
                    $data=[];
                    $inserties=0;
                    foreach ($categories as $category){

                        foreach (['ar','en'] as $locale) {
                            $row=[];
                            $row['cat_title']=$category->cat_title;
                            $row['cat_description']=$category->cat_description;
                            $row['category_id']=$category->id;
                            $row['locale']=$locale;
                            array_push($data,$row);
                        }
                        $inserties++;

                    }DB::table("category_translations")->insert($data);
                    if($inserties ==count($categories)){
                        return "Module ".$module." Translated Successfully";
                    }else
                    {
                        return "Error: Module ".$module." Not Translated";
                    }
                }
                break;
            case "old_values":
                $values=DB::table('products_properties')->get();
                if ($values){
                    $insertes=0;
                    foreach ($values as $v){


                            $data=['value'=>@json_encode(['ar'=>$v->value,'en'=>$v->value])];
                            DB::table('products_properties')->where('id','=',$v->id)->update($data);




                        $insertes++;
                    }

                    if($insertes==count($values)){
                        echo "all values updated";
                    }
                }
            break;
            case "old_properties":
                $properties=DB::table('categories_properties_back')->get();
                if($properties){
                    $insertes=0;
                    foreach ($properties as $property){
                        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
                        $new=new App\categoryProperties();
                        $new->id=$property->property_id;
                        $new->icon=$property->property_icon;
                        $new->icon_size=$property->property_icon_size;
                        $new->sort=$property->property_sort;
                        $new->category_id=$property->property_cat;
                        $new->created_at=$property->created_at;
                        $new->updated_at=$property->updated_at;
                        $new->save();
                        $insertes++;
                    }

                    if($insertes==count($properties)){
                        echo "old properties inserted successfully";

                        // insert translations
                        // get old translations
                        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
                        $old_trans=DB::table('categories_properties_translations_back')->get();
                        $insertes=0;
                        if($old_trans){
                            $data=[];
                            foreach ($old_trans as $trans){
                                $data[]=[
                                    'id'=>$trans->property_id,
                                    'category_properties_id'=>$trans->property,
                                    'name'=>$trans->property_name,
                                    'locale'=>$trans->locale
                                ];
                                $insertes++;
                            }
                            $db=DB::table('categories_properties_translations')->insert($data);
                            if($insertes==count($old_trans)){
                                echo "Old properties translations inserted successfully";

                            }else{
                                echo "not all translations inserted";
                            }
                        }

                    }else{
                        echo "Error:Properties not inserted ";
                    }
                }
                break;
            case "filters":
                // get filters name
                $filters=DB::table("categories_filters")->get();
                if($filters){
                    $data=[];
                    $inserties=0;
                    foreach ($filters as $filter){

                        foreach (['ar','en'] as $locale) {
                            $row=[];
                            $row['name']=$filter->name;
                            $row['filter_id']=$filter->id;
                            $row['locale']=$locale;
                            array_push($data,$row);
                        }
                        $inserties++;

                    }
                    DB::table("categories_filters_translations")->insert($data);
                    if($inserties ==count($filters)){
                        return "Module ".$module." Translated Successfully";
                    }else
                    {
                        return "Error: Module ".$module." Not Translated";
                    }
                }
                break;

            case "products":
                // get categories name
                $products=DB::select("select * from products");//App\Product::where("name","")->get();

                if($products){
                    $data=[];

                    $inserties=0;
                    foreach ($products as $product){

                        foreach (['ar','en'] as $locale) {

                            $row=[];
                            $row['name']=$product->name;
                            $row['description']=$product->description;
                            $row['slide_description']=$product->slide_description;
                            $row['product_id']=$product->id;
                            $row['locale']=$locale;
                            array_push($data,$row);

                        }

                        $inserties++;

                    }
                    DB::table("product_translations")->insert($data);
                    if($inserties ==count($products)){
                        return "Module ".$module." Translated Successfully";
                    }else
                    {
                        return "Error: Module ".$module." Not Translated";
                    }
                }
                break;
            case "properties":
                // get categories name
                $properties=DB::table("categories_properties")->get();

                if($properties){
                    $data=[];
                    $inserties=0;
                    foreach ($properties as $property){

                        foreach (['ar','en'] as $locale) {
                            $row=[];
                            $row['property_name']=$property->property_name;
                            $row['property']=$property->property_id;
                            $row['locale']=$locale;
                            array_push($data,$row);
                        }
                        $inserties++;
                    }

                    DB::table("categories_properties_translations")->insert($data);
                    if($inserties ==count($properties)){
                        return "Module ".$module." Translated Successfully";
                    }else
                    {
                        return "Error: Module ".$module." Not Translated";
                    }
                }
                break;
        }
    }

    function getLang(Request $request)
    {


        // request by ajax
        // if (!$request->ajax()) {

        if ($request->has('set')) {
            App::setLocale($request->input('set'));
            session()->put('lang', $request->input('set'));
            return response()->json(['success' => true, 'message' => "lang ({$request->input('set')}) set successfully"]);
        }

        if ($request->has('lang')) {
            $lang = $request->input('lang');
            app()->setLocale($lang);


            $categories = Lang::get("categories");
            $products = Lang::get("products");
            $main = Lang::get("main");
            $langArray = array_merge($categories, $products);
            $langArray = array_merge($langArray, $main);
            return response()->json([$langArray]);
        }

        // }

    }
}
