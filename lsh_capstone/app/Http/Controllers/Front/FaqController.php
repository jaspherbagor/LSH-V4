<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Front' namespace
namespace App\Http\Controllers\Front;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use App\Models\Faq; // Importing the Faq model for interacting with FAQ data
use Illuminate\Http\Request; // Importing the Request class

// Controller for handling FAQ-related requests
class FaqController extends Controller
{
    // Method to display the list of FAQs
    public function index()
    {
        // Retrieve all FAQs from the database
        $faq_all = Faq::get();
        
        // Render the 'front.faq' view and pass the list of FAQs to it
        return view('front.faq', compact('faq_all'));
    }
}
