<?php
// Namespace declaration: specifies that this controller belongs to the 'App.Http.Controllers.Admin' namespace
namespace App\Http\Controllers\Admin;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use App\Models\Video; // Importing the Video model for interacting with video data
use Illuminate\Http\Request; // Importing the Request class

// Controller for handling admin video-related requests
class AdminVideoController extends Controller
{
    // Method to display the list of all videos
    public function index()
    {
        // Retrieve all videos from the database
        $videos = Video::get();

        // Render the 'admin.video_view' view and pass the list of videos to it
        return view('admin.video_view', compact('videos'));
    }

    // Method to display the form for adding a new video
    public function add()
    {
        // Render the 'admin.video_add' view for adding a new video
        return view('admin.video_add');
    }

    // Method to handle form submission for adding a new video
    public function store(Request $request)
    {
        // Validate the request data for the video ID
        $request->validate([
            'video_id' => 'required' // Video ID is required
        ]);

        // Create a new Video object and populate its fields
        $obj = new Video();
        $obj->video_id = $request->video_id; // Set the video ID
        $obj->caption = $request->caption; // Set the caption (optional)
        $obj->save(); // Save the new video data to the database

        // Redirect back with a success message indicating that the video was added successfully
        return redirect()->back()->with('success', 'Video is added successfully!');
    }

    // Method to display the form for editing a specific video
    public function edit($id)
    {
        // Retrieve the specific video data based on the provided ID
        $video_data = Video::where('id', $id)->first();

        // Render the 'admin.video_edit' view and pass the video data to it
        return view('admin.video_edit', compact('video_data'));
    }

    // Method to handle form submission for updating an existing video
    public function update(Request $request, $id)
    {
        // Retrieve the specific video data based on the provided ID
        $obj = Video::where('id', $id)->first();

        // Update the video data with the new data from the request
        $obj->video_id = $request->video_id; // Update the video ID
        $obj->caption = $request->caption; // Update the caption (optional)
        $obj->update(); // Save the updated video data to the database

        // Redirect back with a success message indicating that the video was updated successfully
        return redirect()->back()->with('success', 'Video is updated successfully!');
    }

    // Method to handle deleting a specific video
    public function delete($id)
    {
        // Retrieve the specific video data based on the provided ID
        $single_data = Video::where('id', $id)->first();

        // Delete the video from the database
        $single_data->delete();

        // Redirect back with a success message indicating that the video was deleted successfully
        return redirect()->back()->with('success', 'Video is deleted successfully!');
    }
}
