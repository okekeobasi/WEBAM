<?php

namespace App\Http\Controllers;

use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use App\User;
use App\Attendance;
use App\Department;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class LogController extends Controller
{
    public function ClockIn($id){
        //Models
        $user = User::find($id);
        $department = Department::find($user->departmentId);
        $attendance = new Attendance();

        $attendance->user_id = $user->staffId;
        $attendance->department_id = $department->id;
        $attendance->method = 'Online';
        $attendance->date = Carbon::today('Africa/Lagos')->toDateString();
        $attendance->time_in = date("H:i:s");
        $attendance->time_out = date("00:00:00");
        $attendance->save();

        return redirect()->route('employee.dashboard');
    }

    public function ClockOut($id){
        DB::update('update attendance set time_out = ? where date = ?',
            [date("H:i:s"), Carbon::today('Africa/Lagos')->toDateString()]);

        return redirect()->route('employee.dashboard');
    }
}
