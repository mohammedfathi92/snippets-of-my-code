<?php

namespace App\Http\Controllers\manage;

use App\Category;
use App\Events\OpportunityCanceled;
use App\Events\OpportunityClosed;
use App\Events\OpportunityLead;
use App\Events\OpportunityProgressUpdated;
use Event;
use App\Opportunity;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class OpportunitiesController extends ManageController
{

    function index()
    {

        $this->data['page_title'] = trans("opportunities.page_title");
        $this->data['page_header'] = trans("opportunities.page_header");
        $this->data['data'] = Opportunity::latest()->paginate(15);
        return view("manage.opportunities.index", $this->data);
    }

    function show(Request $request, $id = 0)
    {
        $opportunity = Opportunity::with("products")->where("id", $id)->first();

        if (!$opportunity) return abort(404);

        $this->data['page_title'] = trans("opportunities.page_title");
        $this->data['page_header'] = trans("opportunities.page_header");
        $this->data['data'] = $opportunity;
        return view("manage.opportunities.show", $this->data);
    }

    function close(Request $request, $id = 0)
    {
        $opportunity = Opportunity::find($id);

        if (!$opportunity) return abort(404);

        if ($opportunity->progress < 100) {
            return redirect()->back()->withErrors(trans("opportunities.error_progress_not_completed_to_close"));
        }

        $opportunity->status = 2;
        $opportunity->status_changed_by = Auth::user()->id;
        $opportunity->updated_by = Auth::user()->id;
        $opportunity->save();

        // send email and notification to user
        Event::fire(new OpportunityClosed($opportunity));

        flash(trans("opportunities.closed_successfully"), "success");
        return redirect("manage/opportunities");


    }

    function cancel(Request $request, $id = 0)
    {
        $opportunity = Opportunity::find($id);

        if (!$opportunity) return abort(404);

        $opportunity->status = 3;
        $opportunity->status_changed_by = Auth::user()->id;
        $opportunity->updated_by = Auth::user()->id;
        $opportunity->save();

        // send email and notification to user
        Event::fire(new OpportunityCanceled($opportunity));
        flash(trans("opportunities.closed_successfully"), "success");
        return redirect("manage/opportunities");


    }
    function lead(Request $request, $id = 0)
    {
        $opportunity = Opportunity::find($id);

        if (!$opportunity) return abort(404);

        $opportunity->status = 1;
        $opportunity->status_changed_by = Auth::user()->id;
        $opportunity->updated_by = Auth::user()->id;
        $opportunity->save();

        // send email and notification to user
        Event::fire(new OpportunityLead($opportunity));
        flash(trans("opportunities.lead_successfully"), "success");
        return redirect("manage/opportunities");


    }

    function progress(Request $request, $id = 0)
    {
        $opportunity = Opportunity::find($id);

        if (!$opportunity) return abort(404);


        $opportunity->progress = $request->input("progress");
        $opportunity->updated_by = Auth::user()->id;
        $opportunity->save();

        Event::fire(new OpportunityProgressUpdated($opportunity));

        flash(trans("opportunities.updated_successfully"), "success");
        return redirect()->back();
    }

    function create()
    {
        $this->data['page_title'] = trans("opportunities.page_title");
        $this->data['page_header'] = trans("opportunities.page_header");
        $this->data['categories'] = Category::all();

        $this->data['distributors'] = User::orderBy("name", "desc")->where("permission", 2)->get();
        return view("manage.opportunities.create", $this->data);
    }

    function store(Request $request)
    {

        $now = date("d-m-Y");
        $rules = [
            'client' => "required|max:255",
            'info' => "required|max:300",
            'categories' => "required",
            'products' => "required",
            'distributor' => "required",
            'quantity' => "required|min:1",
            'deliver_at' => "required|date|after:$now",

        ];
        $inputs = [
            'client' => $request->input("client"),
            'info' => $request->input("info"),
            'deliver_at' => $request->input("deliver_at"),
            'categories' => $request->input("categories"),
            'products' => $request->input("products"),
            'quantity' => $request->input("quantity"),
            'price' => $request->input("price"),
            'user' => $request->input("distributor"),
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
        $opportunity->user_id = $inputs['user'];
        $opportunity->updated_by = Auth::user()->id;
        $opportunity->status = 0;
        $opportunity->total_price = $total_price;
        if ($opportunity->save()) {
            // save opportunity products
            if ($inputs['products']) {
                foreach ($inputs['products'] as $k => $product) {
                    $opportunity->products()->attach($product, ['category_id' => $inputs['categories'][$k], 'quantity' => $inputs['quantity'][$k], 'price' => $inputs['price'][$k]]);
                }
            }
        }

        flash(trans("opportunities.created_successfully"), 'success');
        return response()->json(['success' => true, 'redirect' => "/", 'message' => trans("opportunities.created_successfully")]);


    }

}
