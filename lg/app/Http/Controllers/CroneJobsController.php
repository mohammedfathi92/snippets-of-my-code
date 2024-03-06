<?php

namespace App\Http\Controllers;

use App\Events\OpportunityDelayed;
use App\Opportunity;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Event;

class CroneJobsController extends Controller
{
    function index()
    {
        //check delay opportunities
        $opportunities = Opportunity::where("status", 1)->where("progress", "<", 100)->where("deliver_at", "<", "DATE_ADD(CURDATE(), INTERVAL 5 DAY)");
        if ($opportunities) {
            foreach ($opportunities as $opportunity) {
                Event::fire(new OpportunityDelayed($opportunity));
            }
        }

    }
}
