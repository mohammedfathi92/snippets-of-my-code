<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\IoReport;
use Illuminate\Http\Request;
use Validator;

class IoReportsController extends Controller
{
    public function index()
    {

        $data = IoReport::all();

        return view('loreal.backend.io_reports.index')->with(compact('data'));
    }

    public function ajax_show(Request $request, $id)
    {

        $data = IoReport::find($id);
        if (!$data) {
            return response()->json(['success' => false]);
        }

        $view = view('loreal.backend.io_reports.ajax_show_report')->with(compact('data', 'options'))->render();

        return response()->json(['success' => true, 'view' => $view]);
    }


    public function destroy(Request $request, $id)
    {

        $report = IoReport::find($id);
        if (!$report) {


            return redirect()->back()->with([
                'message'    => 'Not Found Report !',
                'alert-type' => 'error',
            ]);
        }
        $report->delete();

        return redirect()->back()->with([
            'message'    => 'Delete Report Successfully !',
            'alert-type' => 'success',
        ]);


    }
}
