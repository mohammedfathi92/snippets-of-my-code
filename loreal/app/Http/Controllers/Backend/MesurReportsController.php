<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\MesurReport;
use Validator;

class MesurReportsController extends Controller
{
      public function index(){

         $data = MesurReport::all();
        
         return view('loreal.backend.mesur_reports.index')->with(compact('data'));
    } 

      public function ajax_show(Request $request, $id){

         $data = MesurReport::find($id);
          if(!$data){
            return response()->json(['success' => false]);
          }

         $view = view('loreal.backend.mesur_reports.ajax_show_report')->with(compact('data'))->render();

          return response()->json(['success' => true, 'view' =>  $view]);
    } 

    
    public function destroy(Request $request, $id){

      $report = MesurReport::find($id);
      if(!$report){
        dd(1);
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