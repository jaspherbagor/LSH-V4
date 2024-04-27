<?php

namespace App\Http\Controllers\Front; // Define the namespace for the controller

use App\Http\Controllers\Controller; // Import the base controller class
use App\Models\Page; // Import the Page model class
use Illuminate\Http\Request; // Import the Request class

class AboutController extends Controller
{
    // Method to handle displaying the about page
    public function index()
    {
        // Retrieve the data of the about page from the database by querying the Page model with id 1
        $about_data = Page::where('id', 1)->first();
        // Return a view with the about page data
        return view('front.about', compact('about_data'));
    }
}
