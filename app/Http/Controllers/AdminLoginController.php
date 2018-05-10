<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Role;
use Hash;
use Session;

class AdminLoginController extends Controller
{
    public function showLoginForm(){
        if(session()->has('staffId')){
            return redirect()->route('admin.dashboard');
        }
        else return view('admin.auth.login');
    }

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $users = User::all();

        foreach ($users as $user){
            if(Hash::check($password, $user->password) && ($username == $user->username || $username == $user->email)) {
                if (strpos($username, '@') !== false) {
                    if ($username == $user->email){
                        $role_name = Role::find($user->roleId)->role_name;
                        Session::put(['staffId' => $user->staffId, 'role' => $role_name]);
                        if($role_name == "admin") return redirect(route('admin.dashboard'));
                        if($role_name == "regular") return redirect(route('employee.dashboard'));
                    }
                    else return redirect()->back()->withErrors(['username' => 'Wrong Email Address'])->withInput($request->only('username', 'remember'));
                } else {
                    if ($username == $user->username) {
                        $role_name = Role::find($user->roleId)->role_name;
                        Session::put(['staffId' => $user->staffId, 'role' => $role_name]);
                        if($role_name == "admin") return redirect(route('admin.dashboard'));
                        if($role_name == "regular") return redirect(route('employee.dashboard'));
                    }
                    else return redirect()->back()->withErrors(['username' => 'Wrong Username'])->withInput($request->only('username', 'remember'));
                }
            }
        }
        return redirect()->back()->withErrors(['password' => 'Wrong Password'])->withInput($request->only('username', 'remember'));
    }

    public function logout(){
        if(session()->has('staffId')){
            session()->forget('staffId');
            return redirect()->route('admin.showLogin');
        }
        else return redirect()->route('admin.showLogin');

    }
}
