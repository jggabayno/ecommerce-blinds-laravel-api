<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Mail;

class SendForgotPasswordEmailController extends Controller
{

    public function index(Request $request)
    {
        
        $current_timestamp = Carbon::now()->timestamp;

        $user = User::where('email', '=', $request->email)->first();

        if($user){

            $data = [
                'user_id' => $user->id,
                'first_name' => $user->first_name,
                'current_time_stamp'=> $current_timestamp
            ];

            Mail::send('forgotPassword', $data, function ($message) use ($user){
                $message->from(env('MAIL_FROM_ADDRESS'));
                $message->to($user->email);
                $message->subject("Reset Your Password");
            });
    
            return count(Mail::failures());

        } else {
            return 'Email not exist';
        }
    }

}