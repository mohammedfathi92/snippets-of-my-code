<?php

namespace App\Http\Controllers;

use App\Action;
use App\Area;
use App\Employee;
use App\Http\Requests\IncidentRequest;
use App\Http\Requests\IoRequest;
use App\Http\Requests\MesurRequest;
use App\IncidentReport;
use App\IoReport;
use App\Mail\IncidentReportCreated;
use App\Mail\IoReportCreated;
use App\Mail\MesurReportCreated;
use App\MesurReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReportsController extends Controller
{

    function storeIo(IoRequest $request)
    {
        try {
            $area = Area::find($request->area);
            $user = null;
            $now = Carbon::now();
            $user_id = 0;
            if ($request->user_type == 'employee') {
                $user = Employee::findByEmpNo($request->employee_id);
                $user_id = $user->id;
            } else {
                $user_id = 238;
            }
            //qps database
            $data = [
                'accountableID' => $area->manager->id,
                'issueDate'     => $now,
                'description'   => $request->description,
                'suggestion'    => $request->suggestion,
                'issuerID'      => $user_id,
                'type'          => $request->io_type,
                'locationID'    => $request->location,
                'guestName'     => $request->user_type == 'guest' ? $request->guest_name : '',
            ];

            // save iO Report in qps connection
            $insertId = DB::connection('qps')->table('form')->insertGetId($data);

            $data = [
                'io_type'       => $request->io_type,
                'issue_id'      => $insertId,
                'user_type'     => $request->user_type,
                'reporter_id'   => $user_id,
                'reporter_name' => $request->user_type == 'guest' ? $request->guest_name : $user->name,
                'area_id'       => $request->area,
                'location_id'   => $request->location,
                'manager_id'    => $area->manager->id,
                'description'   => $request->description,
                'suggestion'    => $request->suggestion,
                'risks_list'    => is_array($request->risks_list) ? json_encode($request->risks_list) : null,
                'created_at'    => $now,
                'updated_at'    => $now,
            ];

//        $report = IoReport::create($data);
            $report = DB::connection('mysql')->table('io_reports')->insert($data);

//        $report = IoReport::create($data);
            $report_id = DB::connection('mysql')->table('io_reports')->insertGetId($data);

            // Send Report to Area Leader
            // 1- Get Area leader email
            // 2- send email
            $manager = Area::find($request->area)->manager;
            $report = IoReport::find($report_id);
            try {
                if ($manager) {
                    Mail::to($manager)->send(new IoReportCreated($report));
                }
            } catch (\Exception $ex) {
//                return response()->json(['success' => false, "message" => "System Error, No Reports sent to Leaders or managers"], 500);
                return response()->json(['success' => true, 'message' => "Report Sent Successfully"]);
            }

            return response()->json(['success' => true, 'message' => "Report Sent Successfully"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, "message" => "System Error , You have to contact with system administrator!"], 500);
        }
    }

    function storeMesur(MesurRequest $request)
    {

        try {
            $data = $request->except(['observations', 'actions', '_token']);
            $now = Carbon::now();

            $leader = Employee::findByEmpNo($request->leader_id);
            $co_leader = Employee::findByEmpNo($request->co_leader_id);
            $copyTo = Employee::findByEmpNo($request->copy_to_id);
            $area = Area::find($request->visited_area_id);
            $areaManager = $area->manager;
            // insert actions in qps db

            if ($request->actions) {
                $actions = [];
                foreach ($request->actions as $action) {
                    $actions[] = [
                        'typeid'        => (int)$action['type'],
                        'sourceid'      => 4,// mesur
                        'issuerid'      => $leader->id,
                        'AccountableID' => $action['coLeader'],
                        'IssueDate'     => $now,
                        'PlannedDate'   => Carbon::createFromFormat("d/m/Y", $action['target_date']),
                        'ClosureDate'   => Carbon::createFromFormat("d/m/Y", $action['target_date']),
                        "StatusID"      => 2,
                        "ActionDetails" => $action['details'],
                    ];
                }
                Action::insert($actions);
//            DB::connection('qps')->table("action")->insert($actions);
            }

            $data = array_merge($data, [
                'leader_id'    => $leader->id,
                'co_leader_id' => $co_leader->id,
                'copy_to_id'   => $copyTo->id,
                'observations' => json_encode($request->observations),
                'actions'      => json_encode($request->actions),
                'created_at'   => $now,
                'updated_at'   => $now
            ]);

            $data['visited_date'] = Carbon::createFromFormat("d/m/Y", $request->visited_date);
            $report = MesurReport::create($data);

            try {
                // send emails to leader,co-leader and area manager
                if ($areaManager) {
                    Mail::to([$areaManager, $leader, $co_leader])->send(new MesurReportCreated($report));
                }
            } catch (\Exception $ex) {
//                return response()->json(['success' => false, "message" => "System Error, No Reports sent to Leaders or managers"], 500);
                return response()->json(['success' => true, 'message' => "Report Sent Successfully"]);
            }

            return response()->json(['success' => true, 'message' => "Report Sent Successfully"]);

        } catch (\Exception $e) {
            Log::alert($e);
            return response()->json(['success' => false, "message" => "System Error , You have to contact with system administrator!"], 500);
        }

    }

    function storeIncident(IncidentRequest $request)
    {
        try {

            $data = $request->except(['_token']);
            $reporter = Employee::findByEmpNo($request->reporter_id);

            $data['reporter_id'] = $reporter->id;
            $data['incident_date'] = Carbon::createFromFormat("d/m/Y", $request->incident_date);

            $report = IncidentReport::create($data);

            if ($report) {
                Mail::to([$reporter])->send(new IncidentReportCreated($report));
            }

            return response()->json(['success' => true, 'message' => "Report Sent Successfully"]);

        } catch (\Exception $ex) {
            return response()->json(['success' => false, "message" => "System Error , You have to contact with system administrator!"], 500);

        }
    }
}
