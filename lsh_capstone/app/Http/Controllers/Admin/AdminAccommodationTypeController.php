<?php

namespace App\Http\Controllers\Admin; // Define the namespace for the controller

use App\Http\Controllers\Controller; // Import the base controller class
use App\Models\AccommodationType; // Import the AccommodationType model class
use Illuminate\Http\Request; // Import the Request class

class AdminAccommodationTypeController extends Controller
{
    // Method to handle viewing a list of all accommodation types
    public function index()
    {
        // Retrieve all accommodation types from the database
        $accommodation_types = AccommodationType::get();
        // Return a view with the list of accommodation types
        return view('admin.accommodation_type_view', compact('accommodation_types'));
    }

    // Method to handle displaying the form for adding a new accommodation type
    public function add()
    {
        // Return a view for the add form
        return view('admin.accommodation_type_add');
    }

    // Method to handle the form submission and storing a new accommodation type
    public function store(Request $request)
    {
        // Validate the incoming request data for photo and required fields
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120',
            'name' => 'required'
        ]);

        // Get the file extension of the uploaded photo
        $ext = $request->file('photo')->extension();
        // Generate a unique filename for the photo using the current timestamp
        $final_name = time() . '.' . $ext;

        // Move the uploaded photo to the public uploads directory with the new filename
        $request->file('photo')->move(public_path('uploads/'), $final_name);

        // Create a new AccommodationType instance and set its properties based on the request data
        $obj = new AccommodationType();
        $obj->photo = $final_name;
        $obj->name = $request->name;
        // Save the new accommodation type to the database
        $obj->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Accommodation type is added successfully!');
    }

    // Method to handle displaying the form for editing an existing accommodation type
    public function edit($id)
    {
        // Retrieve the accommodation type data based on the provided ID
        $accommodation_type_data = AccommodationType::where('id', $id)->first();
        // Return a view with the accommodation type data for the edit form
        return view('admin.accommodation_type_edit', compact('accommodation_type_data'));
    }

    // Method to handle the form submission and updating an existing accommodation type
    public function update(Request $request, $id)
    {
        // Retrieve the existing accommodation type based on the provided ID
        $obj = AccommodationType::where('id', $id)->first();

        // Check if a new photo file has been uploaded
        if ($request->hasFile('photo')) {
            // Validate the new photo file
            $request->validate([
                'photo' => 'image|mimes:jpeg,jpg,svg,png,webp,gif|max:5120',
            ]);

            // Remove the existing photo file from the uploads directory
            unlink(public_path('uploads/' . $obj->photo));

            // Get the file extension of the new photo
            $ext = $request->file('photo')->extension();
            // Generate a unique filename for the new photo using the current timestamp
            $final_name = time() . '.' . $ext;

            // Move the new photo file to the public uploads directory with the new filename
            $request->file('photo')->move(public_path('uploads/'), $final_name);

            // Update the photo property of the existing accommodation type
            $obj->photo = $final_name;
        }

        // Update the name property of the existing accommodation type based on the request data
        $obj->name = $request->name;
        // Save the updated accommodation type to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Accommodation type is updated successfully!');
    }

    // Method to handle deleting an existing accommodation type
    public function delete($id)
    {
        // Retrieve the accommodation type data based on the provided ID
        $single_data = AccommodationType::where('id', $id)->first();
        // Remove the photo file of the accommodation type from the uploads directory
        unlink(public_path('uploads/' . $single_data->photo));
        // Delete the accommodation type record from the database
        $single_data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Accommodation type is deleted successfully!');
    }
}
