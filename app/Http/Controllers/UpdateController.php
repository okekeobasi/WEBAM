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

class UpdateController extends Controller
{

    /*
     * Insert into DB
     */
    public function insert($input, $id){
        //Models
        $person = User::find($id);
        $roles = new Role;
        $departments = new Department;

        $path = $this->upload($input);
//        Storage::put($path, $input->file('pics'));

        $roles = $roles->where('role_name', $input->role)->get();
        $departments =$departments->where('department', $input->department)->get();

        foreach ($roles as $role) {
            $person->roleId = $role->id;
        }
        foreach ($departments as $department) {
            $person->departmentId = $department->id;
        }

        $person->firstname = $input->firstname;
        $person->lastname = $input->lastname;
        $person->username = $input->username;
        $person->email = $input->email;
        $person->phone = $input->number;
        $person->status = $input->status;
        $person->password = Hash::make($input->password);
        $person->file_path = $path;
        $person->save();
    }

    /*
     * Upload file
     */
    public function upload($input){
        //The file path pathinfo($file_path)
        if($input->file('pic') === null){
            $path = "employees/usericon.png";
        }
        else {
            $path = Storage::putFile('employees', $input->file('pic')) or  "employees/usericon.png";
        }

        return $path;
    }

    /**
     *
     *Validate input
     * @param  array  $request
     */
    public function Update(Request $request, $id)
    {
        /*
         * Validate Fields
         */
        //Check if the email request contains '@'
        if(strpos($request->email, "@") !== false){
            //Is the email extension the default email
            if(strpos($request->email, "@activedgetechnologies.com") !== false) {
                $request->validate([
                    'email' => 'required|string|max:255',
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
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'password2' => 'required|string|min:8',
            'number' => 'required|min:10',
            'status' => 'required',
            'role' => 'required'
        ]);

        //If the passwords don't match
        if($request->password !== $request->password2) return redirect()->back()->withErrors(['password'=>'Passwords don\'t match'])
            ->withInput($request->except('password', 'password2'));

        //Upload file function
        $this->upload($request);

        //Insert into DB function
        $this->insert($request, $id);

        return redirect()->route('employee.scr', $id);
    }

    public function departmentUpdate(Request $request, $id){
        $department = Department::find($id);

        $department->department = $request->name;
        $department->resumption = $request->resumption;
        $department->closing = $request->closing;
        $department->status = strtolower($request->status);
        $department ->save();
        return redirect()->route('config.department.scr', $id);
    }
}
