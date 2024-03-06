<?php

namespace App\Http\Controllers\backend;

use App\Events\UserLogs;
use App\PrintTemplate;
use App\PrintAction;
use Illuminate\Http\Request;
use  TCG\Voyager\Facades\Voyager;
use App\Http\Controllers\Controller;

class PrintsController extends Controller
{
    public function index(){

        if (!Voyager::can('show_prints'))
            return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $this->data['data'] = PrintTemplate::all();
        return view('prints.index',$this->data);
    }

    public function store(Request $request){

        // if (!Voyager::can('create_prints'))
        //     return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $this->validate($request,[
            'type'=>'required|max:50'
        ]);

        $temp = PrintTemplate::create([
            'content'=>$request->input('content'),
            'created_by'=>Auth()->id(),
            'updated_by'=>Auth()->id(),
        ]);

        $logs = [
            'action' => 'create_template',
            'notes' => 'user_create_template',
            'attrs' => [
                'template' => $group->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message'=> __('messages.prints.create')]);
    }


     public function update(Request $request, $temp_id){

        // if (!Voyager::can('edit_prints'))
        //     return redirect()->back()->with(['message' => __('messages.permissions.access'), 'alert_danger' => 'info']);

        $this->validate($request,[
            'type'=>'required|max:50'
        ]);

        $temp = PrintTemplate::findOrFail($temp_id);

        $temp->update([
            'content'=>$request->input('content'),
            'updated_by'=>Auth()->id(),
        ]);

        $logs = [
            'action' => 'update_template',
            'notes' => 'user_update_template',
            'attrs' => [
                'template' => $temp->id,
            ],

        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message'=> __('messages.prints.update')]);
    }

    

}
