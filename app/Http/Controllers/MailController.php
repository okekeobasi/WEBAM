<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailJob;
use App\Mail\mailSender;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function showMail(Request $request){
        return view('admin.mail.upvote');
    }

    public function sendMail(Request $request){
        $password = $request->password;
        $admin_id = $request->admin_id;

        $admin = User::find($admin_id);
        config(['mail.username' => trim($admin->email), 'mail.password' => trim($password)]);
        /*
        if(Hash::check($password, $admin->password)){
            Mail::send(new mailSender);
            return json_encode(['responseText' => 'success']);
        }
        else{
            return response()->json('Incorrect Password', 400);
        }
        */
        $job = (new SendMailJob())->delay(Carbon::now()->addSeconds(10));
        dispatch($job);

        return response()->json(['message' => 'Email Sent'], 200);
        return 'Email Sent';
    }
}
