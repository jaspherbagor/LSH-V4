<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Front' namespace
namespace App\Http\Controllers\Front;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use App\Models\Page; // Importing the Page model for interacting with page data
use Illuminate\Http\Request; // Importing the Request class

// Controller for handling privacy policy-related requests
class PrivacyController extends Controller
{
    // Method to display the privacy policy page
    public function index()
    {
        // Retrieve the privacy policy page data (assuming it has an ID of 1)
        $privacy_data = Page::where('id', 1)->first();
        
        // Render the 'front.privacy' view and pass the privacy policy data to it
        return view('front.privacy', compact('privacy_data'));
    }
}
