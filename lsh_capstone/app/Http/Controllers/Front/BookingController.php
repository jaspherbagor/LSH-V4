<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\WebsiteMail;
use App\Models\Accommodation;
use App\Models\AccommodationType;
use App\Models\BookedRoom;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stripe;

class BookingController extends Controller
{
    public function cart_submit(Request $request)
    {
        // Validate the request data
        $request->validate([
            'room_id' => 'required', // Room ID must be provided
            'checkin_checkout' => 'required', // Check-in and check-out date range must be provided
            'adult' => 'required' // Number of adults must be provided
        ]);

        // Split the check-in and check-out date range
        $dates = explode(' - ', $request->checkin_checkout);
        $checkin_date = $dates[0]; // Extract the check-in date
        $checkout_date = $dates[1]; // Extract the check-out date

        // Convert the dates from 'd/m/Y' format to 'Y-m-d' format
        $d1 = explode('/', $checkin_date);
        $d2 = explode('/', $checkout_date);
        $d1_new = $d1[2] . '-' . $d1[1] . '-' . $d1[0];
        $d2_new = $d2[2] . '-' . $d2[1] . '-' . $d2[0];

        // Convert the date strings to timestamps
        $t1 = strtotime($d1_new); // Timestamp for check-in date
        $t2 = strtotime($d2_new); // Timestamp for check-out date

        // Initialize a flag for checking room availability
        $count = 1;
        // Loop through each day from check-in date to check-out date
        while (1) {
            // If the check-in date is equal to or later than the check-out date, stop the loop
            if ($t1 >= $t2) {
                break;
            }
            
            // Format the current date as 'd/m/Y'
            $single_date = date('d/m/Y', $t1);
            
            // Check how many rooms have already been booked for the current date
            $total_already_booked_rooms = BookedRoom::where('booking_date', $single_date)
                ->where('room_id', $request->room_id)
                ->count();
            
            // Retrieve the room details from the database
            $arr = Room::where('id', $request->room_id)->first();
            // Get the total allowed rooms for the specific room ID
            $total_allowed_rooms = $arr->total_rooms;
            
            // Retrieve the total number of adults from the request
            $cart_total_guest = $request->adult;

            // Get the maximum number of guests allowed in the room
            $room_total_guest = $arr->total_guests;

            // Check if the number of adults in the cart exceeds the allowed number of guests in the room
            if ($cart_total_guest > $room_total_guest) {
                // Redirect back with an error message if the number of guests exceeds the allowed number
                return redirect()->back()->with('error', 'There were only ' . $room_total_guest . ' guests allowed to book in this room!');
            }

            // Check if all rooms for the current date are already booked
            if ($total_already_booked_rooms == $total_allowed_rooms) {
                // If all rooms are booked, set the flag to 0 and break the loop
                $count = 0;
                break;
            }
            
            // Move to the next day by adding one day to the current timestamp
            $t1 = strtotime('+1 day', $t1);
        }

        // If the flag is 0, it means the room is already fully booked for the desired date range
        if ($count == 0) {
            // Redirect back with an error message
            return redirect()->back()->with('error', 'Maximum number of this room is already booked');
        }

        // Store the booking details in the session (room ID, check-in date, check-out date, number of adults, and children)
        session()->push('cart_room_id', $request->room_id);
        session()->push('cart_checkin_date', $checkin_date);
        session()->push('cart_checkout_date', $checkout_date);
        session()->push('cart_adult', $request->adult);
        session()->push('cart_children', $request->children);

        // Redirect back with a success message indicating the room has been added to the cart
        return redirect()->back()->with('success', 'Room is added to the cart successfully.');
    }

    public function cart_view()
    {
        // Return the 'front.cart' view for displaying the cart contents
        return view('front.cart');
    }
    

    public function cart_delete($id)
    {
        $arr_cart_room_id = array();
        $i=0;
        foreach(session()->get('cart_room_id') as $value) {
            $arr_cart_room_id[$i] = $value;
            $i++;
        }

        $arr_cart_checkin_date = array();
        $i=0;
        foreach(session()->get('cart_checkin_date') as $value) {
            $arr_cart_checkin_date[$i] = $value;
            $i++;
        }

        $arr_cart_checkout_date = array();
        $i=0;
        foreach(session()->get('cart_checkout_date') as $value) {
            $arr_cart_checkout_date[$i] = $value;
            $i++;
        }

        $arr_cart_adult = array();
        $i=0;
        foreach(session()->get('cart_adult') as $value) {
            $arr_cart_adult[$i] = $value;
            $i++;
        }

        $arr_cart_children = array();
        $i=0;
        foreach(session()->get('cart_children') as $value) {
            $arr_cart_children[$i] = $value;
            $i++;
        }

        session()->forget('cart_room_id');
        session()->forget('cart_checkin_date');
        session()->forget('cart_checkout_date');
        session()->forget('cart_adult');
        session()->forget('cart_children');

        for($i=0;$i<count($arr_cart_room_id);$i++)
        {
            if($arr_cart_room_id[$i] == $id) 
            {
                continue;    
            }
            else
            {
                session()->push('cart_room_id',$arr_cart_room_id[$i]);
                session()->push('cart_checkin_date',$arr_cart_checkin_date[$i]);
                session()->push('cart_checkout_date',$arr_cart_checkout_date[$i]);
                session()->push('cart_adult',$arr_cart_adult[$i]);
                session()->push('cart_children',$arr_cart_children[$i]);
            }
        }

        return redirect()->back()->with('success', 'Cart item is deleted.');

    }


