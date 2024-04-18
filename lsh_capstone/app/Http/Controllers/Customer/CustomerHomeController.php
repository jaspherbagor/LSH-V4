<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerHomeController extends Controller
{
    public function index()
    {
        $total_completed_orders = Order::where('status','Completed')->where('customer_id',Auth::guard('customer')->user()->id)->count();
        $total_pending_orders = Order::where('status','Pending')->where('customer_id',Auth::guard('customer')->user()->id)->count();

        $recent_orders = Order::where('customer_id', Auth::guard('customer')->user()->id)->orderBy('id', 'desc')->skip(0)->take(5)->get();
        return view('customer.home', compact('total_completed_orders','total_pending_orders', 'recent_orders'));

    }
}
