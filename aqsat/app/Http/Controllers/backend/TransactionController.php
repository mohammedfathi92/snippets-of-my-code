<?php

//type of financial transaction
// 1- deposit         ايداع
// 2- pull            سحب
// 3- first_payment   استلام اول دفعه فى القسط
// 4- pull_buy        سحب شراء
// 5- contract_pay    مخالصه
// 6- pull_expenses   سحب مصروفات
// 7- transfer        تحويل
// -8 premium_payment دفع الاقساط
// 9- contract_profit عموله عقد
// 10- contract_fees  رسوم العقد


namespace App\Http\Controllers\backend;

use App\Company_account;
use App\Financial_transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    public function index()
    {
        if(!Voyager::can('show_financial_transactions'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $limit = 20;
        $this->data['accounts'] = Company_account::all();
        $this->data['transactions'] = new Financial_transaction;
        return view('transaction.index',$this->data);
    }

    public function show($id){

        if(!Voyager::can('show_financial_transactions'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $financial_transaction = Financial_transaction::findOrFail($id);
        return view('transaction.show',compact('financial_transaction'));
    }

    public function advanced_search(Request $request)

    {

        $accounts = Company_account::all();
        $transaction = new Financial_transaction;

        if ($request->has('id') and $request['id'] != null) {
            $transaction = Financial_transaction::where('id', $request->input('id'));
        }

        if ($request->has('account_id') and $request['account_id'] != null) {
            $transaction = Financial_transaction::where('account_id', $request->input('account_id'));
        }

        if ($request->has('investor') and $request['investor'] != null) {
            $transaction = Financial_transaction::whereHas('user', function ($q) {
                $q->where('is_investor',1)->where('name', Input::get('investor'));
            });
        }

        if ($request->has('gthan') and $request['gthan'] != null) {
            $transaction = Financial_transaction::where('price','>', $request->input('gthan'));
        }

        if ($request->has('lthan') and $request['lthan'] != null) {
            $transaction = Financial_transaction::where('price','<', $request->input('lthan'));
        }

        if ($request->has('qthan') and $request['qthan'] != null) {
            $transaction = Financial_transaction::where('price', $request->input('qthan'));
        }

//        if ($request->has('dstart') and $request['dstart'] != null) {
//            $transaction = Financial_transaction::where('created_at','<', $request->input('dstart'));
//        }
//
//        if ($request->has('dend') and $request['dend'] != null) {
//            $transaction = Financial_transaction::where('created_at','>', $request->input('dend'));
//        }

        if ($request->has('type') and $request['type'] != null) {
            if($request->input('type') == 1){
                $transaction = Financial_transaction::where('type','deposit');
            }

            if($request->input('type') == 2){
                $transaction = Financial_transaction::where('type','pull');
            }

            if($request->input('type') == 3){
                $transaction = Financial_transaction::where('type','transfer');
            }

            if($request->input('type') == 4){
                $transaction = Financial_transaction::where('type','premium_payment');
            }

        }


        return view('transaction.index', ['transactions' => $transaction,'accounts'=>$accounts]);
    }

}
