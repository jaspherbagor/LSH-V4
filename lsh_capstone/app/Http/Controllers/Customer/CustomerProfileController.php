<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Customer' namespace
namespace App\Http\Controllers\Customer;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use App\Models\Customer; // Importing the Customer model
use Illuminate\Http\Request; // Importing the Request class
use Illuminate\Support\Facades\Auth; // Importing the Auth facade for authentication
use Illuminate\Support\Facades\Hash; // Importing the Hash facade for hashing passwords

// Controller for handling customer profile-related requests
class CustomerProfileController extends Controller
{
    // Method to display the customer profile page
    public function index()
    {
        // Render the 'customer.profile' view for the customer profile page
        return view('customer.profile');
    }

    // Method to handle customer profile form submission
    public function profile_submit(Request $request)
    {
        // Retrieve the authenticated customer's data based on their email
        $customer_data = Customer::where('email', Auth::guard('customer')->user()->email)->first();

        // Validate the request data for name and email
        $request->validate([
            'name' => 'required', // Name is required
            'email' => 'required|email' // Email is required and must be valid
        ]);

        // Check if a new password is provided in the request
        if ($request->password != '') {
            // Validate the request data for password and confirmed password
            $request->validate([
                'password' => 'required', // Password is required if provided
                'retype_password' => 'required|same:password' // Confirmed password must match the original password
            ]);

            // Hash the new password and update the customer's password
            $customer_data->password = Hash::make($request->password);
        }

        // Check if a photo file is provided in the request
        if ($request->hasFile('photo')) {
            // Validate the photo file (type and size restrictions)
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif,svg,webp|max:5120' // Photo file must be an image and within the size limit
            ]);

            // If the customer already has a photo, delete the existing photo file
            if ($customer_data->photo != NULL) {
                unlink(public_path('uploads/' . $customer_data->photo));
            }

            // Retrieve the extension of the uploaded photo file
            $ext = $request->file('photo')->extension();
            
            // Generate a unique file name for the photo using the current timestamp
            $final_name = time() . '.' . $ext;
            
            // Move the uploaded photo file to the specified directory with the new file name
            $request->file('photo')->move(public_path('uploads/'), $final_name);

            // Update the customer's photo file name in the database
            $customer_data->photo = $final_name;
        }

        // Update the customer's profile information with the new data from the request
        $customer_data->name = $request->name;
        $customer_data->email = $request->email;
        $customer_data->phone = $request->phone;
        $customer_data->country = $request->country;
        $customer_data->address = $request->address;
        $customer_data->province = $request->province;
        $customer_data->city = $request->city;
        $customer_data->zip = $request->zip;
        $customer_data->update(); // Save the updated customer data to the database

        // Redirect back with a success message indicating that the profile information was saved successfully
        return redirect()->back()->with('success', 'Profile information is saved successfully.');
    }
}
