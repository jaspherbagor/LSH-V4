<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Front' namespace
namespace App\Http\Controllers\Front;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use App\Models\Video; // Importing the Video model for interacting with video data
use Illuminate\Http\Request; // Importing the Request class

// Controller for handling video gallery-related requests
class VideoController extends Controller
{
    // Method to display a paginated list of videos in the gallery
    public function index()
    {
        // Retrieve videos from the database and paginate them (12 videos per page)
        $video_all = Video::paginate(12);
        
        // Render the 'front.video_gallery' view and pass the paginated videos to it
        return view('front.video_gallery', compact('video_all'));
    }
}
