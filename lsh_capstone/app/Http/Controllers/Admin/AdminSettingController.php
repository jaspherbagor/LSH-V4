<?php

// Declare the namespace for the controller
namespace App\Http\Controllers\Admin;

// Import necessary classes
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

// Define the controller class
class AdminSettingController extends Controller
{
    // Method to display the settings
    public function index()
    {
        // Retrieve the setting data with ID 1 from the database
        $setting_data = Setting::where('id', 1)->first();
        // Return the view with the setting data
        return view('admin.setting', compact('setting_data'));
    }

    // Method to update the settings
    public function update(Request $request)
    {
        // Retrieve the existing setting with ID 1 from the database
        $obj = Setting::where('id', 1)->first();

        // Check if a new logo file is uploaded
        if ($request->hasFile('logo')) {
            // Validate the new logo file
            $request->validate([
                'logo' => 'image|mimes:jpg,jpeg,png,gif,webp,svg|max:5120'
            ]);

            // Delete the existing logo file from the server
            unlink('uploads/' . $obj->logo);

            // Get the extension of the new logo file
            $ext = $request->file('logo')->extension();
            // Generate a unique name for the new logo file using the current timestamp
            $final_name = time() . '.' . $ext;

            // Move the new logo file to the uploads directory
            $request->file('logo')->move('uploads/', $final_name);
            // Update the logo attribute of the setting
            $obj->logo = $final_name;
        }

        // Check if a new favicon file is uploaded
        if ($request->hasFile('favicon')) {
            // Validate the new favicon file
            $request->validate([
                'favicon' => 'image|mimes:jpg,jpeg,png,gif,webp,svg|max:5120'
            ]);

            // Delete the existing favicon file from the server
            unlink('uploads/' . $obj->favicon);

            // Get the extension of the new favicon file
            $ext = $request->file('favicon')->extension();
            // Generate a unique name for the new favicon file using the current timestamp
            $final_name = time() . '.' . $ext;

            // Move the new favicon file to the uploads directory
            $request->file('favicon')->move('uploads/', $final_name);
            // Update the favicon attribute of the setting
            $obj->favicon = $final_name;
        }

        // Update other attributes of the setting from the request
        $obj->top_bar_phone = $request->top_bar_phone;
        $obj->top_bar_email = $request->top_bar_email;
        $obj->home_feature_status = $request->home_feature_status;
        $obj->home_room_total = $request->home_room_total;
        $obj->home_room_status = $request->home_room_status;
        $obj->home_testimonial_status = $request->home_testimonial_status;
        $obj->home_latest_post_total = $request->home_latest_post_total;
        $obj->home_latest_post_status = $request->home_latest_post_status;
        $obj->footer_address = $request->footer_address;
        $obj->footer_phone = $request->footer_phone;
        $obj->footer_email = $request->footer_email;
        $obj->copyright = $request->copyright;
        $obj->facebook = $request->facebook;
        $obj->twitter = $request->twitter;
        $obj->linkedin = $request->linkedin;
        $obj->pinterest = $request->pinterest;
        $obj->analytic_id = $request->analytic_id;
        $obj->theme_color_1 = $request->theme_color_1;
        $obj->theme_color_2 = $request->theme_color_2;

        // Save the updated setting data to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Setting is updated successfully.');
    }
}
