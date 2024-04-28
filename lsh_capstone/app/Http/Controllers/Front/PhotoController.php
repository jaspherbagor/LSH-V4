<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Front' namespace
namespace App\Http\Controllers\Front;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use App\Models\Photo; // Importing the Photo model for interacting with photo data
use Illuminate\Http\Request; // Importing the Request class

// Controller for handling photo gallery-related requests
class PhotoController extends Controller
{
    // Method to display a paginated list of photos in the gallery
    public function index()
    {
        // Retrieve photos from the database and paginate them (12 photos per page)
        $photo_all = Photo::paginate(12);
        
        // Render the 'front.photo_gallery' view and pass the paginated photos to it
        return view('front.photo_gallery', compact('photo_all'));
    }
}
