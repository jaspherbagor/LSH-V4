<?php

// Declare the namespace for the controller
namespace App\Http\Controllers\Admin;

// Import necessary classes
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

// Define the controller class
class AdminTestimonialController extends Controller
{
    // Method to display all testimonials
    public function index()
    {
        // Retrieve all testimonials from the database
        $testimonials = Testimonial::get();
        // Return the view with the testimonials data
        return view('admin.testimonial_view', compact('testimonials'));
    }

    // Method to display the add testimonial form
    public function add()
    {
        // Return the view for adding a new testimonial
        return view('admin.testimonial_add');
    }

    // Method to store a new testimonial
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120', // Validate photo
            'name' => 'required', // Validate name
            'designation' => 'required', // Validate designation
            'comment' => 'required' // Validate comment
        ]);

        // Get the file extension of the uploaded photo
        $ext = $request->file('photo')->extension();
        // Generate a unique name for the photo
        $final_name = time() . '.' . $ext;

        // Move the photo to the uploads directory
        $request->file('photo')->move(public_path('uploads/'), $final_name);

        // Create a new Testimonial instance
        $obj = new Testimonial();
        // Assign photo, name, designation, and comment to the object
        $obj->photo = $final_name;
        $obj->name = $request->name;
        $obj->designation = $request->designation;
        $obj->comment = $request->comment;
        // Save the testimonial to the database
        $obj->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Testimonial is added successfully!');
    }

    // Method to display the edit testimonial form
    public function edit($id)
    {
        // Retrieve the testimonial data for the given ID
        $testimonial_data = Testimonial::where('id', $id)->first();
        // Return the view with the testimonial data
        return view('admin.testimonial_edit', compact('testimonial_data'));
    }

    // Method to update a testimonial
    public function update(Request $request, $id)
    {
        // Retrieve the existing testimonial from the database
        $obj = Testimonial::where('id', $id)->first();

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

            // Update the photo attribute of the testimonial
            $obj->photo = $final_name;
        }

        // Update the other attributes of the testimonial
        $obj->name = $request->name;
        $obj->designation = $request->designation;
        $obj->comment = $request->comment;
        // Save the updated testimonial to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Testimonial is updated successfully!');
    }

    // Method to delete a testimonial
    public function delete($id)
    {
        // Retrieve the testimonial data for the given ID
        $single_data = Testimonial::where('id', $id)->first();
        // Remove the photo file associated with the testimonial
        unlink(public_path('uploads/' . $single_data->photo));
        // Delete the testimonial from the database
        $single_data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Testimonial is deleted successfully!');
    }
}
