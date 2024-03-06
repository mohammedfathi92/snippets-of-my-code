<?php

namespace Corsata\Http\Controllers\backend;

use Corsata\Category;
use Corsata\Article;
use Corsata\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;

use Corsata\Http\Requests;
use Corsata\Http\Controllers\backend\BackendBaseController;

class ArticlesController extends BackendBaseController
{
    function index()
    {

        if (!Auth::user()->can("show articles")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("articles.backend_page_title");
        $this->data['page_header'] = trans("articles.backend_page_header");
        $this->data['data'] = Article::all();

        return view("backend.articles.index", $this->data);
    }

    function category($id = 0)
    {

        if (!Auth::user()->can("show articles")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $category = Category::find($id);
        if (!$category) {
            return redirect()->back()->with(['message' => trans("categories.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['category'] = $category;
        $this->data['data'] = $category->articles;

        return view("backend.articles.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create articles")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $this->data['page_title'] = trans("articles.backend_page_title");
        $this->data['page_header'] = trans("articles.backend_page_create_header");
        return view("backend.articles.create", $this->data);
    }

    function store(Request $request)
    {

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("articles.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["category"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $article = new Article();
        $article->in_home = (boolean)$request->input('in_home');
        $article->status = (boolean)$request->input('status');
        $article->category_id = (int)$request->input('category');

        if ($request->input('photo')) {
            $article->photo = $request->input('photo');
        }


        if ($article->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $article->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $article->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $article->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $article->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $article->save();

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
                            'module'    => 'articles',
                            'key'       => 'article-gallery',
                            'module_id' => $article->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

        return redirect($this->data['backend_uri'] . "/articles")->with(['message' => trans("articles.success_created"), 'alert-type' => 'success']);


    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit articles")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $article = Article::find($id);
        if (!$article) {
            flash(trans("articles.id_not_found"), 'danger');

            return redirect()->back();
        }

        $this->data['page_title'] = trans("articles.backend_page_title");
        $this->data['page_header'] = trans("articles.backend_page_create_header");
        $this->data['data'] = $article;

        return view("backend.articles.edit", $this->data);
    }

    function update(Request $request, $id = 0)
    {
        if (!Auth::user()->can("edit articles")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $article = Article::find($id);
        if (!$article) {

            return redirect()->back()->with(['message' => trans("articles.id_not_found"), 'alert-type' => 'error']);
        }

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["name.$locale"] = "required|max:255";
            $rules["meta_keywords.$locale"] = "max:255";
            $rules["meta_description.$locale"] = "max:255";
            $messages["name.$locale.required"] = trans("articles.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $rules["category"] = "required";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $article->in_home = (boolean)$request->input('in_home');
        $article->status = (boolean)$request->input('status');
        $article->category_id = (int)$request->input('category');

        if ($request->input('photo')) {
            $article->photo = $request->input('photo');
        }


        if ($article->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $article->translateOrNew($locale)->name = $request->input('name.' . $locale);
                $article->translateOrNew($locale)->description = $request->input('description.' . $locale);
                $article->translateOrNew($locale)->meta_keywords = $request->input('meta_keywords.' . $locale);
                $article->translateOrNew($locale)->meta_description = $request->input('meta_description.' . $locale);
            }

            $article->save();

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
                            'module'    => 'articles',
                            'key'       => 'article-gallery',
                            'module_id' => $article->id,
                        ];
                    }

                }

                Media::insert($gallery);
            }
        }

        return redirect($this->data['backend_uri'] . "/articles")->with(['message' => trans("articles.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $id = 0)
    {
        if (!Auth::user()->can("delete articles")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $article = Article::find($id);
        if (!$article) {
            return redirect()->back()->with(['message' => trans("articles.id_not_found"), 'alert-type' => 'error']);
        }

        // get Article photos
        $defaultPhoto = $article->photo;
        $gallery = $article->gallery;

        if ($article->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);
            // delete photos from storage and database
            if ($gallery) {

                foreach ($gallery as $file) {
                    $uploader->delete($file->name);
                }
            }

            return redirect()->back()->with(['message' => trans("articles.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("articles.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete articles")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $article = Article::find($id);

                if ($article) {
                    $defaultPhoto = $article->photo;
                    $gallery = $article->gallery;

                    if ($article->delete()) {
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

            return redirect()->back()->with(["message" => trans("articles.success_multi_delete", ['count' => $deleted]), "alert-type" => "success"]);
        }

        return redirect()->back()->with(["message" => trans("articles.error_multi_delete_empty"), "alert-type" => "error"]);

    }


}
