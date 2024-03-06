<?php

namespace App\Http\Controllers\backend;


use App\Note;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function index($id, $slug)
    {
        
    	$investor = User::findOrFail($id);
        $this->data['investor'] = $investor;
        $this->data['investor_contracts'] = $investor->contracts;
        $this->data['investor_accounts'] = $investor->company_account;
        $this->data['investor_notes'] = Note::where('module','investor')->where('module_id',$id)->get();
        return view('frontend.profile.index', $this->data);
    }


     /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    
}
