<?php

// Declare the namespace for the controller
namespace App\Http\Controllers\Admin;

// Import necessary classes
use App\Http\Controllers\Controller;  // Base controller class
use App\Models\Admin;  // Model for admin users
use Illuminate\Http\Request;  // Request handling class
use Illuminate\Support\Facades\Auth;  // Authentication facade for handling logins
use Illuminate\Support\Facades\Hash;  // Hashing functions for passwords

// Define the AdminProfileController class, extending the base Controller class
class AdminProfileController extends Controller
{
    // Method to display the admin profile page
    public function index()
    {
        // Return the 'admin.profile' view for the admin profile
        return view('admin.profile');
    }

    // Method to handle the submission of the admin profile form
    public function profileSubmit(Request $request)
    {
        // Retrieve the current admin's data based on the email address
        $admin_data = Admin::where('email', Auth::guard('admin')->user()->email)->first();

        // Validate the request data (name and email are required)
        $request->validate([
            'name' => 'required',  // Name is required
            'email' => 'required|email',  // Email is required and must be a valid email
        ]);

        // Check if the password field is not empty
        if ($request->password != '') {
            // Validate the password and confirmation password fields
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]);

            // Hash the password and update it in the admin data
            $admin_data->password = Hash::make($request->password);
        }

        // Check if a new photo file is uploaded
        if ($request->hasFile('photo')) {
            // Validate the new photo (it must be an image of specific types and size)
            $request->validate([
                'photo' => 'image|mimes:jpeg,jpg,svg,png,webp,gif|max:5120'  // Photo must be an image of specific types and max size 5MB
            ]);

            // Remove the existing photo file
            if ($admin_data->photo) {
                unlink(public_path('uploads/' . $admin_data->photo));
            }

            // Get the extension of the new photo
            $ext = $request->file('photo')->extension();

            // Generate a unique name for the new photo (using 'admin' as prefix and the extension)
            $final_name = 'admin' . '.' . $ext;

            // Move the new photo to the 'uploads' directory
            $request->file('photo')->move(public_path('uploads/'), $final_name);

            // Update the photo attribute of the admin data
            $admin_data->photo = $final_name;
        }

        // Update the name and email attributes of the admin data from the request data
        $admin_data->name = $request->name;
        $admin_data->email = $request->email;

        // Save the updated admin data to the database
        $admin_data->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Profile information is saved successfully!');
    }
}
