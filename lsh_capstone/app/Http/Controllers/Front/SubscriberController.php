<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Front' namespace
namespace App\Http\Controllers\Front;

// Importing necessary classes, models, and facades
use App\Http\Controllers\Controller; // Importing base controller class
use App\Mail\WebsiteMail; // Importing the WebsiteMail class for sending emails
use App\Models\Admin; // Importing the Admin model
use App\Models\Subscriber; // Importing the Subscriber model for interacting with subscriber data
use Illuminate\Http\Request; // Importing the Request class
use Illuminate\Support\Facades\Mail; // Importing the Mail facade for sending emails
use Illuminate\Support\Facades\Validator; // Importing the Validator facade for request validation

// Controller for handling subscriber-related requests
class SubscriberController extends Controller
{
    // Method to handle the email sending for subscription
    public function send_email(Request $request)
    {
        // Validate the incoming request data for the email field
        $validator = Validator::make($request->all(), [
            'email' => 'required|email', // Email field is required and must be a valid email
        ]);

        // Check if validation fails
        if (!$validator->passes()) {
            // Return JSON response with error messages if validation fails
            return response()->json(['code' => 0, 'error_message' => $validator->errors()->toArray()]);
        } else {
            // Generate a unique verification token using SHA-256 hashing algorithm
            $token = hash('sha256', time());

            // Create a new Subscriber object and populate its fields
            $obj = new Subscriber();
            $obj->email = $request->email; // Set the email address from the request
            $obj->status = 0; // Set the subscriber status to unverified (0)
            $obj->token = $token; // Set the verification token
            $obj->save(); // Save the new subscriber to the database

            // Generate a verification link for the subscriber
            $verification_link = url('subscriber/verify/' . $request->email . '/' . $token);

            // Define the subject for the verification email
            $subject = 'Subscriber Verification';
            
            // Create the email message content with the verification link
            $message = 'Please click on the link below to confirm your subscription: <br>';
            $message .= '<a href="' . $verification_link . '">';
            $message .= $verification_link;
            $message .= '</a>';

            // Send the verification email to the subscriber
            Mail::to($request->email)->send(new WebsiteMail($subject, $message));

            // Return JSON response indicating success and prompting the user to check their email
            return response()->json(['code' => 1, 'success_message' => 'Please check your email to confirm subscription!']);
        }
    }

    // Method to verify a subscriber's email and token
    public function verify($email, $token)
    {
        // Find the subscriber with the given email and token
        $subscriber_data = Subscriber::where('email', $email)->where('token', $token)->first();

        // Check if the subscriber data is found
        if ($subscriber_data) {
            // Clear the token and set the status to verified (1)
            $subscriber_data->token = '';
            $subscriber_data->status = 1;
            $subscriber_data->update(); // Save the changes to the database

            // Redirect to the home page with a success message
            return redirect()->route('home')->with('success', 'Your subscription is verified successfully!');
        } else {
            // Redirect to the home page with an error message if the subscriber data is not found
            return redirect()->route('home')->with('error', 'Your data is not found!');
        }
    }
}
