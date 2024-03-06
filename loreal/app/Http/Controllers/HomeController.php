<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $potential_risks = \DB::connection('qps')->table('potential_risks')->get();

        $leaders = \DB::connection('qps')
            ->table('vw_emp')
            ->select(['managerid as id', 'managername as name'])
            ->groupBy('managerid')
            ->get();

        $actionTypes = \DB::connection('qps')->table('actiontype')->get();

        return view("frontend.layouts.master", compact('potential_risks', 'leaders', 'actionTypes'));
    }
}
