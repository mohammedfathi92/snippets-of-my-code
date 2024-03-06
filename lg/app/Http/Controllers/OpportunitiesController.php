<?php

namespace App\Http\Controllers;

use App\Category;
use App\Opportunity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Validator;

class OpportunitiesController extends Controller
{

    function index()
    {

        $this->data['page_title'] = trans("opportunities.page_title");
        $this->data['page_header'] = trans("opportunities.page_header");
        $this->data['data'] = Auth::user()->opportunities()->paginate(15);
        return view("opportunities.index", $this->data);
    }

    function show(Request $request, $id = 0)
    {
        $opportunity = Opportunity::with("products")->find($id);

        if (!$opportunity) return abort(404);

        if (!$opportunity->user_id == Auth::user()->id && Auth::user()->permission > 1) {
            return redirect("opportunities")->withErrors(trans("opportunities.permission_denied"));
        }


        $this->data['page_title'] = trans("opportunities.page_title");
        $this->data['page_header'] = trans("opportunities.page_header");
        $this->data['data'] = $opportunity;
        return view("opportunities.show", $this->data);
    }

    function cancel(Request $request, $id = 0)
    {
        $opportunity = Opportunity::find($id);

        if (!$opportunity) return abort(404);

        if (!$opportunity->user_id == Auth::user()->id && Auth::user()->permission > 1) {
            return redirect("opportunities")->withErrors(trans("opportunities.permission_denied"));
        }

        $opportunity->status = 3;
        $opportunity->status_changed_by = Auth::user()->id;
        $opportunity->updated_by = Auth::user()->id;
        $opportunity->save();
        flash(trans("opportunities.closed_successfully"), "success");
        return redirect("opportunities");


    }

    function progress(Request $request, $id = 0)
    {
        $opportunity = Opportunity::find($id);

        if (!$opportunity) return abort(404);

        if ((!$opportunity->user_id == Auth::user()->id && Auth::user()->permission > 1) || $opportunity->status !== 1) {
            return redirect("opportunities")->withErrors(trans("opportunities.permission_denied"));
        }

        if ($request->input('_action') == 'close' || (int)$request->input('progress') >= 100) {
            return $this->close($request, $id);
        }

        $opportunity->progress = $request->input("progress");
        $opportunity->updated_by = Auth::user()->id;
        $opportunity->save();
        flash(trans("opportunities.updated_successfully"), "success");
        return redirect("opportunities");


    }

    function close(Request $request, $id = 0)
    {
        $opportunity = Opportunity::find($id);

        if (!$opportunity) return abort(404);

        if (!$opportunity->user_id == Auth::user()->id && Auth::user()->permission > 1) {
            return redirect("opportunities")->withErrors(trans("opportunities.permission_denied"));
        }

        if ((int)$request->input("progress") < 100) {
            return redirect()->back()->withErrors(trans("opportunities.error_progress_not_completed_to_close"));
        }

        if (!$request->has("photo") || !$request->input('photo')) {
            return redirect()->back()->withErrors(trans("opportunities.error_close_prove_document_required"));
        }

        $opportunity->close_attachments = \GuzzleHttp\json_encode($request->input("photo"));
        $opportunity->status = 2;
        $opportunity->progress = 100;
        $opportunity->status_changed_by = Auth::user()->id;
        $opportunity->updated_by = Auth::user()->id;
        $opportunity->save();
        flash(trans("opportunities.closed_successfully"), "success");
        return redirect("opportunities");


    }

    function create()
    {
        $this->data['page_title'] = trans("opportunities.page_title");
        $this->data['page_header'] = trans("opportunities.page_header");
        $this->data['categories'] = Category::all();
        return view("opportunities.create", $this->data);
    }

    function store(Request $request)
    {

        $now = date("d-m-Y");
        $rules = [
            'client'     => "required|max:255",
            'info'       => "required|max:300",
            'categories' => "required",
            'products'   => "required",
            'quantity'   => "required|min:1",
            'deliver_at' => "required|date|after:$now",

        ];
        $inputs = [
            'client'     => $request->input("client"),
            'info'       => $request->input("info"),
            'deliver_at' => $request->input("deliver_at"),
            'categories' => $request->input("categories"),
            'products'   => $request->input("products"),
            'quantity'   => $request->input("quantity"),
            'price'      => $request->input("price"),
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->messages()->toJson()]);
        }

        $total_price = 0;
        if ($inputs['price']) {
            foreach ($inputs['price'] as $i => $price) {
                $total_price += $price * $inputs['quantity'][$i];
            }
        }

        $opportunity = new Opportunity();
        $opportunity->client_name = $inputs['client'];
        $opportunity->details = $inputs['info'];
        $opportunity->deliver_at = date("Y-m-d", strtotime($inputs['deliver_at']));
        $opportunity->user_id = Auth::user()->id;
        $opportunity->updated_by = Auth::user()->id;
        $opportunity->status = 0;
        $opportunity->total_price = $total_price;
        if ($opportunity->save()) {
            // save opportunity products
            if ($inputs['products']) {
                foreach ($inputs['products'] as $k => $product) {
                    $opportunity->products()->attach($product,
                        ['category_id' => $inputs['categories'][$k],
                         'quantity'    => $inputs['quantity'][$k],
                         'price'       => $inputs['price'][$k]]);
                }
            }
        }

        flash(trans("opportunities.created_successfully"), 'success');
        return response()->json(['success' => true, 'redirect' => "/", 'message' => trans("opportunities.created_successfully")]);


    }

    function postUpload(Request $request)
    {

        $photo = null;
        $filename = null;
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $photo = $request->file('file');

            $filename = Str::lower(
                "confirmation-" . str_replace(' ', '-', pathinfo($photo->getClientOriginalName(), PATHINFO_FILENAME))
                . '-'
                . uniqid()
                . '.'
                . $photo->getClientOriginalExtension()
            );
            $photo->move(config('settings.upload_path'), $filename);
            $small = Image::make(config('settings.upload_path') . "/" . $filename);
            $small->resize(100, 100);
            $small_destination = config('settings.upload_path') . '/small/';
            $small->save($small_destination . "/" . $filename);
            return response()->json(['success' => true, 'file' => $filename, 'small' => $small_destination . "/" . $filename]);
        }

        return response()->json(['success' => false, "message" => "No files selected to upload!"]);
    }

}
