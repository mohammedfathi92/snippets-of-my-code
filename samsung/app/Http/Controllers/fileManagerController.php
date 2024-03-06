<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class fileManagerController extends Controller
{
    function postDelete(Request $request)
    {
        $response = ['success' => false, "message" => null];
        $file=$request->input("file");
        if (Storage::disk('public')->has($file)) {
            if (Storage::disk('public')->delete($file)) {
                $response = ["success" => true, "message" => trans("main.success_file_deleted")];
            } else {
                $response = ['success' => false, "message" => trans("main.error_can_not_delete_file")];
            }
        } else {
            $response = ['success' => false, "message" => trans("main.error_file_not_found"),"file"=>var_dump(Storage::disk("public"))];
        }
        return response()->json($response);
    }
}
