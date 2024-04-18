@extends('front.layout.app')

@section('main_content')

<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $global_page_data->payment_heading }}</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 checkout-left mb_30">


                @php
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
                $total_price = 0;
                for($i=0;$i<count($arr_cart_room_id);$i++)
                {
                    $room_data = DB::table('rooms')->where('id',$arr_cart_room_id[$i])->first();
                    $accommodation = DB::table('accommodations')->where('id', $room_data->accommodation_id)->first();
                    $accommodation_type = DB::table('accommodation_types')->where('id', $accommodation->accommodation_type_id)->first();                            
                    $d1 = explode('/',$arr_cart_checkin_date[$i]);
                    $d2 = explode('/',$arr_cart_checkout_date[$i]);
                    $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
                    $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
                    $t1 = strtotime($d1_new);
                    $t2 = strtotime($d2_new);
                    $diff = ($t2-$t1)/60/60/24;
                    if($accommodation_type->name != 'Hotel') {
                        $daily_price = $room_data->price / 30;
                        $subtotal = $daily_price * $diff;
                    } else {
                        $subtotal = $room_data->price*$diff;
                    }
                    $total_price = $total_price+($subtotal);
                }
                @endphp
                        
                <h4>Make Payment</h4>
                <select name="payment_method" class="form-control select2" id="paymentMethodChange" autocomplete="off">
                    <option value="">Select Payment Method</option>
                    <option value="Stripe">Cards</option>
                </select>

                <div class="stripe mt_20">
                    <h4>Pay with Cards</h4>
                    <p>Accepted Cards: </p>
                    <ol>
                        <li>American Express</li>
                        <li>China UnionPay (CUP)</li>
                        <li>Discover & Diners Club</li>
                        <li>eftpos Australia</li>
                        <li>Japan Credit Bureau (JCB)</li>
                        <li>Mastercard</li>
                        <li>Visa</li>
                    </ol>
                    @php
                    $cents = $total_price*100;
                    $customer_email = Auth::guard('customer')->user()->email;
                    $stripe_publishable_key = config('services.stripe.publishable');
                    @endphp
                    <form action="{{ route('stripe',$total_price) }}" method="post">
                        @csrf
                        <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="{{ $stripe_publishable_key }}"
                            data-amount="{{ $cents }}"
                            data-name="{{ config('app.name') }}"
                            data-description=""
                            data-image="{{ asset('stripe_logo.png') }}"
                            data-currency="php"
                            data-email="{{ $customer_email }}"
                        >
                        </script>
                    </form>
                </div>

            </div>
            <div class="col-lg-4 col-md-4 checkout-right">
                <div class="inner">
                    <h4 class="mb_10">Billing Info</h4>
                    <div>
                        Name: <span class="fw-bold">{{ session()->get('billing_name') }}</span>
                    </div>
                    <div>
                        Email: <span class="fw-bold">{{ session()->get('billing_email') }}</span>
                    </div>
                    <div>
                        Phone: <span class="fw-bold">{{ session()->get('billing_phone') }}</span>
                    </div>
                    <div>
                        Country: <span class="fw-bold">{{ session()->get('billing_country') }}</span>
                    </div>
                    <div>
                        Address: <span class="fw-bold">{{ session()->get('billing_address') }}</span>
                    </div>
                    <div>
                        City: <span class="fw-bold">{{ session()->get('billing_city') }}</span>
                    </div>
                    <div>
                        Province: <span class="fw-bold">{{ session()->get('billing_province') }}</span>
                    </div>
                    <div>
                        Zip: <span class="fw-bold">{{ session()->get('billing_zip') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 checkout-right">
                <div class="inner">
                    <h4 class="mb_10">Cart Details</h4>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                @php
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

                                $total_price = 0;
                                for($i=0;$i<count($arr_cart_room_id);$i++)
                                {
                                    $room_data = DB::table('rooms')->where('id',$arr_cart_room_id[$i])->first();
                                    $accommodation = DB::table('accommodations')->where('id', $room_data->accommodation_id)->first();
                                    $accommodation_type = DB::table('accommodation_types')->where('id', $accommodation->accommodation_type_id)->first();
                                    @endphp

                                    <tr>
                                        <td>
                                            {{ $room_data->room_name }}
                                            <br>
                                            ({{ $arr_cart_checkin_date[$i] }} - {{ $arr_cart_checkout_date[$i] }})
                                            <br>
                                            Adult: {{ $arr_cart_adult[$i] }}, Children: {{ $arr_cart_children[$i] }}
                                        </td>
                                        <td class="p_price">
                                            @php
                                                $d1 = explode('/',$arr_cart_checkin_date[$i]);
                                                $d2 = explode('/',$arr_cart_checkout_date[$i]);
                                                $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
                                                $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
                                                $t1 = strtotime($d1_new);
                                                $t2 = strtotime($d2_new);
                                                $diff = ($t2-$t1)/60/60/24;

                                                if($accommodation_type->name != 'Hotel') {
                                                    $daily_price = $room_data->price / 30;
                                                    $subtotal = $daily_price * $diff;
                                                } else {
                                                    $subtotal = $room_data->price*$diff;
                                                }
                                                echo '₱'.number_format($subtotal, 2);
                                            @endphp
                                        </td>
                                    </tr>
                                    @php
                                    $total_price = $total_price+($subtotal);
                                }
                                @endphp                                
                                <tr>
                                    <td><b>Total:</b></td>
                                    <td class="p_price"><b>₱{{ number_format($total_price, 2) }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection