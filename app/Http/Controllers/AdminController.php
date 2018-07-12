<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use App\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\ViewComposers\ViewComposer;

class AdminController extends Controller
{
    /*
     * Home
     */
    public function home(){
        $Attendance = Attendance::where('user_id', session()->get('staffId'))->get();
        $testAttendance = DB::select('select * from attendance where date = ? and user_id = ?',
            [Carbon::today('Africa/Lagos')->toDateString(), session()->get('staffId')]);
        $id = session()->get('staffId');

        /*$date_array = "[";
        $time_in_array = "[";
        $time_out_array = "[";
        $i = 1;
        foreach ($Attendance as $row){
            $date_array .= "'$row->date'";

            $d = strtotime($row->time_in);
            $time = date('H',$d);
            $time_in_array .= "'$time'";

            $d = strtotime($row->time_out);
            $time = date('H',$d);
            $time_out_array .= "'$time'";

            if($i < sizeof($Attendance)){
                $date_array .= ",";
                $time_in_array .= ",";
                $time_out_array .= ",";
            }
            $i++;
        }
        $date_array .= "]";
        $time_in_array .= "]";
        $time_out_array .= "]";*/

        return view('admin.dashboard', compact('user','roles', 'Attendance', 'testAttendance', 'id'));

//        return view('admin.dashboard', compact('Attendance','testAttendance'));
    }

    /*
     * Employee Module
     */
    public function showEmployeeRecords(){
        return view('admin.employee.records')
            ->with(['employee'=>'active', 'employee_rec'=>'active']);
    }

    public function showEmployeeBiometrics(){
        return view('admin.employee.biometrics')
            ->with(['employee'=>'active', 'employee_bio'=>'active']);
    }

    public function createEmployeeRecord(){
        $roles = Role::all();
        $departments = Department::all();

        return view('admin.employee.new', compact('roles', 'departments'))
            ->with(['employee'=>'active', 'employee_cre'=>'active']);
    }

    public function showEmployeeScreen($id){
//        if(!isset($_GET['staffId'])) return redirect()->route('index');
        $roles = Role::all();
        $user = User::find($id);
        $Attendance = Attendance::where('user_id', $id)->get();
        $testAttendance = DB::select('select * from attendance where date = ? and user_id = ?',
            [Carbon::today('Africa/Lagos')->toDateString(), $id]);

       /* $date_array = "[";
        $time_in_array = "[";
        $time_out_array = "[";
        $i = 1;
        foreach ($Attendance as $row){
            $date_array .= "'$row->date'";

            $d = strtotime($row->time_in);
            $time = date('H',$d);
            $time_in_array .= "'$time'";

            $d = strtotime($row->time_out);
            $time = date('H',$d);
            $time_out_array .= "'$time'";

            if($i < sizeof($Attendance)){
                $date_array .= ",";
                $time_in_array .= ",";
                $time_out_array .= ",";
            }
            $i++;
        }
        $date_array .= "]";
        $time_in_array .= "]";
        $time_out_array .= "]";*/

        return view('admin.employee.screen', compact('user','roles', 'Attendance', 'testAttendance', 'id',
            'date_array', 'time_in_array', 'time_out_array'));
    }

    /*
     * Attendance Module
     */
    public function showAttendanceRecords(){
        $Attendance = Attendance::all();
        $users = User::all();
        $Attendance = $Attendance->where('date', Carbon::today('Africa/Lagos')->toDateString());

        return view('admin.attendance.records', compact('Attendance', 'users'))
            ->with(['attendance'=>'active', 'attendance_rec'=>'active']);
    }

    public function fetchAttendanceRecords(Request $request){
        $users = User::all();
        $Attendance = Attendance::where('date', $request->date)->get();

        return view('admin.attendance.records', compact('Attendance', 'users'))
            ->with(['attendance'=>'active', 'attendance_rec'=>'active']);
    }

    public function fetchManageAttendanceRecords(Request $request){
        $users = User::all();
        $Attendance = Attendance::where('date', $request->date)->get();

        return view('admin.attendance.manage', compact('Attendance', 'users'))
            ->with(['attendance'=>'active', 'attendance_man'=>'active']);
    }

    public function editAttendanceRecords(Request $request, $date){
        $Attendance = Attendance::where('date', $date)->get();
        $users = User::all();

        $time = $request->time;
        $username = $request->username;
        $action = $request->action;
        $date = $request->date;
        $user = User::where('username',$username)->get() or die('bye');

        $staffId = $user[0]->staffId;
        $dep_id = $user[0]->departmentId;

        if($action == "Remove"){
//            DB::delete('delete from attendance where user_id = ? and date = ?', [$staffId, $date]);
            $staffId = $request->id;
            DB::delete('delete from attendance where user_id = ? and date = ?', [$staffId, $date]);
        }
        else{
            DB::insert('insert into attendance (user_id, department_id, method, date, time_in, time_out) VALUES (?,?,?,?,?,?)',
                [$staffId, $dep_id, "Online", $date, $time, "17:30:00"]) or die('Error');
        }

        return redirect()->route('attendance.man');
//        return view('admin.attendance.manage', compact('Attendance', 'users'))
//            ->with(['attendance'=>'active', 'attendance_man'=>'active']);
    }

    public function editTimeAttendanceRecords(Request $request){
        $id = $request->id;
        $time_in = $request->time_in;
        $time_out = $request->time_out;
        DB::update('update attendance SET time_in = ?, time_out = ? WHERE id = ?', [$time_in, $time_out, $id]) or die('Error');

        return redirect()->route('attendance.man');
    }

    public function deleteAttendanceRecords(Request $request, $date){
        $Attendance = Attendance::where('date', $date)->get();
        $users = User::all();
        $action = $request->action;

        $staffId = $request->id;

        if($action == "Remove"){
            DB::delete('delete from attendance where id = ? and date = ?', [$staffId, $date]);
        }

        return redirect()->route('attendance.man');
    }
    public function manageAttendanceRecords(){
        $Attendance = Attendance::all();
        $users = User::all();
        $Attendance = $Attendance->where('date', Carbon::today('Africa/Lagos')->toDateString());

        return view('admin.attendance.manage', compact('Attendance', 'users'))
            ->with(['attendance'=>'active', 'attendance_man'=>'active']);
    }

    /*
     * Report Module
     */
    public function showEmployeeReport($id){
        $users_ = User::where('departmentId', $id)->get();
//        $users = User::find($id);
//        dd($users_);
        return view('admin.report.employee', compact('users_', 'id'))
            ->with(['report'=>'active', 'report_emp'=>'active']);
    }

    public function showAttendanceReport(){
        return view('admin.report.attendance')->with(['report'=>'active', 'report_att'=>'active']);
    }

    /*
     * Config
     */
    public function showConfigDepartment(){
        $departments = Department::all();
        foreach ($departments as $department){
            $users = User::where('departmentId', $department->id)->get();
            $len_users = sizeof($users);
            DB::update('update department SET population = ? WHERE id = ?', [$len_users, $department->id]);
        }
        return view('admin.config.department.records', compact('departments'));
    }

    public function showDepartmentScreen($id){
        $department = Department::find($id);
        $Attendance = Attendance::where('department_id', $id)->get();
        return view('admin.config.department.screen', compact('department', 'Attendance', 'id'));
    }

    public function createDepartment(Request $request){
        $departments = Department::all();

        $request->validate([
            'department' => 'required|string|max:255|unique:department',
        ]);
        $department = new Department();

        $department->department = $request->department;
        $department->resumption = $request->resumption;
        $department->population = 0;
        $department->closing = $request->closing;
        $department->status = strtolower($request->status);
        $department ->save();

        return view('admin.config.department.records', compact('departments'));
    }
}
