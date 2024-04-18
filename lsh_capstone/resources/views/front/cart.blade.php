@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $global_page_data->cart_heading }}</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container">
        <div class="row cart">
            <div class="col-md-12">
                

                @if(session()->has('cart_room_id'))

                <div class="table-responsive">
                    <table class="table table-bordered table-cart">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Serial</th>
                                <th>Photo</th>
                                <th>Room Info</th>
                                {{-- @php
                                $room = \App\Models\Room::where('id', session()->get('cart_room_id'))->first();
                                $accommodation = \App\Models\Accommodation::where('id', $room->accommodation_id)->first();
                                $accommodation_type = \App\Models\AccommodationType::where('id', $accommodation->accommodation_type_id)->first();
                                @endphp --}}
                                <th>Price</th>
                                <th>Checkin</th>
                                <th>Checkout</th>
                                <th>Guests</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
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
                                        <a href="{{ route('cart_delete',$arr_cart_room_id[$i]) }}" class="cart-delete-link" onclick="return confirm('Are you sure?');"><i class="fa fa-times"></i></a>
                                    </td>
                                    <td>{{ $i+1 }}</td>
                                    <td><img src="{{ asset('uploads/'.$room_data->featured_photo) }}"></td>
                                    <td>
                                        <a href="{{ route('room_detail',$room_data->id) }}" class="room-name">{{ $room_data->room_name }}</a>
                                    </td>

                                    @if($accommodation_type->name != 'Hotel')
                                    <td>₱{{ number_format($room_data->price, 2) }}/Month</td>
                                    @else
                                    <td>₱{{ number_format($room_data->price, 2) }}/Night</td>
                                    @endif

                                    <td>{{ \Carbon\Carbon::createFromFormat('d/m/Y', $arr_cart_checkin_date[$i])->format('F d, Y') }}</td>
                                    <td>{{ \Carbon\Carbon::createFromFormat('d/m/Y', $arr_cart_checkout_date[$i])->format('F d, Y') }}</td>
                                    <td>
                                        Adult: {{ $arr_cart_adult[$i] }}<br>
                                        Children: {{ $arr_cart_children[$i] }}
                                    </td>
                                    <td>
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
                                <td colspan="8" class="tar">Total:</td>
                                <td class="fw-bold">₱{{ number_format($total_price, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="checkout mb_20">
                    <a href="{{ route('checkout') }}" class="btn btn-primary bg-website">Checkout</a>
                </div>

                @else

                <div class="text-danger mb_30 d-flex align-items-center justify-content-center">
                    Cart is empty!
                </div>

                @endif

            </div>
        </div>
    </div>
</div>
@endsection