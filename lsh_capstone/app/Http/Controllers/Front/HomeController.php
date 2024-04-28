<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Front' namespace
namespace App\Http\Controllers\Front;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use App\Models\Accommodation; // Importing the Accommodation model
use App\Models\AccommodationType; // Importing the AccommodationType model
use App\Models\Feature; // Importing the Feature model
use App\Models\Post; // Importing the Post model
use App\Models\Room; // Importing the Room model
use App\Models\Slide; // Importing the Slide model
use App\Models\Testimonial; // Importing the Testimonial model
use Illuminate\Http\Request; // Importing the Request class

// Controller for handling home page-related requests
class HomeController extends Controller
{
    // Method to display the home page
    public function index()
    {
        // Retrieve all testimonials from the database
        $testimonial_all = Testimonial::get();
        
        // Retrieve all slides from the database
        $slide_all = Slide::get();
        
        // Retrieve all features from the database
        $feature_all = Feature::get();
        
        // Retrieve the latest 3 posts, ordered by ID in descending order
        $post_all = Post::orderBy('id', 'desc')->limit(3)->get();
        
        // Retrieve the latest 4 rooms, ordered by ID in descending order
        $room_all = Room::orderBy('id', 'desc')->limit(4)->get();
        
        // Retrieve all accommodation types from the database
        $accommodation_types = AccommodationType::get();
        
        // Render the 'front.home' view and pass the retrieved data to it
        return view('front.home', compact('slide_all', 'feature_all', 'testimonial_all', 'post_all', 'room_all', 'accommodation_types'));
    }
}
