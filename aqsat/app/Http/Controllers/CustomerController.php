<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Contract;
use App\Events\UserLogs;
use App\ContractPremium;
use App\Group;
use App\Note;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */



     public function index()
    {
 if (!Auth::user()) {

            return redirect()->route("login")->with(['message' => trans("auth.must_login"), 'alert-type' => 'error']);
        }
        $investor = User::findOrFail(auth()->id());
        $this->data['investor'] = $investor;
        $this->data['investor_contracts'] = $investor->contracts;
        $this->data['investor_accounts'] =$investor->company_account;
        $this->data['investor_notes'] = Note::where('module', 'investor')->where('module_id', auth()->id())->get();

           $this->data['users'] = User::where('is_client',1)
        ->whereHas('client_contracts', function ($query) {
          $query->where('investor_id', auth()->id())->where('kind', '!=', 2);
      })->with('client_contracts')->get();


      //    $this->data['users'] = User::where('is_client',1)
      //   ->whereHas('client_contracts', function ($query) {
      //     $query->where('kind', 4)->where('investor_id', auth()->id());
      // })->with('client_contracts')->get();


        return view('frontend.profile.index', $this->data);
       
        
    }

   public function late_client_premiums($contract_id){
     if (!Auth::user()) {

            return redirect()->route("login")->with(['message' => trans("auth.must_login"), 'alert-type' => 'error']);
        }

        $contract = Contract::findOrFail($contract_id);
        if(!$contract)
            return redirect()->back()->with(['message'=>'العقد غير متاح' ,'alert_danger'=>'info']);
         if($contract->investor_id != Auth()->id())
            return redirect()->back()->with(['message'=>"عفواّ ليس لديك القدرة على رؤية هذا العقد" ,'alert_danger'=>'info']);

        // $user = auth()->user();
        // if(!$user)
        //     return redirect()->back()->with(['message'=>'no users found' ,'alert_danger'=>'info']);

        $users_data = [];
   $client = User::findOrFail($contract->client_id);
     
     if($client){
       $users_data[] = ['type'=>'client', 'data'=> $client];
     }
    
     if($contract->sponsor_id){
     $kafil_1 = User::findOrFail($contract->sponsor_id);
     if($kafil_1){
       $users_data[] = ['type'=>'kafil_1', 'data'=> $kafil_1];
     }
     }
    
   if($contract->sponsor_two_id){
     $kafil_2 = User::findOrFail($contract->sponsor_two_id);
     if($kafil_2){
       $users_data[] = ['type'=>'kafil_2', 'data'=> $kafil_2];
     }
   }

        
        $this->data['user'] = $client;
        $this->data['users_data'] = $users_data;
        // $this->data['client_contracts'] = $user->contracts->where('kind',4);
         $this->data['contract'] = $contract;
            // get previous & next user id
    // $this->data['previous_user'] = $client->where('id', '<', $user->id)->max('id');
    // $this->data['next_user'] = $client->where('id', '>', $user->id)->min('id');


        $contract_notes = Note::where('module', 'contract')->where('module_id', $contract->id);
        $this->data['notes'] = $client->collections->where('note_type', 1);
        $this->data['investor_notes'] = $contract_notes->where('created_by',  $contract->investor_id);

        return view('frontend.profile.aqsat_notes', $this->data);
    }

      

    public function contract_note_store(Request $request)
    {
        $this->validate($request, [
            'note' => 'required|min:0|max:500',
        ]);

        $note = Note::create([
            'module' => 'contract',
            'module_id' => $request->input('contract_id'),
            'note' => $request->input('note'),
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

        public function showContract($contract_id){
         $contract = Contract::where('id', $contract_id)->where('investor_id', Auth()->id())->first();

          if (!$contract)
            return redirect()->back()->with(['message' => 'هذا العقد غير متاح', 'alert_danger' => 'info']);

        $total = 0;



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

        $late_payment = ContractPremium::where('contract_id', $contract_id)
                ->where('date_type_mi', '<', \Carbon\Carbon::now()->subDays($numOfLateDays))
                ->whereColumn('payment', '<', 'amount')->sum('amount') - ContractPremium::where('contract_id', $contract_id)
                ->where('date_type_mi', '<', \Carbon\Carbon::now()->subDays($numOfLateDays))
                ->whereColumn('payment', '<', 'amount')->sum('payment');

        return view('frontend.profile.show_contract',
            compact(['contract', 'total', 'premium_date', 'premiums', 'premiums_payment', 'groups', 'late_payment']));
    }


    function ajax_get_note(Request $request){
        $note = \App\Collection::where('id',$request->input('id'))->value('notes');
        return $note;
   

    }



    
}
