<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\WebsiteMail;

class AdminLoginController extends Controller
{
    public function index()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin_home');
        } elseif (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
            return redirect()->route('customer_logout');
        }
        
        return view('admin.login');
    }

    public function forgetPassword()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin_home');
        }
        return view('admin.forget_password');
    }

    public function forgetPasswordSubmit(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin_home');
        }

        $request->validate([
            'email' => 'required|email'
        ]);

        $admin_data = Admin::where('email', $request->email)->first();

        if(!$admin_data) {
            return redirect()->back()->with('error', 'Email address not found!');
        }
        
        $token = hash('sha256',time());

        $admin_data->token = $token;
        $admin_data->update();

        $resetLink = url('admin/reset-password/'.$token.'/'.$request->email);
        $subject = 'Reset Password';
        $message = 'Please assist by following the reset process. Kindly click on the following link to reset your password: ';
        $message .= '<a href="'.$resetLink.'">Click Here</a>';

        Mail::to($request->email)->send(new WebsiteMail($subject,$message));

        return redirect()->route('admin_login')->with('success', 'Please check your email and follow the steps there.');
    }

    public function loginSubmit(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin_home');
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if(Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin_home');
        } else {
            return redirect()->route('admin_login')->with('error', 'Invalid Credentials!');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }

    public function resetPassword($token, $email)
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin_home');
        }

        $admin_data = Admin::where('token', $token)->where('email', $email)->first();
        if(!$admin_data) {
            return redirect()->route('admin_login');
        }


        return view('admin.reset_password', compact('token', 'email'));

    }

    public function resetPasswordSubmit(Request $request) 
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin_home');
        }
        
        $request->validate([
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        $admin_data = Admin::where('token',$request->token)->where('email',$request->email)->first();
        $admin_data->password = Hash::make($request->password);
        $admin_data->token = '';
        $admin_data->update();

        return redirect()->route('admin_login')->with('success', 'Password has been reset successfully!');
    }


}
