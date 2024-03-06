<?php

namespace App\Http\Controllers;

use App\Level;
use App\Opportunity;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Validator;

class AccountsController extends Controller
{
    function me()
    {
        $this->data['page_title'] = trans("users.update_account_settings");
        $this->data['page_header'] = trans("users.update_account_settings");
        $this->data['data'] = Auth::user();
        return view("accounts.me", $this->data);

    }


    function updateMe(Request $request)
    {
        $id = Auth::user()->id;

        $rules = [
            'name' => "required|max:255",

            'password' => "alpha_num|min:6|max:32|confirmed",
            'address' => "max:255",
            'job' => "max:255",

            'annual_sales' => "integer",
            'phone' => 'numeric',
            'mobile' => 'numeric',
            'about' => 'min:10',
        ];

        if (Auth::user()->permission == 0) {
            $rules['email'] = "required|email|unique:users,email,$id";
        }


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("account")
                ->withErrors($validator)
                ->withInput();
        }


        $user = User::find($id);
        $user->name = $request->input('name');

        if ($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->address = $request->input('address');
        $user->company = $request->input('company');
        $user->job = $request->input('job');
        $user->phone = $request->input('phone');
        $user->mobile = $request->input('mobile');
        $user->annual_sales = $request->input('annual_sales');
        $user->about = $request->input('about');
        if ($request->input('avatar')) {
            $user->avatar = $request->input('avatar');
        }

        $user->save();

        flash(trans("users.account_updated_successfully"), "success");
        return redirect("account");


    }


    function profile(Request $request, $id = 0)
    {
        $user = Auth::user();
        if ($id) {
            $user = User::find($id);

            // can't found provided user id.
            if (!$user) return redirect()->back(302)->withErrors(trans("users.error_id_not_found"));


            // profile visitor not a manager.
            if (Auth::user()->permission > 1 || (Auth::user()->permission > 0 && $user->permission == 0)) {
                return redirect("/")->withErrors(trans("main.management_access_denied"));
            }

        }
        $this->data['level']=$user->level();
        $this->data['page_title'] = trans("users.profile_page_title",['name'=>$user->name]);
        $this->data['page_header'] = trans("users.profile_page_header",['name'=>$user->name]);
        $userData = $user->opportunities();

        $paginate = $userData->paginate(15);

        $open = 0;
        $leads = 0;
        $canceled = 0;
        $closed = 0;
        $all=0;

        if ($userData->get()) {
            foreach ($userData->get() as $item) {

                switch ($item->status) {
                    case 0:
                        $open++;
                        $all++;
                        break;
                    case 1:
                        $leads++;
                        $all++;
                        break;
                    case 2:
                        $closed++;
                        $all++;
                        break;
                    case 3:
                        $canceled++;
                        $all++;
                        break;

                }
            }
        }


        $leadOpportunities=$userData->whereIn('status',[1,2])->get();
        $this->data['openCount'] = $open;
        $this->data['leadsCount'] = $leads;
        $this->data['canceledCount'] = $canceled;
        $this->data['closedCount'] = $closed;
        $this->data['allCount'] = $all;
        $this->data['opportunities'] = $paginate;
        $this->data['leadsOpportunities'] = $leadOpportunities;
        $this->data['data'] = $user;
        return view("accounts.profile", $this->data);

    }
}
