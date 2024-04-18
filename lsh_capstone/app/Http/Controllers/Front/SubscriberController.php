<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Admin;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class SubscriberController extends Controller
{
    public function send_email(Request $request)
    {
        // dd($request->name);
        $validator = Validator::make($request->all(),[
            'email' => 'required|email'
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error_message'=>$validator->errors()->toArray()]);
        }else{

            $token = hash('sha256', time());

            $obj = new Subscriber();
            $obj->email = $request->email;
            $obj->status = 0;
            $obj->token = $token;
            $obj->save();


            $verification_link = url('subscriber/verify/'.$request->email.'/'.$token);

            // Send email
            $subject = 'Subscriber Verification';
            $message = 'Please click on the link below to confirm your subscription: <br>';

            $message .= '<a href="'.$verification_link.'">';
            $message .= $verification_link;
            $message .= '</a>';

            Mail::to($request->email)->send(new WebsiteMail($subject, $message));

            return response()->json(['code'=>1,'success_message'=>'Please check your email to confirm subscription!']);
        }
    }

    public function verify($email,$token)
    {
        $subscriber_data = Subscriber::where('email', $email)->where('token', $token)->first();

        if($subscriber_data) {
            //echo 'Your data has been found? Weeee Di Nga!';
            $subscriber_data->token = '';
            $subscriber_data->status = 1;
            $subscriber_data->update();

            return redirect()->route('home')->with('success', 'Your subscription is verified successfully!');
        } else {
            //echo 'Your data is not found! Period.';
            return redirect()->route('home')->with('error', 'Your data is not found!');
        }
    }
}
