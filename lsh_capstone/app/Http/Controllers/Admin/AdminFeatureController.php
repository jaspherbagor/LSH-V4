<?php

// Declare the namespace for the controller
namespace App\Http\Controllers\Admin;

// Import necessary classes
use App\Http\Controllers\Controller;  // Base controller class
use App\Models\Feature;  // Model for features
use Illuminate\Http\Request;  // Request handling class

// Define the AdminFeatureController class, extending the base Controller class
class AdminFeatureController extends Controller
{
    // Method to display all features
    public function index()
    {
        // Retrieve all features from the database
        $features = Feature::all();
        
        // Return the 'admin.feature_view' view with the features data
        return view('admin.feature_view', compact('features'));
    }

    // Method to display the form for adding a new feature
    public function add()
    {
        // Return the 'admin.feature_add' view for adding a new feature
        return view('admin.feature_add');
    }

    // Method to store a new feature
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'icon' => 'required',  // Validate icon
            'heading' => 'required'  // Validate heading
        ]);

        // Create a new Feature instance
        $obj = new Feature();
        
        // Assign request data to the Feature object
        $obj->icon = $request->icon;
        $obj->heading = $request->heading;
        $obj->text = $request->text;

        // Save the new Feature object to the database
        $obj->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Feature is added successfully!');
    }

    // Method to display the edit form for a feature
    public function edit($id)
    {
        // Retrieve feature data based on the provided feature ID
        $feature_data = Feature::where('id', $id)->first();
        
        // Return the 'admin.feature_edit' view with the feature data
        return view('admin.feature_edit', compact('feature_data'));
    }

    // Method to update a feature
    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'icon' => 'required',  // Validate icon
            'heading' => 'required'  // Validate heading
        ]);

        // Retrieve the existing feature based on the provided feature ID
        $obj = Feature::where('id', $id)->first();

        // Update the feature object with the request data
        $obj->icon = $request->icon;
        $obj->heading = $request->heading;
        $obj->text = $request->text;

        // Save the updated feature object to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Feature is updated successfully!');
    }

    // Method to delete a feature
    public function delete($id)
    {
        // Retrieve the feature data based on the provided feature ID
        $single_data = Feature::where('id', $id)->first();
        
        // Delete the feature from the database
        $single_data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Feature is deleted successfully!');
    }
}
