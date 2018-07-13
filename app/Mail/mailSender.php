<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class mailSender extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->subject('Management Feedback');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $user_id = $request->user_id;
        $admin_id = $request->admin_id;
        $feedback = $request->feedback;
        $password = $request->password;

        $user = User::find($user_id);
        $admin = User::find($admin_id);

//        dd(config());
//        dd($request);

        if($feedback == 'upvote') {
            return $this->view('admin.mail.upvote',
                ['user' => $user, 'admin' => $admin, 'feedback' => $feedback])
                ->from("$admin->email")
                ->to("$user->email")
                ->subject('Management Feedback');
        }
        if($feedback == 'downvote') {
            return $this->view('admin.mail.downvote',
                ['user' => $user, 'admin' => $admin, 'feedback' => $feedback])
                ->from("$admin->email")
                ->to("$user->email")
                ->subject('Management Feedback');
        }
    }
}
