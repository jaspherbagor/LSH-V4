<?php

// Declare the namespace for the controller
namespace App\Http\Controllers\Admin;

// Import necessary classes
use App\Http\Controllers\Controller;  // Base controller class
use App\Models\Post;  // Model for posts
use Illuminate\Http\Request;  // Request handling class

// Define the AdminPostController class, extending the base Controller class
class AdminPostController extends Controller
{
    // Method to display all posts
    public function index()
    {
        // Retrieve all posts from the database
        $posts = Post::all();
        
        // Return the 'admin.post_view' view with the posts data
        return view('admin.post_view', compact('posts'));
    }

    // Method to display the form for adding a new post
    public function add()
    {
        // Return the 'admin.post_add' view for adding a new post
        return view('admin.post_add');
    }

    // Method to handle the submission of the form for adding a new post
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,svg,webp,gif|max:5120',  // Photo must be an image of specific types and max size 5MB
            'heading' => 'required',  // Heading is required
            'short_content' => 'required',  // Short content is required
            'content' => 'required'  // Full content is required
        ]);

        // Get the file extension of the uploaded photo
        $ext = $request->file('photo')->extension();

        // Generate a unique name for the photo using the current timestamp and extension
        $final_name = time() . '.' . $ext;

        // Move the photo to the 'uploads' directory
        $request->file('photo')->move(public_path('uploads/'), $final_name);

        // Create a new Post instance
        $obj = new Post();
        
        // Assign the photo name, heading, and content from the request data to the Post object
        $obj->photo = $final_name;
        $obj->heading = $request->heading;
        $obj->short_content = $request->short_content;
        $obj->content = $request->content;
        
        // Set the total view count to 1
        $obj->total_view = 1;

        // Save the new Post object to the database
        $obj->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Post is added successfully!');
    }

    // Method to display the form for editing an existing post
    public function edit($id)
    {
        // Retrieve the post data based on the provided post ID
        $post_data = Post::where('id', $id)->first();

        // Return the 'admin.post_edit' view with the post data
        return view('admin.post_edit', compact('post_data'));
    }

    // Method to handle the submission of the form for editing an existing post
    public function update(Request $request, $id)
    {
        // Retrieve the existing post based on the provided post ID
        $obj = Post::where('id', $id)->first();

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

            // Update the photo attribute of the Post object
            $obj->photo = $final_name;
        }

        // Update the heading, short content, and content attributes of the Post object from the request data
        $obj->heading = $request->heading;
        $obj->short_content = $request->short_content;
        $obj->content = $request->content;

        // Save the updated Post object to the database
        $obj->update();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Post is updated successfully!');
    }

    // Method to delete a post
    public function delete($id)
    {
        // Retrieve the post data based on the provided post ID
        $single_data = Post::where('id', $id)->first();

        // Remove the photo file associated with the post
        unlink(public_path('uploads/' . $single_data->photo));

        // Delete the post from the database
        $single_data->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Post is deleted successfully!');
    }
}
