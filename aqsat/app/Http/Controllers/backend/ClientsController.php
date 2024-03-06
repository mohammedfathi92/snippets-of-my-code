<?php

namespace App\Http\Controllers\backend;

use App\Collection;
use App\Events\UserLogs;
use App\Note;
use App\Profile;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;

use TCG\Voyager\Facades\Voyager;

class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(!Voyager::can('show_clients'))
            return redirect()->back()->with(['message'=> __('messages.permissions.access'),'alert_danger'=>'info']);

        $this->data['clients'] = user::where('is_client', 1)->orderBy('id', 'desc');
        return view('clients.index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Voyager::can('create_clients'))
            return redirect()->back()->with(['message'=> __('messages.permissions.access'),'alert_danger'=>'info']);
        return view('clients.create');
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
       //     'email' => 'required|string|email|max:255|unique:users',
            'notes' => 'max:255',
            'national_id' => 'numeric|min:7',
            'release_date' => 'date',
            'release_place'=> 'max:50',
            'mobile'=>'max:25',
            'phone'=>'max:25',
            'address'=>'max:60',
            'work'=>'max:50',
            'work_phone'=>'max:25',
            'nationality'=>'max:40',
            // 'release_date_type' => 'required',
        ]);



        $user = User::create([
            'name' => $request['full_name'],
            'email' => random_int(10, 10000).hexdec(uniqid()).'@gmail.com',
            'password' => bcrypt('FMxanX2D\[-a&&8_'),
            'is_client' => 1,
        ]);

        $user->email = $user->id.random_int(10, 10000).hexdec(uniqid()).'@gmail.com';
        $user->save();

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
            'notes' => $request->notes,
            'gender' => $request->gender,
              // 'release_date_type' => $request->release_date_type,
        ]);


        $logs = [
            'action' => 'create_client',
            'notes' => 'user_create_client',
            'attrs' => [
                'client' => $user->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect(route('clients.show',$user->id))->with(['message' => __('messages.client.create')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if(!Voyager::can('show_clients'))
            return redirect()->back()->with(['message'=> __('messages.permissions.access'),'alert_danger'=>'info']);

        $this->data['clients'] = User::where('is_client',1)->get();
        $this->data['client'] = User::findOrFail($id);
        $this->data['client_accounts'] = $this->data['client']->company_account;
        $this->data['client_notes'] = Note::where('module','client')->where('module_id',$id)->get();

        return view('clients.show', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Voyager::can('edit_clients'))
            return redirect()->back()->with(['message'=> __('messages.permissions.access'),'alert_danger'=>'info']);

        $this->data['client'] = User::findOrFail($id);
        return view('clients.edit', $this->data);
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
            'formal_name' => 'required|string|max:255',
          //  'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'notes' => 'max:255',
            'national_id' => 'min:7',
            'release_date' => 'date',
            'release_place'=> 'max:50',
            'mobile'=>'max:25',
            'phone'=>'max:25',
            'address'=>'max:60',
            'work'=>'max:50',
            'work_phone'=>'max:25',
            'nationality'=>'max:40',
             
        ]);


        //save in users table
        $user = User::findOrFail($id);

        $user->name = $request->input('full_name');
       // $user->email = $request->email;

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
        $user->profile->gender = $request->input('gender');
        $user->profile->notes = $request->input('notes');
        //$user->profile->release_date_type = $request->input('release_date_type');
        $user->profile->gender = $request->input('gender');
         

        $user->profile->save();

        $logs = [
            'action' => 'update_client',
            'notes' => 'user_update_client',
            'attrs' => [
                'client' => $user->id,
            ],

        ];
        event(new UserLogs($logs));


        return redirect()->back()->with(['message' => __('messages.client.update')]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(!Voyager::can('delete_clients'))
            return redirect()->back()->with(['message'=> __('messages.permissions.access'),'alert_danger'=>'info']);

        User::findOrFail($id)->delete();

        $logs = [
            'action' => 'delete_client',
            'notes' => 'user_delete_client',
            'attrs' => [
                'client' => $id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message' => __('messages.client.delete')]);
    }

    public function advanced_search(Request $request)
    {
         if(!Voyager::can('show_clients'))
            return redirect()->back()->with(['message'=> __('messages.permissions.access'),'alert_danger'=>'info']);

        $clients = User::where('is_client', 1);
        if ($request->has('name') and $request['name'] != null) {
            $clients->where('is_client', 1)->where('name', $request->input('name'));
        }

        if ($request->has('national_id') and $request['national_id'] != null) {
            $clients->whereHas('profile', function ($q) {
                $q->where('national_id', Input::get('national_id'));
            });
        }

        if ($request->has('mobile') and $request['mobile'] != null) {
            $clients->whereHas('profile', function ($q) {
                $q->where('mobile', Input::get('mobile'));
            });
        }

        return view('clients.index', ['clients' => $clients]);
    }


    public function client_note_store(Request $request,$id)
    {
        $this->validate($request, [
            'note' => 'required|min:0|max:500',
        ]);

        $note = Note::create([
            'module'=>'client',
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

        return redirect()->back()->with(['message' => __('messages.client.notes')]);
    }

}
