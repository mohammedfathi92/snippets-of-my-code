<?php

namespace App\Http\Controllers\backend;

use App\Events\UserLogs;
use App\Group;
use Illuminate\Http\Request;
use  TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
{
    public function index(){

        if (!Voyager::can('show_groups'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $this->data['groups'] = Group::all();
        return view('groups.index',$this->data);
    }

    public function store(Request $request){

        if (!Voyager::can('create_groups'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $this->validate($request,[
            'name'=>'required|max:50'
        ]);

        $group = Group::create([
            'name'=>$request->input('name'),
            'created_by'=>Auth()->id(),
            'updated_by'=>Auth()->id(),
        ]);

        $logs = [
            'action' => 'create_group',
            'notes' => 'user_create_group',
            'attrs' => [
                'group' => $group->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message'=> __('messages.groups.create')]);
    }

    public function ajax_edit_group(Request $request){
        $group = Group::findOrFail($request['id']);
        return view('groups.ajax_group_edit',compact('group'));
    }

    public function update(Request $request){

        if (!Voyager::can('edit_groups'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);


        $this->validate($request,[
            'name'=>'required',
        ]);

        $account = Group::findOrFail($request->input('group_id'));

        $account->name = $request->input('name');
        $account->updated_by = Auth()->id();
        $account->save();

        $logs = [
            'action' => 'update_group',
            'notes' => 'user_update_group',
            'attrs' => [
                'group' => $account->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message'=>  __('messages.groups.update')]);


    }

}
