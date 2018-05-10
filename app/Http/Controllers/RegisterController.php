<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use App\Role;
use Carbon\Carbon;
use Faker\Provider\DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{

    /*
     * Insert into DB
     */
    public function insert($input){
        //Models
        $users = new User;
        $roles = new Role;
        $departments = new Department;

        $path = $this->upload($input);
//        Storage::put($path, $input->file('pics'));

        $roles = $roles->where('role_name', $input->role)->get();
        $departments =$departments->where('department', $input->department)->get();

        foreach ($roles as $role) {
            $users->roleId = $role->id;
        }
        foreach ($departments as $department) {
            $users->departmentId = $department->id;
        }

        $users->firstname = $input->firstname;
        $users->lastname = $input->lastname;
        $users->username = $input->username;
        $users->email = $input->email;
        $users->phone = $input->number;
        $users->status = $input->status;
        $users->password = Hash::make($input->password);
        $users->file_path = $path;
        $users->biometrics = 'N/A';
        $users->save();
    }

    /*
     * Upload file
     */
    public function upload($input){
        //The file path pathinfo($file_path)
        if($input->file == null){
            $path = "employees/usericon.png";
        }
        else {
            $path = Storage::putFile('employees', $input->file('pic'));
        }
        return $path;
    }

    /**
     *
     *Validate input
     * @param  array  $request
     */
    protected function Register(Request $request)
    {
        /*
         * Validate Fields
         */
        //Check if the email request contains '@'
        if(strpos($request->email, "@") !== false){
            //Is the email extension the default email
            if(strpos($request->email, "@activedgetechnologies.com") !== false) {
                $request->validate([
                    'email' => 'required|string|max:255|unique:users',
                ]);
            }//If not then return an error
            else return redirect()->back()->withErrors(['email'=>'Wrong Email Address'])
                ->withInput($request->except('password', 'password2'));
        }//If it doesn't contain '@' then append the default email to it
        else {
            $request->email = $request->email . "@activedgetechnologies.com";
        }

        //Validate the Request with these rules
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
            'password2' => 'required|string|min:8',
            'number' => 'required|min:10',
            'status' => 'required',
            'role' => 'required'
        ]);

        //If the passwords don't match
        if($request->password !== $request->password2) return redirect()->back()->withErrors(['password'=>'Passwords don\'t match'])
            ->withInput($request->except('password', 'password2'));

        //Insert into DB function
        $this->insert($request);

        return redirect()->route('employee.rec');
    }
}
