@extends('front.layout.app')

@section('main_content')
<div class="page-top">
    <div class="bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $global_page_data->checkout_heading }}</h2>
            </div>
        </div>
    </div>
</div>
<div class="page-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-6 checkout-left">

                <form action="{{ route('payment') }}" method="post" class="frm_checkout">
                    @csrf
                    <div class="billing-info">
                        <h4 class="mb_30">Billing Information</h4>
                        @php
                        if(session()->has('billing_name')) {
                            $billing_name = session()->get('billing_name');
                        } else {
                            $billing_name = Auth::guard('customer')->user()->name;
                        }

                        if(session()->has('billing_email')) {
                            $billing_email = session()->get('billing_email');
                        } else {
                            $billing_email = Auth::guard('customer')->user()->email;
                        }

                        if(session()->has('billing_phone')) {
                            $billing_phone = session()->get('billing_phone');
                        } else {
                            $billing_phone = Auth::guard('customer')->user()->phone;
                        }

                        if(session()->has('billing_country')) {
                            $billing_country = session()->get('billing_country');
                        } else {
                            $billing_country = Auth::guard('customer')->user()->country;
                        }

                        if(session()->has('billing_address')) {
                            $billing_address = session()->get('billing_address');
                        } else {
                            $billing_address = Auth::guard('customer')->user()->address;
                        }

                        if(session()->has('billing_province')) {
                            $billing_province = session()->get('billing_province');
                        } else {
                            $billing_province = Auth::guard('customer')->user()->province;
                        }

                        if(session()->has('billing_city')) {
                            $billing_city = session()->get('billing_city');
                        } else {
                            $billing_city = Auth::guard('customer')->user()->city;
                        }

                        if(session()->has('billing_zip')) {
                            $billing_zip = session()->get('billing_zip');
                        } else {
                            $billing_zip = Auth::guard('customer')->user()->zip;
                        }
                        @endphp
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="">Name: *</label>
                                <input type="text" class="form-control mb_15" name="billing_name" value="{{ $billing_name }}">
                                @if($errors->has('billing_name'))
                                <span class="text-danger">{{ $errors->first('billing_name') }}</span>
                            @endif
                            </div>
                            <div class="col-lg-6">
                                <label for="">Email Address: *</label>
                                <input type="text" class="form-control mb_15" name="billing_email" value="{{ $billing_email }}">
                                @if($errors->has('billing_email'))
                                <span class="text-danger">{{ $errors->first('billing_email') }}</span>
                            @endif
                            </div>
                            <div class="col-lg-6">
                                <label for="">Phone Number: *</label>
                                <input type="text" class="form-control mb_15" name="billing_phone" value="{{ $billing_phone }}">
                                @if($errors->has('billing_phone'))
                                <span class="text-danger">{{ $errors->first('billing_phone') }}</span>
                            @endif
                            </div>
                            <div class="col-lg-6">
                                <label for="">Country: *</label>
                                <input type="text" class="form-control mb_15" name="billing_country" value="{{ $billing_country }}">
                                @if($errors->has('billing_country'))
                                <span class="text-danger">{{ $errors->first('billing_country') }}</span>
                            @endif
                            </div>
                            <div class="col-lg-6">
                                <label for="">Address: *</label>
                                <input type="text" class="form-control mb_15" name="billing_address" value="{{ $billing_address }}">
                                @if($errors->has('billing_address'))
                                <span class="text-danger">{{ $errors->first('billing_address') }}</span>
                            @endif
                            </div>
                            <div class="col-lg-6">
                                <label for="">Province: *</label>
                                <input type="text" class="form-control mb_15" name="billing_province" value="{{ $billing_province }}">
                                @if($errors->has('billing_province'))
                                <span class="text-danger">{{ $errors->first('billing_province') }}</span>
                            @endif
                            </div>
                            <div class="col-lg-6">
                                <label for="">City: *</label>
                                <input type="text" class="form-control mb_15" name="billing_city" value="{{ $billing_city }}">
                                @if($errors->has('billing_city'))
                                <span class="text-danger">{{ $errors->first('billing_city') }}</span>
                            @endif
                            </div>
                            <div class="col-lg-6">
                                <label for="">Zip Code: *</label>
                                <input type="text" class="form-control mb_15" name="billing_zip" value="{{ $billing_zip }}">
                                @if($errors->has('billing_zip'))
                                <span class="text-danger">{{ $errors->first('billing_zip') }}</span>
                            @endif
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary bg-website mb_30">Continue to payment</button>
                </form>
            </div>
            <div class="col-lg-4 col-md-6 checkout-right">
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
                                            ({{ \Carbon\Carbon::createFromFormat('d/m/Y', $arr_cart_checkin_date[$i])->format('F d, Y') }} - {{ \Carbon\Carbon::createFromFormat('d/m/Y', $arr_cart_checkout_date[$i])->format('F d, Y') }})
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