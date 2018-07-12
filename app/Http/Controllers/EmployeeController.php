<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use DB;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function home(){
        $Attendance = Attendance::where('user_id', session()->get('staffId'))->get();
        $testAttendance = DB::select('select * from attendance where date = ? and user_id = ?',
            [Carbon::today('Europe/Berlin')->toDateString(), session()->get('staffId')]);
        $id = session()->get('staffId');

        return view('employee.dashboard', compact('Attendance','testAttendance', 'id'));
    }
}
