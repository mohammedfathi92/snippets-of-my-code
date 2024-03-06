<?php

namespace Corsata\Http\Controllers;

use Illuminate\Http\Request;
use Corsata\User;

use Nahid\Talk\Live\Broadcast;

class HomeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('chat.home', compact('users'));
    }

    public function tests()
    {

        $b = new Broadcast(\Illuminate\Contracts\Config\Repository::class, \Vinkla\Pusher\PusherFactory::class);
        dd($b->tests());
    }
}
