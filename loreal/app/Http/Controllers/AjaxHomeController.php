<?php

namespace App\Http\Controllers;

use App\Area;
use App\Employee;
use Illuminate\Http\Request;

class AjaxHomeController extends Controller
{

	function getRisksByType($type=null){
		$data=\DB::connection('qps')->table("potential_risks")->where("used_in",$type)->get();
		return response()->json(['success'=>true,'data'=>$data]);
	}
    function validateEmpId(Request $request)
    {

        $response = ['success' => false, 'message' => "", 'data' => []];

        if ($request->id) {
            $data = Employee::findByEmpNo($request->id);

            if ($data->count()) {
                $response['data'] = $data;
                $response['success'] = true;
                $response['message'] = "Valid Employee Id";
            }

        }

        return response()->json($response);
    }

    function getAreaLocations(Request $request)
    {
        $locations = null;
        if ($request->area) {
            $area = Area::find($request->area);
            $locations = $area->locations;
        }
        return response()->json(['success' => true, 'data' => $locations]);

    }
}
