<?php

namespace App\Http\Controllers\Admin; // Define the namespace for the controller

use App\Http\Controllers\Controller; // Import the base controller class
use App\Models\Customer; // Import the Customer model class
use Illuminate\Http\Request; // Import the Request class

class AdminCustomerController extends Controller
{
    // Method to handle viewing a list of all customers
    public function index()
    {
        // Retrieve all customers from the database
        $customers = Customer::get();
        // Return a view with the list of customers
        return view('admin.customer', compact('customers'));
    }

    // Method to handle changing the status of a customer
    public function change_status($id)
    {
        // Retrieve the customer data based on the provided ID
        $customer_data = Customer::where('id', $id)->first();
        
        // Check the current status of the customer and toggle it
        if ($customer_data->status == 1) {
            // If the current status is active, set it to inactive
            $customer_data->status = 0;
        } else {
            // If the current status is inactive, set it to active
            $customer_data->status = 1;
        }
        // Update the customer's status in the database
        $customer_data->update();
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Customer status has been successfully changed!');
    }
}
