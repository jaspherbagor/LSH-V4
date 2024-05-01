<?php

// Declare the namespace for the controller
namespace App\Http\Controllers\Admin;

// Import necessary classes
use App\Http\Controllers\Controller;  // Base controller class
use App\Models\Customer;  // Model for customers
use App\Models\Order;  // Model for orders
use App\Models\OrderDetail;  // Model for order details
use Illuminate\Http\Request;  // Request handling class
use Illuminate\Support\Facades\Auth;  // Authentication facade for handling logins

// Define the AdminOrderController class, extending the base Controller class
class AdminOrderController extends Controller
{
    // Method to display all orders
    public function index()
    {
        // Retrieve all orders from the database
        $orders = Order::all();
        
        // Return the 'admin.orders' view with the orders data
        return view('admin.orders', compact('orders'));
    }

    // Method to display an invoice for a specific order
    public function invoice($id)
    {
        // Retrieve the order data based on the provided order ID
        $order = Order::where('id', $id)->first();

        // Retrieve the order details associated with the order ID
        $order_detail = OrderDetail::where('order_id', $id)->get();

        // Retrieve the customer data associated with the order
        $customer_data = Customer::where('id', $order->customer_id)->first();

        // Return the 'admin.invoice' view with the order, order details, and customer data
        return view('admin.invoice', compact('order', 'order_detail', 'customer_data'));
    }

    // Method to delete an order
    public function delete($id)
    {
        // Delete the order from the database based on the provided order ID
        Order::where('id', $id)->delete();

        // Delete the order details associated with the order ID
        OrderDetail::where('order_id', $id)->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Order is deleted successfully!');
    }
}
