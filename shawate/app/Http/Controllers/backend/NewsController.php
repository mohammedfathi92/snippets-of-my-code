<?php

namespace App\Http\Controllers\backend;

use App\News;
use App\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\backend\BackendBaseController;

class NewsController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show news")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("news.backend_page_title");
        $this->data['page_header'] = trans("news.backend_page_header");
        $this->data['data'] = News::all();

        return view("backend.news.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create news")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("news.backend_page_title");
        $this->data['page_header'] = trans("news.backend_page_create_header");
        return view("backend.news.create", $this->data);
    }

    function store(Request $request)
    {

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("news.validation_name_locale_required", ['locale' => $properties['native']]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $news = new News();
        $news->in_home = (boolean)$request->input('in_home');
        $news->status = (boolean)$request->input('status');

        if ($request->input('photo')) {
            $news->photo = $request->input('photo');
        }


        if ($news->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $news->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $news->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $news->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $news->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $news->save();

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
                            'module'    => 'news',
                            'key'       => 'news-gallery',
                            'module_id' => $news->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

        return redirect($this->data['backend_uri'] . "/news")->with(['message' => trans("news.success_created"), 'alert-type' => 'success']);


    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit news")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $news = News::find($id);
        if (!$news) {
            return redirect()->back()->with(['message' => trans("news.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("news.backend_page_title");
        $this->data['page_header'] = trans("news.backend_page_create_header");
        $this->data['data'] = $news;

        return view("backend.news.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit news")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $news = News::find($id);
        if (!$news) {

            return redirect()->back()->with(['message' => trans("news.id_not_found"), 'alert-type' => 'error']);
        }

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("news.validation_name_locale_required", ['locale' => $properties['native']]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $news->in_home = (boolean)$request->input('in_home');
        $news->status = (boolean)$request->input('status');

        if ($request->input('photo')) {
            $news->photo = $request->input('photo');
        }


        if ($news->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $news->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $news->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $news->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $news->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $news->save();

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
                            'module'    => 'news',
                            'key'       => 'news-gallery',
                            'module_id' => $news->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

        return redirect($this->data['backend_uri'] . "/news")->with(['message' => trans("news.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete news")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $news = News::find($id);
        if (!$news) {
            return redirect()->back()->with(['message' => trans("news.id_not_found"), 'alert-type' => 'error']);
        }

        // get News photos
        $defaultPhoto = $news->photo;
        $gallery = $news->gallery;

        if ($news->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("news.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("news.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete news")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $news = News::find($id);

                if ($news) {
                    $defaultPhoto = $news->photo;
                    $gallery = $news->gallery;

                    if ($news->delete()) {
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

            return redirect()->back()->with(["message" => trans("news.success_multi_delete", ['count' => $deleted]), "alert-type" => "success"]);
        }

        return redirect()->back()->with(["message" => trans("news.error_multi_delete_empty"), "alert-type" => "error"]);

    }


}
