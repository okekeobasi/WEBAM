<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Mockery\Exception;

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

    public function getEmployeeLog(Request $request){
        $id = $request->id;
        $limit = $request->limit;
        if($limit == 'all'){
            $Attendance = DB::select("SELECT * FROM attendance WHERE user_id = ?",
                [$id]);
            return response()->json($Attendance);
        }
        else {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $Attendance = DB::select("SELECT * FROM attendance WHERE user_id = ? AND date >= ? AND date <= ? ",
                [$id, $startDate, $endDate]);
            return response()->json($Attendance);
        }
    }

    public function employeeReport(Request $request){
        $id = $request->id;
        $limit = $request->limit;
        if($limit == 'all'){
            $Attendance = DB::select("SELECT * FROM attendance WHERE user_id = ?",
                [$id]);
            return response()->json($Attendance);
        }
        else {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            return $Attendance = DB::select("SELECT * FROM attendance WHERE user_id = ? AND date >= ? AND date <= ? ",
                [$id, $startDate, $endDate]);
             response()->json($Attendance);
        }
        /*
        if($request->limit == 'all'){
            return response()->json(Attendance::where('user_id', $id)->get());
        }
        */
    }

    public function attendanceReport(){}

    public function getDepartmentDate(Request $request){
        $id = $request->id;
        $limit = $request->limit;

        if($limit == 'all'){
             return response()->json([Attendance::where('department_id', $id)->get(), User::where('departmentId', $id)->get()]);
        }
        else {
            $startDate = $request->startDate;
            $endDate = $request->endDate;
            $Attendance = DB::select("SELECT * FROM attendance WHERE department_id = ? AND date >= ? AND date <= ? ",
                [$id, $startDate, $endDate]);
            return response()->json([$Attendance, User::where('departmentId', $id)->get()]);
        }
    }

    public function sidebarSearch(Request $request){
        $name = $request->text;

        $user = User::where('username', '=', "$name")->first();
        if ($user == null) $user = User::where('firstname', 'LIKE', "$name%")->first();
        if ($user == null) $user = User::where('lastname', 'LIKE', "%$name")->first();

        if ($user == null) {
            if (strpos($name, ' ') !== false) {
                $fullname = explode(' ', $name);

                $firstname = $fullname[0];
                $lastname = $fullname[1];

                $user = User::where('firstname', 'LIKE', "$firstname%")->first();
                if ($user == null) $user = User::where('lastname', 'LIKE', "%$lastname")->first();
            }
        }

        if ($user == null) $user = User::where('firstname', 'LIKE', "%$name%")->first();
        if ($user == null) $user = User::where('lastname', 'LIKE', "%$name%")->first();

        return $user->staffId;
    }




    public function dashboard(Request $request){
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


}
