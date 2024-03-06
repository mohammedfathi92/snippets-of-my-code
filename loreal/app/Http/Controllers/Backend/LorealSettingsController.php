<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\LorealSettings;
use Validator;

class LorealSettingsController extends Controller
{
      public function index(){

         $data = LorealSettings::all();
        
         return view('loreal.backend.settings.index')->with(compact('data'));
    } 

      public function ajax_get_options(Request $request, $id, $key = null){

         $data = LorealSettings::find($id);
          if(!$data){
            return response()->json(['success' => false]);
          }
          if(!$data->value){
            $options = [];
          }else{
            $options = json_decode($data->value);
          }

         $view = view('loreal.backend.settings.partials.options')->with(compact('data', 'options'))->render();

          return response()->json(['success' => true, 'view' =>  $view]);
    } 

      public function store_options(Request $request, $id, $key = null){

         $setting = LorealSettings::find($id);
         if(!$setting){
          return redirect()->back()->with('Not found that settings');
         }

         $storedOptions = [];

         $options = $request->get('options', []);
           
            foreach ($options as $option) {
          $storedOptions[$option['key']] = $option['value'];
            }
        $object = (object)$storedOptions;
        $setting->update(['value'=> json_encode($object)]);

       return redirect()->back()->with([
                'message'    => 'Updated Successfully !',
                'alert-type' => 'success',
            ]);
    } 
}