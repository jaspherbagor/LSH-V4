<?php

// Declare the namespace for the controller
namespace App\Http\Controllers\Admin;

// Import necessary classes
use App\Http\Controllers\Controller;  // Base controller class
use App\Models\Photo;  // Model for photos
use Illuminate\Http\Request;  // Request handling class

// Define the AdminPhotoController class, extending the base Controller class
class AdminPhotoController extends Controller
{
    // Method to display all photos
    public function index()
    {
        // Retrieve all photos from the database
        $photos = Photo::all();
        
        // Return the 'admin.photo_view' view with the photos data
        return view('admin.photo_view', compact('photos'));
    }

    // Method to display the form for adding a new photo
    public function add()
    {
        // Return the 'admin.photo_add' view for adding a new photo
        return view('admin.photo_add');
    }

    // Method to handle the submission of the form for adding a new photo
    public function store(Request $request)
    {
        // Validate the request data (photo is required and must be an image of specific types and size)
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120'  // Photo must be an image of specific types and max size 5MB
        ]);

        // Get the file extension of the uploaded photo
        $ext = $request->file('photo')->extension();

        // Generate a unique name for the photo using the current timestamp and extension
        $final_name = time() . '.' . $ext;

        // Move the photo to the 'uploads' directory
        $request->file('photo')->move(public_path('uploads/'), $final_name);

        // Create a new Photo instance
        $obj = new Photo();
        
        // Assign the photo name and caption from the request data to the Photo object
        $obj->photo = $final_name;
        $obj->caption = $request->caption;

        // Save the new Photo object to the database
        $obj->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Photo is added successfully!');
    }

    // Method to display the form for editing an existing photo
    public function edit($id)
    {
        // Retrieve the photo data based on the provided photo ID
        $photo_data = Photo::where('id', $id)->first();

        // Return the 'admin.photo_edit' view with the photo data
        return view('admin.photo_edit', compact('photo_data'));
    }

    // Method to handle the submission of the form for editing an existing photo
    public function update(Request $request, $id)
    {
        // Retrieve the existing photo based on the provided photo ID
        $obj = Photo::where('id', $id)->first();

        // Check if a new photo file is uploaded
        if ($request->hasFile('photo')) {
            // Validate the new photo (it must be an image of specific types and size)
            $request->validate([
                'photo' => 'image|mimes:jpeg,jpg,svg,png,webp,gif|max:5120'  // Photo must be an image of specific types and max size 5MB
            ]);

            // Remove the existing photo file
            unlink(public_path('uploads/' . $obj->photo));

            // Get the extension of the new photo
            $ext = $request->file('photo')->extension();

            // Generate a unique name for the new photo using the current timestamp and extension
            $final_name = time() . '.' . $ext;

            // Move the new photo to the 'uploads' directory
            $request->file('photo')->move(public_path('uploads/'), $final_name);

            // Update the photo attribute of the Photo object
            $obj->photo = $final_name;
        }

        // Update the caption attribute of the Photo object from the request data
        $obj->caption = $request->caption;

        // Save the updated Photo object to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Photo is updated successfully!');
    }

    // Method to delete a photo
    public function delete($id)
    {
        // Retrieve the photo data based on the provided photo ID
        $single_data = Photo::where('id', $id)->first();

        // Remove the photo file from the 'uploads' directory
        unlink(public_path('uploads/' . $single_data->photo));

        // Delete the photo from the database
        $single_data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Photo is deleted successfully!');
    }
}
