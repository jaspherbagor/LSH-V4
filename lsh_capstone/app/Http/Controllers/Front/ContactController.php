<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Front' namespace
namespace App\Http\Controllers\Front;

// Importing necessary classes, models, and facades
use App\Http\Controllers\Controller; // Importing base controller class
use App\Mail\WebsiteMail; // Importing the WebsiteMail class for sending emails
use App\Models\Admin; // Importing the Admin model
use App\Models\Page; // Importing the Page model
use Illuminate\Http\Request; // Importing the Request class
use Illuminate\Support\Facades\Mail; // Importing the Mail facade for sending emails
use Illuminate\Support\Facades\Validator; // Importing the Validator facade for request validation

// Controller for handling contact-related requests
class ContactController extends Controller
{
    // Method to display the contact page
    public function index()
    {
        // Retrieve the contact page data (assuming it has an ID of 1)
        $contact_data = Page::where('id', 1)->first();
        
        // Render the 'front.contact' view and pass the contact page data to it
        return view('front.contact', compact('contact_data'));
    }

    // Method to handle email sending from the contact form
    public function send_email(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'name' => 'required', // Name field is required
            'email' => 'required|email', // Email field is required and must be a valid email
            'message' => 'required' // Message field is required
        ]);

        // Check if validation fails
        if (!$validator->passes()) {
            // Return JSON response with error messages if validation fails
            return response()->json(['code' => 0, 'error_message' => $validator->errors()->toArray()]);
        } else {
            // Define the subject for the email
            $subject = 'Contact form email';
            
            // Create the email message content
            $message = 'Visitor email information: <br>';
            $message .= '<br>Name: ' . $request->name;
            $message .= '<br>Email: ' . $request->email;
            $message .= '<br>Message: ' . $request->message;

            // Retrieve admin data (assuming admin has an ID of 1)
            $admin_data = Admin::where('id', 1)->first();
            
            // Get the admin's email address
            $admin_email = $admin_data->email;

            // Send the email using the WebsiteMail class
            Mail::to($admin_email)->send(new WebsiteMail($subject, $message));

            // Return JSON response indicating success
            return response()->json(['code' => 1, 'success_message' => 'Email has been sent successfully!']);
        }
    }
}
