<?php


namespace Corsata\Http\Controllers\backend;

use Corsata\Currency;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Corsata\Http\Requests;
use Corsata\Http\Controllers\backend\BackendBaseController;


class CurrenciesController extends BackendBaseController
{
    function index()
    {
        if (!Auth::user()->can("show currencies")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => "error"]);
        }


        $this->data['data'] = Currency::all();

        return view("backend.currencies.index", $this->data);
    }

    function create()
    {
        if (!Auth::user()->can("create currencies")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => "error"]);
        }
        return view("backend.currencies.create", $this->data);
    }

    function store(Request $request)
    {

        if (!Auth::user()->can("create currencies")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }

        $rules = [];
        $messages = [];

        $rules["name"] = "required|max:255";
        $rules["code"] = "required|max:3|unique:currencies";
        $rules["symbol_left"] = "required_without:symbol_right|max:3";
        $rules["decimal_place"] = "required|numeric|max:8";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $currency = new Currency();
        $currency->name = $request->input("name");
        $currency->code = strtoupper($request->input("code"));
        $currency->symbol_left = $request->input("symbol_left") ?: null;
        $currency->symbol_right = $request->input("symbol_right") ?: null;
        $currency->decimal_place = $request->input("decimal_place") ?: null;
        $currency->status = (bool)$request->input('status');
        if ($currency->save()) {
            return redirect($this->data['backend_uri'] . "/currencies")->with(['message' => trans("currencies.success_created"), "alert-type" => "success"]);
        }
        return redirect()->back()->with(['message' => trans("currencies.error_create"), "alert-type" => "error"]);
    }


    function edit($id = 0)
    {
        if (!Auth::user()->can("edit currencies")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }
        $currency = Currency::find($id);
        if (!$currency) {
            return redirect()->back()->with(['message' => trans("currencies.id_not_found"), 'alert-type' => 'error']);
        }
        $this->data['data'] = $currency;

        return view("backend.currencies.edit", $this->data);
    }


    function update(Request $request, $id = 0)
    {

        if (!Auth::user()->can("edit currencies")) {
            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => 'error']);
        }


        $currency = Currency::find($id);
        if (!$currency) {
            return redirect()->back()->with(['message' => trans("currencies.id_not_found"), 'alert-type' => 'error']);
        }
        $rules = [];
        $messages = [];

        $rules["name"] = "required|max:255";
        $rules["code"] = "required|max:3|unique:currencies,code,{$id}";
        $rules["symbol_left"] = "required_without:symbol_right|max:3";
        $rules["decimal_place"] = "required|numeric|max:8";

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $currency->name = $request->input("name");
        $currency->code = strtoupper($request->input("code"));
        $currency->symbol_left = $request->input("symbol_left") ?: null;
        $currency->symbol_right = $request->input("symbol_right") ?: null;
        $currency->decimal_place = $request->input("decimal_place") ?: null;
        $currency->status = (bool)$request->input('status');
        if ($currency->save()) {
            return redirect($this->data['backend_uri'] . "/currencies")->with(['message' => trans("currencies.success_updated"), "alert-type" => "success"]);
        }
        return redirect()->back()->with(['message' => trans("currencies.error_update"), "alert-type" => "error"]);
    }


    function delete($id = 0)
    {
        if (!Auth::user()->can("delete currencies")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => "error"]);
        }


        $currency = Currency::find($id);
        if (!$currency) {
            return redirect()->back()->with(['message' => trans("currencies.id_not_found"), 'alert-type' => "error"]);
        }

        if ($currency->delete()) {
            return redirect()->back()->with(['message' => trans("currencies.success_deleted"), 'alert-type' => "success"]);
        }

        return redirect()->back()->with(['message' => trans("currencies.error_delete"), 'alert-type' => "error"]);
    }

    function multiDelete(Request $request)
    {

        if (!Auth::user()->can("delete currencies")) {

            return redirect()->back()->with(['message' => trans("permissions.permission_denied"), 'alert-type' => "error"]);
        }


        if ($request->input('items') && is_array($request->input('items'))) {
            $deleted = 0;
            foreach ($request->input('items') as $id) {
                $currency = Currency::find($id);
                if ($currency && $currency->delete()) {
                    $deleted++;
                }
            }
            return redirect()->back()->with(['message' => trans("currencies.success_multi_delete", ['count' => $deleted]), 'alert-type' => "success"]);
        }
        return redirect()->back()->with(['message' => trans("currencies.error_multi_delete_empty"), 'alert-type' => "warning"]);

    }

    function updateRates()
    {
        $currencies = new Currency();
        $update = $currencies->updateRates();
        if ($update === false) {

            return redirect()->back()->with(['message' => trans('currencies.no_currencies_found_to_update'), 'alert-type' => 'error']);
        } elseif ($update === 0) {
            return redirect()->back()->with(['message' => trans('currencies.no_rates_changes'), 'alert-type' => 'warning']);
        } else {
            return redirect()->back()->with(['message' => trans('currencies.rates_updated_success', ['count' => $update]), 'alert-type' => 'success']);
        }

    }


}
