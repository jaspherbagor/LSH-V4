<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Customer' namespace
namespace App\Http\Controllers\Customer;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use App\Models\AccommodationRate; // Importing the AccommodationRate model for interacting with accommodation ratings data
use App\Models\Order; // Importing the Order model for interacting with order data
use Illuminate\Http\Request; // Importing the Request class
use Illuminate\Support\Facades\Auth; // Importing the Auth facade for authentication

// Controller for handling customer home page-related requests
class CustomerHomeController extends Controller
{
    // Method to display the customer home page
    public function index()
    {
        // Retrieve the total count of completed orders for the authenticated customer
        $total_completed_orders = Order::where('status', 'Completed')
                                       ->where('customer_id', Auth::guard('customer')->user()->id)
                                       ->count();

        // Retrieve the total count of pending orders for the authenticated customer
        $total_pending_orders = Order::where('status', 'Pending')
                                     ->where('customer_id', Auth::guard('customer')->user()->id)
                                     ->count();

        // Retrieve the 5 most recent orders for the authenticated customer, ordered by ID in descending order
        $recent_orders = Order::where('customer_id', Auth::guard('customer')->user()->id)
                              ->orderBy('id', 'desc')
                              ->skip(0)
                              ->take(5)
                              ->get();

        // Retrieve the total count of reviews (accommodation rates) submitted by the authenticated customer
        $total_reviews = AccommodationRate::where('customer_id', Auth::guard('customer')->user()->id)
                                          ->count();

        // Render the 'customer.home' view and pass the retrieved data to it
        return view('customer.home', compact('total_completed_orders', 'total_pending_orders', 'recent_orders', 'total_reviews'));
    }
}
