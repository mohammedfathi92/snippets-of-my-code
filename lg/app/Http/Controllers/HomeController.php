<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests;
use App\Opportunity;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['page_title'] = trans("home.page_title");
        $this->data['page_header'] = trans("home.page_header");

        $user=Auth::user();
        $opportunities=Opportunity::orderBy("updated_at", "desc")->take(10);
        $products=Product::orderBy("updated_at", "desc")->take(10);
        $partners=User::orderBy("updated_at", 'desc')->where("permission", 2)->take(10)->get();
        $leads=Opportunity::orderBy("updated_at", "desc")->where('status', 1)->take(10);
        $won=Opportunity::orderBy("updated_at", "desc")->where('status', 2)->take(10);
        $lost=Opportunity::orderBy("updated_at", "desc")->where('status', 3)->take(10);
        $messages=Contact::latest()->take(10)->get();
        $this->data['opportunities'] = $user->permission > 1 ? $opportunities->where("user_id",$user->id)->get():$opportunities->get();
        $this->data['products'] = $user->permission > 1 ? false:$products->get();
        $this->data['partners'] =$user->permission > 1 ? false:$partners;
        $this->data['leads'] =$user->permission > 1 ? $leads->where("user_id",$user->id)->get():$leads->get();
        $this->data['wonProjects'] =$user->permission > 1 ? $won->where("user_id",$user->id)->get():$won->get();
        $this->data['lostProjects'] =$user->permission > 1 ? $lost->where("user_id",$user->id)->get():$lost->get();
        $this->data['messages'] =$user->permission > 1 ? false:$messages;
        return view('home', $this->data);
    }
}
