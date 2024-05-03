@extends('customer.layout.app')

@section('heading', 'Order Invoice')

@section('right_top_button')
<a href="{{ route('customer_order_view') }}" class="btn btn-primary"><i class="fa fa-eye"></i> View All</a>
@endsection

@section('main_content')
<div class="section-body">
    <div class="invoice">
        <div class="invoice-print">
            <div class="row">
                <div class="col-lg-12">
                    <div class="invoice-title d-block">
                        <h2 class="mb-3">Invoice</h2>
                        <div class="invoice-number mt-md-0 mt-sm-0 mt-4">Booking No. <span class="c1">{{ $order->order_no }}</span>
                        </div>

                        <div class="container d-flex align-items-center justify-content-end me-4">
                            <div>
                                <svg class="barcode"
                                jsbarcode-format="auto"
                                jsbarcode-value="{{ $order->order_no }}"
                                jsbarcode-textmargin="1"
                                jsbarcode-height="50"
                                jsbarcode-width="2"
                                jsbarcode-fontoptions="italic">
                                </svg>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        
                        <div class="col-md-4">
                            <address>
                                <strong>Invoice To</strong><br>
                                <img src="{{ asset('uploads/'.Auth::guard('customer')->user()->photo) }}" alt="profile photo" class="w_50" ><br>
                                {{ Auth::guard('customer')->user()->name }}<br>
                                {{ Auth::guard('customer')->user()->address }},<br>
                                {{ Auth::guard('customer')->user()->city }}, <br>
                                {{ Auth::guard('customer')->user()->province }}
                            </address>
                        </div>
                        <div class="col-md-4">
                            <address>
                                <strong>Invoice from:</strong><br>                    
                                <img src="{{ asset('uploads/logo.png') }}" alt="" class="w_100"><br>
                                Tandang Sora St., Antonino,<br>
                                Labason, Zamboanga del Norte, 7117 <br>
                                contact@labason.space <br>
                            </address>
                        </div>
                        <div class="col-md-4 text-md-right">
                            <address>
                                <strong>Invoice Date</strong><br>
                                {{ \Carbon\Carbon::createFromFormat('d/m/Y', $order->booking_date)->format('F d, Y') }}
                            </address>
                        </div>
                        <div class="col-md-4">
                            <div id="qrcode"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="section-title">Order Summary</div>
                    <p class="section-lead">Room information given below in detail:</p>
                    <hr class="invoice-above-table">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-md">
                            <tr>
                                <th>SL</th>
                                <th>Accommodation Name</th>
                                <th>Room Name</th>
                                <th class="text-center">Checkin Date</th>
                                <th class="text-center">Checkout date</th>
                                <th class="text-center">Number of Adult</th>
                                <th class="text-center">Number of Children</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                            @php   $total = 0;   @endphp
                            @foreach($order_detail as $item)
                            @php
                            $room_data = \App\Models\Room::where('id',$item->room_id)->first();
                            $accommodation_data = \App\Models\Accommodation::where('id', $room_data->accommodation_id)->first();
                            $accommodation_type_data = \App\Models\AccommodationType::where('id', $accommodation_data->accommodation_type_id)->first();
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $accommodation_data->name }}</td>
                                <td>{{ $room_data->room_name }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::createFromFormat('d/m/Y', $item->checkin_date)->format('F d, Y') }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::createFromFormat('d/m/Y', $item->checkout_date)->format('F d, Y') }}</td>
                                <td class="text-center">{{ $item->adult }}</td>
                                <td class="text-center">{{ $item->children }}</td>
                                <td class="text-right">
                                    @php
                                        $d1 = explode('/',$item->checkin_date);
                                        $d2 = explode('/',$item->checkout_date);
                                        $d1_new = $d1[2].'-'.$d1[1].'-'.$d1[0];
                                        $d2_new = $d2[2].'-'.$d2[1].'-'.$d2[0];
                                        $t1 = strtotime($d1_new);
                                        $t2 = strtotime($d2_new);
                                        $diff = ($t2-$t1)/60/60/24;
                                        if($accommodation_type_data->name != 'Hotel') {
                                            $daily_price = $room_data->price / 30;
                                            $subtotal = $daily_price * $diff;
                                        } else {
                                            $subtotal = $room_data->price*$diff;
                                        }
                                        $sub = $subtotal;
                                        echo '₱'.number_format($sub, 2);
                                    @endphp
                                </td>
                            </tr>
                            @php
                            $total += $sub;
                            @endphp
                            @endforeach
                        </table>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-12 text-right">
                            <div class="invoice-detail-item">
                                <div class="invoice-detail-name">Total</div>
                                <div class="invoice-detail-value invoice-detail-value-lg">₱{{ number_format($total, 2) }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="about-print-button">
        <div class="text-md-right">
            <a href="javascript:window.print();" class="btn btn-primary bg-website btn-icon icon-left text-white print-invoice-button"><i class="fas fa-print"></i> Print</a>
        </div>
    </div>
</div>
<script src=
"https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js">
</script>
<script src="{{ asset('dist\js\JsBarcode.all.min.js') }}"></script>
<script>
    var qrcode = new QRCode("qrcode", {
        text: "{{ $order->order_no }}",
        width: 128,
        height: 128,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });

    JsBarcode(".barcode").init();
</script>
@endsection
