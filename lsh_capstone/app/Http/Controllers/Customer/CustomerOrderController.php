<?php
// Namespace declaration: specifies that this controller belongs to the 'App\Http\Controllers\Customer' namespace
namespace App\Http\Controllers\Customer;

// Importing necessary classes and models
use App\Http\Controllers\Controller; // Importing base controller class
use Illuminate\Http\Request; // Importing the Request class
use Illuminate\Support\Facades\Auth; // Importing the Auth facade for authentication
use App\Models\Customer; // Importing the Customer model
use App\Models\Order; // Importing the Order model for interacting with order data
use App\Models\OrderDetail; // Importing the OrderDetail model for interacting with order detail data

// Controller for handling customer order-related requests
class CustomerOrderController extends Controller
{
    // Method to display the list of orders for the authenticated customer
    public function index()
    {
        // Retrieve all orders for the authenticated customer
        $orders = Order::where('customer_id', Auth::guard('customer')->user()->id)
                       ->get();
        
        // Render the 'customer.orders' view and pass the list of orders to it
        return view('customer.orders', compact('orders'));
    }

    // Method to display the invoice for a specific order based on the given order ID
    public function invoice($id)
    {
        // Retrieve the specific order based on the provided order ID
        $order = Order::where('id', $id)->first();
        
        // Retrieve the order details associated with the specific order
        $order_detail = OrderDetail::where('order_id', $id)->get();
        
        // Render the 'customer.invoice' view and pass the order and order details to it
        return view('customer.invoice', compact('order', 'order_detail'));
    }
}
