<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Customer' namespace
namespace App\Http\Controllers\Customer;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use App\Models\Accommodation; // Importing the Accommodation model for interacting with accommodation data
use App\Models\AccommodationRate; // Importing the AccommodationRate model for interacting with accommodation rate data
use Illuminate\Http\Request; // Importing the Request class
use Illuminate\Support\Facades\Auth; // Importing the Auth facade for authentication

// Controller for handling customer reviews
class CustomerReviewController extends Controller
{
    // Method to display the list of reviews submitted by the authenticated customer
    public function index()
    {
        // Retrieve all rates (reviews) submitted by the authenticated customer
        $rates = AccommodationRate::where('customer_id', Auth::guard('customer')->user()->id)->get();

        // Render the 'customer.review_view' view and pass the list of rates to it
        return view('customer.review_view', compact('rates'));
    }

    // Method to display the form for adding a review to a specific accommodation
    public function add_review($id)
    {
        // Retrieve the specific accommodation based on the provided ID
        $accommodation = Accommodation::where('id', $id)->first();
        
        // Render the 'customer.review_add' view and pass the accommodation data to it
        return view('customer.review_add', compact('accommodation'));
    }

    // Method to handle form submission for adding a new review
    public function review_store(Request $request, $id)
    {
        // Validate the request data for review heading, rate, and review description
        $request->validate([
            'review_heading' => 'required', // Review heading is required
            'rate' => 'required', // Rate is required
            'review_description' => 'required' // Review description is required
        ]);

        // Create a new AccommodationRate object and populate its fields
        $review_data = new AccommodationRate();
        $review_data->customer_id = Auth::guard('customer')->user()->id; // Set the authenticated customer ID
        $review_data->accommodation_id = $id; // Set the accommodation ID
        $review_data->rate = $request->rate; // Set the rate
        $review_data->review_heading = $request->review_heading; // Set the review heading
        $review_data->review_description = $request->review_description; // Set the review description
        $review_data->save(); // Save the new review data to the database

        // Redirect back with a success message indicating that the review was submitted successfully
        return redirect()->back()->with('success', 'Review for accommodation has been submitted successfully!');
    }

    // Method to display the form for editing a specific review
    public function review_edit($id)
    {
        // Retrieve the review data for the specific accommodation based on the ID
        $review_data = AccommodationRate::where('accommodation_id', $id)->first();
        
        // Render the 'customer.review_edit' view and pass the review data to it
        return view('customer.review_edit', compact('review_data'));
    }

    // Method to handle form submission for updating an existing review
    public function review_update(Request $request, $id)
    {
        // Retrieve the review data for the specific accommodation based on the ID
        $review_data = AccommodationRate::where('accommodation_id', $id)->first();

        // Update the review data with the new data from the request
        $review_data->rate = $request->rate;
        $review_data->review_heading = $request->review_heading;
        $review_data->review_description = $request->review_description;
        $review_data->update(); // Save the updated review data to the database

        // Redirect back with a success message indicating that the review was updated successfully
        return redirect()->back()->with('success', 'Review has been successfully updated!');
    }

    // Method to handle deleting a specific review
    public function review_delete($id)
    {
        // Retrieve the review data for the specific review ID
        $review_data = AccommodationRate::where('id', $id)->first();

        // Delete the review from the database
        $review_data->delete();

        // Redirect back with a success message indicating that the review was deleted successfully
        return redirect()->back()->with('success', 'Review has been successfully deleted!');
    }
}
