<?php

namespace Corsata\Http\Controllers;

use Corsata\Category;
use Corsata\LandingPage;
use Corsata\LandingBlock;
use Corsata\Media;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Corsata\Http\Requests;

class PageBuilderController extends Controller
{
    function index()
    {

    }



    function ajax_store(Request $request, $id)
    { 
        $frames_height = [];

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

            foreach ($jsonDeCode->pages as $key => $value) {
                if ($key == 0) {
                    foreach ($value->blocks as $block) {
                       $frames_height = $block->frames_order;
                    }
                }
            }


          return response()->json(["responseCode" => 1, 'responseHTML' => '<h5>Hooray!</h5> <p>The site was saved successfully!</p>', 'page'=> $frames_height]);


           }   
        
            
        

    }

    
     function ajax_get_page(Request $request, $id)
    { 

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




    function store(Request $request)
    {

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("pages.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["slug"] = "required|max:255|unique:pages,slug";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $page = new Page();
        $page->slug = str_slug($request->input('slug'));
        $page->icon_class = $request->input('icon')?:null;
        $page->in_menu = (boolean)$request->input('in_menu');
        $page->status = (boolean)$request->input('status');

        if ($request->input('photo')) {
            $page->photo = $request->input('photo');
        }


        if ($page->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $page->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $page->translateOrNew($locale)->content = $request->input('content.' . $locale);
                $page->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $page->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $page->save();

            if ($request->input("gallery") and is_array($request->input("gallery"))) {
                $gallery = [];
                foreach ($request->input("gallery") as $image) {

                    $upload_dir = config("settings.upload_dir");
                    $upload_path = config("settings.upload_path");

                    if (Storage::disk("public")->exists($upload_dir . "/$image")) {
                        $ext = File::extension($upload_path . "/$image");
                        $mim = File::mimeType($upload_path . "/$image");
                        $gallery[] = [
                            'title'     => $image,
                            'name'      => $image,
                            'full_path' => Storage::url($upload_dir . "/$image"),
                            'extension' => $ext,
                            'mime_type' => $mim,
                            'module'    => 'pages',
                            'key'       => 'page-gallery',
                            'module_id' => $page->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

//        return redirect($this->data['backend_uri'] . "/pages")->with(['message' => trans("pages.success_created"), 'alert-type' => 'success']);
        return redirect()->back()->with(['message' => trans("pages.success_created"), 'alert-type' => 'success']);


    }





    function edit($id = 0)
    {
        if (!Auth::user()->can("edit pages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $page = Page::find($id);
        if (!$page) {
            flash(trans("pages.id_not_found"), 'danger');

            return redirect()->back();
        }

        $this->data['page_title'] = trans("pages.backend_page_title");
        $this->data['page_header'] = trans("pages.backend_page_create_header");
        $this->data['data'] = $page;

        return view("backend.pages.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit pages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $page = Page::find($id);
        if (!$page) {

            return redirect()->back()->with(['message' => trans("pages.id_not_found"), 'alert-type' => 'error']);
        }

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("pages.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["slug"] = "required|max:255|min:3|unique:pages,slug,{$id}";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $page->slug = str_slug($request->input('slug'));
        $page->icon_class = $request->input('icon')?:null;
        $page->in_menu = (boolean)$request->input('in_menu');
        $page->status = (boolean)$request->input('status');

        if ($request->input('photo')) {
            $page->photo = $request->input('photo');
        }


        if ($page->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $page->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $page->translateOrNew($locale)->content = $request->input('content.' . $locale);
                $page->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $page->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $page->save();

            if ($request->input("gallery") and is_array($request->input("gallery"))) {
                $gallery = [];
                foreach ($request->input("gallery") as $image) {

                    $upload_dir = config("settings.upload_dir");
                    $upload_path = config("settings.upload_path");

                    if (Storage::disk("public")->exists($upload_dir . "/$image")) {
                        $ext = File::extension($upload_path . "/$image");
                        $mim = File::mimeType($upload_path . "/$image");
                        $gallery[] = [
                            'title'     => $image,
                            'name'      => $image,
                            'full_path' => Storage::url($upload_dir . "/$image"),
                            'extension' => $ext,
                            'mime_type' => $mim,
                            'module'    => 'pages',
                            'key'       => 'page-gallery',
                            'module_id' => $page->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

//        return redirect($this->data['backend_uri'] . "/pages")->with(['message' => trans("pages.success_updated"), 'alert-type' => 'success']);
        return redirect()->back()->with(['message' => trans("pages.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete pages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $page = Page::find($id);
        if (!$page) {
            return redirect()->back()->with(['message' => trans("pages.id_not_found"), 'alert-type' => 'error']);
        }

        // get Page photos
        $defaultPhoto = $page->photo;
        $gallery = $page->gallery;

        if ($page->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("pages.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("pages.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete pages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $page = Page::find($id);

                if ($page) {
                    $defaultPhoto = $page->photo;
                    $gallery = $page->gallery;

                    if ($page->delete()) {
                        $uploader = new UploaderController();
                        $uploader->delete($defaultPhoto);
                        // delete photos from storage and database
                        if ($gallery) {
                            foreach ($gallery as $file) {

                                $uploader->delete($file->name);
                            }
                        }
                    }

                    $deleted++;
                }
            }

            return redirect()->back()->with(["message" => trans("pages.success_multi_delete", ['count' => $deleted]), "alert-type" => "success"]);
        }

        return redirect()->back()->with(["message" => trans("pages.error_multi_delete_empty"), "alert-type" => "error"]);

    }


}
