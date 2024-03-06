<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;

use App\Http\Requests;

class AboutController extends Controller
{
    function index(){
        $about=About::first();
        $this->data['page_title']   =$about->title;
        $this->data['page_header']   =$about->title;
        $this->data['data']=$about;

        return view("about",$this->data);
    }
}