    public function checkout()
    {
        if(!Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'You must have to login in order to book');
        }

        if(!session()->has('cart_room_id')) {
            return redirect()->back()->with('error', 'No accommodation units added to booking cart');
        }

        return view('front.checkout');
    }

    public function payment(Request $request)
    {
        if(!Auth::guard('customer')->check()) {
            return redirect()->back()->with('error', 'You must have to login in order to checkout');
        }

        if(!session()->has('cart_room_id')) {
            return redirect()->back()->with('error', 'There is no item in the cart');
        }

        $request->validate([
            'billing_name' => 'required',
            'billing_email' => 'required|email',
            'billing_phone' => 'required',
            'billing_country' => 'required',
            'billing_address' => 'required',
            'billing_province' => 'required',
            'billing_city' => 'required',
            'billing_zip' => 'required'
        ]);

        session()->put('billing_name',$request->billing_name);
        session()->put('billing_email',$request->billing_email);
        session()->put('billing_phone',$request->billing_phone);
        session()->put('billing_country',$request->billing_country);
        session()->put('billing_address',$request->billing_address);
        session()->put('billing_province',$request->billing_province);
        session()->put('billing_city',$request->billing_city);
        session()->put('billing_zip',$request->billing_zip);

        return view('front.payment');
    }


    public function stripe(Request $request,$final_price)
    {
        $stripe_secret_key = config('services.stripe.secret');
        $cents = $final_price*100;
        Stripe\Stripe::setApiKey($stripe_secret_key);
        $response = Stripe\Charge::create ([
            "amount" => $cents,
            "currency" => "php",
            "source" => $request->stripeToken,
            "description" => env('APP_NAME')
        ]);

        $responseJson = $response->jsonSerialize();
        $transaction_id = $responseJson['balance_transaction'];
        $last_4 = $responseJson['payment_method_details']['card']['last4'];

        $order_no = time();

        $statement = DB::select("SHOW TABLE STATUS LIKE 'orders'");
        $ai_id = $statement[0]->Auto_increment;

        $obj = new Order();
        $obj->customer_id = Auth::guard('customer')->user()->id;
        $obj->order_no = $order_no;
        $obj->transaction_id = $transaction_id;
        $obj->payment_method = 'Stripe';
        $obj->card_last_digit = $last_4;
        $obj->paid_amount = $final_price;
        $obj->booking_date = date('d/m/Y');
        $obj->status = 'Completed';
        $obj->save();
        
        $arr_cart_room_id = array();
        $i=0;
        foreach(session()->get('cart_room_id') as $value) {
            $arr_cart_room_id[$i] = $value;
            $i++;
        }

        $arr_cart_checkin_date = array();
        $i=0;
        foreach(session()->get('cart_checkin_date') as $value) {
            $arr_cart_checkin_date[$i] = $value;
            $i++;
        }

        $arr_cart_checkout_date = array();
        $i=0;
        foreach(session()->get('cart_checkout_date') as $value) {
            $arr_cart_checkout_date[$i] = $value;
            $i++;
        }

        $arr_cart_adult = array();
        $i=0;
        foreach(session()->get('cart_adult') as $value) {
            $arr_cart_adult[$i] = $value;
            $i++;
        }

        $arr_cart_children = array();
        $i=0;
        foreach(session()->get('cart_children') as $value) {
            $arr_cart_children[$i] = $value;
            $i++;
        }

        for($i=0;$i<count($arr_cart_room_id);$i++)
        {
            $r_info = Room::where('id',$arr_cart_room_id[$i])->first();
            $accommodation = Accommodation::where('id', $r_info->accommodation_id)->first();
            $accommodation_type = AccommodationType::where('id', $accommodation->accommodation_type_id)->first();
            $d1 = explode('/',$arr_cart_checkin_date[$i]);
            $d2 = explode('/',$arr_cart_checkout_date[$i]);
            $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
            $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
            $t1 = strtotime($d1_new);
            $t2 = strtotime($d2_new);
            $diff = ($t2-$t1)/60/60/24;
            if($accommodation_type->name != 'Hotel') {
                $daily_price = $r_info->price / 30;
                $subtotal = $daily_price * $diff;
            } else {
                $subtotal = $r_info->price*$diff;
            }
            $sub = $subtotal;

            $obj = new OrderDetail();
            $obj->order_id = $ai_id;
            $obj->room_id = $arr_cart_room_id[$i];
            $obj->order_no = $order_no;
            $obj->checkin_date = $arr_cart_checkin_date[$i];
            $obj->checkout_date = $arr_cart_checkout_date[$i];
            $obj->adult = $arr_cart_adult[$i];
            $obj->children = $arr_cart_children[$i];
            $obj->subtotal = $sub;
            $obj->save();

            while(1) {
                if($t1>=$t2) {
                    break;
                }

                $obj = new BookedRoom();
                $obj->booking_date = date('d/m/Y',$t1);
                $obj->order_no = $order_no;
                $obj->room_id = $arr_cart_room_id[$i];
                $obj->save();

                $t1 = strtotime('+1 day',$t1);
            }

        }

        $subject = 'Thank You for Your Booking with Labason Safe Haven';
        $message = '<p>Dear <strong>'.Auth::guard('customer')->user()->name. '</strong>,</p>';
        $message .= '<p>Thank you for choosing <strong>Labason Safe Haven</strong> for your upcoming stay. We appreciate your trust in us and are excited to welcome you to our establishment. The booking information is given below: </p>';

        $message .= '<strong>Booking No</strong>: '.$order_no;
        $message .= '<br><strong>Transaction Id</strong>: '.$transaction_id;
        $message .= '<br><strong>Payment Method</strong>: Stripe';
        $message .= '<br><strong>Paid Amount</strong>: ₱'.number_format($final_price, 2);
        $message .= '<br><strong>Booking Date</strong>: '.\Carbon\Carbon::createFromFormat('d/m/Y', date('d/m/Y'))->format('F d, Y').'<br>';

        for($i=0;$i<count($arr_cart_room_id);$i++) {

            $r_info = Room::where('id',$arr_cart_room_id[$i])->first();
            $accommodation = Accommodation::where('id', $r_info->accommodation_id)->first();
            $accommodation_type = AccommodationType::where('id', $accommodation->accommodation_type_id)->first();

            $d1 = explode('/',$arr_cart_checkin_date[$i]);
            $d2 = explode('/',$arr_cart_checkout_date[$i]);
            $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
            $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
            $t1 = strtotime($d1_new);
            $t2 = strtotime($d2_new);
            $diff = ($t2-$t1)/60/60/24;
            if($accommodation_type->name != 'Hotel') {
                $daily_price = $r_info->price / 30;
                $subtotal = $daily_price * $diff;
            } else {
                $subtotal = $r_info->price*$diff;
            }
            $sub = $subtotal;
            $message .= '<br><strong>Accommodation Name</strong>: '.$accommodation->name;
            $message .= '<br><strong>Room Name</strong>: '.$r_info->room_name;
            if($accommodation_type->name != 'Hotel') {
                $message .= '<br><strong>Price Per Month</strong>: ₱'.number_format($r_info->price, 2);
            } else {
                $message .= '<br><strong>Price Per Night</strong>: ₱'.number_format($r_info->price, 2);
            }
            $message .= '<br><strong>Subtotal</strong>: ₱'.number_format($sub, 2);
            $message .= '<br><strong>Checkin Date</strong>: '.\Carbon\Carbon::createFromFormat('d/m/Y', $arr_cart_checkin_date[$i])->format('F d, Y');
            $message .= '<br><strong>Checkout Date</strong>: '.\Carbon\Carbon::createFromFormat('d/m/Y', $arr_cart_checkout_date[$i])->format('F d, Y');
            $message .= '<br><strong>Adult</strong>: '.$arr_cart_adult[$i];
            $message .= '<br><strong>Children</strong>: '.$arr_cart_children[$i].'<br>';
        }            
        $message .= '<p>At Labason Safe Haven, we are committed to providing you with a comfortable and memorable experience. Our team is dedicated to ensuring that your stay exceeds your expectations. </p>';
        $message .= '<p>If you have any special requests or requirements, please feel free to let us know, and we will do our best to accommodate them.</p>';
        $message .= '<p>Once again, thank you for choosing Labason Safe Haven. We look forward to welcoming you and providing you with exceptional hospitality.</p>';
        $message .= 'Warm regards, <br>';
        $message .= '<strong>Celine Lerios</strong> <br>';
        $message .= '<strong>Chief Operating Officer</strong><br>';
        $message .= '<strong>Labason Safe Haven</strong><br>';

        $customer_email = Auth::guard('customer')->user()->email;

        Mail::to($customer_email)->send(new WebsiteMail($subject,$message));

        session()->forget('cart_room_id');
        session()->forget('cart_checkin_date');
        session()->forget('cart_checkout_date');
        session()->forget('cart_adult');
        session()->forget('cart_children');
        session()->forget('billing_name');
        session()->forget('billing_email');
        session()->forget('billing_phone');
        session()->forget('billing_country');
        session()->forget('billing_address');
        session()->forget('billing_state');
        session()->forget('billing_city');
        session()->forget('billing_zip');

        return redirect()->route('home')->with('success', 'Payment is successful');

    }
}
