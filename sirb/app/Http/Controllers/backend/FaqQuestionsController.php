<?php

namespace Sirb\Http\Controllers\backend;

use Sirb\FAQ;
use Sirb\FaqQuestion;
use Illuminate\Support\Facades\Auth;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Validator;
use Illuminate\Http\Request;
use Sirb\Http\Requests;
use Sirb\Http\Controllers\backend\BackendBaseController;

class FaqQuestionsController extends BackendBaseController
{
    function index($category_id = 0)
    {

        if (!Auth::user()->can("show faq")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $category = FAQ::find($category_id);

        if (!$category) {
            return redirect()->back()->with(['message' => trans("faq.id_not_found"), 'alert-type' => 'error']);
        }

        $this->data['category'] = $category;
        $this->data['data'] = $category->questions;

        return view("backend.faq.questions.index", $this->data);
    }

    function create($category_id = 0)
    {
        if (!Auth::user()->can("create faq")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $category = FAQ::find($category_id);

        if (!$category) {
            return redirect()->back()->with(['message' => trans("faq.id_not_found"), 'alert-type' => 'error']);
        }


        $this->data['page_title'] = trans("faqQuestions.backend_page_title");
        $this->data['page_header'] = trans("faqQuestions.backend_page_create_header");

        $this->data['category'] = $category;
        return view("backend.faq.questions.create", $this->data);
    }

    function store(Request $request, $category_id = 0)
    {
        $category = FAQ::find($category_id);

        if (!$category) {
            return redirect()->back()->with(['message' => trans("faq.id_not_found"), 'alert-type' => 'error']);
        }
        $rules = [];
        $messages = [];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["question.$locale"] = "required|max:255";
            $rules["answer.$locale"] = "required";
            $messages["question.$locale.required"] = trans("faqQuestions.validation_question_locale_required", ['locale' => $properties['native']]);
            $messages["answer.$locale.required"] = trans("faqQuestions.validation_answer_locale_required", ['locale' => $properties['native']]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $question = new FaqQuestion();
        $question->sort = (int)$request->input('sort') ?: 1;
        $question->status = (boolean)$request->input('status');
        $question->category_id = $category->id;

        if ($question->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $question->translateOrNew($locale)->question = $request->input('question.' . $locale);
                $question->translateOrNew($locale)->answer = $request->input('answer.' . $locale);
            }
            $question->save();
        }

//        return redirect($this->data['backend_uri'] . "/faq/{$category->id}/questions")->with(['message' => trans("faqQuestions.success_created"), 'alert-type' => 'success']);
        return redirect()->back()->with(['message' => trans("faqQuestions.success_created"), 'alert-type' => 'success']);
    }


    function edit($category_id=0,$id = 0)
    {
        if (!Auth::user()->can("edit faq")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $category = FAQ::find($category_id);

        if (!$category) {
            return redirect()->back()->with(['message' => trans("faq.id_not_found"), 'alert-type' => 'error']);
        }


        $question = FaqQuestion::find($id);
        if (!$question) {
            return redirect()->back()->with(['message' => trans("faqQuestions.id_not_found"), 'alert-type' => 'error']);
        }
        $this->data['data'] = $question;

        return view("backend.faq.questions.edit", $this->data);
    }

    function update(Request $request, $category_id = 0, $id = 0)
    {
        if (!Auth::user()->can("edit faq")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $category = FAQ::find($category_id);

        if (!$category) {
            return redirect()->back()->with(['message' => trans("faq.id_not_found"), 'alert-type' => 'error']);
        }

        $question = FaqQuestion::find($id);
        if (!$question) {

            return redirect()->back()->with(['message' => trans("faqQuestions.id_not_found"), 'alert-type' => 'error']);
        }

        $rules = [];
        $messages = [];
        foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
            $rules["question.$locale"] = "required|max:255";
            $rules["answer.$locale"] = "required";
            $messages["question.$locale.required"] = trans("faqQuestions.validation_question_locale_required", ['locale' => $properties['native']]);
            $messages["answer.$locale.required"] = trans("faqQuestions.validation_answer_locale_required", ['locale' => $properties['native']]);
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $question->sort = (int)$request->input('sort') ?: 1;
        $question->status = (boolean)$request->input('status');
        $question->category_id = $category->id;

        if ($question->save()) {

            foreach (LaravelLocalization::getSupportedLocales() as $locale => $properties) {
                $question->translateOrNew($locale)->question = $request->input('question.' . $locale);
                $question->translateOrNew($locale)->answer = $request->input('answer.' . $locale);
            }
            $question->save();
        }

//        return redirect($this->data['backend_uri'] . "/faq/$category->id/questions")->with(['message' => trans("faqQuestions.success_updated"), 'alert-type' => 'success']);
        return redirect()->back()->with(['message' => trans("faqQuestions.success_updated"), 'alert-type' => 'success']);


    }

    function delete(Request $request,$category_id=0, $id = 0)
    {
        if (!Auth::user()->can("delete faq")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $category = FAQ::find($category_id);

        if (!$category) {
            return redirect()->back()->with(['message' => trans("faq.id_not_found"), 'alert-type' => 'error']);
        }

        $question = FaqQuestion::find($id);
        if (!$question) {
            return redirect()->back()->with(['message' => trans("faqQuestions.id_not_found"), 'alert-type' => 'error']);
        }


        if ($question->delete()) {

            return redirect()->back()->with(['message' => trans("faqQuestions.success_deleted"), 'alert-type' => 'success']);
        }
        return redirect()->back()->with(['message' => trans("faqQuestions.error_delete"), 'alert-type' => 'error']);

    }

    function multiDelete(Request $request)
    {
        if (!Auth::user()->can("delete faq")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $category = FaqQuestion::find($id);

                if ($category) {

                    if ($category->delete()) {
                        $deleted++;
                    }


                }
            }

            return redirect()->back()->with(["message" => trans("faqQuestions.success_multi_delete", ['count' => $deleted]), "alert-type" => "success"]);
        }

        return redirect()->back()->with(["message" => trans("faqQuestions.error_multi_delete_empty"), "alert-type" => "error"]);

    }


}
