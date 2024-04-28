<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Front' namespace
namespace App\Http\Controllers\Front;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use App\Models\Page; // Importing the Page model for interacting with page data
use Illuminate\Http\Request; // Importing the Request class

// Controller for handling terms and conditions-related requests
class TermsController extends Controller
{
    // Method to display the terms and conditions page
    public function index()
    {
        // Retrieve the terms and conditions page data (assuming it has an ID of 1)
        $terms_data = Page::where('id', 1)->first();
        
        // Render the 'front.terms' view and pass the terms and conditions data to it
        return view('front.terms', compact('terms_data'));
    }
}
