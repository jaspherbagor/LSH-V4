<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminSubscriberController extends Controller
{
    public function index()
    {
        $subscriber = Subscriber::where('status', 1)->get();
        return view('admin.subscriber_show', compact('subscriber'));
    }

    public function send_email()
    {
        return view('admin.subscriber_send_email');
    }

    public function submit_email(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);


        // Send Email

        $subject  = $request->subject;
        $message = $request->message;

        $all_subscribers = Subscriber::where('status', 1)->get();

        foreach($all_subscribers as $item)
        {
            Mail::to($item->email)->send(new WebsiteMail($subject, $message));
        }

        return redirect()->back()->with('success', 'Email has been sent successfully');
    }
}
