<?php

// Declare the namespace for the controller
namespace App\Http\Controllers\Admin;

// Import necessary classes
use App\Http\Controllers\Controller;  // Base controller class
use App\Models\AccommodationRate;  // Model for accommodation rates and reviews
use Illuminate\Http\Request;  // Request handling class

// Define the AdminReviewController class, extending the base Controller class
class AdminReviewController extends Controller
{
    // Method to display all accommodation reviews and rates
    public function index()
    {
        // Retrieve all reviews and rates from the database
        $reviews = AccommodationRate::all();
        
        // Return the 'admin.review_view' view with the reviews and rates data
        return view('admin.review_view', compact('reviews'));
    }

    // Method to delete a review or rate
    public function delete($id)
    {
        // Retrieve the accommodation rate data based on the provided ID
        $rate_data = AccommodationRate::where('id', $id)->first();
        
        // Check if the rate data exists
        if ($rate_data) {
            // Delete the accommodation rate data from the database
            $rate_data->delete();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Rate has been successfully deleted!');
        } else {
            // If the rate data is not found, redirect back with an error message
            return redirect()->back()->with('error', 'Rate not found!');
        }
    }
}
