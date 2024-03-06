<?php

namespace App\Http\Controllers\backend;

//-----------------------contracts type--------------------------------//
//issue_contracts kind =5
//late_payment_contracts kind = 4
//conflict_contracts kind =3
//pure_contracts kind = 2
//currently_contracts kind = null

//-----------------------premiums type--------------------------------//
//not_paid = 0
//part_paid = 1
//full_paid = 2
//late_paid = 3


use App\Company_account;
use App\Contract;
use App\ContractPremium;
use App\Events\UserLogs;
use App\Financial_transaction;
use App\Group;
use App\Note;
use App\ProductPayment;
use App\Profile;
use App\Profit;
use App\User;

use GeniusTS\HijriDate\Hijri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Mockery\Matcher\Not;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use TCG\Voyager\Facades\Voyager;
use App\Helpers\Main\Aqsat;


class ContractsController extends Controller
{
    public function index()
    {
        if(!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message'=> __('messages.permissions.access'),'alert_danger'=>'info']);
        $this->data['title'] = 'contracts';
        return view('contracts.index', $this->data);
    }

    public function create($type)
    {
        if (!Voyager::can('create_contracts'))
            return redirect()->back()->with(['message' => __('messages.permissions.access')]);

        if(Session::has('contract_reviewed')){
        Session::forget('contract_reviewed');
        }
        $contracts_inActive = Contract::where('status', 0)->where('created_at', Auth()->id());  
        foreach ($contracts_inActive->get() as $cont) {
            $contracts_inActive->forceDelete(); 
        
        }  

        $this->data['title'] = 'new contracts';
        $this->data['type'] = $type;
        $this->data['investors'] = User::where('is_investor', 1)->get();
        $this->data['clients'] = User::where('is_client', 1)->get();
        $this->data['sponsors'] = User::where('is_sponsor', 1)->get();
        $this->data['groups'] = Group::all();
        return view('contracts.create', $this->data);
    }

    public function ajax_investor_product(Request $request)
    {
        $investor = User::findOrFail($request['id']);
        $this->data['investor_product'] = $investor->product_payments;
        return view('contracts.ajax_products', $this->data);
    }

    public function ajax_investor_accounts(Request $request)
    {
        $investor = User::findOrFail($request['id']);
        $accounts = $investor->company_account;
        return view('contracts.ajax_get_investor_accounts', compact('accounts'));
    }

    public function store(Request $request, $type)
    {

        $request['contract_date'] = str_replace('/', '-', $request->input('contract_date'));
        $request['premiums_start_date_hijry'] = str_replace('/', '-', $request->input('premiums_start_date_hijry'));
        $request['premiums_start_date'] = str_replace('/', '-', $request->input('premiums_start_date'));

        if ($request->has('premiums_date_type') and $request->input('premiums_date_type') == 0) {

            $premiums_start_date_mi = Hijri::convertToGregorian(
                Carbon::parse($request['premiums_start_date_hijry'])->format('d'),
                Carbon::parse($request['premiums_start_date_hijry'])->format('m'),
                Carbon::parse($request['premiums_start_date_hijry'])->format('Y'))->format('Y-m-d');

            $request->merge(['premiums_start_date' => $premiums_start_date_mi]);

        } elseif ($request->has('premiums_date_type') and $request->input('premiums_date_type') == 1) {
            $request->merge(['premiums_start_date_hijry' => Hijri::convertToHijri($request->input('premiums_start_date'))
                ->format('Y-m-d')]);
        }


        if ($request->input('premiums_start_date_hijry') == '') {
            $request->merge(['premiums_start_date_hijry' => Hijri::convertToHijri($request->input('premiums_start_date'))
                ->format('Y-m-d')]);
        }

        if ($type == 1) {
            $rules = [
                'contract_num' => 'required|unique:contracts',
                'investor_id' => 'required|integer|',
                'client_id' => 'required|integer|',
                'contract_date' => 'required',
                'premiums_start_date_hijry' => 'required',
                'premiums_date_type' => 'required|integer|min:0|max:1',
                'schedule_type' => 'required|integer|min:0|max:4',
                'premiums_start_date' => 'required',
                'contract_value' => 'required|min:0',
                'total_profit' => 'integer',
                'first_payment' => 'min:0',
                'premiums_number' => 'required|min:0',
                'premiums_value' => 'required|min:0',
                'last_premium' => 'required|min:0',
                'account_id' => 'required|integer',
                'group_id' => 'required|integer',
                'profit_type' => 'required',
                'profit_pay_type' => 'required',
                'contract_profit' => 'required|min:0',
                'commission_account' => 'required'
            ];
        }

        if ($type == 2) {
            $rules = [
                'investor_id' => 'required|integer|',
                'client_id' => 'required|integer|',
                'contract_date' => 'required',
                'premiums_start_date_hijry' => 'required',
                'premiums_start_date' => 'required',
                'contract_value' => 'required|min:0',
                'total_profit' => 'integer',
                'first_payment' => 'min:0',
                'account_id' => 'required|integer',
                'group_id' => 'required|integer',
                'profit_type' => 'required',
                'profit_pay_type' => 'required',
                'contract_profit' => 'required|min:0',
                'commission_account' => 'required'
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($type == 2) {
            $request['premiums_value'] = $request->input('contract_value');
        }

        //       contract_profit  =>   العموله  //he mean Commission
        if ($request->input('profit_type') == 1) {
            $request['contract_profit'] = ($request['contract_profit'] / 100) * $request['total_profit'];
        }

        if ($request->input('last_premium') < $request->input('contract_profit') and $request['profit_pay_type'] == 3)
            return redirect()->back()->with(['message' => __('messages.contract.check_last_premium'), 'alert_danger' => 'info']);


        $request->merge(['created_by' => Auth()->id()]);

        $investor = User::findOrFail($request->input('investor_id'));
        if (!$investor) {
            return redirect()->back()->with(['message' => 'no investors founded']);
        }

              if(Session::has('contract_reviewed')){
           Session::forget('contract_reviewed');
            $contracts_inActive = Contract::where('status', 0)->where('created_at', Auth()->id());  
        foreach ($contracts_inActive->get() as $cont) {
            $contracts_inActive->forceDelete(); 
        
        } 
        }
        Session::put('contract_reviewed', ['first_payment' => 
            ['account' => $request['account_id'], 'amount' => $request['first_payment']],
            'products' => $request->all()
        ]);


//      create new contract
        $contract = Contract::create($request->all());
    
     
     

        //last_date
        $start_date = Carbon::createFromFormat('Y-m-d', $contract->premiums_start_date);

        if ($contract->schedule_type == 0) {
            $last_date = $start_date->addDay($contract->premiums_number - 1)->toDateString();
        } elseif ($contract->schedule_type == 1)
            $last_date = $start_date->addWeek($contract->premiums_number - 1)->toDateString();

        elseif ($contract->schedule_type == 2)
            $last_date = $start_date->addMonth($contract->premiums_number - 1)->toDateString();

        elseif ($contract->schedule_type == 3)
            $last_date = $start_date->addMonths(($contract->premiums_number - 1) * 6)->toDateString();

        elseif ($contract->schedule_type == 4)
            $last_date = $start_date->addYear($contract->premiums_number - 1)->toDateString();

        $contract->last_date = $last_date;

        //contract_type && discount first payment of contract_val
        $contract->contract_type = $type;
        $contract->contract_value = $request->input('contract_value') - $request->input('first_payment');

        if ($type == 2) {
            $contract->premiums_value = $contract->contract_value;
            $contract->premiums_number = 1;
        }
        $contract->save();


        if ($request->input('contract_price') == 0)
            return redirect()->back()
                ->with(['message' => __('messages.contract.check_product'), 'alert_danger' => 'info']);

        $premiums_start_date = $contract->premiums_start_date;
        $premium_date = Carbon::createFromFormat('Y-m-d', $premiums_start_date);
        $schedule_premium = Carbon::createFromFormat('Y-m-d', $contract->premiums_start_date);

        $logs = [
            'action' => 'create_contract',
            'notes' => 'user_create_contract',
            'attrs' => [
                'contract' => $contract->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->route('contracts.review', $contract->id);

    }

    function review($id)
    {
        $contract = Contract::findOrFail($id);

        if (!$contract)
            return redirect()->back()->with(['message' => 'this contract not found', 'alert_danger' => 'info']);

        $account_name = Company_account::find($contract->account_id);


        return view('contracts.review', compact(['contract'], 'account_name'));

    }

    public function ajax_new_user_store(Request $request, $type)
    {
        $rules = [
            'full_name' => 'required|string|max:255',
            //  'email' => 'required|string|email|max:255|unique:users',
            'notes' => 'max:255',
            'national_id' => 'numeric|min:5',
            'release_date' => 'date',
        ];

        $validator = Validator::make($request->all(), $rules);
if($type == 'client'){
$is_client = 1;
$is_sponsor = 0;

}else{
$is_client = 0;
$is_sponsor = 1;
}
        if ($validator->fails()){
            if($type == 'client'){
                $dataUsers = User::where('is_client', 1)->get();
            }else{
                $dataUsers = User::where('is_sponsor', 1)->get();
            }
            
            return view('contracts.ajax_new_user_message', compact('dataUsers', 'type'))->withErrors($validator);
        }


        $user = User::create([
            'name' => $request['full_name'],
            'email' => random_int(10, 10000) . hexdec(uniqid()) . '@gmail.com',
            'password' => bcrypt('FMxanX2D\[-a&&8_'),
            'is_client' => $is_client,
            'is_sponsor' => $is_sponsor,
        ]);

        $user->email = $user->id . random_int(10, 10000) . hexdec(uniqid()) . '@gmail.com';
        $user->save();

        $user_info = array_add($request->all(), 'user_id', $user->id);

        Profile::create($user_info);
         $this->data['user_type'] = $type;

        if($type == 'client'){
$this->data['users_list'] = User::where('is_client', 1)->get();

}else{
        $this->data['users_list'] = User::where('is_sponsor', 1)->get();
}
 return view('contracts.ajax_new_user', $this->data);
    }

    public function contract_save($id)
    {
    if(!Session::has('contract_reviewed')){
        return redirect()->back()->with(['message' => 'حدث خطأ ما اعد كتابة العقد مرة ثانية', 'alert_danger' => 'info']);
          
        }


        $contract_session = Session::get('contract_reviewed');
        $first_payment = $contract_session['first_payment'];
        $products = $contract_session['products'];

        $contract = Contract::findOrFail($id);
        $total = 0;
        if (!$contract)
            return redirect()->back()->with(['message' => 'this contract not found', 'alert_danger' => 'info']);

         //save first_payment
        if($first_payment){
        if ($first_payment > 0) {
            $client = $contract->client->name;
            $investor = $contract->investor;
            Financial_transaction::create([
                'created_by' => Auth()->id(),
                'updated_by' => Auth()->id(),
                'account_id' => $first_payment['account'],
                'user_id' => $investor->id,
                'type' => 'first_payment',
                'price' => $first_payment['amount'],
                'contract_id' => $contract->id,
                'notes' => __('messages.contract.Financial', ['amount' => $products['first_payment'], 'name' => $client, 'name_2' => $investor->name]),
            ]);
        }

        //save in selected account
        $account = Company_account::find($first_payment['account']);
        $account->account_value += $first_payment['amount'];
        $account->save();
}

  $investor_products = $investor->product_payments()->count();


   if($products){ 
        for ($i = 1; $i <= $investor_products; $i++) {
            if (isset($products['price_' . $i]) and isset($products['quantity_' . $i])) {
                if ($products['main_quantity_' . $i] < $products['quantity_' . $i]) {
                    return redirect()->back()->with(['message' => __('messages.contract.check_amount'), 'alert_danger' => 'info']);
                }
                $contract->products()->attach($products['product_id_' . $i],
                    ['quantity' => $products['quantity_' . $i], 'price' => $products['price_' . $i]
                        , 'first_payment' => $products['payment_price_' . $i]]);

                //update investor product quantity
                $investor_product = $contract->investor->product_payments
                    ->where('product_id', $products['product_id_' . $i])
                    ->where('quantity', '!=', 0)->where('price', $products['payment_price_' . $i])->first();

                $investor_product->quantity = $investor_product->quantity - $products['quantity_' . $i];
                $investor_product->save();

            } else {
                continue;
            }
        }

        } 

        $contract->status = 1;

        $contract->save();



//       delete inActive contracts
        if(Session::has('contract_reviewed')){
        Session::forget('contract_reviewed');
        }
         $contracts_inActive = Contract::where('status', 0)->where('created_at', Auth()->id());  
        foreach ($contracts_inActive->get() as $cont) {
            $contracts_inActive->forceDelete(); 
        
        } 


        if ($contract->contract_type == 1) {

            $premiums_start_date = $contract->premiums_start_date;
            $premium_date = Carbon::createFromFormat('Y-m-d', $premiums_start_date);


            $schedule_premium = Carbon::createFromFormat('Y-m-d', $contract->premiums_start_date);
            $schedule_premium_hijry = Carbon::createFromFormat('Y-m-d', $contract->premiums_start_date_hijry);


            if ($contract->save()) {
                for ($i = 1; $i <= $contract->premiums_number; $i++) {
                    $contract_premium = new ContractPremium();
                    $contract_premium->order = $i;
                    $contract_premium->status = 0;
                    $contract_premium->created_by = Auth()->id();
                    $contract_premium->updated_by = Auth()->id();


                    if ($i == 1) {
                        $contract_premium->date_type_hij = $schedule_premium_hijry->toDateString();
                    } elseif ($contract->schedule_type == 0)
                        $contract_premium->date_type_hij = $schedule_premium_hijry->addDay()->toDateString();

                    elseif ($contract->schedule_type == 1)
                        $contract_premium->date_type_hij = $schedule_premium_hijry->addWeek()->toDateString();

                    elseif ($contract->schedule_type == 2)
                        $contract_premium->date_type_hij = $schedule_premium_hijry->addMonth()->toDateString();

                    elseif ($contract->schedule_type == 3)
                        $contract_premium->date_type_hij = $schedule_premium_hijry->addMonths(6)->toDateString();

                    elseif ($contract->schedule_type == 4)
                        $contract_premium->date_type_hij = $schedule_premium_hijry->addYear()->toDateString();


                    $contract_premium->date_type_mi = $schedule_premium;

                    if ($i == 1) {
                        $contract_premium->date_type_mi = $schedule_premium->toDateString();
                    } elseif ($contract->schedule_type == 0)
                        $contract_premium->date_type_mi = $schedule_premium->addDay()->toDateString();

                    elseif ($contract->schedule_type == 1)
                        $contract_premium->date_type_mi = $schedule_premium->addWeek()->toDateString();

                    elseif ($contract->schedule_type == 2)
                        $contract_premium->date_type_mi = $schedule_premium->addMonth()->toDateString();

                    elseif ($contract->schedule_type == 3)
                        $contract_premium->date_type_mi = $schedule_premium->addMonths(6)->toDateString();

                    elseif ($contract->schedule_type == 4)
                        $contract_premium->date_type_mi = $schedule_premium->addYear()->toDateString();


////                  profit_pay_type
//                    if($contract->profit_pay_type == 1){
//                        if($i == 1){
//                            $contract_premium->amount = $contract->premiums_value + $contract->contract_profit;
//                        }else{
//                            $contract_premium->amount = $contract->premiums_value;
//                        }
//                    }elseif ($contract->profit_pay_type == 2){
//                        $contract_premium->amount = $contract->premiums_value +
//                            ($contract->contract_profit / $contract->premiums_number);
//                    }elseif ($contract->profit_pay_type == 3){
//                        if($i == $contract->premiums_number){
//                            $contract_premium->amount = $contract->premiums_value + $contract->contract_profit;
//                        }else{
//                            $contract_premium->amount = $contract->premiums_value;
//                        }
//                    }

                    $contract_premium->amount = $contract->premiums_value;
                    $contract_premium->payment = 0.00;
                    $contract_premium->profit = 0.00;
                    $contract_premium->contract_id = $contract->id;

                    $contract_premium->save();
                }
            }
        }

        if ($contract->contract_type == 2) {
            $contract_order = new ContractPremium();

            $contract_order->status = 0;
            $contract_order->created_by = Auth()->id();
            $contract_order->updated_by = Auth()->id();


////          profit_pay_type
//            if($contract->profit_pay_type == 1){
//                $contract_order->amount = $contract->contract_value + $contract->contract_profit;
//
//            }elseif ($contract->profit_pay_type == 2){
//                $contract_order->amount = $contract->contract_value + ($contract->contract_profit / 1);
//
//            }elseif ($contract->profit_pay_type == 3){
//                $contract_order->amount = $contract->contract_value + $contract->contract_profit;
//            }


            $contract_order->amount = $contract->contract_value;
            $contract_order->payment = 0.00;
            $contract_order->profit = 0.00;
            $contract_order->contract_id = $contract->id;
            $contract_order->date_type_hij = $contract->premiums_start_date_hijry;
            $contract_order->date_type_mi = $contract->premiums_start_date;
            $contract_order->order = 1;

            $contract_order->save();
        }

        //delete investor product when quantity = 0
        $investor_product = ProductPayment::where('quantity', '<=', 0)->get();

        foreach ($investor_product as $product) {
            $product->delete();
        }

        //delete contracts not active status = 0
        $contractsInActrive = Contract::where('status', 0)->where('created_by', Auth()->id());
        if($contractsInActrive){

        foreach ($contractsInActrive->get() as $row) {
            $row->forceDelete();
        }
        }


        $premiums = ContractPremium::where('contract_id', $contract->id)->get();

        return redirect()->route('contracts.show', $contract->id)
            ->with(['message' => __('messages.contract.save')]);
    }

    public function contract_cancel(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);
        if (!$contract)
            return redirect()->back()->with(['message' => 'this contract not found', 'alert_danger' => 'info']);
        $contract_type = $contract->contract_type;
        $contract->forceDelete();

        if(Session::has('contract_reviewed')){
        Session::forget('contract_reviewed');
        }

        return redirect()->route('contracts.create', $contract_type?:1);

        // $this->data['title'] = 'new contracts';
        // $this->data['type'] = (int)$request->input('type');
        // $this->data['investors'] = User::where('is_investor', 1)->get();
        // $this->data['clients'] = User::where('is_client', 1)->get();
        // $this->data['groups'] = Group::all();
        // $this->data['contract'] = $contract;
        // $this->data['sponsors'] = User::where('is_sponsor', 1)->get();

        // foreach ($contract->products as $product) {

        //     $investor_product = ProductPayment::where('user_id', $contract->investor_id)
        //         ->where('product_id', $product->id)
        //         ->where('price', $product->pivot->first_payment)->first();

        //     if (!$investor_product) {
        //         return redirect()->back()->with(['message' => 'this contract not have products', 'alter_danger' => 'info']);
        //     }
        //     $investor_product->quantity += $product->pivot->quantity;

        //     $product->pivot->quantity = 0;

        //     $product->pivot->save();

        //     $investor_product->save();
        // }


        // return view('contracts.recreate', $this->data);
    }

    public function show($id)
    {
        if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        
        $contract = Contract::findOrFail($id);

        $total = 0;

        if (!$contract) {
            return redirect()->back()->with(['message' => 'this contract not found', 'alert_danger' => 'info']);
        }



        $premiums_start_date = $contract->premiums_start_date;
        $premium_date = Carbon::createFromFormat('Y-m-d', $premiums_start_date);

        $schedule_premium = Carbon::createFromFormat('Y-m-d', $contract->premiums_start_date);

        $premiums = ContractPremium::where('contract_id', $contract->id)->get();

        //late premiums
        // the contract will be late after this num of days---------------------
        $numOfLateDays = setting('admin.mark_as_delay')?:0;
if($contract->quittance < 1){ //Not mokhalasa
        foreach ($premiums as $premium) {
            if ($premium->date_type_mi < Carbon::now()->subDays($numOfLateDays)) {
                if ($premium->payment != $premium->amount) {
                    $premium->status = 3;
                    $premium->save();
                } else {
                    $premium->status = 2;
                    $premium->save();
                }
            } elseif ($premium->date_type_mi > Carbon::now()->subDays($numOfLateDays) and $premium->status == 3) {

                if ($premium->amount == $premium->payment) {
                    $premium->status = 2;
                    $premium->save();
                } elseif ($premium->amount != $premium->payment and $premium->payment != 0) {
                    $premium->status = 1;
                    $premium->save();
                } elseif ($premium->amount != $premium->payment and $premium->payment == 0) {
                    $premium->status = 0;
                    $premium->save();
                }
            }
        }
        }
if($contract->quittance < 1){
        //contract will be late
        $amount = $contract->contract_premium->sum('amount');
        $payment = $contract->contract_premium->sum('payment');

        foreach ($contract->contract_premium as $premium) {
            if ($premium->status == 3) {
                $contract->kind = 4;
                $contract->save();
                break;
            } else {
                if ($amount == $payment) {
                    $contract->kind = 2;
                    $contract->save();
                }else{
                    $contract->kind = null;
                    $contract->save();
                }

            }
        }
    } //end quantance condition


        $premiums_payment = ContractPremium::where('contract_id', $contract->id)->where('payment', '!=', 0)->get();

        $groups = Group::all();

        $late_payment = ContractPremium::where('contract_id', $id)
                ->where('date_type_mi', '<', \Carbon\Carbon::now()->subDays($numOfLateDays))
                ->whereColumn('payment', '<', 'amount')->sum('amount') - ContractPremium::where('contract_id', $id)
                ->where('date_type_mi', '<', \Carbon\Carbon::now()->subDays($numOfLateDays))
                ->whereColumn('payment', '<', 'amount')->sum('payment');

        return view('contracts.show',
            compact(['contract', 'total', 'premium_date', 'premiums', 'premiums_payment', 'groups', 'late_payment']))
            ->with(['message' => 'your contract saved successfully']);
    }

    public function update_group(Request $request, $id)
    {

        if (!Voyager::can('edit_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $contract = Contract::findOrFail($id);
        $contract->group_id = $request->input('group_id');
        $contract->save();


        $logs = [
            'action' => 'update_contract_group',
            'notes' => 'user_update_contract_group',
            'attrs' => [
                'contract' => $contract->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message' => __('messages.contract.group')]);
    }

    public function ajax_get_premium(Request $request)
    {
        $this->data['premium_info'] = ContractPremium::where('contract_id', $request['contract_id'])
            ->where('order', $request['order'])->first();

        $this->data['investor_accounts'] = $this->data['premium_info']->contract->investor->company_account;

        $this->data['order'] = $request['order'];
        $this->data['contract_id'] = $request['contract_id'];

        return view('contracts.premium_payment', $this->data);
    }


    //--------------------start contracts update-----------------------
    public function sponsor_edit($id)
    {

        if (!Voyager::can('edit_contracts'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $this->data['title'] = 'Sponsor Edit';
        $this->data['contract'] = Contract::findOrFail($id);

        if (!$this->data['contract'])
            return redirect()->back()->with(['message' => 'no contracts founded']);
        $this->data['sponsors'] = User::where('is_sponsor', 1)->get();

        return view('contracts.sponsor_edit', $this->data);
    }

    public function sponsor_update(Request $request, $id)
    {

        $contract = Contract::findOrFail($id);

        if (!$contract)
            return redirect()->back()->with(['message' => 'no contracts founded']);

        $contract->sponsor_id = $request->input('sponsor_id');
        $contract->sponsor_two_id = $request->input('sponsor_two_id');
        $contract->contract_profit = $request->input('contract_profit');

        $contract->save();

        $logs = [
            'action' => 'update_contract_sponsor',
            'notes' => 'user_update_contract_sponsor',
            'attrs' => [
                'contract' => $contract->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect(route('contracts.show', $contract->id))->with(['message' => __('messages.contract.sponsor_edit')]);

    }

    public function fees_update(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required|Numeric|min:0',
        ]);

        $contract = Contract::findOrFail($id);

        $contract->fees = $request->input('amount');
        $contract->save();

        $logs = [
            'action' => 'update_contract_fees',
            'notes' => 'user_update_contract_fees',
            'attrs' => [
                'contract' => $contract->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message' => __('messages.contract.fees')]);

    }

    public function profit_update(Request $request, $id)
    {
        $this->validate($request, [
            'contract_profit' => 'required|Numeric|min:0',
        ]);

        $contract = Contract::findOrFail($id);

        $contract->contract_profit = $request->input('contract_profit');
        $contract->save();

        $logs = [
            'action' => 'update_contract_profit',
            'notes' => 'user_update_contract_profit',
            'attrs' => [
                'contract' => $contract->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message' => __('messages.contract.profit')]);

    }

    public function premium_payment(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required|min:0',
            'account_id' => 'required|integer',
            'note' => 'max:500',
        ]);

        $contract = Contract::findOrFail($request['contract_id']);
        $investor = $contract->investor;
        if (!$contract)
            return redirect()->back()->with(['message' => 'no contracts founded', 'alert_danger' => 'info']);

        $premium_info = ContractPremium::find($id);

           if (!$premium_info)
            return redirect()->back()->with(['message' => 'An error happened', 'alert_danger' => 'info']);
          if ($request->input('prem_type') == 1)
            return redirect()->back()->with(['message' => 'An error happened', 'alert_danger' => 'info']);

          $order = (int)$request->input('order');
        if (!$order) {
            return redirect()->back()->with(['message' => __('messages.contract.premiums_pay_check_order'), 'alert_danger' => 'info']);
        }
       $net_amount = $premium_info->amount - $premium_info->payment;
        if ($request->input('amount') > $net_amount)
            return redirect()->back()->with(['message' => __('messages.contract.premium_pay_check_amount'), 'alert_danger' => 'info']);

        //save_in_investor_account
        $investor_account = $contract->investor->company_account->where('id', $request->input('account_id'))->first();
      $contract_commission_account = 0;
      if($contract->commission_account) {
       $company_account = Company_account::find($contract->commission_account);

      } else{
        //main company account
        $company_account = Company_account::where('user_id', 1)->where('user_type', 'company')->first();
      }  

        if (!$company_account)
            return redirect()->back()->with(['message' => 'main company account not found try again', 'alert_danger' => 'info']);
      //3molat el 3aqd

        // profit_pay_type  [1 => in first premiums , 2=> on total premium, 2=> in last premium]
        // he use {profit} word as commission of contract
        $profit = $contract->contract_profit;

        $unpaid = $contract->contract_profit - $contract->contract_profit_payment;
        $commission = 0.00;

        if ($contract->profit_pay_type != 2) {

            if ($contract->profit_pay_type == 1) {
                if ($request['amount'] - $unpaid < 0) {
                    $company_account->account_value += $request['amount'];
                    $company_account->save();
                    $investor_account->account_value += 0;
                    $investor_account->save();
                    
                 if ($unpaid != 0) {
                         $commission = $request['amount'];
                        Profit::create([
                            'contract_id' => $contract->id,
                            'premium_id' => $premium_info->id,
                            'client_id' => $contract->client->id,
                            'paid' => $commission,
                        ]);
                        $contract_profit_payment = $contract->contract_profit_payment + $commission;
                         $contract->update(array('contract_profit_payment' => $contract_profit_payment));

            Financial_transaction::create([
            'created_by' => Auth()->id(),
            'updated_by' => Auth()->id(),
            'account_id' => $company_account->id,
            'user_id' => $contract->investor->id,
            'type' => 'contract_commission',
            'price' => $commission,
            'premium_id' => $premium_info->id,
            'contract_id' => $request['contract_id'],
            'notes' => __('messages.contract.contract_financial', ['contract' => $contract->contract_num, 'investor' => $investor->name, 'amount' => $request['amount']]),
        ]);
                    }

                } else {
                    $company_account->account_value += $unpaid;
                    $company_account->save();

                    $investor_account->account_value += $request['amount'] - $unpaid;
                    $investor_account->save();
                    if ($unpaid != 0) {
                        $commission = $unpaid; 
                        Profit::create([
                            'contract_id' => $contract->id,
                            'premium_id' => $premium_info->id,
                            'client_id' => $contract->client->id,
                            'paid' => $commission,
                        ]);


                        $contract_profit_payment = $contract->contract_profit_payment + $unpaid;
                         $contract->update(array('contract_profit_payment' => $contract_profit_payment));

        Financial_transaction::create([
            'created_by' => Auth()->id(),
            'updated_by' => Auth()->id(),
            'account_id' => $company_account->id,
            'user_id' => $contract->investor->id,
            'type' => 'contract_commission',
            'price' => $commission,
            'premium_id' => $premium_info->id,
            'contract_id' => $request['contract_id'],
            'notes' => __('messages.contract.contract_financial', ['contract' => $contract->contract_num, 'investor' => $investor->name, 'amount' => $unpaid]),
        ]);
                    }
                }

            } 
            if ($contract->profit_pay_type == 3) {

                if ($premium_info->order == $contract->premiums_number) {
                    $company_account->account_value += $unpaid;
                    $company_account->save();

                    $investor_account->account_value += $request->input('amount') - $unpaid;
                    $investor_account->save();

                    if ($unpaid != 0) {
                        $commission = $unpaid; 
                        Profit::create([
                            'contract_id' => $contract->id,
                            'premium_id' => $premium_info->id,
                            'client_id' => $contract->client->id,
                            'paid' => $commission,
                        ]);
                          $contract_profit_payment = $contract->contract_profit_payment + $unpaid;
                         $contract->update(array('contract_profit_payment' => $contract_profit_payment));
             Financial_transaction::create([
            'created_by' => Auth()->id(),
            'updated_by' => Auth()->id(),
            'account_id' => $company_account->id,
            'user_id' => $contract->investor->id,
            'type' => 'contract_commission',
            'price' => $commission,
            'premium_id' => $premium_info->id,
            'contract_id' => $request['contract_id'],
            'notes' => __('messages.contract.contract_financial', ['contract' => $contract->contract_num, 'investor' => $investor->name, 'amount' => $unpaid]),
        ]);
                    }


                } else {
                    $investor_account->account_value += $request->input('amount');
                    $investor_account->save();
                }

            }

        } else {

            $premium_profit = $contract->contract_profit / $contract->premiums_number;

            if ($premium_info->payment == 0) {

                if ($request['amount'] < $premium_profit)
                    return redirect()->back()->with(['message' => __('messages.contract.first_payment_mot_less_commission', ['amount' => $premium_profit]), 'alert_danger' => 'info']);

                if ($investor_account == $company_account) {
                    $investor_account->account_value += $request->input('amount');
                    $contract->contract_profit_payment += $premium_profit;
                    $contract->save();
                    $investor_account->save();
                    if ($unpaid != 0) {
                        $commission = $unpaid;
                        Profit::create([
                            'contract_id' => $contract->id,
                            'premium_id' => $premium_info->id,
                            'client_id' => $contract->client->id,
                            'paid' => $commission,
                        ]);
                             Financial_transaction::create([
            'created_by' => Auth()->id(),
            'updated_by' => Auth()->id(),
            'account_id' => $company_account->id,
            'user_id' => $contract->investor->id,
            'type' => 'contract_commission',
            'price' => $commission,
            'premium_id' => $premium_info->id,
            'contract_id' => $request['contract_id'],
            'notes' => __('messages.contract.contract_financial', ['contract' => $contract->contract_num, 'investor' => $investor->name, 'amount' => $unpaid]),
        ]);
                    }
                } else {
                    $investor_account->account_value += $request->input('amount') - $premium_profit;
                    $investor_account->save();

                    $company_account->account_value += $premium_profit;
                    $contract->contract_profit_payment += $premium_profit;
                    $contract->save();
                    $company_account->save();

                    if ($unpaid != 0) {
                        $commission = $premium_profit;
                        Profit::create([
                            'contract_id' => $contract->id,
                            'premium_id' => $premium_info->id,
                            'client_id' => $contract->client->id,
                            'paid' => $commission,
                        ]);
            Financial_transaction::create([
            'created_by' => Auth()->id(),
            'updated_by' => Auth()->id(),
            'account_id' => $company_account->id,
            'user_id' => $contract->investor->id,
            'type' => 'contract_commission',
            'price' => $commission,
            'premium_id' => $premium_info->id,
            'contract_id' => $request['contract_id'],
            'notes' => __('messages.contract.contract_financial', ['contract' => $contract->contract_num, 'investor' => $investor->name, 'amount' => $premium_profit]),
        ]);
                    }

                }
            } else {
                $investor_account->account_value += $request->input('amount');
                $investor_account->save();
            }

        }

        if ($request->input('amount') < $premium_info->amount - $premium_info->payment) {
            $premium_info->status = 1; //semi paid
            $premium_info->commission = $commission;
            $premium_info->payment = $request->input('amount') + $premium_info->payment;
            $premium_info->profit = ($request->input('amount') + $premium_info->payment) * (setting('admin.profit_percent')?: 0.037);
            $premium_info->account_id = $request->input('account_id');
            $premium_info->note = $request->input('note');

        } else {
            $premium_info->status = 2; //full paid
             $premium_info->commission = $commission;
            $premium_info->payment = $request->input('amount') + $premium_info->payment;
            $premium_info->account_id = $request->input('account_id');
            $premium_info->profit = ($request->input('amount') + $premium_info->payment) * 0.037;
            $premium_info->note = $request->input('note');
        }
        if($request->input('amount') > 0){
            $premium_info->last_pay_time = Carbon::now();
        }

        $premium_info->save();

        // $premium_payment = ContractPremium::where('contract_id', $request['contract_id'])->sum('payment');

        //contract_pure kind = 2
        $contract_id = $request['contract_id'];
        $count_paid = ContractPremium::where('contract_id',$contract_id)
         ->where('status', 2)
         ->count();

         $count_all = ContractPremium::where('contract_id',$contract_id)
         ->count();

        if($count_paid >= $count_all){
          $contract->kind = 2;
          $contract->save();
        }
        // if ($contract->contract_value == $premium_payment) {
        //     $contract->kind = 2;
        //     $contract->save();
        // }

        $count_lated = ContractPremium::where('contract_id',$contract_id)
         ->where('date_type_mi', '<', \Carbon\Carbon::now()->subDay(setting('admin.mark_as_delay')?:0))
         ->where('status', '!=', 2)
         ->count();

        if($count_lated > 0){
          $contract->kind = 4;
          $contract->save();
        }

        //financial transaction
        $client = $premium_info->contract->client->name;
        

        Financial_transaction::create([
            'created_by' => Auth()->id(),
            'updated_by' => Auth()->id(),
            'account_id' => $request->input('account_id'), //account which recieve mony
            'user_id' => $contract->client->id, //user who pay
            'type' => 'premium_payment',
            'price' => $request->input('amount'),
            'premium_id' => $premium_info->id,
            'contract_id' => $contract->id,
            'notes' => __('messages.contract.premium_Financial', ['name' => $client, 'name_2' => $investor->name, 'amount' => $request['amount']]),
        ]);

        $logs = [
            'action' => 'premium_pay',
            'notes' => 'user_premium_pay',
            'attrs' => [
                'contract' => $contract->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect(route('contracts.show', $contract->id))->with(['message' => __('messages.contract.premium_pay')]);

    }

    public function premium_edit($id)
    {
        if (!Voyager::can('edit_contracts'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $this->data['contract_id'] = $id;
        $this->data['premiums'] = ContractPremium::where('contract_id', $id)->where('status', 0)->get();

        $this->data['premiums_count'] = ContractPremium::where('contract_id', $id)->where('status', 0)->count();

        $this->data['total_remain'] =
            ContractPremium::where('contract_id', $id)->where('status', 0)->sum('amount')
            -
            (
            ContractPremium::where('contract_id', $id)->where('status', 0)->sum('payment')
                //  +
                // ContractPremium::where('contract_id', $id)->where('status', 1)->sum('payment')
            );


        return view('contracts.premium_schedual_edit', $this->data);
    }

    public function premium_update(Request $request, $id)
    {
        $premiums_edit = ContractPremium::where('contract_id', $id)->where('status', 0)->count();

        if ($request->input('total_edit') == $request->input('contract_remain')) {
            for ($i = 1; $i <= $premiums_edit; $i++) {

                $request['date_type_mi_' . $i] = str_replace('/', '-', $request->input('date_type_mi_' . $i));

                $request['date_type_hij_' . $i] = str_replace('/', '-', $request->input('date_type_hij_' . $i));


                if ($request->input('date_type_mi_' . $i) == '')
                    return redirect()->back()->with(['message' => __('messages.contract.premium_date'), 'alert_danger' => 'info']);
                if ($request->input('amount_' . $i) == '')
                    return redirect()->back()->with(['message' => __('messages.contract.premium_amount'), 'alert_danger' => 'info']);
                if (!Carbon::hasFormat($request->input('date_type_mi_' . $i), 'Y-m-d'))
                    return redirect()->back()->with(['message' => __('messages.contract.date_check'), 'alert_danger' => 'info']);
                if ($request->input('date_type_hij_' . $i) == '')
                    return redirect()->back()->with(['message' => __('messages.contract.premium_date'), 'alert_danger' => 'info']);
                if (!Carbon::hasFormat($request->input('date_type_hij_' . $i), 'Y-m-d'))
                    return redirect()->back()->with(['message' => __('messages.contract.date_check'), 'alert_danger' => 'info']);

                $premium = ContractPremium::where('contract_id', $id)->where('order', $request->input('order_' . $i))->first();

                $premium->amount = $request->input('amount_' . $i);
                $premium->date_type_mi = $request->input('date_type_mi_' . $i);
                $premium->date_type_hij = $request->input('date_type_hij_' . $i);

                $premium->save();
            }

            $logs = [
                'action' => 'update_contract',
                'notes' => 'user_update_contract',
                'attrs' => [
                    'contract' => $id,
                ],

            ];
            event(new UserLogs($logs));

            return redirect()->back()->with(['message' => __('messages.contract.premium_edit')]);
        } else {
            return redirect()->back()
                ->with(['message' => __('messages.contract.premium_check') . $request->input('contract_remain')
                    , 'alert_danger' => 'info']);
        }

    }

    public function edit_date($id)
    {
        if (!Voyager::can('edit_contracts'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $premium = ContractPremium::findOrFail($id);
        return view('contracts.date_edit', compact('premium'));
    }

    public function update_date(Request $request, $id)
    {
        $request['date_type_mi'] = str_replace('/', '-', $request->input('date_type_mi'));
        $request['date_type_hij'] = str_replace('/', '-', $request->input('date_type_hij'));

        $this->validate($request, [
            'date_type_hij' => 'required',
            'date_type_mi' => 'required',
        ]);

        if (!Carbon::hasFormat($request->input('date_type_hij'), 'Y-m-d'))
            return redirect()->back()->with(['message' => __('messages.contract.date_check'), 'alert_danger' => 'info']);

        if (!Carbon::hasFormat($request->input('date_type_mi'), 'Y-m-d'))
            return redirect()->back()->with(['message' => __('messages.contract.date_check'), 'alert_danger' => 'info']);

        $premium = ContractPremium::findOrFail($id);

        $premium->date_type_hij = $request['date_type_hij'];
        $premium->date_type_mi = $request['date_type_mi'];
        $premium->save();

        $premium->contract->premiums_start_date = $request->input('date_type_mi');
        $premium->contract->save();

        $logs = [
            'action' => 'premium_update',
            'notes' => 'user_premium_update',
            'attrs' => [
                'premium' => $premium->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect(route('contracts.show', $premium->contract->id))->with(['message' => __('messages.contract.date_edit')]);
    }

    //--------------------end contracts update-----------------------


    //--------------------start contracts type-----------------------
    public function contract_currently()
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $this->data['groups'] = Group::all();
        $this->data['contracts'] = Contract::where('kind', null);
        return view('contracts.current', $this->data);
    }

    public function contract_profits()
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $contracts_profits = new Contract();
        return view('contracts.profits', compact('contracts_profits'));
    }

    public function contract_pure()
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $contracts = Contract::where('kind', 2);
        return view('contracts.pure', compact('contracts'));
    }

    public function contract_conflict($id)
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $contract = Contract::findOrFail($id);

        if (!$contract)
            return redirect()->back()->with(['message' => 'no contracts founded', 'alert_danger' => 'info']);

//        conflict contracts
        $contract->kind = 3;
        $contract->save();

        $logs = [
            'action' => 'create_contract_conflict',
            'notes' => 'user_create_contract_conflict',
            'attrs' => [
                'contract' => $contract->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message' => __('messages.contract.conflict')]);
    }

    public function all_contract_conflict()
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $contracts = Contract::where('kind', 3);
        return view('contracts.conflict', compact('contracts'));
    }

    public function contract_finished(Request $request, $id)
    {
        $this->data['contract'] = Contract::findOrFail($id);
        if (!$this->data['contract'])
            return redirect()->back()->with(['message' => 'no contracts founded', 'alert_danger' => 'info']);

        $this->data['contract_remain'] = $this->data['contract']->contract_value - $this->data['contract']
                ->contract_premium->sum('payment');

        $this->data['investor_account'] = $this->data['contract']->investor->company_account;

        return view('contracts.finished', $this->data);
    }

    public function contract_finished_store(Request $request, $id)
    {
        $this->validate($request, [
            'amount' => 'required|min:0|numeric',
            'discount' => 'required|min:0|numeric',
            'account_id' => 'required|integer'
        ]);

        $contract = Contract::findOrFail($id);
        if (!$contract)
            return redirect()->back()->with(['message' => 'no contracts founded', 'alert_danger' => 'info']);

        if ($contract->contract_value < $request['amount'])
            return redirect()->back()->with(['message' => __('messages.contract.premium_pay_check_amount'), 'alert_danger' => 'info']);


        //contract_pure
        $contract->kind = 2;
        $contract->quittance = 1;
        $contract->discount = $request->input('discount');
        $contract->save();



        foreach ($contract->contract_premium->where('status', '!=', 2) as $premium) {

            $premium->status = 2;
            $premium->save();

        }


        //save in selected account
        $investor_account = $contract->investor->company_account->where('id', $request->input('account_id'))->first();

        //company account for commision
        if($contract->commission_account) {
       $company_account = Company_account::find($contract->commission_account);

      } else{
        $company_account = Company_account::where('user_id', 1)->where('user_type', 'company')->first();
      }  

        if ($contract->contract_profit_payment < $contract->contract_profit) {
            $profit_remain = $contract->contract_profit - $contract->contract_profit_payment;
            $investor_account->account_value += $request->input('amount') - $profit_remain;
            $investor_account->save();

            $company_account->account_value += $profit_remain;
            $company_account->save();
            $contract->contract_profit_payment += $profit_remain;
            $contract->save();
                  Profit::create([
                            'contract_id' => $contract->id,
                            'premium_id' => $contract->contract_premium->last()->id,
                            'client_id' => $contract->client->id,
                            'paid' => $profit_remain,
                        ]);
              Financial_transaction::create([
            'created_by' => Auth()->id(),
            'updated_by' => Auth()->id(),
            'account_id' => $company_account->id,
            'user_id' => $contract->investor->id,
            'type' => 'contract_commission',
            'price' => $profit_remain,
            'premium_id' => $contract->contract_premium->last()->id,
            'contract_id' => $contract->id,
            'notes' => __('messages.contract.contract_financial', ['contract' => $contract->contract_num, 'investor' => $contract->investor->name , 'amount' => $request['amount']]),
        ]);

        } else {
            $investor_account->account_value += $request->input('amount');
            $investor_account->save();
        }


        //financial transaction
        $client = $contract->client->name;
        $investor = $contract->investor->name;

        Financial_transaction::create([
            'created_by' => Auth()->id(),
            'updated_by' => Auth()->id(),
            'account_id' => $request->input('account_id'),
            'user_id' => $contract->investor->id,
            'type' => 'contract_pay',
            'price' => $request->input('amount'),
            'contract_id' => $contract->id,
            'notes' => __('messages.contract.finish_Financial', ['name' => $client, 'amount' => $request['amount'], 'name_2' => $investor]),
        ]);

        $logs = [
            'action' => 'create_contract_finish',
            'notes' => 'user_create_contract_finish',
            'attrs' => [
                'contract' => $contract->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->route('contracts.show', $contract->id)->with(['message' => __('messages.contract.finish')]);
    }

    public function all_premiums()
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        //$num = 20;
        $premiums = new ContractPremium();
        return view('contracts.premiums', compact('premiums'));
    }

    public function contract_all_profits()
    {
        $contracts = new Contract();
        return view('contracts.profit', compact('contracts'));
    }

    public function contract_fees()
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $contracts = new Contract();
        return view('contracts.fees', compact('contracts'));
    }

    public function contract_late_payment()
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $premiums = ContractPremium::where('date_type_mi', '<', Carbon::now()->subDay(setting('admin.mark_as_delay')?:0))
            ->whereColumn('payment', '<', 'amount')->get();

        if ($premiums) {
            foreach ($premiums as $premium) {
               
                if ($premium->contract && $premium->contract->kind != 2) {
                    $premium->contract->kind = 4;
                    $premium->contract->save();
                }
            }
        }

//        $premiums = ContractPremium::where('status', 3);

        $contracts = Contract::where('kind', 4);
        return view('contracts.late_payment', compact('contracts'));
    }

    public function contract_issue_save($id)
    {
        $contract = Contract::findOrFail($id);
        if (!$contract) {
            return redirect()->back()->with(['message' => 'no contracts found', 'alert_danger' => 'info']);
        }

        $contract->kind = 5;
        $contract->save();

        $logs = [
            'action' => 'create_contract_issue',
            'notes' => 'user_create_contract_issue',
            'attrs' => [
                'contract' => $contract->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message' => __('messages.contract.issue')]);
    }

    public function contract_issue()
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $groups = Group::all();
        $title = 'contracts with issues';
        $contracts = Contract::where('kind', 5);
        return view('contracts.issue', compact('contracts', 'title', 'groups'));
    }

    public function contract_late_premium()
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $late_premiums = ContractPremium::where('status', 3);
        return view('contracts.premium_late', compact('late_premiums'));
    }

    //payment_profit
    public function ajax_payment_profit(Request $request)
    {
        $contract = Contract::findOrFail($request->input('id'));
        $company_accounts = Company_account::where('user_id', 1)->get();
        return view('contracts.ajax_payment_profit', compact('contract', 'company_accounts'));
    }

    public function ajax_investor_account_value(Request $request)
    {
        $investor_account_value = Company_account::where('id', $request->input('id'))->value('account_value');
        return $investor_account_value;
    }

    public function ajax_company_account_value(Request $request)
    {
        $company_account_value = Company_account::where('id', $request->input('id'))->value('account_value');
        return $company_account_value;
    }

    public function pay_profit(Request $request, $id)
    {
        $this->validate($request, [
            'contract_profit' => 'required|numeric|min:0',
            'investor_account_id' => 'required',
            'company_account_id' => 'required',
        ]);

        $contract = Contract::findOrFail($id);

        if (!$contract)
            return redirect()->back()->with(['message' => 'no contracts founded', 'alert_danger' => 'info']);

        $investor_account = Company_account::findOrFail($request->input('investor_account_id'));

        if ($investor_account->account_value < $request->input('contract_profit'))
            return redirect()->back()->with(['message' => 'your account not have enough money for this payment ', 'alert_danger' => 'info']);

        if ($contract->contract_profit - $contract->contract_profit_payment < $request->input('contract_profit'))
            return redirect()->back()->with(['message' => 'your payment is greater than required', 'alert_danger' => 'info']);

        $investor_account->account_value = $investor_account->account_value - $request->input('contract_profit');
        $investor_account->save();


        $company_account = Company_account::findOrFail($request->input('company_account_id'));
        $company_account->account_value = $company_account->account_value + $request->input('contract_profit');
        $company_account->save();


        $contract->contract_profit_payment += $request->input('contract_profit');
        $contract->save();


        //financial transaction
        $investor = $contract->investor->name;

        Financial_transaction::create([
            'created_by' => Auth()->id(),
            'updated_by' => Auth()->id(),
            'account_id' => $company_account->id,
            'user_id' => $contract->investor->id,
            'type' => 'contract_profit',
            'price' => $request->input('contract_profit'),
            'contract_id' => $contract->id,
            'notes' =>
                ' سداد عمولة عقد بمبلغ ' . $request->input('contract_profit') . ' ريال سعودى , من/' . $investor . ' /الى/ ' . ' الشركه ',
        ]);

        return redirect()->back()->with(['message' => 'your payment saved']);

    }

    //payment_fees
    public function ajax_payment_fees(Request $request)
    {

        $contract = Contract::find($request->input('id'));
        $company_accounts = Company_account::all();
        return view('contracts.ajax_payment_fees', compact('contract', 'company_accounts'));
    }

    public function pay_fees(Request $request, $id)
    {

        $this->validate($request, [
            'contract_fees' => 'required|numeric|min:0',
            'company_account_id' => 'required',
        ]);

        $contract = Contract::findOrFail($id);

        if (!$contract)
            return redirect()->back()->with(['message' => 'no contracts founded', 'alert_danger' => 'info']);


        if ($contract->fees - $contract->contract_fees_payment < $request->input('contract_fees'))
            return redirect()->back()->with(['message' => 'your payment is greater than required', 'alert_danger' => 'info']);




        $company_account = Company_account::findOrFail($request->input('company_account_id'));
        $company_account->account_value += $request->input('contract_fees');
        $company_account->save();


        $contract->contract_fees_payment += $request->input('contract_fees');
        $contract->save();

        //financial transaction
        $client = $contract->client->name;

        Financial_transaction::create([
            'created_by' => Auth()->id(),
            'updated_by' => Auth()->id(),
            'account_id' => $company_account->id,
            'user_id' => $contract->client->id,
            'type' => 'contract_fees',
            'price' => $request->input('contract_fees'),
            'contract_id' => $contract->id,
            'notes' =>
                ' سداد رسوم عقد بمبلغ ' . $request->input('contract_fees') . ' ريال سعودى , من/' . $client . ' /الى/ ' . ' الشركه ',
        ]);

        return redirect()->back()->with(['message' => 'تم الدفع بنجاح']);
    }

    //-------------end contracts type-------------------------------

    public function contract_note_store(Request $request)
    {
        $this->validate($request, [
            'note' => 'required|min:0|max:500',
        ]);

        $note = Note::create([
            'module' => 'contract',
            'module_id' => $request->input('contract_id'),
            'note' => (string)$request->input('note'),
            'created_by' => Auth()->id()
        ]);

        $logs = [
            'action' => 'create_contract_note',
            'notes' => 'user_create_contract_note',
            'attrs' => [
                'note' => $note->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message' => __('messages.contract.notes')]);
    }

    public function contract_payment($id)
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $contract = Contract::findOrFail($id);
        $premiums = ContractPremium::where('contract_id', $id)->where('status', '!=', 2)->get();
        $premiums_payment = ContractPremium::where('contract_id', $id)->sum('payment');
        return view('contracts.payment', compact('premiums', 'contract', 'premiums_payment'));
    }

    public function ajax_get_payment(Request $request)
    {
        $premium_amount = ContractPremium::where('contract_id', $request['contract_id'])->where('order', $request['order'])->value('amount');
        $premium_payment = ContractPremium::where('contract_id', $request['contract_id'])->where('order', $request['order'])->value('payment');

        return $premium_amount - $premium_payment;
    }

    public function destroy(Request $request, $id)
    {
        if (!Voyager::can('delete_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

            $contract = Contract::find($id);
        if (!$contract)
             return redirect()->back()->with(['message' => 'this contract not found', 'alert_danger' => 'info']);

        Aqsat::delete('contract', $id, true, $request->all());

        $logs = [
            'action' => 'delete_contract',
            'notes' => 'user_delete_contract',
            'attrs' => [
            'contract' => $id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect(url('admin/contracts/1/create'))->with(['message' => __('messages.contract.delete')]);
    }

    //-------------start contracts search type-------------------------------

    public function search_currently(Request $request)
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);
        $groups = Group::all();
        $contracts = Contract::where('kind', null);

        if ($request->has('contract_num') and $request['contract_num'] != null) {
            $contracts->where('contract_num', $request->input('contract_num'));
        }

        if ($request->has('client') and $request['client'] != null) {
            $contracts->whereHas('client', function ($q) {
                $q->where('name', Input::get('client'));
            });
        }

        if ($request->has('investor') and $request['investor'] != null) {
            $contracts->whereHas('investor', function ($q) {
                $q->where('name', Input::get('investor'));
            });
        }

        if ($request->has('contract_value') and $request['contract_value'] != null) {
            $contracts->where('contract_value', $request->input('contract_value'));
        }


        if ($request->has('type') and $request['type'] != null) {
            $contracts->where('contract_type', $request->input('type'));
        }

        if ($request->has('group_id') and $request['group_id'] != null) {
            $contracts->where('group_id', $request->input('group_id'));
        }


        return view('contracts.current', ['contracts' => $contracts, 'groups' => $groups]);
    }

    public function search_conflict(Request $request)
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $contracts = Contract::where('kind', 3);
        if ($request->has('contract_num') and $request['contract_num'] != null) {
            $contracts->where('contract_num', $request->input('contract_num'));
        }

        if ($request->has('client') and $request['client'] != null) {
            $contracts->whereHas('client', function ($q) {
                $q->where('name', Input::get('client'));
            });
        }

        if ($request->has('investor') and $request['investor'] != null) {
            $contracts->whereHas('investor', function ($q) {
                $q->where('name', Input::get('investor'));
            });
        }

        if ($request->has('type') and $request['type'] != null) {
            $contracts->where('contract_type', $request->input('type'));
        }

        return view('contracts.conflict', ['contracts' => $contracts]);
    }

    public function search_late_payment(Request $request)
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $contracts = Contract::where('kind', 4);

        if ($request->has('contract_num') and $request['contract_num'] != null) {
            $contracts->where('contract_num', $request->input('contract_num'));
        }

        if ($request->has('client') and $request['client'] != null) {
            $contracts->whereHas('client', function ($q) {
                $q->where('name', Input::get('client'));

            });
        }

        if ($request->has('investor') and $request['investor'] != null) {
            $contracts->whereHas('investor', function ($q) {
                $q->where('name', Input::get('investor'));
            });
        }

        if ($request->has('type') and $request['type'] != null) {
            $contracts->where('contract_type', $request->input('type'));
        }

        return view('contracts.late_payment', ['contracts' => $contracts]);
    }

    public function search_profits(Request $request)
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);


        $contracts = new Contract();
        if ($request->has('contract_num') and $request['contract_num'] != null) {
            $contracts = Contract::where('contract_num', $request->input('contract_num'));
        }

        if ($request->has('client') and $request['client'] != null) {
            $contracts = Contract::whereHas('client', function ($q) {
                $q->where('name', Input::get('client'));
            });
        }

        if ($request->has('investor') and $request['investor'] != null) {
            $contracts = Contract::whereHas('investor', function ($q) {
                $q->where('name', Input::get('investor'));
            });
        }

        if ($request->has('premium_value') and $request['premium_value'] != null) {
            $contracts = Contract::where('premiums_value', $request->input('premium_value'));
        }


        if ($request->has('type') and $request['type'] != null) {
            $contracts = Contract::where('contract_type', $request->input('type'));
        }

        return view('contracts.profits', ['contracts_profits' => $contracts]);
    }

    public function search_pure(Request $request)
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $contracts = Contract::where('kind', 2);

        if ($request->has('id') and $request['id'] != null) {
            $contracts->where('id', $request->input('id'));
        }

        if ($request->has('client') and $request['client'] != null) {
            $contracts->whereHas('client', function ($q) {
                $q->where('name', Input::get('client'));
            });
        }

        if ($request->has('investor') and $request['investor'] != null) {
            $contracts->whereHas('investor', function ($q) {
                $q->where('name', Input::get('investor'));
            });
        }

        if ($request->has('premium_value') and $request['premium_value'] != null) {
            $contracts->where('premiums_value', $request->input('premium_value'));
        }


        if ($request->has('type') and $request['type'] != null) {
            $contracts->where('contract_type', $request->input('type'));
        }

        return view('contracts.pure', ['contracts' => $contracts]);
    }

    public function search_profit(Request $request)
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $contracts = new Contract();
        if ($request->has('contract_num') and $request['contract_num'] != null) {
            $contracts = Contract::where('contract_num', $request->input('contract_num'));
        }

        if ($request->has('client') and $request['client'] != null) {
            $contracts = Contract::whereHas('client', function ($q) {
                $q->where('name', Input::get('client'));
            });
        }

        if ($request->has('investor') and $request['investor'] != null) {
            $contracts = Contract::whereHas('investor', function ($q) {
                $q->where('name', Input::get('investor'));
            });
        }

        if ($request->has('premium_value') and $request['premium_value'] != null) {
            $contracts = Contract::where('premiums_value', $request->input('premium_value'));
        }

        if ($request->has('type') and $request['type'] != null) {
            $contracts = Contract::where('contract_type', $request->input('type'));
        }

        return view('contracts.profit', ['contracts' => $contracts]);

    }

    public function search_premiums(Request $request)
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $contracts = Contract::orderBy('id', 'asc');

        if ($request->has('client') and $request['client'] != null) {
            $contracts->whereHas('client', function ($q) {
                $q->where('name', Input::get('client'));
            });
        }

        if ($request->has('investor') and $request['investor'] != null) {
            $contracts->whereHas('investor', function ($q) {
                $q->where('name', Input::get('investor'));
            });
        }

        $premiums = '';
        if ($contracts) {
            $contracts_id = $contracts->select('id')->get()->toArray();
            $premiums = ContractPremium::whereIn('contract_id', $contracts_id);
        }


        if ($request->has('pay_status') and $request['pay_status'] != null) {
            $premiums = ContractPremium::where('status', $request->input('pay_status'));
        }


        return view('contracts.premiums', ['premiums' => $premiums]);

    }

    public function search_fees(Request $request)
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $contracts = new Contract();
        if ($request->has('contract_num') and $request['contract_num'] != null) {
            $contracts = Contract::where('contract_num', $request->input('contract_num'));
        }

        if ($request->has('client') and $request['client'] != null) {
            $contracts = Contract::whereHas('client', function ($q) {
                $q->where('name', Input::get('client'));
            });
        }

        if ($request->has('investor') and $request['investor'] != null) {
            $contracts = Contract::whereHas('investor', function ($q) {
                $q->where('name', Input::get('investor'));
            });
        }

        if ($request->has('premium_value') and $request['premium_value'] != null) {
            $contracts = Contract::where('premiums_value', $request->input('premium_value'));
        }

        if ($request->has('type') and $request['type'] != null) {
            $contracts = Contract::where('contract_type', $request->input('type'));
        }

        return view('contracts.fees', ['contracts' => $contracts]);

    }

    public function search_issue(Request $request)
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $groups = Group::all();
        $contracts = Contract::where('kind', 5);

        if ($request->has('id') and $request['id'] != null) {
            $contracts->where('id', $request->input('id'));
        }

        if ($request->has('client') and $request['client'] != null) {
            $contracts->whereHas('client', function ($q) {
                $q->where('name', Input::get('client'));
            });
        }

        if ($request->has('investor') and $request['investor'] != null) {
            $contracts->whereHas('investor', function ($q) {
                $q->where('name', Input::get('investor'));
            });
        }

        if ($request->has('contract_value') and $request['contract_value'] != null) {
            $contracts->where('contract_value', $request->input('contract_value'));
        }


        if ($request->has('type') and $request['type'] != null) {
            $contracts->where('contract_type', $request->input('type'));
        }

        if ($request->has('group_id') and $request['group_id'] != null) {
            $contracts->where('group_id', $request->input('group_id'));
        }


        return view('contracts.issue', ['contracts' => $contracts, 'groups' => $groups]);
    }


    public function search_late_premiums(Request $request)
    {
         if (!Voyager::can('show_contracts'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $premiums = ContractPremium::where('status', 3)->orderBy('id', 'asc');

        if ($request->has('dstart') and $request['dstart'] != null) {
            $premiums->where('date_type_mi', '>=', $request->input('dstart'));
        }

        if ($request->has('dend') and $request['dend'] != null) {
            $premiums->where('date_type_mi', '<=', $request->input('dend'));
        }


        if ($request->has('id') and $request['id'] != null) {
            $premiums->where('id', $request->input('id'));
        }


        return view('contracts.premium_late', ['late_premiums' => $premiums]);

    }


    //-------------end contracts search type-------------------------------

}



