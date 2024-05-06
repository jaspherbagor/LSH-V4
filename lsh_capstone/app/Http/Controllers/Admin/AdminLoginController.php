<?php

// Declare the namespace for the controller
namespace App\Http\Controllers\Admin;

// Import necessary classes
use App\Http\Controllers\Controller;  // Base controller class
use App\Models\Admin;  // Model for admin users
use Illuminate\Http\Request;  // Request handling class
use Illuminate\Support\Facades\Hash;  // Hashing functions for passwords
use Illuminate\Support\Facades\Auth;  // Authentication facade for handling logins
use Illuminate\Support\Facades\Mail;  // Mail facade for sending emails
use App\Mail\WebsiteMail;  // Mailable class for sending emails

// Define the AdminLoginController class, extending the base Controller class
class AdminLoginController extends Controller
{
    // Method to display the login page
    public function index()
    {
        // Check if the admin is already logged in
        if (Auth::guard('admin')->check()) {
            // Redirect to the admin home page if logged in
            return redirect()->route('admin_home');
        }
        // Check if a customer is logged in and log them out
        elseif (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
            // Redirect to the admin login page
            return redirect()->route('admin_login');
        }
        
        // Return the 'admin.login' view for admin login
        return view('admin.login');
    }

    // Method to display the forget password page
    public function forgetPassword()
    {
        // Check if the admin is already logged in
        if (Auth::guard('admin')->check()) {
            // Redirect to the admin home page if logged in
            return redirect()->route('admin_home');
        }

        // Return the 'admin.forget_password' view for forgetting password
        return view('admin.forget_password');
    }

    // Method to handle the forget password form submission
    public function forgetPasswordSubmit(Request $request)
    {
        // Check if the admin is already logged in
        if (Auth::guard('admin')->check()) {
            // Redirect to the admin home page if logged in
            return redirect()->route('admin_home');
        }

        // Validate the request data (email is required and must be a valid email)
        $request->validate([
            'email' => 'required|email'
        ]);

        // Retrieve the admin data based on the provided email
        $admin_data = Admin::where('email', $request->email)->first();

        // Check if the admin data is not found
        if (!$admin_data) {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Email address not found!');
        }
        
        // Generate a unique token for password reset
        $token = hash('sha256', time());

        // Update the admin data with the token
        $admin_data->token = $token;
        $admin_data->update();

        // Create the password reset link
        $resetLink = url('admin/reset-password/' . $token . '/' . $request->email);

        // Set the email subject and message
        $subject = 'Reset Password';
        $message = 'Please assist by following the reset process. Kindly click on the following link to reset your password: ';
        $message .= '<a href="' . $resetLink . '">Click Here</a>';

        // Send the password reset email
        Mail::to($request->email)->send(new WebsiteMail($subject, $message));

        // Redirect back to the admin login page with a success message
        return redirect()->route('admin_login')->with('success', 'Please check your email and follow the steps there.');
    }

    // Method to handle the login form submission
    public function loginSubmit(Request $request)
    {
        // Check if the admin is already logged in
        if (Auth::guard('admin')->check()) {
            // Redirect to the admin home page if logged in
            return redirect()->route('admin_home');
        }

        // Validate the request data (email and password are required)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Create the credentials array
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        // Attempt to authenticate the admin
        if (Auth::guard('admin')->attempt($credentials)) {
            // Redirect to the admin home page if authentication is successful
            return redirect()->route('admin_home');
        } else {
            // Redirect back to the admin login page with an error message if authentication fails
            return redirect()->route('admin_login')->with('error', 'Invalid Credentials!');
        }
    }

    // Method to handle admin logout
    public function logout()
    {
        // Log out the admin
        Auth::guard('admin')->logout();
        
        // Redirect to the admin login page
        return redirect()->route('admin_login');
    }

    // Method to display the reset password page
    public function resetPassword($token, $email)
    {
        // Check if the admin is already logged in
        if (Auth::guard('admin')->check()) {
            // Redirect to the admin home page if logged in
            return redirect()->route('admin_home');
        }

        // Retrieve the admin data based on the token and email
        $admin_data = Admin::where('token', $token)->where('email', $email)->first();

        // Check if the admin data is not found
        if (!$admin_data) {
            // Redirect to the admin login page if data not found
            return redirect()->route('admin_login');
        }

        // Return the 'admin.reset_password' view with the token and email data
        return view('admin.reset_password', compact('token', 'email'));
    }

    // Method to handle the reset password form submission
    public function resetPasswordSubmit(Request $request)
    {
        // Check if the admin is already logged in
        if (Auth::guard('admin')->check()) {
            // Redirect to the admin home page if logged in
            return redirect()->route('admin_home');
        }
        
        // Validate the request data (password and confirm_password are required and must match)
        $request->validate([
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[^a-zA-Z0-9])/',
            ],
            'confirm_password' => 'required|same:password'
        ]);

        // Retrieve the admin data based on the token and email
        $admin_data = Admin::where('token', $request->token)->where('email', $request->email)->first();

        // Update the admin's password and clear the token
        $admin_data->password = Hash::make($request->password);
        $admin_data->token = '';
        $admin_data->update();

        // Redirect to the admin login page with a success message
        return redirect()->route('admin_login')->with('success', 'Password has been reset successfully!');
    }
}
