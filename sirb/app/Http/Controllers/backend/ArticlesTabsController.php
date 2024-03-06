<?php

namespace Sirb\Http\Controllers\backend;

use Sirb\Article;
use Sirb\Http\Requests;
use Sirb\Tab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;

//use Sirb\Http\Controllers\backend\BackendBaseController;

class ArticlesTabsController extends BackendBaseController
{
    function index($article_id = 0)
    {
        if (!Auth::user()->can("show articles")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $article = Article::find($article_id);

        if (!$article) {

            return redirect()->back()->with(['message' => trans("articles.id_not_found"), 'alert-type' => 'error']);
        }
        $this->data['article'] = $article;
        $this->data['article'] = $article;
        $this->data['method'] = "post";

        return view("backend.articles.tabs.index", $this->data);
    }

    function create($article_id = 0)
    {
        if (!Auth::user()->can("create articles")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $article = Article::find($article_id);

        if (!$article) {

            return redirect()->back()->with(['message' => trans("articles.id_not_found"), 'alert-type' => 'error']);
        }
        $this->data['article'] = $article;

        $this->data['method'] = "post";

        return view("backend.articles.tabs.index", $this->data);
    }

    function store(Request $request, $article_id = 0)
    {
        $rules = [];
        $messages = [];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["title.$locale"] = "required|max:255";
            $messages["title.$locale.required"] = trans("tabs.validation_name_locale_required", ['locale' => $properties['native']]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tab = new Tab();

        $tab->photo = $request->input('photo') ?: null;
        $tab->sort = (int)$request->input('sort') ?: 1;
        $tab->module_id = $article_id;
        $tab->key = "article-tab";

        if ($tab->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $tab->translateOrNew($locale)->title = $request->input('title.' . $locale);
                $tab->translateOrNew($locale)->description = $request->input('description.' . $locale);
            }

            $tab->save();
        }

//        return redirect($this->data['backend_uri'] . "/articles/$article_id/tabs")->with(['message' => trans("articles.tabs.success_created"), 'alert-type' => 'success']);
        return redirect()->back()->with(['message' => trans("articles.tabs.success_created"), 'alert-type' => 'success']);
    }

    function edit($article_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit articles")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $tab = Tab::find($id);
        if (!$tab) {

            return redirect()->back()->with(['message' => trans("articles.tabs.id_not_found"), 'alert-type' => 'error']);
        }


        $article = Article::find($article_id);

        if (!$article) {

            return redirect()->back()->with(['message' => trans("articles.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['article'] = $article;

        $this->data['data'] = $tab;
        $this->data['method'] = 'put';

        return view("backend.articles.tabs.index", $this->data);
    }

    function update(Request $request, $article_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit articles")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $rules = [];
        $messages = [];

        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["title.$locale"] = "required|max:255";
            $messages["title.$locale.required"] = trans("tabs.validation_name_locale_required", ['locale' => $properties['native']]);
        }
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tab = Tab::find($id);

        $tab->photo = $request->input('photo') ?: $request->input("old_photo") ?: null;
        $tab->sort = (int)$request->input('sort') ?: 1;
        $tab->module_id = $article_id;
        $tab->key = "article-tab";

        if ($tab->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $tab->translateOrNew($locale)->title = $request->input('title.' . $locale);
                $tab->translateOrNew($locale)->description = $request->input('description.' . $locale);
            }

            $tab->save();

        }
        /*return redirect($this->data['backend_uri'] . "/articles/$article_id/tabs")
            ->with(['message' => trans("articles.tabs.success_updated"), 'alert-type' => 'success']);
       */
        return redirect()->back()->with(['message' => trans("articles.tabs.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $article_id = 0, $id = 0)
    {
        if (!Auth::user()->can("delete articles")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $tab = Tab::find($id);
        if (!$tab) {

            return redirect()->back()->with(['message' => trans("articles.tabs.id_not_found"), 'alert-type' => 'error']);
        }


        $article = Article::find($article_id);

        if (!$article) {

            return redirect()->back()->with(['message' => trans("articles.id_not_found"), 'alert-type' => 'error']);
        }

        // get service photos
        $defaultPhoto = $tab->photo;

        if ($tab->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);

            //return redirect("/" . $this->data['backend_uri'] . "/articles/$article_id/tabs")->with(['message' => trans("articles.tabs.success_deleted"), 'alert-type' => 'success']);
            return redirect()->back()->with(['message' => trans("articles.tabs.success_deleted"), 'alert-type' => 'success']);
        }
            //        return redirect("/" . $this->data['backend_uri'] . "/articles//$article_id/tabs")->with(['message' => trans("articles.tabs.error_delete"), 'alert-type' => 'error']);
            return redirect()->back()->with(['message' => trans("articles.tabs.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete articles")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $tab = Tab::find($id);

                if ($tab) {
                    $defaultPhoto = $tab->photo;
                    if ($tab->delete()) {
                        $uploader = new UploaderController();
                        $uploader->delete($defaultPhoto);
                        // delete photos from storage and database
                    }

                    $deleted++;
                }
            }


            return redirect()->back()->with(['message' => trans("articles.tabs.success_multi_delete", ['count' => $deleted]), 'alert-type' => "success"]);
        }

        return redirect()->back()->with(['message' => trans("articles.tabs.error_multi_delete_empty"), 'alert-type' => "warning"]);

    }
}
