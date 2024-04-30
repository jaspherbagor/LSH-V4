<?php

// Declare the namespace for the controller
namespace App\Http\Controllers\Admin;

// Import necessary classes
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;

// Define the controller class
class AdminSlideController extends Controller
{
    // Method to display all slides
    public function index()
    {
        // Retrieve all slides from the database
        $slides = Slide::get();
        // Return the view with the slides data
        return view('admin.slide_view', compact('slides'));
    }

    // Method to display the form for adding a new slide
    public function add()
    {
        // Return the view for adding a new slide
        return view('admin.slide_add');
    }

    // Method to store a new slide
    public function store(Request $request)
    {
        // Validate the request data (photo is required and must be an image of specific types and size)
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120',
        ]);

        // Get the file extension of the uploaded photo
        $ext = $request->file('photo')->extension();
        // Generate a unique name for the photo using the current timestamp
        $final_name = time() . '.' . $ext;

        // Move the photo to the uploads directory
        $request->file('photo')->move(public_path('uploads/'), $final_name);

        // Create a new Slide instance
        $obj = new Slide();
        // Assign the photo file name and other request data to the Slide object
        $obj->photo = $final_name;
        $obj->heading = $request->heading;
        $obj->text = $request->text;
        $obj->button_text = $request->button_text;
        $obj->button_url = $request->button_url;
        // Save the new Slide object to the database
        $obj->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Slide is added successfully!');
    }

    // Method to display the edit slide form
    public function edit($id)
    {
        // Retrieve the slide data for the given ID
        $slide_data = Slide::where('id', $id)->first();
        // Return the view with the slide data
        return view('admin.slide_edit', compact('slide_data'));
    }

    // Method to update a slide
    public function update(Request $request, $id)
    {
        // Retrieve the existing slide from the database
        $obj = Slide::where('id', $id)->first();

        // Check if a new photo is uploaded
        if ($request->hasFile('photo')) {
            // Validate the new photo
            $request->validate([
                'photo' => 'image|mimes:jpeg,jpg,svg,png,webp,gif|max:5120',
            ]);

            // Remove the existing photo file
            unlink(public_path('uploads/' . $obj->photo));

            // Get the extension of the new photo
            $ext = $request->file('photo')->extension();
            // Generate a unique name for the new photo
            $final_name = time() . '.' . $ext;

            // Move the new photo to the uploads directory
            $request->file('photo')->move(public_path('uploads/'), $final_name);

            // Update the photo attribute of the slide
            $obj->photo = $final_name;
        }

        // Update the other attributes of the slide
        $obj->heading = $request->heading;
        $obj->text = $request->text;
        $obj->button_text = $request->button_text;
        $obj->button_url = $request->button_url;
        // Save the updated slide to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Slide is updated successfully!');
    }

    // Method to delete a slide
    public function delete($id)
    {
        // Retrieve the slide data for the given ID
        $single_data = Slide::where('id', $id)->first();
        // Remove the photo file associated with the slide
        unlink(public_path('uploads/' . $single_data->photo));
        // Delete the slide from the database
        $single_data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Slide is deleted successfully!');
    }
}
