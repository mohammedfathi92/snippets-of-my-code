<?php

namespace App\Http\Controllers;

use App\updateOut;
use Illuminate\Http\Request;

use App\Http\Requests;

class syncOutController extends Controller
{
    protected $success=false;
    protected $data=null;

    function index(Request $request){
        // export data
        $data=updateOut::all();
        if($data){
            $this->data=$data;
            $this->success=true;

        }

        return response()->json(['success'=>$this->success,'data'=>$this->data]);
    }
}
