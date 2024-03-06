<?php

namespace Sirb\Http\Controllers;

use Sirb\Category;
use Sirb\LandingPage;
use Sirb\LandingBlock;
use Sirb\Media;
use DB;

use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Sirb\Http\Requests;

class PageBuilderController extends Controller
{
    function index()
    {
    

    }

    function build($id)
    {
        // if (!Auth::user()->can("show builder")) {

        //     return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        // }
        $page = LandingPage::findOrFail($id);

        $locale_code = Input::get("lang")?:"ar";
                  
           return view("builder.show", ['page_title'=>trans("pages.backend_landing_page_title"), 'page'=> $page, 'pageLang' => $locale_code]);

    }

    function ajax_store(Request $request, $id)
    { 
        // if (!Auth::user()->can("create builder")) {
        //   return  response()->json(["responseCode" => 0, 'responseHTML' => trans("permissions.permission_denied")]);
           
        // }


     

        $page = LandingPage::findOrFail($id);
        $jsonEnCode = json_encode($request->get('data'));
        $jsonDeCode = json_decode($jsonEnCode);    
        $locale = $request->query("lang")?:"ar";

        if ($jsonDeCode->delete === "true") {
            \DB::table('landing_page_translations')
            ->where('landing_page_id', $page->id)->where('locale', $locale)
            ->update(['json_code' => $jsonEnCode, 'lang_status' => 0]);
        return response()->json(["responseCode" => 1, 'responseHTML' => '<h5>Hooray!</h5> <p>The site was saved successfully!</p>', 'page'=> 'is empty']);
           }else{

             \DB::table('landing_page_translations')
            ->where('landing_page_id', $page->id)->where('locale', $locale)
            ->update(['json_code' => $jsonEnCode, 'lang_status' => 1]);

            if($page->blocks()->where('lang', $locale)->count()){
                foreach ($page->blocks()->where('lang', $locale)->get() as $block) {
                    $block->delete();
                }

            
            }

            
            foreach ($jsonDeCode->pages as $key => $value) {
                if ($key == 0) {
                    foreach ($value->blocks as $block) {
                        $blockPage = new LandingBlock;
                        $blockPage->page_id =  $page->id;
                        $blockPage->original_url = $block->frames_original_url?:null;
                        $blockPage->loader_function = $block->frames_loaderFunction?:null;
                        $blockPage->height = $block->frames_height?:null;
                        $blockPage->global = !empty($block->frames_global) ?:false;
                        $blockPage->html_code = $block->frames_html?:null;
                        $blockPage->order = $block->frames_order;
                        $blockPage->lang = $locale;
                        $blockPage->block_style = $block->frames_block_style?:"light";
                        $blockPage->data_type = $block->frames_data_type?:null;
                        $blockPage->is_dynamic =  (boolean)$block->frames_dynamic?:false;
                        $blockPage->product_type = $block->frames_product_type?:null;
                        $blockPage->data_amount = 8;
                        $blockPage->country_id = $block->frames_country?:null;
                        $blockPage->btn_color = $block->frames_btnColor?:null;
                        $blockPage->city_id =  $block->frames_city?:null;
                        $blockPage->category_id = $block->frames_category?:null;
                        $blockPage->stars_num = (int)$block->frames_order_stars;
                        $blockPage->data_featured = 1;
                        $blockPage->status = true;
                        $blockPage->comments_num = $block->frames_order_comment;
                        $blockPage->reviews_num = $block->frames_order_review;
                        $blockPage->visits_num = (int)$block->frames_heigh_visit;
                        $blockPage->last_visit = (int)$block->frames_last_visit;
                        $blockPage->current_visit = (int)$block->frames_visit_now;
                        $blockPage->save();
    
                    }
                }
            }


          return response()->json(["responseCode" => 1, 'responseHTML' => '<h5>Hooray!</h5> <p>The site was saved successfully!</p>']);


           }   
        
            
        

    }

    function ajax_upload(Request $request)
    {

  $file = null;
        $filename = null;
        $file_prefix = "";
        $allowed_extensions = config("settings.allowed_extensions");
        $uploadIAllowed = false;
        $response = [
            'success'  => false,
            'file'     => null,
            'ext'      => null,
            'mimeType' => null,
            'type'     => null,
        ];
        if ($request->input('prefix')) {
            $file_prefix = $request->input('prefix');
        }
        $file_resize = [100, 100];//w×h
        if ($request->input('resize') and is_array($request->input('resize'))) {
            $file_resize = $request->input('resize');
        }

        $file = $request->file('imageFileField');
        $mime = pathinfo($file->getClientMimeType(), PATHINFO_FILENAME);
        $ext = $file->getClientOriginalExtension();
        $filename = Str::lower(
            $file_prefix . str_replace(' ', '-', pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME))
            . '-'
            . uniqid()
            . '.'
            . $ext
        );
        $mime = strtolower($mime);

        if (in_array($mime, $allowed_extensions['images'])) {
            $response['type'] = 'image';
            $uploadIAllowed = true;
        } elseif (in_array($mime, $allowed_extensions['videos'])) {
            $response['type'] = 'video';
            $uploadIAllowed = true;
        } elseif (in_array($mime, $allowed_extensions['documents'])) {
            $response['type'] = 'document';
            $uploadIAllowed = true;
        } else {
            $response['message'] = "Not Allowed File";
            $response['type'] = $mime;
        }

        if ($request->hasFile('imageFileField') && $file->isValid() && $uploadIAllowed) {

            $file->move(config('settings.upload_path'), $filename);


            // check if file is image
            if ($response['type'] == 'image') {
                // resize it
                $thumbnails_dir = config("settings.thumbnails_dir");
                $thumbnails_destination = config('settings.upload_path') . "/$thumbnails_dir/";
                //check if directory exists
                if (!File::exists($thumbnails_destination))
                    File::makeDirectory($thumbnails_destination, 0775);

                $image = Image::make(config('settings.upload_path') . "/" . $filename);

                if ($image->width() >= $file_resize[0] || $image->height() >= $file_resize[1]) {
                    $image->resize($file_resize[0], $file_resize[1]);
                }


                $image->save($thumbnails_destination . $filename);

                $response['success'] = true;
                $response['file'] = $filename;
                $response['ext'] = $ext;
                $response['mimeType'] = $mime;
                $response['small'] = $thumbnails_destination . $filename;


            } elseif ($response['type'] == 'video' || $response['type'] == 'document') {
                $response['success'] = true;
                $response['file'] = $filename;
                $response['ext'] = $ext;
                $response['mimeType'] = $mime;

            } else {
                $response['success'] = true;
                $response['file'] = $filename;
                $response['ext'] = $ext;
                $response['mimeType'] = $mime;
            }

            $response['code'] = 1;
        $response['response'] = "/files/" . $filename;


        }

        return response()->json($response);
    }

    
     function ajax_get_page(Request $request, $id)
    { 
        // if (!Auth::user()->can("show builder")) {
        //   return  response()->json(["success" => false, 'responseHTML' => trans("permissions.permission_denied")]);
           
        // }

        $page = LandingPage::find($id);

        if (!$page) {
            flash(trans("pages.id_not_found"), 'danger');

            return response()->json(["success" => false, 'msg'=> 'Page Not Found']);
        }

        $locale = $request->query("lang")?:null;

           $json_code = DB::table('landing_page_translations')
            ->where('landing_page_id', $page->id)->where('locale', $locale)
            ->first()->json_code;

            $json = $json_code?:"{}";
        


     return response($json);

    }




    


}
