<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminAPIController extends Controller
{
    public function testDate(Request $request){
        $id = $request->id;
        $startDate = $request->startDate;
        $endDate = $request->endDate;
        $Attendance = DB::select("SELECT * FROM attendance WHERE user_id = ? AND date >= ? AND date <= ? ",
            [$id, $startDate, $endDate]);
        return response()->json($Attendance);
    }

    public function dashboardDate($date, Request $request){
        if(strpos($request->link, 'employee') !== false){
            $id = $request->id;
        }
        else{
            $id = session()->get('staffId');
        }
        $date = explode(',', $date);
        $Attendance = DB::select("SELECT * FROM attendance WHERE user_id = ? AND date >= ? AND date <= ? ",
            [$id, $date[0], $date[1]]);
//session()->get('staffId')
        return response()->json($Attendance);
    }

    public function employeeReport(Request $request){
        $id = $request->id;
        if($request->limit == 'all'){
            return response()->json(Attendance::where('user_id', $id)->get());
        }
    }

    public function attendanceReport(){}

    public function getDepartmentDate(Request $request){
        $id = $request->id;
        if($request->limit == 'all'){
             return response()->json([Attendance::where('department_id', $id)->get(), User::where('departmentId', $id)->get()]);
        }
    }
}
