<?php

namespace App\Http\Controllers\backend;

use App\UserLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TCG\Voyager\Facades\Voyager;

class LogsController extends Controller
{
    public function index()
    {
    	 if (!Voyager::can('browse_admin'))
            return redirect()->back()->with(['message' => 'you can not access this page', 'alert_danger' => 'info']);
        $logs = UserLog::all();
        return view('logs.index', compact('logs'));
    }
}
