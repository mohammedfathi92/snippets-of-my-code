<?php

namespace App\Http\Controllers\backend;

use App\Collection;
use App\Contract;
use App\ContractPremium;
use App\Events\UserLogs;
use App\User;
use App\Note;
use Carbon\Carbon;
use GeniusTS\HijriDate\Hijri;
use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;

class CollectionsController extends Controller
{
    public function index()
    {
        if(!Voyager::can('show_collections'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $this->data['users'] = User::where('is_client',1)->whereHas('client_contracts', function($q){
            $q->where('kind', '!=', 2);

        })->with('client_contracts')->get();
        return view('collections.index', $this->data);
    }

    public function create($id){
        if(!Voyager::can('create_collections'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $coll = Collection::findOrFail($id);
        $this->data['clients'] = User::where('is_client', 1)->get();
        return view('collections.create',$this->data);
    }

    public function ajax_get_premiums(Request $request)
    {
        $contract = Contract::findOrFail($request->input('id'));
        return view('collections.ajax_form_notes', compact('contract'));
    }

    public function ajax_get_premium(Request $request)
    {
        $premium = ContractPremium::where('id',$request->input('id'))->first();
        return view('collections.ajax_form_note',compact('premium'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'call_date' => 'required|date',
            'notes' => 'max:500',
            'call_status' => 'required|integer',
            'user_phone'=>'required',
            'note_type'=>'required',
            'contract_id'=>'required',
        ]);


        $request->merge(['created_by' => Auth()->id()]);

        $client_no = strpos($request->input('user_phone'), "c_");
        $kafil_1_no = strpos($request->input('kafil_1'), "k1_");
        $kafil_2_no = strpos($request->input('kafil_2'), "k2_");
        if($client_no !== false){
            $phone = str_replace("c_","",$request->input('user_phone'));
            $request->merge(['phone' => $phone, 'phone_type'=> 'client']);
        }
        if($kafil_1_no !== false){
             $phone = str_replace("k1_","",$request->input('user_phone'));
            $request->merge(['phone' => $kafil_1_no, 'phone_type'=> 'kafil_1']);
        }
        if($kafil_2_no !== false){
             $phone = str_replace("k2_","",$request->input('user_phone'));
            $request->merge(['phone' => $kafil_2_no, 'phone_type'=> 'kafil_2']);
        }

        $collection = Collection::create($request->all());

        $logs = [
            'action' => 'create_collection',
            'notes' => 'user_create_collection',
            'attrs' => [
                'collection' => $collection->id,
            ],
        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message' => __('messages.collections.create')]);
    }

    public function show($id){
        if(!Voyager::can('show_collections'))
            return redirect()->back()->with(['message'=>__('messages.permissions.access'),'alert_danger'=>'info']);

        $notes = Collection::where('premium_id',$id)->get();
        $premium = ContractPremium::findOrFail($id);

        return view('collections.show',compact('notes','premium'));
    }

    public function ajax_get_note(Request $request){
        $note = Collection::where('id',$request->input('id'))->value('notes');
        return $note;
    }

    public function late_client_premiums($contract_id, $user_id){

         if(!Voyager::can('show_collections'))
            return redirect()->back()->with(['message'=> __('messages.permissions.access'),'alert_danger'=>'info']);

        $contract = Contract::where('id', $contract_id)->where('client_id', $user_id)->first();
        if(!$contract)
            return redirect()->back()->with(['message'=>'لا توجد بيانات لهذا العقد' ,'alert_danger'=>'danger']);

        $user = User::findOrFail($user_id);
        // dd($user->name);
        if(!$user)
            return redirect()->back()->with(['message'=>'حدث خطأ ما' ,'alert_danger'=>'danger']);

        $users_data = [];
   $client = $user;
     $clientName = '';
     // dd($user->name);
     if($client){
       $users_data[] = ['type'=>'client', 'data'=> $client];
     }
     $kafil_1_name = '';
     if($contract->sponsor_id){
     $kafil_1 = User::findOrFail($contract->sponsor_id);
     if($kafil_1){
       $users_data[] = ['type'=>'kafil_1', 'data'=> $kafil_1];
     }
     }
     $kafil_2_name = '';
   if($contract->sponsor_two_id){
     $kafil_2 = User::findOrFail($contract->sponsor_two_id);
     if($kafil_2){
       $users_data[] = ['type'=>'kafil_2', 'data'=> $kafil_2];
     }
   }

        
        $this->data['user'] = $user;
        $this->data['users_data'] = $users_data;
        // $this->data['client_contracts'] = $user->contracts->where('kind',4);
         $this->data['contract'] = $contract;
       $this->data['contract_notes'] = Note::where('module', 'contract')->where('module_id', $contract->id);
        $this->data['notes'] = $user->collections->where('note_type', 1);
        // $this->data['investor_general_note'] = $user->collections->where('note_type', 2)->last();
        // $this->data['admin_general_note'] = $user->collections->where('note_type', 3)->last();

        return view('collections.client_late_premiums', $this->data);
    }

public function ajax_user_mobiles($contract_id){

$contract = Contract::find($contract_id);
if (!$contract) {
    return redirect()->back()->with(['message'=>'Not found contract' ,'alert_danger'=>'info']);
}

$users = [];
   $client = User::findOrFail($contract->client_id);
     $clientName = '';
     if($client){
       $users[] = ['type'=>'client', 'data'=> $client];
     }
     $kafil_1_name = '';
     if($contract->sponsor_id){
     $kafil_1 = User::findOrFail($contract->sponsor_id);
     if($kafil_1){
       $users[] = ['type'=>'kafil_1', 'data'=> $kafil_1];
     }
     }
     $kafil_2_name = '';
   if($contract->sponsor_two_id){
     $kafil_2 = User::findOrFail($contract->sponsor_two_id);
     if($kafil_2){
       $users[] = ['type'=>'kafil_2', 'data'=> $kafil_2];
     }
   }
        return view('collections.ajax_user_mobiles',compact('users'));
    }




}
