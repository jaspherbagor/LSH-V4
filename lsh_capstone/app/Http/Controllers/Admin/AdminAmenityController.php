<?php

namespace App\Http\Controllers\Admin; // Define the namespace for the controller

use App\Http\Controllers\Controller; // Import the base controller class
use App\Models\Amenity; // Import the Amenity model class
use Illuminate\Http\Request; // Import the Request class

class AdminAmenityController extends Controller
{
    // Method to handle viewing a list of all amenities
    public function index()
    {
        // Retrieve all amenities from the database
        $amenities = Amenity::get();
        // Return a view with the list of amenities
        return view('admin.amenity_view', compact('amenities'));
    }

    // Method to handle displaying the form for adding a new amenity
    public function add()
    {
        // Return a view for the add form
        return view('admin.amenity_add');
    }

    // Method to handle the form submission and storing a new amenity
    public function store(Request $request)
    {
        // Validate the incoming request data for the required name field
        $request->validate([
            'name' => 'required',
        ]);

        // Create a new Amenity instance and set its name based on the request data
        $obj = new Amenity();
        $obj->name = $request->name;
        // Save the new amenity to the database
        $obj->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Amenity is added successfully!');
    }

    // Method to handle displaying the form for editing an existing amenity
    public function edit($id)
    {
        // Retrieve the amenity data based on the provided ID
        $amenity_data = Amenity::where('id', $id)->first();
        // Return a view with the amenity data for the edit form
        return view('admin.amenity_edit', compact('amenity_data'));
    }

    // Method to handle the form submission and updating an existing amenity
    public function update(Request $request, $id)
    {
        // Retrieve the existing amenity based on the provided ID
        $obj = Amenity::where('id', $id)->first();

        // Update the name property of the existing amenity based on the request data
        $obj->name = $request->name;
        // Save the updated amenity to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Amenity is updated successfully!');
    }

    // Method to handle deleting an existing amenity
    public function delete($id)
    {
        // Retrieve the amenity data based on the provided ID
        $single_data = Amenity::where('id', $id)->first();
        // Delete the amenity record from the database
        $single_data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Amenity is deleted successfully!');
    }
}
