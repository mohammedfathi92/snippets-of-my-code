<?php

namespace App\Http\Controllers\backend;

use App\Company_account;
use App\Events\UserLogs;
use App\User;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\Controller;

class BankAccountController extends Controller
{
    public function index(){

        if(!Voyager::can('show_accounts'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $this->data['investors'] = User::where('is_investor',1)->get();
        $this->data['accounts'] = Company_account::all();
        return view('banking_accounts.index',$this->data);
    }

    public function store(Request $request){

        $this->validate($request,[
            'user_id'=>'required|integer',
            'account_name'=>'required|',
            'account_number'=>'required|integer|min:0',
            'user_name'=>'required|string|max:100',
        ]);

        if($request->input('account_number') == 1){
            return redirect()->back()->with(['message'=>'your account number first account created 
            with investor please change it to any number', 'alert_danger'=>'info']);
        }

        $account = Company_account::create([
            'user_name'=>$request['user_name'],
            'user_type'=>$request->input('type'),
            'user_id'=>$request['user_id'],
            'account_name'=>$request->input('account_name'),
            'account_number'=>$request->input('account_number'),
            'account_value'=> 0,
            'created_by'=>Auth()->id(),
            'status'=>1
        ]);

        $logs = [
            'action' => 'create_company_account',
            'notes' => 'user_create_company_account',
            'attrs' => [
                'company_account' => $account->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message'=> __('messages.bank_accounts.create')]);
    }

    public function ajax_edit_account(Request $request){
        $account = Company_account::findOrFail($request['id']);
        return view('banking_accounts.ajax_account_edit',compact('account'));
    }

    public function update(Request $request){

        if(!Voyager::can('edit_accounts'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $this->validate($request,[
            'account_name'=>'required',
            'account_number'=>'required|integer|min:0',
            'user_name'=>'required|string|max:100',
        ]);

        $account = Company_account::findOrFail($request->input('account_id'));

        if($account->account_number == 1){
            $account->account_number = 1;
        }else{
            if($request->input('account_number') == 1){
                return redirect()->back()->with(['message'=>'your account_number first account created 
            with investor please change it to any number', 'alert_danger'=>'info']);
            }
            $account->account_number = $request->input('account_number');
        }

        $account->account_name = $request->input('account_name');

        $account->status = $request->input('status');
        $account->user_name = $request->input('user_name');
        $account->save();

        $logs = [
            'action' => 'update_company_account',
            'notes' => 'user_update_company_account',
            'attrs' => [
                'company_account' => $account->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message'=> __('messages.bank_accounts.update')]);
    }

    public function create(){

        if(!Voyager::can('create_accounts'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $company_accounts = Company_account::where('user_id',1)->get();
        return view('banking_accounts.company_accounts_create',compact('company_accounts'));
    }

}
