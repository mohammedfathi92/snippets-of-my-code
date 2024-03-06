<?php

namespace App\Http\Controllers\backend;

use App\Category;
use App\Page;
use App\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\backend\BackendBaseController;

class PagesController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show pages")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("pages.backend_page_title");
        $this->data['page_header'] = trans("pages.backend_page_header");

        return view("backend.pages.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create pages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("pages.backend_page_title");
        $this->data['page_header'] = trans("pages.backend_page_create_header");
        return view("backend.pages.create", $this->data);
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

        return redirect($this->data['backend_uri'] . "/pages")->with(['message' => trans("pages.success_created"), 'alert-type' => 'success']);


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

        return redirect($this->data['backend_uri'] . "/pages")->with(['message' => trans("pages.success_updated"), 'alert-type' => 'success']);


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
