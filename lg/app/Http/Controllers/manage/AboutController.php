<?php

namespace App\Http\Controllers\manage;

use App\About;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Validator;
use Laracasts\Flash\Flash;

class AboutController extends ManageController
{
    function index()
    {
        $about = About::first();
        $this->data['page_title'] = $about->title;
        $this->data['page_header'] = $about->title;
        $this->data['data'] = $about;

        return view("manage.about.edit", $this->data);
    }

    function store(Request $request)
    {
        $rules = [
            'title.ar' => "required|max:255",
            'title.en' => "required|max:255",
            'body.ar' => "required",
            'body.en' => "required",
        ];
        $messages = [
            'title.ar.required' => trans("about.validation_arabic_title_required"),
            'title.en.required' => trans("about.validation_english_title_required"),
            'title.ar.max' => trans("about.validation_title_max", ['max' => 255]),
            'title.en.max' => trans("about.validation_title_max", ['max' => 255]),
            'body.ar.required' => trans("about.validation_arabic_body_required"),
            'body.en.required' => trans("about.validation_english_body_required"),
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect('manage/about')
                ->withErrors($validator)
                ->withInput();
        }

        $about = About::first();
        $about->updated_by = Auth::user()->id;
        $about->save();
        foreach (['ar', 'en'] as $locale) {
            $about->translateOrNew($locale)->title = $request->input("title.$locale");
            $about->translateOrNew($locale)->body = $request->input("body.$locale");
        }
        $about->save();
        flash(trans("about.success_page_updated"), "success");
        return redirect()->back();
    }
}
