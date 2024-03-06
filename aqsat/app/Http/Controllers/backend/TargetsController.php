<?php

namespace App\Http\Controllers\backend;

use App\Events\UserLogs;
use App\Target;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TargetsController extends Controller
{
    public function index(){
        $this->data['targets'] = Target::all();
        return view('targets.index',$this->data);
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required|max:100',
        ]);

        $target = Target::create([
            'name'=>$request->input('name'),
            'created_by'=>Auth()->id(),
            'updated_by'=>Auth()->id(),
        ]);

        $logs = [
            'action' => 'create_target',
            'notes' => 'user_create_target',
            'attrs' => [
                'target' => $target->id,
            ],
        ];
        event(new UserLogs($logs));

        return redirect()->back()->with(['message'=> __('messages.targets.create')]);
    }
}
