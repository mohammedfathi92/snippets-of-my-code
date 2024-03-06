<?php

namespace Sirb\Http\Controllers\backend;

use Sirb\Page;
use Sirb\Tab;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;
use Sirb\Http\Requests;

class PagesTabsController extends BackendBaseController
{
    function index($page_id = 0)
    {
        if (!Auth::user()->can("show pages")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $page = Page::find($page_id);

        if (!$page) {

            return redirect()->back()->with(['message' => trans("pages.id_not_found"), 'alert-type' => 'error']);
        }
        $this->data['page'] = $page;
        $this->data['page'] = $page;

        $this->data['method'] = "post";

        return view("backend.pages.tabs.index", $this->data);
    }

    function create($page_id = 0)
    {
        if (!Auth::user()->can("create pages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $page = Page::find($page_id);

        if (!$page) {

            return redirect()->back()->with(['message' => trans("pages.id_not_found"), 'alert-type' => 'error']);
        }
        $this->data['page'] = $page;

        $this->data['method'] = "post";

        return view("backend.pages.tabs.index", $this->data);
    }

    function store(Request $request, $page_id = 0)
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
        $tab->module_id = $page_id;
        $tab->key = "page-tab";

        if ($tab->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $tab->translateOrNew($locale)->title = $request->input('title.' . $locale);
                $tab->translateOrNew($locale)->description = $request->input('description.' . $locale);
            }

            $tab->save();
        }

//        return redirect($this->data['backend_uri'] . "/pages/$page_id/tabs")->with(['message' => trans("pages.tabs.success_created"), 'alert-type' => 'success']);
        return redirect()->back()->with(['message' => trans("pages.tabs.success_created"), 'alert-type' => 'success']);
    }

    function edit($page_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit pages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $tab = Tab::find($id);
        if (!$tab) {

            return redirect()->back()->with(['message' => trans("pages.tabs.id_not_found"), 'alert-type' => 'error']);
        }


        $page = Page::find($page_id);

        if (!$page) {

            return redirect()->back()->with(['message' => trans("pages.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['page'] = $page;

        $this->data['data'] = $tab;
        $this->data['method'] = 'put';

        return view("backend.pages.tabs.index", $this->data);
    }

    function update(Request $request, $page_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit pages")) {
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
        $tab->module_id = $page_id;
        $tab->key = "page-tab";

        if ($tab->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $tab->translateOrNew($locale)->title = $request->input('title.' . $locale);
                $tab->translateOrNew($locale)->description = $request->input('description.' . $locale);
            }

            $tab->save();

        }
//        return redirect($this->data['backend_uri'] . "/pages/$page_id/tabs")
        return redirect()->back()->with(['message' => trans("pages.tabs.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request, $page_id = 0, $id = 0)
    {
        if (!Auth::user()->can("delete pages")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $tab = Tab::find($id);
        if (!$tab) {

            return redirect()->back()->with(['message' => trans("pages.tabs.id_not_found"), 'alert-type' => 'error']);
        }


        $page = Page::find($page_id);

        if (!$page) {

            return redirect()->back()->with(['message' => trans("pages.id_not_found"), 'alert-type' => 'error']);
        }

        // get service photos
        $defaultPhoto = $tab->photo;

        if ($tab->delete()) {
            $uploader = new UploaderController();
            $uploader->delete($defaultPhoto);

//            return redirect("/" . $this->data['backend_uri'] . "/pages/$page_id/tabs")->with(['message' => trans("pages.tabs.success_deleted"), 'alert-type' => 'success']);
            return redirect()->back()->with(['message' => trans("pages.tabs.success_deleted"), 'alert-type' => 'success']);
        }
//        return redirect("/" . $this->data['backend_uri'] . "/pages/$page_id/tabs")->with(['message' => trans("pages.tabs.error_delete"), 'alert-type' => 'error']);
        return redirect()->back()->with(['message' => trans("pages.tabs.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete pages")) {
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


            return redirect()->back()->with(['message' => trans("pages.tabs.success_multi_delete", ['count' => $deleted]), 'alert-type' => "success"]);
        }

        return redirect()->back()->with(['message' => trans("pages.tabs.error_multi_delete_empty"), 'alert-type' => "warning"]);

    }
}
