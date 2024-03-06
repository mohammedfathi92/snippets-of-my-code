<?php

namespace App\Http\Controllers\backend;

use App\Company_account;
use App\Events\UserLogs;
use App\Financial_transaction;
use App\Note;
use App\ProductPayment;
use App\Profile;
use App\Target;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\Controller;

class InvestorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Voyager::can('show_investors'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $this->data['investors'] = user::where('is_investor', 1)->orderBy('id', 'desc');
        return view('investors.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Voyager::can('create_investors'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        return view('investors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [

            'full_name' => 'required|string|max:255',
            'formal_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'national_id' => 'numeric|min:7',
            'release_date' => 'date',
            'total_account' => 'min:0',
            'release_place' => 'max:50',
            'mobile' => 'max:25',
            'phone' => 'max:25',
            'address' => 'max:60',
            'work' => 'max:50',
            'work_phone' => 'max:25',
            'nationality' => 'max:40',
            // 'release_date_type' => 'required',
        ]);


        if ($request['total_account'] < 0)
            return redirect()->back()->with(['message' => __('messages.investor.total_account_check'), 'alert_danger' => 'info']);

        if ($request->has('out_product')) {

            $this->validate($request, [
                'quantity' => 'min:0|required',
                'price' => 'min:0|required',
            ]);


            $total = $request->input('quantity') * $request->input('price');
            if ($request->input('total_account') < $total)
                return redirect()->back()->with(['message' => __('messages.investor.total_account'), 'alert_danger' => 'info']);

            $request['total_account'] = $request->input('total_account') - $total;
        }

        $user = User::create([
            'name' => $request['full_name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'is_investor' => 1,
        ]);

        Profile::create([
            'full_name' => $request->full_name,
            'formal_name' => $request->formal_name,
            'national_id' => $request->national_id,
            'release_date' => $request->release_date,
            'release_place' => $request->release_place,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'address' => $request->address,
            'work' => $request->work,
            'work_phone' => $request->work_phone,
            'nationality' => $request->nationality,
            'user_id' => $user->id,
            'gender' => $request->gender,
            // 'release_date_type' => $request->release_date_type,
        ]);


        if ($request->has('out_product')) {

            $new_product = new ProductPayment;
            $new_product->user_id = $user->id;
            $new_product->product_id = 1;
            $new_product->quantity = $request->input('quantity');
            $new_product->price = $request->input('price');
            $new_product->save();
        }


        $account = Company_account::create([
            'created_by' => Auth()->id(),
            'account_value' => $request['total_account'],
            'account_name' => $request['account_name'],
            'user_name' => $user->name,
            'account_number' => '0',
            'user_id' => $user->id,
            'status' => 1,
            'notes' => __('messages.investor.company_account', ['name' => $user->name]),
        ]);

        Financial_transaction::create([
            'created_by' => Auth()->id(),
            'updated_by' => Auth()->id(),
            'user_id' => $user->id,
            'type' => 'deposit',
            'account_id' => $account->id,
            'price' => $request['total_account'],
            'notes' => __('messages.investor.Financial', ['name' => $user->name, 'amount' => $request['total_account']]),
        ]);

        $logs = [
            'action' => 'create_investor',
            'notes' => 'user_create_investor',
            'attrs' => [
                'investor' => $user->id,
            ],

        ];
        event(new UserLogs($logs));


        return redirect(route('investors.show', $user->id))->with(['message' => __('messages.investor.create')]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Voyager::can('show_investors'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $this->data['investor'] = User::findOrFail($id);
        $this->data['investor_contracts'] = $this->data['investor']->contracts;
        $this->data['investor_accounts'] = $this->data['investor']->company_account;
        $this->data['investor_notes'] = Note::where('module', 'investor')->where('module_id', $id)->get();

         $this->data['users'] = User::where('is_client',1)
        ->whereHas('client_contracts', function ($query) use ($id) {
          $query->where('investor_id', $id)->where('kind', 4);

       });
        return view('investors.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Voyager::can('edit_investors'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $this->data['investor'] = User::findOrFail($id);
        return view('investors.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'full_name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'formal_name' => 'string|max:255',
            'national_id' => 'min:7',
            'release_date' => 'date',
            'release_place' => 'max:50',
            'mobile' => 'max:25',
            'phone' => 'max:25',
            'address' => 'max:60',
            'work' => 'max:50',
            'work_phone' => 'max:25',
            'nationality' => 'max:40',
           

        ]);

        //save in users table
        $user = User::findOrFail($id);

        $user->name = $request->full_name;
        $user->email = $request->email;

        $user->save();

        //save in profile table
        $user->profile->full_name = $request->input('full_name');
        $user->profile->formal_name = $request->input('formal_name');
        $user->profile->national_id = $request->input('national_id');
        $user->profile->release_date = $request->input('release_date');
        $user->profile->release_place = $request->input('release_place');
        $user->profile->mobile = $request->input('mobile');
        $user->profile->phone = $request->input('phone');
        $user->profile->address = $request->input('address');
        $user->profile->work = $request->input('work');
        $user->profile->work_phone = $request->input('work_phone');
        $user->profile->nationality = $request->input('nationality');
        //$user->profile->release_date_type = $request->input('release_date_type');
        $user->profile->gender = $request->input('gender');
        
      

        $user->profile->save();

        $logs = [
            'action' => 'update_investor',
            'notes' => 'user_update_investor',
            'attrs' => [
                'investor' => $user->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message' => __('messages.investor.update')]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (!Voyager::can('delete_investors'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        if ($id == 1)
            return redirect()->back()->with(['message' => __('messages.investor.main_investor'), 'alert_danger' => 'info']);

        User::findOrFail($id)->delete();


        $logs = [
            'action' => 'delete_investor',
            'notes' => 'user_delete_investor',
            'attrs' => [
                'investor' => $id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect(route('investors.'))->with(['message' => __('messages.investor.delete')]);
    }


//deposit money
    public function deposit($type = null)
    {
         if (!Voyager::can('create_financial_transactions'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        if ($type == 'company') {
            $this->data['type'] = $type;
        }

        $this->data['company_accounts'] = Company_account::where('user_id', 1)->get();
        $this->data['investors'] = User::where('is_investor', 1)->select('name', 'id')->get();
        return view('investors.deposit', $this->data);
    }

    public function ajax_user_deposit(Request $request)
    {
        $investor = User::findOrFail($request['id']);
        $accounts = $investor->company_account;
        return view('investors.ajax_deposit_accounts', compact('accounts'));
    }

    public function ajax_deposit_account_value(Request $request)
    {
        $account = Company_account::findOrFail($request['id']);
        return $account->account_value;
    }

    public function deposit_store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|integer|min:0',
            'user_id' => 'required|integer',
            'account_id' => 'required|integer'
        ]);

        $account = Company_account::where('id', $request['account_id'])->first();

        $new_account = $account->account_value + $request['amount'];

        $account->account_value = $new_account;

        // $account->notes = $request['notes'];

        $account->save();


        if ($request->has('out_product')) {

            $this->validate($request, [
                'quantity' => 'min:0|required',
                'price' => 'min:0|required',
            ]);

            $total = $request->input('quantity') * $request->input('price');
            if ($request->input('after') + $request['amount'] < $total)
                return redirect()->back()->with(['message' => __('messages.deposit.check_money'), 'alert_danger' => 'info']);


            $new_product = new ProductPayment;
            $new_product->user_id = $request->input('investor_id');
            $new_product->product_id = 1;
            $new_product->quantity = $request->input('quantity');
            $new_product->price = $request->input('price');
            $new_product->save();
        }


        if ($request->has('out_product')) {
            $total_price = $request->input('quantity') * $request->input('price');
            $account->account_value = ($request->input('after') + $request['amount']) - $total_price;
            $account->save();
        }

        $user = User::findOrFail($request->input('user_id'));

        $financial = Financial_transaction::create([
            'created_by' => Auth()->id(),
            'updated_by' => Auth()->id(),
            'account_id' => $request->input('account_id'),
            'user_id' => $request->input('user_id'),
            'type' => 'deposit',
            'price' => $request->input('amount'),
            'notes' => __('messages.deposit.Financial', ['name' => $user->name, 'amount' => $request['amount']]),
        ]);
        if($request->input('note')){

          $note = Note::create([
            'module' => 'financial_process',
            'module_id' => $financial->id,
            'note' => $request->input('note'),
            'created_by' => Auth()->id()
        ]);
          }

        $logs = [
            'action' => 'create_deposit',
            'notes' => 'user_create_deposit',
            'attrs' => [
                'deposit' => $financial->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message' => __('messages.deposit.create')]);
    }

//pull money
    public function pull_from_account($type = null, $type_2 = null)
    {
         if (!Voyager::can('create_financial_transactions'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);
        if ($type == 'company') {
            $this->data['type'] = $type;
        }

        if ($type_2 == 'company_payments') {
            $this->data['type_2'] = $type_2;
        }

        $this->data['company_accounts'] = Company_account::where('user_id', 1)->get();
        $this->data['investors'] = User::where('is_investor', 1)->select('name', 'id')->get();

        $this->data['targets'] = Target::all();

        $this->data['pull_expenses'] = Financial_transaction::where('type', 'pull_expenses')->get();

        return view('investors.pull', $this->data);
    }

    public function pull_store(Request $request)
    {

        $this->validate($request, [
            'amount' => 'required|integer|min:0',
            'user_id' => 'required|integer',
            'account_id' => 'required|integer'
        ]);

        if ($request->has('type_2') and $request->input('target_id') == null)
            return redirect()->back()->with(['message' => 'target is required', 'alert_danger' => 'inf']);

        $account = Company_account::where('id', $request->input('account_id'))->first();

        if ($request->input('amount') <= $account->account_value) {
            $new_account = $account->account_value - $request->input('amount');

            $account->account_value = $new_account;

            $account->save();

         

            $user = User::findOrFail($request->input('user_id'));

            if ($request->has('type_2')) {
                $type = 'pull_expenses';
                $note = __('messages.pull.Financial_company', ['name' => $user->name, 'amount' => $request['amount']]);
            } else {
                $type = 'pull';
                $note = __('messages.pull.Financial_investor', ['name' => $user->name, 'amount' => $request['amount']]);
            }

            $financial = Financial_transaction::create([
                'created_by' => Auth()->id(),
                'updated_by' => Auth()->id(),
                'target_id' => $request->input('target_id'),
                'account_id' => $request->input('account_id'),
                'user_id' => $request->input('user_id'),
                'type' => $type,
                'price' => $request->input('amount'),
                'notes' => $note,
            ]);

             if($request->input('note')){

        $note = Note::create([
            'module' => 'financial_process',
            'module_id' => $financial->id,
            'note' => $request->input('note'),
            'created_by' => Auth()->id()
        ]);

    }

            $logs = [
                'action' => 'create_pull',
                'notes' => 'user_create_pull',
                'attrs' => [
                    'pull' => $financial->id,
                ],

            ];
            event(new UserLogs($logs));


            return redirect()->back()->with(['message' => __('messages.pull.create')]);
        } else {
            return redirect()->back()
                ->with(['message' => __('messages.pull.check_money'), 'alert_danger' => 'alert-danger']);
        }
    }

// transfer money
    public function transfer_process()
    {
         if (!Voyager::can('create_financial_transactions'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);
        $this->data['investors'] = User::where('is_investor', 1)->select('name', 'id')->get();
        return view('investors.transfer', $this->data);
    }

    public function make_transfer(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric|min:0',
            'from_user_id' => 'required|integer',
            'to_user_id' => 'required|integer',
            'from_account_id' => 'required|integer',
            'to_account_id' => 'required|integer',
        ]);


        $from_account = Company_account::where('id', $request->input('from_account_id'))->first();

        if ($request->input('amount') <= $from_account->account_value) {
            $from_account->account_value = $from_account->account_value - $request->input('amount');

            $from_account->save();

            $to_account = Company_account::where('id', $request->input('to_account_id'))->first();

            $to_account->account_value = $to_account->account_value + $request->input('amount');

            $to_account->save();


            $user_from = User::findOrFail($request->input('from_user_id'));

            $user_to = User::findOrFail($request->input('to_user_id'));

            $financial= Financial_transaction::create([
                'created_by' => Auth()->id(),
                'updated_by' => Auth()->id(),
                'account_id' => $request->input('from_account_id'),
                'user_id' => $request->input('from_user_id'),
                'to_user' => $request->input('to_user_id'),
                'to_account' => $request->input('to_account_id'),
                'type' => 'transfer',
                'price' => $request->input('amount'),
                'notes' => __('messages.transfer.Financial', ['name' => $user_from->name, 'amount' => $request['amount'], 'name_2' => $user_to->name]),
            ]);

         if($request->input('note')){

              $note = Note::create([
            'module' => 'financial_process',
            'module_id' => $financial->id,
            'note' => $request->input('note'),
            'created_by' => Auth()->id()
        ]);
          }

            $logs = [
                'action' => 'create_transfer',
                'notes' => 'user_create_transfer',
                'attrs' => [
                    'transfer' => $financial->id,
                ],

            ];
            event(new UserLogs($logs));

            return redirect()->back()->with(['message' => __('messages.transfer.create')]);
        }

        return redirect()->back()
            ->with(['message' => __('messages.transfer.check_money'), 'alert_danger' => 'info']);
    }

//advanced_search
    public function advanced_search(Request $request)
    {
         if (!Voyager::can('show_investors'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);

        $investors = User::where('is_investor', 1);
        if ($request->has('name') and $request['name'] != null) {
            $investors->where('is_investor', 1)->where('name', $request->input('name'));
        }

        if ($request->has('national_id') and $request['national_id'] != null) {
            $investors->whereHas('profile', function ($q) {
                $q->where('national_id', Input::get('national_id'));
            });
        }

        if ($request->has('mobile') and $request['mobile'] != null) {
            $investors->whereHas('profile', function ($q) {
                $q->where('mobile', Input::get('mobile'));
            });
        }

        return view('investors.index', ['investors' => $investors]);
    }

//investor_notes
    public function investor_note_store(Request $request, $id)
    {
        
        $this->validate($request, [
            'note' => 'required|min:0|max:500',
        ]);

        $note = Note::create([
            'module' => 'investor',
            'module_id' => $id,
            'note' => (string)$request->input('note'),
            'created_by' => Auth()->id(),
        ]);

        $logs = [
            'action' => 'create_note',
            'notes' => 'user_create_note',
            'attrs' => [
                'note' => $note->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message' => __('messages.investor.notes')]);
    }

}
