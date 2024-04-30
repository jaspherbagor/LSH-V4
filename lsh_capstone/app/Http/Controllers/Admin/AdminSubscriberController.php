<?php

// Declare the namespace for the controller
namespace App\Http\Controllers\Admin;

// Import necessary classes
use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

// Define the controller class
class AdminSubscriberController extends Controller
{
    // Method to display the list of active subscribers
    public function index()
    {
        // Retrieve all active subscribers (status = 1) from the database
        $subscriber = Subscriber::where('status', 1)->get();
        // Return the view with the list of active subscribers
        return view('admin.subscriber_show', compact('subscriber'));
    }

    // Method to display the form for sending emails
    public function send_email()
    {
        // Return the view for sending email to subscribers
        return view('admin.subscriber_send_email');
    }

    // Method to handle the email sending form submission
    public function submit_email(Request $request)
    {
        // Validate the request data (subject and message are required)
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        // Get the subject and message from the request
        $subject = $request->subject;
        $message = $request->message;

        // Retrieve all active subscribers from the database
        $all_subscribers = Subscriber::where('status', 1)->get();

        // Send an email to each subscriber
        foreach ($all_subscribers as $item) {
            // Send an email using the WebsiteMail class
            Mail::to($item->email)->send(new WebsiteMail($subject, $message));
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Email has been sent successfully');
    }
}
